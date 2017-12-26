<nav class="navbar navbar-light bg-header">
    <a class="navbar-brand" href="#">
        <img src="/images/logo.png" width="110" height="30" alt="">
    </a>
    <div class="flex-center position-ref full-height">

        @if (Auth::check())
            <p>El usuario está correctamente autenticado</p>
            <a href="{{ route('login') }}">Cerrar Sesion</a>


        @else
            <p>El usuario no esta autenticado</p>
            @endif

    </div>
</nav>