<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">
        <a class="navbar-brand">
            <img src="{{ asset('imagenes/logo.png') }}" width="50" height="50" class="d-inline-block align-text-top">
        </a>
        <span class="navbar-brand">BIOGUARDIAN</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('apodIndex','ini2') ? 'font-weight-bold' : '' }}" href="{{ route('apodIndex') }}">
                        Educación Ambiental
                    </a>
                </li>
            </ul>
            
            <ul class="d-flex navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('login') ? 'font-weight-bold' : '' }}" aria-current="page" href="{{ route('login') }}">Iniciar Sesion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('register') ? 'font-weight-bold' : '' }}" aria-current="page" href="{{ route('register') }}">Registrarse</a>
                </li>
            </ul>
        </div>
    </div>
</nav>