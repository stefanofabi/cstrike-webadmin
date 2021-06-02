@extends('layouts.app')

@section('content')

   <div style="width: 20%; float:left; margin-left: 1%;">
      <nav class="navbar bg-light">
         <ul class="navbar-nav">
            <li class="nav-item">
                  <a class="nav-link" href="{{ route('staff/administrators/index') }}"> {{ trans('home.administrators') }} </a>
            </li>
         
            <li class="nav-item">
                  <a class="nav-link" href="#"> {{ trans('home.ranks') }} </a>
            </li>
         
            <li class="nav-item">
                  <a class="nav-link" href="#"> {{ trans('home.servers') }} </a>
            </li>
         </ul>
      </nav>

      @section('left-content')
      @show
   </div>

   <div style="width: 77%; ; margin-left: 1%; margin-right: 1%; float:right;">
      @section('right-content')
      @show
   </div>

@endsection
