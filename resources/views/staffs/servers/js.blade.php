<script type="text/javascript">

    function clearData() {

        $("#modal_server_id").val('');
        $("#modal_server_name").val('');
        $("#modal_server_ip").val('');
    }
    
    function editServer(server) {
        clearData();

        var parameters = {
            "_token" : '{{ csrf_token() }}',
            "id" : server,
        };

        $.ajax({
            data:  parameters,
            url:   "{{ route('staffs/servers/edit') }}",
            type:  'post',
            dataType: 'json',
            beforeSend: function () {
                $("#modal_servers_messages").html('<div class="spinner-border text-info"> </div> {{ trans("forms.please_wait") }} ');
            },
            success:  function (data) {
                $("#modal_servers_messages").html("");

                clearData();

                // Load results
                $("#modal_server_id").val(data['id']);
                $("#modal_server_name").val(data['name']);
                $("#modal_server_ip").val(data['ip']);
            }
        }).fail( function() {
            $("#modal_servers_messages").html('<div class="alert alert-danger fade show"> <button type="button" class="close" data-dismiss="alert">&times;</button> <strong> {{ trans("forms.danger") }}! </strong> {{ trans("servers.danger_edited_server") }} </div>');
        });

        return false;   	
	}

    function updateServer() {
        var server_id = $("#modal_server_id").val();

		var parameters = {
            "_token" : '{{ csrf_token() }}',
			"id" : $("#modal_server_id").val(),
			"name" : $("#modal_server_name").val(),
			"ip" : $("#modal_server_ip").val(),
		};
        
		$.ajax({
			data:  parameters,
			url:   "{{ route('staffs/servers/update') }}",
			type:  'post',
			beforeSend: function () {
				$("#modal_servers_messages").html('<div class="spinner-border text-info"> </div> {{ trans("forms.please_wait") }}');
			},
			success:  function (response) {
				$("#modal_servers_messages").html('<div class="alert alert-success fade show"> <strong> {{ trans("forms.well_done") }}! </strong> {{ trans("servers.success_updated_server") }} </div>');

                // Update the list of servers
                $("#server_name_"+server_id).html(parameters['name']);
                $("#server_ip_"+server_id).html(parameters['ip']);
			}
		}).fail( function() {
    		$("#modal_servers_messages").html('<div class="alert alert-danger fade show"> <button type="button" class="close" data-dismiss="alert">&times;</button> <strong> {{ trans("forms.danger") }}! </strong> {{ trans("servers.danger_updated_server") }} </div>');
		});

        // It would be nice if there is a scroll to the message of the ajax result

		return false;   	
	}

    function destroyServer(server_id){
        if (confirm('{{ trans("forms.confirm") }}')) {
            var form = document.getElementById('destroy_server_'+server_id);
            form.submit();
        }
    }
</script>