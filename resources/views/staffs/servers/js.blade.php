<script type="text/javascript">

    function seeGameChat(server) {
        var parameters = {
            "_token" : '{{ csrf_token() }}',
            "id" : server,
        };

        $.ajax({
            data:  parameters,
            url:   "{{ route('staffs/servers/see_game_chat') }}",
            type:  'post',
            dataType: 'json',
            beforeSend: function () {
                $("#modal_servers_game_chat_messages").html('<div class="spinner-border text-info"> </div> {{ trans("forms.please_wait") }} ');
            },
            success:  function (gameChats) {
                $("#modal_servers_game_chat_messages").html("");

                $('#myGameChatTable tbody').empty();

                gameChats.forEach(function(chat, index) {
                    var date = new Date(chat['date']).toLocaleString('es-ES', { day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit' });
                    var name = chat['name'];
                    var message = chat['message'];
                    var team = chat['team'];
                    var alive = chat['alive'];

                    var row = '<tr><td>' + date + '</td>';
                    row += "<td>";

                    if (! alive && team != 'SPEC') 
                        row += '<span class="fw-bold"> **DEAD** </span>';

                    switch (team) {
                        case 'T': {
                            row += '<span class="fw-bold text-danger">' + name + ' </span> : ' + message;
                            break;
                        }

                        case 'CT': {
                            row += '<span class="fw-bold text-primary">' + name + ' </span> : ' + message;
                            break;
                        }

                        case 'SPEC': {
                            row += '<span class="fw-bold text-secondary">' + name + ' </span> : ' + message;
                        }
                    } 

                    row += '</td> </tr>';
            
                    // Agregar la fila a la tabla
                    $('#myGameChatTable tbody').append(row);
                });



            }
        }).fail( function() {
            $("#modal_servers_game_chat_messages").html('<div class="alert alert-danger alert-dismissible fade show"> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> <strong> {{ trans("forms.danger") }}! </strong> {{ trans("servers.danger_edited_server") }} </div>');
        });

        return false;   	
	}
    
    function clearData() {

        $("#modal_server_id").val('');
        $("#modal_server_name").val('');
        $("#modal_server_ip").val('');
        $("#modal_ranking_url").val('');
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
                $("#modal_ranking_url").val(data['ranking_url']);
            }
        }).fail( function() {
            $("#modal_servers_messages").html('<div class="alert alert-danger alert-dismissible fade show"> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> <strong> {{ trans("forms.danger") }}! </strong> {{ trans("servers.danger_edited_server") }} </div>');
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
            "ranking_url" : $("#modal_ranking_url").val(),
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
    		$("#modal_servers_messages").html('<div class="alert alert-danger alert-dismissible fade show"> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> <strong> {{ trans("forms.danger") }}! </strong> {{ trans("servers.danger_edited_server") }} </div>');
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