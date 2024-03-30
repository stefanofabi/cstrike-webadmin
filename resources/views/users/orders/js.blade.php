<script>

    function clearData() {

        $("#modal_order_id").val('');
        $("#modal_order_package").text('');
        $("#modal_order_expiration").text('');
        $("#modal_order_auth").val('');
        $("#modal_order_password").val('');
    }
    
    function editOrder(order) {
        clearData();

        var parameters = {
            "_token" : '{{ csrf_token() }}',
            "id" : order,
        };

        $.ajax({
            data:  parameters,
            url:   "{{ route('users/orders/edit') }}",
            type:  'post',
            dataType: 'json',
            beforeSend: function () {
                $("#modal_orders_messages").html('<div class="spinner-border text-info"> </div> {{ trans("forms.please_wait") }} ');
            },
            success:  function (data) {
                $("#modal_orders_messages").html("");

                var order = data['order'];
                var package = data['package'];

                $("#modal_order_id").val(order['id']);

                // Load results
                $("#modal_order_package").text(package['name']);
                $("#modal_order_expiration").text(order['expiration']);

                switch (order['status']) {
                    case 'Active': {
                        $("#modal_order_status").html('<span class="badge bg-success"> {{ trans('orders.active') }} </span>');
                        break;
                    }

                    case 'Expired': {
                        $("#modal_order_status").html('<span class="badge bg-danger"> {{ trans('orders.expired') }} </span>');
                        break;
                    }

                    case 'Pending': {
                        $("#modal_order_status").html('<span class="badge bg-warning"> {{ trans('orders.pending') }} </span>');
                        break;
                    }
                }

                $("#modal_order_auth").val(order['auth']);
                $("#modal_order_password").val(order['password']);
            }
        }).fail( function() {
            $("#modal_orders_messages").html('<div class="alert alert-danger alert-dismissible fade show"> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> <strong> {{ trans("forms.danger") }}! </strong> {{ trans("orders.danger_updated_order") }} </div>');
        });

        return false;   	
	}


    function updateOrder() {
        var order_id = $("#modal_order_id").val();

		var parameters = {
            "_token" : '{{ csrf_token() }}',
			"id" : $("#modal_order_id").val(),
            "auth" : $("#modal_order_auth").val(),
            "password" : $("#modal_order_password").val(),
		};

		$.ajax({
			data:  parameters,
			url:   "{{ route('users/orders/update') }}",
			type:  'post',
			beforeSend: function () {
				$("#modal_orders_messages").html('<div class="spinner-border text-info"> </div> {{ trans("forms.please_wait") }}');
			},
			success:  function (response) {
				$("#modal_orders_messages").html('<div class="alert alert-success fade show"> <strong> {{ trans("forms.well_done") }}! </strong> {{ trans("orders.success_updated_order") }} </div>');
                
			}
		}).fail( function(xhr) {
    		$("#modal_orders_messages").html('<div class="alert alert-danger alert-dismissible fade show"> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> <strong> {{ trans("forms.danger") }}! </strong> ' + xhr.responseJSON.message +' </div>');
		});

		return false;   	
	}
</script>