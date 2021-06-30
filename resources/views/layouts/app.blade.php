<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        <link type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <script>
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>

        @section('style')
        @show

        @section('js')
        @show
    </head>

    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('img/logo.png') }}" alt="{{ trans('home.logo') }}" width="150" height="40">
                    </a>

                    <div id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
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
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <img height="30px" width="30px" src="{{ asset('storage/avatars/'.Auth::user()->avatar ) }}" class="rounded-circle" alt="{{ Auth::user()->avatar }}"> {{ Auth::user()->name }} <span class="caret"> </span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                        <a class="dropdown-item" href="{{ route('auth/change_password') }}">  {{ trans('auth.change_password') }}</a>

                                        <a class="dropdown-item" href="{{ route('auth/change_avatar') }}">  {{ trans('auth.change_avatar') }}</a>

                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="py-4">
                @if ($errors->any())
                    <div class="alert alert-danger ml-5 mr-5">
                        <p> <strong> {{ trans('forms.failed_transaction') }} </strong> </p>

                        <ul>
                            @foreach ($errors->all() as $error)
                                <li> {{ $error }} </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </body>


    <footer class="bg-white pt-2 text-center" style="bottom: 0; position: fixed; width: 100%;">
        <div class="float-right mr-3">

            <span data-toggle="tooltip" data-placement="top" title="Web">
                <a style="color: black; text-decoration: none" class="mr-1" href="https://4evergaming.com.ar"> 
                    <i class="fas fa-globe"></i> 
                </a> 
            </span>

            <span data-toggle="tooltip" data-placement="top" title="Facebook">
                <a style="color: black; text-decoration: none" class="mr-1" href="https://facebook.com/4evergaming.com.ar"> 
                    <i class="fab fa-facebook"></i> 
                </a>
            </span>

            <span data-toggle="tooltip" data-placement="top" title="Instagram">
                <a style="color: black; text-decoration: none" class="mr-1" href="https://instagram.com/4evergaming.com.ar"> 
                    <i class="fab fa-instagram"></i> 
                </a>
            </span>
            
            <span data-toggle="tooltip" data-placement="top" title="YouTube">
                <a style="color: black; text-decoration: none" class="mr-1" href="https://www.youtube.com/channel/UCOGkRP2uNamUAsWnYUPd2xg"> 
                    <i class="fab fa-youtube"></i> 
                </a>
            </span>

            <span data-toggle="tooltip" data-placement="top" title="WhatsApp">
                <a style="color: black; text-decoration: none" class="mr-1" href="http://wa.me/5491124002295"> 
                    <i class="fab fa-whatsapp"></i> 
                </a>
            </span>

        </div>

        <p>
            &copy; @php echo date('Y') @endphp <a style="color: black" href="https://4evergaming.com.ar">4evergaming</a>. Todos los derechos reservados
        </p>
       
    </footer>
 

    
</html>
