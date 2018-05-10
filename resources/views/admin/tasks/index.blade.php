@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.tasks.title')</h3>
    @can('task_create')
    <p>
        <a href="{{ route('admin.tasks.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped ajaxTable @can('task_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('task_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.tasks.fields.name')</th>
                        <th>@lang('global.tasks.fields.description')</th>
                        <th>@lang('global.tasks.fields.status')</th>
                        <th>@lang('global.tasks.fields.tag')</th>
                        <th>@lang('global.tasks.fields.attachment')</th>
                        <th>@lang('global.tasks.fields.due-date')</th>
                        <th>@lang('global.tasks.fields.user')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('task_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.tasks.mass_destroy') }}';
        @endcan
        $(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('admin.tasks.index') !!}';
            window.dtDefaultOptions.columns = [@can('task_delete')
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endcan{data: 'name', name: 'name'},
                {data: 'description', name: 'description'},
                {data: 'status.name', name: 'status.name'},
                {data: 'tag.name', name: 'tag.name'},
                {data: 'attachment', name: 'attachment'},
                {data: 'due_date', name: 'due_date'},
                {data: 'user.name', name: 'user.name'},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection