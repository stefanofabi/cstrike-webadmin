@extends('staffs.app')

@section('title')
{{ trans('packages.create_package') }}
@endsection

@section('js')

@endsection

@section('right-content')
    <div class="p-3 my-3 bg-primary text-white">
        <h1> <i class="fa-solid fa-plus"></i> {{ trans('packages.create_package') }} </h1>
        <p class="col-md-9"> {{trans('packages.create_package_message') }} </p>
    </div>

    <form action="{{ route('staffs/packages/store') }}" method="POST">
        @csrf

        <div class="col-md-9">
            <label for="name"> <h5> <strong> {{ trans('packages.name') }}: </h5> </strong> </label>
            
            <input type="text" class="form-control" name="name" value="{{ @old('name') }}" required>
        </div>

        <div class="col-md-9 mt-3">
            <label for="name"> <h5> <strong> {{ trans('packages.description') }}: </h5> </strong> </label>
            
            <textarea class="form-control" name="description"></textarea>
        </div>

        <div class="col-md-9 mt-3">
            <label for="name"> <h5> <strong> {{ trans('packages.price') }}: </h5> </strong> </label>
            
            <input type="number" step="0.1" class="form-control" name="price" value="{{ @old('price') }}" required>
        </div>
        
        <button style="clear: both" type="submit" class="btn btn-primary mb-3 mt-4"> {{ trans('forms.submit') }}</button>
    </form>
@endsection