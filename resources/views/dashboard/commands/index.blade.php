@extends('layouts.dashboard')

@section('content')
    <div class="row">
        @include('dashboard.commands._partials.list', [ 'step' => 'before', 'action' => $action - 1 ])
        @include('dashboard.commands._partials.list', [ 'step' => 'after', 'action' => $action + 1 ])
    </div>

    @include('dashboard.projects._dialogs.command')
@stop

@push('javascript')
    <script type="text/javascript">
        new Fixhub.CommandsTab();
        Fixhub.Commands.add({!! $commands !!});
    </script>
    <script src="{{ cdn('js/ace.js') }}"></script>
@endpush

@push('templates')
    <script type="text/template" id="command-template">
        <td data-command-id="<%- id %>"><span class="drag-handle"><i class="fixhub fixhub-drag"></i></span> <%- name %></td>
        <td>
            <%= user ? user : '{{ trans('commands.default') }}' %>
        </td>
        <td>
            <% if (optional) { %>
                {{ trans('app.yes') }}
            <% } else { %>
                {{ trans('app.no') }}
            <% } %>
        </td>
        <td>
            <div class="btn-group pull-right">
                @if($project->can('manage'))
                <button type="button" class="btn btn-default btn-edit" title="{{ trans('commands.edit') }}" data-toggle="modal" data-target="#command"><i class="fixhub fixhub-edit"></i></button>
                <button type="button" class="btn btn-danger btn-delete" title="{{ trans('commands.delete') }}" data-toggle="modal" data-target="#model-trash"><i class="fixhub fixhub-delete"></i></button>
                @endif
            </div>
        </td>
    </script>
@endpush
