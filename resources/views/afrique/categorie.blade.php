@extends('layouts.master')
@section('content')
	<!-- Feature Category Section & sidebar -->
	<section id="feature_category_section" class="feature_category_section category_page section_wrapper">
	<div class="container">   
		<div class="row">
		   	<div class="col-md-9">
			   <?php $cross = 0 ?>
				@forelse($articles as $article)
				@if($cross == 1)
					@break
				@endif
				@if($article->publier == 1)
				@if($cross==0)
		   		<div class="row">
					<div class="col-md-12">
						<div class="feature_news_item category_item">
                			<div class="item">
								<div class="item_wrapper">
									<div class="item_img">
										<img class="img-responsive" src="{{ asset(env('UPLOAD_PATH').'/' . $article->image) }}" alt="Chania">
									</div><!--item_img--> 
									<div class="item_title_date">
										<div class="news_item_title">
											<h1><a href="{{ url('article/'.$article->id) }}">{{ $article->titre }}</a></h1>
										</div><!--news_item_title-->
										<div class="item_meta">{{ $article->updated_at->format('d-m-Y') }},  par: {{$article->redacteur->name}}</div>
									</div><!--item_title_date-->
								</div><!--item_wrapper-->
							    <div class="item_content">{{$article->contenue}}
							    </div><!--item_content-->

							</div><!--item-->               			 
            			</div><!--feature_news_item-->
					</div><!--col-md-6-->
				</div>
				<?php $cross = 1 ?>	
				@endif
				@endif
				@empty
				<div class="row">
					<div class="col-md-10">
						<div class="panel panel-default">
						<div class="panel-body">
							Aucun article pour le moment dans cette catégorie
						</div>
						</div>
					</div>
				</div>
				@endforelse
				<div class="row">	
				@foreach($articles as $article)
				@if($cross == 12)
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
					<?php $cross = 12 ?>
					@endforeach
				</div><!--row-->	
		   	</div><!--col-md-9-->

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