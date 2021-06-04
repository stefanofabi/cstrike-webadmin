@extends('staff.app')

@section('right-content')

    <div class="p-3 my-3 bg-primary text-white">
        <div class="btn-group float-right">
            <a  href="{{ route('staff/ranks/create') }}" class="btn btn-info"> <span class="fas fa-plus"> </span> {{ trans('ranks.create_rank') }} </a>
        </div>

        <h1> {{ trans('home.ranks') }} </h1>
        <p> {{trans('ranks.welcome_message') }} </p>
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
                            <td> {{ $rank->name }} </td>
                            <td> ${{ number_format($rank->price, 2, ',', '.') }} </td>

                            <td class="text-right">
                                <form id="destroy_rank_{{ $rank->id }}" method="POST" action="#">
                                    @csrf
                                    @method('DELETE')

                                    <a class="btn btn-info btn-sm float-right" title="{{ trans('ranks.destroy_rank') }}" onclick="destroyRank('{{ $rank->id }}')"> <i class="fas fa-trash fa-sm"> </i> </a>
                                </form>

                                <button type="button" class="btn btn-info btn-sm mr-3" data-toggle="modal" data-target="#editRank" onclick="return editRank('{{ $rank->id }}')" title="{{ trans('ranks.edit_rank') }}">
                                    <span class="fas fa-edit"></span>
                                </button>
                                
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