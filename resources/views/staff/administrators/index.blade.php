@extends('staff.app')

@section('js')
    <script type="text/javascript">

        function editAdministrator(administrator) {

            var parameters = {
                "id" : administrator,
                "_token" : '{{ csrf_token() }}'
            };

            $.ajax({
                data:  parameters,
                url:   "{{ route('staff/administrators/edit') }}",
                type:  'post',
                dataType: 'json',
                beforeSend: function () {
                    $("#modal_administrators_messages").html('<div class="spinner-border text-info"> </div> {{ trans("forms.please_wait") }} ');
                },
                success:  function (data) {
                    $("#modal_administrators_messages").html("");
                    
                    // Load results
                    $("#modal_administrator_id").val(data['id']);
                    $("#modal_administrator_name").val(data['name']);
                    $("#modal_administrator_auth").val(data['auth']);
                    $("#modal_administrator_password").val(data['password']);
                    $("#modal_administrator_account_flag").val(data['account_flag']);
                    $("#modal_administrator_expiration").val(data['expiration']);
                    $("#modal_administrator_rank_id option[value='"+data['rank_id']+"']").attr("selected",true);

                }
            }).fail( function() {
                $("#modal_administrators_messages").html('<div class="alert alert-danger fade show"> <button type="button" class="close" data-dismiss="alert">&times;</button> <strong> {{ trans("forms.danger") }}! </strong> {{ trans("administrators.danger_edited_administrator") }} </div>');
            });

            return false;   	
	    }

        function destroy_administrator(administrator_id){
            if (confirm('{{ trans("forms.confirm") }}')) {
                var form = document.getElementById('destroy_administrator_'+administrator_id);
                form.submit();
            }
        }
    </script>
@endsection

@section('right-content')
    
    @include('staff/administrators/edit')

    <div class="p-3 my-3 bg-primary text-white">
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