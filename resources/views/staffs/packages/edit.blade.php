<!-- Modal -->
<div class="modal fade" id="editPackage">
	<div class="modal-dialog modal-dialog-centered modal-xl">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel"> <i class="fa-solid fa-cube"></i> {{ trans('packages.edit_package') }} </h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<!-- Modal body -->
			<div class="modal-body ms-1 me-1">
				<!-- Carga los datos ajax -->
				<div class="mb-3" id="modal_packages_messages"></div>
				
				<form class="form-horizontal" method="post" onsubmit="return updatePackage();">

					<input type="hidden" id="modal_package_id">

					<div class="row mb-5">
						<div class="col-9">
							<label for="name"> <h5> <strong> {{ trans('packages.name') }}: </h5> </strong> </label>
							
							<input type="text" class="form-control" id="modal_package_name" required>
						</div>
				
						<div class="col-9 mt-3">
							<label for="name"> <h5> <strong> {{ trans('packages.price') }}: </h5> </strong> </label>
							
							<input type="number" step="0.1" class="form-control" id="modal_package_price" required>
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