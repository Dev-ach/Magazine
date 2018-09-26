<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Afrique défis</title>
    <!-- Goole Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,700|Roboto:400,500" rel="stylesheet"> 

    <!-- Bootstrap -->
    <link href="{{ asset('css1/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="{{ asset('fonts1/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
	
    <!-- Owl carousel -->
    <link href="{{ asset('css1/owl.carousel.css') }}" rel="stylesheet">
	 <link href="{{ asset('css1/owl.theme.default.min.css') }}" rel="stylesheet">

    <!-- Off Canvas Menu -->
    <link href="{{ asset('css1/offcanvas.min.css') }}" rel="stylesheet">

    <!--Theme CSS -->
	<link href="{{ asset('css1/style.css') }}" rel="stylesheet">
	<!--Calendrier css-->
	<link href="{{ asset('css1/calendrier.css') }}" rel="stylesheet">

	<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
<body>
<div id="main-wrapper">

    <!-- Header Section -->
	<header>
	    <div class="container">
	     	<div class="top_ber">
				<div class="row">
		    		<div class="col-md-6">
						<div class="top_ber_left">
						{{ date('d-m-Y H:i') }}
						</div><!--top_ber_left-->
		    		
		    	</div><!--row-->
	     	</div><!--top_ber-->
	     	
	     	<div class="header-section">
				<div class="row">
		    	 	<div class="col-md-3">
						<div class="logo">
                        <a  href="{{url('/')}}"><img class="img-responsive" src="{{ asset('img/logo.png') }}" alt=""></a>
						</div><!--logo-->
		    	 	</div><!--col-md-3-->
		    	 	
		    	 	<div class="col-md-6">
						
		    	 	</div><!--col-md-6-->
		    	 	
		    	 	<div class="col-md-3">
						<div class="social_icon1">
								<a class="icons-sm fb-ic"><i class="fa fa-facebook"></i></a>
								<!--Twitter-->
								<a class="icons-sm tw-ic"><i class="fa fa-twitter"></i></a>
								<!--Google +-->
								<a class="icons-sm gplus-ic"><i class="fa fa-google-plus"> </i></a>
								<!--Linkedin-->
								<a class="icons-sm li-ic"><i class="fa fa-linkedin"> </i></a> 
								<!--Pinterest-->
								<a class="icons-sm pin-ic"><i class="fa fa-pinterest"> </i></a>
						</div> <!--social_icon1-->
		    	 	</div><!--col-md-3-->
		    	</div> <!--row-->	
	     	</div><!--header-section-->    	      
	    </div><!-- /.container -->   

		<nav class="navbar main-menu navbar-inverse navbar-static-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed pull-left" data-toggle="offcanvas">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				</div>
				<div id="navbar" class="collapse navbar-collapse sidebar-offcanvas">
				<ul class="nav navbar-nav">
					<li class="hidden"><a href="#page-top"></a></li>
					<?php $nav = 0 ; $idx=0;?>
					@foreach($categories as $categorie)
					@if($nav <= 7)
					<li><a class="page-scroll" href="{{url('categorie/'.$categorie->id)}}">{{$categorie->categorie}}</a></li>
					<?php $nav += 1 ?>
					@endif
					@endforeach

					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Plus <b class="caret"></b></a>
						<ul class="dropdown-menu">
						@foreach($categories as $categorie)
						@if($nav <= $idx)
							<li><a href="{{url('categorie/'.$categorie->id)}}">{{$categorie->categorie}}</a></li>
						@endif
						<?php $idx += 1 ?>
						@endforeach
						</ul>
					</li>	
				</ul>
				<div class="pull-right">
					<form class="navbar-form" action="{{URL::to('recherche')}}" method="post" role="search">
					{{ csrf_field() }}
						<div class="input-group">
							<input class="form-control" placeholder="rechercher un article" name="recherche" type="text">
							<div class="input-group-btn">
								<button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
							</div>
						</div>
					</form>
				</div>
				</div>
			</div>
		</nav> 
		<!-- .navbar -->
	</header>

    @yield('content')

    <!-- Footer Section -->
    <footer class="footer_section section_wrapper section_wrapper" >
	<div class="footer_top_section">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="text_widget footer_widget">
					<div class="footer_widget_title"><h2>À PROPOS D'AFRIQUE DÉFIS</h2></div>
		         
		         	<div class="footer_widget_content">
					 Nous nous sommes spécialisés dans la publication d'informations à forte valeur ajoutée et publicité. Indépendants de tout gouvernement ou organisation politique. Cela nous permet de garantir à nos lecteurs une information originale et objective. Ayant une double vocation, nationale et internationale. Nous décodons les rapports de force politique, l'organisation des réseaux d'influence, les enjeux économiques (l’industrie, l’agriculture et le tourisme). Notre ambition est de pénétrer à chaque fois au cœur des informations, le relationnel et l’événementiel. Nous agissons dans le cadre de l’accompagnement des opérateurs économiques (investisseurs, industriels et entrepreneurs).
					 </div>
					</div><!--text_widget-->
				</div><!--col-xs-3-->

				<div class="col-md-2">
					<div class="footer_widget">
                        <div class="footer_widget_title"><h2>DÉCOUVRIR</h2></div>
					    <div class="footer_menu_item ">
								<ul class="nav navbar-nav ">
								<?php $nav = 0 ; $idx=0;?>
									@foreach($categories as $categorie)
									@if($nav <= 7)
									<li><a href="{{url('categorie/'.$categorie->id)}}">{{$categorie->categorie}}</a></li>
									<?php $nav += 1 ?>
									@endif
									@endforeach
								</ul>
			      	</div><!--footer_menu_item-->
                    </div><!--footer_widget-->
				</div><!--col-xs-6-->
				<div class="col-md-2">
					<div class="footer_widget">
                        <div class="footer_widget_title"><h2>Contactez nous</h2></div>
					    <div class="footer_menu_item ">
							Email: info@afriquedefis.com <br>
							tél : <br>+212 613-187358
			      	</div><!--footer_menu_item-->
                    </div><!--footer_widget-->
				</div><!--col-xs-6-->
				<div class="col-md-4">
 					<div class="text_widget footer_widget">
						<div class="footer_widget_title"><h2>Mot du Président</h2></div>
						<img class="imgS" src="{{ asset('img/IMG_6138.jpg') }}" />
						<div class="footer_widget_content">
						Fort de notre expérience dans l'information à forte valeur ajoutée, Afrique Défis est en mesure d'offrir à ses lecteurs une veille avancée, indispensable dans un cadre opérationnel. Assuré la couverture médiatique de touts les événements et initiatives ayant trait au dynamisme et au développement du continent Africain fait partie de nos priorités primordiales. Nous nous sommes adressés en priorité à un public professionnel, élargi notre audience à des lecteurs Africains francophones en premier lieu toujours exigeants, mais plus diversifiés. Notre devise est : Dynamisme – Développement – Défis. 
						<br>Moulay Zaid ZIZI <br>
						Président Fondateur
						</div>
				</div><!--col-xs-3-->
			</div><!--row-->
		</div><!--container-->
	</div><!--footer_top_section-->
	<a href="#" class="crunchify-top"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
	
	<div class="copyright-section">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
							
					</div><!--col-xs-3-->
					<div class="col-md-6">
						<div class="copyright">
						© Copyright 2018 - afrique défis magazine 
						</div>
					</div><!--col-xs-6-->
					<div class="col-md-3">
						Afrique défis Magazine
					</div><!--col-xs-3-->
				</div><!--row-->
			</div><!--container-->
		</div><!--copyright-section-->
</footer>

</div> <!--main-wrapper-->
  
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset('js1/jquery.min.js') }}"></script>

<!-- Owl carousel -->
<script src="{{ asset('js1/owl.carousel.js') }}"></script>

<!-- Bootstrap -->
<script src="{{ asset('js1/bootstrap.min.js') }}"></script>

<!-- Theme Script File-->
<script src="{{ asset('js1/script.js') }}"></script> 

<!-- Off Canvas Menu -->
<script src="{{ asset('js1/offcanvas.min.js') }}"></script> 

<!-- Calendrier js -->
<script src="{{ asset('js1/calendrier.js') }}"></script> 

   
</body>
</html>