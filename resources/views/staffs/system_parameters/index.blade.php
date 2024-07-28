@extends('staffs.app')

@section('title')
{{ trans('home.system_parameters') }}
@endsection

@section('js')
    @include('staffs.system_parameters.js')

    <script type="module">
        $('#mySystemParametersTable').DataTable({
            "language": {
                "info": '{{ trans('datatables.info') }}',
                "infoEmpty": '{{ trans('datatables.info_empty') }}',
                "infoFiltered": '{{ trans('datatables.info_filtered') }}',
                "search": '{{ trans('datatables.search') }}',
                "paginate": {
                    "first": '{{ trans('datatables.first') }}',
                    "last": '{{ trans('datatables.last') }}',
                    "previous": '{{ trans('datatables.previous') }}',
                    "next": '{{ trans('datatables.next') }}',
                },
                "lengthMenu": '{{ trans('datatables.show') }} '+
                    '<select class="form-select form-select-sm">'+
                    '<option value="10"> 10 </option>'+
                    '<option value="20"> 20 </option>'+
                    '<option value="30"> 30 </option>'+
                    '<option value="-1"> {{ trans('datatables.all') }} </option>'+
                    '</select> {{ trans('datatables.records') }}',
                "emptyTable": '{{ trans('datatables.no_data') }}',
                "zeroRecords": '{{ trans('datatables.no_match_records') }}',
            }
        });
    </script>
@endsection

@section('right-content')

    @include('staffs.system_parameters.edit')
    
    <div class="p-3 my-3 bg-primary text-white">
        <h1> <i class="fa-solid fa-gear"></i> {{ trans('home.system_parameters') }} </h1>
        <p class="col-9"> {{trans('system_parameters.welcome_message') }} </p>
    </div>

    <div>
        <table class="table table-striped w-100" id="mySystemParametersTable">
            <thead>
                <tr>
                    <th> {{ trans('system_parameters.name') }} </th>
                    <th> {{ trans('system_parameters.description') }}</th>
                    <th> {{ trans('system_parameters.category') }}</th>
                    <th class="text-end"> {{ trans('forms.actions') }}</th>
                </tr>
            </thead>
            
            <tbody>
                @if ($parameters->isNotEmpty())
                    @foreach ($parameters as $parameter)
                        <tr>
                            <td id="parameter_name_{{ $parameter->id }}"> {{ $parameter->name }} </td>

                            <td id="parameter_description_{{ $parameter->id }}"> {{ $parameter->description }} </td>

                            <td id="parameter_category_{{ $parameter->category }}"> {{ $parameter->category }} </td>

                            <td class="text-end">
                                <a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editSystemParameter" onclick="return editSystemParameter('{{ $parameter->id }}')" title="{{ trans('system_parameters.edit_system_parameter') }}">
                                    <span class="fas fa-edit"></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>

        </table>
    </div>
@endsection