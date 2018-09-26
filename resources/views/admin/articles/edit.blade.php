@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.article.title')</h3>
    
    {!! Form::model($article, ['method' => 'PUT', 'route' => ['admin.articles.update', $article->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('titre', trans('quickadmin.article.fields.titre').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('titre', old('titre'), ['class' => 'form-control', 'placeholder' => 'titre de l\'article', 'required' => '']) !!}
                    <p class="help-block">titre de l'article</p>
                    @if($errors->has('titre'))
                        <p class="help-block">
                            {{ $errors->first('titre') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('contenue', trans('quickadmin.article.fields.contenue').'*', ['class' => 'control-label']) !!}
                    {!! Form::textarea('contenue', old('contenue'), ['class' => 'form-control ', 'placeholder' => 'contenue de l\'article', 'required' => '']) !!}
                    <p class="help-block">contenue de l'article</p>
                    @if($errors->has('contenue'))
                        <p class="help-block">
                            {{ $errors->first('contenue') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('categories_id', trans('quickadmin.article.fields.categories').'', ['class' => 'control-label']) !!}
                    {!! Form::select('categories_id', $categories, old('categories_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('categories_id'))
                        <p class="help-block">
                            {{ $errors->first('categories_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('tag_id', trans('quickadmin.article.fields.tag-id').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-tag_id">
                        {{ trans('quickadmin.qa_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-tag_id">
                        {{ trans('quickadmin.qa_deselect_all') }}
                    </button>
                    {!! Form::select('tag_id[]', $tag_ids, old('tag_id') ? old('tag_id') : $article->tag_id->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-tag_id' ]) !!}
                    <p class="help-block">tags de l'article</p>
                    @if($errors->has('tag_id'))
                        <p class="help-block">
                            {{ $errors->first('tag_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    @if ($article->image)
                        <a href="{{ asset(env('UPLOAD_PATH').'/'.$article->image) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/'.$article->image) }}"></a>
                    @endif
                    {!! Form::label('image', trans('quickadmin.article.fields.image').'', ['class' => 'control-label']) !!}
                    {!! Form::file('image', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                    {!! Form::hidden('image_max_size', 2) !!}
                    {!! Form::hidden('image_max_width', 4096) !!}
                    {!! Form::hidden('image_max_height', 4096) !!}
                    <p class="help-block">image de l'article</p>
                    @if($errors->has('image'))
                        <p class="help-block">
                            {{ $errors->first('image') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('publier', trans('quickadmin.article.fields.publier').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('publier', 0) !!}
                    {!! Form::checkbox('publier', 1, old('publier', old('publier')), []) !!}
                    <p class="help-block">publier l'article</p>
                    @if($errors->has('publier'))
                        <p class="help-block">
                            {{ $errors->first('publier') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('redacteur_id', trans('quickadmin.article.fields.redacteur').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('redacteur_id', $redacteurs, old('redacteur_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block">rédacteur de l'article</p>
                    @if($errors->has('redacteur_id'))
                        <p class="help-block">
                            {{ $errors->first('redacteur_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script>
        $("#selectbtn-tag_id").click(function(){
            $("#selectall-tag_id > option").prop("selected","selected");
            $("#selectall-tag_id").trigger("change");
        });
        $("#deselectbtn-tag_id").click(function(){
            $("#selectall-tag_id > option").prop("selected","");
            $("#selectall-tag_id").trigger("change");
        });
    </script>
@stop