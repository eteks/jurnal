<section>
	<?php
	global $post;
	$parent_title = get_the_title($post->post_parent);
	
	$args = get_cat_ID($parent_title) ;
	$term_taxonomy = $wpdb->prefix.'term_taxonomy';
	$term = $wpdb->prefix.'terms';
	echo '<div class="none_language">';
	$parent_slug = $post->post_name;
	echo '</div>';

	if($parent_slug == 'home' || $parent_slug == 'volumes' ) { 

	?>
		<div class="frame_text">
			<h1 class="frame_title">REVUE HISTORIQUE<br> de<br> PONDICHÉRY</h1>
			<?php
				the_content();
			
				$start=0;
				$limit=5;
				if(isset($_GET['id']))
				{
					$id=$_GET['id'];
					$start=($id-1)*$limit;
				}
				else{
					$id=1;
				}
				$sql = "SELECT * FROM $term_taxonomy where parent='$args' and taxonomy='category'  LIMIT $start, $limit";
				$query = "SELECT * FROM $term_taxonomy where parent='$args' and taxonomy='category'";
				$result_rows1 = $wpdb->get_var($query);
				$result_rows1 = $wpdb->num_rows;
				$result_rows = $wpdb->get_var($sql);
				$result_rows = $wpdb->num_rows;	
				if($result_rows>0) {
				$result = $wpdb->get_results($sql) or die(mysql_error());
				foreach ($result as $key => $value) { 
			?>
			    <div class="volume col-xs-10 col-lg-12">
					<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">	
	 		   	 		<img src="<?php bloginfo('stylesheet_directory');?>/images/volume.png" alt="Building_picture" class="fr building_pic">
	 		   		</div>
	 		   		<div class="col-xs-8 col-sm-6 col-md-8 col-lg-8 no_pad ">	
			   			<h4 class="fl"> <?php echo get_cat_name($value->term_id); ?> </h4>
			   		</div>
			   		<div class="col-xs-8 col-sm-6 col-md-8 col-lg-8 no_pad ">	
			   			<h5 class="fl">
			   				<a href="sections/?vol_id=<?php echo $value->term_id; ?>">Read It  <i class="fa fa-angle-right" aria-hidden="true"> </i></a>
			   			</h5>
			   		</div>
			   		<div class="clearfix"> </div>
			    </div>
			<?php
				}
				$total=ceil($result_rows1/$limit);
				echo '<div class="col-sm-12 col-md-12 col-lg-12 frame_footer"> <div class="paginaion_section col-lg-11">';
				if($id>1)
				{
				echo "<a href='?id=".($id-1)."' class='button'>  < </a>";
				}
				for($i=1;$i<=$total;$i++)
				{
					if($i==$id) { 
						echo "<span class='current pagination_list'><a href='#'>".$i."</a></span>"; 
					}
					else { 
						echo "<span class='pagination_list'><a href='?id=".$i."'>".$i."</a></span>"; 
					}
				}
				if($id!=$total)
				{
					echo "<a href='?id=".($id+1)."' class='button'> > </a>";
				}
				echo '</div> <div class="clearfix"> </div> ';
				} else {
					echo "No volumes found";
					echo '<div class="col-sm-12 col-md-12 col-lg-12 frame_footer">';
				}
				?>
			    	<span>HISTORICAL SOCIETY OF PONDICHERRY</span>
				</div>
			</div>
			<?php	
			}
			else if($parent_slug == 'sections') { 
			$vol_id = $_GET['vol_id'];
			?>
			<div class="frame_text">
			  	<!--breadcrumb-->
			  	<div class="breadcrumb-w hidden-xs ">
					<ul class="breadcrumb">
						<li>
							<a data-active="1" class="breadcrumb_anger" href="volumes">Home page</a>
						</li>
						<li>
							<span>List Sections </span>
						</li>
					</ul>
				</div>
				<?php
					the_content(); 
				?>
				<h1 class="content_subtitle">TABLE DES MATIÈRES</h1>
			  	<h5 class="volume_number"> <?php echo get_cat_name($vol_id); ?> </h5>
			  	<div class="page_content">
			  	 	<table class="table_content none_language">
			  	 		<?php
			  	 		$start=0;
						$limit=5;
						if(isset($_GET['id']))
						{
						$id=$_GET['id'];
						$start=($id-1)*$limit;
						}
						else{
							$id=1;
						}
						$sql = "SELECT * FROM $term_taxonomy inner join $term on $term_taxonomy.term_taxonomy_id=$term.term_id where $term_taxonomy.parent='$vol_id' and $term_taxonomy.taxonomy='category' LIMIT $start, $limit";
						$query = "SELECT * FROM $term_taxonomy where parent='$vol_id' and taxonomy='category'";
						$result_rows1 = $wpdb->get_var($query);
						$result_rows1 = $wpdb->num_rows;
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
						echo '</table> </div>';
						$total=ceil($result_rows1/$limit);
						echo '<div class="col-xs-11 col-sm-12 col-md-12 col-lg-12 content_footer"> <div class="paginaion_section col-lg-11">';
						if($id>1)
						{
						echo "<a href='?vol_id=".$vol_id."&id=".($id-1)."' class='button'>  < </a>";
						}
						for($i=1;$i<=$total;$i++)
						{
						if($i==$id) { 
							echo "<span class='current pagination_list'><a href='#'>".$i."</a></span>"; 
						}
						else { 
							echo "<span class='pagination_list'><a href='?vol_id=".$vol_id."&id=".$i."'>".$i."</a></span>"; 
						}
						}
						if($id!=$total)
						{
							echo "<a href='?vol_id=".$vol_id."&id=".($id+1)."' class='button'> > </a>";
						}
						echo '</div> <div class="clearfix"> </div> ';
						} else {
							echo "No sections found";
							echo '</table> </div>';
							echo '<div class="col-xs-11 col-sm-12 col-md-12 col-lg-12 content_footer">';
						}
						?>
				   <span>HISTORICAL SOCIETY OF PONDICHERRY</span>
		    	</div>
			</div>
			<?php
			}
			else if($parent_slug == 'articles') { 
			$sec_id = $_GET['sec_id'];
			$section_name=explode("-",get_cat_name($sec_id));
			?>
			<div class="frame_text">
			<?php
				the_content(); 
				$query_breadcrump = "SELECT * FROM $term_taxonomy where term_taxonomy_id='$sec_id' and taxonomy='category'";
				$result_breadcrump = $wpdb->get_row($query_breadcrump) or die(mysql_error());
				$vol_bread_id = $result_breadcrump->parent;


			?>
			  	<!--breadcrumb-->
			  	<div class="breadcrumb-w hidden-xs ">
					<ul class="breadcrumb">
						<li>
							<a data-active="1" class="breadcrumb_anger" href="volumes">Home page</a>
						</li>
						<li>
							<a data-active="1" class="breadcrumb_anger" href="sections/?vol_id=<?php echo $vol_bread_id; ?>"> Sections </a>
						</li>
						<li>
							<span>List Articles</span>
						</li>
					</ul>
				</div>
				<h1 class="content_subtitle">TABLE DES MATIÈRES</h1>
			  	<h5 class="volume_number"> <?php echo $section_name[0]; ?> </h5>
			  	<div class="page_content">
			  	 	<table class="table_content">
			  	  		<?php
			  	 		$start=0;
						$limit=5;
						if(isset($_GET['id']))
						{
						$id=$_GET['id'];
						$start=($id-1)*$limit;
						}
						else{
						$id=1;
						}
						$sql = "SELECT * FROM $term_taxonomy inner join $term on $term_taxonomy.term_taxonomy_id=$term.term_id where $term_taxonomy.parent='$sec_id' and $term_taxonomy.taxonomy='category' LIMIT $start, $limit";
						$query = "SELECT * FROM $term_taxonomy where parent='$sec_id' and taxonomy='category'";
						$result_rows1 = $wpdb->get_var($query);
						$result_rows1 = $wpdb->num_rows;
						$result_rows = $wpdb->get_var($sql);
						$result_rows = $wpdb->num_rows;
						if($result_rows>0) {
						$result = $wpdb->get_results($sql) or die(mysql_error());
						foreach ($result as $key => $value) { 
						$sections=explode("-",$value->name);
  						?>
						<tr>
			  	 			<td class="td1"> <a href="<?php echo $sections[0]."?sec_id=".$value->parent; ?>"> <?php echo $sections[0]; ?> </a> </td>
			  	 			<td class="td2"> <?php echo $sections[1]; ?> </td>
			  	 		</tr>
			  	 		<?php
						} 
						echo '</table> </div>';
						$total=ceil($result_rows1/$limit);
						echo '<div class="col-xs-11 col-sm-12 col-md-12 col-lg-12 content_footer"> <div class="paginaion_section col-lg-11">';
						if($id>1)
						{
						echo "<a href='?sec_id=".$sec_id."&id=".($id-1)."' class='button'>  < </a>";
						}
						for($i=1;$i<=$total;$i++)
						{
						if($i==$id) { 
							echo "<span class='current pagination_list'><a href='#'>".$i."</a></span>"; 
						}
						else { 
							echo "<span class='pagination_list'><a href='?sec_id=".$sec_id."&id=".$i."'>".$i."</a></span>"; 
						}
						}
						if($id!=$total)
						{
							echo "<a href='?sec_id=".$sec_id."&id=".($id+1)."' class='button'> > </a>";
						}
						echo '</div> <div class="clearfix"> </div> ';
						} else {
							echo "No Articles found";
							echo '</table> </div>';
							echo '<div class="col-xs-11 col-sm-12 col-md-12 col-lg-12 content_footer">';
						}
						?>
				   <span>HISTORICAL SOCIETY OF PONDICHERRY</span>
		    	</div>
			</div>
			<?php
			}
			else if($parent_slug == 'about' || $parent_slug == 'feedback' || $parent_slug == 'termscon') { 
			?>
			<div class="frame_text">
				<!--breadcrumb-->
			  	<div class="breadcrumb-w hidden-xs ">
					<ul class="breadcrumb">
						<li>
							<a data-active="1" class="breadcrumb_anger" href="volumes">Home page</a>
						</li>
						<li>
							<span> <?php echo $parent_title; ?> </span>
						</li>
					</ul>
				</div>
				<div class="other_pages col-xs-12 col-lg-12">
					<div class="col-xs-1 col-lg-1"></div>
					<div class="col-xs-10 col-lg-10">
						<?php
						the_content();
						?>
					</div>
					<div class="col-xs-1 col-lg-1"></div>
				</div>
			</div>
			<?php	
			}
			else if($parent_slug == 'contact') { 
			?>
			<div class="frame_text">
				<!--breadcrumb-->
			  	<div class="breadcrumb-w hidden-xs ">
					<ul class="breadcrumb">
						<li>
							<a data-active="1" class="breadcrumb_anger" href="volumes">Home page</a>
						</li>
						<li>
							<span> <?php echo $parent_title; ?> </span>
						</li>
					</ul>
				</div>
				<div class="other_pages col-xs-12 col-lg-12">
					<div class="col-xs-1 col-lg-1"></div>
					<div class="col-xs-10 col-lg-10 contact_us_form">
						<div class="form_section">
							<?php
								the_content();
							?>
						</div>
						<div class="map_section">
							<div id="map_area">
								<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD29eCm_1Q3IlgBZ60IoY-Cj3l8AMlmgoY&callback=initMap" async defer> </script>
								<script>
									var map; function initMap() { 
              							var lattitude = $() 
          								map = new google.maps.Map(document.getElementById("map_area"), {
	            							center: {lat: 11.942160 , lng: 79.795164},
	              							zoom: 17
            							});
            						}
            					</script>
							</div>
						</div>
						<div class="cb"> </div>
					</div>
					<div class="col-xs-1 col-lg-1"></div>
				</div>
			</div>
			<?php	
			}
			else { 
			$today_date=date("d-m-Y");
			?>
			<div class="frame_text">
			<?php
				$sec_bread_id = $_GET['sec_id'];
			?>
				<!--breadcrumb-->
			  	<div class="breadcrumb-w hidden-xs ">
					<ul class="breadcrumb">
						<li>
							<a data-active="1" class="breadcrumb_anger" href="volumes">Home page</a>
						</li>
						<li>
							<a data-active="1" class="breadcrumb_anger" href="articles?sec_id=<?php echo $sec_bread_id; ?>" > Articles </a>
						</li>
						<li>
							<span> <?php echo $parent_title; ?>  </span>
						</li>
					</ul>
				</div>
				<h1 class="frame_title"> <?php echo $parent_title; ?>  
				</h1>
				<hr />
				<input type="hidden" value="<?php echo $parent_title; ?>" id="download_article_name" />
				<input type="hidden" value="<?php echo $today_date ?>" id="download_article_date" />
				<div class="articlecontent col-xs-12 col-lg-12">
					<div class="col-xs-1 col-lg-1"></div>
					<div class="col-xs-10 col-lg-10 article_content_section">
						<?php
						the_content();
						?>
					</div>
					<div class="col-xs-1 col-lg-1"></div>
					<!-- <a data-popup-event="click" data-sgpopupid="1" class="sg-show-popup" href="javascript:void(0)"><p></p>
						<div class="download">Télécharger Article</div>
					</a> -->
				</div>
			</div>
			<?php	}
			// the_content();
			?>
</section>
