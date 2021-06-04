<script type="text/javascript">

    function clearData() {

        $("#modal_administrator_id").val('');
        $("#modal_administrator_name").val('');
        $("#modal_administrator_auth").val('');
        $("#modal_administrator_password").val('');
        $("#modal_administrator_expiration").val('');
        $("#modal_administrator_rank_id").val('');

        // All checkboxes
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
            url:   "{{ route('staff/administrators/edit') }}",
            type:  'post',
            dataType: 'json',
            beforeSend: function () {
                $("#modal_administrators_messages").html('<div class="spinner-border text-info"> </div> {{ trans("forms.please_wait") }} ');
            },
            success:  function (data) {
                $("#modal_administrators_messages").html("");

                var administrator = data['administrator'];
                var privileges = administrator['privileges'];

                // Load results
                $("#modal_administrator_id").val(administrator['id']);
                $("#modal_administrator_name").val(administrator['name']);
                $("#modal_administrator_auth").val(administrator['auth']);
                $("#modal_administrator_password").val(administrator['password']);
                var account_flags = administrator['account_flags'].split('');

                account_flags.forEach(function(account_flag, index) {
                    $('#flag_'+account_flag).attr('checked', true);
                });

                privileges.forEach(function(privilege, index) {
                    $('#server_'+privilege['server_id']).attr('checked', true);
                });

                $("#modal_administrator_expiration").val(administrator['expiration']);
                $("#modal_administrator_rank_id option[value='"+administrator['rank_id']+"']").attr("selected",true);
                    
            }
        }).fail( function() {
            $("#modal_administrators_messages").html('<div class="alert alert-danger fade show"> <button type="button" class="close" data-dismiss="alert">&times;</button> <strong> {{ trans("forms.danger") }}! </strong> {{ trans("administrators.danger_edited_administrator") }} </div>');
        });

        return false;   	
	}

    function updateAdministrator() {
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
		};

		$.ajax({
			data:  parameters,
			url:   "{{ route('staff/administrators/update') }}",
			type:  'post',
			beforeSend: function () {
				$("#modal_administrators_messages").html('<div class="spinner-border text-info"> </div> {{ trans("forms.please_wait") }}');
			},
			success:  function (response) {
				$("#modal_administrators_messages").html('<div class="alert alert-success fade show"> <strong> {{ trans("forms.well_done") }}! </strong> {{ trans("administrators.success_updated_administrator") }} </div>');
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