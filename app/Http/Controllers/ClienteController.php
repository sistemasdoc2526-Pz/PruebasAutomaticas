<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::latest()->get();
        return view('clientes.index', compact('clientes'));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre'   => 'required|string|max:100',
            'email'    => 'required|email|max:100',   
            'telefono' => 'nullable|string|max:20',
        ]);

        Cliente::create($datos);

        return redirect()->route('clientes.index')
            ->with('ok', 'Cliente creado correctamente');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return redirect()->route('clientes.index')
            ->with('ok', 'Cliente eliminado');
    }
}