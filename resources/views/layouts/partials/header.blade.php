<nav class="navbar navbar-light bg-header">
    <a class="navbar-brand" href="#">
        <img src="/images/logo.png" width="110" height="30" alt="">
    </a>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                        @endauth
            </div>
        @endif
    </div>
</nav>