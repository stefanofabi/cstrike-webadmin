@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="width:720px">
                <div class="card-header">{{ trans('auth.change_avatar') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('auth/change_avatar') }}">
                        @csrf


                        <h4 class="card-title"> {{ auth()->user()->name }} </h4>

                        <div class="custom-file mb-3">
                            <input type="file" class="custom-file-input" id="customFile" name="filename">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ trans('forms.submit') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>

                <img class="card-img-bottom" src="{{ asset('storage/avatars/'.auth()->user()->avatar ) }}" alt="Profile image" style="width:100%">

            </div>
        </div>
    </div>
</div>
@endsection
