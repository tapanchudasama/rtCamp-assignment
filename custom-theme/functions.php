<?php
/**
 * DESIGNfly functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package DESIGNfly
 */

if ( ! function_exists( 'designfly_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function designfly_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on DESIGNfly, use a find and replace
		 * to change 'designfly' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'designfly', get_template_directory() . '/languages' );

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
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'designfly' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'designfly_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'designfly_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function designfly_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'designfly_content_width', 640 );
}
add_action( 'after_setup_theme', 'designfly_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function designfly_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'designfly' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'designfly' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '<hr style="margin-bottom: -2px; width: 270px; margin-left: -0px"></h2>',
		)
	);
}
add_action( 'widgets_init', 'designfly_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function designfly_scripts() {
	wp_enqueue_style( 'designfly-style', get_stylesheet_uri(), '', '1' );

	wp_enqueue_script( 'designfly-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'designfly-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'designfly_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
/**
 * Add theme Scripts
 *
 * @return void
 */
function add_theme_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri(), array(), wp_rand( 111, 999 ), 'all' );

	wp_enqueue_style( 'slider', get_template_directory_uri() . '/css/slider.css', array(), '1.1', 'all' );

	wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), 1.1, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );
/**
 * Special Nav classes
 *
 * @param classes $classes Classes.
 * @param item    $item Item.
 *
 * @return classes
 */
function special_nav_class( $classes, $item ) {
	if ( in_array( 'current-menu-item', $classes, true ) ) {
		$classes[] = 'active ';
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'special_nav_class', 10, 2 );
/**
 * New Excerpt
 *
 * @param more $more More.
 *
 * @return string
 */
function new_excerpt_more( $more ) {
	return '';
}
add_filter( 'excerpt_more', 'new_excerpt_more', 21 );

/**
 * The Excerpt More Link
 *
 * @param excerpt $excerpt Excerpt.
 *
 * @return string
 */
function the_excerpt_more_link( $excerpt ) {
	$post    = get_post();
	$excerpt = ' <a class="anchor" href="' . get_permalink( $post->ID ) . '">Read More</a>.';
	return $excerpt;
}
add_filter( 'the_excerpt', 'the_excerpt_more_link', 21 );

/**
 * Autolink Featured Images
 *
 * @param html $html HTML.
 * @param ID   $post_id Post ID.
 * @param ID   $post_image_id Post Image ID.
 *
 * @return string
 */
function wpb_autolink_featured_images( $html, $post_id, $post_image_id ) {
	$html = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '">' . $html . '</a>';
	return $html;
}
add_filter( 'post_thumbnail_html', 'wpb_autolink_featured_images', 10, 3 );

/**
 * Shortcode[book]
 *
 * @param Array $atts Attributes.
 *
 * @return string
 */
function short_code( $atts ) {
	$atts = shortcode_atts(
		array(
			'id'          => '1',
			'author_name' => 'Tapan',
			'category'    => 'Drama',
			'tag'         => 'chetan',
			'publisher'   => 'harper collins',
		),
		$atts,
		'book'
	);

	return " <b>PostID:</b> {$atts['id']}
    <br>
    <b>Author Name</b>: {$atts['author_name']}
    <br>
    <b>Category:</b> {$atts['category']}
    <br>
    <b>Tags:</b> {$atts['tag']}
    <br>
    <b>Publisher:</b> {$atts['publisher']}";
}
add_shortcode( 'book', 'short_code' );
