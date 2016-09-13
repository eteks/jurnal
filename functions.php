<?php

//  Display menu options in appearance
function journal_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Widget Area', 'twentyfifteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentyfifteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'journal_widgets_init' );

//  Display header menu and footer menu options in menu page
register_nav_menus( array(
		'primary' => __( 'Header Menu',  'journal' ),
		'footer'  => __( 'Footer Menu', 'journal' ),
) );

add_theme_support( 'custom-logo', array(
		'height'      => 248,
		'width'       => 248,
		'flex-height' => true,
) );


/**
* Create Logo Setting and Upload Control
*/
// function volume_logo($wp_customize) {
// // add a setting for the site logo
// $wp_customize->add_setting('your_theme_logo');
// // Add a control to upload the logo
// $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'your_theme_logo',
// array(
// 'label' => 'Volume Logo',
// 'section' => 'title_tagline',
// 'settings' => 'your_theme_logo',
// ) ) );
// }
// add_action('customize_register', 'volume_logo');