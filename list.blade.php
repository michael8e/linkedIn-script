@extends('layouts/app')

@section('head')
@parent
<script src="{{ asset('js/app/templates/list.js') }}" type="text/javascript"></script>
@stop

@section('title') @parent - All Templates @stop

@section('page_header')
    Templates
@stop

@section('content')
    <div class="row">
        <div class="form-group">
            <a href="/templates/create">
                {!! Form::button('<span class="glyphicon glyphicon-plus"></span>&nbsp;Create', ['class' => 'btn btn-success']) !!}
            </a>
            <a href="/templates/import">
                {!! Form::button('<span class="glyphicon glyphicon glyphicon-import"></span>&nbsp;Import', ['class' => 'btn btn-success']) !!}
            </a>
        </div>

        <div class="form-group">
        {!! Form::open(['action' => 'TemplatesController@index', 'method' => 'get', 'class' => 'form-inline text-center']) !!}
        {!! Form::label('group_id', 'Filter by group') !!}
        {!! Form::select('group_id', $groupsOptions, $groupId, ['class' => 'form-control input-sm']) !!}
        {!! Form::button('Update', ['id' => 'updateFilters', 'class' => 'btn btn-success btn-sm', 'type' => 'submit']) !!}

        {!! Form::close() !!}
        </div>
    </div>
    <div class="row">
        @if (!empty($templates) && (count($templates) > 0))
            <table class="table table-bordered table-condensed table-hover longtext">
                <tr>
                    <th class="text-right col-md-1">Id</th>
                    <th class="text-left col-md-2">Name</th>
                    <th class="text-left">Description</th>
                    <th class="text-right col-md-2">Actions</th>
                </tr>

                @foreach($templates as $template)
                    <tr>
                        <td class="text-right">
                            {{ $template->id }}
                        </td>
                        <td class="text-left">
                            <a class="text-info" href="{{ route('templates.show', [$template->id]) }}" title="Click to view a template" target="_blank"> {{ $template->name }}</a>
                        </td>

                        <td class="text-left">
                            <samp>
                                {!! strip_tags($template->description, '<br>') !!}
                            </samp>
                        </td>


                        <td class="text-right">
                            <a href="{{ route('templates.export', [$template->id]) }}">
                                {!! Form::button('<span class="glyphicon glyphicon glyphicon-export"></span>', ['title' => 'Export', 'id' => 'export_' . $template->id, 'class' => 'btn btn-info']) !!}
                            </a>
                            <a href="{{ route('templates.edit', [$template->id]) }}">
                                {!! Form::button('<span class="glyphicon glyphicon-pencil"></span>', ['title' => 'Edit', 'id' => 'edit_' . $template->id, 'class' => 'btn btn-default']) !!}
                            </a>

                            {!! Form::open(['route' => ['templates.destroy', $template->id], 'method' => 'delete', 'style' => 'display: inline;']) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-remove"></span>', ['title' => 'Delete', 'class' => 'btn btn-danger confirm-submit']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <div class="jumbotron">
                <h4>Templates not found</h4>
                <p>Try to change filtering</p>
            </div>
        @endif
        <a href="/templates/create">
            {!! Form::button('<span class="glyphicon glyphicon-plus"></span>&nbsp;Create', ['class' => 'btn btn-success']) !!}
        </a>
        <a href="/templates/import">
            {!! Form::button('<span class="glyphicon glyphicon glyphicon glyphicon-import"></span>&nbsp;Import', ['class' => 'btn btn-success']) !!}
        </a>
    </div>
    {!! $templates->appends(['group_id' => $groupId])->links() !!}
@endsection