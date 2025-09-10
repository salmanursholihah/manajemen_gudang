<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Customer;
class ManagerTransactionController extends Controller
{
    //     public function index() {
    //     $transactions = Transaction::paginate(5);
    //     return view('backend.manager.transactions.index', compact('transactions'));
    // }

    // public function approve(Transaction $transaction) {
    //     $transaction->update(['status' => 'approved']);
    //     return redirect()->route('backend.manager.transactions.index')->with('success','Transaction approved');
    // }
    //    public function edit(Transaction $transaction)
    // {
    //     $customers = Customer::all();
    //     return view('backend.manager.transactions.edit', compact('transaction','customers'));
    // }

    // public function update(Request $request, Transaction $transaction)
    // {
    //     $request->validate([
    //         'invoice' => 'required|string|unique:transactions,invoice,' . $transaction->id,
    //         'customer_id' => 'required|exists:customers,id',
    //         'date' => 'required|date',
    //         'total' => 'required|numeric',
    //     ]);

    //     $transaction->update($request->all());
    //     return redirect()->route('backend.manager.transactions.index')->with('success','Transaction updated.');
    // }
    public function index()
      {
        $transactions = Transaction::with(['customer','supplier'])->paginate(5);
        return view('backend.manager.transactions.index', compact('transactions'));
    }

    public function approve($id)
    {
        $t = Transaction::findOrFail($id);
        $t->status = 'approved';
        $t->save();
        return back()->with('success','Transaction approved');
    }

    public function reject($id)
    {
        $t = Transaction::findOrFail($id);
        $t->status = 'rejected';
        $t->save();
        return back()->with('error','Transaction rejected');
    }

}
