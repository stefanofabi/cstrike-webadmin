@extends('users.app')

@section('title')
{{ trans('home.orders') }}
@endsection

@section('js')
    @include('users.orders.js')
    
    <script type="module">
        var orderId = "{{ $order->id ?? '' }}";
        var defaultValue = orderId ? '#' + orderId : '';
        
        $('#myOrdersTable').DataTable({
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
            },
            "search": {"search": defaultValue }
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
    @include('users.orders.edit')

    <div class="p-3 my-3 bg-primary text-white">
        <h1> <i class="fa-solid fa-cube"></i> </span> {{ trans('home.orders') }} </h1>
        <p class="col-9"> {{trans('orders.welcome_message') }} </p>
    </div>

    <div>
        <table class="table table-striped" id="myOrdersTable">
            <thead>
                <tr>
                    <th> # </th>
                    <th> {{ trans('orders.date') }} </th>
                    <th> {{ trans('orders.package') }} </th>
                    <th> {{ trans('orders.price') }} </th>
                    <th> {{ trans('orders.status') }} </th>
                    <th> {{ trans('orders.expiration') }} </th>
                    <th class="text-end"> {{ trans('forms.actions') }}</th>
                </tr>
            </thead>
            
            <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td> #{{ $order->id }} </td>
                            <td> {{ $order->date }} </td>
                            <td> {{ $order->package->name }} </td>
                            <td> ${{ $order->price }} </td>
                            <td>
                                @switch($order->status)
                                    @case('Pending')
                                    <span class="badge bg-primary"> {{ trans('orders.pending') }} </span>
                                    @break
                                    @endcase

                                    @case('Active')
                                    <span class="badge bg-success"> {{ trans('orders.active') }} </span>
                                    @break
                                    @endcase

                                    @case('Expired')
                                    <span class="badge bg-danger"> {{ trans('orders.expired') }} </span>
                                    @break
                                    @endcase
                                @endswitch
                            </td>

                            <td> {{ $order->expiration ?? 'N/A' }} </td>

                            <td class="text-end">   
                                <a class="btn btn-primary btn-sm" href="{{ route('users/orders/pay', ['id' => $order->id]) }}" title="{{ trans('orders.pay_order') }}"> 
                                    <i class="fa-solid fa-dollar-sign"></i>
                                </a>

                                <a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editOrder" onclick="return editOrder('{{ $order->id }}')" title="{{ trans('orders.edit_order') }}">
                                    <i class="fa-solid fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
            </tbody>

        </table>
    </div>
@endsection