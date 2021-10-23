<script type="text/javascript">


    $(document).ready(function(){

        $("#checkAll").click(function () {  
                
            if ($('#checkAll').val() == 'on') {
                $('#checkAll').val('off');
                $('input:checkbox').attr('checked', false);
            } else {
                $('#checkAll').val('on');
                $('input:checkbox').attr('checked', true);
            }
        });
    });

    function clearData() {

        $("#modal_rank_id").val('');
        $("#modal_rank_name").val('');
        $("#modal_rank_price").val('');
        $("#modal_rank_color").val('');
        $("#modal_rank_purchase_link").val('');
        
        // All checkboxes
        $('input:checkbox').attr('checked', false);
    }
    
    function editRank(rank) {
        clearData();

        var parameters = {
            "_token" : '{{ csrf_token() }}',
            "id" : rank,
        };

        $.ajax({
            data:  parameters,
            url:   "{{ route('staffs/ranks/edit') }}",
            type:  'post',
            dataType: 'json',
            beforeSend: function () {
                $("#modal_ranks_messages").html('<div class="spinner-border text-info"> </div> {{ trans("forms.please_wait") }} ');
            },
            success:  function (data) {
                $("#modal_ranks_messages").html("");

                clearData();

                // Load results
                $("#modal_rank_id").val(data['id']);
                $("#modal_rank_name").val(data['name']);
                $("#modal_rank_price").val(data['price']);
                $("#modal_rank_color").val(data['color']);
                $("#modal_rank_purchase_link").val(data['purchase_link']);

                var access_flags = data['access_flags'].split('');

                access_flags.forEach(function(access_flag, index) {
                    $('#flag_'+access_flag).attr('checked', true);
                });
            }
        }).fail( function() {
            $("#modal_ranks_messages").html('<div class="alert alert-danger fade show"> <button type="button" class="close" data-dismiss="alert">&times;</button> <strong> {{ trans("forms.danger") }}! </strong> {{ trans("ranks.danger_edited_rank") }} </div>');
        });

        return false;   	
	}

    function updateRank() {
        var rank_id = $("#modal_rank_id").val();

		var parameters = {
            "_token" : '{{ csrf_token() }}',
			"id" : $("#modal_rank_id").val(),
			"name" : $("#modal_rank_name").val(),
			"price" : $("#modal_rank_price").val(),
            "purchase_link" : $("#modal_rank_purchase_link").val(),
            "color" : $("#modal_rank_color").val(),
            "access_flags" : JSON.stringify($('[name="access_flags[]"]').serializeArray()),
		};

        console.log(parameters['access_flags']);
        
		$.ajax({
			data:  parameters,
			url:   "{{ route('staffs/ranks/update') }}",
			type:  'post',
			beforeSend: function () {
				$("#modal_ranks_messages").html('<div class="spinner-border text-info"> </div> {{ trans("forms.please_wait") }}');
			},
			success:  function (response) {
				$("#modal_ranks_messages").html('<div class="alert alert-success fade show"> <strong> {{ trans("forms.well_done") }}! </strong> {{ trans("ranks.success_updated_rank") }} </div>');

                // Update the list of ranks
                $("#rank_name_"+rank_id).html(parameters['name']);
                $("#rank_price_"+rank_id).html('$'+parameters['price']);
			}
		}).fail( function() {
    		$("#modal_ranks_messages").html('<div class="alert alert-danger fade show"> <button type="button" class="close" data-dismiss="alert">&times;</button> <strong> {{ trans("forms.danger") }}! </strong> {{ trans("ranks.danger_updated_rank") }} </div>');
		});

        // It would be nice if there is a scroll to the message of the ajax result

		return false;   	
	}

    function destroyRank(rank_id){
        if (confirm('{{ trans("forms.confirm") }}')) {
            var form = document.getElementById('destroy_rank_'+rank_id);
            form.submit();
        }
    }
</script>