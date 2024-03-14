<!-- Modal -->
<div class="modal fade" id="editServer">
	<div class="modal-dialog modal-dialog-centered modal-s">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel"><i class="fas fa-edit"></i> {{ trans('servers.edit_server') }} </h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<!-- Modal body -->
			<div class="modal-body ms-1 me-1">
				<!-- Carga los datos ajax -->
				<div class="mb-3" id="modal_servers_messages"></div>
				
				<form class="form-horizontal" method="post" onsubmit="return updateServer();">

					<input type="hidden" id="modal_server_id" name="id">

					<div class="row mb-5">
						<div class="col-9">
							<label for="name"> <h5> <strong> {{ trans('servers.name') }}: </h5> </strong> </label>
							
							<input type="text" class="form-control col-12" placeholder="{{ trans('servers.enter_name') }}" id="modal_server_name" required>
						</div>

						<div class="col-9 mt-3">
							<label for="auth"> <h5> <strong> {{ trans('servers.ip') }}: </strong> </h5> </label>
							
							<input type="text" class="form-control col-12" placeholder="{{ trans('servers.enter_ip') }}" id="modal_server_ip" required>
						</div>

						<div class="col-9 mt-3">
							<label for="auth"> <h5> <strong> {{ trans('servers.ranking_url') }}: </strong> </h5> </label>
							
							<input type="text" class="form-control col-6" id="modal_ranking_url">
						</div>
					</div>
					
					<!-- Modal footer -->
					<div style="clear: both;" class="modal-footer">
						<button type="submit" class="btn btn-primary"> {{ trans('forms.save') }} </button>
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal"> {{ trans('forms.cancel') }} </button>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>