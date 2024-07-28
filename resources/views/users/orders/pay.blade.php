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

    <div class="mt-3"> 
        <h2> <i class="fa-solid fa-cart-shopping"></i> {{ trans('payments.choose_your_payment_method') }} </h2>
        
        <a class="btn btn-primary mt-3" data-bs-toggle="collapse" href="#bankTransfer" role="button" aria-expanded="false" aria-controls="bankTransfer">
            <i class="fa-solid fa-building-columns"></i> {{ trans('payments.bank_transfer') }}
        </a>

        <a class="btn btn-primary mt-3" href="{{ $mercadopago['init_point'] ?? '#' }}"> <i class="fa-solid fa-handshake"></i> MercadoPago </a>

        <a class="btn btn-primary mt-3" href="{{ $paypal ?? '#' }}"> <i class="fa-brands fa-paypal"></i> PayPal </a>
    </div>

    <div class="collapse col-md-6 mt-3" id="bankTransfer">
        <div class="card card-body">
            <h5 class="card-title">Datos Bancarios</h5>
            <p><strong>{{ trans('payments.bank') }}:</strong> {{ CstrikeWebAdmin::getSystemParameterValueByKey('BANK') }} </p>
            <p><strong>{{ trans('payments.account_owner') }}:</strong> {{ CstrikeWebAdmin::getSystemParameterValueByKey('ACCOUNT_OWNER') }} </p>
            <p><strong>{{ trans('payments.owner_identification') }}:</strong> {{ CstrikeWebAdmin::getSystemParameterValueByKey('OWNER_IDENTIFICATION') }} </p>
            <p><strong>CBU:</strong> {{ CstrikeWebAdmin::getSystemParameterValueByKey('BANK_ACCOUNT_NUMBER') }} </p>
            <p><strong>Alias:</strong> {{ CstrikeWebAdmin::getSystemParameterValueByKey('BANK_ACCOUNT_ALIAS') }} </p>
        </div>

        <div class="mt-3 alert alert-info" role="alert">
            <h6><strong> {{trans('payments.important_note') }} </strong></h6>
            <p> {{ trans('payments.notify_payment') }} </p>
        </div>
    </div>


@endsection