<script type="text/javascript">

        function editAdministrator(administrator) {

            var parameters = {
                "id" : administrator,
                "_token" : '{{ csrf_token() }}'
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
                    
                    // Load results
                    $("#modal_administrator_id").val(data['id']);
                    $("#modal_administrator_name").val(data['name']);
                    $("#modal_administrator_auth").val(data['auth']);
                    $("#modal_administrator_password").val(data['password']);
                    $("#modal_administrator_account_flag").val(data['account_flag']);
                    $("#modal_administrator_expiration").val(data['expiration']);
                    $("#modal_administrator_rank_id option[value='"+data['rank_id']+"']").attr("selected",true);

                }
            }).fail( function() {
                $("#modal_administrators_messages").html('<div class="alert alert-danger fade show"> <button type="button" class="close" data-dismiss="alert">&times;</button> <strong> {{ trans("forms.danger") }}! </strong> {{ trans("administrators.danger_edited_administrator") }} </div>');
            });

            return false;   	
	    }

        function destroy_administrator(administrator_id){
            if (confirm('{{ trans("forms.confirm") }}')) {
                var form = document.getElementById('destroy_administrator_'+administrator_id);
                form.submit();
            }
        }
    </script>