<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class SupplierProductController extends Controller
{
       public function index() {
        $products = Product::where('supplier_id', auth()->id())->get();
        return view('backend.supplier.products.index', compact('products'));
    }

    public function requestRestock(Request $request, Product $product) {
        // logika ajukan restock ke admin
        $product->update(['restock_requested' => true]);
        return redirect()->route('backend.supplier.products.index')->with('success','Restock request sent');
    }
}
