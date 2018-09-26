@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.article.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.article.fields.titre')</th>
                            <td field-key='titre'>{{ $article->titre }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.article.fields.contenue')</th>
                            <td field-key='contenue'>{!! $article->contenue !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.article.fields.tag-id')</th>
                            <td field-key='tag_id'>
                                @foreach ($article->tag_id as $singleTagId)
                                    <span class="label label-info label-many">{{ $singleTagId->tag }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.article.fields.image')</th>
                            <td field-key='image'>@if($article->image)<a href="{{ asset(env('UPLOAD_PATH').'/' . $article->image) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $article->image) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.article.fields.publier')</th>
                            <td field-key='publier'>{{ Form::checkbox("publier", 1, $article->publier == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.article.fields.redacteur')</th>
                            <td field-key='redacteur'>{{ $article->redacteur->name or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#commentaires" aria-controls="commentaires" role="tab" data-toggle="tab">Commentaires</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="commentaires">
<table class="table table-bordered table-striped {{ count($commentaires) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
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

            <p>&nbsp;</p>

            <a href="{{ route('admin.articles.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
