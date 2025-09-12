<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class OperatorInboundController extends Controller
{
   public function create()
{
    $inbounds = Transaction::where('type', 'pembelian')->with(['supplier', 'items.product'])->paginate(10);
    $suppliers = Supplier::all();
    $products = Product::all();

    return view('backend.operator.transactions.inbound', compact('suppliers','products','inbounds'));
}


    public function store(Request $request)
    {
        $request->validate([
            'invoice' => 'required|unique:transactions',
            'supplier_id' => 'required|exists:suppliers,id',
            'date' => 'required|date',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.price' => 'required|numeric|min:0',
        ]);

        $total = collect($request->products)->sum(fn($item) => $item['quantity'] * $item['price']);

        $transaction = Transaction::create([
            'invoice' => $request->invoice,
            'supplier_id' => $request->supplier_id,
            'type' => 'pembelian',
            'total' => $total,
            'date' => $request->date,
            'status' => 'pending',
            'user_id' => Auth::id(),
        ]);

        foreach($request->products as $item){
            $product = Product::find($item['product_id']);
            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);

            $product->quantity += $item['quantity']; // update stock
            $product->save();
        }

        return redirect()->route('backend.operator.transactions.index')
                         ->with('success','Inbound transaction created');
    }
}

