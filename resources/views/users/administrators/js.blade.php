<script>

    function clearData() {

        $("#modal_administrator_name").text('');
        $("#modal_administrator_auth").text('');
        $("#modal_administrator_password").text('');
        $("#modal_administrator_rank").text('');
        $("#modal_administrator_server").text('');
        $("#modal_administrator_status").text('');
        $("#modal_administrator_suspended").text('');
        
        // Uncheck all checkboxes
        $('input:checkbox').attr('checked', false);
    }
    
    function seeAdministrator(administrator) {
        clearData();

        var parameters = {
            "_token" : '{{ csrf_token() }}',
            "id" : administrator,
        };

        $.ajax({
            data:  parameters,
            url:   "{{ route('users/administrators/edit') }}",
            type:  'post',
            dataType: 'json',
            beforeSend: function () {
                $("#modal_users_messages").html('<div class="spinner-border text-info"> </div> {{ trans("forms.please_wait") }} ');
            },
            success:  function (data) {
                $("#modal_users_messages").html("");

                var administrator = data['administrator'];
                var rank = data['rank'];
                var server = data['server'];

                // Load results
                $("#modal_administrator_name").text(administrator['name']);
                $("#modal_administrator_auth").text(administrator['auth']);
                $("#modal_administrator_password").text(administrator['password']);
                $("#modal_administrator_rank").text(rank['name']);

                var account_flags = administrator['account_flags'].split('');

                account_flags.forEach(function(account_flag, index) {
                    $('#flag_'+account_flag).attr('checked', true);
                });

                $("#modal_administrator_server").text(server['name']);

                switch (administrator['status']) {
                    case 'Active': {
                        $("#modal_administrator_status").html('<span class="badge bg-success"> {{ trans('administrators.active') }} </span>');
                        break;
                    }

                    case 'Suspended': {
                        $("#modal_administrator_status").html('<span class="badge bg-danger"> {{ trans('administrators.suspended') }} </span>');
                        break;
                    }

                    case 'Expired': {
                        $("#modal_administrator_status").html('<span class="badge bg-warning"> {{ trans('administrators.expired') }} </span>');
                        break;
                    }
                }

                $('#modal_administrator_expiration').text(administrator['expiration']);
                
                if (administrator['status'] == 'Suspended') {
                    $('#suspendAdministratorDiv').removeClass('d-none');
                    $('#modal_administrator_suspended').text(administrator['suspended']);
                } else {
                    $('#suspendAdministratorDiv').addClass('d-none');
                }
            }
        }).fail( function() {
            $("#modal_users_messages").html('<div class="alert alert-danger alert-dismissible fade show" role="alert"> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> <strong> {{ trans("forms.danger") }}! </strong> {{ trans("administrators.danger_edited_administrator") }} </div>');
        });

        return false;   	
	}
</script>