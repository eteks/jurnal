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
	// $hook_name = 'sgwindow_empty_column_2-'.$journal_curr_slug;
	// echo $hook_name;
?>
<div class="sidebar-2 right-sidebar">
	<div class="column-size-3">		
		<div class="widget-area">
		<?php if ( is_active_sidebar( 'right-sidebar-widgets' ) ) : ?>
				<p> dynamic </p>
				<?php dynamic_sidebar( 'right-sidebar-widgets' ); ?>

		<?php else : ?>
				<p> No static content </p>
				<?php 
				// do_action( $hook_name ); 
				?>
		
		<?php endif; ?>
		</div><!-- .widget-area -->
	</div><!-- .column -->
</div><!-- .sidebar-1 -->