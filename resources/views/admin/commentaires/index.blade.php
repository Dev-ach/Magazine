@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.commentaires.title')</h3>
    @can('commentaire_create')
    <p>
        <a href="{{ route('admin.commentaires.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    @can('commentaire_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.commentaires.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.commentaires.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($commentaires) > 0 ? 'datatable' : '' }} @can('commentaire_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('commentaire_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('quickadmin.commentaires.fields.pseudo')</th>
                        <th>@lang('quickadmin.commentaires.fields.email')</th>
                        <th>@lang('quickadmin.commentaires.fields.commentaire')</th>
                        <th>@lang('quickadmin.commentaires.fields.valider')</th>
                        <th>@lang('quickadmin.commentaires.fields.article')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($commentaires) > 0)
                        @foreach ($commentaires as $commentaire)
                            <tr data-entry-id="{{ $commentaire->id }}">
                                @can('commentaire_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='pseudo'>{{ $commentaire->pseudo }}</td>
                                <td field-key='email'>{{ $commentaire->email }}</td>
                                <td field-key='commentaire'>{{ $commentaire->commentaire }}</td>
                                <td field-key='valider'>{{ Form::checkbox("valider", 1, $commentaire->valider == 1 ? true : false, ["disabled"]) }}</td>
                                <td field-key='article'>{{ $commentaire->article->titre or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('commentaire_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.commentaires.restore', $commentaire->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('commentaire_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.commentaires.perma_del', $commentaire->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('commentaire_view')
                                    <a href="{{ route('admin.commentaires.show',[$commentaire->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('commentaire_edit')
                                    <a href="{{ route('admin.commentaires.edit',[$commentaire->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('commentaire_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.commentaires.destroy', $commentaire->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('commentaire_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.commentaires.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection