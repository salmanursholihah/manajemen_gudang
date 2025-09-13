<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with('supplier')->get();
        return view('backend.admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('backend.admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'category'  => 'required',
            'image'     => 'nullable|image',
            'supplier_id' => 'required|exists:suppliers,id'
        ]);

        $data = $request->only(['name', 'category', 'supplier_id']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }
        $data['status'] = Product::STATUS_APPROVED; // Admin langsung approved

        Product::create($data);

        return redirect()->route('backend.admin.products.index')->with('success', 'Product created');
    }

    public function edit(Product $product)
    {
        return view('backend.admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'     => 'required',
            'category' => 'required',
            'image'    => 'nullable|image'
        ]);

        $data = $request->only(['name', 'category']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('backend.admin.products.index')->with('success', 'Product updated');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Product deleted');
    }
}
