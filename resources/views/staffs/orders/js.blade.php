<script type="text/javascript">

    function clearData() {
        $("#modal_order_id").val('');
        $("#modal_order_package").val('');
        $("#modal_order_auth").val('');
        $("#modal_order_expiration").val('');
        $("#modal_order_price").val('');
        
        $("#modal_order_number").html('');
        $("#modal_order_user_name").html('');
        $("#modal_order_user_email").html('');
        $("#modal_order_date").html('');
        $("#modal_order_status").html('');
    }
    
    function editOrder(order) {
        clearData();

        var parameters = {
            "_token" : '{{ csrf_token() }}',
            "id" : order,
        };

        $.ajax({
            data:  parameters,
            url:   "{{ route('staffs/orders/edit') }}",
            type:  'post',
            dataType: 'json',
            beforeSend: function () {
                $("#modal_orders_messages").html('<div class="spinner-border text-info"> </div> {{ trans("forms.please_wait") }} ');
            },
            success:  function (data) {
                $("#modal_orders_messages").html("");

                clearData();

                var order = data['order'];
                var user = data['user'];
                
                // Load results
                $("#modal_order_id").val(order['id']);
                $("#modal_order_number").html(order['id']);
                $("#modal_order_user_name").html(user['name']);
                $("#modal_order_user_email").html(user['email']);
                $("#modal_order_date").html(order['date']);
                $("#modal_order_status").html(order['status']);
                $("#modal_order_package").val(order['package_id']);
                $("#modal_order_auth").val(order['auth']);
                $("#modal_order_password").val(order['password']);
                $("#modal_order_expiration").val(order['expiration']);
                $("#modal_order_price").val(order['price']);

            }
        }).fail( function() {
            $("#modal_orders_messages").html('<div class="alert alert-danger fade show"> <button type="button" class="close" data-dismiss="alert">&times;</button> <strong> {{ trans("forms.danger") }}! </strong> {{ trans("orders.danger_edited_order") }} </div>');
        });

        return false;   	
	}

    function updateOrder() {
        var order_id = $("#modal_order_id").val();

		var parameters = {
            "_token" : '{{ csrf_token() }}',
			"id" : $("#modal_order_id").val(),
			"package_id" : $("#modal_order_package").val(),
            "auth" : $("#modal_order_auth").val(),
            "password" : $("#modal_order_password").val(),
            "expiration" : $("#modal_order_expiration").val(),
			"price" : $("#modal_order_price").val(),
		};

		$.ajax({
			data:  parameters,
			url:   "{{ route('staffs/orders/update') }}",
			type:  'post',
			beforeSend: function () {
				$("#modal_orders_messages").html('<div class="spinner-border text-info"> </div> {{ trans("forms.please_wait") }}');
			},
			success:  function (response) {
				$("#modal_orders_messages").html('<div class="alert alert-success fade show"> <strong> {{ trans("forms.well_done") }}! </strong> {{ trans("orders.success_updated_order") }} </div>');

                var selected_package = $("#modal_order_package option:selected").text();
                $("#order_package_"+order_id).html(selected_package);
			}
		}).fail( function() {
    		$("#modal_orders_messages").html('<div class="alert alert-danger fade show"> <button type="button" class="close" data-dismiss="alert">&times;</button> <strong> {{ trans("forms.danger") }}! </strong> {{ trans("orders.danger_updated_order") }} </div>');
		});

        // It would be nice if there is a scroll to the message of the ajax result

		return false;   	
	}

    function destroyOrder(order_id) {
        if (confirm('{{ trans("forms.confirm") }}')) {
            var form = document.getElementById('destroy_order_'+order_id);
            form.submit();
        }
    }

    function activateOrder(order_id) {
        if (confirm('{{ trans("forms.confirm") }}')) {
            var form = document.getElementById('activate_order_'+order_id);
            form.submit();
        }
    }

    function cancelOrder(order_id) {
        if (confirm('{{ trans("forms.confirm") }}')) {
            var form = document.getElementById('cancel_order_'+order_id);
            form.submit();
        }
    }

    function renewOrder(order_id) {
        if (confirm('{{ trans("forms.confirm") }}')) {
            var form = document.getElementById('renew_order_'+order_id);
            form.submit();
        }
    }
</script>