@extends('staffs.app')

@section('title')
{{ trans('home.administrators') }}
@endsection

@section('js')
    
    @include('staffs.administrators.js')

    <script type="module">
        $(document).ready(function(){
            $('#rank').val("{{ @old('rank_id') }}");
        });
    </script>

    <script type="module">
        $('#myAdministratorsTable').DataTable({
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


    <script>
        window.addEventListener("load", function() {
        
            // icon to be able to interact with the element
            showPassword = document.querySelector('.show-password');
            showPassword.addEventListener('click', () => {
        
            // input elements of type password
            password1 = document.querySelector('.password1');
        
            if ( password1.type === "text" ) {
                password1.type = "password"
                password2.type = "password"
                showPassword.classList.remove('fa-eye-slash');
            } else {
                password1.type = "text"
                password2.type = "text"
                showPassword.classList.toggle("fa-eye-slash");
            }
        })
        });
    </script>
@endsection

@section('style')
    <style>
        .password-icon {
            float: right;
            position: relative;
            margin: -25px 10px 0 0;
            cursor: pointer;
        }
    </style>
@endsection

@section('right-content')
    
    @include('staffs.administrators.edit')

    <div class="p-3 my-3 bg-primary text-white">
        <div class="btn-group float-end">
            <a  href="{{ route('staffs/administrators/create') }}" class="btn btn-light"> <span class="fas fa-user-plus"> </span> {{ trans('administrators.create_administrator') }} </a>
        </div>

        <h1> <span class="fas fa-users"> </span> {{ trans('home.administrators') }} </h1>
        <p class="col-9"> {{trans('administrators.welcome_message') }} </p>
    </div>

    <div>
        <table class="table table-striped w-100" id="myAdministratorsTable">
            <thead>
                <tr>
                    <th> {{ trans('administrators.name') }} </th>
                    <th> {{ trans('servers.server') }}</th>
                    <th> {{ trans('ranks.rank') }}</th>
                    <th> {{ trans('administrators.status') }} </th>
                    <th class="text-end"> {{ trans('forms.actions') }}</th>
                </tr>
            </thead>
            
            <tbody>
                @if ($administrators->isNotEmpty())
                    @foreach ($administrators as $administrator)
                        <tr>
                            <td id="administrator_name_{{ $administrator->id }}"> {{ $administrator->name }} </td>

                            <td id="administrator_server_{{ $administrator->id }}"> {{ $administrator->server->name }} </td>
                            
                            <td id="administrator_rank_{{ $administrator->id }}"> {{ $administrator->rank->name }} </td>

                            <td id="administrator_status_{{ $administrator->id }}">
                                @switch ($administrator->status)
                                    @case('Active')
                                        <span class="badge bg-success"> {{ trans('administrators.active') }} </span>
                                        @break
                                    @endcase

                                    @case('Suspended')
                                        <span class="badge bg-danger"> {{ trans('administrators.suspended') }} </span>
                                        @break
                                    @endcase

                                    @case('Expired')
                                        <span class="badge bg-warning"> {{ trans('administrators.expired') }} </span>
                                        @break
                                    @endcase

                                    @case('Cancelled')
                                    <span class="badge bg-primary"> {{ trans('administrators.cancelled') }} </span>
                                    @break
                                @endswitch 
                            </td>

                            <td class="text-end">
                                <a class="btn btn-primary btn-sm @if (empty($administrator->order_id)) disabled @endif" href="{{ route('staffs/orders/index', ['order' => $administrator->order_id]) }}" title="{{ trans('administrators.find_order') }}"> <i class="fa-solid fa-cube"></i> </a>

                                <a class="btn btn-primary btn-sm" href="{{ route('staffs/bans/index', ['server' => $administrator->server_id, 'administrator' => $administrator->id]) }}" title="{{ trans('administrators.find_bans') }}"> <i class="fa-solid fa-ban"></i> </a>

                                <a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editAdministrator" onclick="return editAdministrator('{{ $administrator->id }}')" title="{{ trans('administrators.edit_administrator') }}">
                                    <span class="fas fa-user-edit"></span>
                                </a>

                                <a class="btn btn-primary btn-sm @if (! empty($administrator->order_id)) disabled @endif" title="{{ trans('administrators.destroy_administrator') }}" onclick="destroy_administrator('{{ $administrator->id }}')"> <i class="fas fa-user-slash fa-sm"> </i> </a>
                                
                                <form id="destroy_administrator_{{ $administrator->id }}" method="POST" action="{{ route('staffs/administrators/destroy', ['id' => $administrator->id]) }}">
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