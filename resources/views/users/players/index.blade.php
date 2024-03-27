@extends('users.app')

@section('title')
{{ trans('home.players_log') }}
@endsection

@section('js')
    <script type="module">
        $('#myPlayersTable').DataTable({
            "language": {
                "info": '{{ trans('datatables.info') }}',
                "infoEmpty": '{{ trans('datatables.info_empty') }}',
                "infoFiltered": '{{ trans('datatables.info_filtered') }}',
                "search": '{{ trans('datatables.search') }}',
                "paginate": {
                    "first": '{{ trans('datatables.first') }}',
                    "last": '{{ trans('datatables.last') }}',
                    "previous": '{{ trans('datatables.previous') }}',
                    "next": '{{ trans('datatables.next') }}',
                },
                "lengthMenu": '{{ trans('datatables.show') }} '+
                    '<select class="form-select form-select-sm">'+
                    '<option value="10"> 10 </option>'+
                    '<option value="20"> 20 </option>'+
                    '<option value="30"> 30 </option>'+
                    '<option value="-1"> {{ trans('datatables.all') }} </option>'+
                    '</select> {{ trans('datatables.records') }}',
                "emptyTable": '{{ trans('datatables.no_data') }}',
                "zeroRecords": '{{ trans('datatables.no_match_records') }}',
            }
        });
    </script>
@endsection

@section('right-content')
    <div class="p-3 my-3 bg-primary text-white">
        <h1> <span class="fas fa-list"> </span> {{ trans('home.players_log') }} </h1>
        <p class="col-9"> {{trans('players.welcome_message') }} </p>
    </div>

    <div class="mt-3">
        <table class="table table-striped" id="myPlayersTable">
            <thead>
                <tr>
                    <th> {{ trans('players.date') }} </th>
                    <th> {{ trans('players.name') }} </th>
                    <th> {{ trans('players.steam_id') }} </th>
                    <th> {{ trans('players.ip') }} </th>
                    <th> {{ trans('players.server_name') }} </th>
                    <th class="text-end"> {{ trans('forms.actions') }}</th>
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

                            <td class="text-end">
                                <a href="{{ route('users/bans/create', $player->id) }}" class="btn btn-info btn-sm" title="{{ trans('players.ban_player') }}" > <i class="fas fa-ban fa-sm"></i> </a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>

        </table>
    </div>
@endsection