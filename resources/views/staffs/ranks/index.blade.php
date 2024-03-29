@extends('staffs.app')

@section('title')
{{ trans('home.ranks') }}
@endsection

@section('js')
    @include('staffs.ranks.js')

    <script type="module">
        $('#myRanksTable').DataTable({
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

    @include('staffs.ranks.edit')

    <div class="p-3 my-3 bg-primary text-white">
        <div class="btn-group float-end">
            <a  href="{{ route('staffs/ranks/create') }}" class="btn btn-light"> <i class="fa-solid fa-user-plus"></i> {{ trans('ranks.create_rank') }} </a>
        </div>

        <h1> <span class="fas fa-user-tag"> </span> {{ trans('home.ranks') }} </h1>
        <p class="col-9"> {{trans('ranks.welcome_message') }} </p>
    </div>

    <div>
        <table class="table table-striped" id="myRanksTable">
            <thead>
                <tr>
                    <th> {{ trans('ranks.name') }} </th>
                    <th> {{ trans('ranks.price') }} </th>
                    <th class="text-end"> {{ trans('forms.actions') }}</th>
                </tr>
            </thead>
            
            <tbody>
                @if ($ranks->isNotEmpty())
                    @foreach ($ranks as $rank)
                        <tr>
                            <td id="rank_name_{{ $rank->id }}"> {{ $rank->name }} </td>
                            <td id="rank_price_{{ $rank->id }}"> ${{ number_format($rank->price, 2, ',', '.') }} </td>

                            <td class="text-end form-inline">          
                                <a type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editRank" onclick="return editRank('{{ $rank->id }}')" title="{{ trans('ranks.edit_rank') }}">
                                    <span class="fas fa-edit"></span>
                                </a>

                                <a class="btn btn-primary btn-sm" title="{{ trans('ranks.destroy_rank') }}" onclick="destroyRank('{{ $rank->id }}')"> <i class="fas fa-trash fa-sm"> </i> </a>

                                <form id="destroy_rank_{{ $rank->id }}" method="POST" action=" {{ route('staffs/ranks/destroy', ['id' => $rank->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                </form>                               
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>

        </table>
    </div>
@endsection