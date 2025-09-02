<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;

class AdminSupplierController extends Controller
{
    // Tampilkan daftar supplier
    public function index()
    {
        $suppliers = Supplier::all();
        return view('backend.admin.suppliers.index', compact('suppliers'));
    }

    // Tampilkan form create supplier
    public function create()
    {
        return view('backend.admin.suppliers.create');
    }

    // Simpan supplier baru
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:suppliers',
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $data = $request->all();

        // Upload gambar jika ada
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('suppliers', 'public');
        }

        Supplier::create($data);

        return redirect()->route('backend.admin.suppliers.index')
                         ->with('success', 'Supplier created successfully.');
    }

    // Tampilkan form edit supplier
    public function edit(Supplier $supplier)
    {
        return view('backend.admin.suppliers.edit', compact('supplier'));
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

        return redirect()->route('backend.admin.suppliers.index')
                         ->with('success', 'Supplier updated successfully.');
    }

    // Hapus supplier
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('backend.admin.suppliers.index')
                         ->with('success', 'Supplier deleted successfully.');
    }
}
