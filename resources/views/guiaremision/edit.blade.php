@extends('layouts.admin.app')
@section('content')
    @include('components.header-body',[
        'title' => 'Marcas',
        'tab' => 'Inventario',
    ])
    @component('components.form')
        @slot('title','Editar marca')
        @slot('content')
            @include('components.errors-and-messages')
            <form method="POST" action="{{route('inventory.brands.update',$model->id)}}">
                @method('PUT')
                @include('inventories.brands.partials.fields',[
                'back'=> route('inventory.brands.index')
                ])
            </form>
        @endslot
    @endcomponent
@endsection
