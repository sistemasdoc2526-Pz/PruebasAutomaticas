@extends('layouts.app')
@section('titulo', 'Categorías')

@section('contenido')
    <h1>Gestión de Categorías</h1>

    <form method="POST" action="{{ route('categorias.store') }}">
        @csrf
        <input type="text" name="nombre" placeholder="Nombre" value="{{ old('nombre') }}">
        <input type="text" name="descripcion" placeholder="Descripción" value="{{ old('descripcion') }}">
        <button type="submit">Guardar</button>
    </form>

    <h2>Listado</h2>
    @forelse ($categorias as $cat)
        <div>
            {{ $cat->nombre }} - {{ $cat->descripcion }}
        </div>
    @empty
        <p>No hay categorías registradas.</p>
    @endforelse
@endsection