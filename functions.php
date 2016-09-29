<?php
/**
 * The template for displaying the cms options
 *
 * @package WordPress
 * @link http://www.revuehistoriquedepondichery.org/demo/
 * @subpackage journal window
 * @since journal Window 1.0
 */

//  To add widgets
add_theme_support('widgets');

// To register sidebar for 
function journal_get_widgets($widget_name,$widget_id,$widget_des) {
    register_sidebar( array(
        'name'          => $widget_name,
        'id'            => $widget_id,
        'description'   => $widget_des,
        'before_widget' => '<div class="widget-area-custom">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}

// To add multiple widgets
journal_get_widgets('Left sidebar','left-sidebar-widgets','To add widgets for left sidebar');
journal_get_widgets('Right sidebar','right-sidebar-widgets','To add widgets for right sidebar');
journal_get_widgets('Language Option','language-widgets','To add language widgets for dropdown');


//  Display header menu and footer menu options in menu page
register_nav_menus( array(
        'primary' => __( 'Header Menu',  'journal' ),
        'footer'  => __( 'Footer Menu', 'journal' ),
) );

// To change logo
add_theme_support( 'custom-logo', array(
        'height'      => 248,
        'width'       => 248,
        'flex-height' => true,
) );

//  To change header logo
$args = array(
    'width'                  => 200,
    'height'                 => 200,
    'flex-height'            => true,
    'flex-width'             => true
);
add_theme_support( 'custom-header', $args );


//admin page
require get_stylesheet_directory() . '/inc/admin-page.php';

//customize sidebars
require get_stylesheet_directory() . '/inc/customize-sidebar.php';


//  Pagination - custom
function wp_custom_pagination($page_val,$total_page_count,$current_slug) {
?>
    <div class="clearfix"> </div>
    <div class="col-sm-12 col-md-12 col-lg-12 frame_footer"> 
        <div class="paginaion_section col-lg-11">
        <?php 
            $i=1;
            if(!empty($current_slug)) :
                $url_pag="?post-type=$current_slug&page-num=";
            else :
                $url_pag="?page-num=";
            endif;
            if($page_val>1) :
                echo "<a href='$url_pag".($page_val-1)."' class='button'>  < </a>";
            endif;
            while($i<=$total_page_count) :
                if($i==$page_val) : 
                    echo "<span class='current pagination_list'><a href='#'>".$i."</a></span>"; 
                else :
                    echo "<span class='pagination_list'><a href='$url_pag".$i."'>".$i."</a></span>"; 
                endif;
                $i++;
            endwhile;
            if($page_val!=$total_page_count) :
                echo "<a href='$url_pag".($page_val+1)."' class='button'> > </a>";
            endif;
        ?>
        </div> 
        <div class="clearfix"> </div> 
        <div class="col-sm-12 col-md-12 col-lg-12 frame_footer_content">
            <span>HISTORICAL SOCIETY OF PONDICHERRY</span>
        </div>
    </div>
<?php
}

//  Rewrite Url for volume, sections, articles
add_action( 'init', 'rewrite_categories_url' );
function rewrite_categories_url() {
    add_rewrite_rule( 'books/([^/]+)/?$','index.php?pagename=sections&vol-name=$matches[1]','top');
    add_rewrite_rule( 'books/([^/]+)/([^/]+)/?$','index.php?pagename=articles&vol-name=$matches[1]&sec-name=$matches[2]','top');
    add_rewrite_rule( 'books/([^/]+)/([^/]+)/([^/]+)/?$','index.php?pagename=article-content&vol-name=$matches[1]&sec-name=$matches[2]&art-name=$matches[3]','top');
}


//  To create variable for url rewrite function
add_filter( 'query_vars', 'register_custom_query_vars_volume', 1 );
function register_custom_query_vars_volume( $vars ) {
    $vars[] = 'vol-name';
    $vars[] = 'sec-name';
    $vars[] = 'art-name';
    return $vars;
}