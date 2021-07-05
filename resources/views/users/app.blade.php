@extends('layouts.app')

@section('content')

   <div class="col-md-3 mt-3 mb-3 float-left">
      <nav class="navbar bg-light">
         <ul class="navbar-nav">
            <li class="nav-item">
                  <a class="nav-link" href="{{ route('users/bans/index') }}"> {{ trans('home.my_bans') }} </a>
            </li>

            <li class="nav-item">
                  <a class="nav-link" href="{{ route('users/players/index') }}"> {{ trans('home.players_log') }} </a>
            </li>

            @if (auth()->user()->administrator)
               <li class="nav-item">
                     <a class="nav-link" href="{{ route('users/profiles/my_administrator') }}"> {{ trans('home.my_administrator') }} </a>
               </li>
            @else 
               <li class="nav-item">
                     <a class="nav-link" href="{{ route('users/profiles/buy_administrator') }}"> {{ trans('home.buy_administrator') }} </a>
               </li>
            @endif
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
