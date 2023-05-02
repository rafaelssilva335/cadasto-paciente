<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Address::all();
        return response()->json($addresses);
    }

    public function show($id)
    {
        $address = Address::findOrFail($id);
        return response()->json($address);
    }

    public function store(StoreAddressRequest $request)
    {
        $validatedData = $request->validated();
        
        $address = new Address;
        $address->fill($validatedData);
        $address->save();

        return response()->json($address, 201);
    }

    public function update(UpdateAddressRequest $request, Address $address)
    {
        $validatedData = $request->validated();

        $address->update($validatedData);
        $address->save();

        return response()->json($address, 200);
    }

    public function destroy($id)
    {
        $address = Address::findOrFail($id);
        $address->delete();

        return response()->json(null, 204);
    }
}
