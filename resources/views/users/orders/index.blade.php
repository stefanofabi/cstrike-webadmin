@extends('users.app')

@section('title')
{{ trans('home.orders') }}
@endsection

@section('js')
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
@endsection

@section('right-content')
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
                                @switch($order->status)
                                    @case('Pending')
                                    <a class="btn btn-primary btn-sm" href="{{ route('users/orders/pay', ['id' => $order->id]) }}" title="{{ trans('orders.pay_order') }}"> 
                                        <i class="fa-solid fa-dollar-sign"></i>
                                    </a>
                                    @break
                                    @endcase

                                    @case('Expired')
                                    <a class="btn btn-primary btn-sm" href="{{ route('users/orders/pay', ['id' => $order->id]) }}" title="{{ trans('orders.pay_order') }}"> 
                                        <i class="fa-solid fa-dollar-sign"></i>
                                    </a>
                                    @break
                                    @endcase
                                @endswitch
                            </td>
                        </tr>
                    @endforeach
            </tbody>

        </table>
    </div>
@endsection