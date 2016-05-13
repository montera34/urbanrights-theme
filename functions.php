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
}
add_action( 'widgets_init', 'urbanrights_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function urbanrights_scripts() {
	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri(). '/bootstrap/css/bootstrap.min.css' );
	wp_enqueue_style( 'urbanrights-style', get_stylesheet_uri(),array('bootstrap-style') );

	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri(). '/bootstrap/js/bootstrap.min.js',array('jquery'),true );
	if ( is_post_type_archive( 'declarations' ) || is_home() || is_page_template('page-declarations.php') || is_tax(array('protect','eradicate','initiate')) )
		wp_enqueue_script( 'ur-declarations-js', get_template_directory_uri() . '/js/ur-declarations.js', array('jquery'), true );
	if ( is_page_template( 'page-map.php' ) )
		wp_enqueue_script( 'ur-spaces-js', get_template_directory_uri() . '/js/ur-spaces.js', array('jquery'), true );
//	wp_enqueue_script( 'urbanrights-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

//	wp_enqueue_script( 'urbanrights-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'urbanrights_scripts' );

// load scripts for IE compatibility
function urbanrights_extra_scripts_styles() {
	echo "
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src='https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js'></script>
	<script src='https://oss.maxcdn.com/respond/1.4.2/respond.min.js'></script>
	<![endif]-->
	";
	if ( is_user_logged_in() ) {
		echo "<style media='screen' type='text/css'>#top-navbar{margin-top: 32px;} html { margin-top: 113px!important;}</style>";
	} else {
		echo "<style media='screen' type='text/css'>html { margin-top: 81px!important;}</style>";

	}
}
/* Load scripts for IE compatibility */
add_action('wp_head','urbanrights_extra_scripts_styles',999);

function urbanrights_favicon() {
	echo "
	<link rel='shortcut icon' href='".URBANRIGHTS_BLOGTHEME."/images/favicon.png' />
	";
	return;
}
add_action('wp_head','urbanrights_favicon');

// custom loops for each template
function urbanrights_custom_args_for_loops( $query ) {
	if ( $query->query_vars['post_type'] == 'declarations' && $query->is_main_query() ) { 
		$query->set( 'nopaging','true');
		$query->set( 'order','ASC');
		$query->set( 'orderby','menu_order');
	}
	elseif ( $query->query_vars['post_type'] == 'sessions' && $query->is_main_query() ) { 
		$query->set( 'nopaging','true');
		$query->set( 'orderby','meta_value_num');
		$query->set( 'meta_key','session-date');
		$query->set( 'order','ASC');
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
require get_template_directory() . '/inc/jetpack.php';
