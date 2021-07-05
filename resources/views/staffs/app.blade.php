@extends('layouts.app')

@section('content')

   <div class="col-md-3 mt-3 mb-3 float-left">
      <nav class="navbar bg-light">
         <ul class="navbar-nav">
            <li class="nav-item">
                  <a class="nav-link" href="{{ route('staffs/administrators/index') }}"> {{ trans('home.administrators') }} </a>
            </li>
         
            <li class="nav-item">
                  <a class="nav-link" href="{{ route('staffs/ranks/index') }}"> {{ trans('home.ranks') }} </a>
            </li>
         
            <li class="nav-item">
                  <a class="nav-link" href="{{ route('staffs/servers/index') }}"> {{ trans('home.servers') }} </a>
            </li>

            <li class="nav-item">
                  <a class="nav-link" href="{{ route('staffs/bans/index') }}"> {{ trans('home.bans') }} </a>
            </li>

            <li class="nav-item">
                  <a class="nav-link" href="{{ route('staffs/players/index') }}"> {{ trans('home.players_log') }} </a>
            </li>

            <li class="nav-item">
                  <a class="nav-link" href="{{ route('staffs/logs/activity_logs') }}" target="_blank"> {{ trans('home.activity_logs') }} </a>
            </li>
         </ul>
      </nav>

      @section('left-content')
      @show
   </div>

   <div class="col-md-9 mt-3 mb-3 float-left mb-5">
      @section('right-content')
      @show
   </div>

@endsection
