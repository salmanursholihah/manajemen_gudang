<?php
namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierProductController extends Controller
{
    public function index()
    {
        $products = Product::where('supplier_id', Auth::id())->get();
        return view('backend.supplier.products.index', compact('products'));
    }

    public function create()
    {
        return view('backend.supplier.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'category' => 'required',
            'image'    => 'nullable|image',
            'supplier_id ' => Auth()->id()
        ]);

        $data = $request->only(['name', 'category']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $data['supplier_id'] = Auth::id();
        $data['status'] = Product::STATUS_PENDING;

        Product::create($data);

        return redirect()->route('backend.supplier.products.index')->with('success', 'Product submitted for approval');
    }
}
?>