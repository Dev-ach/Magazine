@extends('layouts.master')
@section('content')
<br><br>

<div class="container"> 
    <div class="row">
    <div class="media-body">
        le résultat de la recherche <strong>"{{$result}}"</stronge> :
    </div>
    </div>
    <br>
    <div class="row">
    @forelse($articles as $article)
    @if($article->publier == 1)
        <div class="col-md-6">
            <div class="feature_news_item">
                <div class="item">
                    <div class="item_wrapper">
                        <div class="item_img">
                            <img class="img-responsive" src="{{ asset(env('UPLOAD_PATH').'/' . $article->image) }}" alt="Chania">
                        </div> <!--item_img-->
                        <div class="item_title_date">
                            <div class="news_item_title">
                                <h2><a href="{{ url('article/'.$article->id) }}">{{$article->titre}}</a></h2>
                            </div>
                            <div class="item_meta">{{ $article->updated_at->format('d-m-Y') }},  par: {{$article->redacteur->name}}</div>
                        </div><!--item_title_date-->
                    </div> <!--item_wrapper-->
                    <div class="item_content">{{$article->contenue}}
                    </div>

                </div><!--item-->
            </div><!--feature_news_item-->
        </div><!--col-md-6-->	
        @endif
        @empty
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                <div class="panel-body">
                    Aucun article trouver.
                </div>
                </div>
            </div>
        </div>
        @endforelse		
    </div>
</div>
<br><br><br><br><br><br><br>
@endsection