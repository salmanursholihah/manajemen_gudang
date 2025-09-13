<?php 
namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierTransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('supplier_id', Auth::id())
                                   ->with(['customer','items.product'])
                                   ->orderBy('date','desc')
                                   ->paginate(10);
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
        'invoice' => 'required|string|unique:transactions',
        'customer_id' => 'required|exists:customers,id',
        'total' => 'required|numeric',
        'date' => 'required|date',
        'document_supplier' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
    ]);

    // Simpan dokumen kalau ada
    $documentPath = null;
    if ($request->hasFile('document')) {
        $documentPath = $request->file('document')->store('documents', 'public');
    }

    Transaction::create([
        'invoice'     => $request->invoice,
        'customer_id' => $request->customer_id,
        'supplier_id' => Auth::id(), // supplier login
        'type'        => 'pembelian',  // supplier hanya draft inbound
        'total'       => $request->total,
        'date'        => $request->date,
        'status'      => 'pending',
        'document_supplier'    => $documentPath, // simpan path dokumen
        'user_id'     => Auth::id(),
    ]);

    return redirect()->route('backend.supplier.transactions.index')
                     ->with('success','Draft transaction submitted, waiting for operator validation.');
}
    }    
