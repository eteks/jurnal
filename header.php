<!Doctype html>
<html lang="en-US">
	<head>
		<title> <?php echo get_bloginfo( 'name' ); ?> </title>
	 	<meta charset="utf-8">
	 	<meta name="viewport" content="width=device-width, intial-scale=1.0, maximum-scale=3.0, user-scalable=no">
		<!---css -->
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/responsive.css">
		<?php wp_head();?>
	</head>
	<body>
		<header>
			<section class="top_header">	
		 		<div class="container">
		 			<div class="row">
		 		  		<!--nav-bar-->
		 		  		<nav class="navbar navbar-default" role="navigation">
				     		<div class="navbar-header col-sm-0 col-lg-2">
						 		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								 	 <span class="icon-bar"></span> 
								 	 <span class="icon-bar"></span> 
								 	 <span class="icon-bar"></span> 
						  		</button>
						  		<div class="navbar-brand navbar-left">
						  			<a href="volumes">
						  				<img src="<?php bloginfo('stylesheet_directory');?>/images/logo.png">
						  			</a>
						  		</div>
				      		</div>
						    <div class="navbar-brand navbar-right col-sm-0 col-md-1 col-lg-1 hidden-xs">
						    	<select class="languages" >
						      		<option value="ENGLISH"selected>English</option>
						      		<option value="FRENCH">French</option>
						      	</select>
						    </div>
				      		<h2 class="mobile_title visible-xs col-xs-12">LA SOCIÉTÉ HISTOIRE de PONDICHÉRY</h2>	
		  			  		<div class="navbar-collapse collapse col-sm-11 col-lg-9">
				  			  	<!-- <div class="navbar-collapse collapse col-sm-11 col-lg-9" aria-expanded="false" style="height: 1px;">  -->  
				  			  	<h2 class="hidden-xs">LA SOCIÉTÉ HISTOIRE de PONDICHÉRY</h2>
				  			  	<ul class="nav nav-justified">
								 	<li class="active"><a href="volumes">Home</a></li>
									<li><a href="#">About us</a></li>
									<li><a href="#">Contact us</a></li>
									<li><a href="#">Feedback</a></li>
								</ul>
					  		</div><!-- /.navbar-collapse --> 
				  		</nav>
		        	</div>
		     	</div><!--container--> 
		  	</section>
		</header>
		<div id="body_section">
	 		<section id="sub_header">
			  	<div class="container">
			 		<div class="row">
				 	  <div class="title2 col-lg-12">
				 	  	   <div class="col-xs-3 col-sm-3 col-md-4 col-lg-4">	
				 		   	 	<img src="<?php bloginfo('stylesheet_directory');?>/images/building.png" alt="Building_picture" class="fr">
				 		   </div>
				 		   <div class="col-xs-9 col-sm-9 col-md-8 col-lg-8 title_nopad">	
						   		<p class="fl">Researches into the History & Culture of French and Indian Pondicherry </p>
						   </div>
						   <div class="clearfix"> </div>
			 		  </div>	
			 		</div>
			 	</div>	
			</section>