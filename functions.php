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




add_action( 'category_edit_form_fields', 'extra_edit_tax_fields', 10, 2 );
add_action( 'category_add_form_fields', 'extra_edit_tax_fields', 10, 2 );


function extra_edit_tax_fields($tag) {
    // Check for existing taxonomy meta for term ID.
    $t_id = $tag->term_id;
    echo  $t_id;
    $term_meta = get_option( "taxonomy_$t_id" ); ?>
    <tr class="form-field custom-field">
        <th scope="row" valign="top">
            <label for="cat_name_eng"><?php _e( 'Category Name in English' ); ?></label></th>
            <td>
                <input type="text"  style="width:95%;" name="term_meta[cat_name_eng]" id="term_meta[cat_name_eng]" value="<?php echo esc_attr( $term_meta['cat_name_eng'] ) ? esc_attr( $term_meta['cat_name_eng'] ) : ''; ?>">
                <p class="description"><?php _e( 'To enter category name in english' ); ?></p>
            </td>
        </th>
    </tr>
    <tr class="form-field custom-field">
         <th scope="row" valign="top">
            <label for="cat_name_tam"><?php _e( 'Category Name in Tamil' ); ?></label></th>
            <td>
                <input type="text" style="width:95%;" name="term_meta[cat_name_tam]" id="term_meta[cat_name_tam]" value="<?php echo esc_attr( $term_meta['cat_name_tam'] ) ? esc_attr( $term_meta['cat_name_tam'] ) : ''; ?>" >
                <p class="description"><?php _e( 'To enter category name in tamil' ); ?></p>
            </td>
        </th>
    </tr>
    <tr class="form-field custom-field">
         <th scope="row" valign="top">
            <label for="cat_page"><?php _e( 'Page Number' ); ?></label></th>
            <td>
                <input type="text" style="width:95%;" name="term_meta[cat_page_no]" id="term_meta[cat_page_no]" value="<?php echo esc_attr( $term_meta['cat_page_no'] ) ? esc_attr( $term_meta['cat_page_no'] ) : ''; ?>" >
                <p class="description"><?php _e( 'To enter category page number' ); ?></p>
            </td>
        </th>
    </tr>


<?php
}

// Save extra taxonomy fields callback function.
function save_extra_taxonomy_fields( $term_id ) {
    if ( isset( $_POST['term_meta'] ) ) {
        $t_id = $term_id;
        $term_meta = get_option( "taxonomy_$t_id" );
        $cat_keys = array_keys( $_POST['term_meta'] );
        foreach ( $cat_keys as $key ) {
            if ( isset ( $_POST['term_meta'][$key] ) ) {
                $term_meta[$key] = $_POST['term_meta'][$key];
            }
        }
        // Save the option array.
        update_option( "taxonomy_$t_id", $term_meta );
    }
}   
add_action( 'edited_category', 'save_extra_taxonomy_fields', 10, 2 );   
add_action( 'created_category', 'save_extra_taxonomy_fields', 10, 2 );   

















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