@extends('layouts.app')

@section('content')

   <div style="width: 20%; float:left; margin-left: 1%;">
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
         </ul>
      </nav>

      @section('left-content')
      @show
   </div>

   <div style="width: 77%; ; margin-left: 1%; margin-right: 1%; float:right; margin-bottom: 5%">
      @section('right-content')
      @show
   </div>

@endsection
