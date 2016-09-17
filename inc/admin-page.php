<?php
/**
 * The template for displaying the admin section
 *
 * @package WordPress
 * @link http://www.revuehistoriquedepondichery.org/demo/
 * @subpackage journal window
 * @since journal Window 1.0
 */


function revue_admin_page() {
	add_theme_page( __( 'About theme' ), __( 'About Revue'), 'edit_theme_options', 'about-page', 'revue_about_page');
}
add_action( 'admin_menu', 'revue_admin_page' );

function revue_admim_style( $hook ) {
	if ( 'appearance_page_about-page' == $hook ) {
		wp_enqueue_style( 'revue-admin-page-style', get_stylesheet_directory_uri() . '/inc/css/admin-style.css', array(), null );
	}
	else {
		wp_enqueue_style( 'revue-admin-category-style', get_stylesheet_directory_uri() . '/inc/css/admin-cat-style.css', array(), null );
		return;
	}
}
add_action( 'admin_enqueue_scripts', 'revue_admim_style' );


function revue_about_page() {
?>
	<div class="admin-revue-wrapper">
		<h1 class="sg-header"><?php esc_html_e( 'Main Info' ); ?></h1>
		<div class="revue-wrapper">
			<p>
				<a href="http://www.revuehistoriquedepondichery.org/demo/" target="_blank">
				<?php esc_html_e( 'Visit site', 'new_journal' ); ?> </a>
			</p>
			<div class="revue-image">
				<img src="<?php echo get_stylesheet_directory_uri() . '/screenshot.png'; ?>" />
			</div> 
		</div> 
		<div class="ets-wrapper">
			<p> Developed by Etekchno Services Pvt Ltd.
				<a href="http://etekchnoservices.com/" target="_blank">
				<?php esc_html_e( 'Visit site', 'new_journal' ); ?> </a>
			</p>
			<div class="ets-image">
				<img src="<?php echo get_stylesheet_directory_uri() . '/images/ets_screenshot.png'; ?>" />
			</div> 
		</div> 
	</div><!-- .main-wrapper -->
<?php
}