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
    // ✅ Validasi sesuai struktur form
    $request->validate([
        'invoice' => 'required|string|unique:transactions',
        'customer_id' => 'required|exists:customers,id',
        'supplier_id' => 'nullable|exists:suppliers,id',
        'type' => 'required|in:pembelian,pembayaran', // samakan dengan create.blade.php
        'date' => 'required|date',
        'products' => 'required|array',
        'products.*' => 'required|exists:products,id',
        'quantities' => 'required|array',
        'quantities.*' => 'required|integer|min:1',
    ]);

    // ✅ Hitung total transaksi
    $total = 0;
    foreach ($request->products as $index => $productId) {
        $product = Product::findOrFail($productId);
        $quantity = $request->quantities[$index];
        $total += $product->price * $quantity;
    }

    // ✅ Simpan transaksi
    $transaction = Transaction::create([
        'invoice' => $request->invoice,
        'customer_id' => $request->customer_id,
        'supplier_id' => $request->supplier_id,
        'type' => $request->type,
        'total' => $total,
        'date' => $request->date,
        'status' => 'pending',
        'user_id' => Auth::id(),
    ]);

    // ✅ Simpan item transaksi + update stock
    foreach ($request->products as $index => $productId) {
        $product = Product::findOrFail($productId);
        $quantity = $request->quantities[$index];

        TransactionItem::create([
            'transaction_id' => $transaction->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'price' => $product->price,
        ]);

        // update stok berdasarkan tipe transaksi
        if ($request->type === 'inbound') {
            $product->increment('stock', $quantity);
        } else {
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
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $transaction->update(['status' => $request->status]);

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
