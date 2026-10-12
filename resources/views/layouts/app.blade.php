<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('titulo')</title>
</head>
<body>
    <nav>
        <a href="{{ route('productos.index') }}">Productos</a> |
        <a href="{{ route('clientes.index') }}">Clientes</a> |
        <a href="{{ route('categorias.index') }}">Categorías</a>
    </nav>
    <hr>

    <!--@if (session('ok'))
        <p style="color:green">{{ session('ok') }}</p>
    @endif

    @if ($errors->any())
        <ul style="color:red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif!-->
    @yield('contenido')
</body>
</html>