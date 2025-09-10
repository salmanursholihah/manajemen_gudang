<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SupplierProductController extends Controller
{
    public function index()
    {
        $products = Product::where('supplier_id', Auth::id())->paginate(5);
        return view('backend.supplier.products.index', compact('products'));
    }

    public function create()
    {
        return view('backend.supplier.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'category'  => 'required|in:mekanis,elektrikal,piping,aksesoris,umum',
            'jumlah'    => 'required|integer|min:0',
            'satuan'    => 'required|string|max:50',
            'deskripsi' => 'nullable|string',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $data = $request->only(['name', 'category', 'satuan', 'deskripsi']);
        $data['stock']       = $request->jumlah; // mapping jumlah -> stock
        $data['supplier_id'] = Auth::id();
        $data['status']      = 'panding'; // ✅ fix typo

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('backend.supplier.products.index')
                         ->with('success', 'Product created and panding approval.');
    }

    public function edit(Product $product)
    {
        if ($product->supplier_id != Auth::id()) {
            abort(403);
        }
        return view('backend.supplier.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        if ($product->supplier_id != Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name'      => 'required|string|max:255',
            'category'  => 'required|in:mekanis,elektrikal,piping,aksesoris,umum',
            'jumlah'    => 'required|integer|min:0',
            'satuan'    => 'required|string|max:50',
            'deskripsi' => 'nullable|string',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $data = $request->only(['name', 'category', 'satuan', 'deskripsi']);
        $data['stock'] = $request->jumlah;

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('backend.supplier.products.index')
                         ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->supplier_id != Auth::id()) {
            abort(403);
        }

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('backend.supplier.products.index')
                         ->with('success', 'Product deleted successfully.');
    }
}
