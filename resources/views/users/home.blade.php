@extends('layouts.app')

@section('title')
{{ trans('home.dashboard') }}
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> {{ trans('home.dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                    
                        <div class="col">
                            <div style="text-align: center;">
                                <a class="nav-link" style="color: black" href="{{ route('users/bans/index') }}">
                                    <h1>
                                        <i style="font-size: 8vw" class="fas fa-ban"></i>
                                    </h1>

                                    <br />

                                    {{ trans('home.my_bans') }}
                                </a>
                            </div>
                        </div>

                        <div class="col">
                            <div style="text-align: center;">
                                <a class="nav-link" style="color: black" href="{{ route('users/players/index') }}">
                                    <h1>
                                        <i style="font-size: 8vw" class="fas fa-users"></i>
                                    </h1>

                                    <br />

                                    {{ trans('players.players_log') }}
                                </a>
                            </div>
                        </div>

                        <div class="col">
                            <div style="text-align: center;">

                                @if (auth()->user()->administrator)
                                    <a class="nav-link" style="color: black" href="{{ route('users/profiles/my_administrator') }}">
                                        <h1>
                                            <i style="font-size: 8vw" class="fas fa-id-badge"></i>
                                        </h1>

                                        <br />

                                        {{ trans('home.my_administrator') }}
                                    </a>    
                                @else 
                                    <a class="nav-link" style="color: black" href="{{ route('buy_administrator') }}">
                                        <h1>
                                            <i style="font-size: 8vw" class="fas fa-shopping-cart"></i>
                                        </h1>

                                        <br />

                                        {{ trans('home.buy_administrator') }}
                                    </a>   

                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
