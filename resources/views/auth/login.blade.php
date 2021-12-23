@extends('layouts.auth.app')
@section('title','Iniciar sesión')
@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <input type="text"
                   class="form-control"
                   name="email"
                   placeholder="Correo"
                   value="{{ old('email') }}"
                   required autofocus>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
        </div>
        <button class="btn btn-primary btn-block">Ingresar</button>
    </form>
@endsection
