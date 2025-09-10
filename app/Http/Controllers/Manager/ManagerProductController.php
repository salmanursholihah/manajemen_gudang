<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Support\Facades\Storage;

class ManagerProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(5);
        return view('backend.manager.products.index', compact('products'));
    }

    public function approve($id)
    {
        $p = Product::findOrFail($id);
        $p->status = 'approv';
        $p->save();
        return back()->with('success','Approved by Manager');
    }

    public function reject($id)
    {
        $p = Product::findOrFail($id);
        $p->status = 'reject';
        $p->save();
        return back()->with('error','Rejected by Manager');
    }
    
    public function edit(Product $product)
    {
        $suppliers = Supplier::all();
        return view('backend.manager.products.edit', compact('product','suppliers'));
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
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('backend.manager.products.index')
                         ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        // Hapus image juga kalau ada
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('backend.manager.products.index')
                         ->with('success', 'Product deleted successfully.');
    }
}
