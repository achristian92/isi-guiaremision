@extends('layouts.app')
@section('content')
    @include('components.header-body',['title' => 'Guía de Remisión'])
    @component('components.form')
        @slot('title','Nueva Guía - Cabecera')
        @slot('content')
            @include('components.errors-and-messages')
            <form method="POST" action="{{route('guiaremision.store')}}">
                @include('guiaremision.partials.fields',[
                'back'=> route('guiaremision.index')
                ])
            </form>
        @endslot
    @endcomponent
@endsection
