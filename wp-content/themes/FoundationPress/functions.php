<?php
/**
 * Author: Ole Fredrik Lie
 * URL: http://olefredrik.com
 *
 * FoundationPress functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

/** Various clean up functions */
require_once( 'library/cleanup.php' );

/** Required for Foundation to work properly */
require_once( 'library/foundation.php' );

/** Format comments */
require_once( 'library/class-foundationpress-comments.php' );

/** Register all navigation menus */
require_once( 'library/navigation.php' );

/** Add menu walkers for top-bar and off-canvas */
require_once( 'library/class-foundationpress-top-bar-walker.php' );
require_once( 'library/class-foundationpress-mobile-walker.php' );

/** Create widget areas in sidebar and footer */
require_once( 'library/widget-areas.php' );

/** Return entry meta information for posts */
require_once( 'library/entry-meta.php' );

/** Enqueue scripts */
require_once( 'library/enqueue-scripts.php' );

/** Add theme support */
require_once( 'library/theme-support.php' );

/** Add Nav Options to Customer */
require_once( 'library/custom-nav.php' );

/** Change WP's sticky post class */
require_once( 'library/sticky-posts.php' );

/** Configure responsive image sizes */
require_once( 'library/responsive-images.php' );

/** Gutenberg editor support */
require_once( 'library/gutenberg.php' );

/** If your site requires protocol relative url's for theme assets, uncomment the line below */
// require_once( 'library/class-foundationpress-protocol-relative-theme-assets.php' );

// Custom code for functions/.php

// Section post type 
function create_posttype() {
//  About
    register_post_type( 'about',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'About' ),
				'singular_name' => __( 'About' ),
			),
			'supports' => array( 'title', 'editor','thumbnail' ),
            'public' => true,
            'has_archive' => true,
			'rewrite' => array('slug' => 'About sections'),
			
			
        )
        
		
    );
    // Front
    register_post_type( 'front',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Front' ),
				'singular_name' => __( 'Front' ),
			),
			'supports' => array( 'title', 'editor','thumbnail' ),
            'public' => true,
            'has_archive' => true,
			'rewrite' => array('slug' => 'Front sections'),
			
			
        )
        
		
    );
     // Front
     register_post_type( 'faq',
     // CPT Options
         array(
             'labels' => array(
                 'name' => __( 'Faq' ),
                 'singular_name' => __( 'Faq' ),
             ),
             'public' => true,
             'has_archive' => true,
             'rewrite' => array('slug' => 'Front sections'),
             
             
         )
         
         
     );
   
}

// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );
//  theme support for woocommerce
function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

// removing single-product tabs
/**
 * Remove product data tabs
 */
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {

    unset( $tabs['description'] );      	// Remove the description tab
    unset( $tabs['reviews'] ); 			// Remove the reviews tab
    unset( $tabs['additional_information'] );  	// Remove the additional information tab

    return $tabs;
}

// removes thumbnail from single product
function remove_gallery_and_product_images() {
    if ( is_product() ) {
        remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
        }
    }
    add_action('loop_start', 'remove_gallery_and_product_images');

    /**
 * Remove related products output
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

