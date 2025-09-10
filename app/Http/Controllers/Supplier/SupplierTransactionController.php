<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Customer;
use App\Models\Supplier;
class SupplierTransactionController extends Controller
{
    //  public function index() {
    //     $transactions = Transaction::where('supplier_id', auth()->id())->get();
    //     return view('backend.supplier.transactions.index', compact('transactions'));
    // }
        public function index()
    {
        $transactions = Transaction::where('supplier_id', auth()->id())->with('customer')->paginate(5);
        return view('backend.supplier.transactions.index', compact('transactions'));
    }

    public function create()
    {
        $customers = Customer::all();
        $suppliers = Supplier::all();
        return view('backend.supplier.transactions.create', compact('customers','suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'invoice' => 'required|string',
            'customer_id' => 'required|exists:customers,id',
            'type' => 'required|in:pembelian,pembayaran',
            'total' => 'required|numeric',
            'date' => 'required|date'
        ]);

        Transaction::create([
            'invoice' => $request->invoice,
            'customer_id' => $request->customer_id,
            'supplier_id' => auth()->id(),
            'type' => $request->type,
            'total' => $request->total,
            'date' => $request->date,
        ]);

        return redirect()->route('backend.supplier.transactions.index')
            ->with('success','Transaction submitted');
    }

}
