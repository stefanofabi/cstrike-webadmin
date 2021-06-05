@extends('staffs.app')

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
                            <td> {{ $ban->name }} </td>
                            <td> {{ $ban->steam_id }} </td>
                            <td> {{ $ban->ip }} </td>
                            <td> {{ $ban->expiration }} </td>

                            <td class="text-right">
                                <form id="destroy_ban_{{ $ban->id }}" method="POST" action=" {{ route('staffs/bans/destroy', ['id' => $ban->id]) }}">
                                    @csrf
                                    @method('DELETE')

                                    <a class="btn btn-info btn-sm float-right" title="{{ trans('bans.destroy_ban') }}" onclick="destroyBan('{{ $ban->id }}')"> <i class="fas fa-trash fa-sm"> </i> </a>
                                </form>

                                <button type="button" class="btn btn-info btn-sm mr-3" data-toggle="modal" data-target="#editBan" onclick="return editBan('{{ $ban->id }}')" title="{{ trans('bans.edit_ban') }}">
                                    <span class="fas fa-edit"></span>
                                </button>
                                
                            </td>
                        </tr>
                    @endforeach
                @else 
                    <td colspan="5"> {{ trans('forms.no_data' )}} </td>
                @endif
            </tbody>

        </table>
    </div>
@endsection