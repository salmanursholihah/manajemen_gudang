<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Customer;
use App\Models\Supplier;

class AdminTransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['customer','supplier'])->paginate(5);
        return view('backend.admin.transactions.index', compact('transactions'));
    }

    public function create()
    {
        $customers = Customer::all();
        $suppliers = Supplier::all();
        return view('backend.admin.transactions.create', compact('customers','suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'invoice'     => 'required|string',
            'customer_id' => 'required|exists:customers,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'type'        => 'required|in:pembelian,pembayaran',
            'total'       => 'required|numeric',
            'date'        => 'required|date'
        ]);

        Transaction::create($request->only([
            'invoice','customer_id','supplier_id','type','total','date'
        ]));

        return redirect()->route('backend.admin.transactions.index')
            ->with('success','Transaction created');
    }

    public function edit(Transaction $transaction)
    {
        $customers = Customer::all();
        $suppliers = Supplier::all();

        return view('backend.admin.transactions.edit', compact('transaction','customers','suppliers'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'invoice'     => 'required|string',
            'customer_id' => 'required|exists:customers,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'type'        => 'required|in:pembelian,pembayaran',
            'total'       => 'required|numeric',
            'date'        => 'required|date'
        ]);

        $transaction->update($request->only([
            'invoice','customer_id','supplier_id','type','total','date'
        ]));

        return redirect()->route('backend.admin.transactions.index')
            ->with('success','Transaction updated.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('backend.admin.transactions.index')
            ->with('success','Transaction deleted.');
    }
}
