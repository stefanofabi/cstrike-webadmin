<!-- Modal -->
<div class="modal fade" id="editAdministrator">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel"><i class="fas fa-user-edit"></i> {{ trans('administrators.edit_administrator') }} </h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<!-- Carga los datos ajax -->
				<div class="mb-3" id="modal_administrators_messages"></div>
				
				<form class="form-horizontal" method="post" onsubmit="return updateAdministrator();">

					<input type="hidden" id="modal_administrator_id" name="id">

					<div class="form-group">
						<div class="input-group mb-4 col-md-9 input-form">
							<div class="input-group-prepend">
								<span class="input-group-text"> {{ trans('administrators.name') }} </span>
							</div>

							<input type="text" class="form-control" id="modal_administrator_name" name="name" required>
						</div>
					</div>

					<div class="form-group">
						<div class="input-group mb-4 col-md-9 input-form">
							<div class="input-group-prepend">
								<span class="input-group-text"> {{ trans('administrators.auth') }} </span>
							</div>

							<input type="text" class="form-control" id="modal_administrator_auth" name="auth" required>
						</div>
					</div>

					<div class="form-group">
						<div class="input-group mb-4 col-md-9 input-form">
							<div class="input-group-prepend">
								<span class="input-group-text"> {{ trans('administrators.password') }} </span>
							</div>

							<input type="text" class="form-control" id="modal_administrator_password" name="password" required>
						</div>
					</div>

					<div class="form-group">
						<div class="input-group mb-4 col-md-9 input-form">
							<div class="input-group-prepend">
								<span class="input-group-text"> {{ trans('administrators.account_flag') }} </span>
							</div>

							<input type="text" class="form-control" id="modal_administrator_account_flag" name="account_flag" required>
						</div>
					</div>

					<div class="form-group">
						<div class="input-group mb-4 col-md-9 input-form">
							<div class="input-group-prepend">
								<span class="input-group-text"> {{ trans('administrators.expiration') }} </span>
							</div>

							<input type="date" class="form-control" id="modal_administrator_expiration" name="expiration" required>
						</div>
					</div>

					<div class="input-group mb-4 col-md-9 input-form">
						<div class="input-group-prepend">
							<span class="input-group-text"> {{ trans('ranks.rank') }} </span>
						</div>

						<select class="form-control input-sm" id="modal_administrator_rank_id" name="rank_id">
							<option value=""> {{ trans('forms.select_option') }} </option>

							@foreach ($ranks as $rank)
								<option value="{{ $rank->id }}"> {{ $rank->name }} </option>
							@endforeach
						</select>
					</div>

					<!-- Modal footer -->
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary"> {{ trans('forms.save') }} </button>
						<button type="button" class="btn btn-danger" data-dismiss="modal"> {{ trans('forms.cancel') }} </button>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>