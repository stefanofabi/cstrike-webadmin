<!-- Modal -->
<div class="modal fade" id="editSystemParameter">
	<div class="modal-dialog modal-dialog-centered modal-xl">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel"><i class="fas fa-edit"></i> {{ trans('system_parameters.edit_system_parameter') }} </h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<!-- Modal body -->
			<div class="modal-body ms-1 me-1">
				<!-- Carga los datos ajax -->
				<div class="mb-3" id="modal_system_parameter_messages"></div>
				
				<form class="form-horizontal" method="post" onsubmit="return updateSystemParameter();">

					<input type="hidden" id="modal_system_parameter_id">

					<div class="col-md-9 mb-5">
						<div class="mt-3">
							<label for="name"> <h5> <strong> {{ trans('system_parameters.name') }}: </h5> </strong> </label>
							<input type="text" class="form-control col-12" placeholder="" id="modal_system_parameter_name" disabled>
						</div>


						<div class="mt-3">
							<label for="name"> <h5> <strong> {{ trans('system_parameters.category') }}: </h5> </strong> </label>
							<input type="text" class="form-control col-12" placeholder="" id="modal_system_parameter_category" disabled>
						</div>


						<div class="mt-3">
							<label for="name"> <h5> <strong> {{ trans('system_parameters.value') }}: </h5> </strong> </label>
							<input type="text" class="form-control col-12" placeholder="" id="modal_system_parameter_value" required>
						</div>
					</div>

					<!-- Modal footer -->
					<div style="clear: both" class="modal-footer">
						<button type="submit" class="btn btn-primary"> {{ trans('forms.save') }} </button>
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal"> {{ trans('forms.cancel') }} </button>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>