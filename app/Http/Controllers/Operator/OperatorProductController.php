<?php 
namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Product;

class OperatorProductController extends Controller
{
    public function index()
    {
        $products = Product::where('status', Product::STATUS_APPROVED)
            ->with('supplier')
            ->get();

        return view('backend.operator.products.index', compact('products'));
    }
}
