<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
class ManagerCustomerController extends Controller
{
        public function index() {
        $customers = Customer::paginate(5);
        return view('backend.manager.customers.index', compact('customers'));
    }

    public function approve(Customer $customer) {
        $customer->update(['status' => 'approved']);
        return redirect()->route('backend.manager.customers.index')->with('success','Customer approved');
    }
   public function edit(Customer $customer)
    {
        return view('backend.manager.customers.edit', compact('customer'));
    }
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $customer->update($request->all());
        return redirect()->route('backend.manager.customers.index')->with('success', 'Customer updated successfully.');
    }
}
