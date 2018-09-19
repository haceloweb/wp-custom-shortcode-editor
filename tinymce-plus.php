<?php 
/**
 * Plugin Name: TinyMCE Plus
 * Version: 1.0
 * Author: Diego Alfaro - Namu
 * Description: A simple TinyMCE Plugin to add a custom button in the Visual Editor
 * License: GPL2
 */
define( 'WP_DEBUG', true );

define( 'TINYMCE_PLUS_PATH', plugin_dir_path( __FILE__ ) );
define( 'TINYMCE_PLUS_URL', plugin_dir_url( __FILE__ ) );

include TINYMCE_PLUS_PATH . "classes/Shortcode_Plus.php";
include TINYMCE_PLUS_PATH . "classes/TinyMCE_Plus.php";

$tinymce_custom_link_class = new TinyMCE_Plus;
$shortcode_class = new Shortcode_Plus;