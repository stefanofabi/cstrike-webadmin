@extends('users.app')

@section('title')
{{ trans('home.my_administrator') }}
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function(){
            setAccountFlags();

            setAccessServers();

            setAccessFlags();

            $(':checkbox[readonly=readonly]').click(function(){
                return false;        
            });
        });

        function setAccountFlags() {
            var account_flags = '{{ $administrator->account_flags }}';
            
            account_flags = account_flags.split('');

            account_flags.forEach(function(account_flag, index) {
                $('#account_flag_'+account_flag).attr('checked', true);
            });
        }

        function setAccessFlags() {
            var access_flags = '{{ $administrator->rank->access_flags }}';
            
            access_flags = access_flags.split('');

            access_flags.forEach(function(access_flag, index) {
                $('#access_flag_'+access_flag).attr('checked', true);
            });
        }

        function setAccessServers() {
            var servers = [
                    @foreach ($administrator->privileges as $privilege)
                    '{{ $privilege->server_id }}',
                    @endforeach    
            ];

            servers.forEach(function(server, index) {
                $('#server_'+server).attr('checked', true);
            });
        }
    </script>
@endsection

@section('right-content')
    <div class="p-3 my-3 bg-primary text-white">
        <h1> <span class="fas fa-user-shield"> </span> {{ trans('home.my_administrator') }} </h1>
        <p class="col-9"> {{trans('administrators.my_administrator_message') }} </p>
    </div>


    <div class="form-group">
        <label for="name"> <h5> <strong> {{ trans('administrators.auth') }}: </h5> </strong> </label>
                
        <input type="text" class="form-control col-6" value="{{ $administrator->auth }}" readonly>
    </div>

    <div class="form-group">
        <label for="password"> <h5> <strong> {{ trans('administrators.password') }}: </strong> </h5> </label>
                
        <input type="text" class="form-control col-6" value="{{ $administrator->password }}" readonly>
    </div>
    
    <div class="form-group">
                <h5> <strong>{{ trans('administrators.expiration') }}: </strong> </h5>

                <input class="form-control col-6" type="date" value="{{ $administrator->expiration }}" readonly>

                @if (date('Y-m-d') > date('Y-m-d', strtotime($administrator->expiration.' - 10 days')))
                    <a href="{{ $administrator->rank->purchase_link }}" target="_blank" class="btn btn-info mt-1" title="{{ trans('administrators.renew_now') }}"> {{ trans('administrators.renew_now') }} </a>
                @endif
    </div>

    <div class="form-group">
        <h5> <strong>{{ trans('ranks.rank') }}: </strong> </h5>

        <input class="form-control col-6" type="text" value="{{ $administrator->rank->name }}" readonly>
    </div>

    <div class="form-group">
        <h5> <strong> {{ trans('administrators.account_flags') }}: </strong> </h5>
                
        <div class="form-check">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" id="account_flag_a" readonly="readonly">
                <span data-toggle="tooltip" data-placement="right" title="Flag a"> {{ trans('administrators.unique_tag') }} </span>
            </label> 

            <br />

            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" id="account_flag_b" readonly="readonly">
                <span data-toggle="tooltip" data-placement="right" title="Flag b"> {{ trans('administrators.flexible_tag') }} </span>
            </label>

            <br />

            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" id="account_flag_c" readonly="readonly">
                <span data-toggle="tooltip" data-placement="right" title="Flag c"> {{ trans('administrators.it_steam') }} </span>
            </label>

            <br />

            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" id="account_flag_e" readonly="readonly">
                <span data-toggle="tooltip" data-placement="right" title="Flag d"> {{ trans('administrators.it_ip') }} </span>
            </label>

            <br />
                    
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" id="account_flag_e" readonly="readonly">
                <span data-toggle="tooltip" data-placement="right" title="Flag e"> {{ trans('administrators.password_not_checked') }} </span>
            </label>

            <br />

            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" id="account_flag_k" readonly="readonly">
                <span data-toggle="tooltip" data-placement="right" title="Flag k"> {{ trans('administrators.name_tag_case_sensitive') }} </span>
            </label>
        </div>
    </div>


    <div class="form-group">
        <h5> <strong> {{ trans('servers.servers_with_access') }}: </strong> </h5>

        <div class="form-check">
            @foreach ($servers as $server)
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="server_{{ $server->id }}" readonly="readonly">
                    <span data-toggle="tooltip" data-placement="right" title="{{ $server->ip }}"> {{ $server->name }} </span>
                </label>

                <br />
            @endforeach
        </div>
    </div>

    <div class="form-group">
        <h5> <strong> {{ trans('ranks.access_flags') }}: </strong> </h5> 
            
        <div class="form-check">

            <!-- Left column -->
            <div style="width: 40%; float:left; margin-left: 1%;">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="access_flag_a" readonly="readonly">
                    <span data-toggle="tooltip" data-placement="right" title="Flag a"> {{ trans('ranks.immunity') }} </span>
                </label> 

                <br />

                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="access_flag_b" readonly="readonly">
                    <span data-toggle="tooltip" data-placement="right" title="Flag b"> {{ trans('ranks.reserved_slot') }} </span>
                </label>

                <br />

                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="access_flag_c" readonly="readonly">
                    <span data-toggle="tooltip" data-placement="right" title="Flag c"> {{ trans('ranks.kick') }} </span>
                </label>

                <br />

                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="access_flag_d" readonly="readonly">
                    <span data-toggle="tooltip" data-placement="right" title="Flag d"> {{ trans('ranks.ban') }} </span>
                </label>

                <br />
                    
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="access_flag_e" readonly="readonly">
                    <span data-toggle="tooltip" data-placement="right" title="Flag e"> {{ trans('ranks.slay_slap') }} </span>
                </label>

                <br />

                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="access_flag_f" readonly="readonly">
                    <span data-toggle="tooltip" data-placement="right" title="Flag f"> {{ trans('ranks.change_map') }} </span>
                </label>

                <br />

                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="access_flag_g" readonly="readonly">
                    <span data-toggle="tooltip" data-placement="right" title="Flag g"> {{ trans('ranks.modify_cvar') }} </span>
                </label>

                <br />

                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="access_flag_h" readonly="readonly">
                    <span data-toggle="tooltip" data-placement="right" title="Flag h"> {{ trans('ranks.execute_cfg') }} </span>
                </label>

                <br />

                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="access_flag_i" readonly="readonly">
                    <span data-toggle="tooltip" data-placement="right" title="Flag i"> {{ trans('ranks.top_chat') }} </span>
                </label>

                <br />

                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="access_flag_j" readonly="readonly">
                    <span data-toggle="tooltip" data-placement="right" title="Flag j"> {{ trans('ranks.generate_votes') }} </span>
                </label>

                <br />

                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="access_flag_k" readonly="readonly">
                    <span data-toggle="tooltip" data-placement="right" title="Flag k"> {{ trans('ranks.change_password') }} </span>
                </label>

                <br />

                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="access_flag_l" readonly="readonly">
                    <span data-toggle="tooltip" data-placement="right" title="Flag l"> {{ trans('ranks.rcon_access') }} </span>
                </label>

                <br />
            </div>

            <!-- Right column -->
            <div style="width: 57%; ; margin-left: 1%; margin-right: 1%; float:right;">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="access_flag_m" readonly="readonly">
                    <span data-toggle="tooltip" data-placement="right" title="Flag m"> {{ trans('ranks.flag_m') }} </span>
                </label>

                <br />

                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="access_flag_n" readonly="readonly">
                    <span data-toggle="tooltip" data-placement="right" title="Flag n"> {{ trans('ranks.flag_n') }} </span>
                </label>

                <br />

                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="access_flag_o" readonly="readonly">
                    <span data-toggle="tooltip" data-placement="right" title="Flag o"> {{ trans('ranks.flag_o') }} </span>
                </label>

                <br />

                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="access_flag_p" readonly="readonly">
                    <span data-toggle="tooltip" data-placement="right" title="Flag p"> {{ trans('ranks.flag_p') }} </span>
                </label>

                <br />

                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="access_flag_q" readonly="readonly">
                    <span data-toggle="tooltip" data-placement="right" title="Flag q"> {{ trans('ranks.flag_q') }} </span>
                </label>

                <br />

                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="access_flag_r" readonly="readonly">
                    <span data-toggle="tooltip" data-placement="right" title="Flag r"> {{ trans('ranks.flag_r') }} </span>
                </label>

                <br />

                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="access_flag_s" readonly="readonly">
                    <span data-toggle="tooltip" data-placement="right" title="Flag s"> {{ trans('ranks.flag_s') }} </span>
                </label>

                <br />

                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="access_flag_t" readonly="readonly">
                    <span data-toggle="tooltip" data-placement="right" title="Flag t"> {{ trans('ranks.flag_t') }} </span>
                </label>

                <br />
                <br />

                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="access_flag_u" readonly="readonly">
                    <span data-toggle="tooltip" data-placement="right" title="Flag u"> {{ trans('ranks.flag_u') }} </span>
                </label>

                <br />

                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="access_flag_v" readonly="readonly">
                    <span data-toggle="tooltip" data-placement="right" title="Flag v"> {{ trans('ranks.flag_v') }} </span>
                </label>

                <br />

                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="access_flag_z" readonly="readonly">
                    <span data-toggle="tooltip" data-placement="right" title="Flag z"> {{ trans('ranks.flag_z') }} </span>
                </label>
            </div>                
        </div>
    </div>
@endsection