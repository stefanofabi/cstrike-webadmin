@extends('staffs.app')

@section('title')
{{ trans('home.bans') }}
@endsection

@section('js')
    <script>

        $(document).ready(function(){
            $('#server').on('change', function() {
                $('#selectServer').submit();
            });

            $('#server').val('{{ $server_id ?? '' }}')
        });
        
    </script>

    @include('staffs.bans.js')
@endsection

@section('right-content')

    @include('staffs.bans.edit')

    <div class="p-3 my-3 bg-primary text-white">
        <div class="btn-group float-right">
            <a  href="{{ route('staffs/bans/create') }}" class="btn btn-info"> <span class="fas fa-plus"> </span> {{ trans('bans.create_ban') }} </a>
        </div>

        <h1> <span class="fas fa-ban"> </span> {{ trans('home.bans') }} </h1>
        <p class="col-9"> {{trans('bans.welcome_message') }} </p>
    </div>

    <div class="form-row">
        <div class="form-group">
            <h3> <strong> {{ trans('forms.select_server') }}: </strong> </h3>  
        </div>

        <div class="form-group col-md-6 ml-3">
            <form action="{{ route('staffs/bans/load') }}" method="POST" id="selectServer">
                @csrf
                
                <select class="form-control col-12" name="server_id" id="server">
                    <option value=""> {{ trans('forms.select_option') }}</option>
                    @foreach ($servers as $server) 
                        <option value="{{ $server->id }}"> {{ $server->name }} [{{ $server->ip }}] </option>
                    @endforeach
                </select>

            </form>
        </div>
    </div>

    <div class="card">
        <table class="table table-striped">
            <thead>
                <tr>    
                    <th> {{ trans('bans.date') }} </th>
                    <th> {{ trans('bans.name') }} </th>
                    <th> {{ trans('bans.steam_id') }} </th>
                    <th> {{ trans('bans.ip') }} </th>
                    <th> {{ trans('bans.expiration') }} </th>
                    <th class="text-right"> {{ trans('forms.actions') }}</th>
                </tr>
            </thead>
            
            <tbody>
                @if (isset($bans) && $bans->isNotEmpty())
                    @foreach ($bans as $ban)
                        <tr>
                            <td id="ban_date_{{ $ban->id }}"> {{ date('d/m/Y H:i', strtotime($ban->date)) }}  </td>
                            <td id="ban_name_{{ $ban->id }}"> {{ $ban->name }} </td>

                            <td id="ban_steam_id_{{ $ban->id }}"> 
                                @if (empty($ban->steam_id)) 
                                    {{ trans('bans.not_apply') }} 
                                @else 
                                    {{ $ban->steam_id }} 
                                @endif
                            </td>

                            <td id="ban_ip_{{ $ban->id }}"> 
                                @if (empty($ban->ip)) 
                                {{ trans('bans.not_apply') }} 
                                @else 
                                    {{ $ban->ip }} 
                                @endif
                            </td>

                            <td id="ban_expiration_{{ $ban->id }}">  
                                @if (empty($ban->expiration)) 
                                    {{ trans('bans.never') }} 
                                @else 
                                    {{ date('d/m/Y H:i', strtotime($ban->expiration)) }} 

                                    @if ($ban->expiration < date('Y-m-d\TH:i'))
                                        <span class="badge badge-success"> {{ trans('bans.expired') }}</span>
                                    @endif
                                @endif
                            </td>

                            <td class="float-right form-inline">
                                <button type="button" class="btn btn-info btn-sm mr-1 mb-1" data-toggle="modal" data-target="#editBan" onclick="return editBan('{{ $ban->id }}')" title="{{ trans('bans.edit_ban') }}">
                                    <span class="fas fa-edit"></span>
                                </button>

                                <form id="destroy_ban_{{ $ban->id }}" method="POST" action=" {{ route('staffs/bans/destroy', ['id' => $ban->id]) }}">
                                    @csrf
                                    @method('DELETE')

                                    <a class="btn btn-info btn-sm mb-1" title="{{ trans('bans.destroy_ban') }}" onclick="destroyBan('{{ $ban->id }}')"> <i class="fas fa-trash fa-sm"> </i> </a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else 
                    <td colspan="6"> {{ trans('forms.no_data' )}} </td>
                @endif
            </tbody>

        </table>
    </div>
@endsection