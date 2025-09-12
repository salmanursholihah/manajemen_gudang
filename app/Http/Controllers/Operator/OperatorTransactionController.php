<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\Product;
use App\Models\TransactionItem;

class OperatorTransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['customer', 'supplier', 'items.product'])->paginate(10);
        return view('backend.operator.transactions.index', compact('transactions'));
    }

    public function edit(Transaction $transaction)
    {
        $transaction->load('items.product');
        return view('backend.operator.transactions.edit', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $transaction->update([
            'status' => $request->status
        ]);

        return redirect()->route('backend.operator.transactions.index')
                         ->with('success','Transaction updated');
    }

    public function destroy(Transaction $transaction)
    {
        // Optional: rollback stock sebelum delete
        foreach($transaction->items as $item){
            $product = Product::find($item->product_id);
            if($transaction->type == 'pembelian'){
                $product->quantity -= $item->quantity;
            } else {
                $product->quantity += $item->quantity;
            }
            $product->save();
        }

        $transaction->delete();
        return redirect()->route('backend.operator.transactions.index')
                         ->with('success','Transaction deleted');
    }
public function create()
{
    $customers = Customer::all();
    $suppliers = Supplier::all();
    $products = Product::where('status', 'approved')->get(); // hanya produk aktif
    return view('backend.operator.transactions.create', compact('customers','suppliers','products'));
}

public function store(Request $request)
{
    $request->validate([
        'invoice' => 'required|string|unique:transactions',
        'customer_id' => 'required|exists:customers,id',
        'supplier_id' => 'nullable|exists:suppliers,id',
        'type' => 'required|in:pembelian,pembayaran',
        'date' => 'required|date',
        'products' => 'required|array',
        'products.*.id' => 'required|exists:products,id',
        'products.*.quantity' => 'required|integer|min:1',
    ]);

    // Hitung total transaksi dari produk
    $total = 0;
    foreach ($request->products as $p) {
        $product = Product::find($p['id']);
        $total += $product->price * $p['quantity']; // asumsi Product ada field price
    }

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

    // Simpan transaction_items dan update stock
    foreach ($request->products as $p) {
        $product = Product::find($p['id']);

        TransactionItem::create([
            'transaction_id' => $transaction->id,
            'product_id' => $product->id,
            'quantity' => $p['quantity'],
            'price' => $product->price,
        ]);

        // Update stock produk
        if($request->type == 'pembelian') {
            $product->increment('quantity', $p['quantity']); // inbound
        } else {
            $product->decrement('quantity', $p['quantity']); // outbound
        }
    }

    return redirect()->route('backend.operator.transactions.index')->with('success','Transaction created successfully.');
}

}
