<script type="text/javascript">

    function setBanExpiration(minutes) {

        // Ban permanently
        if (minutes == "") {
            $("#modal_ban_expiration").val(''); 
            return;  
        }

        var dateVal = new Date();

        dateVal.setMinutes(dateVal.getMinutes() + parseInt(minutes, 10));

        var day = dateVal.getDate().toString().padStart(2, "0");
        var month = (1 + dateVal.getMonth()).toString().padStart(2, "0");
        var hour = dateVal.getHours().toString().padStart(2, "0");
        var minute = dateVal.getMinutes().toString().padStart(2, "0");

        var inputDate = dateVal.getFullYear() + "-" + (month) + "-" + (day) + "T" + (hour) + ":" + (minute);

        $("#modal_ban_expiration").val(inputDate);   
    }

    function clearData() {

        $("#modal_ban_name").val('');
        $("#modal_ban_steam_id").val('');
        $("#modal_ban_ip").val('');
        $("#modal_ban_reason").val('');
        $("#modal_ban_server_id").val('');
        $("#modal_ban_expiration").val('');
        $("#modal_ban_private_notes").val('');

    }
    
    function editBan(ban) {
        clearData();

        var parameters = {
            "_token" : '{{ csrf_token() }}',
            "id" : ban,
        };

        $.ajax({
            data:  parameters,
            url:   "{{ route('staffs/bans/edit') }}",
            type:  'post',
            dataType: 'json',
            beforeSend: function () {
                $("#modal_bans_messages").html('<div class="spinner-border text-info"> </div> {{ trans("forms.please_wait") }} ');
            },
            success:  function (data) {
                $("#modal_bans_messages").html("");
                
                // Load results
                $("#modal_ban_id").val(data['id']);
                $("#modal_ban_name").val(data['name']);
                $("#modal_ban_steam_id").val(data['steam_id']);
                $("#modal_ban_ip").val(data['ip']);                
                $("#modal_ban_expiration").val(data['expiration']);

                $("#modal_ban_reason").val(data['reason']);
                $("#modal_ban_server_id").val(data['server_id']);
                $("#modal_ban_private_notes").val(data['private_notes']);
                
            }
        }).fail( function() {
            $("#modal_bans_messages").html('<div class="alert alert-danger fade show"> <button type="button" class="close" data-dismiss="alert">&times;</button> <strong> {{ trans("forms.danger") }}! </strong> {{ trans("bans.danger_edited_ban") }} </div>');
        });

        return false;   	
	}

    function updateBan() {
        var ban_id = $("#modal_ban_id").val();

		var parameters = {
            "_token" : '{{ csrf_token() }}',
			"id" : $("#modal_ban_id").val(),
			"name" : $("#modal_ban_name").val(),
            "steam_id" : $("#modal_ban_steam_id").val(),
			"ip" : $("#modal_ban_ip").val(),
            "reason" : $("#modal_ban_reason").val(),
            "server_id" : $("#modal_ban_server_id").val(),
            "expiration" : $("#modal_ban_expiration").val(),
            "private_notes" : $("#modal_ban_private_notes").val(),
		};
        
		$.ajax({
			data:  parameters,
			url:   "{{ route('staffs/bans/update') }}",
			type:  'post',
			beforeSend: function () {
				$("#modal_bans_messages").html('<div class="spinner-border text-info"> </div> {{ trans("forms.please_wait") }}');
			},
			success:  function (response) {
				$("#modal_bans_messages").html('<div class="alert alert-success fade show"> <strong> {{ trans("forms.well_done") }}! </strong> {{ trans("bans.success_updated_ban") }} </div>');

                // Update the list of servers
                $("#ban_name_"+ban_id).html(parameters['name']);

                if (parameters['steam_id'] == "") {
                    $("#ban_steam_id_"+ban_id).html("{{ trans('bans.not_apply') }}");
                } else {
                    $("#ban_steam_id_"+ban_id).html(parameters['steam_id']);        
                }

                if (parameters['ip'] == "") {
                    $("#ban_ip_"+ban_id).html("{{ trans('bans.not_apply') }}");
                } else {
                    $("#ban_ip_"+ban_id).html(parameters['ip']);        
                }

                if (parameters['expiration'] == "") {
                    $("#ban_expiration_"+ban_id).html("{{ trans('bans.never') }}");
                } else {
                    $("#ban_expiration_"+ban_id).html(parameters['expiration']);        
                }
                
			}
		}).fail( function(response) {
    		$("#modal_bans_messages").html('<div class="alert alert-danger fade show"> <button type="button" class="close" data-dismiss="alert">&times;</button> <strong> {{ trans("forms.danger") }}! </strong> '+response.responseJSON['message']+' </div>');
		});

        // It would be nice if there is a scroll to the message of the ajax result

		return false;   	
	}

    function destroyBan(ban_id){
        if (confirm('{{ trans("forms.confirm") }}')) {
            var form = document.getElementById('destroy_ban_'+ban_id);
            form.submit();
        }
    }
</script>