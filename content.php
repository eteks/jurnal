<section>
	<?php
		$parent_title = get_the_title($post->post_parent);
		$args = get_cat_ID($parent_title) ;
		if($parent_title == 'volumes') { 
	?>
	<div class="frame_text">
		<h1 class="frame_title">REVUE HISTORIQUE<br> de<br> PONDICHÉRY</h1>
		<hr> 
		<?php
			$sql = "SELECT * FROM wp_term_taxonomy where parent='$args'";
			$result_rows = $wpdb->get_var($sql);
			$result_rows = $wpdb->num_rows;	
			if($result_rows>0) {
				$result = $wpdb->get_results($sql) or die(mysql_error());
				foreach ($result as $key => $value) { 
		?>
		<div class="volume col-xs-10 col-lg-12">
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-3">	
		 	 	<img src="<?php bloginfo('stylesheet_directory');?>/images/building.png" alt="Building_picture" class="fr">
			</div>
		    <div class="col-xs-8 col-sm-6 col-md-8 col-lg-9 no_pad ">	
				<h4 class="fl"> <?php echo get_cat_name($value->term_id); ?> </h4>
			</div>
			<div class="col-xs-8 col-sm-6 col-md-8 col-lg-8 no_pad ">	
				<h5 class="fl"><a href="sections/?vol_id=<?php echo $value->term_id; ?>">Read It  <i class="fa fa-angle-right" aria-hidden="true"> </i></a></h5>
			</div>
			<div class="clearfix"> </div>
		</div>
		<?php
				}
			} else {
				echo "No volumes found";
			}
		?>
		
		<div class="col-xs-11 col-sm-12 col-md-12 col-lg-12 frame_footer">
		    <span>HISTORICAL SOCIETY OF PONDICHERRY</span>
		</div>
	</div>
	<?php	
		}
	else if($parent_title == 'sections') { 
		$vol_id = $_GET['vol_id'];
	?>
    <section id="page_index">
      	<div class="container">
		    <div class="row">
		 	    <div class="col-md-12 col-lg-12 " id="frame" class="img-responsive">
					<div class="frame_text">
					  	<div class="breadcrumb-w hidden-xs col-sm-12">
							<ul class="breadcrumb">
								<li>
									<a href="volumes">Home page</a>
								</li>
								<li>
									<span>Sections table</span>
								</li>
							</ul>
				 		</div>
			  	 		<span class="content_subtitle col-xs-10 col-sm-7 col-md-5 col-lg-5">TABLE DES MATIÈRES</span>
			  	 		<span class="volume_number col-sm-3 col-lg-2"> <?php echo get_cat_name($vol_id); ?> </span>
			  	 		<div class="page_content">
			 	 			<table class="table_content">
        						<?php
									
									$sql = "SELECT * FROM wp_term_taxonomy inner join wp_terms on wp_term_taxonomy.term_taxonomy_id=wp_terms.term_id where wp_term_taxonomy.parent='$vol_id'";

									$result_rows = $wpdb->get_var($sql);
									$result_rows = $wpdb->num_rows;	
									if($result_rows>0) {
										$result = $wpdb->get_results($sql) or die(mysql_error());
										foreach ($result as $key => $value) { 
										$sections=explode("-",$value->name);
  								?>	
				
  								<tr>
									<td class="td1"><a href="articles?sec_id=<?php echo $value->term_id; ?>"> <?php echo $sections[0]; ?> </a></td>
									<td class="td2"> <?php echo $sections[1]; ?> </td>
								</tr>
								<?php 
										} 
									} else {
										echo "No sections found";
									}
								?>

							</table>
						</div>
						<div class="clearfix"> </div>
						<div class="col-xs-11 col-sm-7 col-md-8 col-lg-12 content_footer">
							<span>HISTORICAL SOCIETY OF PONDICHERRY</span>
						</div>
					</div>
				</div>
			</div>
		</div> 	  	
    </section>	
	<?php
		}
		else if($parent_title == 'articles') { 
			$sec_id = $_GET['sec_id'];
			$section_name=explode("-",get_cat_name($sec_id));
	?>
    <section id="page_index">
      	<div class="container">
	        <div class="row">
	 		    <div class="col-md-12 col-lg-12 " id="frame" class="img-responsive">
					<div class="frame_text">
					  	<div class="breadcrumb-w hidden-xs col-sm-12">
							<ul class="breadcrumb">
								<li>
									<a href="volumes">Home page</a>
								</li>
								<li>
									<span>Artilcles table</span>
								</li>
							</ul>
				 		</div>
			  	 		<span class="content_subtitle col-xs-10 col-sm-7 col-md-5 col-lg-5">TABLE DES MATIÈRES</span>
			  	 		<span class="volume_number col-sm-3 col-lg-2"> <?php echo $section_name[0]; ?> </span>
				  	 	<div class="page_content">
				  	 		<table class="table_content">
        						<?php
									$sql = "SELECT * FROM wp_term_taxonomy inner join wp_terms on wp_term_taxonomy.term_taxonomy_id=wp_terms.term_id where wp_term_taxonomy.parent='$sec_id'";
									$result = $wpdb->get_results($sql) or die(mysql_error());
									foreach ($result as $key => $value) { 
										$sections=explode("-",$value->name);
  								?>			
  								<tr>
									<td class="td1"><a href="<?php echo $sections[0]; ?>"> <?php echo $sections[0]; ?> </a></td>
									<td class="td2"> <?php echo $sections[1]; ?> </td>
								</tr>
								<?php
									} 
								?>
							</table>
						</div>
						<div class="clearfix"> </div>
						<div class="col-xs-11 col-sm-7 col-md-8 col-lg-12 content_footer">
							<span>HISTORICAL SOCIETY OF PONDICHERRY</span>
						</div>
					</div>
				</div>
			</div>
		</div> 	  	
    </section>	
	<?php
		}
		else { 
			$today_date=date("Y-m-d");
			?>
		<div class="frame_text">
			<h1 class="frame_title"> <?php echo $parent_title; ?>  </h1>
			<hr />
			<input type="hidden" value="<?php echo $parent_title; ?>" id="download_article_name" />
			<input type="hidden" value="<?php echo $today_date ?>" id="download_article_date" />
			<div class="articlecontent col-xs-10 col-lg-12">
				<div class="col-xs-10 col-lg-1"></div>
				<div class="col-xs-10 col-lg-10 article_content_section">
					<?php
						// global $more;
						// $more = 0;
						the_content('Read the full article...');
					?>

				</div>
				<div class="col-xs-10 col-lg-1"></div>
				<!--<a data-popup-event="click" data-sgpopupid="1" class="sg-show-popup" href="javascript:void(0)"><p></p>
					<div class="download">Télécharger Article</div>
				</a> -->
			</div>
		</div>
	<?php	}
		// the_content();
	?>
</section>	