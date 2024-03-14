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
                                    <a class="nav-link" href="{{ route('login') }}"> {{ trans('auth.login') }} </a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ trans('auth.register') }} </a>
                                </li>
                            @endif
                        @else
                            
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img height="30px" width="30px" src="{{ asset('storage/avatars/'.Auth::user()->avatar ) }}?t={{ strtotime(Auth::user()->updated_at) }}" class="rounded-circle" alt="{{ Auth::user()->avatar }}"> {{ Auth::user()->name }} <span class="caret"> </span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('auth/change_password') }}">  {{ trans('auth.change_password') }}</a>

                                    <a class="dropdown-item" href="{{ route('auth/change_avatar') }}">  {{ trans('avatars.change_avatar') }}</a>

                                    @can('system_logs')
                                        <a class="dropdown-item disabled" href="" target="_blank">  {{ trans('home.system_logs') }}</a>
                                    @endcan

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

        <div class="container-fluid">
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
        </div>
    </body>
</html>