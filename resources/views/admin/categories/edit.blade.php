@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.categories.title')</h3>
    
    {!! Form::model($category, ['method' => 'PUT', 'route' => ['admin.categories.update', $category->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('categorie', trans('quickadmin.categories.fields.categorie').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('categorie', old('categorie'), ['class' => 'form-control', 'placeholder' => 'catégorie des articles', 'required' => '']) !!}
                    <p class="help-block">catégorie des articles</p>
                    @if($errors->has('categorie'))
                        <p class="help-block">
                            {{ $errors->first('categorie') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Article
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>@lang('quickadmin.article.fields.titre')</th>
                        
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="article">
                    @forelse(old('articles', []) as $index => $data)
                        @include('admin.categories.articles_row', [
                            'index' => $index
                        ])
                    @empty
                        @foreach($category->articles as $item)
                            @include('admin.categories.articles_row', [
                                'index' => 'id-' . $item->id,
                                'field' => $item
                            ])
                        @endforeach
                    @endforelse
                </tbody>
            </table>
            <a href="#" class="btn btn-success pull-right add-new">@lang('quickadmin.qa_add_new')</a>
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script type="text/html" id="article-template">
        @include('admin.categories.articles_row',
                [
                    'index' => '_INDEX_',
                ])
               </script > 

            <script>
        $('.add-new').click(function () {
            var tableBody = $(this).parent().find('tbody');
            var template = $('#' + tableBody.attr('id') + '-template').html();
            var lastIndex = parseInt(tableBody.find('tr').last().data('index'));
            if (isNaN(lastIndex)) {
                lastIndex = 0;
            }
            tableBody.append(template.replace(/_INDEX_/g, lastIndex + 1));
            return false;
        });
        $(document).on('click', '.remove', function () {
            var row = $(this).parentsUntil('tr').parent();
            row.remove();
            return false;
        });
        </script>
@stop