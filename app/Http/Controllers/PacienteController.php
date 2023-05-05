<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PacienteController extends Controller
{
    public function index()
    {
        return Inertia::render('Pacientes/Pacientes', [
            'baseUrl' => url('/')
        ]);
    }
    public function create()
    {
        return Inertia::render('Pacientes/Home', [
            'baseUrl' => url('/')
        ]);
    }
    public function edit(Patient $patient)
    {
        return Inertia::render('Pacientes/Edit', [
            'baseUrl' => url('/'),
            'patient' => 
                $patient->toArray(),
            'patient.address' => $patient->address
        ]);
    }
}
