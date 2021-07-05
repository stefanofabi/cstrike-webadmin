@extends('staffs.app')

@section('title')
{{ trans('home.ranks') }}
@endsection

@section('js')
    @include('staffs.ranks.js')
@endsection

@section('right-content')

    @include('staffs.ranks.edit')

    <div class="p-3 my-3 bg-primary text-white">
        <div class="btn-group float-right">
            <a  href="{{ route('staffs/ranks/create') }}" class="btn btn-info"> <span class="fas fa-user-plus"> </span> {{ trans('ranks.create_rank') }} </a>
        </div>

        <h1> <span class="fas fa-user-tag"> </span> {{ trans('home.ranks') }} </h1>
        <p class="col-9"> {{trans('ranks.welcome_message') }} </p>
    </div>

    <div class="card">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th> {{ trans('ranks.name') }} </th>
                    <th> {{ trans('ranks.price') }} </th>
                    <th class="text-right"> {{ trans('forms.actions') }}</th>
                </tr>
            </thead>
            
            <tbody>
                @if ($ranks->isNotEmpty())
                    @foreach ($ranks as $rank)
                        <tr>
                            <td id="rank_name_{{ $rank->id }}"> {{ $rank->name }} </td>
                            <td id="rank_price_{{ $rank->id }}"> ${{ number_format($rank->price, 2, ',', '.') }} </td>

                            <td class="float-right form-inline">          
                                <button type="button" class="btn btn-info btn-sm mr-1 mb-1" data-toggle="modal" data-target="#editRank" onclick="return editRank('{{ $rank->id }}')" title="{{ trans('ranks.edit_rank') }}">
                                    <span class="fas fa-edit"></span>
                                </button>

                                <form id="destroy_rank_{{ $rank->id }}" method="POST" action=" {{ route('staffs/ranks/destroy', ['id' => $rank->id]) }}">
                                    @csrf
                                    @method('DELETE')

                                    <a class="btn btn-info btn-sm mb-1" title="{{ trans('ranks.destroy_rank') }}" onclick="destroyRank('{{ $rank->id }}')"> <i class="fas fa-trash fa-sm"> </i> </a>
                                </form>                               
                            </td>
                        </tr>
                    @endforeach
                @else 
                    <td colspan="5"> {{ trans('forms.no_data' )}} </td>
                @endif
            </tbody>

        </table>
    </div>
@endsection