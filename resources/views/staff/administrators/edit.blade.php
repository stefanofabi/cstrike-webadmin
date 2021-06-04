<!-- Modal -->
<div class="modal fade" id="editAdministrator">
	<div class="modal-dialog modal-dialog-centered modal-xl">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel"><i class="fas fa-user-edit"></i> {{ trans('administrators.edit_administrator') }} </h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body ml-1 mr-1">
				<!-- Carga los datos ajax -->
				<div class="mb-3" id="modal_administrators_messages"></div>
				
				<form class="form-horizontal" method="post" onsubmit="return updateAdministrator();">

					<input type="hidden" id="modal_administrator_id" name="id">

					<!-- Left Column -->
					<div style="width: 40%; float:left; margin-left: 1%; margin-bottom: 2%">
						<div class="form-group">
							<label for="name"> <h5> <strong> {{ trans('administrators.name') }}: </h5> </strong> </label>
							
							<input type="text" class="form-control col-12" placeholder="{{ trans('administrators.enter_name') }}" name="name" id="modal_administrator_name" value="{{ @old('name') }}" required>
						</div>

						<div class="form-group">
							<label for="auth"> <h5> <strong> {{ trans('administrators.auth') }}: </strong> </h5> </label>
							
							<input type="text" class="form-control col-12" placeholder="{{ trans('administrators.enter_auth') }}" name="auth" id="modal_administrator_auth" value="{{ @old('auth') }}" required>
						</div>

						<div class="form-group">
							<label for="password"> <h5> <strong> {{ trans('administrators.password') }}: </strong> </h5> </label>
							
							<input type="password" class="form-control password1 col-12" placeholder="{{ trans('administrators.enter_password') }}" name="password" id="modal_administrator_password">
							<div class="col-12"> <span class="fa fa-fw fa-eye password-icon show-password"></span> </div>
						</div>


						<div class="form-group">
							<h5> <strong>{{ trans('administrators.expiration') }}: </strong> </h5>

							<input class="form-control col-12" type="date" name="expiration" id="modal_administrator_expiration" value="{{ @old('expiration') ?? date('Y-m-d', strtotime(date('Y-m-d').' + 1 month')) }}" required>
						</div>

						<div class="form-group">
							<h5> <strong>{{ trans('ranks.rank') }}: </strong> </h5>

							<select class="form-control col-12" name="rank_id" id="modal_administrator_rank_id" required>
								<option value="">  {{ trans('forms.select_option') }} </option>
									
								@foreach ($ranks as $rank)
									<option value="{{ $rank->id }}">  {{ $rank->name }} </option>
								@endforeach
							</select>
						</div>
					</div>

					<!-- Right Column -->
					<div style="width: 57%; ; margin-left: 1%; margin-right: 1%; float:right;padding-left: 3%;">
						<div class="form-group">
							<h5> <strong> {{ trans('administrators.account_flags') }}: </strong> </h5>
							
							<div class="form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="account_flags[]" id="flag_a" value="a">
									<span data-toggle="tooltip" data-placement="right" title="Flag a"> {{ trans('administrators.unique_tag') }} </span>
								</label> 

								<br />

								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="account_flags[]" id="flag_b" value="b">
									<span data-toggle="tooltip" data-placement="right" title="Flag b"> {{ trans('administrators.flexible_tag') }} </span>
								</label>

								<br />

								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="account_flags[]" id="flag_c" value="c">
									<span data-toggle="tooltip" data-placement="right" title="Flag c"> {{ trans('administrators.it_steam') }} </span>
								</label>

								<br />

								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="account_flags[]" id="flag_d" value="d">
									<span data-toggle="tooltip" data-placement="right" title="Flag d"> {{ trans('administrators.it_ip') }} </span>
								</label>

								<br />
								
								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="account_flags[]" id="flag_e" value="e">
									<span data-toggle="tooltip" data-placement="right" title="Flag e"> {{ trans('administrators.password_not_checked') }} </span>
								</label>

								<br />

								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="account_flags[]" id="flag_k" value="k">
									<span data-toggle="tooltip" data-placement="right" title="Flag k"> {{ trans('administrators.name_tag_case_sensitive') }} </span>
								</label>
							</div>
						</div>


						<div class="form-group">
							<h5> <strong> {{ trans('servers.servers_with_access') }}: </strong> </h5>

							<div class="form-check">
								@forelse ($servers as $server)
									<label class="form-check-label">
										<input class="form-check-input" type="checkbox" name="servers[]" id="server_{{ $server->id }}" value="{{ $server->id }}">
										<span data-toggle="tooltip" data-placement="right" title="{{ $server->ip }}"> {{ $server->name }} </span>
									</label>

									<br />
								@empty
									<div style="color: red"> {{ trans('servers.no_servers') }} </div>
								@endforelse
							</div>
						</div>
					</div>

					<!-- Modal footer -->
					<div style="clear: both" class="modal-footer">
						<button type="submit" class="btn btn-primary"> {{ trans('forms.save') }} </button>
						<button type="button" class="btn btn-danger" data-dismiss="modal"> {{ trans('forms.cancel') }} </button>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>