@extends('layouts.app')
@section('titulo', 'Clientes')

@section('contenido')
    <h1>Gestión de Clientes</h1>

    <form method="POST" action="{{ route('clientes.store') }}">
        @csrf
        <input type="text" name="nombre" placeholder="Nombre" value="{{ old('nombre') }}">
        <input type="text" name="email" placeholder="Email" value="{{ old('email') }}">
        <input type="text" name="telefono" placeholder="Teléfono" value="{{ old('telefono') }}">
        <button type="submit">Guardar</button>
    </form>

    <h2>Listado</h2>
    @forelse ($clientes as $c)
        <div>
            {{ $c->nombre }} - {{ $c->email }} - Tel: {{ $c->telefono }}
            <form method="POST" action="{{ route('clientes.destroy', $c) }}" style="display:inline">
                @csrf @method('DELETE')
                <button type="submit">Eliminar</button>
            </form>
        </div>
    @empty
        <p>No hay clientes registrados.</p>
    @endforelse
@endsection