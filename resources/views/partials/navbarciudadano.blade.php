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
                    <a class="nav-link {{ request()->routeIs('ciudadano','ciu2') ? 'font-weight-bold' : '' }}" href="{{ route('ciudadano') }}">
                        Educación Ambiental
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('noticiasciu') ? 'font-weight-bold' : '' }}" href="{{ route('noticiasciu') }}">
                        Noticias
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('mapaciu') ? 'font-weight-bold' : '' }}" href="{{ route('mapaciu') }}">
                        Mapa
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('avistamientos','aciu2') ? 'font-weight-bold' : '' }}" href="{{ route('aciu2') }}">
                        Avistamientos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('registroavisciu') ? 'font-weight-bold' : '' }}" href="{{ route('registroavisciu') }}">
                        Registro de avistamientos
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} - {{ Auth::user()->role }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Cerrar Sesión') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                            <a class="dropdown-item" href="/profile">Perfil</a>
                            
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

