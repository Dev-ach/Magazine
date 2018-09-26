@extends('layouts.master')
@section('content')
<!-- Feature Category Section & sidebar -->
<section id="feature_category_section" class="feature_category_section single-page section_wrapper">
	<div class="container">   
		<div class="row">
		   	 <div class="col-md-9">
				<div class="single_content_layout">
					<div class="item feature_news_item">
						<div class="item_img">
							<img  class="img-responsive" src="{{ asset(env('UPLOAD_PATH').'/' . $article->image) }}" alt="Chania">
						</div><!--item_img--> 
							<div class="item_wrapper">
								<div class="news_item_title">
									<h2>{{ $article->titre }}</h2>
								</div><!--news_item_title-->
								<div class="item_meta">{{ $article->updated_at->format('d-m-Y') }},  par: {{$article->redacteur->name}}</div>


									<div class="item_content">
									{{$article->contenue}}
									</div><!--item_content-->

                                    <div class="category_list">
									@foreach ($article->tag_id as $singleTagId)
                                        <a href="#">{{ $singleTagId->tag }}</a>
                                    @endforeach
                                    </div><!--category_list-->
							</div><!--item_wrapper-->	
					</div><!--feature_news_item-->
					
					

					<div class="readers_comment">
                        <div class="single_media_title"><h2>Commentaire sur l'article</h2></div>
						<?php $valider = 0 ?>
						@forelse($commentaires as $commentaire)
						@if($commentaire->valider == 1)
						<div class="media">
							<div class="media-left">
								<a href="#">
									<img alt="64x64" class="media-object imgS" data-src="{{ asset('img/avatar.png') }}"
										 src="{{ asset('img/avatar.png') }}" data-holder-rendered="true">
								</a>
							</div>
							<div class="media-body">
								<h2 class="media-heading">{{$commentaire->pseudo}}</h2>
								{{$commentaire->commentaire}}
							</div>

						</div>
						<?php $valider = 1 ?>
						@endif
						@empty
						<div class="media-body">
						Aucun commentaire pour le moment.
						</div>
						<?php $valider = 2 ?>
						@endforelse
						@if($valider==0)
						<div class="media-body">
						Aucun commentaire pour le moment.
						</div>
						@endif
					</div><!--readers_comment-->

					<div class="add_a_comment">
						<div class="single_media_title"><h2>Ajouter un commentaire</h2></div>
						<div class="comment_form">
							<form action="{{ url('commentaire')}}" method="post">
							{{ csrf_field() }}
	                            <div class="form-group">
	                                <input type="text" name="pseudo" placeholder="Entrer votre pseudo" class="form-control" id="inputName">
	                            </div>
	                            <div class="form-group">
	                                <input type="text" name="email" class="form-control" id="inputEmail" placeholder="Entrer votre Email">
	                            </div>
	                            <div class="form-group comment">
	                                <textarea class="form-control" id="inputComment" name="commentaire" placeholder="Entrer votre Commentaire"></textarea>
	                            </div>
								<input id="prodId" name="article_id" type="hidden" value="{{$article->id}}">
	                            <button type="submit" class="btn btn-submit red">Submit</button>
	                        </form>
                        </div><!--comment_form-->
					</div><!--add_a_comment-->
				   			 
				</div><!--single_content_layout-->
		   	 </div>

				<div class="col-md-3">

				<div class="tab sitebar">
					<ul class="nav nav-tabs">
						<li class="active"><a  href="#1" data-toggle="tab">DERNIER</a></li>
						<li><a href="#2" data-toggle="tab">POPULAIRE</a></li>
					</ul>

					<div class="tab-content">
						<div class="tab-pane active" id="1">
						@foreach ($allarticles as $article)
						@if($loop->index == 4)
							@break
						@endif
						@if($article->publier == 1)
							<div class="media">
								<div class="media-left">
									<a href="#"><img class="media-object imgS" src="{{ asset(env('UPLOAD_PATH').'/' . $article->image) }}" alt="Generic placeholder image"></a>
								</div><!--media-left-->
								<div class="media-body">
									<h4 class="media-heading"><a href="{{ url('article/'.$article->id) }}">{{$article->titre}}</a></h4>
									<div class="item_meta">{{ $article->updated_at->format('d-m-Y') }}</div>
								</div><!--media-body-->
							</div><!--media-->
						@endif
						@endforeach
						</div><!--tab-pane-->
						
						<div class="tab-pane" id="2">
						@foreach ($artcom as $article)
						@if($loop->index == 4)
							@break
						@endif
						@if($article->publier == 1)
							<div class="media">
								<div class="media-left">
									<a href="#"><img class="media-object imgS" src="{{ asset(env('UPLOAD_PATH').'/' . $article->image) }}" alt="Generic placeholder image"></a>
								</div><!--media-left-->
								<div class="media-body">
									<h4 class="media-heading"><a href="{{ url('article/'.$article->id) }}">{{$article->titre}}</a></h4>
									<div class="item_meta">{{ $article->updated_at->format('d-m-Y') }}</div>
								</div><!--media-body-->
							</div><!--media-->
						@endif
						@endforeach
						</div><!--tab-pane-->
					</div><!--tab-content-->
				</div><!--tab-->

				



				<div class="most_comment">
				<div class="sidebar_title">
                        <h2>Le plus Commenté</h2>
                    </div>
					@foreach ($artcomv as $ac)
					@if($loop->index == 5)
						@break
					@endif
					@if($article->publier == 1)
                    <div class="media">
                        <div class="media-left">
                            <a href="#"><img class="media-object imgS" src="{{ asset(env('UPLOAD_PATH').'/' . $ac->image) }}" alt="Generic placeholder image"></a>
                        </div><!--media-left-->
                        <div class="media-body">
                            <h3 class="media-heading"><a href="{{ url('article/'.$ac->id) }}">{{$ac->titre}}</a></h3>
                             <div class="comment_box">
                                <div class="comments_icon"> <i class="fa fa-comments" aria-hidden="true"></i></div>
                                 <div class="comments"><a href="#">{{$ac->comCount}} Commentaires</a></div>
                             </div><!--comment_box-->
                        </div><!--media-body-->
                    </div><!--media-->
					@endif
					@endforeach
				</div><!--most_comment-->
			</div>
		</div>	   	
</section><!--feature_category_section-->
@endsection