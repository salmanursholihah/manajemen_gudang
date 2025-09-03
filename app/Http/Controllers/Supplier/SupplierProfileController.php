<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupplierProfileController extends Controller
{
      public function edit() {
        $supplier = auth()->user();
        return view('backend.supplier.profile.edit', compact('supplier'));
    }

    public function update(Request $request) {
        $supplier = auth()->user();
        $supplier->update($request->all());
        return redirect()->route('backend.supplier.profile.edit')->with('success','Profile updated');
    }
}
