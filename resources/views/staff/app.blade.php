@extends('layouts.app')

@section('content')

   <div style="width: 20%; float:left">
      @section('left-content')
      @show
   </div>

   <div style="width: 80%; float:right">
      @section('right-content')
      @show
   </div>

@endsection
