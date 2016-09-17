<?php
/**
 * Template Name: Left sidebar
 *
 * @package WordPress
 * @link http://www.revuehistoriquedepondichery.org/demo/
 * @subpackage journal window
 * @since journal Window 1.0
 */
 __( 'Left Sidebar', 'new-journal' );

get_header(); 

?>
	<section class="index_class">
       	<div class="container">
		    <div class="row img-responsive" id="frame">
			    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 full-width_site">
					<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
	  				</div>
	  				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
	  					<?php
							get_sidebar( '1' );
						?>
	  				</div>
 					<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
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