<?php
/**
 * The template for displaying the post content and book details
 *
 * @package WordPress
 * @link http://www.revuehistoriquedepondichery.org/demo/
 * @subpackage journal window
 * @since journal Window 1.0
 */
?>

<?php
	global $post;
	$parent_slug = $post->post_name;
	$limit=5;
	$default_value=1;
	if(isset($_GET['page-num']) && !empty($_GET['page-num'])) :
		$page_val = $_GET['page-num'];
		$start_value = ($page_val-1)*$limit + 1;
		$end_value = $start_value+($limit-1);
		$default_start_value = $start_value;
	else :
		$page_val = 1;
		$start_value = 1;
		$default_start_value = $start_value;
		$end_value = 5;
		
	endif;
	
	if($parent_slug == 'home'): ?>
		<div class="frame_text">
			<?php
				the_content();
				$args = array(
			    	'orderby' => 'id',
			      	'hide_empty'=> 0,
			      	'parent' => 0,
			 	);
				$categories = get_categories($args);
				$total_count = count($categories);
				$total_page_count = absint(($total_count / $limit)+1);

				foreach ($categories as $value) : 
				?>
				<?php
				if($default_value >= $default_start_value && $start_value <= $end_value) :
				?>
			    <div class="volume col-xs-10 col-lg-12">
					<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">	
						<?php
							$t_id = $value->term_id;
							$term_meta = get_option( "taxonomy_$t_id" );
							$taxonomy_image_url = get_option('z_taxonomy_image'.$t_id);
							if(!empty($taxonomy_image_url)) :
						?>	
							<img src="<?php echo $taxonomy_image_url; ?>" alt="Building_picture" class="fr building_pic">
						<?php
							else: 
						?>
							<img src="<?php bloginfo('stylesheet_directory');?>/images/building.png" alt="Building_picture" class="fr building_pic">
						<?php	
							endif;
						?>
	 		   	 	</div>
	 		   		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 no_pad ">
	 		   			<h4 class="fl fre"> <?php echo $value->name; ?> </h4>
	 		   			<h4 class="fl eng"> <?php echo $term_meta['cat_name_eng']; ?> </h4>
			   			<h4 class="fl tam"> <?php echo $term_meta['cat_name_tam']; ?> </h4>
			   		</div>
			   		<?php
			   			$start_value++;
			   			$slug_name = $value->slug;
			   			// echo $slug_name;
			   		?>
			   		<div class="col-xs-8 col-sm-6 col-md-8 col-lg-8 no_pad ">	
			   			<h5 class="fl">
			   				<a href="sections?post-type=<?php echo $slug_name; ?>"> <span class="eng"> Read It </span> <span class="fre"> lis le </span> <span class="tam"> இதை படிக்க </span>  <i class="fa fa-angle-right" aria-hidden="true"> </i></a>
			   			</h5>
			   		</div>
			   		<div class="clearfix"> </div>
			    </div>
				<?php 
				else:
					$default_value++;	
				endif;
				?>
				<?php
					endforeach;
				?>
				<?php 
					$current_slug=0;
					wp_custom_pagination($page_val,$total_page_count,$current_slug);
				?>
		</div>
	<?php	
	elseif($parent_slug == 'sections'): 
	?>
		<div class="frame_text">
			  	<!--breadcrumb-->
		  	<div class="breadcrumb-w hidden-xs breadcrumb-align">
				<ul class="breadcrumb">
					<li>
						<a data-active="1" class="breadcrumb_anger" href="home">
						<span class="eng"> Home page </span>
						<span class="fre"> Page d'accueil </span>
						<span class="tam"> முகப்பு பக்கம் </span>
						</a>
					</li>
					<li>
						<span class="eng"> List Sections </span>
						<span class="fre"> Liste Sections </span>
						<span class="tam"> பட்டியல் பிரிவுகள்</span>
					</li>
				</ul>
			</div>
			<div class="cb"> </div>
			<?php
				the_content(); 
			?>
			<?php
			if(isset($_GET['post-type']) && !empty($_GET['post-type'])) :	
			$slug = $_GET['post-type'];
			$current_slug = $slug;
			$cat = get_category_by_slug($slug);
			// print_r($cat);
			$cat_id = $cat->term_id;
			$args = array(
		    	'orderby' => 'id',
		      	'hide_empty'=> 0,
		      	'parent' => $cat_id,
			);
			$categories = get_categories($args);
			$term_meta = get_option( "taxonomy_$cat_id" );
			$total_count = count($categories);
			$total_page_count = absint(($total_count / $limit)+1); 

			?>
			<h5 class="volume_number fre"> <?php echo $cat->name; ?> </h5>
			<h5 class="volume_number eng"> <?php echo $term_meta['cat_name_eng']; ?> </h5>
		  	<h5 class="volume_number tam"> <?php echo $term_meta['cat_name_tam']; ?> </h5>
		  	<div class="page_content">
		  	 	<table class="table_content none_language">
		  	 		<?php
		  	 		foreach ($categories as $value) :
					?>
					<?php
						if($default_value >= $default_start_value && $start_value <= $end_value) :	
					?>
						<tr>
							<td> <?php
								$t_id = $value->term_id;
								$term_meta = get_option( "taxonomy_$t_id" );
								$start_value++;
					   			$slug_name = $value->slug;
					   			// echo $slug_name;
					   		?> </td>


			  	 			<td class="td1 fre"><a href="articles?post-type=<?php echo $slug_name; ?>"> <?php echo $value->name; ?> </a></td>
			  	 			<td class="td1 eng"><a href="articles?post-type=<?php echo $slug_name; ?>"> <?php echo $term_meta['cat_name_eng']; ?> </a></td>
			  	 			<td class="td1 tam"><a href="articles?post-type=<?php echo $slug_name; ?>"> <?php echo $term_meta['cat_name_tam']; ?> </a></td>
			  	 			<td class="td2"> <?php echo $term_meta['cat_page_no']; ?> </td>
			  	 		</tr>
			  	 	<?php 
					else:
						$default_value++;	
					endif;
					?>
					<?php 
					endforeach; ?>
				</table> 
			</div>
			<?php 
				wp_custom_pagination($page_val,$total_page_count,$current_slug);
			?>
			<?php else:
			?>
			<div class="page_content">
				<p> No sections found </p>
				<span>HISTORICAL SOCIETY OF PONDICHERRY</span>
			</div>
			<?php
			endif;
			?>   
		</div>

	<?php
	elseif($parent_slug == 'articles'): 
		if(isset($_GET['post-type']) && !empty($_GET['post-type'])) :
		$slug = $_GET['post-type'];
		$current_slug = $slug;
		$cat = get_category_by_slug($slug);
		// print_r($cat);
		$cat_id = $cat->term_id;
		$term_meta = get_option( "taxonomy_$cat_id");
		$cat_parent_id = $cat->category_parent;
		$parent_category = get_category($cat_parent_id);
		$cat_parent_name = $parent_category->slug;
		$sec_name = $cat->name;
		$args = array(
	    	'orderby' => 'id',
	      	'hide_empty'=> 0,
	      	'parent' => $cat_id,
		);
		$categories = get_categories($args);
		$total_count = count($categories);
		$total_page_count = absint(($total_count / $limit)+1); 
	?>
		<div class="frame_text">
			<!--breadcrumb-->
			<div class="breadcrumb-w hidden-xs breadcrumb-align">
				<ul class="breadcrumb">
					<li>
						<a data-active="1" class="breadcrumb_anger" href="home">
						<span class="eng"> Home page </span>
						<span class="fre"> Page d'accueil </span>
						<span class="tam"> முகப்பு பக்கம் </span>
						</a>
					</li>
					<li>
						<span class="eng"><a data-active="1" class="breadcrumb_anger" href="sections?post-type=<?php echo $cat_parent_name; ?>"> Sections </a>
						</span>
						<span class="fre"><a data-active="1" class="breadcrumb_anger" href="sections?post-type=<?php echo $cat_parent_name; ?>"> Sections </a>
						</span>
						<span class="tam"><a data-active="1" class="breadcrumb_anger" href="sections?post-type=<?php echo $cat_parent_name; ?>"> பிரிவுகள் </a>
						</span>
						
					</li>
					<li>
						<span class="eng"> List Articles </span>
						<span class="fre"> Liste des articles </span>
						<span class="tam"> பட்டியல் கட்டுரைகள் </span>
					</li>
				</ul>
			</div>
			<div class="cb"> </div>
			<?php
				the_content(); 
			?>
			<h5 class="volume_number fre"> <?php echo $sec_name; ?> </h5>
			<h5 class="volume_number eng"> <?php echo $term_meta['cat_name_eng']; ?> </h5>
			<h5 class="volume_number tam"> <?php echo $term_meta['cat_name_tam']; ?> </h5>
		  	<div class="page_content">
		  	 	<table class="table_content">
		  	  		<?php
		  	 		foreach ($categories as $key => $value): 
						?>
						<tr>
							<?php 
							if($default_value >= $default_start_value && $start_value <= $end_value) :
							?>
							<td> <?php
								$t_id = $value->term_id;
								$term_meta = get_option( "taxonomy_$t_id" );	
								$start_value++;
					   			$slug_name = $value->slug;
					   			// echo $slug_name;
					   		?> </td>
			  	 			<td class="td1 fre"> <a href="article-content?post-type=<?php echo $slug_name; ?>"> <?php echo $value->name; ?> </a> </td>
			  	 			<td class="td1 eng"> <a href="article-content?post-type=<?php echo $slug_name; ?>"> <?php echo $term_meta['cat_name_eng']; ?> </a> </td>
			  	 			<td class="td1 tam"> <a href="article-content?post-type=<?php echo $slug_name; ?>"> <?php echo $term_meta['cat_name_tam']; ?> </a> </td>
			  	 			<td class="td2"> <?php echo $term_meta['cat_page_no']; ?> </td>
			  	 		</tr>
			  	 			<?php 
							else:
								$default_value++;	
							endif;
							?>
		  	 		<?php
						endforeach;
					?>
				</table> 
			</div>
        	<?php 
				wp_custom_pagination($page_val,$total_page_count,$current_slug);
			?>
		</div>
		<?php else:
		?>
		<div class="frame_text">
			<p> No articles found </p>
			<span>HISTORICAL SOCIETY OF PONDICHERRY</span>
		</div>
		<?php endif;
		?>


	<?php
	elseif($parent_slug == 'article-content'): 
		if(isset($_GET['post-type']) && !empty($_GET['post-type'])) :
		$slug = $_GET['post-type'];
		$cat = get_category_by_slug($slug);
		// print_r($cat);
		$cat_id = $cat->term_id;
		$term_meta = get_option( "taxonomy_$cat_id");
		$sec_parent_id = $cat->category_parent;
		$parent_section = get_category($sec_parent_id);
		$cat_parent_id = $parent_section->category_parent;
		$sec_parent_name = $parent_section->slug;
		$parent_category = get_category($cat_parent_id);
		$cat_parent_name = $parent_category->slug;
		$art_name = $cat->name;
	?>			
		<div class="frame_text">
			<!--breadcrumb-->
			<div class="breadcrumb-w hidden-xs breadcrumb-align">
				<ul class="breadcrumb">
					<li>
						<a data-active="1" class="breadcrumb_anger" href="home">
						<span class="fre"> Page d'accueil </span>
						<span class="eng"> Home page </span>
						<span class="tam"> முகப்பு பக்கம் </span>

						</a>
					</li>
					<li>
						<a data-active="1" class="breadcrumb_anger" href="sections?post-type=<?php echo $cat_parent_name; ?>"> 
						<span class="fre"> Sections </span>
						<span class="eng"> Sections </span>
						<span class="tam"> பிரிவுகள் </span>
						</a>
					</li>
					<li>
						<a data-active="1" class="breadcrumb_anger" href="articles?post-type=<?php echo $sec_parent_name; ?>"> 
						<span class="fre"> Des articles </span>
						<span class="eng"> Articles </span>
						<span class="tam"> கட்டுரைகள் </span>
						</a>
					</li>
					<li>
						<span class="fre"> <?php echo $art_name; ?> </span>
						<span class="eng"> <?php echo $term_meta['cat_name_eng']; ?> </span>
						<span class="tam"> <?php echo $term_meta['cat_name_tam']; ?> </span>
					</li>
				</ul>
			</div>
			<div class="cb"> </div>
			<h5 class="volume_number article_heading fre"> <?php echo $art_name; ?> </h5>
			<h5 class="volume_number article_heading eng"> <?php echo $term_meta['cat_name_eng']; ?> </h5>
			<h5 class="volume_number article_heading tam"> <?php echo $term_meta['cat_name_tam']; ?> </h5>
			<div class="article_description_language">
				<?php echo $cat->description; ?>
			</div>
			<input type="hidden" value="<?php echo $art_name; ?>" id="download_article_name" />
			<input type="hidden" value="<?php echo get_the_date(); ?>" id="download_article_date" />
			<div class="popup_article">
				<?php
					the_content(); 
				?>
			</div>
		</div>
			<a href="" id="download_pdf_link"> </a>
		<?php else:
		?>
		<div class="frame_text">
			<p> No content for articles </p>
		</div>
		<?php endif;
		?>
<?php
	else:
		the_content();
	endif; 
?>