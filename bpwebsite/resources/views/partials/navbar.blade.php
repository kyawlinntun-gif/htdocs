<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/home') }}">{{ config('APP_NAME', 'BPWebsite') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ Request::is('home') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/home') }}">Home</a>
                </li>
                <li class="nav-item {{ Request::is('about_us') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/about_us') }}">About Us</a>
                </li>
            </ul>
        </div>
    </div>
</nav>