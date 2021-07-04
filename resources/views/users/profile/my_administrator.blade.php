@extends('users.app')

@section('right-content')
    <div class="p-3 my-3 bg-primary text-white">
        <h1> <span class="fas fa-user-shield"> </span> {{ trans('home.my_administrator') }} </h1>
        <p class="col-9"> {{trans('administrators.my_administrator_message') }} </p>
    </div>

    

@endsection