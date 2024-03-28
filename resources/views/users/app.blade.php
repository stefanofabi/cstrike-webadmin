@extends('layouts.app')

@section('content')
<div class="row mt-3">
   @section('menu-content')
   <div class="col-md-3">
      <nav class="navbar bg-light">
         <ul class="navbar-nav">
            <li class="nav-item">
               <a class="nav-link" href="{{ route('users/administrators/index') }}"> {{ trans('home.my_administrators') }} </a>
            </li>

            <li class="nav-item">
                  <a class="nav-link" href="{{ route('users/bans/index') }}"> {{ trans('home.my_bans') }} </a>
            </li>

            <li class="nav-item">
               <a class="nav-link" href="{{ route('users/orders/index') }}"> {{ trans('home.my_orders') }} </a>
            </li>

            <li class="nav-item">
                  <a class="nav-link" href="{{ route('users/players/index') }}"> {{ trans('home.players_log') }} </a>
            </li>
         </ul>
      </nav>
      

      @section('left-content')
      @show
   </div>
   @show

   <div class="col-md">
      @section('right-content')
      @show
   </div>
</div>
@endsection
