<script>

    function clearData() 
    {

        $("#modal_system_parameter_id").val('');
        $("#modal_system_parameter_name").val('');
        $("#modal_system_parameter_category").val('');
        $("#modal_system_parameter_value").val('');
    }
    
    function editSystemParameter(parameter) {
        clearData();

        var parameters = {
            "_token" : '{{ csrf_token() }}',
            "id" : parameter,
        };

        $.ajax({
            data:  parameters,
            url:   "{{ route('staffs/system_parameters/edit') }}",
            type:  'post',
            dataType: 'json',
            beforeSend: function () {
                $("#modal_system_parameter_messages").html('<div class="spinner-border text-info"> </div> {{ trans("forms.please_wait") }} ');
            },
            success:  function (data) {
                $("#modal_system_parameter_messages").html("");

                // Load results
                $("#modal_system_parameter_id").val(data['id']);
                $("#modal_system_parameter_name").val(data['name']);
                $("#modal_system_parameter_category").val(data['category']);
                $("#modal_system_parameter_value").val(data['value']);
            }
        }).fail( function() {
            $("#modal_system_parameter_messages").html('<div class="alert alert-danger fade show"> <button type="button" class="close" data-dismiss="alert">&times;</button> <strong> {{ trans("forms.danger") }}! </strong> {{ trans("system_parameters.danger_edited_system_parameter") }} </div>');
        });

        return false;   	
	}

    function updateSystemParameter() 
    {
		var parameters = {
            "_token" : '{{ csrf_token() }}',
			"id" : $("#modal_system_parameter_id").val(),
			"value" : $("#modal_system_parameter_value").val(),
		};

		$.ajax({
			data:  parameters,
			url:   "{{ route('staffs/system_parameters/update') }}",
			type:  'post',
			beforeSend: function () {
				$("#modal_system_parameter_messages").html('<div class="spinner-border text-info"> </div> {{ trans("forms.please_wait") }}');
			},
			success:  function (response) {
				$("#modal_system_parameter_messages").html('<div class="alert alert-success fade show"> <strong> {{ trans("forms.well_done") }}! </strong> {{ trans("system_parameters.success_updated_system_parameter") }} </div>');

			}
		}).fail( function() {
    		$("#modal_system_parameter_messages").html('<div class="alert alert-danger fade show"> <button type="button" class="close" data-dismiss="alert">&times;</button> <strong> {{ trans("forms.danger") }}! </strong> {{ trans("system_parameters.danger_updated_system_parameter") }} </div>');
		});

        // It would be nice if there is a scroll to the message of the ajax result

		return false;   	
	}
</script>