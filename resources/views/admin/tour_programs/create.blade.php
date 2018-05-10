@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.tour-program.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.tour_programs.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('month', trans('global.tour-program.fields.month').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('month', $enum_month, old('month'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('month'))
                        <p class="help-block">
                            {{ $errors->first('month') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('select_date', trans('global.tour-program.fields.select-date').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('select_date', old('select_date'), ['class' => 'form-control date', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('select_date'))
                        <p class="help-block">
                            {{ $errors->first('select_date') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('medical_representative_name', trans('global.tour-program.fields.medical-representative-name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('medical_representative_name', old('medical_representative_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('medical_representative_name'))
                        <p class="help-block">
                            {{ $errors->first('medical_representative_name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('area', trans('global.tour-program.fields.area').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('area', old('area'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('area'))
                        <p class="help-block">
                            {{ $errors->first('area') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('modification', trans('global.tour-program.fields.modification').'', ['class' => 'control-label']) !!}
                    {!! Form::text('modification', old('modification'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('modification'))
                        <p class="help-block">
                            {{ $errors->first('modification') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('remarks', trans('global.tour-program.fields.remarks').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('remarks', old('remarks'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('remarks'))
                        <p class="help-block">
                            {{ $errors->first('remarks') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('work_with_manager', trans('global.tour-program.fields.work-with-manager').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('work_with_manager', old('work_with_manager'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('work_with_manager'))
                        <p class="help-block">
                            {{ $errors->first('work_with_manager') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent
    <script>
        $('.date').datepicker({
            autoclose: true,
            dateFormat: "{{ config('app.date_format_js') }}"
        });
    </script>

@stop