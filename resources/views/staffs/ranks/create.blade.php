@extends('staffs.app')

@section('js')
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();

            $("#checkAll").click(function () {  
                
                if ($('#checkAll').val() == 'on') {
                    $('#checkAll').val('off');
                    $('input:checkbox').attr('checked', false);
                } else {
                    $('#checkAll').val('on');
                    $('input:checkbox').attr('checked', true);
                }
            });
        });

        
    </script>

@endsection

@section('right-content')

    <div class="p-3 my-3 bg-primary text-white">
        <h1> {{ trans('ranks.create_rank') }} </h1>
        <p> {{trans('ranks.create_rank_message') }} </p>
    </div>

    <form action="{{ route('staffs/ranks/store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name"> <h5> <strong> {{ trans('ranks.name') }}: </h5> </strong> </label>
            
            <input type="text" class="form-control col-6" placeholder="{{ trans('ranks.enter_name') }}" name="name" value="{{ @old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="auth"> <h5> <strong> {{ trans('ranks.price') }}: </strong> </h5> </label>
            
            <input type="number" class="form-control col-6" placeholder="{{ trans('ranks.enter_price') }}" name="price" value="{{ @old('price') }}" step="0.1" required>
        </div>

        <div class="form-group">
            <h5> 
                <strong> {{ trans('ranks.access_flags') }}: </strong>  

                <span class="ml-5">
                    <input class="form-check-input" type="checkbox" id="checkAll" value="off"> Check all
                </span>
            </h5> 
            
            <div class="form-check">

            <label class="form-check-label">
                        
            </label> 

                <!-- Left column -->
                <div style="width: 40%; float:left; margin-left: 1%;">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="access_flags[]" value="a">
                        <span data-toggle="tooltip" data-placement="right" title="Flag a"> {{ trans('ranks.immunity') }} </span>
                    </label> 

                    <br />

                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="access_flags[]" value="b">
                        <span data-toggle="tooltip" data-placement="right" title="Flag b"> {{ trans('ranks.reserved_slot') }} </span>
                    </label>

                    <br />

                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="access_flags[]" value="c">
                        <span data-toggle="tooltip" data-placement="right" title="Flag c"> {{ trans('ranks.kick') }} </span>
                    </label>

                    <br />

                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="access_flags[]" value="d">
                        <span data-toggle="tooltip" data-placement="right" title="Flag d"> {{ trans('ranks.ban') }} </span>
                    </label>

                    <br />
                    
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="access_flags[]" value="e">
                        <span data-toggle="tooltip" data-placement="right" title="Flag e"> {{ trans('ranks.slay_slap') }} </span>
                    </label>

                    <br />

                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="access_flags[]" value="f">
                        <span data-toggle="tooltip" data-placement="right" title="Flag f"> {{ trans('ranks.change_map') }} </span>
                    </label>

                    <br />

                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="access_flags[]" value="g">
                        <span data-toggle="tooltip" data-placement="right" title="Flag g"> {{ trans('ranks.modify_cvar') }} <span style="color:#FF0000; font-weight: bold; font-size: small";> {{ trans('ranks.not_recommended')}} </span> </span>
                    </label>

                    <br />

                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="access_flags[]" value="h">
                        <span data-toggle="tooltip" data-placement="right" title="Flag h"> {{ trans('ranks.execute_cfg') }} </span>
                    </label>

                    <br />

                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="access_flags[]" value="i">
                        <span data-toggle="tooltip" data-placement="right" title="Flag i"> {{ trans('ranks.top_chat') }} </span>
                    </label>

                    <br />

                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="access_flags[]" value="j">
                        <span data-toggle="tooltip" data-placement="right" title="Flag j"> {{ trans('ranks.generate_votes') }} </span>
                    </label>

                    <br />

                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="access_flags[]" value="k">
                        <span data-toggle="tooltip" data-placement="right" title="Flag k"> {{ trans('ranks.change_password') }} </span>
                    </label>

                    <br />

                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="access_flags[]" value="l">
                        <span data-toggle="tooltip" data-placement="right" title="Flag l"> {{ trans('ranks.rcon_access') }} <span style="color:#FF0000; font-weight: bold; font-size: small";> {{ trans('ranks.not_recommended')}} </span> </span>
                    </label>

                    <br />
                </div>

                <!-- Right column -->
                <div style="width: 57%; ; margin-left: 1%; margin-right: 1%; float:right;">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="access_flags[]" value="m">
                        <span data-toggle="tooltip" data-placement="right" title="Flag m"> {{ trans('ranks.flag_m') }} </span>
                    </label>

                    <br />

                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="access_flags[]" value="n">
                        <span data-toggle="tooltip" data-placement="right" title="Flag n"> {{ trans('ranks.flag_n') }} </span>
                    </label>

                    <br />

                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="access_flags[]" value="o">
                        <span data-toggle="tooltip" data-placement="right" title="Flag o"> {{ trans('ranks.flag_o') }} </span>
                    </label>

                    <br />

                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="access_flags[]" value="p">
                        <span data-toggle="tooltip" data-placement="right" title="Flag p"> {{ trans('ranks.flag_p') }} </span>
                    </label>

                    <br />

                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="access_flags[]" value="q">
                        <span data-toggle="tooltip" data-placement="right" title="Flag q"> {{ trans('ranks.flag_q') }} </span>
                    </label>

                    <br />

                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="access_flags[]" value="r">
                        <span data-toggle="tooltip" data-placement="right" title="Flag r"> {{ trans('ranks.flag_r') }} </span>
                    </label>

                    <br />

                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="access_flags[]" value="s">
                        <span data-toggle="tooltip" data-placement="right" title="Flag s"> {{ trans('ranks.flag_s') }} </span>
                    </label>

                    <br />

                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="access_flags[]" value="t">
                        <span data-toggle="tooltip" data-placement="right" title="Flag t"> {{ trans('ranks.flag_t') }} </span>
                    </label>

                    <br />
                    <br />

                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="access_flags[]" value="u">
                        <span data-toggle="tooltip" data-placement="right" title="Flag u"> {{ trans('ranks.flag_u') }} </span>
                    </label>

                    <br />

                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="access_flags[]" value="v">
                        <span data-toggle="tooltip" data-placement="right" title="Flag v"> {{ trans('ranks.flag_v') }} </span>
                    </label>

                    <br />

                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="access_flags[]" value="z">
                        <span data-toggle="tooltip" data-placement="right" title="Flag z"> {{ trans('ranks.flag_z') }} </span>
                    </label>
                </div>                
            </div>
        </div>
        
        <button style="clear: both" type="submit" class="btn btn-primary float-right mb-3 mt-4"> {{ trans('forms.submit') }}</button>
    </form>
    
    <hr style="clear: both">
@endsection