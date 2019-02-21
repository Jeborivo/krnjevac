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
     // FAQ
     register_post_type( 'faq',
     // CPT Options
         array(
             'labels' => array(
                 'name' => __( 'Faq' ),
                 'singular_name' => __( 'Faq' ),
             ),
             'public' => true,
             'has_archive' => true,
             'rewrite' => array('slug' => 'Faq'),
             
             
         )
         
         
     );
     register_post_type( 'related_product',
     // CPT Options
         array(
             'labels' => array(
                 'name' => __( 'Related Product' ),
                 'singular_name' => __( 'Related Product' ),
             ),
             'supports' => array( 'title', 'editor' ),
             'public' => true,
             'has_archive' => true,
             'rewrite' => array('slug' => 'Related Product'),
             
             
            ));
            register_post_type( 'popular_products',
            // CPT Options
                array(
                    'labels' => array(
                        'name' => __( 'Popular Product' ),
                        'singular_name' => __( 'Popular Product' ),
                    ),
                    'supports' => array( 'title', 'editor' ),
                    'public' => true,
                    'has_archive' => true,
                    'rewrite' => array('slug' => 'Popular Product'),
                    
                    
                   ));
   
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
// Last seen session




/**
 * Register our widgetized areas.
 *
 */
function arphabet_widgets_init() {

	register_sidebar( array(
		'name'          => 'newsletter',
		'id'            => 'newsletter',
		'before_widget' => '<div class="newsletter">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'arphabet_widgets_init' );

// cart Total label renamed
add_filter('gettext', 'wc_renaming_checkout_total', 20, 3);
function wc_renaming_checkout_total( $translated_text, $untranslated_text, $domain ) {

    if( !is_admin() && is_checkout ) {
        if( $untranslated_text == 'Total' )
            $translated_text = __( 'Ukupno','theme_slug_domain' );
    }
    return $translated_text;
}
// cart Subotal label renamed
add_filter('gettext', 'wc_renaming_checkout_subtotal', 20, 3);
function wc_renaming_checkout_subtotal( $translated_text, $untranslated_text, $domain ) {

    if( !is_admin() && is_checkout ) {
        if( $untranslated_text == 'Subtotal' )
            $translated_text = __( 'Proizvodi','theme_slug_domain' );
    }
    return $translated_text;
}
// cart Shipping label renamed
add_filter( 'woocommerce_shipping_package_name', 'custom_shipping_package_name' );
function custom_shipping_package_name( $name ) {
  return 'Poštarina';
}

// cart Total label renamed
add_filter('gettext', 'wc_renaming_order_recieved_total', 20, 3);
function wc_renaming_order_recieved_total( $translated_text, $untranslated_text, $domain ) {

    if( !is_admin() && order_received ) {
        if( $untranslated_text == 'Total' )
            $translated_text = __( 'Ukupno','theme_slug_domain' );
    }
    return $translated_text;
}