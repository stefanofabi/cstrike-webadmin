@extends('staffs.app')

@section('title')
{{ trans('home.servers') }}
@endsection

@section('js')
    @include('staffs.servers.js')

    <script type="module">
        $('#myServersTable').DataTable({
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

    @include('staffs.servers.edit')

    <div class="p-3 my-3 bg-primary text-white">
        <div class="btn-group float-end">
            <a  href="{{ route('staffs/servers/create') }}" class="btn btn-light"> <span class="fas fa-plus"> </span> {{ trans('servers.create_server') }} </a>
        </div>

        <h1> <span class="fas fa-server"> </span> {{ trans('home.servers') }} </h1>
        <p class="col-9"> {{trans('servers.welcome_message') }} </p>
    </div>

    <div class="mt-3">
        <table class="table table-striped w-100" id="myServersTable">
            <thead>
                <tr>
                    <th> {{ trans('servers.id') }} </th>
                    <th> {{ trans('servers.name') }} </th>
                    <th> {{ trans('servers.ip') }} </th>
                    <th> {{ trans('servers.server_status') }} </th>
                    <th class="text-end"> {{ trans('forms.actions') }}</th>
                </tr>
            </thead>
            
            <tbody>
                @if ($servers->isNotEmpty())
                    @foreach ($servers as $server)
                        <tr>
                            <td> {{ $server->id }} </td>
                            <td id="server_name_{{ $server->id }}"> {{ $server->name }} </td>

                            <td id="server_ip_{{ $server->id }}"> {{ $server->ip }} </td>

                            <td> 
                                @if (!empty($server->online_date) && strtotime($server->online_date) >= strtotime(date('Y-m-d H:i:s').'- 15 minutes'))
                                <span class="badge bg-success"> {{ trans('servers.online') }} </span> 
                                @else
                                <span class="badge bg-danger"> {{ trans('servers.offline') }} </span> 
                                @endif
                            </td>
                            <td class="text-end form-inline">

				                <a class="btn btn-success btn-sm" href="steam://connect/{{ $server->ip }}"> <i class="fas fa-sign-in-alt"></i> </a>

                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editServer" onclick="return editServer('{{ $server->id }}')" title="{{ trans('servers.edit_server') }}">
                                    <span class="fas fa-edit"></span>
                                </button>

                                <a class="btn btn-primary btn-sm" title="{{ trans('servers.destroy_server') }}" onclick="destroyServer('{{ $server->id }}')"> <i class="fas fa-trash fa-sm"> </i> </a>

                                <form id="destroy_server_{{ $server->id }}" method="POST" action=" {{ route('staffs/servers/destroy', ['id' => $server->id]) }}">
                                    @csrf
                                    @method('DELETE')

                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>

        </table>
    </div>
@endsection