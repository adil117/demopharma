@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.tour-program.title')</h3>
    @can('tour_program_create')
    <p>
        <a href="{{ route('admin.tour_programs.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        <a href="#" class="btn btn-warning" style="margin-left:5px;" data-toggle="modal" data-target="#myModal">@lang('global.app_csvImport')</a>
        @include('csvImport.modal', ['model' => 'TourProgram'])
        
        @if(!is_null(Auth::getUser()->role_id) && config('global.can_see_all_records_role_id') == Auth::getUser()->role_id)
            @if(Session::get('TourProgram.filter', 'all') == 'my')
                <a href="?filter=all" class="btn btn-default">Show all records</a>
            @else
                <a href="?filter=my" class="btn btn-default">Filter my records</a>
            @endif
        @endif
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.tour_programs.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.tour_programs.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped ajaxTable @can('tour_program_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('tour_program_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.tour-program.fields.month')</th>
                        <th>@lang('global.tour-program.fields.select-date')</th>
                        <th>@lang('global.tour-program.fields.medical-representative-name')</th>
                        <th>@lang('global.tour-program.fields.area')</th>
                        <th>@lang('global.tour-program.fields.modification')</th>
                        <th>@lang('global.tour-program.fields.remarks')</th>
                        <th>@lang('global.tour-program.fields.work-with-manager')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('tour_program_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.tour_programs.mass_destroy') }}'; @endif
        @endcan
        $(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('admin.tour_programs.index') !!}?show_deleted={{ request('show_deleted') }}';
            window.dtDefaultOptions.columns = [@can('tour_program_delete')
                @if ( request('show_deleted') != 1 )
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endif
                @endcan{data: 'month', name: 'month'},
                {data: 'select_date', name: 'select_date'},
                {data: 'medical_representative_name', name: 'medical_representative_name'},
                {data: 'area', name: 'area'},
                {data: 'modification', name: 'modification'},
                {data: 'remarks', name: 'remarks'},
                {data: 'work_with_manager', name: 'work_with_manager'},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection