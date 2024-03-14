<script>

    function clearData() {

        $("#modal_administrator_id").val('');
        $("#modal_administrator_name").val('');
        $("#modal_administrator_auth").val('');
        $("#modal_administrator_password").val('');
        $("#modal_administrator_expiration").val('');
        $("#modal_administrator_account").val('');

        // Uncheck all checkboxes
        $('input:checkbox').attr('checked', false);
    }
    
    function editAdministrator(administrator) {
        clearData();

        var parameters = {
            "_token" : '{{ csrf_token() }}',
            "id" : administrator,
        };

        $.ajax({
            data:  parameters,
            url:   "{{ route('staffs/administrators/edit') }}",
            type:  'post',
            dataType: 'json',
            beforeSend: function () {
                $("#modal_administrators_messages").html('<div class="spinner-border text-info"> </div> {{ trans("forms.please_wait") }} ');
            },
            success:  function (data) {
                $("#modal_administrators_messages").html("");

                var administrator = data['administrator'];
                var privileges = administrator['privileges'];
                var user = administrator['user'];

                // Load results
                $("#modal_administrator_id").val(administrator['id']);
                $("#modal_administrator_name").val(administrator['name']);
                $("#modal_administrator_auth").val(administrator['auth']);
                $("#modal_administrator_password").val(administrator['password']);
                
                var account_flags = administrator['account_flags'].split('');

                account_flags.forEach(function(account_flag, index) {
                    $('#flag_'+account_flag).attr('checked', true);
                });

                $("#modal_server_id").val(administrator['server_id']);


                $("#modal_administrator_expiration").val(administrator['expiration']);
                $("#modal_administrator_rank_id option[value='"+administrator['rank_id']+"']").attr("selected",true);

                if (user) {
                    $("#modal_administrator_account").val(user['email']);
                    $("#modal_user_id").val(administrator['user_id']);     
                }
                
                if (administrator['suspended'] !== null) {
                    $('#modal_suspend_administrator').attr('checked', true);
                }
            }
        }).fail( function() {
            $("#modal_administrators_messages").html('<div class="alert alert-danger fade show"> <button type="button" class="close" data-dismiss="alert">&times;</button> <strong> {{ trans("forms.danger") }}! </strong> {{ trans("administrators.danger_edited_administrator") }} </div>');
        });

        return false;   	
	}

    function updateAdministrator() {
        var administrator_id = $("#modal_administrator_id").val();

		var parameters = {
            "_token" : '{{ csrf_token() }}',
			"id" : $("#modal_administrator_id").val(),
			"name" : $("#modal_administrator_name").val(),
			"auth" : $("#modal_administrator_auth").val(),
            "password" : $("#modal_administrator_password").val(),
            "account_flags" : JSON.stringify($('[name="account_flags[]"]').serializeArray()),
            "servers" : JSON.stringify($('[name="servers[]"]').serializeArray()),
            "expiration" : $("#modal_administrator_expiration").val(),
            "rank_id" : $("#modal_administrator_rank_id").val(),
            "user_id" : $("#modal_user_id").val(),
            "server_id" : $("#modal_server_id").val(),
            "suspended" : $('#modal_suspend_administrator').prop('checked')
		};

		$.ajax({
			data:  parameters,
			url:   "{{ route('staffs/administrators/update') }}",
			type:  'post',
			beforeSend: function () {
				$("#modal_administrators_messages").html('<div class="spinner-border text-info"> </div> {{ trans("forms.please_wait") }}');
			},
			success:  function (response) {
				$("#modal_administrators_messages").html('<div class="alert alert-success fade show"> <strong> {{ trans("forms.well_done") }}! </strong> {{ trans("administrators.success_updated_administrator") }} </div>');

                // Update the list of administrators
                $("#administrator_name_"+administrator_id).html(parameters['name']);
                $("#administrator_auth_"+administrator_id).html(parameters['auth']);
                $("#administrator_expiration_"+administrator_id).html(parameters['expiration']);
                $("#administrator_rank_"+administrator_id).html($( "#modal_administrator_rank_id option:selected" ).text());
			}
		}).fail( function() {
    		$("#modal_administrators_messages").html('<div class="alert alert-danger fade show"> <button type="button" class="close" data-dismiss="alert">&times;</button> <strong> {{ trans("forms.danger") }}! </strong> {{ trans("administrators.danger_updated_administrator") }} </div>');
		});

        // It would be nice if there is a scroll to the message of the ajax result

		return false;   	
	}

    function destroy_administrator(administrator_id){
        if (confirm('{{ trans("forms.confirm") }}')) {
            var form = document.getElementById('destroy_administrator_'+administrator_id);
            form.submit();
        }
    }
</script>