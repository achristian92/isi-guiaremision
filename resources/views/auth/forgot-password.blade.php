@extends('layouts.auth.app')
@section('title','Reiniciar contraseña')
@section('content')
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group">
            <input type="text"
                   name="email"
                   class="form-control"
                   placeholder="Correo"
                   required autofocus>
        </div>
        <button class="btn btn-primary btn-block" type="submit">Reiniciar</button>
        <hr>
        <p class="text-muted">Tomar una acción diferente.</p>
        <a href="{{ route('register') }}" class="btn btn-sm btn-outline-light mr-1">Regístrate ahora!</a>
        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light ml-1">Ingresar!</a>
    </form>
@endsection
