<?php
/**
 * @package WordPress
 * @subpackage Rally Health Corp Site
 */

add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 320, 300, true ); // Normal post thumbnails
add_image_size('article-list-image', 600, 600, array('center','center')); // article list image
add_image_size('single-post-image', 1280, 720, array('center','center')); // large post thumbnails


/* =Clean up the WordPress head
------------------------------------------------- */

// remove header links
add_action('init', 'tjnz_head_cleanup');
function tjnz_head_cleanup() {
	// remove_action( 'wp_head', 'feed_links_extra', 3 ); // Category Feeds
	// remove_action( 'wp_head', 'feed_links', 2 ); // Post and Comment Feeds
	// remove_action( 'wp_head', 'rsd_link' ); // EditURI link
	// remove_action( 'wp_head', 'wlwmanifest_link' ); // Windows Live Writer
	// remove_action( 'wp_head', 'index_rel_link' ); // index link
	// remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // previous link
	// remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
	// remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // Links for Adjacent Posts
	// remove_action( 'wp_head', 'wp_generator' ); // WP version
	if (!is_admin()) {
		wp_deregister_script('jquery'); // De-Register jQuery
		wp_register_script('jquery', '', '', '', true); // Register as 'empty', because we manually insert our script in header.php
	}
}

// remove WP version from RSS
// add_filter('the_generator', 'tjnz_rss_version');
// function tjnz_rss_version() { return ''; }

// add function to get category ID
function get_category_id($cat_name){
	$term = get_term_by('name', $cat_name, 'category');
	return $term->term_id;
}

// add function to get tag ID
function get_tag_id($tag_name){
	$term = get_term_by('name', $tag_name, 'post_tag');
	return $term->term_id;
}

//Gets post cat slug and looks for single-[cat slug].php and applies it
add_filter('single_template', create_function (
	'$the_template',
	'foreach( (array) get_the_category() as $cat ) {
		if ( file_exists(TEMPLATEPATH . "/single-{$cat->slug}.php") )
		return TEMPLATEPATH . "/single-{$cat->slug}.php"; }
	return $the_template;' )
);


// add function for offset and pagination together
function my_post_limit($limit) {
	global $paged, $myOffset;
	if (empty($paged)) {
			$paged = 1;
	}
	$postperpage = intval(get_option('posts_per_page'));
	$pgstrt = ((intval($paged) -1) * $postperpage) + $myOffset . ', ';
	$limit = 'LIMIT '.$pgstrt.$postperpage;
	return $limit;
} //end function my_post_limit


// add theme support for nav menus
function register_my_menu() {
 register_nav_menus( array(
		'header-menu' => 'Header Menu',
		'about-menu' => 'About Us Menu'
	));
}
add_action( 'init', 'register_my_menu' );


// add theme support for side bars
add_action( 'widgets_init', 'rally_corp_widgets_init' );
function rally_corp_widgets_init() {
	register_sidebar( array(
		'name' => __( 'main sidebar', 'rally-corp' ),
		'id' => 'sidebar-1',
		'description' => __( 'Main sidebar.', 'rally-corp' ),
	) );
	register_sidebar( array(
		'name' => __( 'bottom bar', 'rally-corp' ),
		'id' => 'sidebar-2',
		'description' => __( 'Bottom bar that goes on the end of the page', 'rally-corp' ),
	) );
}

// add theme support for infinite scroll
// add_theme_support( 'infinite-scroll', array(
// 	'type' => 'scroll',
// 	'container' => 'content',
// 	'wrapper' => false,
// 	'posts_per_page' => 12,
// 	'footer' => false,
// ) );

// add filter to remove automatic gallery styles
add_filter( 'use_default_gallery_style', '__return_false' );

// add custom meta box for meta fields
include 'custom_meta_box.php';

// remove styles from ninja forms
remove_filter('ninja_forms_display_css','ninja_forms_display_css', 10, 2 );

// add category class to the body tag

add_filter('body_class','add_category_to_single');
function add_category_to_single($classes) {
	if (is_single() ) {
		global $post;
		foreach((get_the_category($post->ID)) as $category) {
			// add category slug to the $classes array
			$classes[] = $category->category_nicename;
		}
	}
	// return the $classes array
	return $classes;
}


?>
