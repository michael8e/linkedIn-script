@extends('layouts/app')

@section('head') @parent
<script src="{{ asset('js/app/templates/create.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/vendor/codemirror/editor.js') }}" type="text/javascript"></script>
<link rel="stylesheet" href="{{ asset('css/vendor/codemirror/editor.css') }}">
<!-- Load jQuery UI (we need resizabale plugin for editor resize emulation) !-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js" type="text/javascript"></script>
@include('php2js.variable_field')
@stop

@section('title') @parent - Create Template @stop

@section('page_header')
    Create template
@stop

@section('content')
    {!! Form::model($template, ['route' => ['templates.store'], 'id' => 'createTemplateForm', 'class' => 'are-you-sure']) !!}
    <div class="row">

        <div class="form-group @if ($errors->has('name')) has-error @endif">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'My_template']) !!}
            <span id="helpBlock" class="help-block">
                    Please use only alpha-numeric, dash and underscore. No spaces please
                </span>
            @if ($errors->has('name'))
                <span class="label label-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>

        <div class="form-group @if ($errors->has('description')) has-error @endif">
            {!! Form::label('description', 'Description(optional):') !!}<br>
            {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 7,'style' => 'resize:vertical']) !!}
            <span id="helpBlock" class="help-block">
                    Use {{ '<br>' }} tag for multiline description
            </span>
            @if ($errors->has('description'))
                <span class="label label-danger">{{ $errors->first('description') }}</span>
            @endif
        </div>

        <div class="form-group @if ($errors->has('group_id')) has-error @endif">
            {!! Form::label('group_id', 'Group (optional)') !!}
            {!! Form::select('group_id', $groupsOptions, $groupId, ['class' => 'form-control input-sm']) !!}
            <span id="helpBlock" class="help-block">
                    Use groups to organize your templates
                </span>
            @if ($errors->has('group_id'))
                <span class="label label-danger">{{ $errors->first('group_id') }}</span>
            @endif
        </div>
    </div>



    <div class="row">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#edit_body" aria-controls="edit_body" role="tab" data-toggle="tab">Edit body</a>
            </li>
            <li role="presentation">
                <a href="#live_preview" aria-controls="live_preview" role="tab" data-toggle="tab">Live preview</a>
            </li>
            <li role="presentation">
                <a href="#used_vars" aria-controls="used_vars" role="tab" data-toggle="tab">Used PHP variables</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="edit_body" role="tabpanel">

                <div class="col-md-9" style="padding-left: 0">
                    <div class="form-group @if ($errors->has('body')) has-error @endif">
                        {!! Form::label('body', 'Template source:') !!}<br>
                        {!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => 25,'style' => 'resize:vertical']) !!}
                        <span id="helpBlock" class="help-block">
                        <a class="text-info" href="https://laravel.com/docs/5.2/blade" target="_blank">Blade</a> syntax is allowed. Please use it very careful.
                    </span>
                        @if ($errors->has('body'))
                            <span style="display: block" class="label label-danger" title="{{ $errors->first('body') }}">{{ $errors->first('body') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        {!! Form::checkbox('prepareBeforeSave',true, true) !!}
                        {!! Form::label('prepareBeforeSave', 'Need to prepare') !!}

                        <span id="helpBlock" class="help-block">
                    (Optimize HTML, inline styles, replace images to our server)
                    </span>
                    </div>

                    <div class="row">
                        {!! Form::button('<span class="glyphicon glyphicon-ok"></span>&nbsp;Save', ['type' => 'submit', 'class' => 'btn btn-success','data-toggle' => 'modal', 'data-target' => '#pleaseWaitDialog']) !!}
                        <a href="/templates">
                            {!! Form::button('Cancel', ['id' => 'cancelCreate', 'class' => 'btn btn-default']) !!}
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3" style="padding-right: 0">
                        <div class="form-group">
                            {!! Form::label('context', 'Show available variables:') !!}<br>
                            {!! Form::select('context', $contextOptions, 'no_context', ['class' => 'form-control input-sm', 'data-ays-ignore' => 'true']) !!}
                            <br>
                            <ul class="list-group varList" id="contextVars"></ul>
                        </div>
                    </div>
                </div>

            </div>

            <div class="tab-pane" id="live_preview" role="tabpanel">
                <div class="form-group">
                    {!! Form::label('preview_frame', 'How it looks:') !!}<br>
                    <iframe id="preview_frame"  height="500px" width="100%"></iframe>
                    <span id="helpBlock" class="help-block">
                            Blade is not actually rendered here. Use this to check HTML look & feel.
                    </span>
                </div>
            </div>

            <div class="tab-pane" id="used_vars" role="tabpanel">
                <div class="form-group">
                    {!! Form::textarea('usedVars', 'No vars found', ['id' => 'usedVars', 'class' => 'form-control', 'rows' => 20, 'style' => 'resize:vertical', 'readonly' => 'readonly']) !!}
                    <span id="helpBlock" class="help-block">
                            Parsed from editor
                    </span>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
