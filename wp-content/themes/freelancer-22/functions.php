<?php

// Functions file - Feel free to move parts to the includes folder as you build dear friend...

// flush_rewrite_rules();

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

register_default_headers( array(
    'header' => array(
        'url'   => get_template_directory_uri() . '/images/logo-kinneret-black.svg',
        'thumbnail_url' => get_template_directory_uri() . '/images/logo-kinneret-black.svg',
        'description'   => _x( 'header', 'the logo', 'kinneret logo' )),
));

$args = array(
    'width'         => 440,
    'height'        => 60,
    'default-image' => get_template_directory_uri() . '/images/logo-kinneret-black.svg',
    'uploads'       => true,
);
add_theme_support( 'custom-header', $args );

add_theme_support( 'automatic-feed-links' );
add_theme_support( 'title-tag' );

/*function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');*/

remove_filter('the_content','wpautop');

remove_filter('contact','wpautop');

/*do_shortcode( get_post_meta( $post->ID, 'content', true ) );*/

//decide when you want to apply the auto paragraph

add_filter('the_content','my_custom_formatting');

function my_custom_formatting($content){
    if(get_post_type()=='home') //if it does not work, you may want to pass the current post object to get_post_type
        return $content;//no autop
    else
        return wpautop($content);
}


// Add default posts and comments RSS feed links to head.
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );

/*============================================
Register navbar and sidebar
=============================================*/

register_nav_menus( array(
    'primary' => __( 'Main Menu', 'main-menu' ),
    'footer' => __( 'Footer Menu', 'footer-menu' ),
    'social'  => __( 'Social Links Menu', 'social-menu' ),
) );


add_action('wp_enqueue_scripts', 'header_enqueue_css');
add_action('wp_enqueue_scripts', 'footer_enqueue_js');


/*============================================
Enqueue js and css
=============================================*/

function header_enqueue_css() {
    //load css files
    wp_enqueue_style('theme', get_template_directory_uri(). '/css/theme.css', 'style');
    wp_enqueue_style('style', get_template_directory_uri() . '/style.css', 'style');
    //wp_enqueue_style('flickitycss', get_template_directory_uri() . '/js/vendor/flickity/flickity.min.css', 'style');
    //wp_enqueue_style('featherlightcss', get_template_directory_uri() . '/js/vendor/featherlight/featherlight.css', 'style');
    wp_enqueue_style('aoscss', get_template_directory_uri() . '/js/vendor/aos/aos.css', 'style');
}

function footer_enqueue_js() {

    //load js files
    //wp_enqueue_script('jquery-local', get_template_directory_uri() . '/js/vendor/jquery-1.9.min.js', 'jquery-local','1.9',TRUE);

    // vendor scripts
    //wp_enqueue_script('flickity-js', get_template_directory_uri() . '/js/vendor/flickity/flickity.pkgd.min.js', '','2.2.0',TRUE);
    wp_enqueue_script('easing', get_template_directory_uri() . '/js/vendor/jquery-easing/jquery.easing.js','', '2.0', TRUE);
    //wp_enqueue_script('appear', get_template_directory_uri() . '/js/vendor/jquery-appear/jquery.appear.js','', '0.4', TRUE);
    //wp_enqueue_script('lottie', get_template_directory_uri() . '/js/vendor/lottie/lottie.min.js','', '1.0', TRUE);
    //wp_enqueue_script('anime-js', get_template_directory_uri() . '/js/vendor/anime/anime.min.js', '','1.0',TRUE);
    //wp_enqueue_script('textillate-js', get_template_directory_uri() . '/js/vendor/textillate/jquery.textillate.js', '','1.0',TRUE);
    //wp_enqueue_script('lettering-js', get_template_directory_uri() . '/js/vendor/lettering/jquery.lettering.js', '','1.0',TRUE);
    //wp_enqueue_script('featherlight-js', get_template_directory_uri() . '/js/vendor/featherlight/featherlight.js', '','1.7.13',TRUE);

    // site scripts
    wp_enqueue_script('main-js', get_template_directory_uri() . '/js/site.js', '','1.3',TRUE);
}

add_action('wp_enqueue_scripts', 'my_register_javascript', 100);

function my_register_javascript() {
    wp_register_script('mediaelement', plugins_url('wp-mediaelement.min.js', __FILE__), array('jquery'), '4.8.2', true);
    wp_enqueue_script('mediaelement');
}


/*--------------------------------------------------------*\
   Register Custom Post Types
\*--------------------------------------------------------*/

add_action('init', 'gc_registerPostTypes');

function gc_registerPostTypes() {
    $post__types = [
        'people' => [],
        'news' => [],
    ];

    foreach ($post__types as $key => $options) {
        $labels = [
            'name' => _x(ucfirst($key), 'post type general name'),
            'singular_name' => _x(ucfirst($key), 'post type singular name'),
            'add_new' => _x('Add New ', ucfirst($key)),
            'add_new_item' => 'Add New ' . ucfirst($key),
            'edit_item' => 'Edit ' . ucfirst($key),
            'new_item' => 'New ' . ucfirst($key),
            'view_item' => 'View ' . ucfirst($key),
            'search_items' => 'Search ' . ucfirst($key),
            'not_found' => 'Nothing found',
            'not_found_in_trash' => 'Nothing found in Trash',
            'parent_item_colon' => ''
        ];

        $defaults = [
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => true,
            'menu_position' => null,
            'supports' => ['title', 'editor', 'thumbnail', 'revisions'],
            'show_in_nav_menus' => true,
        ];

        $args = array_merge($defaults, $options);
        register_post_type($key, $args);
    }
}

// Register Custom Taxonomies
function custom_taxonomies() {

    // People Categories

    $labels = array(
        'name'                       => _x( 'People Categories', 'Taxonomy General Name', 'roots' ),
        'singular_name'              => _x( 'People Category', 'Taxonomy Singular Name', 'roots' ),
        'menu_name'                  => __( 'Categories', 'roots' ),
        'all_items'                  => __( 'All People Categories', 'roots' ),
        'parent_item'                => __( 'Parent People Category', 'roots' ),
        'parent_item_colon'          => __( 'Parent People Category:', 'roots' ),
        'new_item_name'              => __( 'New People Category', 'roots' ),
        'add_new_item'               => __( 'Add New People Category', 'roots' ),
        'edit_item'                  => __( 'Edit Category', 'roots' ),
        'update_item'                => __( 'Update Category', 'roots' ),
        'separate_items_with_commas' => __( 'Separate categories with commas', 'roots' ),
        'search_items'               => __( 'Search Categories', 'roots' ),
        'add_or_remove_items'        => __( 'Add or remove categories', 'roots' ),
        'choose_from_most_used'      => __( 'Choose from the most used items', 'roots' ),
        'not_found'                  => __( 'Not Found', 'roots' ),
    );
    $rewrite = array(
        'slug'                       => 'people-categories',
        'with_front'                 => true,
        'hierarchical'               => true,
    );
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => $rewrite
    );
    register_taxonomy( 'people_categories', array( 'people' ), $args );

}


/**
 * Register our sidebars and widgetized areas.
 *
 */

function copyright_widget_init() {

    register_sidebar( array(
        'name' => 'Copyright Widget',
        'id' => 'copyright_widget',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="hide">',
        'after_title' => '</h2>',
    ) );
}
add_action( 'widgets_init', 'copyright_widget_init' );


function social_widget_init() {

    register_sidebar( array(
        'name' => 'Social Widget',
        'id' => 'social_widget',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="hide">',
        'after_title' => '</h2>',
    ) );
}
add_action( 'widgets_init', 'social_widget_init' );


function footer_widget_init() {

	register_sidebar( array(
		'name' => 'Footer Widget',
        'id' => 'footer-widget',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );
}
add_action( 'widgets_init', 'footer_widget_init' );

function disclaimer_widget_init() {

	register_sidebar( array(
		'name' => 'Disclaimer Widget',
		'id' => 'disclaimer_widget',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => '',
	) );
}
add_action( 'widgets_init', 'disclaimer_widget_init' );



// Reduce nav classes, leaving only 'current-menu-item'

function nav_class_filter( $var, $item) {
    $resultArray = is_array($var) ? array_intersect($var, array('current-menu-item', 'menu-item', 'current-page-parent')) : array();
    $resultArray[] = 'nav-'.cleanname($item->title);
    return $resultArray;
}
add_filter('nav_menu_css_class', 'nav_class_filter', 100, 2);

function cleanname($v) {
    $v = preg_replace('/[^a-zA-Z0-9s]/', '', $v);
    $v = str_replace(' ', '-', $v);
    $v = strtolower($v);
    return $v;
}


/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.0
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

require_once dirname( __FILE__ ) . '/includes/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );

function my_theme_register_required_plugins() {

    $plugins = array(

        array(
            'name'      => 'Simple 301 Redirects',
            'slug'      => 'simple-301-redirects',
            'required'  => true,
        ),

        array(
            'name'      => 'Page Links To',
            'slug'      => 'page-links-to',
            'required'  => true,
        ),

        array(
            'name'      => 'Simple Custom Post Order',
            'slug'      => 'simple-custom-post-order',
            'required'  => true,
        ),

        array(
            'name'      => "IT's Tracking Code",
            'slug'      => 'its-tracking-code',
            'required'  => false,
        ),

        array(
            'name'      => 'All-in-One WP Migration',
            'slug'      => 'all-in-one-wp-migration',
            'required'  => false,
        ),

        array(
            'name'      => 'The SEO Framework',
            'slug'      => 'autodescription',
            'required'  => false,
        ),

        array(
            'name'      => 'Autoptimize',
            'slug'      => 'autoptimize',
            'required'  => false,
        ),


    );

    /*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
    $config = array(
        'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.

    );

    tgmpa( $plugins, $config );
}

class acme_menu_Walker extends Walker_Nav_Menu {


    function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) {
        $object = $item->object;
        $type = $item->type;
        $title = $item->title;
        $permalink = $item->url;
        $output .= "<li class='nav-category js-nav-animate'>";

        //Add SPAN if no Permalink
        if( $permalink && $permalink != '#' ) {
            $output .= '<a href="' . $permalink . '" class="nav-link">';
        } else {
            $output .= '<span>';
        }

        $output .= $title;

        if( $permalink && $permalink != '#' ) {
            $output .= '</a>';
        } else {
            $output .= '</span>';
        }
    }
}

