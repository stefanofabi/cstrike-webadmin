<!-- Modal -->
<div class="modal fade" id="seeAdministrator">
	<div class="modal-dialog modal-dialog-centered modal-xl">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel"> <i class="fa-solid fa-user-nurse"></i> {{ trans('administrators.see_administrator') }} </h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<!-- Modal body -->
			<div class="modal-body ms-1 me-1">
				<!-- Carga los datos ajax -->
				<div class="mb-3" id="modal_users_messages"></div>

					<div class="row mb-5">
						<!-- Left Column -->
						<div class="col-md">
							<div>
								<span class="fs-5 fw-bold">{{ trans('administrators.name') }}: </span>
								<span id="modal_administrator_name"> </span> 
							</div>

							<div class="mt-3">
								<span class="fs-5 fw-bold"> {{ trans('administrators.auth') }}: </span>
								<span id="modal_administrator_auth"> </span> 
							</div>

							<div class="mt-3">
								<span class="fs-5 fw-bold"> {{ trans('administrators.password') }}:  </span> 
								<span style="visibility: hidden" class="password1" id="modal_administrator_password"> </span> 
								<div class=""> <span class="fa fa-fw fa-eye password-icon show-password"></span> </div>
							</div>

							<div class="mt-3">
								<span class="fs-5 fw-bold"> {{ trans('ranks.rank') }}: </span>
								<span id="modal_administrator_rank"> </span> 
							</div>
						</div>

						<!-- Right Column -->
						<div class="col-md">
							<div>
								<h5> <strong> {{ trans('administrators.account_flags') }}: </strong> </h5>
								
								<div>
									<label class="form-check-label">
										<input class="form-check-input" type="checkbox" name="account_flags[]" id="flag_a" value="a" disabled>
										<span data-bs-toggle="tooltip" data-bs-placement="right" title="Flag a"> {{ trans('administrators.unique_tag') }} </span>
									</label> 

									<br />

									<label class="form-check-label">
										<input class="form-check-input" type="checkbox" name="account_flags[]" id="flag_b" value="b" disabled>
										<span data-bs-toggle="tooltip" data-bs-placement="right" title="Flag b"> {{ trans('administrators.flexible_tag') }} </span>
									</label>

									<br />

									<label class="form-check-label">
										<input class="form-check-input" type="checkbox" name="account_flags[]" id="flag_c" value="c" disabled>
										<span data-bs-toggle="tooltip" data-bs-placement="right" title="Flag c"> {{ trans('administrators.it_steam') }} </span>
									</label>

									<br />

									<label class="form-check-label">
										<input class="form-check-input" type="checkbox" name="account_flags[]" id="flag_d" value="d" disabled>
										<span data-bs-toggle="tooltip" data-bs-placement="right" title="Flag d"> {{ trans('administrators.it_ip') }} </span>
									</label>

									<br />
									
									<label class="form-check-label">
										<input class="form-check-input" type="checkbox" name="account_flags[]" id="flag_e" value="e" disabled>
										<span data-bs-toggle="tooltip" data-bs-placement="right" title="Flag e"> {{ trans('administrators.password_not_checked') }} </span>
									</label>

									<br />

									<label class="form-check-label">
										<input class="form-check-input" type="checkbox" name="account_flags[]" id="flag_k" value="k" disabled>
										<span data-bs-toggle="tooltip" data-bs-placement="right" title="Flag k"> {{ trans('administrators.name_tag_case_sensitive') }} </span>
									</label>
								</div>
							</div>

							<div class="mt-3">
								<span class="fs-5 fw-bold"> {{ trans('servers.servers_with_access') }}: </span>
								<span id="modal_administrator_server"> </span>
							</div>

							<div class="mt-3">
								<label> 
									<span class="fs-5 fw-bold"> {{ trans('administrators.status') }}: </span>
									<span id="modal_administrator_status"> </span> 
									<div class="mt-1 d-none" id="suspendAdministratorDiv"> {{ trans('administrators.suspend_administrator') }}: <span id="modal_administrator_suspended"> </span> </div>
								</label>
							</div>
						</div>
					</div>

					<!-- Modal footer -->
					<div style="clear: both" class="modal-footer">
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal"> {{ trans('forms.exit') }} </button>
					</div>
			</div>
		</div>
	</div>
</div>