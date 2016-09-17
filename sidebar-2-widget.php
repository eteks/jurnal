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
	// global $sgwindow_curr_page_id;
	// $sgwindow_curr_slug = sgwindow_get_page_sidebar_slug( $sgwindow_curr_page_id );
	// $hook_name = 'sgwindow_empty_column_1-'.$sgwindow_curr_slug;
	$journal_curr_slug = journal_get_sidebar_slug();
	$hook_name = 'sgwindow_empty_column_2-'.$journal_curr_slug;
	// echo $hook_name;
?>
<div class="sidebar-2 right-sidebar">
	<div class="column-size-3">		
		<div class="widget-area">
		<?php if ( is_active_sidebar( 'column-2'.'-'.$journal_curr_slug ) ) : ?>
				<p> dynamic </p>
				<?php dynamic_sidebar( 'column-2'.'-'.$journal_curr_slug ); ?>

		<?php else : ?>
				<p> static </p>
				<?php do_action( $hook_name ); ?>
		
		<?php endif; ?>
		</div><!-- .widget-area -->
	</div><!-- .column -->
</div><!-- .sidebar-1 -->