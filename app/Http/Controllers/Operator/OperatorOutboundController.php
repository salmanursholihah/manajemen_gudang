<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\TransactionItems;

class OperatorOutboundController extends Controller
{
    public function create()
    {
        $outbounds = Transaction::where('type', 'pembayaran')->with(['customer', 'items.product'])->paginate(10);
        $customers = Customer::all();
        $products = Product::all();
        return view('backend.operator.transactions.outbound', compact('customers','products','outbounds'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'invoice' => 'required|unique:transactions',
            'customer_id' => 'required|exists:customers,id',
            'date' => 'required|date',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.price' => 'required|numeric|min:0',
        ]);

        $total = collect($request->products)->sum(fn($item) => $item['quantity'] * $item['price']);

        $transaction = Transaction::create([
            'invoice' => $request->invoice,
            'customer_id' => $request->customer_id,
            'type' => 'pembayaran',
            'total' => $total,
            'date' => $request->date,
            'status' => 'pending',
            'user_id' => Auth::id(),
        ]);

        foreach($request->products as $item){
            $product = Product::find($item['product_id']);
            if($product->quantity < $item['quantity']){
                return back()->with('error',"Stock {$product->name} tidak cukup!");
            }

            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);

            $product->quantity -= $item['quantity']; // update stock
            $product->save();
        }

        return redirect()->route('backend.operator.transactions.index')
                         ->with('success','Outbound transaction created');
    }
}

