<!-- Modal -->
<div class="modal fade" id="editRank">
	<div class="modal-dialog modal-dialog-centered modal-xl">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel"><i class="fas fa-user-edit"></i> {{ trans('ranks.edit_rank') }} </h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body ml-1 mr-1">
				<!-- Carga los datos ajax -->
				<div class="mb-3" id="modal_ranks_messages"></div>
				
				<form class="form-horizontal" method="post" onsubmit="return updateRank();">

					<input type="hidden" id="modal_rank_id" name="id">

					<div class="form-group">
						<label for="name"> <h5> <strong> {{ trans('ranks.name') }}: </h5> </strong> </label>
						
						<input type="text" class="form-control col-6" placeholder="{{ trans('ranks.enter_name') }}" name="name" id="modal_rank_name" required>
					</div>

					<div class="form-group">
						<label for="auth"> <h5> <strong> {{ trans('ranks.price') }}: </strong> </h5> </label>
						
						<input type="number" class="form-control col-6" placeholder="{{ trans('ranks.enter_price') }}" name="price" id="modal_rank_price" step="0.1" required>
					</div>

					<div class="form-group">
						<label for="name"> <h5> <strong> {{ trans('ranks.purchase_link') }}: </h5> </strong> </label>
						
						<input type="text" class="form-control col-6" name="purchase_link" id="modal_rank_purchase_link" value="{{ @old('purchase_link') }}">
					</div>

					<div class="form-group">
						<label for="auth"> <h5> <strong> {{ trans('ranks.color') }}: </strong> </h5> </label>
						
						<input type="color" class="form-control col-6" name="color" id="modal_rank_color" required>
					</div>

					<div class="form-group">
						<h5> 
							<strong> {{ trans('ranks.access_flags') }}: </strong> 

							<span class="ml-5">
								<input class="form-check-input" type="checkbox" id="checkAll" value="off"> Check all
							</span>	
						</h5>
						
						<div class="form-check">

							<!-- Left column -->
							<div style="width: 40%; float:left; margin-left: 1%;">
								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="access_flags[]" id="flag_a" value="a">
									<span data-toggle="tooltip" data-placement="right" title="Flag a"> {{ trans('ranks.immunity') }} </span>
								</label> 

								<br />

								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="access_flags[]" id="flag_b" value="b">
									<span data-toggle="tooltip" data-placement="right" title="Flag b"> {{ trans('ranks.reserved_slot') }} </span>
								</label>

								<br />

								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="access_flags[]" id="flag_c" value="c">
									<span data-toggle="tooltip" data-placement="right" title="Flag c"> {{ trans('ranks.kick') }} </span>
								</label>

								<br />

								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="access_flags[]" id="flag_d" value="d">
									<span data-toggle="tooltip" data-placement="right" title="Flag d"> {{ trans('ranks.ban') }} </span>
								</label>

								<br />
								
								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="access_flags[]" id="flag_e" value="e">
									<span data-toggle="tooltip" data-placement="right" title="Flag e"> {{ trans('ranks.slay_slap') }} </span>
								</label>

								<br />

								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="access_flags[]" id="flag_f" value="f">
									<span data-toggle="tooltip" data-placement="right" title="Flag f"> {{ trans('ranks.change_map') }} </span>
								</label>

								<br />

								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="access_flags[]" id="flag_g" value="g">
									<span data-toggle="tooltip" data-placement="right" title="Flag g"> {{ trans('ranks.modify_cvar') }} <span style="color:#FF0000; font-weight: bold; font-size: small";> {{ trans('ranks.not_recommended')}} </span> </span>
								</label>

								<br />

								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="access_flags[]" id="flag_h" value="h">
									<span data-toggle="tooltip" data-placement="right" title="Flag h"> {{ trans('ranks.execute_cfg') }} </span>
								</label>

								<br />

								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="access_flags[]" id="flag_i" value="i">
									<span data-toggle="tooltip" data-placement="right" title="Flag i"> {{ trans('ranks.top_chat') }} </span>
								</label>

								<br />

								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="access_flags[]" id="flag_j" value="j">
									<span data-toggle="tooltip" data-placement="right" title="Flag j"> {{ trans('ranks.generate_votes') }} </span>
								</label>

								<br />

								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="access_flags[]" id="flag_k" value="k">
									<span data-toggle="tooltip" data-placement="right" title="Flag k"> {{ trans('ranks.change_password') }} </span>
								</label>

								<br />

								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="access_flags[]" id="flag_l" value="l">
									<span data-toggle="tooltip" data-placement="right" title="Flag l"> {{ trans('ranks.rcon_access') }} <span style="color:#FF0000; font-weight: bold; font-size: small";> {{ trans('ranks.not_recommended')}} </span> </span>
								</label>

								<br />
							</div>

							<!-- Right column -->
							<div style="width: 57%; ; margin-left: 1%; margin-right: 1%; float:right;">
								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="access_flags[]" id="flag_m" value="m">
									<span data-toggle="tooltip" data-placement="right" title="Flag m"> {{ trans('ranks.flag_m') }} </span>
								</label>

								<br />

								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="access_flags[]" id="flag_n" value="n">
									<span data-toggle="tooltip" data-placement="right" title="Flag n"> {{ trans('ranks.flag_n') }} </span>
								</label>

								<br />

								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="access_flags[]" id="flag_o" value="o">
									<span data-toggle="tooltip" data-placement="right" title="Flag o"> {{ trans('ranks.flag_o') }} </span>
								</label>

								<br />

								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="access_flags[]" id="flag_p" value="p">
									<span data-toggle="tooltip" data-placement="right" title="Flag p"> {{ trans('ranks.flag_p') }} </span>
								</label>

								<br />

								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="access_flags[]" id="flag_q" value="q">
									<span data-toggle="tooltip" data-placement="right" title="Flag q"> {{ trans('ranks.flag_q') }} </span>
								</label>

								<br />

								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="access_flags[]" id="flag_r" value="r">
									<span data-toggle="tooltip" data-placement="right" title="Flag r"> {{ trans('ranks.flag_r') }} </span>
								</label>

								<br />

								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="access_flags[]" id="flag_s" value="s">
									<span data-toggle="tooltip" data-placement="right" title="Flag s"> {{ trans('ranks.flag_s') }} </span>
								</label>

								<br />

								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="access_flags[]" id="flag_t" value="t">
									<span data-toggle="tooltip" data-placement="right" title="Flag t"> {{ trans('ranks.flag_t') }} </span>
								</label>

								<br />
								<br />

								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="access_flags[]" id="flag_u" value="u">
									<span data-toggle="tooltip" data-placement="right" title="Flag u"> {{ trans('ranks.flag_u') }} </span>
								</label>

								<br />

								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="access_flags[]" id="flag_v" value="v">
									<span data-toggle="tooltip" data-placement="right" title="Flag v"> {{ trans('ranks.flag_v') }} </span>
								</label>

								<br />

								<label class="form-check-label">
									<input class="form-check-input" type="checkbox" name="access_flags[]" id="flag_z" value="z">
									<span data-toggle="tooltip" data-placement="right" title="Flag z"> {{ trans('ranks.flag_z') }} </span>
								</label>
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