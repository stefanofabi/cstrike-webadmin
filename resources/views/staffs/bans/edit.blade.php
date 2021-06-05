<!-- Modal -->
<div class="modal fade" id="editServer">
	<div class="modal-dialog modal-dialog-centered modal-s">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel"><i class="fas fa-edit"></i> {{ trans('servers.edit_server') }} </h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body ml-1 mr-1">
				<!-- Carga los datos ajax -->
				<div class="mb-3" id="modal_servers_messages"></div>
				
				<form class="form-horizontal" method="post" onsubmit="return updateServer();">

					<input type="hidden" id="modal_server_id" name="id">

					<div class="form-group">
						<label for="name"> <h5> <strong> {{ trans('servers.name') }}: </h5> </strong> </label>
						
						<input type="text" class="form-control col-12" placeholder="{{ trans('servers.enter_name') }}" name="name" id="modal_server_name" value="{{ @old('name') }}" required>
					</div>

					<div class="form-group">
						<label for="auth"> <h5> <strong> {{ trans('servers.ip') }}: </strong> </h5> </label>
						
						<input type="text" class="form-control col-12" placeholder="{{ trans('servers.enter_ip') }}" name="ip" id="modal_server_ip" value="{{ @old('ip') }}" required>
					</div>

					<!-- Modal footer -->
					<div style="clear: both;" class="modal-footer">
						<button type="submit" class="btn btn-primary"> {{ trans('forms.save') }} </button>
						<button type="button" class="btn btn-danger" data-dismiss="modal"> {{ trans('forms.cancel') }} </button>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>