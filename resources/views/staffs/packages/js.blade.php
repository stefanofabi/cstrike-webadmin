<script type="text/javascript">

    function managePrivileges(package) {

        var parameters = {
            "_token" : '{{ csrf_token() }}',
            "id" : package,
        };

        $.ajax({
            data:  parameters,
            url:   "{{ route('staffs/packages/get_privileges') }}",
            type:  'post',
            dataType: 'json',
            beforeSend: function () {
                $("#modal_manage_privileges_messages").html('<div class="spinner-border text-info"> </div> {{ trans("forms.please_wait") }} ');
            },
            success:  function (privileges) {
                $("#modal_manage_privileges_messages").html("");

                $('#myPrivilegesTable tbody').empty();

                // Load results
                $("#modal_manage_privileges_id").val(package);

                privileges.forEach(function(privilege, index) {
                    var privilege_id = privilege['id'];
                    var server = privilege['server'];
                    var rank = privilege['rank'];

                    var row = '<tr><td>' + server + '</td>';
                    row += "<td>" + rank +" </td>";
                    row += '<td class="text-end"> <a class="btn btn-primary btn-sm" title="' + "{{ trans('packages.destroy_privilege') }}" + '" onclick="destroyPrivilege(' + privilege_id +')"> <i class="fas fa-trash fa-sm"> </i> </a> </td>';
                    row += '</tr>';
            
                    // Agregar la fila a la tabla
                    $('#myPrivilegesTable tbody').append(row);
                });
            }
        }).fail( function() {
            $("#modal_manage_privileges_messages").html('<div class="alert alert-danger fade show"> <button type="button" class="close" data-dismiss="alert">&times;</button> <strong> {{ trans("forms.danger") }}! </strong> {{ trans("ranks.danger_edited_rank") }} </div>');
        });

        return false;   	
	}

    function destroyPrivilege(privilege) {
		var parameters = {
            "_token" : '{{ csrf_token() }}',
			"id" : privilege
		};

		$.ajax({
			data:  parameters,
			url:   "{{ route('staffs/packages/privileges/destroy') }}",
			type:  'post',
			beforeSend: function () {
				$("#modal_manage_privileges_messages").html('<div class="spinner-border text-info"> </div> {{ trans("forms.please_wait") }}');
			},
			success:  function (privilege) {
				$("#modal_manage_privileges_messages").html('<div class="alert alert-success fade show"> <strong> {{ trans("forms.well_done") }}! </strong> {{ trans("packages.success_store_privilege") }} </div>');
            
			}
		}).fail( function() {
    		$("#modal_manage_privileges_messages").html('<div class="alert alert-danger alert-dismissible fade show"> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> <strong> {{ trans("forms.danger") }}! </strong> {{ trans("packages.danger_already_server_assigned") }} </div>');
		});

        // It would be nice if there is a scroll to the message of the ajax result

		return false;   	
	}

    function storePrivilege() {
        var package_id = $("#modal_manage_privileges_id").val();

		var parameters = {
            "_token" : '{{ csrf_token() }}',
			"package_id" : $("#modal_manage_privileges_id").val(),
			"server_id" : $("#modal_manage_privileges_server").val(),
			"rank_id" : $("#modal_manage_privileges_rank").val(),
		};

		$.ajax({
			data:  parameters,
			url:   "{{ route('staffs/packages/privileges/store') }}",
			type:  'post',
			beforeSend: function () {
				$("#modal_manage_privileges_messages").html('<div class="spinner-border text-info"> </div> {{ trans("forms.please_wait") }}');
			},
			success:  function (privilege) {
				$("#modal_manage_privileges_messages").html('<div class="alert alert-success fade show"> <strong> {{ trans("forms.well_done") }}! </strong> {{ trans("packages.success_store_privilege") }} </div>');

                // Update the list of privileges
                var privilege_id = privilege['id'];
                var serverText = $('#modal_manage_privileges_server option:selected').text();
                var rankText = $('#modal_manage_privileges_rank option:selected').text();

                var row = '<tr><td>' + serverText + '</td>';
                row += "<td>" + rankText +" </td>";
                row += '<td class="text-end"> <a class="btn btn-primary btn-sm" title="' + "{{ trans('packages.destroy_privilege') }}" + '" onclick="destroyPrivilege(' + privilege_id +')"> <i class="fas fa-trash fa-sm"> </i> </a> </td>';
                row += '</tr>';
            
                // Agregar la fila a la tabla
                $('#myPrivilegesTable tbody').append(row);
			}
		}).fail( function() {
    		$("#modal_manage_privileges_messages").html('<div class="alert alert-danger alert-dismissible fade show"> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> <strong> {{ trans("forms.danger") }}! </strong> {{ trans("packages.danger_already_server_assigned") }} </div>');
		});

        // It would be nice if there is a scroll to the message of the ajax result

		return false;   	
	}

    function clearData() {
        $("#modal_package_id").val('');
        $("#modal_package_name").val('');
        $("#modal_package_price").val('');
    }
    
    function editPackage(package) {
        clearData();

        var parameters = {
            "_token" : '{{ csrf_token() }}',
            "id" : package,
        };

        $.ajax({
            data:  parameters,
            url:   "{{ route('staffs/packages/edit') }}",
            type:  'post',
            dataType: 'json',
            beforeSend: function () {
                $("#modal_packages_messages").html('<div class="spinner-border text-info"> </div> {{ trans("forms.please_wait") }} ');
            },
            success:  function (data) {
                $("#modal_packages_messages").html("");

                clearData();

                // Load results
                $("#modal_package_id").val(data['id']);
                $("#modal_package_name").val(data['name']);
                $("#modal_package_price").val(data['price']);

            }
        }).fail( function() {
            $("#modal_packages_messages").html('<div class="alert alert-danger fade show"> <button type="button" class="close" data-dismiss="alert">&times;</button> <strong> {{ trans("forms.danger") }}! </strong> {{ trans("ranks.danger_edited_rank") }} </div>');
        });

        return false;   	
	}

    function updatePackage() {
        var package_id = $("#modal_package_id").val();

		var parameters = {
            "_token" : '{{ csrf_token() }}',
			"id" : $("#modal_package_id").val(),
			"name" : $("#modal_package_name").val(),
			"price" : $("#modal_package_price").val(),
		};

		$.ajax({
			data:  parameters,
			url:   "{{ route('staffs/packages/update') }}",
			type:  'post',
			beforeSend: function () {
				$("#modal_packages_messages").html('<div class="spinner-border text-info"> </div> {{ trans("forms.please_wait") }}');
			},
			success:  function (response) {
				$("#modal_packages_messages").html('<div class="alert alert-success fade show"> <strong> {{ trans("forms.well_done") }}! </strong> {{ trans("ranks.success_updated_rank") }} </div>');

                // Update the list of packages
                $("#package_name_"+ package_id).html(parameters['name']);
                $("#package_price_"+ package_id).html('$'+parameters['price']);
			}
		}).fail( function() {
    		$("#modal_packages_messages").html('<div class="alert alert-danger fade show"> <button type="button" class="close" data-dismiss="alert">&times;</button> <strong> {{ trans("forms.danger") }}! </strong> {{ trans("ranks.danger_updated_rank") }} </div>');
		});

        // It would be nice if there is a scroll to the message of the ajax result

		return false;   	
	}

    function destroyPackage(package_id){
        if (confirm('{{ trans("forms.confirm") }}')) {
            var form = document.getElementById('destroy_package_'+package_id);
            form.submit();
        }
    }
</script>