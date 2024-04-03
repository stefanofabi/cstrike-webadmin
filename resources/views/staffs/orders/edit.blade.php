<!-- Modal -->
<div class="modal fade" id="editOrder">
	<div class="modal-dialog modal-dialog-centered modal-xl">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel"> <i class="fa-solid fa-cube"></i> {{ trans('orders.edit_order') }} #<span id="modal_order_number"> </span> </h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<!-- Modal body -->
			<div class="modal-body ms-1 me-1">
				<!-- Carga los datos ajax -->
				<div class="mb-3" id="modal_orders_messages"></div>

				<form class="form-horizontal" method="post" onsubmit="return updateOrder();">

					<input type="hidden" id="modal_order_id">

					<div> <span class="fs-5 fw-bold"> Usuario: </span> <span id="modal_order_user_name"> </span> </div>
					<div> <span class="fs-5 fw-bold"> Email: </span> <span id="modal_order_user_email"> </span> </div>
					
					<div> <span class="fs-5 fw-bold"> Fecha: </span> <span id="modal_order_date"> </span> </div>
					<div> <span class="fs-5 fw-bold"> Estado: </span> <span id="modal_order_status"> </span> </div>

					<div class="row mb-5">
						<div class="col-9 mt-3">
							<h5> <strong>{{ trans('orders.package') }}: </strong> </h5>

							<select class="form-select col-12" id="modal_order_package" required>
								<option value="">  {{ trans('forms.select_option') }} </option>
									
								@foreach ($packages as $package)
									<option value="{{ $package->id }}">  {{ $package->name }} </option>
								@endforeach
							</select>
						</div>

						<div class="col-md-9 mt-3">
							<label for="name"> <h5> <strong> {{ trans('orders.auth') }}: </h5> </strong> </label>
							
							<input type="text" class="form-control" id="modal_order_auth" required>
						</div>

						<div class="col-md-9 mt-3">
							<label for="name"> <h5> <strong> {{ trans('orders.password') }}: </h5> </strong> </label>
							
							<input type="password" class="form-control password1" id="modal_order_password" placeholder="{{ trans('administrators.enter_password') }}">
							<div class="col-12"> <span class="fa fa-fw fa-eye password-icon show-password"></span> </div>
						</div>

						<div class="col-md-9 mt-3">
							<label for="name"> <h5> <strong> {{ trans('orders.expiration') }}: </h5> </strong> </label>
							
							<input type="date" class="form-control" id="modal_order_expiration">
						</div>
				
						<div class="col-md-9 mt-3">
							<label for="name"> <h5> <strong> {{ trans('orders.price') }}: </h5> </strong> </label>
							
							<input type="number" step="0.1" class="form-control" id="modal_order_price">
							<div class="fst-italic fs-6"> {{ trans('orders.replace_order_price') }} </div>
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