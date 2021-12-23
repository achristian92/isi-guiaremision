@extends('layouts.auth.app')
@section('title','Reiniciar contraseña')
@section('content')
    <form method="POST" action={{ route('password.update') }}>
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group">
            <input type="email"
                   class="form-control"
                   name="email"
                   placeholder="Correo"
                   value="{{ old('email') }}"
                   required>
        </div>
        <div class="form-group">
            <input type="password"
                   class="form-control"
                   name="password"
                   placeholder="Password"
                   required>
        </div>
        <div class="form-group">
            <input type="password"
                   class="form-control"
                   name="password_confirmation"
                   placeholder="Confirmar password"
                   required>
        </div>
        <button class="btn btn-primary btn-block" type="submit">Restablecer</button>
        <hr>
        <p class="text-muted">Ya tienes cuenta?</p>
        <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Ingresar!</a>
    </form>
@endsection
