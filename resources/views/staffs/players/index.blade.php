@extends('staffs.app')

@section('js')
    @include('staffs.players.js')
@endsection

@section('right-content')
    <div class="p-3 my-3 bg-primary text-white">
        <h1> <span class="fas fa-list"> </span> {{ trans('home.players_log') }} </h1>
        <p class="col-9"> {{trans('players.welcome_message') }} </p>
    </div>

    <div class="card">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th> {{ trans('players.date') }} </th>
                    <th> {{ trans('players.name') }} </th>
                    <th> {{ trans('players.steam_id') }} </th>
                    <th> {{ trans('players.ip') }} </th>
                    <th> {{ trans('players.server_name') }} </th>
                    <th class="text-right"> {{ trans('forms.actions') }}</th>
                </tr>
            </thead>
            
            <tbody>
                @if ($players->isNotEmpty())
                    @foreach ($players as $player)
                        <tr>
                            <td> {{ date('d/m/Y H:i',strtotime($player->date)) }} </td>
                            <td> {{ $player->name }} </td>
                            <td> {{ $player->steam_id }} </td>
                            <td> {{ $player->ip }} </td>
                            <td> {{ $player->server->name }} </td>

                            <td class="float-right form-inline">
                                <a href="{{ route('staffs/bans/create', $player->id) }}" class="btn btn-info btn-sm mr-1 mb-1" title="{{ trans('players.ban_player') }}" > <i class="fas fa-ban fa-sm"></i> </a>                             
                            
                                <form id="destroy_player_{{ $player->id }}" method="POST" action=" {{ route('staffs/players/destroy', ['id' => $player->id]) }}">
                                    @csrf
                                    @method('DELETE')

                                    <a class="btn btn-info btn-sm mb-1" title="{{ trans('players.destroy_player') }}" onclick="destroyPlayer('{{ $player->id }}')"> <i class="fas fa-trash fa-sm"> </i> </a>
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