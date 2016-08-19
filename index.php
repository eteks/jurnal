<?php get_header(); ?>
	<section class="index_class">
		<div class="container">
			<div class="row">
				<div class="frame" class="col-md-12 col-lg-12 ">
					<?php 
						if ( have_posts() ) : while ( have_posts() ) : the_post();
			  				get_template_part( 'content', get_post_format() );
		  				endwhile; endif; 
			    	?>
			    </div>
			</div>
		</div>
	</section>
<?php get_footer(); ?>