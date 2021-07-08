@extends('staffs.app')

@section('title')
{{ trans('administrators.create_administrator') }}
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();

            $('#rank').val("{{ @old('rank_id') }}");
        });


        $(function () {
            $("#administrator_account").autocomplete({
                minLength: 2,
                source: function (event, ui) {
                    var parameters = {
                        "_token": '{{ csrf_token() }}',
                        "filter": $("#administrator_account").val()
                    };

                    $.ajax({
                        data: parameters,
                        url: '{{ route("staffs/administrators/load_users") }}',
                        type: 'post',
                        dataType: 'json',
                        beforeSend: function () {
                            // nothing...
                        },
                        success: ui
                    });

                    return ui;
                },
                select: function (event, ui) {
                    event.preventDefault();
                    $('#administrator_account').val(ui.item.label);
                    $('#user_id').val(ui.item.id);
                }
            });
        });
    </script>

    <script>
        window.addEventListener("load", function() {
        
            // icon to be able to interact with the element
            showPassword = document.querySelector('.show-password');
            showPassword.addEventListener('click', () => {
        
            // input elements of type password
            password1 = document.querySelector('.password1');
        
            if ( password1.type === "text" ) {
                password1.type = "password"
                password2.type = "password"
                showPassword.classList.remove('fa-eye-slash');
            } else {
                password1.type = "text"
                password2.type = "text"
                showPassword.classList.toggle("fa-eye-slash");
            }
        })
        });
    </script>
@endsection

@section('style')
    <style>
        .password-icon {
        float: right;
        position: relative;
        margin: -25px 10px 0 0;
        cursor: pointer;
        }
    </style>
@endsection

@section('right-content')

    <div class="p-3 my-3 bg-primary text-white">
        <h1> {{ trans('administrators.create_administrator') }} </h1>
        <p class="col-9"> {{trans('administrators.create_administrator_message') }} </p>
    </div>

    <form action="{{ route('staffs/administrators/store') }}" method="POST">
        @csrf


        <!-- Left Column -->
		<div style="width: 55%; float:left; margin-left: 1%; margin-bottom: 2%">
            <div class="form-group">
                <label for="name"> <h5> <strong> {{ trans('administrators.name') }}: </h5> </strong> </label>
                
                <input type="text" class="form-control col-12" placeholder="{{ trans('administrators.enter_name') }}" name="name" value="{{ @old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="auth"> <h5> <strong> {{ trans('administrators.auth') }}: </strong> </h5> </label>
                
                <input type="text" class="form-control col-12" placeholder="{{ trans('administrators.enter_auth') }}" name="auth" value="{{ @old('auth') }}" required>
            </div>

            <div class="form-group">
                <label for="password"> <h5> <strong> {{ trans('administrators.password') }}: </strong> </h5> </label>
                
                <input type="password" class="form-control password1 col-12" placeholder="{{ trans('administrators.enter_password') }}" name="password">
                <div class="col-12"> <span class="fa fa-fw fa-eye password-icon show-password"></span> </div>
            </div>

            <div class="form-group">
                <h5> <strong>{{ trans('administrators.expiration') }}: </strong> </h5>

                <input class="form-control col-12" type="date" name="expiration" value="{{ @old('expiration') ?? date('Y-m-d', strtotime(date('Y-m-d').' + 1 month')) }}">
            </div>

            <div class="form-group">
                <h5> <strong>{{ trans('ranks.rank') }}: </strong> </h5>

                <select class="form-control col-12" name="rank_id" id="rank" required>
                    <option value="">  {{ trans('forms.select_option') }} </option>
                    
                    @foreach ($ranks as $rank)
                        <option value="{{ $rank->id }}">  {{ $rank->name }} </option>
                    @endforeach
                </select>
            </div>
        </div>


        <!-- Right Column -->
		<div style="width: 42%; ; margin-left: 1%; margin-right: 1%; float:right;padding-left: 3%;">
            <div class="form-group">
                <h5> <strong> {{ trans('administrators.account_flags') }}: </strong> </h5>
                
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="account_flags[]" id="flag_a" value="a">
                        <span data-toggle="tooltip" data-placement="right" title="Flag a"> {{ trans('administrators.unique_tag') }} </span>
                    </label> 

                    <br />

                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="account_flags[]" value="b">
                        <span data-toggle="tooltip" data-placement="right" title="Flag b"> {{ trans('administrators.flexible_tag') }} </span>
                    </label>

                    <br />

                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="account_flags[]" value="c">
                        <span data-toggle="tooltip" data-placement="right" title="Flag c"> {{ trans('administrators.it_steam') }} </span>
                    </label>

                    <br />

                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="account_flags[]" value="d">
                        <span data-toggle="tooltip" data-placement="right" title="Flag d"> {{ trans('administrators.it_ip') }} </span>
                    </label>

                    <br />
                    
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="account_flags[]" value="e">
                        <span data-toggle="tooltip" data-placement="right" title="Flag e"> {{ trans('administrators.password_not_checked') }} </span>
                    </label>

                    <br />

                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="account_flags[]" value="k">
                        <span data-toggle="tooltip" data-placement="right" title="Flag k"> {{ trans('administrators.name_tag_case_sensitive') }} </span>
                    </label>
                </div>
            </div>


            <div class="form-group">
                <h5> <strong> {{ trans('servers.servers_with_access') }}: </strong> </h5>

                <div class="form-check">
                    @forelse ($servers as $server)
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="servers[]" value="{{ $server->id }}">
                            <span data-toggle="tooltip" data-placement="right" title="{{ $server->ip }}"> {{ $server->name }} </span>
                        </label>

                        <br />
                    @empty
                        <div style="color: red"> {{ trans('servers.no_servers') }} </div>
                    @endforelse
                </div>
            </div>

            <div class="form-group">
                <label for="auth"> <h5> <strong> {{ trans('administrators.administrator_account') }}: </strong> </h5> </label>
                
                <input type="text" class="form-control col-12" placeholder="{{ trans('forms.start_typing') }}" id="administrator_account" name="administrator_account" value="{{ @old('administrator_account') }}">
                <input type="hidden" id="user_id" name="user_id" value="{{ @old('user_id') }}">
            </div>
        </div>
        
        <button style="clear: both" type="submit" class="btn btn-primary float-right mb-3 mt-4"> {{ trans('forms.submit') }}</button>
    </form>
    
    <hr style="clear: both">
@endsection