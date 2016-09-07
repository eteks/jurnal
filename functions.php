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

