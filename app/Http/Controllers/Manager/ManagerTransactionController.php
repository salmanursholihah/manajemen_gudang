<?php 
namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ManagerTransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['customer','supplier','items.product'])
                                   ->orderBy('date','desc')
                                   ->paginate(10);
        return view('backend.manager.transactions.index', compact('transactions'));
    }

    public function approve($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update(['status' => 'approved']);
        return back()->with('success','Transaction approved');
    }

    public function reject($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update(['status' => 'rejected']);
        return back()->with('error','Transaction rejected');
    }
}
