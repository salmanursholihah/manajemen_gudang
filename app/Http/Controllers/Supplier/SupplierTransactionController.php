<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
class SupplierTransactionController extends Controller
{
     public function index() {
        $transactions = Transaction::where('supplier_id', auth()->id())->get();
        return view('backend.supplier.transactions.index', compact('transactions'));
    }
}
