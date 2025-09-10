<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Support\Facades\Storage;
class AdminProductController extends Controller
{

    public function index(){

        $products = Product::paginate(10);
        return view ('backend.admin.products.index', compact('products'));
    }
    public function create()
    {
        $suppliers = Supplier::all();
        return view('backend.admin.products.create',compact('suppliers'));
    }



  public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'category' => 'required|in:mekanis,elektrikal,piping,aksesoris,umum',
        'supplier_id' => 'nullable|exists:suppliers,id',
        'stock' => 'required|integer',
        'satuan' => 'required|string|max:50',
        'deskripsi' => 'nullable|string',
        'lokasi_penyimpanan' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    $data = $request->only([
        'name', 'category', 'supplier_id', 'stock', 'satuan', 
        'deskripsi', 'lokasi_penyimpanan'
    ]);

    // Upload gambar
    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('products', 'public');
    }

    Product::create($data);

    return redirect()->route('backend.admin.products.index')
                     ->with('success', 'Product created successfully.');
}


    public function edit(Product $product)
    {
        $suppliers = Supplier::all();
        return view('backend.admin.products.edit', compact('product','suppliers'));
    }
public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'category' => 'required|in:mekanis,elektrikal,piping,aksesoris,umum',
        'supplier_id' => 'nullable|exists:suppliers,id',
        'stock' => 'required|integer',
        'satuan' => 'required|string|max:50',
        'deskripsi' => 'nullable|string',
        'lokasi_penyimpanan' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    $data = $request->only([
        'name', 'category', 'supplier_id', 'stock', 'satuan', 
        'deskripsi', 'lokasi_penyimpanan'
    ]);

    if ($request->hasFile('image')) {
        if ($product->image && \Storage::disk('public')->exists($product->image)) {
            \Storage::disk('public')->delete($product->image);
        }
        $data['image'] = $request->file('image')->store('products', 'public');
    }

    $product->update($data);

    return redirect()->route('backend.admin.products.index')
                     ->with('success', 'Product updated successfully.');
}

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('backend.admin.products.index')->with('success', 'product deleted successfully.');
    }


}

