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
		// echo "page ".$page_val;
		$start_value = ($page_val-1)*$limit + 1;
		// echo "start ".$start_value;
		$end_value = $start_value+($limit-1);
		// echo "end ".$end_value;
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
	 		   	 		<img src="<?php bloginfo('stylesheet_directory');?>/images/building.png" alt="Building_picture" class="fr building_pic">
	 		   		</div>
	 		   		<div class="col-xs-8 col-sm-6 col-md-8 col-lg-8 no_pad ">	
			   			<h4 class="fl"> <?php echo $value->name; ?> </h4>
			   		</div>
			   		<?php
			   			$start_value++;
			   			$slug_name = $value->slug;
			   			// echo $slug_name;
			   		?>
			   		<div class="col-xs-8 col-sm-6 col-md-8 col-lg-8 no_pad ">	
			   			<h5 class="fl">
			   				<a href="sections?post-type=<?php echo $slug_name; ?>"> <span class="eng"> Read It </span> <span class="fre"> 
lis le </span> <span class="tam"> இதை படிக்க </span>  <i class="fa fa-angle-right" aria-hidden="true"> </i></a>
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
						<a data-active="1" class="breadcrumb_anger" href="home">Home page</a>
					</li>
					<li>
						<span>List Sections </span>
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
			$total_count = count($categories);
			$total_page_count = absint(($total_count / $limit)+1); 

			?>
		  	<h5 class="volume_number"> <?php echo $cat->name; ?> </h5>
		  	<div class="page_content">
		  	 	<table class="table_content none_language">
		  	 		<?php
		  	 		foreach ($categories as $value) :
					?>
					<?php
						if($default_value >= $default_start_value && $start_value <= $end_value) :	
						$sections=explode("-",$value->name);
					?>
						<tr>
							<td> <?php
								$start_value++;
					   			$slug_name = $value->slug;
					   			// echo $slug_name;
					   		?> </td>
			  	 			<td class="td1"><a href="articles?post-type=<?php echo $slug_name; ?>"> <?php echo $sections[0]; ?> </a></td>
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
		$section_name=explode("-",$sec_name);
	?>
		<div class="frame_text">
			<!--breadcrumb-->
			<div class="breadcrumb-w hidden-xs breadcrumb-align">
				<ul class="breadcrumb">
					<li>
						<a data-active="1" class="breadcrumb_anger" href="home">Home page</a>
					</li>
					<li>
						<a data-active="1" class="breadcrumb_anger" href="sections?post-type=<?php echo $cat_parent_name; ?>"> Sections </a>
					</li>
					<li>
						<span>List Articles</span>
					</li>
				</ul>
			</div>
			<div class="cb"> </div>
			<?php
				the_content(); 
			?>
			<h5 class="volume_number"> <?php echo $section_name[0]; ?> </h5>
		  	<div class="page_content">
		  	 	<table class="table_content">
		  	  		<?php
		  	 		foreach ($categories as $key => $value): 
						$articles=explode("-",$value->name);
						?>
						<tr>
							<?php 
							if($default_value >= $default_start_value && $start_value <= $end_value) :
							?>
							<td> <?php
								$start_value++;
					   			$slug_name = $value->slug;
					   			// echo $slug_name;
					   		?> </td>
			  	 			<td class="td1"> <a href="article-content?post-type=<?php echo $slug_name; ?>"> <?php echo $articles[0]; ?> </a> </td>
			  	 			<td class="td2"> <?php echo $articles[1]; ?> </td>
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
		$sec_parent_id = $cat->category_parent;
		$parent_section = get_category($sec_parent_id);
		$cat_parent_id = $parent_section->category_parent;
		$sec_parent_name = $parent_section->slug;
		$parent_category = get_category($cat_parent_id);
		$cat_parent_name = $parent_category->slug;

		// $post_id = get_term_meta($cat_id,'_term_image');
		// $uploads = wp_upload_dir();
		// $event_name = get_post_meta( $post_id[0], '_wp_attached_file' );
  //   	$file_path = $uploads['baseurl']."/".$event_name[0];
  //   	// echo $file_path;
		$art_name = $cat->name;
		$article_name=explode("-",$art_name);
	?>			
		<div class="frame_text">
			<!--breadcrumb-->
			<div class="breadcrumb-w hidden-xs breadcrumb-align">
				<ul class="breadcrumb">
					<li>
						<a data-active="1" class="breadcrumb_anger" href="home">Home page</a>
					</li>
					<li>
						<a data-active="1" class="breadcrumb_anger" href="sections?post-type=<?php echo $cat_parent_name; ?>"> Sections </a>
					</li>
					<li>
						<a data-active="1" class="breadcrumb_anger" href="articles?post-type=<?php echo $sec_parent_name; ?>"> Articles </a>
					</li>
					<li>
						<span> <?php echo $article_name[0]; ?> </span>
					</li>
				</ul>
			</div>
			<div class="cb"> </div>
			<h5 class="volume_number article_heading"> <?php echo $article_name[0]; ?> </h5>
			<div class="article_description_language">
				<?php echo $cat->description; ?>
			</div>
			<input type="hidden" value="<?php echo $article_name[0]; ?>" id="download_article_name" />
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