@extends('staffs.app')

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
        <h1> {{ trans('bans.create_ban') }} </h1>
        <p> {{trans('bans.create_ban_message') }} </p>
    </div>

    <form action="{{ route('staffs/bans/store') }}" method="POST">
        @csrf

                    <!-- Left Column -->
                    <div style="width: 50%; float:left; margin-left: 1%; margin-bottom: 2%">
                        <div class="form-group">
                            <label for="name"> <h5> <strong> {{ trans('bans.name') }}: </h5> </strong> </label>
                            
                            <input type="text" class="form-control" placeholder="{{ trans('bans.enter_name') }}" name="name" value="{{ @old('name') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="auth"> <h5> <strong> {{ trans('bans.steam_id') }}: </strong> </h5> </label>
                            
                            <input type="text" class="form-control" placeholder="{{ trans('bans.enter_steam_id') }}" name="steam_id" value="{{ @old('steam_id') }}">
                        </div>

                        <div class="form-group">
                            <label for="auth"> <h5> <strong> {{ trans('bans.ip') }}: </strong> </h5> </label>
                            
                            <input type="text" class="form-control" placeholder="{{ trans('bans.enter_ip') }}" name="ip" value="{{ @old('ip') }}">
                        </div>

                        <div class="form-group">
                            <label for="auth"> <h5> <strong> {{ trans('bans.reason') }}: </strong> </h5> </label>
                            
                            <input type="text" class="form-control" placeholder="{{ trans('bans.enter_reason') }}" name="reason" value="{{ @old('reason') }}" required>
                        </div>
					</div>

					<!-- Right Column -->
					<div style="width: 47%; ; margin-left: 1%; margin-right: 1%; float:right;padding-left: 3%;">
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
                            <label for="auth"> <h5> <strong> {{ trans('bans.expiration') }}: </strong> </h5> </label>
                            
                            <input type="datetime-local" class="form-control" placeholder="{{ trans('bans.expiration') }}" name="expiration" value="{{ @old('expiration') }}">
                        </div>

                                
                        <div class="form-group">
                            <label for="auth"> <h5> <strong> {{ trans('bans.private_notes') }}: </strong> </h5> </label>

                            <textarea class="form-control" rows="3" name="private_notes">{{ @old('observations') ?? '' }}</textarea>
                        </div>
					</div>

        <button style="clear: both" type="submit" class="btn btn-primary float-right mb-3 mt-4"> {{ trans('forms.submit') }}</button>
    </form>
    
    <hr style="clear: both">
@endsection