@extends('staff.app')

@section('js')
    @include('staff/administrators/js')
@endsection

@section('right-content')
    
    @include('staff/administrators/edit')

    <div class="p-3 my-3 bg-primary text-white">
        <div class="btn-group float-right">
            <a  href="{{ route('staff/administrators/create') }}" class="btn btn-info"> <span class="fas fa-user-plus"> </span> {{ trans('administrators.create_administrator') }} </a>
        </div>

        <h1> {{ trans('home.administrators') }} </h1>
        <p> {{trans('administrators.welcome_message') }} </p>
    </div>

    <div class="card">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th> {{ trans('administrators.name') }} </th>
                    <th> {{ trans('administrators.auth') }} </th>
                    <th> {{ trans('administrators.expiration') }} </th>
                    <th> {{ trans('ranks.rank') }}</th>
                    <th class="text-right"> {{ trans('forms.actions') }}</th>
                </tr>
            </thead>
            
            <tbody>
                @if ($administrators->isNotEmpty())
                    @foreach ($administrators as $administrator)
                        <tr>
                            <td> {{ $administrator->name }} </td>
                            <td> {{ $administrator->auth }} </td>
                            <td> {{ date('d/m/Y', strtotime($administrator->expiration)) }} </td>
                            <td> {{ $administrator->rank->name }} </td>

                            <td class="text-right">
                                <form id="destroy_administrator_{{ $administrator->id }}" method="POST" action="{{ route('staff/administrators/destroy', ['id' => $administrator->id]) }}">
                                    @csrf
                                    @method('DELETE')

                                    <a class="btn btn-info btn-sm float-right" title="{{ trans('administrators.destroy_administrator') }}" onclick="destroy_administrator('{{ $administrator->id }}')"> <i class="fas fa-user-slash fa-sm"> </i> </a>
                                </form>

                                <button type="button" class="btn btn-info btn-sm mr-3" data-toggle="modal" data-target="#editAdministrator" onclick="return editAdministrator('{{ $administrator->id }}')">
                                    <span class="fas fa-user-edit"></span>
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