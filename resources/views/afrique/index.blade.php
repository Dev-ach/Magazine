@extends('layouts.master')
@section('content')
<!-- Feature Carousel Section -->
<section id="feature_news_section" class="feature_news_section section_wrapper">
	<div class="container">   
	    <div class="row">
	    	<div class="col-md-6">
	    		<div class="feature_news_carousel">
					<div id="featured-news-carousal" class="carousel slide" data-ride="carousel">
					    <!-- Wrapper for slides -->
						<div class="carousel-inner" role="listbox">		
						<?php $cross = 0 ?>
						@foreach ($articles as $article)
						@if($loop->index == 7)
							@break
						@endif
						@if($article->publier == 1)
						@if($cross==0)		    
							<div class="item active feature_news_item">
								<div class="item_wrapper">
									<div class="item_img">
										<img class="img-responsive imgL" src="{{ asset(env('UPLOAD_PATH').'/' . $article->image) }}" alt="Chania">
									</div> <!--item_img-->
									<div class="item_title_date">
										<div class="news_item_title">
											<h2><a href="{{ url('article/'.$article->id) }}">{{ $article->titre }}</a></h2>
										</div>
										<div class="item_meta">{{ $article->updated_at->format('d-m-Y') }},  par: {{$article->redacteur->name}}</div>
									</div> <!--item_title_date-->
								</div>	<!--item_wrapper-->
							    <div class="item_content">{{$article->contenue}}</div>

							</div><!--feature_news_item-->
							<?php $cross = 1 ?>
						@else
						<div class="item feature_news_item">
							<div class="item_wrapper">
								<div class="item_img">
									<img class="img-responsive imgL" src="{{ asset(env('UPLOAD_PATH').'/' . $article->image) }}" alt="Chania">
								</div> <!--item_img-->
								<div class="item_title_date">
									<div class="news_item_title">
										<h2><a href="{{ url('article/'.$article->id) }}">{{ $article->titre }}</a></h2>
									</div>
									<div class="item_meta">{{ $article->updated_at->format('d-m-Y') }},  par: {{$article->redacteur->name}}</div>
								</div> <!--item_title_date-->
							</div>	<!--item_wrapper-->
							<div class="item_content">{{$article->contenue}}</div>

						</div><!--feature_news_item-->
						@endif
						@endif
						
						@endforeach

					  		<!-- Left and right controls -->
							<div class="control-wrapper">
								<a class="left carousel-control" href="#featured-news-carousal" role="button" data-slide="prev">
									<i class="fa fa-chevron-left" aria-hidden="true"></i>
								</a>
								<a class="right carousel-control" href="#featured-news-carousal" role="button" data-slide="next">
									<i class="fa fa-chevron-right" aria-hidden="true"></i>
								</a>
							</div>
						</div><!--carousel-inner-->
	    			</div><!--carousel-->
	    		</div><!--feature_news_carousel-->
	    	</div><!--col-md-6-->
	    	
	    	<div class="col-md-6">
	    		<div class="feature_news_static">
		    		<div class="row">
						<div class="embed-responsive embed-responsive-16by9 imgIF">
							<iframe class="" src="https://www.youtube.com/embed/videoseries?list=PLB3xESPQdBXa482KXXJvfzgTkUPMujxRn" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
						</div>
					</div><!--row-->
	    		</div><!--feature_news_static-->
	    	</div><!--col-md-6-->
	    </div><!--row-->
	</div><!--container-->   	
</section><!--feature_news_section-->

    <!-- Feature Category Section & sidebar -->
    <section id="feature_category_section" class="feature_category_section section_wrapper">
	<div class="container">   
		<div class="row">
		   	<div class="col-md-9">
		   		<div class="category_layout">
			   		<div class="item_caregory red"><h2><a href="category.html">Politique</a></h2></div>
						<div class="row">
						<?php $pass = 0 ?>
						@foreach ($articles as $article)
						@if($article->categories->categorie == 'POLITIQUE')
						@if($pass == 5)
							@break
						@endif
						@if($article->publier == 1)
						@if($pass == 0)
				   			<div class="col-md-7">
								<div class="item feature_news_item">
									<div class="item_wrapper">
										<div class="item_img">
											<img class="img-responsive" src="{{ asset(env('UPLOAD_PATH').'/' . $article->image) }}" alt="politique">
										</div><!--item_img--> 
										<div class="item_title_date">
											<div class="news_item_title">
												<h2><a href="{{ url('article/'.$article->id) }}">{{ $article->titre }}</a></h2>
											</div><!--news_item_title-->
                                            <div class="item_meta">{{ $article->updated_at->format('d-m-Y') }},  par: {{$article->redacteur->name}}</div>
										</div><!--item_title_date-->
									</div><!--item_wrapper-->	
								    <div class="item_content">{{$article->contenue}}
								    </div><!--item_content-->

								</div><!--feature_news_item-->
				   			</div><!--col-md-7-->
							<?php $pass = 1 ?>
				   			@else
				   			<div class="col-md-5">
								<div class="media_wrapper">
									<div class="media">
										<div class="media-left">
											<a href="#"><img class="media-object imgS" src="{{ asset(env('UPLOAD_PATH').'/' . $article->image) }}" alt="politique"></a>
										</div><!--media-left-->
										<div class="media-body">
											<h3 class="media-heading"><a href="{{ url('article/'.$article->id) }}">{{ $article->titre }}
											</a></h3>

											<div class="item_meta">{{ $article->updated_at->format('d-m-Y') }},  par: {{$article->redacteur->name}}</div>

										</div><!--media-body-->
									</div><!--media-->

								</div><!--media_wrapper-->
								 
				   			</div><!--col-md-5-->
							<?php $pass =+ 1 ?>
						@endif
						@endif
						@endif
						@endforeach
				   		</div><!--row-->
			   		</div><!--category_layout-->

		   		<div class="category_layout">
		   			<div class="item_caregory blue"><h2><a href="#">Afrique</a></h2></div>
					<div class="row">
					<?php $pass1 = 0 ?>
					@foreach ($articles as $article)
						@if($article->categories->categorie == 'AFRIQUE')
						@if($pass1 == 5)
							@break
						@endif
						@if($article->publier == 1)
						@if($pass1 == 0)
			   			<div class="col-md-7">
							<div class="item active feature_news_item">
								<div class="item_wrapper">
									<div class="item_img">
										<img class="img-responsive" src="{{ asset(env('UPLOAD_PATH').'/' . $article->image) }}" alt="afrique">
									</div><!--item_img-->  
									<div class="item_title_date">
										<div class="news_item_title">
											<h2><a href="{{ url('article/'.$article->id) }}">{{ $article->titre }}</a></h2>
										</div><!--news_item_title-->
                                        <div class="item_meta">{{ $article->updated_at->format('d-m-Y') }},  par: {{$article->redacteur->name}}</div>
									</div><!--item_title_date-->
								</div><!--item_wrapper-->	
							    <div class="item_content">{{ $article->contenue }}
							    </div>

							</div><!--feature_news_item-->
			   			</div><!--col-md-7-->
						   <?php $pass1 = 1 ?>
			   			@else
			   			<div class="col-md-5">
							<div class="media_wrapper">
								<div class="media">
									<div class="media-left">
										<a href="#"><img class="media-object imgS" src="{{ asset(env('UPLOAD_PATH').'/' . $article->image) }}" alt="afrique"></a>
									</div><!--media-left-->
									<div class="media-body">
										<h3 class="media-heading"><a href="{{ url('article/'.$article->id) }}">{{ $article->titre }}
										</a></h3>
										<div class="item_meta">{{ $article->updated_at->format('d-m-Y') }},  par: {{$article->redacteur->name}}</div>
									</div><!--media-body-->
								</div><!--media-->
							</div>
			   			</div><!--col-md-5-->
						   <?php $pass1 =+ 1 ?>
						@endif
						@endif
						@endif
						@endforeach
			   		</div><!--row-->
		   		</div><!--category_layout-->

		   		<div class="category_layout">
		   			<div class="item_caregory teal"><h2><a href="#">Economie</a></h2></div>
					<div class="row">
					<?php $pass2 = 0 ?>
						@foreach ($articles as $article)
						@if($article->categories->categorie == 'ECONOMIE')
						@if($pass2 == 5)
							@break
						@endif
						@if($article->publier == 1)
						@if($pass2 == 0)
			   			<div class="col-md-7">
							<div class="item active feature_news_item">
								<div class="item_wrapper">
									<div class="item_img">
										<img class="img-responsive" src="{{ asset(env('UPLOAD_PATH').'/' . $article->image) }}" alt="Chania">
									</div><!--item_img-->  
									<div class="item_title_date">
										<div class="news_item_title">
											<h2><a href="{{ url('article/'.$article->id) }}">{{$article->titre}}</a></h3>
										</div><!--news_item_title-->
                                        <div class="item_meta">{{ $article->updated_at->format('d-m-Y') }},  par: {{$article->redacteur->name}}</div>
									</div><!--item_title_date-->
								</div><!--item_wrapper-->	
							    <div class="item_content">{{$article->contenue}}</div>

							</div><!--feature_news_item-->
			   			</div><!--col-md-7-->
						<?php $pass2 = 1 ?>
			   			@else
			   			<div class="col-md-5">
							<div class="media_wrapper">
								<div class="media">
									<div class="media-left">
										<a href="#"><img class="media-object imgS" src="{{ asset(env('UPLOAD_PATH').'/' . $article->image) }}" alt="Generic placeholder image"></a>
									</div><!--media-left-->
									<div class="media-body">
										<h3 class="media-heading"><a href="{{ url('article/'.$article->id) }}">{{$article->titre}}
										</a></h3>

										<div class="item_meta">{{ $article->updated_at->format('d-m-Y') }},  par: {{$article->redacteur->name}}</div>

									</div><!--media-body-->
								</div><!--media-->
							</div>
			   			</div><!--col-md-5-->
						   <?php $pass2 =+ 1 ?>
						@endif
						@endif
						@endif
						@endforeach
			   		</div><!--row-->
		   		</div><!--category_layout-->
		   		
		   		<div id="more_news_item" class="more_news_item">
					<div class="more_news_heading"><h2><a href="#">PLUS DE NOUVELLES</a></h2></div>
					<div class="row">
					@foreach ($articles as $article)
						@if($loop->index == 3)
							@break
						@endif
						@if($article->publier == 1)
						<div class="col-md-4">
							<div class="feature_news_item">
	                			<div class="item">
									<div class="item_wrapper">
										<div class="item_img">
											<img class="img-responsive" src="{{ asset(env('UPLOAD_PATH').'/' . $article->image) }}" alt="Chania">
										</div><!--item_img--> 
										<div class="item_title_date">
											<div class="news_item_title">
												<h3><a href="{{ url('article/'.$article->id) }}">{{$article->titre}}</a></h3>
											</div><!--news_item_title-->
                                            <div class="item_meta">{{ $article->updated_at->format('d-m-Y') }},  par: {{$article->redacteur->name}}</div>
										</div><!--item_title_date-->
									</div><!--item_wrapper-->
								    <div class="item_content">{{$article->contenue}} 
								    </div><!--item_content-->

								</div><!--item-->               			 
	            			</div><!--feature_news_item-->
						</div><!--col-xs-4-->
						@endif
						@endforeach
					</div><!--row-->	
				</div><!--more_news_item-->	
		   	</div><!--col-md-9-->

		   	<div class="col-md-3">

				<div class="tab sitebar">
					<ul class="nav nav-tabs">
						<li class="active"><a  href="#1" data-toggle="tab">DERNIER</a></li>
						<li><a href="#2" data-toggle="tab">POPULAIRE</a></li>
					</ul>

					<div class="tab-content">
						<div class="tab-pane active" id="1">
						@foreach ($articles as $article)
						@if($loop->index == 5)
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

    <!-- Feature Video Item -->
    <section id="feature_video_item" class="feature_video_item section_wrapper">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="feature_video_wrapper">
					<div class="feature_video_title"><h2>Vidéos Liées</h2></div>

					<div id="feature_video_slider" class="owl-carousel">
					@foreach($listvideo as $video)
					@if($loop->index == 13)
							@break
					@endif
						<div class="item">
							<div class="video_thumb"><iframe class="imgM" width="560" height="315" src="{{$video->lien}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>
						</div>
					@endforeach
		            </div><!--feature_video_slider-->


		        </div><!--col-xs-12-->
	        </div><!--row-->
        </div><!--feature_video_wrapper-->
	</div><!--container-->
</section>
@endsection