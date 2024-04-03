@extends('users.app')

@section('title')
{{ trans('home.my_administrators') }}
@endsection

@section('js')
    @include('users.administrators.js')

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
                passwordSpan = document.querySelector('.password1');
            
                if (passwordSpan.style.visibility === "hidden") {
                    passwordSpan.style.visibility = "visible";
                } else {
                    passwordSpan.style.visibility = "hidden";
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
    @include('users.administrators.show')

    <div class="p-3 my-3 bg-primary text-white">
        <h1> <span class="fas fa-users"> </span> {{ trans('home.my_administrators') }} </h1>
        <p class="col-9"> {{trans('administrators.welcome_message') }} </p>
    </div>

    <div>
        <table class="table table-striped w-100" id="myAdministratorsTable">
            <thead>
                <tr>
                    <th> {{ trans('administrators.auth') }} </th>
                    <th> {{ trans('orders.expiration') }} </th>
                    <th> {{ trans('servers.server') }} </th>
                    <th> {{ trans('ranks.rank') }} </th>
                    <th> {{ trans('administrators.status') }}</th>
                    <th class="text-end"> {{ trans('forms.actions') }}</th>
                </tr>
            </thead>
            
            <tbody>
                    @foreach ($administrators as $administrator)
                        <tr>
                            <td id="administrator_name_{{ $administrator->id }}"> 
                                {{ $administrator->auth }} 

                                @if (! empty($administrator->suspended))
                                <span class="badge bg-danger"> {{ trans('administrators.suspended') }}</span> 
                                @endif
                            </td>

                            <td id="administrator_expiration_{{ $administrator->id }}">
                                @if (empty($administrator->order->expiration))
                                    {{ trans('administrators.no_expiration') }}
                                @else 
                                    {{ date('d/m/Y', strtotime($administrator->order->expiration)) }}

                                    @if (date('Y-m-d') > $administrator->order->expiration)
                                        <span class="badge bg-danger"> {{ trans('administrators.expired') }}</span> 
                                    @endif
                                @endif                         
                            </td>

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
                                @endswitch 
                            </td>

                            <td class="text-end">
                                <a class="btn btn-success btn-sm" href="steam://connect/{{ $administrator->server->ip }}"> <i class="fas fa-sign-in-alt"></i> </a>

                                <a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#seeAdministrator" onclick="return seeAdministrator('{{ $administrator->id }}')" title="{{ trans('administrators.see_administrator') }}">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
            </tbody>

        </table>
    </div>
@endsection