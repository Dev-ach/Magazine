@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.commentaires.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.commentaires.fields.pseudo')</th>
                            <td field-key='pseudo'>{{ $commentaire->pseudo }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.commentaires.fields.email')</th>
                            <td field-key='email'>{{ $commentaire->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.commentaires.fields.commentaire')</th>
                            <td field-key='commentaire'>{{ $commentaire->commentaire }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.commentaires.fields.valider')</th>
                            <td field-key='valider'>{{ Form::checkbox("valider", 1, $commentaire->valider == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.commentaires.fields.article')</th>
                            <td field-key='article'>{{ $commentaire->article->titre or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.commentaires.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
