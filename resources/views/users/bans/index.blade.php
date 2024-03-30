@extends('users.app')

@section('title')
{{ trans('home.bans') }}
@endsection

@section('js')
    <script type="module">

        $(document).ready(function(){
            $('#server').on('change', function() {
                $('#selectServer').submit();
            });

            $('#server').val('{{ $server->id ?? '' }}')
        });        
    </script>

    <script type="module">
        $('#myBansTable').DataTable({
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

    @include('users.bans.js')
@endsection

@section('right-content')

    @include('users.bans.edit')

    <div class="p-3 my-3 bg-primary text-white">
        <div class="btn-group float-end">
            <a  href="{{ route('users/bans/create') }}" class="btn btn-light"> <span class="fas fa-plus"> </span> {{ trans('bans.create_ban') }} </a>
        </div>

        <h1> <span class="fas fa-ban"> </span> {{ trans('home.bans') }} </h1>
        <p class="col-9"> {{trans('bans.user_welcome_message') }} </p>
    </div>

    <div class="row mt-3">
        <div class="col-auto">
            <h3> <strong> {{ trans('forms.select_server') }}: </strong> </h3>  
        </div>

        <div class="col-md-6">
            <form action="{{ route('users/bans/index') }}" id="selectServer">
                <select class="form-select" name="server" id="server">
                    <option value=""> {{ trans('forms.select_option') }}</option>
                    @foreach ($servers as $server) 
                        <option value="{{ $server->id }}"> {{ $server->name }} </option>
                    @endforeach
                </select>

            </form>
        </div>
    </div>

    <div class="mt-3">
        <table class="table table-striped" id="myBansTable">
            <thead>
                <tr>    
                    <th> {{ trans('bans.date') }} </th>
                    <th> {{ trans('bans.name') }} </th>
                    <th> {{ trans('bans.steam_id') }} </th>
                    <th> {{ trans('bans.ip') }} </th>
                    <th> {{ trans('bans.expiration') }} </th>
                    <th class="text-end"> {{ trans('forms.actions') }}</th>
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

                            <td class="text-end">
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editBan" onclick="return editBan('{{ $ban->id }}')" title="{{ trans('bans.edit_ban') }}">
                                    <span class="fas fa-edit"></span>
                                </button>

                                <a class="btn btn-primary btn-sm" title="{{ trans('bans.destroy_ban') }}" onclick="destroyBan('{{ $ban->id }}')"> <i class="fas fa-trash fa-sm"> </i> </a>

                                <form id="destroy_ban_{{ $ban->id }}" method="POST" action=" {{ route('users/bans/destroy', ['id' => $ban->id]) }}">
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