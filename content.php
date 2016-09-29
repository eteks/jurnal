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
	 		   			<h4 class="fl"> 
	 		   				<span class=""> <?php echo $value->name; ?> </span>
	 		   			</h4>
			   		</div>
			   		<?php
			   			$start_value++;
			   			$slug_name = $value->slug;
			   			// echo $slug_name;
			   		?>
			   		<div class="col-xs-8 col-sm-6 col-md-8 col-lg-8 no_pad ">	
			   			<h5 class="fl">
			   				<a href="<?php echo get_home_url(); ?>/books/<?php echo $slug_name; ?>"> <span class=""> Read It </span> <i class="fa fa-angle-right" aria-hidden="true"> </i></a>
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
			<?php
			if(get_query_var('vol-name')!=null) :	
			$slug = get_query_var('vol-name');
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
			$total_count = count($categories);
			$total_page_count = absint(($total_count / $limit)+1); 

			?>
			<div class="breadcrumb-w hidden-xs breadcrumb-align">
				<ul class="breadcrumb">
					<li>
						<a data-active="1" class="breadcrumb_anger" href="<?php echo get_home_url(); ?>">
							<span class=""> Home </span>
						</a>
					</li>
					<li>
						<a data-active="1" class="breadcrumb_anger" href="<?php echo get_home_url(); ?>/books/<?php echo $slug; ?>">
							<span class=""> <?php echo $cat->name; ?> </span>
						</a>
					</li>
					<li>
						<span class=""> Sections </span>
					</li>
				</ul>
			</div>
			<div class="cb"> </div>
			<?php
				the_content(); 
			?>
			<h5 class="volume_number">
				<span class=""> <?php echo $cat->name; ?> </span>
			</h5>

				<?php if($total_count >= 1) : ?>
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
									$sections = explode('-',$value->name);
									$start_value++;
						   			$slug_name = $value->slug;
						   			// echo $slug_name;
						   		?> </td>
				  	 			<td class="td1">
				  	 				<a href="<?php echo get_home_url(); ?>/books/<?php echo $current_slug; ?>/<?php echo $slug_name; ?>"> 
				  	 					<span class=""> <?php echo $sections[0]; ?> </span>
				  	 				</a>
				  	 			</td>
				  	 			<td class="td2"> <?php echo $sections[1]; ?> </td>
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
				<?php 
				else :
				?>
					<div class="page_content">
						<p> No sections found </p>
						<div class="col-sm-12 col-md-12 col-lg-12 frame_footer"> 
    						<span>HISTORICAL SOCIETY OF PONDICHERRY</span>
        				</div>
    				</div>
				<?php
				endif;
				?>
			<?php 
			else:
			?>
			<div class="page_content">
				<p> No sections found </p>
				<div class="col-sm-12 col-md-12 col-lg-12 frame_footer"> 
					<span>HISTORICAL SOCIETY OF PONDICHERRY</span>
				</div>
			</div>
			<?php
			endif;
			?>   
		</div>

	<?php
	elseif($parent_slug == 'articles'): 
		if(get_query_var('sec-name')!=null) :
		$slug = get_query_var('sec-name');
		$current_slug = $slug;
		$cat = get_category_by_slug($slug);
		// print_r($cat);
		$cat_id = $cat->term_id;
		$cat_parent_id = $cat->category_parent;
		$parent_category = get_category($cat_parent_id);
		$cat_parent_name = $parent_category->slug;
		$section_name = explode('-',$cat->name);

		$args = array(
			'category' => $cat_id,
	 		'order'    => 'ASC'
		);
		$categories = get_posts($args);
		// print_r($categories);
		$total_count = count($categories);
		$total_page_count = absint(($total_count / $limit)+1); 
	?>

		<div class="frame_text">
			<!--breadcrumb-->
			<div class="breadcrumb-w hidden-xs breadcrumb-align">
				<ul class="breadcrumb">
					<li>
						<a data-active="1" class="breadcrumb_anger" href="<?php echo get_home_url(); ?>">
						<span class=""> Home </span>
						</a>
					</li>
					<li>
						<a data-active="1" class="breadcrumb_anger" href="<?php echo get_home_url(); ?>/books/<?php echo $cat_parent_name; ?>"> 
							<span class=""> <?php echo  $parent_category->name; ?> </span>
						</a>
					</li>
					<li>
						<a data-active="1" class="breadcrumb_anger" href="<?php echo get_home_url(); ?>/books/<?php echo $cat_parent_name; ?>/<?php echo $slug; ?>"> 
							<span class=""> <?php echo $section_name[0]; ?> </span>
						</a>
					</li>
					<li>
						<span class=""> Articles </span>
					</li>
				</ul>
			</div>
			<div class="cb"> </div>
			<?php
				the_content(); 
			?>
			<h5 class="volume_number"> 
				<span class=""> <?php echo $section_name[0]; ?> </span>
			</h5>
				<?php  if($total_count >= 1) :  
				?>
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
									$article_name = explode('-',$value->post_title);
									$start_value++;
									$slug_name = $value->post_name;
						   			// echo $slug_name;
						   		?> </td>
				  	 			<td class="td1"> 
				  	 				<a href="<?php echo get_home_url(); ?>/books/<?php echo $cat_parent_name; ?>/<?php echo $current_slug; ?>/<?php echo $slug_name; ?>"> 	
				  	 					<span class=""> <?php echo $article_name[0]; ?> </span>
				  	 				</a>
				  	 			</td>
				  	 			<td class="td2"> <?php echo $article_name[1]; ?> </td>
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
				<?php
				else :
				?>
				<div class="page_content">
					<p> No articles found </p>
					<div class="col-sm-12 col-md-12 col-lg-12 frame_footer"> 
						<span>HISTORICAL SOCIETY OF PONDICHERRY</span>
					</div>
				</div>
				<?php
					endif;
				?>
		</div>
		
		<?php else:
		?>
		<div class="frame_text">
			<?php
				the_content(); 
			?>
			<div class="page_content">
				<p> No articles found </p>
				<div class="col-sm-12 col-md-12 col-lg-12 frame_footer"> 
					<span>HISTORICAL SOCIETY OF PONDICHERRY</span>
				</div>
			</div>
		</div>
		<?php endif;
		?>

	<?php
	elseif($parent_slug == 'article-content'): 
		if(get_query_var('art-name')!=null) :
		$slug = get_query_var('art-name');
		$args = array(
	    	'orderby' => 'ID',
	     	'name' => $slug
		);
		$categories = get_posts($args);
		// print_r($categories);
		$article_name = explode('-',$categories[0]->post_title);
		$article_id = $categories[0]->ID;
		$sec_detail=get_the_category( $article_id );
		// print_r($sec_detail);
		$sec_name=explode("-",$sec_detail[0]->name);
		$sec_slug = $sec_detail[0]->slug;
		$parent_cat_id = $sec_detail[0]->category_parent;
		$vol_detail = get_category($parent_cat_id);
		$vol_slug = $vol_detail->slug;
	?>			
		<div class="frame_text">
			<!--breadcrumb-->
			<div class="breadcrumb-w hidden-xs breadcrumb-align">
				<ul class="breadcrumb">
					<li>
						<a data-active="1" class="breadcrumb_anger" href="<?php echo get_home_url(); ?>">
							<span class=""> Home </span>
						</a>
					</li>
					<li>
						<a data-active="1" class="breadcrumb_anger" href="<?php echo get_home_url(); ?>/books/<?php echo $vol_slug; ?>"> 
							<span class=""> <?php echo $vol_detail->name; ?> </span>
						</a>
					</li>
					<li>
						<a data-active="1" class="breadcrumb_anger" href="<?php echo get_home_url(); ?>/books/<?php echo $vol_slug; ?>/<?php echo $sec_slug; ?>"> 
							<span class=""> <?php echo $sec_name[0]; ?> </span>
						</a>
					</li>
					<li>
						<span class=""> <?php echo $article_name[0]; ?> </span>
					</li>
				</ul>
			</div>
			<div class="cb"> </div>
			<h5 class="volume_number article_heading"> 
				<span class=""> <?php echo $article_name[0]; ?> </span>
			</h5>
			<div class="article_description_language">
				<?php echo $categories[0]->post_content; ?>
			</div>
			<input type="hidden" value="<?php echo $article_name[0]; ?>" id="download_article_name" />
			<input type="hidden" value="<?php echo date('l jS F Y'); ?>" id="download_article_date" />
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