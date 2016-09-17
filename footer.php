<?php
/**
 * The template for displaying the footer
 *
 * @package WordPress
 * @link http://www.revuehistoriquedepondichery.org/demo/
 * @subpackage journal window
 * @since journal Window 1.0
 */
?>
			<section>
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<?php
								if ( has_nav_menu( 'footer' ) ) : 
									wp_nav_menu( array(
									 	'theme_location' => 'footer',
									 	'items_wrap' => '<ul class="menu_footer active_section">%3$s</ul>'
									)); 
	 							endif; 
	 						?>
						</div>
					</div>
			   	</div>
		    </section>
		</div>
	    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
	    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/custom.js"></script>
		<?php wp_footer(); ?> 	
	</body>
</html>