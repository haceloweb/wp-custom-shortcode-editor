<?php 
/**
 * Class Name: Shortcode_Plus
 * Author: Diego Alfaro - Namu
 */
class Shortcode_Plus {

    private $post_type;
         
    function __construct() {

        $this->post_type = "shortcode";

        if ( is_admin() ) {
            //creates post type for shortcodes
            add_action( 'init', array(  $this, 'create_shortcode_posttype' ) );
            //creates the editor metaboxes for shortcode
            add_action( 'add_meta_boxes_shortcode', array(  $this, 'shortcode_add_meta_boxes' ) );
            //handles the save data for shortcode
            add_action( 'save_post', array(  $this, 'save_shortcode_meta' ) );
            //adds admin js for shortcode editor only
            add_action( 'admin_print_scripts-post-new.php', array(  $this, 'shortcode_admin_script' ), 11 );
            add_action( 'admin_print_scripts-post.php', array(  $this, 'shortcode_admin_script' ), 11 );
		}

    }

    public static function list_shortcodes(){

        $shortcodes = array();
        $args = array(
            'post_type' => "shortcode",
            'nopaging ' => true
        );
        $shortcode_loop = new WP_Query($args);

        while( $shortcode_loop->have_posts() ){
            $shortcode_loop->the_post();
            $shortcode_ID = get_the_ID();
            array_push($shortcodes, array(
                "slug" => get_post_meta( $shortcode_ID, 'shortcode_slug', true),
                "text" => get_post_meta( $shortcode_ID, 'shortcode_btn_text', true),
                "tooltip" => get_post_meta( $shortcode_ID, 'shortcode_btn_tooltip', true),
                "close" => get_post_meta( $shortcode_ID, 'shortcode_close_tag', true),
                "params" => get_post_meta( $shortcode_ID, 'shortcode_params', true),
            ));
        }

        return $shortcodes;
    } 

    function create_shortcode_posttype() {
    
        register_post_type( $this->post_type,
            array(
                'labels' => array(
                    'name' => __( 'Shortcodes' ),
                    'singular_name' => __( 'Shortcode' )
                ),
                'public' => false,  // it's not public, it shouldn't have it's own permalink, and so on
                'publicly_queryable' => true,  // you should be able to query it
                'show_ui' => true,  // you should be able to edit it in wp-admin
                'exclude_from_search' => true,  // you should exclude it from search results
                'show_in_nav_menus' => false,  // you shouldn't be able to add it to menus
                'has_archive' => false,  // it shouldn't have archive page
                'rewrite' => false,  // it shouldn't have rewrite rules
                'supports' => array( 'title' ),
            )
        );
    }

    function shortcode_add_meta_boxes( $post ){

        add_meta_box( 'shortcode_meta_box', __( 'Shortcode Information', 'custom_shortcode_editor' ), array(  $this, 'shortcode_build_meta_box' ), $this->post_type, 'normal' );
        add_meta_box( 'shortcode_params_meta_box', __( 'Shortcode Parameters', 'custom_shortcode_params_editor' ), array(  $this, 'shortcode_params_build_meta_box' ), $this->post_type, 'normal' );
    }

    function shortcode_build_meta_box(){

        global $post;  
        $shortcode_slug = get_post_meta( $post->ID, 'shortcode_slug', true);
        $shortcode_btn_text = get_post_meta( $post->ID, 'shortcode_btn_text', true);
        $shortcode_btn_tooltip = get_post_meta( $post->ID, 'shortcode_btn_tooltip', true);
        $shortcode_close_tag = get_post_meta( $post->ID, 'shortcode_close_tag', true);
        
        include( TINYMCE_PLUS_PATH . '/templates/shortcode_data_edit.php' );
    }

    function shortcode_params_build_meta_box(){

        global $post;
        $shortcode_params = get_post_meta( $post->ID, 'shortcode_params', true);

        include( TINYMCE_PLUS_PATH . '/templates/shortcode_params_edit.php' );
    }

    
    function save_shortcode_meta( $post_id ) {

        $post_type = get_post_type($post_id);

        if ( $this->post_type != $post_type ) return;		
            
        //Shortcode Config Fields
        $this->update_meta_field($post_id, 'shortcode_slug');
        $this->update_meta_field($post_id, 'shortcode_btn_text');
        $this->update_meta_field($post_id, 'shortcode_btn_tooltip');
        $this->update_meta_field($post_id, 'shortcode_close_tag');

        //Shortcode Parameters Fields
        $this->update_meta_field($post_id, 'shortcode_params');
    }
    

    private function update_meta_field($post_id, $field) {

        $old = get_post_meta( $post_id, $field, true );
        $new = $_POST[$field];

        if ( $new && $new !== $old ) {
            update_post_meta( $post_id, $field, $new );
        } elseif ( '' === $new && $old ) {
            delete_post_meta( $post_id, $field, $old );
        }
    }

    function shortcode_admin_script() {
        global $post; 
        global $post_type;
        if ( $post_type == $this->post_type ){
            global $post;
            wp_register_script( 'shortcode-admin-script', TINYMCE_PLUS_URL . '/js/admin/shortcode_edit.js' , '', '', true );
            wp_enqueue_script( 'shortcode-admin-script');
        }
    }
}