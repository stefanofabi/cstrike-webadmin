@extends('layouts.app')

@section('title')
{{ trans('avatars.change_avatar') }}
@endsection

@section('content')

<div class="container">
    <h2> {{ trans('avatars.change_avatar') }}</h2>
    
    <p> {{ trans('avatars.change_avatar_message') }} </p>
  
    <div class="card" style="width:400px; height: 600px">
        <img class="card-img-top" src="{{ asset('storage/avatars/'.Auth::user()->avatar ) }}" alt="Card image" style="width:100%">
    
        <div class="card-body float-right">
            <h4 class="card-title"> {{ auth()->user()->name }} </h4>

            <form method="post" action="{{ route('auth/change_avatar') }}" enctype="multipart/form-data">
                @csrf
                
                <div class="custom-file mb-3">
                    <input type="file" class="custom-file-input" name="avatar">
                    <label class="custom-file-label" for="customFile"> {{ trans('forms.choose_file') }}</label>
                </div>

            
                <div class="mt-3 float-right">
                    <button type="submit" class="btn btn-primary"> {{ trans('forms.submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<br /> 
<br />

<script>
    // Add the following code if you want the name of the file appear on select
    // This code goes to the end
    $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
@endsection
