<?php

/* require core classes */
//require_once( get_stylesheet_directory() . '/core/shogun.php' );
require_once(__DIR__ . '/vendor/autoload.php');

use Shogun\Shogun;

function Shogun( $instance = null ) {
    static $instance;

    if ( $instance === null ) {
        $instance = new Shogun;
    }

    return $instance;
}

/**
 * register styles and scripts
 */ 
add_action( 'wp_enqueue_scripts', 'shogun_enqueue_scripts', 20 );
add_action( 'wp_enqueue_scripts', 'shogun_enqueue_styles' );

function shogun_enqueue_scripts()
{
    wp_enqueue_script( 
        'shogun-js', 
        get_stylesheet_directory_uri() . '/dist/bundle.js', 
        [], 
        wp_get_theme()->get( 'Version' ), 
        true 
    );

}

function shogun_enqueue_styles()
{
    wp_enqueue_style( 
        'shogun-css', 
        get_stylesheet_directory_uri() . '/dist/theme.min.css', 
        [], wp_get_theme()->get( 'Version' ) 
    );
}

/*
 * Show the WP Admin Panels if SHOW_ADMIN_BAR is true
 */
if ( Shogun()->Config()->get( 'SHOW_ADMIN_BAR' ) !== true ) {
    add_action( 'after_setup_theme', 'remove_admin_bar' );

    function remove_admin_bar() {
        show_admin_bar( false );
    }
}
?>