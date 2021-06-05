@extends('staffs.app')

@section('js')
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });

        function setBanExpiration(minutes) {

            // Ban permanently
            if (minutes == "") {
                $("#expiration").val(''); 
                return;  
            }

            var dateVal = new Date();
            
            dateVal.setMinutes(dateVal.getMinutes() + parseInt(minutes, 10));

            var day = dateVal.getDate().toString().padStart(2, "0");
            var month = (1 + dateVal.getMonth()).toString().padStart(2, "0");
            var hour = dateVal.getHours().toString().padStart(2, "0");
            var minute = dateVal.getMinutes().toString().padStart(2, "0");
            //var sec = dateVal.getSeconds().toString().padStart(2, "0");
            //var ms = dateVal.getMilliseconds().toString().padStart(3, "0");

            var inputDate = dateVal.getFullYear() + "-" + (month) + "-" + (day) + "T" + (hour) + ":" + (minute);        //  + ":" + (sec) + "." + (ms)
            
            $("#expiration").val(inputDate);   
        }

    </script>
@endsection

@section('right-content')

    <div class="p-3 my-3 bg-primary text-white">
        <h1> {{ trans('bans.create_ban') }} </h1>
        <p class="col-9"> {{trans('bans.create_ban_message') }} </p>
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
                            <h5> <strong> {{ trans('bans.servers_with_ban') }}: </strong> </h5>

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
                            
                            <input type="datetime-local" class="form-control" placeholder="{{ trans('bans.expiration') }}" name="expiration" id="expiration" value="{{ @old('expiration') }}">

                            <button type="button" class="btn btn-primary btn-sm ml-1 mt-3" onclick="setBanExpiration('5')"> {{ trans('bans.5_minutes') }}</button>
                            <button type="button" class="btn btn-primary btn-sm ml-1 mt-3" onclick="setBanExpiration('15')"> {{ trans('bans.15_minutes') }}</button>
                            <button type="button" class="btn btn-primary btn-sm ml-1 mt-3" onclick="setBanExpiration('30')"> {{ trans('bans.30_minutes') }}</button>
                            <button type="button" class="btn btn-primary btn-sm ml-1 mt-3" onclick="setBanExpiration('60')"> {{ trans('bans.60_minutes') }}</button>
                            <br />
                            <button type="button" class="btn btn-primary btn-sm ml-1 mt-2 mb-2" onclick="setBanExpiration('1440')"> {{ trans('bans.1_day') }}</button>
                            <button type="button" class="btn btn-primary btn-sm ml-1 mt-2 mb-2" onclick="setBanExpiration('4320')"> {{ trans('bans.3_days') }}</button>
                            <button type="button" class="btn btn-primary btn-sm ml-1 mt-2 mb-2" onclick="setBanExpiration('7200')"> {{ trans('bans.5_days') }}</button>
                            <button type="button" class="btn btn-primary btn-sm ml-1 mt-2 mb-2" onclick="setBanExpiration('43200')"> {{ trans('bans.30_days') }}</button>
                            <button type="button" class="btn btn-primary btn-sm ml-1 mt-2 mb-2" onclick="setBanExpiration('')"> {{ trans('bans.permanently') }}</button>
                        
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