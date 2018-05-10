@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.tour-program.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.tour-program.fields.month')</th>
                            <td field-key='month'>{{ $tour_program->month }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.tour-program.fields.select-date')</th>
                            <td field-key='select_date'>{{ $tour_program->select_date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.tour-program.fields.medical-representative-name')</th>
                            <td field-key='medical_representative_name'>{{ $tour_program->medical_representative_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.tour-program.fields.area')</th>
                            <td field-key='area'>{{ $tour_program->area }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.tour-program.fields.modification')</th>
                            <td field-key='modification'>{{ $tour_program->modification }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.tour-program.fields.remarks')</th>
                            <td field-key='remarks'>{!! $tour_program->remarks !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.tour-program.fields.work-with-manager')</th>
                            <td field-key='work_with_manager'>{{ $tour_program->work_with_manager }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.tour_programs.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
