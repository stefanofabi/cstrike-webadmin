@extends('users.app')

@section('title')
{{ trans('orders.create_order') }}
@endsection

@section('js')
    <script type="module">
        $(document).ready(function(){
            $('#package').val("{{ $package->id ?? old('package_id') }}");
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

@section('menu-content', '')

@section('right-content')

    <div class="p-3 my-3 bg-primary text-white">
        <h1> {{ trans('orders.create_order') }} </h1>
        <p class="col-9"> {{trans('orders.create_order_message') }} </p>
    </div>

    <form action="{{ route('users/orders/store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-9 mt-3">
                <h5> <strong>{{ trans('orders.package') }}: </strong> </h5>

                <select class="form-select" name="package_id" id="package" required>
                    <option value="">  {{ trans('forms.select_option') }} </option>
                        
                    @foreach ($packages as $package)
                        <option value="{{ $package->id }}">  {{ $package->name }} ${{ $package->price }} </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-9 mt-3">
                <label for="name"> <h5> <strong> {{ trans('orders.auth') }}: </h5> </strong> </label>
                
                <input type="text" class="form-control" placeholder="{{ trans('orders.enter_your_tag') }}" name="auth" value="{{ old('auth') }}" required minlength="4" maxlength="32">
                <div class="fst-italic"> {{ trans('orders.tag_requirements') }} </div>
            </div>

            <div class="col-md-9 mt-3">
                <label for="name"> <h5> <strong> {{ trans('orders.password') }}: </h5> </strong> </label>
                
                <input type="password" class="form-control password1" placeholder="{{ trans('administrators.enter_password') }}" name="password" required minlength="4" maxlength="20">
                <div class="col-12"> <span class="fa fa-fw fa-eye password-icon show-password"></span> </div>
                <div class="fst-italic"> {{ trans('orders.password_requirements') }} </div>
            </div>
            
        </div>

        <button type="submit" class="btn btn-primary mb-3 mt-4"> {{ trans('orders.order_now') }}</button>
    </form>
@endsection