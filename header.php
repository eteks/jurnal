<!Doctype html>
<html lang="en-US">
	<head>
		<title> <?php bloginfo( 'name' ); ?> - <?php echo bloginfo( 'description' ); ?> </title>
	 	<meta charset="utf-8">
	 	<meta name="viewport" content="width=device-width, intial-scale=1.0, maximum-scale=3.0, user-scalable=no">
		<!---css -->
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
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
				     		<div class="navbar-header">
						 		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								 	<span class="icon-bar"></span> 
								 	<span class="icon-bar"></span> 
								 	<span class="icon-bar"></span> 
								</button>
						  		<div class="navbar-brand navbar-left custom_logo_link">
						  			 <?php
						  			 	if ( function_exists( 'the_custom_logo' ) ) {
										    the_custom_logo();
										}

									?>	
		  				  		</div>
						  		<span class="mobile_title visible-xs none_language"><?php bloginfo( 'name' ); ?></span>	
				      		</div>
				      		<div class="navbar-brand navbar-right language_select">
			      				<!-- <select class="languages" >
						      		<option value="ENGLISH" selected>ENGLISH</option>
						      		<option value="FRENCH">FRENCH</option>
			      				</select> -->
				      		</div>
				      		<div class="navbar-collapse collapse">
		  			  			<h3 class="header_title hidden-xs none_language"><?php bloginfo( 'name' ); ?></h3>	  
				  			  	<?php
				  			  		if ( has_nav_menu( 'primary' ) ) : 
										wp_nav_menu( array(
											'theme_location' => 'primary',
										 	'items_wrap' => '<ul class="nav nav-justified active_section">%3$s</ul>'
										)); 
	 								endif; 
	 							?>
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
				 		   	 	<img src="<?php bloginfo('stylesheet_directory');?>/images/building.png" alt="Building_picture" class="fr building_img" />
				 		    </div>
				 		    <div class="col-xs-9 col-sm-9 col-md-8 col-lg-8 title_nopad">	
						   		<p class="fl">Researches into the History & Culture of French and Indian Pondicherry </p>
						    </div>
					   		<div class="clearfix"> </div>
		 		  		</div>	
		 			</div>
		 		</div>	
		  	</section>	
