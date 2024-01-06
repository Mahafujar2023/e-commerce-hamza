<?php

namespace App\Http\Controllers\Backend;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        return view('backend.pages.customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // Validate the incoming request data
        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'nullable|string',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'nullable|string',
            'country' => 'nullable|string',
            'region' => 'nullable|string',
            'city' => 'nullable|string',
            'notes' => 'nullable|string',
        ], [
            'email.unique' => 'The email has already registered to this store.',
        ]);

        // Create the customer
        $customer = Customer::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'country' => $validatedData['country'],
            'region' => $validatedData['region'],
            'city' => $validatedData['city'],
            'notes' => $validatedData['notes'],
        ]);

        $addressData = $request->all();

        foreach ($addressData['additional_first_name'] as $key => $additionalFirstName) {
            Address::create([
                'customer_id' => $customer->id,
                'additional_first_name' => $additionalFirstName,
                'additional_last_name' => $addressData['additional_last_name'][$key],
                'additional_company_name' => $addressData['additional_company_name'][$key],
                'additional_phone' => $addressData['additional_phone'][$key],
                'additional_address_line_1' => $addressData['additional_address_line_1'][$key],
                'additional_address_line_2' => $addressData['additional_address_line_2'][$key],
                'additional_city' => $addressData['additional_city'][$key],
                'additional_region' => $addressData['additional_region'][$key],
                'additional_country' => $addressData['additional_country'][$key],
                'additional_zip_code' => $addressData['additional_zip_code'][$key],
            ]);
        }

        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('backend.pages.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $customerId)
    {
        // Retrieve the customer
        $customer = Customer::findOrFail($customerId);


        $validatedData1 = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'nullable|string',
            'email' => 'required|email|unique:customers,email,' . $customerId,
            'phone' => 'nullable|string',
            'country' => 'nullable|string',
            'region' => 'nullable|string',
            'city' => 'nullable|string',
            'notes' => 'nullable|string',

        ]);

        // Update the customer
        $customer->update($validatedData1);

        $validatedData = $request->validate([

            // Validation rules for the address fields
            'additional_first_name.*' => 'required|string',
            'additional_last_name.*' => 'nullable|string',
            'additional_company_name.*' => 'nullable|string',
            'additional_phone.*' => 'nullable|string',
            'additional_address_line_1.*' => 'nullable|string',
            'additional_address_line_2.*' => 'nullable|string',
            'additional_country.*' => 'nullable|string',
            'additional_region.*' => 'nullable|string',
            'additional_city.*' => 'nullable|string',
            'additional_zip_code.*' => 'nullable|string',
        ]);
        // Update or create addresses
        foreach ($validatedData['additional_first_name'] as $key => $additionalFirstName) {
            $addressId = $request->input('address_id.' . $key);

            $addressData = [
                'additional_first_name' => $validatedData['additional_first_name'][$key],
                'additional_last_name' => $validatedData['additional_last_name'][$key],
                'additional_company_name' => $validatedData['additional_company_name'][$key],
                'additional_phone' => $validatedData['additional_phone'][$key],
                'additional_address_line_1' => $validatedData['additional_address_line_1'][$key],
                'additional_address_line_2' => $validatedData['additional_address_line_2'][$key],
                'additional_country' => $validatedData['additional_country'][$key],
                'additional_region' => $validatedData['additional_region'][$key],
                'additional_city' => $validatedData['additional_city'][$key],
                'additional_zip_code' => $validatedData['additional_zip_code'][$key],
            ];
            

            if ($addressId) {
                // If address ID exists, update the existing address
                $address = Address::findOrFail($addressId);
                $address->update($addressData);
            } else {
                // If no address ID exists, create a new address
                $customer->addresses()->create($addressData);
            }
        }


        return redirect()->route('customers.index')->with('message', 'Customer uodated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        // Redirect or respond accordingly after deleting the customer
        return redirect()->route('customers.index')->with('message', 'Customer deleted successfully');
    }
}
