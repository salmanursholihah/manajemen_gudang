<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Supplier;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with('supplier')->get();
        return view('backend.admin.products.index', compact('products'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        return view('backend.admin.products.create', compact('suppliers'));
    }

   public function store(Request $request)
{
    $request->validate([
        'name'              => 'required|string',
        'category'          => 'required|string',
        'supplier_id'       => 'required|exists:suppliers,id',
        'stock'             => 'required|string',
        'satuan'            => 'required|string',
        'quantity'          => 'required|integer|min:0',
        'deskripsi'         => 'nullable|string',
        'lokasi_penyimpanan'=> 'required|string',
        'price'             => 'required|numeric|min:0',
        'image'             => 'nullable|image',
    ]);

    $data = $request->only([
        'name',
        'category',
        'supplier_id',
        'stock',
        'satuan',
        'quantity',
        'deskripsi',
        'lokasi_penyimpanan',
        'price'
    ]);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('products', 'public');
    }

    $data['status'] = 'approved'; // langsung approved

    Product::create($data);

    return redirect()->route('backend.admin.products.index')->with('success', 'Product created');
}


    public function edit(Product $product)
    {
        $suppliers = Supplier::all();
        return view('backend.admin.products.edit', compact('product','suppliers'));
    }

    public function update(Request $request, Product $product)
    {
      $request->validate([
        'name'              => 'required|string',
        'category'          => 'required|string',
        'supplier_id'       => 'required|exists:suppliers,id',
        'stock'             => 'required|string',
        'satuan'            => 'required|string',
        'quantity'          => 'required|integer|min:0',
        'deskripsi'         => 'nullable|string',
        'lokasi_penyimpanan'=> 'required|string',
        'price'             => 'required|numeric|min:0',
        'image'             => 'nullable|image',
    ]);

    $data = $request->only([
        'name',
        'category',
        'supplier_id',
        'stock',
        'satuan',
        'quantity',
        'deskripsi',
        'lokasi_penyimpanan',
        'price'
    ]);

    if($request->hasFile('image')){
        $data['image'] = $request->file('image')->store('products','public');
    }

        $product->update($data);

        return redirect()->route('backend.admin.products.index')->with('success', 'Product updated');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Product deleted');
    }

    protected function validateProduct(Request $request)
{
    return $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
    ]);
}

}
