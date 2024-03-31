<!-- Modal -->
<div class="modal fade" id="editBan">
	<div class="modal-dialog modal-dialog-centered modal-xl">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel"><i class="fas fa-edit"></i> {{ trans('bans.edit_ban') }} </h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<!-- Carga los datos ajax -->
				<div class="mt-3" id="modal_bans_messages"></div>
				
				<form class="form-horizontal" method="post" onsubmit="return updateBan();">

					<input type="hidden" id="modal_ban_id" name="id">

					<div class="row mt-3 mb-5">
						<!-- Left Column -->
						<div class="col-md">
							<div>
								<label for="name"> <h5> <strong> {{ trans('bans.name') }}: </h5> </strong> </label>
													
								<input type="text" class="form-control" placeholder="{{ trans('bans.enter_name') }}" name="name" id="modal_ban_name" required>
							</div>

							<div class="mt-3">
								<label for="auth"> <h5> <strong> {{ trans('bans.steam_id') }}: </strong> </h5> </label>
													
								<input type="text" class="form-control" placeholder="{{ trans('bans.enter_steam_id') }}" name="steam_id" id="modal_ban_steam_id">
							</div>

							<div class="mt-3">
								<label for="auth"> <h5> <strong> {{ trans('bans.ip') }}: </strong> </h5> </label>
													
								<input type="text" class="form-control" placeholder="{{ trans('bans.enter_ip') }}" name="ip" id="modal_ban_ip">
							</div>

							<div class="mt-3">
								<label for="auth"> <h5> <strong> {{ trans('bans.reason') }}: </strong> </h5> </label>
													
								<input type="text" class="form-control" placeholder="{{ trans('bans.enter_reason') }}" name="reason" id="modal_ban_reason" required>
							</div>

							<div class="mt-3">
								<label for="auth"> <h5> <strong> {{ trans('bans.private_notes') }}: </strong> </h5> </label>

								<textarea class="form-control" rows="3" name="private_notes" id="modal_ban_private_notes"></textarea>
							</div>
						</div>

						<!-- Right Column -->
						<div class="col-md">
							<div class="mt-3">
								<span class="fs-5 fw-bold">  {{ trans('bans.servers_with_ban') }}: </span> <span id="modal_ban_server"> </span>
							</div>


							<div class="mt-3">
								<label for="auth"> <h5> <strong> {{ trans('bans.expiration') }}: </strong> </h5> </label>
											
								<input type="datetime-local" class="form-control" placeholder="{{ trans('bans.expiration') }}" name="expiration" id="modal_ban_expiration">

								<button type="button" class="btn btn-primary btn-sm ml-1 mt-3" onclick="setBanExpiration('5')"> {{ trans('bans.5_minutes') }}</button>
								<button type="button" class="btn btn-primary btn-sm ml-1 mt-3" onclick="setBanExpiration('15')"> {{ trans('bans.15_minutes') }}</button>
								<button type="button" class="btn btn-primary btn-sm ml-1 mt-3" onclick="setBanExpiration('30')"> {{ trans('bans.30_minutes') }}</button>
								<button type="button" class="btn btn-primary btn-sm ml-1 mt-3" onclick="setBanExpiration('60')"> {{ trans('bans.60_minutes') }}</button>
										
								<br />
										
								<button type="button" class="btn btn-primary btn-sm ml-1 mt-2 mb-2" onclick="setBanExpiration('1440')"> {{ trans('bans.1_day') }}</button>
								<button type="button" class="btn btn-primary btn-sm ml-1 mt-2 mb-2" onclick="setBanExpiration('4320')"> {{ trans('bans.3_days') }}</button>
								<button type="button" class="btn btn-primary btn-sm ml-1 mt-2 mb-2" onclick="setBanExpiration('7200')"> {{ trans('bans.5_days') }}</button>
								<button type="button" class="btn btn-primary btn-sm ml-1 mt-2 mb-2" onclick="setBanExpiration('43200')"> {{ trans('bans.30_days') }}</button>
								<button type="button" class="btn btn-primary btn-sm ml-1 mt-2 mb-2" onclick="setBanExpiration('')"> {{ trans('bans.permanently') }}</button>
							</div>

							<div class="mt-3">
								<span class="fs-5 fw-bold">  {{ trans('bans.banned_by_admin') }}: </span> <span id="modal_ban_administrator"> </span>
							</div>			
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