<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Software BSWsuite - Brainbox</title>

    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}"/>
    <link href="{{asset('css/select2.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/bundle.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/prism.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<div class="preloader">
    <div class="preloader-icon"></div>
</div>

@include('layouts.navbar')

<div id="main">
    <div class="navigation">
        @include('layouts.sidebar-tab')
        @include('layouts.sidebar-body')
    </div>
    <main class="main-content">
        <div id="app">
            @yield('content')
        </div>
    </main>
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/bundle.js') }}"></script>
<script src="{{asset('js/prism.js')}}"></script>
<script src="{{ asset('js/customer.js') }}"></script>
<script src="{{asset('js/select2.min.js')}}"></script>
@stack('js')
</body>
</html>
