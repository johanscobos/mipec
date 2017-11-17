<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Styles -->

    <link href="{{asset('/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('/css/layout.css')}}" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin - @yield('title')</title>



</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4" style="border:1px solid #0b2e13">

            @php

            @endphp

            @if(Auth::user()->tipo_user=='0')
            @include('layouts.partials.sidebar-menu-admin')
                @else
                @include('layouts.partials.sidebar-menu-clientes')
            @endif
        </div>
        <div class="col-md-8" style="border:1px solid #0b2e13">
            @yield('content')
        </div>
    </div>
</div>

@include('layouts.partials.footer')


<!-- Scripts -->
<script src="{{ asset('js/jquery-3.2.1.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
</body>
</html>


