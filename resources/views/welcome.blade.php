<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>InstagramF</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
        <style type="text/css">
            body{
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>
        <div class="home_enlaces_arriba">
            <div>
                @if (Route::has('login'))
                    <div class="top-right links">
                        @auth
                            <a href="{{ url('/home') }}">Home</a>
                        @else
                            <a href="{{ route('login') }}">{{ __('Login') }}</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>

            <div class="contenedor">
                <div class="home">
                    <div class="title ">
                        InstagramF
                        <span> un mini Instagram para pasar el rato</span>
                    </div>

                    <div class=" home_links ">
                        <a href="{{ route('login')}}">Ingresar</a>
                        <a href="{{route('register')}}">Registrate</a>
                    </div>

                </div>
                
            </div>
            <footer>
                <div class="home_footer">
                    <p> Desarrollado por Francisco Miguel Charris Camargo &copy; <?php echo date('Y'); ?></p>
                    <a target="_blank" href="https://www.facebook.com/profile.php?id=100013541311546"><img src="{{ asset('img/facebook.png') }}"></a>
                </div>
            </footer>        
    </body>
</html>
