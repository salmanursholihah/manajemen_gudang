<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;

class ManagerSupplierController extends Controller
{
       public function index() {
        $suppliers = Supplier::paginate(5);
        return view('backend.manager.suppliers.index', compact('suppliers'));
    }

    public function approve(Supplier $supplier) {
        $supplier->update(['status' => 'approved']);
        return redirect()->route('backend.manager.suppliers.index')->with('success','Supplier approved');
    }
    
    // Tampilkan form edit supplier
    public function edit(Supplier $supplier)
    {
        return view('backend.manager.suppliers.edit', compact('supplier'));
    }

    // Update supplier
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:suppliers,email,' . $supplier->id,
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $data = $request->all();

        // Upload gambar jika ada
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('suppliers', 'public');
        }

        $supplier->update($data);

        return redirect()->route('backend.manager.suppliers.index')
                         ->with('success', 'Supplier updated successfully.');
    }
}
