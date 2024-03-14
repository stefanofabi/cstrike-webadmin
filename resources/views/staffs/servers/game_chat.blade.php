<!-- Modal -->
<div class="modal fade" id="seeGameChat">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel"> <i class="fa-solid fa-comments"></i> {{ trans('servers.game_chat') }} </h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<!-- Modal body -->
			<div class="modal-body ms-1 me-1">
				<!-- Carga los datos ajax -->
				<div class="mb-3" id="modal_servers_game_chat_messages"></div>

				<div class="mb-5">
					<table class="table" id="myGameChatTable">
						<thead>
							<tr>
								<th class="w-25"> Date </th>
								<th> Mensaje </th>
							</tr>
						</thead>

						<tbody>
							
						</tbody>
					</table>
				</div>
				
				<!-- Modal footer -->
				<div style="clear: both;" class="modal-footer">
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal"> {{ trans('forms.close') }} </button>
				</div>
			</div>
		</div>
	</div>
</div>