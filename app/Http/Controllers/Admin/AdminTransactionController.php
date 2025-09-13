<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Product;

class AdminTransactionController extends Controller
{
  public function index()
{
    $products = Product::with('supplier')->latest()->get();
    $suppliers = Supplier::all();
    $customers = Customer::all();

    $transactions = Transaction::with(['customer','supplier','items.product'])
                               ->orderBy('date','desc')
                               ->paginate(10);

    return view('backend.admin.transactions.index', compact(
        'transactions',
        'products',
        'suppliers',
        'customers'
    ));
}

    public function create()
    {
        $products = Product::with('supplier')->latest()->get();
        $customers = Customer::all();
        $suppliers = Supplier::all();

        return view('backend.admin.transactions.create', compact('customers','suppliers','products'));
    }
public function store(Request $request)
{
    $request->validate([
        'invoice'     => 'required|string|unique:transactions',
        'customer_id' => 'nullable|exists:customers,id',
        'supplier_id' => 'nullable|exists:suppliers,id',
        'type'        => 'required|in:pembelian,pembayaran,mutation',
        'total'       => 'required|numeric',
        'date'        => 'required|date',
        'status'      => 'required|in:draft,pending,approved,rejected',
        'document'    => 'nullable|file|mimes:pdf,jpg,png,doc,docx|max:2048',
    ]);

    // Upload dokumen
    $documentPath = null;
    if ($request->hasFile('document')) {
        $documentPath = $request->file('document')->store('documents', 'public');
    }

    Transaction::create([
        'invoice'     => $request->invoice,
        'customer_id' => $request->customer_id,
        'supplier_id' => $request->supplier_id,
        'type'        => $request->type,
        'total'       => $request->total,
        'date'        => $request->date,
        'status'      => $request->status,   // ✅ ikut disimpan
        'document'    => $documentPath,
        'user_id'     => auth()->id(),       // ✅ user login
    ]);

    return redirect()->route('backend.admin.transactions.index')
                     ->with('success', 'Transaksi berhasil disimpan.');
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
        'invoice'     => 'required|string|unique:transactions,invoice,' . $transaction->id,
        'customer_id' => 'nullable|exists:customers,id',
        'supplier_id' => 'nullable|exists:suppliers,id',
        'type'        => 'required|in:inbound,outbound,mutation',
        'total'       => 'required|numeric',
        'date'        => 'required|date',
        'status'      => 'required|in:draft,pending,approved,rejected',
        'document'    => 'nullable|file|mimes:pdf,jpg,png,doc,docx|max:2048',
    ]);

    $data = $request->only('invoice','customer_id','supplier_id','type','total','date','status');

    if ($request->hasFile('document')) {
        $data['document'] = $request->file('document')->store('documents', 'public');
    }

    $transaction->update($data);

    return redirect()->route('backend.admin.transactions.index')
                     ->with('success', 'Transaksi berhasil diperbarui.');
}


    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('backend.admin.transactions.index')
                         ->with('success','Transaction deleted.');
    }


// menampilkan halaman compare
    public function compare($id)
    {
        $transaction = Transaction::findOrFail($id);

        // data operator
        $operatorData = [
            'total'    => $transaction->total_operator ?? '-',
            'document' => $transaction->document_operator ?? 'Tidak ada',
        ];

        // data supplier
        $supplierData = [
            'total'    => $transaction->total_supplier ?? '-',
            'document' => $transaction->document_supplier ?? 'Tidak ada',
        ];

        return view('backend.admin.transactions.compare', compact('transaction', 'operatorData', 'supplierData'));
    }

    // contoh approve transaksi
    public function approve($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->status = 'approved';
        $transaction->save();

        return redirect()->route('backend.admin.transactions.index')->with('success', 'Transaksi berhasil di-approve!');
    }    
}
