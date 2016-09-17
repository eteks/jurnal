<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @link http://www.revuehistoriquedepondichery.org/demo/
 * @subpackage journal window
 * @since journal Window 1.0
 */
?>

<?php
	// $journal_curr_slug = journal_get_sidebar_slug();
	// $hook_name1 = 'sgwindow_empty_column_1-'.$journal_curr_slug;
	// $hook_name2 = 'sgwindow_empty_column_2-'.$journal_curr_slug;
	// echo $hook_name;
?>
<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
	<div class="sidebar-1 left-sidebar">
		<div class="column-size-3">		
			<div class="widget-area">
				<?php if ( is_active_sidebar( 'left-sidebar-widgets') ) : ?>
					<?php dynamic_sidebar( 'left-sidebar-widgets' ); ?>

				<?php else : ?>
					<p> No static content </p>
					<?php 
						// do_action( $hook_name1 ); 
					?>
				
				<?php endif; ?>
			</div><!-- .widget-area -->
		</div><!-- .column -->
	</div><!-- .sidebar-1 -->
</div>
<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="float:right;">
	<div class="sidebar-2 right-sidebar">
		<div class="column-size-3">		
			<div class="widget-area">
				<?php if ( is_active_sidebar( 'right-sidebar-widgets' ) ) : ?>
					<?php dynamic_sidebar( 'right-sidebar-widgets' ); ?>

				<?php else : ?>
					<p> No static content </p>
					<?php 
						// do_action( $hook_name2 ); 
					?>
				
				<?php endif; ?>
			</div><!-- .widget-area -->
		</div><!-- .column -->
	</div><!-- .sidebar-1 -->
</div>