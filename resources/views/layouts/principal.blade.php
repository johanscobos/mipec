<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Styles -->

    <link href="{{asset('/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('/css/layout.css')}}" rel="stylesheet">
    <script src="https://use.fontawesome.com/a0b9ff5544.js"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin - @yield('title')</title>

</head>
<body>
@include('layouts.partials.header')
<div class="container-flex cont">
        <div class="sidebar">
                @include('layouts.partials.sidebar-menu')
        </div>
        <div class="contenido">
            @yield('content')
        </div>

</div>

@include('layouts.partials.footer')



<!-- Scripts -->
<script src="{{ asset('js/jquery-3.2.1.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/crud.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function()
{
    $("#exampleModal").modal("show");
   
});
</script>
@yield('scripts')
</body>
</html>


