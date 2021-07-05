@extends('staffs.app')

@section('title')
{{ trans('servers.create_server') }}
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();

            $("#checkAll").click(function () {  
                
                if ($('#checkAll').val() == 'on') {
                    $('#checkAll').val('off');
                    $('input:checkbox').attr('checked', false);
                } else {
                    $('#checkAll').val('on');
                    $('input:checkbox').attr('checked', true);
                }
            });
        });

        
    </script>
@endsection

@section('right-content')

    <div class="p-3 my-3 bg-primary text-white">
        <h1> {{ trans('servers.create_server') }} </h1>
        <p class="col-9"> {{trans('servers.create_server_message') }} </p>
    </div>

    <form action="{{ route('staffs/servers/store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name"> <h5> <strong> {{ trans('servers.name') }}: </h5> </strong> </label>
            
            <input type="text" class="form-control col-6" placeholder="{{ trans('servers.enter_name') }}" name="name" value="{{ @old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="auth"> <h5> <strong> {{ trans('servers.ip') }}: </strong> </h5> </label>
            
            <input type="text" class="form-control col-6" placeholder="{{ trans('servers.enter_ip') }}" name="ip" value="{{ @old('ip') }}" required>
        </div>
        
        <button style="clear: both" type="submit" class="btn btn-primary float-right mb-3 mt-4"> {{ trans('forms.submit') }}</button>
    </form>
    
    <hr style="clear: both">
@endsection