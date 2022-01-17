<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Formulario de prueba</h1>
    @if ($errors->any())
        {{-- <ul>
            @foreach ($errors->all() as $error){
                <li>{{ $error }}</li>
            @endforeach
        </ul> --}}
    
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

<form method="POST" action="{{ url('usuarios') }}">
{{-- ASIGNA UN TOKEN --}}
{{-- {{ csrf_field() }}   --}}
<div class="form-group">
<label for="name">Nombre:</label>
<input type="text" class="form-control" name="name" id="name" placeholder="Pedro Perez" value="{{old ('name')}}">
</div>

<div class="form-group">
<label for="email">Correo electrónico:</label>
<input type="email" class="form-control" name="email" id="email" placeholder="pedro@example.com" value="{{old ('email')}}">
</div>

<div class="form-group">
<label for="password">Contraseña:</label>
<input type="password" class="form-control" name="password" id="password" placeholder="Mayor a 6 caracteres">
</div>

<button type="submit" class="btn btn-primary">Crear usuario</button>
</form>
</body>
</html>