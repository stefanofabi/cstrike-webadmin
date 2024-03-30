<!-- Modal -->
<div class="modal fade" id="editOrder">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel"><i class="fas fa-edit"></i> {{ trans('orders.edit_order') }} </h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<!-- Carga los datos ajax -->
				<div class="mt-3" id="modal_orders_messages"></div>
				
				<form class="form-horizontal" method="post" onsubmit="return updateOrder();">

					<input type="hidden" id="modal_order_id">

					<div class="row mt-3 mb-5">
						<div class="col-md-9">
							<span class="fs-5 fw-bold"> {{ trans('orders.package') }}: </span> 
							<span id="modal_order_package"> </span>
						</div>

						<div class="col-md-9 mt-3">
							<span class="fs-5 fw-bold"> {{ trans('orders.expiration') }}: </span> 
							<span id="modal_order_expiration"> </span>
						</div>

						<div class="col-md-9 mt-3">
							<span class="fs-5 fw-bold">{{ trans('orders.status') }}: </span> 
							<span id="modal_order_status"> </span>
						</div>
			
						<div class="col-md-9 mt-3">
							<label for="name"> <h5> <strong> {{ trans('orders.auth') }}: </h5> </strong> </label>
							
							<input type="text" class="form-control" placeholder="{{ trans('orders.enter_your_tag') }}" id="modal_order_auth" value="{{ old('auth') }}" required minlength="4" maxlength="32">
							<div class="fst-italic"> {{ trans('orders.tag_requirements') }} </div>
						</div>
			
						<div class="col-md-9 mt-3">
							<label for="name"> <h5> <strong> {{ trans('orders.password') }}: </h5> </strong> </label>
							
							<input type="password" class="form-control password1" placeholder="{{ trans('administrators.enter_password') }}" id="modal_order_password" required minlength="4" maxlength="20">
							<div> <span class="fa fa-fw fa-eye password-icon show-password"></span> </div>
							<div class="fst-italic"> {{ trans('orders.password_requirements') }} </div>
						</div>
						
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