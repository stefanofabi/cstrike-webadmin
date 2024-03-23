@extends('layouts.app')

@section('title')
{{ trans('home.buy_administrator') }}
@endsection

@section('content')
    <div class="p-3 my-3 bg-primary text-white">
        <h1> <span class="fas fa-credit-card"> </span> {{ trans('home.buy_administrator') }} </h1>
        <p class="col-9"> {{trans('administrators.buy_administrator_message') }} </p>
    </div>

    <div class="mt-3"> <h1> <i class="fa-solid fa-cube"></i> {{ trans('packages.administrators_packages_for_sale') }} </h1> </div>

    @if ($packages->isNotEmpty())
        <div class="row mt-4">
            @foreach ($packages as $package)
            @if ($package->privileges->isEmpty()) @continue @endif

            <div class="col-md-3">
                <div class="card mb-3 h-100 text-center" style="max-width: 18rem;">
                    <div class="card-body">
                        <div class="card-title"> <h5 class="fw-bold"> {{ $package->name }} </h5> <hr> </div>
                        <p class="card-text mt-3"> {{ $package->description }} </p>

                        <div>

                        <div> {{ trans('packages.package_includes_privileges') }}: </div>
                        @foreach ($package->privileges as $privilege)
                        <div> <i class="fa-solid fa-crown"></i> {{ $privilege->server->name }} {{ $privilege->rank->name}} </div>
                        @endforeach

                        
                        </div>
                    </div>

                    <div class="card-footer bg-white p-3"> 
                        <a class="btn btn-primary @guest disabled @endguest" title="{{ trans('packages.buy_now_for', ['price' => $package->price]) }}" href="{{ route('users/orders/create') }}" target="_blank"> {{ trans('packages.buy_now_for', ['price' => $package->price]) }} </a> 
                        @guest <div class="mt-2"> <a href="{{ route('login') }}"> {{ trans('orders.login_before_purchasing') }} </a> </div> @endguest
                    </div>
                    
                </div>
            </div>
            @endforeach
        </div>
    @else 
        <div style="color: red"> {{ trans('administrators.no_places_availables') }} </div>
    @endif

    @if ($ranks->isNotEmpty())
        <div class="mt-5"> <h1> <i class="fa-solid fa-crown"></i> {{ trans('packages.types_of_administrators') }}</h1> </div>

        <div class="card mt-3 mb-5">
            <table class="table table-striped">
                <thead>
                    <tr style="text-align: center;">
                        <th> </th>

                        @foreach ($ranks as $rank)
                            <th> {{ $rank->name }} </th>
                        @endforeach
                    </tr>
                </thead>
                
                <tbody>
                    @foreach ($flags as $flag)
                        <tr>
                            <td> {{ $flag['name'] }} </td> 

                            @foreach ($ranks as $rank)
                                @if (strpos($rank->access_flags, $flag['letter']) === false)
                                    <td style="text-align: center;"> <i class="fas fa-times text-danger"></i> </td> 
                                @else
                                    <td style="text-align: center;"> <i class="fas fa-check text-success"></i> </td> 
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else 
        <div style="color: red"> {{ trans('administrators.no_places_availables') }} </div>
    @endif

@endsection