<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OperatorProductController extends Controller
{
    // Daftar produk milik operator
    public function index()
    {
        $products = Product::where('supplier_id', Auth::id())->paginate(5);
        return view('backend.operator.products.index', compact('products'));
    }

    // Form tambah produk baru
    public function create()
    {
        $products = Product::paginate(10);
        return view('backend.operator.products.create', compact('products'));
    }

    // Simpan produk baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:mekanis,elektrikal,piping,aksesoris,umum',
            'stock' => 'required|integer|min:0',
            'satuan' => 'required|string|max:50',
            'deskripsi' => 'nullable|string',
            'lokasi_penyimpanan' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $data = $request->only(['name', 'category', 'stock', 'satuan', 'deskripsi', 'lokasi_penyimpanan']);
        $data['supplier_id'] = Auth::id(); 
        $data['status'] = 'panding';

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('backend.operator.products.index')
                         ->with('success', 'Product created and panding approval.');
    }

    // Form edit produk
    public function edit(Product $product)
    {
        if ($product->supplier_id != Auth::id()) {
            abort(403);
        }
        return view('backend.operator.products.edit', compact('product'));
    }

    // Update produk
    public function update(Request $request, Product $product)
    {
        if ($product->supplier_id != Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:mekanis,elektrikal,piping,aksesoris,umum',
            'stock' => 'required|integer|min:0',
            'satuan' => 'required|string|max:50',
            'deskripsi' => 'nullable|string',
            'lokasi_penyimpanan' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $data = $request->only(['name', 'category', 'stock', 'satuan', 'deskripsi', 'lokasi_penyimpanan']);

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('backend.operator.products.index')
                         ->with('success', 'Product updated successfully.');
    }

    // Hapus produk
    public function destroy(Product $product)
    {
        if ($product->supplier_id != Auth::id()) {
            abort(403);
        }

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('backend.operator.products.index')
                         ->with('success', 'Product deleted successfully.');
    }
}













