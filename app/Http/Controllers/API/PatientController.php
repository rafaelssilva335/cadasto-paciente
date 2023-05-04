<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Requests\StorePatientRequest;
use App\Models\Address;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::with('address')->get();

        return response()->json($patients);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePatientRequest $request)
    {
        $validatedPatientData = $request->validated();

        // Validação dos dados do endereço
        $validatedAddressData = $request->validate([
            'address.cep' => 'required|string|max:8',
            'address.logradouro' => 'required|string|max:255',
            'address.complemento' => 'nullable|string|max:255',
            'address.bairro' => 'required|string|max:255',
            'address.cidade' => 'required|string|max:255',
            'address.uf' => 'required|string|max:2',
        ]);

        // Criação do paciente
        $patient = new Patient;
        $patient->fill($validatedPatientData);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->store('public/photos');
            $patient->photo = $photo;
        }

        // Criação do endereço e associação ao paciente
        $address = new Address;
        $address->fill($validatedAddressData['address']);
        $address->save();
        
        $patient->address_id = $address->id;
        $patient->save();

        return response()->json($patient, 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        return response()->json($patient);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        $validatedData = $request->validated();

        $patient->update($validatedData);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->store('public/photos');
            $patient->photo = $photo;
            $patient->save();
        }

        return response()->json($patient, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();

        return response()->json(['message' => 'Patient deleted successfully']);
    }
}
