<!-- Modal -->
<div class="modal fade" id="managePrivileges">
	<div class="modal-dialog modal-dialog-centered modal-xl">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel"> <i class="fa-solid fa-cube"></i> {{ trans('packages.manage_privileges') }} </h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<!-- Modal body -->
			<div class="modal-body ms-1 me-1">
				<!-- Carga los datos ajax -->
				<div class="mb-3" id="modal_manage_privileges_messages"></div>

				<div class="col-9">
					<h4> {{ trans('packages.package_includes_privileges') }}: </h4>

					<table class="table" id="myPrivilegesTable">
						<thead>
							<tr>
								<th class="w-25"> {{ trans('servers.server') }} </th>
								<th> {{ trans('ranks.rank') }} </th>
								<th class="text-end"> {{ trans('forms.actions') }} </th>
							</tr>
						</thead>

						<tbody>
							
						</tbody>
					</table>
				</div>

				<div class="mt-5"> <h4> {{ trans('packages.add_new_privilege') }}: </h4> </div>
				
				<form class="form-horizontal" method="post" onsubmit="return storePrivilege();">

					<input type="hidden" id="modal_manage_privileges_id">

					<div class="row mb-5">

						<div class="col-9 mt-3">
							<h5> <strong> {{ trans('servers.servers_with_access') }}: </strong> </h5>

							@if ($servers->isNotEmpty())
							<select class="form-select" id="modal_manage_privileges_server">
								<option selected> {{ trans('administrators.select_a_server') }} </option>

								@foreach ($servers as $server)
								<option value="{{ $server->id}}"> {{ $server->name }} </option>
								@endforeach
							</select>
							@else 
							<div style="color: red"> {{ trans('servers.no_servers') }} </div>
							@endif
						</div>

						<div class="col-9 mt-3">
							<h5> <strong>{{ trans('ranks.rank') }}: </strong> </h5>

							<select class="form-select col-12" id="modal_manage_privileges_rank" required>
								<option value="">  {{ trans('forms.select_option') }} </option>
									
								@foreach ($ranks as $rank)
									<option value="{{ $rank->id }}">  {{ $rank->name }} </option>
								@endforeach
							</select>
						</div>

					</div>

					<!-- Modal footer -->
					<div style="clear: both;" class="modal-footer">
						<button type="submit" class="btn btn-primary"> {{ trans('packages.add_privilege') }} </button>
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal"> {{ trans('forms.cancel') }} </button>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>