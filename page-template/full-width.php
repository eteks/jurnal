<?php
/**
 * Template Name: Full width
 *
 * @package WordPress
 * @link http://www.revuehistoriquedepondichery.org/demo/
 * @subpackage journal window
 * @since journal Window 1.0
 */
get_header(); 
?>
	<section class="index_class">
       	<div class="container">
		    <div class="row img-responsive" id="frame">
			    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 full-width_site">
					<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
	  				</div>
 					<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 content_section">
						<?php if ( have_posts() ) : ?>
						<div class="site-content"> 
							<?php while ( have_posts() ) : the_post();

								get_template_part( 'content', get_post_format() );
							
								endwhile; 
							?>
						
						</div><!-- .content -->
						<?php else :  ?>
						<div class="site-content"> 
							<?php 
								get_template_part( 'content', 'none' );
							?>
						</div><!-- .content -->
						<?php  endif; ?>
					</div>
					<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
	  				</div>
	  			</div>
			</div>
		</div>
	</section>
<?php get_footer();