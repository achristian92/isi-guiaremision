@extends('layouts.auth.app')
@section('title','Crear cuenta')
@section('content')
    <form method="POST" action={{ url('/register') }}>
        @csrf
        <div class="form-group">
            <input type="text"
                   class="form-control"
                   name="company"
                   placeholder="Empresa"
                   value="{{ old('company') }}"
                   required autofocus>
        </div>
        <div class="form-group">
            <input type="text"
                   class="form-control"
                   name="name"
                   placeholder="Nombre"
                   value="{{ old('name') }}"
                   required>
        </div>
        <div class="form-group">
            <input type="email"
                   class="form-control"
                   name="email"
                   placeholder="Correo"
                   value="{{ old('email') }}"
                   required>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
        </div>
        <button class="btn btn-primary btn-block" type="submit">Registrar</button>
        <hr>
        <p class="text-muted">Ya tienes cuenta?</p>
        <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Ingresar!</a>
    </form>
@endsection
