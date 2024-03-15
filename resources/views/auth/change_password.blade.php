@extends('layouts.app')

@section('title')
{{ trans('auth.change_password') }}
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ trans('auth.change_password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('auth/change_password') }}">
                        @csrf

                        <div class="row">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ trans('auth.current_password') }}</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" value="{{ old('current_password') }}" required autofocus>

                                @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end"> {{ trans('auth.new_password') }} </label>

                            <div class="col-md-6">
                                <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" required>

                                @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end"> {{ trans('auth.confirm_password') }} </label>

                            <div class="col-md-6">
                                <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" required>

                                @error('confirm_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ trans('forms.submit') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
