<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title> @yield('title') | {{ trans('welcome.my_community') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @section('style')
        @show

        @section('js')
        @show
    </head>

    <body class="bg-light">

        <nav class="navbar navbar-expand-md shadow bg-white mt-3 ms-2 me-2 rounded">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('img/logo.png') }}" alt="{{ trans('home.logo') }}" width="150">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav w-100 justify-content-end">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}"> {{ trans('auth.login') }} </a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ trans('auth.register') }} </a>
                                </li>
                            @endif
                        @else
                            
                        @endguest
                    </ul>

                    @auth
                    <div class="dropdown me-5">
                        <a class="dropdown-toggle text-decoration-none text-dark" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                            <img height="30px" width="30px" src="{{ asset('storage/avatars/'.Auth::user()->avatar ) }}?t={{ strtotime(Auth::user()->updated_at) }}" class="rounded-circle" alt="{{ Auth::user()->avatar }}"> {{ Auth::user()->name }} <span class="caret"> </span>
                        </a>

                        <ul class="dropdown-menu">

                            <li class="dropdown-item"> <a class="text-decoration-none text-dark" href="{{ route('auth/change_password') }}">  {{ trans('auth.change_password') }}</a> </li>

                            <li class="dropdown-item"> <a class="text-decoration-none text-dark" href="{{ route('auth/change_avatar') }}">  {{ trans('avatars.change_avatar') }}</a> </li>

                            <li class="dropdown-item"> <a class="text-decoration-none text-dark" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Logout') }} </a> </li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </div>
                    @endauth
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            @if ($errors->any())
                    <div class="alert alert-danger ms-5 me-5">
                        <p> <strong> {{ trans('forms.failed_transaction') }} </strong> </p>

                        <ul>
                            @foreach ($errors->all() as $error)
                                <li> {{ $error }} </li>
                            @endforeach
                        </ul>
                    </div>
            @endif

            @yield('content')
        </div>
    </body>
</html>