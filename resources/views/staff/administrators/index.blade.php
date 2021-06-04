@extends('staff.app')

@section('js')
    
    @include('staff/administrators/js')

    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();

            $('#rank').val("{{ @old('rank_id') }}");
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
                            <td>
                                {{ date('d/m/Y', strtotime($administrator->expiration)) }}
                                @if (!empty($administrator->expiration) && date('Y-m-d') > $administrator->expiration)
                                    <span class="badge badge-danger"> {{ trans('administrators.expired') }}</span>  
                                @endif                         
                            </td>
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