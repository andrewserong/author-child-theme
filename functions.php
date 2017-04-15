<?php

// thanks to the following:
// https://developer.wordpress.org/themes/advanced-topics/child-themes/#3-enqueue-stylesheet
// thanks to: https://www.smashingmagazine.com/2016/01/create-customize-wordpress-child-theme/

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
 
    $parent_style = 'parent-style'; // This is the 'hemingway' theme
 
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}

// Add support for 'excerpts' in Pages as well as Posts. This will be used so that pages have one-line descriptions
add_post_type_support( 'page', 'excerpt' );

// enable thumbnails
add_theme_support( 'post-thumbnails' ); 

// additional image sizes
// delete the next line if you do not need additional image sizes
add_image_size( 'category-thumb', 450, 9999 ); //300 pixels wide (and unlimited height)


// https://wpscholar.com/blog/remove-image-size-attributes-wordpress-responsive/


/**
 * Removes width and height attributes from image tags
 *
 * @param string $html
 *
 * @return string
 */
function remove_image_size_attributes( $html ) {
    return preg_replace( '/(width|height)="\d*"/', '', $html );
}
 
// Remove image size attributes from post thumbnails
add_filter( 'post_thumbnail_html', 'remove_image_size_attributes' );
 
// Remove image size attributes from images added to a WordPress post
add_filter( 'image_send_to_editor', 'remove_image_size_attributes' );