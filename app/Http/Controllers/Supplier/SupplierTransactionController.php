<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Customer;
use App\Models\Product;

class SupplierTransactionController extends Controller
{
    /**
     * Tampilkan semua transaksi milik supplier yang login
     */
public function index()
{
    $supplier = Auth::user()->supplier;

    if (!$supplier) {
        // Redirect ke halaman edit profil supplier
        return redirect()->route('profile.edit', Auth::id())
            ->withErrors('Silakan lengkapi data supplier Anda terlebih dahulu.');
    }

    $transactions = Transaction::where('supplier_id', $supplier->id)
        ->with(['customer', 'items.product'])
        ->orderBy('date', 'desc')
        ->paginate(10);

    return view('backend.supplier.transactions.index', compact('transactions'));
}



    
    /**
     * Form tambah transaksi
     */
    public function create()
    {
        $supplier = Auth::user()->supplier;

        if (!$supplier) {
            return redirect()->route('dashboard')
                ->withErrors('Anda bukan supplier, tidak bisa membuat transaksi.');
        }

        $customers = Customer::all();
        $products  = Product::all();

        return view('backend.supplier.transactions.create', compact('customers', 'products'));
    }

    /**
     * Simpan transaksi baru (oleh supplier)
     */
    public function store(Request $request)
    {
        $supplier = Auth::user()->supplier;
        if (!$supplier) {
            return redirect()->route('dashboard')
                ->withErrors('Supplier tidak terdeteksi untuk user ini.');
        }

        $request->validate([
            'invoice' => 'required|string',
            'customer_id' => 'required|exists:customers,id',
            'type' => 'required|in:pembelian,pembayaran',
            'date' => 'required|date',
            'products' => 'required|array',
            'products.*' => 'required|exists:products,id',
            'quantities' => 'required|array',
            'quantities.*' => 'required|integer|min:1',
            'document_supplier' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // ✅ Hitung total supplier
        $totalSupplier = 0;
        foreach ($request->products as $index => $productId) {
            $product  = Product::findOrFail($productId);
            $quantity = $request->quantities[$index];
            $totalSupplier += $product->price * $quantity;
        }

        // ✅ Upload dokumen
        $docSupplier = null;
        if ($request->hasFile('document_supplier')) {
            $docSupplier = $request->file('document_supplier')->store('documents', 'public');
        }

        // ✅ Simpan transaksi
        $transaction = Transaction::create([
            'invoice'           => $request->invoice,
            'customer_id'       => $request->customer_id,
            'supplier_id'       => $supplier->id,   // 🔑 otomatis dari user
            'type'              => $request->type,
            'date'              => $request->date,
            'status'            => 'pending',
            'user_id'           => Auth::id(),

            'total_supplier'    => $totalSupplier,
            'document_supplier' => $docSupplier,

            'total_operator'    => null,
            'document_operator' => null,
        ]);

        // ✅ Simpan item transaksi
        foreach ($request->products as $index => $productId) {
            $product  = Product::findOrFail($productId);
            $quantity = $request->quantities[$index];

            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'product_id'     => $product->id,
                'quantity'       => $quantity,
                'price'          => $product->price,
            ]);

            // update stok sesuai type
            if ($request->type === 'pembelian') {
                $product->increment('stock', $quantity);
            } else {
                $product->decrement('stock', $quantity);
            }
        }

        return redirect()->route('backend.supplier.transactions.index')
            ->with('success', 'Transaksi supplier berhasil dibuat.');
    }
}
