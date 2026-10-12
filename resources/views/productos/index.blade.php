@extends('layouts.app')
@section('titulo', 'Productos')

@section('contenido')
    <h1>Gestión de Productos</h1>

    @if (session('ok'))
        <p style="color:green">{{ session('ok') }}</p>
    @endif

    @if ($errors->any())
        <ul style="color:red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('productos.store') }}">
        @csrf
        <input type="text" name="nombre" placeholder="Nombre" value="{{ old('nombre') }}">
        <input type="number" step="0.01" name="precio" placeholder="Precio" value="{{ old('precio') }}">
        <input type="number" name="stock" placeholder="Stock" value="{{ old('stock') }}">
        <button type="submit">Guardar</button>
    </form>

    <h2>Listado</h2>
    @forelse ($productos as $p)
        <div>
            {{ $p->nombre }} - {{ $p->precio }} Bs - Stock: {{ $p->stock }}
            <form method="POST" action="{{ route('productos.destroy', $p) }}" style="display:inline">
                @csrf @method('DELETE')
                <button type="submit">Eliminar</button>
            </form>
        </div>
    @empty
        <p>No hay productos registrados.</p>
    @endforelse
@endsection