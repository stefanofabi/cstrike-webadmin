@extends('users.app')

@section('title')
{{ trans('orders.pay_order') }}
@endsection

@section('menu-content', '')

@section('right-content')

    <div class="p-3 my-3 bg-primary text-white">
        <h1> <i class="fa-solid fa-dollar-sign"></i> {{ trans('orders.pay_order') }} </h1>
        <p class="col-9"> {{trans('orders.pay_order_message') }} </p>
    </div>

    <div> <h1> <i class="fa-solid fa-cube"></i> {{ trans('orders.order_number', ['id' => $order->id]) }}  </h1> </div>

    <div class="fs-5"> {{ trans('packages.package') }}: {{ $order->package->name }} </div>
    <div class="fs-5"> {{ trans('orders.status') }}: {{ $order->status }} </div>

    @if (! empty($order->expiration))
    <div class="fs-5 mt-3"> {{ trans('orders.expiration') }}: {{ $order->expiration }} </div>
    @endif

    <div class="mt-3">
        <div class="fs-5"> {{ trans('orders.auth') }}: {{ $order->auth }} </div>
        <div class="fs-5"> {{ trans('orders.password') }}: {{ $order->password }} </div>
    </div>

@endsection