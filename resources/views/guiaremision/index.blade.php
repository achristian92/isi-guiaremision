@extends('layouts.app')
@section('content')
    @include('components.header-body',['title' => 'Guía de Remisión'])
    @component('components.list')
        @slot('actions')
            @include('components.btn-create',['route' =>  route('guiaremision.create') ])
        @endslot
        @slot('table')
            <table class="table table-striped mb-0">
                <thead>
                <tr>
                    <th>DOC. REF.</th>
                    <th>Fecha Entrega</th>
                    <th>Cliente</th>
                    <th>Transporte</th>
                    <th>#Productos</th>
                    <th>Sunat</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @each('guiaremision.partials.row', $guias,'guia', 'components.row-empty')
                </tbody>
            </table>
        @endslot
    @endcomponent
@endsection
