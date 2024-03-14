@extends('layouts.app')

@section('content')
<div class="row mt-3">
   <div class="col-md-3">
      <nav class="navbar">
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
   </div>

   <div class="col-md">
      @section('right-content')
      @show
   </div>
</div>
@endsection
