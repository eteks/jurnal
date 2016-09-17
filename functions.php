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

// add_theme_support( 'custom-header', apply_filters( 'test', array(
// 	'default-text-color'     => $default_text_color,
// 	'width'                  => 200,
// 	'height'                 => 200,
// 	'flex-height'            => false,
// 	'wp-head-callback'       => 'twentysixteen_header_style',
// 	'name'       => 'test',
// ) ) );

$args = array(
	'header-text'            => true,
	'default-text-color'     => 'ffffff',
	'width'                  => 200,
	'height'                 => 200,
	'flex-height'            => true,
	'flex-width'             => true,
);
add_theme_support( 'custom-header', $args );



//admin page
require get_stylesheet_directory() . '/inc/admin-page.php';

//customize sidebars
require get_stylesheet_directory() . '/inc/customize-sidebar.php';



// Added by muthu for language converter

add_action('admin_print_footer_scripts','eg_quicktags');
function eg_quicktags() {
?>
<script type="text/javascript" charset="utf-8">
buttonA = edButtons.length;
edButtons[edButtons.length] = new edButton('ed_eng','English','<div class="eng">','</div>','eng');
// buttonB = edButtons.length;
edButtons[edButtons.length] = new edButton('ed_fre','French','<div class="fre">','</div>','fre');
// buttonC= = edButtons.length;
edButtons[edButtons.length] = new edButton('ed_tam','Tamil','<div class="tam">','</div>','tam');

jQuery(document).ready(function($){
   jQuery("#ed_toolbar").append('<input type="button" value="English" id="ed_eng" class="ed_button" onclick="edInsertTag(edCanvas, buttonA);" title="English" />');
   jQuery("#ed_toolbar").append('<input type="button" value="French" id="ed_fre" class="ed_button" onclick="edInsertTag(edCanvas, buttonB);" title="French" />');
   jQuery("#ed_toolbar").append('<input type="button" value="Tamil" id="ed_tam" class="ed_button" onclick="edInsertTag(edCanvas, buttonc);" title="Tamil" />');
   // jQuery('#content-tmce').remove();
   jQuery('.mce-tinymce').hide();
   jQuery('#ed_toolbar').show();
}); 
</script>
<?php
}

// Added by muthu for adding extra fields in category

remove_filter( 'pre_term_description', 'wp_filter_kses' );
remove_filter( 'term_description', 'wp_kses_data' );

add_filter('category_add_form_fields', 'cat_description');
add_filter('edit_category_form_fields', 'cat_description');
function cat_description($tag)
{
?>
    <div class="form-field custom-field">
        <th scope="row" valign="top">
            <label for="description"><?php _ex('Description', 'Taxonomy Description'); ?></label></th>
        <td>
            <?php
                $settings = array('wpautop' => true, 'media_buttons' => true, 'quicktags' => true, 'textarea_rows' => '15', 'textarea_name' => 'description' );
                wp_editor(wp_kses_post($tag->description , ENT_QUOTES, 'UTF-8'), 'cat_description', $settings);
            ?>
            <span class="description"><?php _e('To enter description for category in english, french, tamil.'); ?></span>
        </td>
    </div>
<?php
}


add_action('admin_head', 'remove_default_category_description');
function remove_default_category_description()
{
    global $current_screen;
    if ( $current_screen->id == 'edit-category' )
    {
    ?>
        <script type="text/javascript">
        jQuery(function($) {
            $('textarea#tag-description').closest('.term-description-wrap').remove();
            $('textarea#description').closest('.term-description-wrap').remove();
        });
        </script>
    <?php
    }
}
































//  Pagination - custom
function wp_custom_pagination($page_val,$total_page_count,$current_slug) {
?>
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
        <div class="col-sm-12 col-md-12 col-lg-12 frame_footer">
            <span>HISTORICAL SOCIETY OF PONDICHERRY</span>
        </div>
    </div>
<?php
}