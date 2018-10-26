<?php
/**
 * Author Hemingway Child Theme
 *
 * A child theme for the Hemingway theme by Anders Noren
 *
 * Thanks to the following docs and tutorials:
 * - https://developer.wordpress.org/themes/advanced-topics/child-themes/#3-enqueue-stylesheet
 * - https://www.smashingmagazine.com/2016/01/create-customize-wordpress-child-theme/
 *
 * @package author-hemingway-child-theme
 */

/**
 * Enqueue parent theme stylesheet, and stylesheet for this child theme.
 */
function my_theme_enqueue_styles() {

	$parent_style = 'parent-style'; // This is the 'hemingway' theme.

	wp_enqueue_style( $parent_style,
		get_template_directory_uri() . '/style.css',
		null,
		wp_get_theme()->get( 'Version' )
	);
	wp_enqueue_style( 'child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( $parent_style ),
		wp_get_theme()->get( 'Version' )
	);
}

/**
 * Removes width and height attributes from image tags
 * From: https://wpscholar.com/blog/remove-image-size-attributes-wordpress-responsive/
 *
 * @param string $html the html of the image element.
 *
 * @return string
 */
function remove_image_size_attributes( $html ) {
	return preg_replace( '/(width|height)="\d*"/', '', $html );
}

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

// Add support for 'excerpts' in Pages as well as Posts. This will be used so that pages have one-line descriptions.
add_post_type_support( 'page', 'excerpt' );

// Enable thumbnails.
add_theme_support( 'post-thumbnails' );

// Additional image sizes.
// Delete the next line if you do not need additional image sizes.
add_image_size( 'category-thumb', 450, 9999 ); // 300 pixels wide (and unlimited height)

// Remove image size attributes from post thumbnails.
add_filter( 'post_thumbnail_html', 'remove_image_size_attributes' );

// Remove image size attributes from images added to a WordPress post.
add_filter( 'image_send_to_editor', 'remove_image_size_attributes' );
