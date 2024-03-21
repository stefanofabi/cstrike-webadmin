<!-- Modal -->
<div class="modal fade" id="editAdministrator">
	<div class="modal-dialog modal-dialog-centered modal-xl">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel"><i class="fas fa-user-edit"></i> {{ trans('administrators.edit_administrator') }} </h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<!-- Modal body -->
			<div class="modal-body ms-1 me-1">
				<!-- Carga los datos ajax -->
				<div class="mb-3" id="modal_administrators_messages"></div>
				
				<form class="form-horizontal" method="post" onsubmit="return updateAdministrator();">

					<input type="hidden" id="modal_administrator_id" name="id">

					<div class="row mb-5">
						<!-- Left Column -->
						<div class="col-md">
							<div>
								<label for="name"> <h5> <strong> {{ trans('administrators.name') }}: </h5> </strong> </label>
								
								<input type="text" class="form-control col-12" placeholder="{{ trans('administrators.enter_name') }}" name="name" id="modal_administrator_name" value="{{ @old('name') }}" required>
							</div>

							<div class="mt-3">
								<label for="auth"> <h5> <strong> {{ trans('administrators.auth') }}: </strong> </h5> </label>
								
								<input type="text" class="form-control col-12" placeholder="{{ trans('administrators.enter_auth') }}" name="auth" id="modal_administrator_auth" value="{{ @old('auth') }}" required>
							</div>

							<div class="mt-3">
								<label for="password"> <h5> <strong> {{ trans('administrators.password') }}: </strong> </h5> </label>
								
								<input type="password" class="form-control password1 col-12" placeholder="{{ trans('administrators.enter_password') }}" name="password" id="modal_administrator_password">
								<div class="col-12"> <span class="fa fa-fw fa-eye password-icon show-password"></span> </div>
							</div>

							<div class="mt-3">
								<h5> <strong>{{ trans('ranks.rank') }}: </strong> </h5>

								<select class="form-select col-12" name="rank_id" id="modal_administrator_rank_id" required>
									<option value="">  {{ trans('forms.select_option') }} </option>
										
									@foreach ($ranks as $rank)
										<option value="{{ $rank->id }}">  {{ $rank->name }} </option>
									@endforeach
								</select>
							</div>
						</div>

						<!-- Right Column -->
						<div class="col-md">
							<div>
								<h5> <strong> {{ trans('administrators.account_flags') }}: </strong> </h5>
								
								<div>
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


							<div class="mt-3">
								<h5> <strong> {{ trans('servers.servers_with_access') }}: </strong> </h5>

								@if ($servers->isNotEmpty())
								<select class="form-select" id="modal_server_id">
									<option selected> {{ trans('administrators.select_a_server') }} </option>

									@foreach ($servers as $server)
									<option value="{{ $server->id}}"> {{ $server->ip }} {{ $server->name }} </option>
									@endforeach
								</select>
								@else 
								<div style="color: red"> {{ trans('servers.no_servers') }} </div>
								@endif
							</div>

							<div class="form-check form-switch mt-3">
								<input class="form-check-input" type="checkbox" id="modal_suspend_administrator">
								<label class="form-check-label" for="modal_suspend_administrator"> {{ trans('administrators.suspend_administrator') }} </label>
							</div>
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