@extends('layouts.app')

@section('title')
{{ trans('bans.details_ban') }}
@endsection

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> <h4> <strong> {{ trans('bans.details_ban') }} </strong> </h4> </div>

                <div class="card-body">{{ trans('bans.details_ban_message') }}</div>

                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td style="width: 150px"> <strong> {{ trans('bans.name') }}: </strong> </td>
                            <td> {{ $ban->name }} </td>
                        </tr>

                        <tr>
                            <td> <strong> {{ trans('bans.steam_id') }}: </strong> </td>
                            <td> {{ $ban->steam_id }} </td>
                        </tr>

                        <tr>
                            <td> <strong> {{ trans('bans.ip') }}: </strong> </td>
                            <td> {{ $ban->ip }} </td>
                        </tr>

                        <tr>
                            <td> <strong> {{ trans('bans.date') }}: </strong> </td>
                            <td> {{ $ban->date }} </td>
                        </tr>

                        <tr>
                            <td> <strong> {{ trans('bans.expiration') }}: </strong> </td>
                            <td> @if (empty($ban->expiration)) {{ trans('bans.permanently') }} @else {{ $ban->expiration }} @endif  </td>
                        </tr>

                        <tr>
                            <td> <strong> {{ trans('bans.reason') }}: </strong> </td>
                            <td> {{ $ban->reason }} </td>
                        </tr>

                        @if ($ban->administrator)
                            <tr>
                                <td> <strong> {{ trans('bans.administrator_name') }}: </strong> </td>
                                <td> {{ $ban->administrator->name }} </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
