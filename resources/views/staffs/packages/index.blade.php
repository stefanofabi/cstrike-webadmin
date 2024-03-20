@extends('staffs.app')

@section('title')
{{ trans('home.packages') }}
@endsection

@section('js')

    @include('staffs.packages.js')

    <script type="module">
        $('#myPackagesTable').DataTable({
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

    @include('staffs.packages.edit')
    @include('staffs.packages.manage_privileges')
    
    <div class="p-3 my-3 bg-primary text-white">
        <div class="btn-group float-end">
            <a  href="{{ route('staffs/packages/create') }}" class="btn btn-light"> <span class="fas fa-user-plus"> </span> {{ trans('packages.create_package') }} </a>
        </div>

        <h1> <i class="fa-solid fa-cube"></i> </span> {{ trans('home.packages') }} </h1>
        <p class="col-9"> {{trans('packages.welcome_message') }} </p>
    </div>

    <div>
        <table class="table table-striped" id="myPackagesTable">
            <thead>
                <tr>
                    <th> {{ trans('packages.name') }} </th>
                    <th> {{ trans('packages.price') }} </th>
                    <th class="text-end"> {{ trans('forms.actions') }}</th>
                </tr>
            </thead>
            
            <tbody>
                    @foreach ($packages as $package)
                        <tr>
                            <td id="package_name_{{ $package->id }}"> {{ $package->name }} </td>
                            <td id="package_price_{{ $package->id }}"> ${{ number_format($package->price, 2, ',', '.') }} </td>

                            <td class="text-end form-inline">   
                                <a type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#managePrivileges" onclick="return managePrivileges('{{ $package->id }}')" title="{{ trans('packages.manage_privileges') }}">
                                    <i class="fa-solid fa-key"></i>
                                </a>

                                <a type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editPackage" onclick="return editPackage('{{ $package->id }}')" title="{{ trans('packages.edit_package') }}">
                                    <span class="fas fa-edit"></span>
                                </a>

                                <a class="btn btn-primary btn-sm" title="{{ trans('packages.destroy_package') }}" onclick="destroyPackage('{{ $package->id }}')"> <i class="fas fa-trash fa-sm"> </i> </a>

                                <form id="destroy_package_{{ $package->id }}" method="POST" action=" {{ route('staffs/packages/destroy', ['id' => $package->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                </form>                               
                            </td>
                        </tr>
                    @endforeach
            </tbody>

        </table>
    </div>
@endsection