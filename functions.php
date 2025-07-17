<?php
/**
 * Gosforth Harriers & Athletics Club functions and definitions
 * 
 * @package GHAC
 * @since GHAC 0.1
 * 
 */

// Theme Setup
if ( ! function_exists( 'ghac_setup' ) ) :
  function ghac_setup() {
    // Add default posts and comments RSS feed links to <head>
    add_theme_support( 'automatic-feed-links' );

    // Add title tag to the header
    add_theme_support( 'title-tag' );

    // Enable support for menus
    add_theme_support( 'menus' );

    // Enable support for post thumbnais and featured images
    add_theme_support( 'post-thumbnails' );

    // Enable support for WooCommerce
    add_theme_support( 'woocommerce' );

    // Add support for custom navigation menus.
    register_nav_menus(
      array (
        'unauth-menu' => __('Unauthenticated Menu', 'ghac'),
        'auth-menu' => __('Authenticated Menu', 'ghac'),
        'useful-links' => __('Useful Links', 'ghac'),
        'about-section' => __('About Section', 'ghac')
      )
    );
  }
endif;
add_action( 'after_setup_theme', 'ghac_setup' );

// Add the stylesheets
if ( ! function_exists( 'ghac_load_stylesheets' ) ) :
  function ghac_load_stylesheets() {
    wp_enqueue_style( 'styles', get_template_directory_uri() . '/assets/css/styles.min.css', '', '0.1.14', 'all' );
  }
endif;
add_action( 'wp_enqueue_scripts', 'ghac_load_stylesheets' );

// Add the javascript
if ( ! function_exists( 'ghac_load_javascript' ) ) :
  function ghac_load_javascript() {
    wp_enqueue_script( 'scripts', get_template_directory_uri() . '/assets/js/guess-the-name-of-the-bunny.js', '', '0.1.0', 'all' );
  }
endif;
add_action( 'wp_enqueue_scripts', 'ghac_load_javascript' );

// Add the sidebars
if ( ! function_exists( 'ghac_register_widgets' ) ) :
  function ghac_register_widgets() {
    register_sidebar(
      array(
          'name' => 'Posts Widget',
          'id' => 'posts-widget',
          'class' => '',
          'before_widget' => '',
          'after_widget' => '',
          'before_title' => '<h4>',
          'after_title' => '</h4>'
      )
    );
    
    register_sidebar(
      array(
          'name' => 'Club Records Widget',
          'id' => 'club-records-widget',
          'class' => '',
          'before_widget' => '',
          'after_widget' => '',
          'before_title' => '<h4>',
          'after_title' => '</h4>'
      )
    );

  }
endif;
add_action( 'widgets_init', 'ghac_register_widgets' );

// Session used for Club Relays registration
if ( ! function_exists( 'ghac_session' ) ) :
  function ghac_session() {
    if ( ! session_id() ) :
      session_start();
    endif;

    if ( empty( $_SESSION['ip_address'] ) ) :
      $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];
    endif;

    if ( empty( $_SESSION['user_agent'] ) ) :
      $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
    endif;

    if ($_SESSION['ip_address'] !== $_SERVER['REMOTE_ADDR'] || $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']) :
      // Invalidate session
      session_destroy();
    endif;

    // Do not allow to be set on live!
    //$_SESSION['relays_user_email'] = "nick@gtctek.co.uk";
  }
endif;
add_action('init', 'ghac_session');

// Form Inputs
if ( ! function_exists( 'form_input_checks' ) ) :
  function form_input_checks($data, $trim = true, $slashes = true, $specialchars = true) {
    if ($trim == true) $data = trim($data);
    if ($slashes == true) $data = stripslashes($data);
    if ($specialchars == true) $data = htmlspecialchars($data);
    return $data;
  }
endif;

if ( ! function_exists( 'get_pageid_by_pageslug' ) ):
  function get_pageid_by_pageslug( $page_slug ) {
    $page = get_page_by_path( $page_slug );

    return ( ! empty( $page ) ? $page->ID : null );
  } 
endif;

if ( ! function_exists( 'get_page_permalink_by_pageslug' ) ):
  function get_page_permalink_by_pageslug( $page_slug ) {
    $pageID = get_pageid_by_pageslug( $page_slug );

    return ( ! empty( $pageID ) ? get_permalink( $pageID ) : null );
  }
endif;

include get_template_directory() . "/functions/guess-the-name-of-the-bunny.php";
include get_template_directory() . "/functions/navigation.php";
include get_template_directory() . "/functions/posts.php";
include get_template_directory() . "/functions/users.php";
include get_template_directory() . "/functions/woocommerce.php";