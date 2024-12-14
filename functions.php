<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'parallax', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'parallax' ) );

//* Add Image upload to WordPress Theme Customizer
add_action( 'customize_register', 'parallax_customizer' );
function parallax_customizer(){

	require_once( get_stylesheet_directory() . '/lib/customize.php' );
	
}

// Start the engine
require_once( CHILD_DIR . '/lib/bg-main-slider.php' );

//* Include Section Image CSS
include_once( get_stylesheet_directory() . '/lib/output.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Parallax Pro Theme' );
define( 'CHILD_THEME_URL', 'http://my.studiopress.com/themes/parallax/' );
define( 'CHILD_THEME_VERSION', '1.2' );

//* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'parallax_enqueue_scripts_styles' );
function parallax_enqueue_scripts_styles() {

	wp_enqueue_script( 'port-core', CHILD_URL . '/js/jquery-1.11.0.min.js', array( 'jquery' ), CHILD_THEME_VERSION);
	wp_enqueue_script( 'flexslider', CHILD_URL . '/js/jquery.flexslider-min.js', array( 'jquery' ), CHILD_THEME_VERSION);
	wp_enqueue_script( 'custom-javascript', CHILD_URL . '/js/custom.js', array( 'jquery' ), CHILD_THEME_VERSION);
	wp_enqueue_script( 'parallax-responsive-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0' );

	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'customcss', get_bloginfo( 'stylesheet_directory' ) . '/custom.css', array() );
	wp_enqueue_style( 'slickcss', get_bloginfo( 'stylesheet_directory' ) . '/css/slick.css', array() );
	wp_enqueue_style( 'slicktheme', get_bloginfo( 'stylesheet_directory' ) . '/css/slick-theme.css', array() );
	wp_enqueue_style( 'raleway-google-fonts', '//fonts.googleapis.com/css?family=Raleway:500,600,700,100,800,900,400,200,300', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'lato-google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'nycd-google-fonts', '//fonts.googleapis.com/css?family=Nothing+You+Could+Do', array(), CHILD_THEME_VERSION );
	

}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Reduce the secondary navigation menu to one level depth
add_filter( 'wp_nav_menu_args', 'parallax_secondary_menu_args' );
function parallax_secondary_menu_args( $args ){

	if( 'secondary' != $args['theme_location'] )
	return $args;

	$args['depth'] = 1;
	return $args;

}

//* Unregister layout settings
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

//* Add support for additional color styles
add_theme_support( 'genesis-style-selector', array(
	'parallax-pro-blue'   => __( 'Parallax Pro Blue', 'parallax' ),
	'parallax-pro-green'  => __( 'Parallax Pro Green', 'parallax' ),
	'parallax-pro-orange' => __( 'Parallax Pro Orange', 'parallax' ),
	'parallax-pro-pink'   => __( 'Parallax Pro Pink', 'parallax' ),
) );

//* Unregister secondary sidebar
unregister_sidebar( 'sidebar-alt' );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'width'           => 360,
	'height'          => 70,
	'header-selector' => '.site-title a',
	'header-text'     => false,
) );

//* Add support for structural wraps
add_theme_support( 'genesis-structural-wraps', array(
	'header',
	'nav',
	'subnav',
	'footer-widgets',
	'footer',
) );

// Add Read More Link to Excerpts
add_filter('excerpt_more', 'get_read_more_link');
add_filter( 'the_content_more_link', 'get_read_more_link' );
function get_read_more_link() {
   return '...&nbsp;<a href="' . get_permalink() . '">[Read&nbsp;More]</a>';
}



//* Modify the size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'parallax_author_box_gravatar' );
function parallax_author_box_gravatar( $size ) {

	return 176;

}

//* Modify the size of the Gravatar in the entry comments
add_filter( 'genesis_comment_list_args', 'parallax_comments_gravatar' );
function parallax_comments_gravatar( $args ) {

	$args['avatar_size'] = 120;

	return $args;

}


//* Include Custom banner for home and subpages
add_action( 'genesis_after_header', 'banner', 10 );

function banner() {

 if (is_front_page()) {  
		require(CHILD_DIR.'/home-banner.php');
	 }
  // If it's the About page, display subpage banner
	elseif ( is_page() && !is_page(array('29'))) {
		require(CHILD_DIR.'/subpage-banner.php');
	}
	elseif ( is_single() && !is_singular('portfolio')) {
		require(CHILD_DIR.'/subpage-banner.php');
	}
	elseif (is_singular('portfolio')) {
		require(CHILD_DIR.'/single-portfolio-banner.php');
	}
	elseif ( is_archive()) {
		require(CHILD_DIR.'/subpage-banner.php');
	}
	elseif(is_home()) {
		require(CHILD_DIR.'/subpage-banner.php');
	}
	// If it's the portfolio page, display portfolio banner
	elseif ( is_page(29) ) {
		require(CHILD_DIR.'/portfolio-banner.php');
	}
	

}

// Add Section above footer
add_action( 'genesis_before_footer', 'section_before_footer' );
function section_before_footer() {
	
	if (is_front_page()) {  
		require(CHILD_DIR.'/before-footer.php');
	 }
	elseif ( is_home() ) {
		require(CHILD_DIR.'/before-footer.php');
	}
	elseif ( is_page() ) {
		require(CHILD_DIR.'/before-footer.php');
	}
	elseif ( is_single() ) {
		require(CHILD_DIR.'/before-footer.php');
	}
	elseif ( is_archive() ) {
		require(CHILD_DIR.'/before-footer.php');
	}	
}

/* Fluid Primary Menu (Below Header) */
remove_action( 'genesis_before_header', 'genesis_do_nav');
add_action( 'genesis_after_header', 'genesis_do_nav', 5);
/* end Fluid Menus */


/**
* Add utility bar above header.
*/
function utility_bar() {
echo '<div class="utility-bar"><div class="wrap">';
genesis_widget_area( 'utility-bar-top', array(
'before' => '<div class="utility-bar-top">',
'after' => '</div>',
) );
echo '</div></div>';
}

genesis_register_sidebar( array(
'id' => 'utility-bar-top',
'name' => __( 'Utility Bar Top', 'parallax' ),
'description' => __( 'This is the utility bar above the header.', 'parallax' ),
) );
add_action( 'genesis_before_header', 'utility_bar', 1 );

//Portfolio Post type Starts here
// register the taxonomy to only that custom post type by passing the custom post type name as argument in register_taxonomy.
function portfolio_taxonomy() {  
    register_taxonomy(  
        'specialities',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces). 
        'Portfolio',        //post type name
        array(  
            'hierarchical' => true,  
            'label' => 'Portfolio Categories',  //Display name
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'specialities', // This controls the base slug that will display before each term
                'with_front' => false // Don't display the category base before 
            )
        )  
    );  
}  
add_action( 'init', 'portfolio_taxonomy');


//Then to change the permalink I have created following function
function filter_post_type_link($link, $post)
{
    if ($post->post_type != 'Portfolio')
        return $link;

    if ($cats = get_the_terms($post->ID, 'specialities'))
        $link = str_replace('%specialities%', array_pop($cats)->slug, $link);
    return $link;
}
add_filter('post_type_link', 'filter_post_type_link', 10, 2);

// Portfolio
add_action( 'init', 'register_cpt_team' );
function register_cpt_team() {
$labels = array(
	'name' => _x( 'Portfolio', 'Portfolio' ),
	'singular_name' => _x( 'Portfolio', 'Portfolio' ),
	'add_new' => _x( 'Add New Portfolio', 'Portfolio' ),
	'add_new_item' => _x( 'Add New Portfolio', 'Portfolio' ),
	'edit_item' => _x( 'Edit Portfolio', 'Portfolio' ),
	'new_item' => _x( 'New Portfolio', 'Portfolio' ),
	'view_item' => _x( 'View Portfolio', 'Portfolio' ),
	'search_items' => _x( 'Search Portfolio', 'Portfolio' ),
	'not_found' => _x( 'No Portfolio found', 'Portfolio' ),
	'not_found_in_trash' => _x( 'No Portfolio found in Trash', 'Portfolio' ),
	'parent_item_colon' => _x( 'Parent Team:', 'Portfolio' ),
	'menu_name' => _x( 'Portfolio', 'Portfolio' ),
);
$args = array(
	'labels' => $labels,
	'hierarchical' => true,
	'description' => 'All the Portfolio will be display on its page',
	'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'custom-fields' ),
	'taxonomies' => array( 'specialities', 'post_tag' ),
	'public' => true,
	'show_ui' => true,
	'show_in_menu' => true,
	'show_in_nav_menus' => true,
	'publicly_queryable' => true,
	'exclude_from_search' => false,
	'rewrite' => array('slug' => 'Portfolio/%specialities%','with_front' => FALSE),
	'has_archive'           => 'Portfolio',
	'query_var' => true,
	'can_export' => true,
	'rewrite' => true,
	'capability_type' => 'post'
);
register_post_type( 'Portfolio', $args );
//register_taxonomy_for_object_type( 'category', 'Portfolio' );
}

function wpa_course_post_link( $post_link, $id = 0 ){
    $post = get_post($id);  
    if ( is_object( $post ) ){
        $terms = wp_get_object_terms( $post->ID, 'specialities' );
        if( $terms ){
            return str_replace( '%specialities%' , $terms[0]->slug , $post_link );
        }
    }
    return $post_link;  
}
add_filter( 'post_type_link', 'wpa_course_post_link', 1, 3 );

// Auto apply Default Category to portfolio post if not defined.
function default_taxonomy_term( $post_id, $post ) {
    if ( 'publish' === $post->post_status ) {
        $defaults = array(
            'specialities' => array( 'default'),   //

            );
        $taxonomies = get_object_taxonomies( $post->post_type );
        foreach ( (array) $taxonomies as $taxonomy ) {
            $terms = wp_get_post_terms( $post_id, $taxonomy );
            if ( empty( $terms ) && array_key_exists( $taxonomy, $defaults ) ) {
                wp_set_object_terms( $post_id, $defaults[$taxonomy], $taxonomy );
            }
        }
    }
}
add_action( 'save_post', 'default_taxonomy_term', 100, 2 ); 
// Portfolio
//Portfolio Post type ends here

/* Slider Post Type */
function register_cpt_slider() {

    $labels = array( 
        'name' => _x( 'Slider Posts', 'slider' ),
        'singular_name' => _x( 'Slider Post', 'slider' ),
        'add_new' => _x( 'Add New', 'slider' ),
        'add_new_item' => _x( 'Add New Slider Post', 'slider' ),
        'edit_item' => _x( 'Edit Slider Post', 'slider' ),
        'new_item' => _x( 'New Slider Post', 'slider' ),
        'view_item' => _x( 'View Slider Post', 'slider' ),
        'search_items' => _x( 'Search Slider Posts', 'slider' ),
        'not_found' => _x( 'No slider posts found', 'slider' ),
        'not_found_in_trash' => _x( 'No slider posts found in Trash', 'slider' ),
        'parent_item_colon' => _x( 'Parent Slider Post:', 'slider' ),
        'menu_name' => _x( 'Slider', 'slider' )
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'has_archive' => false,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'slider', $args );

}

add_action( 'init', 'register_cpt_slider' );

// Add new image size for Portfolio feature image
add_image_size( 'Portfolio-Thumbnail', 450, 325, TRUE );
add_image_size( 'Portfolio-large', 1800, 550, array( 'left', 'bottom' ) );
add_image_size( 'slider_full', 1800, 747, true );
add_image_size( 'slider_tablet', 879, 747, true );
add_image_size( 'slider_mobile', 540, 747, true );
//add_image_size( 'Portfolio-Thumbnail', 358, 325, array( 'left', 'bottom' ) );

// Rates Widget
function rates_bar() {
echo '<div class="rates-bar rateswidget"><div class="wrap">';
genesis_widget_area( 'rates-bar-top', array(
'before' => '<div class="rates-bar-top">',
'after' => '</div>',
) );
echo '</div></div>';
}

genesis_register_sidebar( array(
'id' => 'rates-bar-top',
'name' => __( 'Rates Section', 'parallax' ),
'description' => __( 'This is the Rates Section above the footer.', 'parallax' ),
) );
add_action('genesis_before_footer', 'rates_bar' );

// Customize the post info function
add_filter( 'genesis_post_info', 'post_info_filter' );
function post_info_filter($post_info) {
	$post_info = 'Posted on: [post_date]';
	return $post_info;
}
 

//* Add support for 4-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
add_action( 'genesis_footer', 'genesis_footer_widget_areas', 5 );

/* Genesis - Remove breadcrumbs */
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

/** Remove page/post/attachment titles */
add_action( 'get_header', 'remove_titles_all_single_pages' );
function remove_titles_all_single_pages() {
    if ( is_singular('page') ) {
        remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
    }
}
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

//Changing the Copyright text
function genesischild_footer_creds_text () {
 echo '';
}
add_filter( 'genesis_footer_creds_text', 'genesischild_footer_creds_text' );


//* Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

//* Relocate after entry widget
remove_action( 'genesis_after_entry', 'genesis_after_entry_widget_area' );
add_action( 'genesis_after_entry', 'genesis_after_entry_widget_area', 5 );




//* Remove primary navigation menu
//add_theme_support( 'genesis-menus', array( 'secondary' => __( 'Secondary Navigation Menu', 'genesis' ) ) );


// Widget - Latest News on home page
genesis_register_sidebar( array(
	'id'			=> 'genesis-featured-posts',
	'name'			=> __( 'Latest News on Home Page', 'timothy' ),
	'description'	=> __( 'This is home page widget', 'timothy' ),
) );


//Extra Widget Area
function genesischild_footerwidgetheader() {
	genesis_register_sidebar( array(
	'id' => 'footerwidgetheader',
	'name' => __( 'Footer Widget Header', 'genesis' ),
	'description' => __( 'This is for the Footer Widget Headline', 'genesis' ),
	) );

}

add_action ('widgets_init','genesischild_footerwidgetheader');

//Position Widget Header
function genesischild_footerwidgetheader_position ()  {
	echo '<div class="footerwidgetheader-container"><div class="wrap">';
	genesis_widget_area ('footerwidgetheader');
	echo '</div></div>';

}

add_action ('genesis_after_footer','genesischild_footerwidgetheader_position');

remove_action( 'genesis_after_header', 'genesis_do_nav' );

// Button Shortcode
function download_button($atts, $content = null) {
 extract( shortcode_atts( array(
          'url' => '#'
), $atts ) );
return '<a href="'.$url.'" class="wpbutton"><span>' . do_shortcode($content) . '</span></a>';
}
add_shortcode('download', 'download_button');


//* Rotate image using Sub Tag
function random_hero_img($tag) { 

	$args = array( 'post_type' => 'attachment', 
				// 'post_status' => 'publish',
				'orderby' => 'rand',
				'post_mime_type' => 'image',
				'post_status' => 'inherit',
				'tax_query' => array(
					array(
						'taxonomy' => 'media_tag',
						'field' => 'slug',
						'terms' => $tag
					)
				
						));
    $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post();
		  $image = wp_get_attachment_image_src('', $size, false);
		  
		endwhile; 
		wp_reset_query();
		$header_url = $image[0];
  return $header_url;
  
}


// Prevent TinyMCE from stripping out schema.org metadata
function schema_TinyMCE_init($in)
{
    /**
     *   Edit extended_valid_elements as needed. For syntax, see
     *   http://www.tinymce.com/wiki.php/Configuration:valid_elements
     *
     *   NOTE: Adding an element to extended_valid_elements will cause TinyMCE to ignore
     *   default attributes for that element.
     *   Eg. a[title] would remove href unless included in new rule: a[title|href]
     */
    if(!empty($in['extended_valid_elements']))
        $in['extended_valid_elements'] .= ',';

    $in['extended_valid_elements'] .= '@[id|class|style|title|itemscope|itemtype|itemprop|datetime|rel],div,dl,ul,dt,dd,li,span,a|rev|charset|href|lang|tabindex|accesskey|type|name|href|target|title|class|onfocus|onblur]';

    return $in;
}
add_filter('tiny_mce_before_init', 'schema_TinyMCE_init' );

/**
 * Add itemprop image markup to img tags
 * @author Victor M. Font Jr.
 * @link http://victorfont.com/
 */
add_filter('the_content', 'vmf_add_itemprop_image_markup', 2);
function vmf_add_itemprop_image_markup($content)
{
	//Replace the instance with the itemprop image markup.
	$string = '<img';
	$replace = '<img itemprop="image"';
	$content = str_replace( $string, $replace, $content );
	return $content;
}

// Site Optimizations

// Remove Assets Globally 
function wpfiles_dequeue() {
	if (current_user_can( 'update_core' )) {
		return;
	}
	wp_deregister_script('wp-embed');
	
}
add_action( 'wp_enqueue_scripts', 'wpfiles_dequeue', 99 );

// remove jetpack.css from frontend
add_filter( 'jetpack_implode_frontend_css', '__return_false' );

/** Adding custom Favicon */
add_filter( 'genesis_pre_load_favicon', 'custom_favicon' );
function custom_favicon( $favicon_url ) {
	return 'http://www.nationwideconstruction.us/wp-content/themes/parallax-pro/images/favicon.png';
}