@extends('users.app')

@section('right-content')
    <div class="p-3 my-3 bg-primary text-white">
        <h1> <span class="fas fa-credit-card"> </span> {{ trans('home.buy_administrator') }} </h1>
        <p class="col-9"> {{trans('administrators.buy_administrator_message') }} </p>
    </div>

    @if ($ranks->isNotEmpty())
        <div class="card">
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
                                    <td style="text-align: center;"> <i class="fas fa-times"></i> </td> 
                                @else
                                    <td style="text-align: center;"> <i class="fas fa-check"></i> </td> 
                                @endif
                            @endforeach
                        </tr>
                    @endforeach

                    <tr>    
                        <td> {{ trans('administrators.price_monthly') }} </td>

                        @foreach ($ranks as $rank)
                            <td style="text-align: center;">
                                ${{ $rank->price }}
                            </td>
                        @endforeach
                    </tr>

                    <tr style="text-align: center;">    
                        <td> </td>

                        @foreach ($ranks as $rank)
                            <td>
                                <a href="{{ $rank->purchase_link }}" target="_blank" class="btn btn-info" title="{{ trans('administrators.buy_now') }}"> {{ trans('administrators.buy_now') }} </a>
                            </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    @else 
        <div style="color: red"> {{ trans('administrators.no_places_availables') }} </div>
    @endif

@endsection