@extends('layouts.app')

@section('title')
{{ trans('home.dashboard') }}
@endsection

@section('content')
<div class="container mt-5">
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
                                <a class="nav-link" style="color: black" href="{{ route('staffs/administrators/index') }}">
                                    <h1>
                                        <i style="font-size: 8vw" class="fas fa-users"></i>
                                    </h1>

                                    {{ trans('home.administrators') }}
                                </a>
                            </div>
                        </div>

                        <div class="col" style="text-align: center;">
                            <a class="nav-link" style="color: black" href="{{ route('staffs/ranks/index') }}">
                                <h1>
                                    <i style="font-size: 8vw" class="fas fa-key"></i>
                                </h1>

                                {{ trans('home.ranks') }}
                            </a>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col">
                            <div style="text-align: center;">
                                <a class="nav-link" style="color: black" href="{{ route('staffs/servers/index') }}">
                                    <h1>
                                        <i style="font-size: 8vw" class="fas fa-server"></i>
                                    </h1>

                                    {{ trans('home.servers') }}
                                </a>
                            </div>
                        </div>

                        <div class="col">
                            <div style="text-align: center;">
                                <a class="nav-link" style="color: black" href="{{ route('staffs/bans/index') }}">
                                    <h1>
                                        <i style="font-size: 8vw" class="fas fa-ban"></i>
                                    </h1>

                                    {{ trans('home.bans') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
