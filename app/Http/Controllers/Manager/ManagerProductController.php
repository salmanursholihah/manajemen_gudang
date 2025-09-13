<?php 
namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ManagerProductController extends Controller
{
    public function index()
    {
        $products = Product::with('supplier')->get();
        return view('backend.manager.products.index', compact('products'));
    }

    public function approve(Product $product)
    {
        $product->update(['status' => Product::STATUS_APPROVED]);
        return back()->with('success', 'Product approved');
    }

    public function reject(Product $product)
    {
        $product->update(['status' => Product::STATUS_REJECTED]);
        return back()->with('error', 'Product rejected');
    }
}
?>