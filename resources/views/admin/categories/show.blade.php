@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.categories.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.categories.fields.categorie')</th>
                            <td field-key='categorie'>{{ $category->categorie }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#article" aria-controls="article" role="tab" data-toggle="tab">Article</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="article">
<table class="table table-bordered table-striped {{ count($articles) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.article.fields.titre')</th>
                        <th>@lang('quickadmin.article.fields.contenue')</th>
                        <th>@lang('quickadmin.article.fields.tag-id')</th>
                        <th>@lang('quickadmin.article.fields.image')</th>
                        <th>@lang('quickadmin.article.fields.publier')</th>
                        <th>@lang('quickadmin.article.fields.redacteur')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($articles) > 0)
            @foreach ($articles as $article)
                <tr data-entry-id="{{ $article->id }}">
                    <td field-key='titre'>{{ $article->titre }}</td>
                                <td field-key='contenue'>{!! $article->contenue !!}</td>
                                <td field-key='tag_id'>
                                    @foreach ($article->tag_id as $singleTagId)
                                        <span class="label label-info label-many">{{ $singleTagId->tag }}</span>
                                    @endforeach
                                </td>
                                <td field-key='image'>@if($article->image)<a href="{{ asset(env('UPLOAD_PATH').'/' . $article->image) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $article->image) }}"/></a>@endif</td>
                                <td field-key='publier'>{{ Form::checkbox("publier", 1, $article->publier == 1 ? true : false, ["disabled"]) }}</td>
                                <td field-key='redacteur'>{{ $article->redacteur->name or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('article_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.articles.restore', $article->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('article_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.articles.perma_del', $article->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('article_view')
                                    <a href="{{ route('admin.articles.show',[$article->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('article_edit')
                                    <a href="{{ route('admin.articles.edit',[$article->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('article_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.articles.destroy', $article->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="12">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.categories.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
