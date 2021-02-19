<?php
/**
 * Urban Rights functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Urban_Rights
 */

if ( ! function_exists( 'urbanrights_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function urbanrights_setup() {

	// theme global vars
	if (!defined('URBANRIGHTS_BLOGNAME'))
	    define('URBANRIGHTS_BLOGNAME', get_bloginfo('name'));

	if (!defined('URBANRIGHTS_BLOGDESC'))
	    define('URBANRIGHTS_BLOGDESC', get_bloginfo('description','display'));

	if (!defined('URBANRIGHTS_BLOGURL'))
	    define('URBANRIGHTS_BLOGURL', esc_url( home_url( '/' ) ));

	if (!defined('URBANRIGHTS_BLOGTHEME'))
	    define('URBANRIGHTS_BLOGTHEME', get_bloginfo('template_directory'));
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Urban Rights, use a find and replace
	 * to change 'urbanrights' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'urbanrights', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'urbanrights' ),
		'secondary' => esc_html__( 'Secondary', 'urbanrights' ),
		'lang' => esc_html__( 'Languages', 'urbanrights' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'urbanrights_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	add_post_type_support( 'page', 'excerpt' );

	//Image sizes
	urbanrights_image_sizes();
	add_filter( 'image_size_names_choose', 'urbanrights_image_sizes_names' );
}
endif;
add_action( 'after_setup_theme', 'urbanrights_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function urbanrights_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'urbanrights_content_width', 640 );
}
add_action( 'after_setup_theme', 'urbanrights_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function urbanrights_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'urbanrights' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer area', 'urbanrights' ),
		'id'            => 'footer-widgets',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="navbar-text">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="f-widget-tit">',
		'after_title'   => '</div>',
	) );
}
add_action( 'widgets_init', 'urbanrights_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function urbanrights_scripts() {

	if ( !is_admin() ) {
		wp_dequeue_script('jquery');
		wp_dequeue_script('jquery-migrate');
		wp_enqueue_script('jquery', false, array(), NULL, true);
//		wp_enqueue_script('jquery-migrate', false, array(), NULL, true);
		
		wp_dequeue_style('wp-block-library');
		wp_dequeue_style('newsletter');

	}
	wp_dequeue_script('eio-lazy-load');
	wp_enqueue_script('eio-lazy-load',false,array(),NULL,true);

	wp_enqueue_script( 'bootstrap', get_template_directory_uri(). '/bootstrap/js/bootstrap.min.js',array(),true );
//	if ( is_post_type_archive( 'declarations' ) || is_home() || is_page_template('page-declarations.php') || is_tax(array('protect','eradicate','initiate')) )
//		wp_enqueue_script( 'ur-declarations-js', get_template_directory_uri() . '/js/ur-declarations.js', array('jquery'), true );
//	if ( is_page_template( 'page-map.php' ) )
//		wp_enqueue_script( 'ur-spaces-js', get_template_directory_uri() . '/js/ur-spaces.js', array('jquery'), true );
//	wp_enqueue_script( 'urbanrights-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

//	wp_enqueue_script( 'urbanrights-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'urbanrights_scripts',999 );

// load scripts for IE compatibility
function urbanrights_extra_meta_tags() {
	echo "
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	";
}
/* Load scripts for IE compatibility */
add_action('wp_head','urbanrights_extra_meta_tags');

// load scripts for IE compatibility
function urbanrights_extra_scripts_styles() {
	wp_enqueue_style('wp-block-library');
	wp_enqueue_style('newsletter');
	wp_enqueue_style( 'bootstrap', get_template_directory_uri(). '/bootstrap/css/bootstrap.min.css' );
	wp_enqueue_style( 'urbanrights', get_stylesheet_uri(),array('bootstrap') );
	echo "
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src='https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js'></script>
	<script src='https://oss.maxcdn.com/respond/1.4.2/respond.min.js'></script>
	<![endif]-->
	";
	if ( is_user_logged_in() && current_user_can( 'manage_options' ) ) {
		echo "<style media='screen' type='text/css'>#top-navbar{margin-top: 32px !important; } html { margin-top: 93px!important !important; }</style>";
	} else {
		echo "<style media='screen' type='text/css'>html { margin-top: 65px !important; }</style>";

	}
}
add_action('wp_footer','urbanrights_extra_scripts_styles');

function urbanrights_favicon() {
	echo "
	<link rel='shortcut icon' href='".URBANRIGHTS_BLOGTHEME."/images/favicon.png' />
	";
	return;
}
add_action('wp_head','urbanrights_favicon');

// custom loops for each template
function urbanrights_custom_args_for_loops( $query ) {
	if ( is_post_type_archive('declarations') && $query->is_main_query() ) { 
		$query->set( 'nopaging','true');
		$query->set( 'order','ASC');
		$query->set( 'orderby','menu_order');
	}
	elseif ( is_post_type_archive('sessions') && $query->is_main_query() ) { 
		$query->set( 'nopaging','true');
//		$query->set( 'orderby','meta_value_num');
//		$query->set( 'meta_key','session-date');
//		$query->set( 'order','ASC');
	}
	return $query;
} // END custom args for loops
add_filter( 'pre_get_posts', 'urbanrights_custom_args_for_loops' );

function urbanrights_container_class() {
	$class = "class='container'";
	if ( is_page_template('page-map.php') )
		$class = "class='container-fluid'";
	echo $class;
	return;
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';


/**
 * Set up image sizes and media options
 */
function urbanrights_image_sizes() {

	// add extra sizes
	add_image_size( 'icon', 0, 48, false );
	add_image_size( 'bigicon', 0, 96, false );
	add_image_size( 'mini', 263, 0, false );
	add_image_size( 'xsmall', 446, 0, false );
	add_image_size( 'small', 610, 0, false );
	add_image_size( 'xlarge', 1500, 0, false );

	/* set up image sizes*/
	update_option('post-thumbnail_size_w', 1920);
	update_option('thumbnail_size_w', 128);
	update_option('thumbnail_size_h', 0);
	update_option('medium_size_w', 860);
	update_option('medium_size_h', 0);
	update_option('large_size_w', 1151);
	update_option('large_size_h', 0);
}

function urbanrights_image_sizes_names( $sizes ) {
	return array_merge( $sizes, array(
		'icon' => __('Icon 48px','urbanrights'),
		'bigicon' => __('Icon 96px','urbanrights'),
		'mini' => __('Mini 263px width','urbanrights'),
		'xsmall' => __('Extra small 446px width','urbanrights'),
		'small' => __('Small 610px width','urbanrights'),
		'xlarge' => __('Extra large 1500px width','urbanrights'),
	) );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
//require get_template_directory() . '/inc/jetpack.php';

/**
 * Load WordPress core functions redefinitions or modifications.
 */
require get_template_directory() . '/inc/wordpress-redefinitions.php';
