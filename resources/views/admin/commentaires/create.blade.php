@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.commentaires.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.commentaires.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('pseudo', trans('quickadmin.commentaires.fields.pseudo').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('pseudo', old('pseudo'), ['class' => 'form-control', 'placeholder' => 'pseudo pour commenter ', 'required' => '']) !!}
                    <p class="help-block">pseudo pour commenter </p>
                    @if($errors->has('pseudo'))
                        <p class="help-block">
                            {{ $errors->first('pseudo') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('email', trans('quickadmin.commentaires.fields.email').'*', ['class' => 'control-label']) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'email pour commenter ', 'required' => '']) !!}
                    <p class="help-block">email pour commenter </p>
                    @if($errors->has('email'))
                        <p class="help-block">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('commentaire', trans('quickadmin.commentaires.fields.commentaire').'', ['class' => 'control-label']) !!}
                    {!! Form::text('commentaire', old('commentaire'), ['class' => 'form-control', 'placeholder' => 'le commentaire ']) !!}
                    <p class="help-block">le commentaire </p>
                    @if($errors->has('commentaire'))
                        <p class="help-block">
                            {{ $errors->first('commentaire') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('valider', trans('quickadmin.commentaires.fields.valider').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('valider', 0) !!}
                    {!! Form::checkbox('valider', 1, old('valider', false), []) !!}
                    <p class="help-block">valider le commentaire</p>
                    @if($errors->has('valider'))
                        <p class="help-block">
                            {{ $errors->first('valider') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('article_id', trans('quickadmin.commentaires.fields.article').'', ['class' => 'control-label']) !!}
                    {!! Form::select('article_id', $articles, old('article_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">article du commentaire </p>
                    @if($errors->has('article_id'))
                        <p class="help-block">
                            {{ $errors->first('article_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

