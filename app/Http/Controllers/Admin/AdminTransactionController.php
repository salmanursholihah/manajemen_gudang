<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Customer;

class AdminTransactionController extends Controller
{
  
    public function index()
    {
        $transactions = Transaction::with('customer')->get();
        return view('backend.admin.transactions.index', compact('transactions'));
    }

    public function create()
    {
        $customers = Customer::all();
        return view('backend.admin.transactions.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'invoice' => 'required|string|unique:transactions,invoice',
            'customer_id' => 'required|exists:customers,id',
            'date' => 'required|date',
            'total' => 'required|numeric',
        ]);

        Transaction::create($request->all());
        return redirect()->route('backend.admin.transactions.index')->with('success','Transaction created.');
    }

    public function edit(Transaction $transaction)
    {
        $customers = Customer::all();
        return view('backend.admin.transactions.edit', compact('transaction','customers'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'invoice' => 'required|string|unique:transactions,invoice,' . $transaction->id,
            'customer_id' => 'required|exists:customers,id',
            'date' => 'required|date',
            'total' => 'required|numeric',
        ]);

        $transaction->update($request->all());
        return redirect()->route('backend.admin.transactions.index')->with('success','Transaction updated.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('backend.admin.transactions.index')->with('success','Transaction deleted.');
    }
}

