@extends('staffs.app')

@section('title')
{{ trans('home.orders') }}
@endsection

@section('js')

    @include('staffs.orders.js')

    <script type="module">
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

    @include('staffs.orders.edit')

    <div class="p-3 my-3 bg-primary text-white">
        <div class="btn-group float-end">
            <a  href="{{ route('staffs/orders/create') }}" class="btn btn-light"> <span class="fas fa-user-plus"> </span> {{ trans('orders.create_order') }} </a>
        </div>

        <h1> <i class="fa-solid fa-cube"></i> </span> {{ trans('home.orders') }} </h1>
        <p class="col-9"> {{trans('orders.welcome_message') }} </p>
    </div>

    <div>
        <table class="table table-striped" id="myOrdersTable">
            <thead>
                <tr>
                    <th> # </th>
                    <th> {{ trans('orders.date') }} </th>
                    <th> {{ trans('orders.user') }} </th>
                    <th> {{ trans('orders.package') }} </th>
                    <th> {{ trans('orders.price') }} </th>
                    <th> {{ trans('orders.status') }} </th>
                    <th class="text-end"> {{ trans('forms.actions') }}</th>
                </tr>
            </thead>
            
            <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td> {{ $order->id }} </td>
                            <td id="order_name_{{ $order->id }}"> {{ $order->date }} </td>
                            <td id="order_user_{{ $order->id }}"> {{ $order->user->name }} </td>
                            <td id="order_package_{{ $order->id }}"> {{ $order->package->name }} </td>
                            <td id="order_price_{{ $order->id }}"> ${{ $order->price }} </td>
                            <td id="order_status_{{ $order->id }}">
                                @switch($order->status)
                                    @case('Pending')
                                    <span class="badge bg-primary"> {{ trans('orders.pending') }} </span>
                                    @break
                                    @endcase

                                    @case('Completed')
                                    <span class="badge bg-success"> {{ trans('orders.completed') }} </span>
                                    @break
                                    @endcase

                                    @case('Cancelled')
                                    <span class="badge bg-danger"> {{ trans('orders.cancelled') }} </span>
                                    @break
                                    @endcase

                                    @case('Refunded')
                                    <span class="badge bg-warning"> {{ trans('orders.refunded') }} </span>
                                    @break
                                    @endcase
                                @endswitch
                            </td>

                            <td class="text-end form-inline">   
                                <a type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editOrder" onclick="return editOrder('{{ $order->id }}')" title="{{ trans('orders.edit_order') }}">
                                    <span class="fas fa-edit"></span>
                                </a>

                                <a class="btn btn-primary btn-sm" title="{{ trans('orders.destroy_order') }}" onclick="destroyOrder('{{ $order->id }}')"> <i class="fas fa-trash fa-sm"> </i> </a>

                                <form id="destroy_order_{{ $order->id }}" method="POST" action=" {{ route('staffs/orders/destroy', ['id' => $order->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                </form>                               
                            </td>
                        </tr>
                    @endforeach
            </tbody>

        </table>
    </div>
@endsection