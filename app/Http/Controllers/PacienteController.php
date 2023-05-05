<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
class PacienteController extends Controller
{
    public function index()
    {
        return Inertia::render('Pacientes/Pacientes');
    }
    public function create()
    {
        return Inertia::render('Pacientes/Home');
    }
}
