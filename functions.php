<?php // Theme Functions

// Required Files
require_once get_template_directory() . '/_inc/classes/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/_inc/partials/header_markup.php';
require_once get_template_directory() . '/_inc/partials/footer_markup.php';
// require get_template_directory() . '/_inc/classes/class-o-customize.php';
// require get_template_directory() . '/_inc/helpers/custom-css.php';


// Register Required Plugins
add_action( 'tgmpa_register', function () {
	tgmpa([
		[
			'name'      => 'Elementor Page Builder',
			'slug'      => 'elementor',
			'required'  => true
		],
		[
			'name'      => 'Elementor – Header, Footer & Blocks Template',
			'slug'      => 'header-footer-elementor',
			'required'  => true
		]
	],[
		'id'           => 'o',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'parent_slug'  => 'themes.php',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => false,
		'is_automatic' => false,
		'message'      => ''
	]);
});


// Theme Support
add_action( 'after_setup_theme', function() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'header-footer-elementor' );

	add_theme_support( 'post-thumbnails' );
	// set_post_thumbnail_size( 1200, 9999 );
	// add_image_size( 'o_fullscreen', 1980, 9999 );

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		)
	);
});


// Enqueue Styles and Scripts
add_action( 'wp_enqueue_scripts', function () {
	$theme_version = wp_get_theme()->get( 'Version' );

	// Styles
	wp_enqueue_style( 'o-style', get_stylesheet_uri(), array(), $theme_version );
	// wp_add_inline_style( 'o-style', o_get_customizer_css( 'front-end' ) );

	// Scripts
	if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	wp_enqueue_script( 'o-script', get_template_directory_uri() . '/_inc/assets/js/script.js', array(), $theme_version, true );
	// wp_script_add_data( 'o-script', 'async', true );
});


// Navigation Menus
add_action( 'init', function () {
	register_nav_menus([
		'header' => __('Header Menu', 'o'),
		'footer' => __('Footer Menu', 'o')
	]);
});


// Sidebar and Footer Widgets
add_action( 'widgets_init', function () {
	$shared_args = [
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>'
	];

	// Blog Sidebar
	register_sidebar( array_merge( $shared_args, [
		'name' => __( 'Blog Sidebar', 'o' ),
		'id' => 'blog-sidebar'
	]));

	// Footer Widgets
	register_sidebar( array_merge( $shared_args, [
		'name' => __( 'Footer Widgets', 'o' ),
		'id' => 'footer-widgets'
	]));
});


// Helper Functions

// Shim for wp_body_open, ensuring backward compatibility with versions of WordPress older than 5.2.
if ( ! function_exists( 'wp_body_open' ) ) {
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

//function built_with_elementor($id) {
//	return class_exists('Elementor\Plugin') && \Elementor\Plugin::$instance->db->is_built_with_elementor($id);
//}