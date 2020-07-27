<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'InstagramF') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('home') }}">
                    {{ config('app.name', 'InstagramF') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a  class="nav-link" href="{{ route('home') }}">Inicio</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link"  href="{{ route('image.create') }}">Subir imagen</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link"  href="{{ route('like.likes') }}">Favoritas <img class="corazon-navbar" src="{{ asset('img/hearts_red.png')}}"></a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link"  href="{{ route('user.index') }}">Conoce gente</a>
                            </li>
                           
                            <div class="navbar-usuario">
                                <li class="nav-item">
                                    <div class="navbar-avatar"> 
                                        @include('includes.avatar')
                                    </div>
                                </li>
                           
                            
                                <li class="nav-item dropdown">
                                    
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('profile',['id' => \Auth::user()->id]) }}" >
                                            Mi perfil
                                        </a>

                                        <a class="dropdown-item" href="{{route('config')}}" >
                                            Configuracion
                                        </a>

                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>

                                    </div>
                                </li>
                            </div>
                            
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <footer>
        <div class="home_footer">
            <p> Desarrollado por Francisco Miguel Charris Camargo &copy; <?php echo date('Y'); ?></p>
            <div>
                <a target="_blank" href="https://www.facebook.com/profile.php?id=100013541311546">
                    <img src="{{ asset('img/facebook.png') }}">
                </a>
                <a target="_blank" href="https://github.com/franciscocharris">
                    <img src="{{ asset('img/github.png') }}">
                </a>
            </div>
            
        </div>
    </footer> 
    <div class="contenedor_anuncio"></div>
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
<!-- desarrollado por francisco miguel charris camargo -->