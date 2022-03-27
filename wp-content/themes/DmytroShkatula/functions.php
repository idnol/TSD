<?php

register_nav_menu('menu','menu');

add_action( 'wp_print_styles', 'add_styles' );
if ( ! function_exists( 'add_styles' ) ) {
    function add_styles() {
        if ( is_admin() ) {
            return false;
        }

        wp_enqueue_style( 'slick', get_template_directory_uri() . '/css/slick.css', array(), '12.02.2021');
        wp_enqueue_style( 'main', get_template_directory_uri() . '/style.css', array(), '12.02.2021');
    }
}
add_action( 'wp_footer', 'add_scripts' );
if ( ! function_exists( 'add_scripts' ) ) {
    function add_scripts() {
        if ( is_admin() ) {
            return false;
        }
        wp_enqueue_script( 'first',  'https://code.jquery.com/jquery-1.11.0.min.js', '', '', true );
        wp_enqueue_script( 'second',  'https://code.jquery.com/jquery-migrate-1.2.1.min.js', '', '', true );
        wp_enqueue_script( 'slick',  'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', '', '', true );
        wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', '', '', true );
    }
}

function my_scripts_method() {
    if ( !is_admin() ) {
        wp_deregister_script( 'jquery' );
        wp_register_script( 'jquery', ( '//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js' ),[],'',true );
        wp_enqueue_script( 'jquery' );
    }
}
add_action( 'init', 'my_scripts_method' );

function themename_custom_logo_setup() {
    $defaults = array(
        'height'               => 100,
        'width'                => 400,
        'flex-height'          => true,
        'flex-width'           => true,
        'header-text'          => array( 'site-title', 'site-description' ),
        'unlink-homepage-logo' => true,
    );

    add_theme_support( 'custom-logo', $defaults );
}

add_action( 'after_setup_theme', 'themename_custom_logo_setup' );

add_filter( 'upload_mimes', 'svg_upload_allow' );
function svg_upload_allow( $mimes ) {
    $mimes['svg']  = 'image/svg+xml';

    return $mimes;
}

function custom_post_type() {
    register_post_type('slides',
        array(
            'labels'      => array(
                'name'          => __('Slides', 'textdomain'),
                'singular_name' => __('Slide', 'textdomain'),
            ),
            'supports' => Array('title', 'editor', 'excerpt'),
            'public'      => true,
            'has_archive' => true,
        )
    );
}
add_action('init', 'custom_post_type');

function wpb_widgets_init() {

    register_sidebar( array(
        'name'          => 'Custom footer widget',
        'id'            => 'custom-footer-widget',
        'before_widget' => '<div class="chw-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="chw-title">',
        'after_title'   => '</h2>',
    ) );

}
add_action( 'widgets_init', 'wpb_widgets_init' );

/**
 * Send message
 */

if(is_user_logged_in()){
    add_action( 'wp_ajax_send_message', 'send_message');
} else {
    add_action( 'wp_ajax_nopriv_send_message', 'send_message');
}
function send_message() {
    require_once('ajax/mail.php');
    wp_die();
}