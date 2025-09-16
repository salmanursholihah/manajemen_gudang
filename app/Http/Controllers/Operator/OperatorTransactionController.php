<?php 
namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;

class OperatorTransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with(['customer','supplier','items.product']);
        if($request->filled('type')) {
            $query->where('type', $request->type);
        }
        $transactions = $query->orderBy('date','desc')->paginate(10);
        return view('backend.operator.transactions.index', compact('transactions'));
    }

    public function create()
    {   
        $transactions = Transaction::with(['customer','supplier','items.product'])
                                   ->orderBy('date','desc')
                                   ->paginate(10);
        $customers = Customer::all();
        $suppliers = Supplier::all();
        $products = Product::where('status','approved')->get();
        return view('backend.operator.transactions.create', compact('customers','suppliers','products','transactions'));
    }

public function store(Request $request)
{
    $request->validate([
        'invoice' => 'required|string',
        'customer_id' => 'nullable|exists:customers,id',
        'supplier_id' => 'nullable|exists:suppliers,id',
        'type' => 'required|in:pembelian,pembayaran,mutation',
        'date' => 'required|date',
        'products' => 'required|array',
        'products.*' => 'exists:products,id',
        'quantities' => 'required|array',
        'quantities.*' => 'integer|min:1',
        'document_operator' => 'nullable|file|mimes:pdf,jpg,png,doc,docx|max:2048',
    ]);

    // Hitung total dari produk
    $total = 0;
    foreach ($request->products as $i => $productId) {
        $product = Product::findOrFail($productId);
        $total += $product->price * $request->quantities[$i];
    }

    // Upload dokumen operator jika ada
    $docPath = null;
    if ($request->hasFile('document_operator')) {
        $docPath = $request->file('document_operator')->store('documents/operator', 'public');
    }

    $transaction = Transaction::create([
        'invoice' => $request->invoice,
        'customer_id' => $request->customer_id,
        'supplier_id' => $request->supplier_id,
        'type' => $request->type,
        'total' => $total,
        'total_operator' => $request->total_operator ?? $total,
        'status' => 'pending',
        'date' => $request->date,
        'document_operator' => $docPath,
        'user_id' => Auth::id(),
    ]);

    // Simpan item transaksi
    foreach ($request->products as $i => $productId) {
        $product = Product::findOrFail($productId);
        $quantity = $request->quantities[$i];

        TransactionItem::create([
            'transaction_id' => $transaction->id,
            'product_id' => $productId,
            'quantity' => $quantity,
            'price' => $product->price,
        ]);

        // Update stok sesuai tipe transaksi
        if ($request->type === 'pembelian') {
            $product->increment('stock', $quantity);
        } elseif ($request->type === 'pembayaran') {
            $product->decrement('stock', $quantity);
        }
    }

    return redirect()->route('backend.operator.transactions.index')
        ->with('success', 'Transaction created successfully.');
}

    public function edit(Transaction $transaction)
    {
        $transaction->load('items.product');
        $customers = Customer::all();
        $suppliers = Supplier::all();
        $products = Product::where('status','approved')->get();
        return view('backend.operator.transactions.edit', compact('transaction','customers','suppliers','products'));
    }

  public function update(Request $request, Transaction $transaction)
{
    $request->validate([
        'status' => 'required|in:pending,approved,rejected,draft',
        'document_operator' => 'nullable|file|mimes:pdf,jpg,png,doc,docx|max:2048',
    ]);

    $data = ['status' => $request->status];

    if ($request->hasFile('document_operator')) {
        $data['document_operator'] = $request->file('document_operator')->store('documents/operator', 'public');
    }

    $transaction->update($data);

    return redirect()->route('backend.operator.transactions.index')
                     ->with('success','Transaction updated');
}


    public function destroy(Transaction $transaction)
    {
        foreach($transaction->items as $item) {
            $product = Product::find($item->product_id);
            if($transaction->type == 'pembelian') {
                $product->decrement('stock', $item->quantity);
            } else {
                $product->increment('stock', $item->quantity);
            }
        }

        $transaction->delete();
        return redirect()->route('backend.operator.transactions.index')
                         ->with('success','Transaction deleted');
    }
}
