@extends('staffs.app')

@section('js')
    @include('staffs.servers.js')
@endsection

@section('right-content')

    @include('staffs.servers.edit')

    <div class="p-3 my-3 bg-primary text-white">
        <div class="btn-group float-right">
            <a  href="{{ route('staffs/servers/create') }}" class="btn btn-info"> <span class="fas fa-plus"> </span> {{ trans('servers.create_server') }} </a>
        </div>

        <h1> <span class="fas fa-server"> </span> {{ trans('home.servers') }} </h1>
        <p class="col-9"> {{trans('servers.welcome_message') }} </p>
    </div>

    <div class="card">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th> {{ trans('servers.id') }} </th>
                    <th> {{ trans('servers.name') }} </th>
                    <th> {{ trans('servers.ip') }} </th>
                    <th class="text-right"> {{ trans('forms.actions') }}</th>
                </tr>
            </thead>
            
            <tbody>
                @if ($servers->isNotEmpty())
                    @foreach ($servers as $server)
                        <tr>
                            <td> {{ $server->id }} </td>
                            <td id="server_name_{{ $server->id }}"> {{ $server->name }} </td>
                            <td id="server_ip_{{ $server->id }}"> {{ $server->ip }} </td>

                            <td class="text-right">
                                <form id="destroy_server_{{ $server->id }}" method="POST" action=" {{ route('staffs/servers/destroy', ['id' => $server->id]) }}">
                                    @csrf
                                    @method('DELETE')

                                    <a class="btn btn-info btn-sm float-right" title="{{ trans('servers.destroy_server') }}" onclick="destroyServer('{{ $server->id }}')"> <i class="fas fa-trash fa-sm"> </i> </a>
                                </form>

                                <button type="button" class="btn btn-info btn-sm mr-3" data-toggle="modal" data-target="#editServer" onclick="return editServer('{{ $server->id }}')" title="{{ trans('servers.edit_server') }}">
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