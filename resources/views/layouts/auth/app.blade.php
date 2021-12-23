<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BSW suite - Brainbox</title>

    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}"/>
    <link rel="stylesheet" href="{{ asset('css/bundle.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/app.css')  }}" type="text/css">
</head>
<body class="form-membership">

<!-- begin::preloader-->
<div class="preloader">
    <div class="preloader-icon"></div>
</div>
<!-- end::preloader -->

<div class="form-wrapper">
    <div id="logo">
        <img class="logo" src="{{asset('img/logo_isi (2).png')}}" alt="image">
    </div>
    <h5>@yield('title')</h5>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul style="color: red;">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @yield('content')

</div>

<!-- Plugin scripts -->
<script src="{{ asset('js/bundle.js') }}"></script>
<script src="{{ asset('js/customer.js') }}"></script>
<script src="{{asset('js/app.js')}}"></script>

</body>
</html>
