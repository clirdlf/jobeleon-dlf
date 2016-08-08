<?php


  
function call_Jobeleon_Map_Page_Meta() {
    new Jobeleon_Map_Page_Meta();
}

if ( is_admin() ) {
    add_action( 'load-post.php', 'call_Jobeleon_Map_Page_Meta' );
    add_action( 'load-post-new.php', 'call_Jobeleon_Map_Page_Meta' );
}

/** 
 * The Class.
 */
class Jobeleon_Map_Page_Meta {

	/**
	 * Hook into the appropriate actions when the class is constructed.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
	}

	/**
	 * Adds the meta box container.
	 */
	public function add_meta_box( $post_type ) {

            if($post_type != 'page') {
                return;
            }
            
            if(isset($_GET['post']) && is_numeric($_GET['post'])) {
                $post_id = $_GET['post'];
            } elseif(isset($_POST['post_ID']) && is_numeric($_POST['post_ID'])) {
                $post_id = $_POST['post_ID'];
            } else {
                return;
            }
            
            if(get_post_meta($post_id,'_wp_page_template',TRUE) != "home-map.php") {
                return;
            }
            
            add_meta_box(
                    'some_meta_box_name'
                    ,__( 'Map Options', 'jobeleon' )
                    ,array( $this, 'render_meta_box_content' )
                    ,$post_type
                    ,'advanced'
                    ,'high'
            );
            
	}

	/**
	 * Save the meta when the post is saved.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	public function save( $post_id ) {
	
            if(get_post_meta($post_id,'_wp_page_template',TRUE) != "home-map.php") {
                return $post_id;
            }

            // Check if our nonce is set.
            if ( ! isset( $_POST['jobeleon_home_map_box_nonce'] ) )
                return $post_id;

            $nonce = $_POST['jobeleon_home_map_box_nonce'];

            // Verify that the nonce is valid.
            if ( ! wp_verify_nonce( $nonce, 'jobeleon_home_map_box' ) )
                return $post_id;

            // If this is an autosave, our form has not been submitted,
            //     so we don't want to do anything.
            if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
                return $post_id;

            // Check the user's permissions.
            if ( 'page' == $_POST['post_type'] ) {

                if ( ! current_user_can( 'edit_page', $post_id ) ) {
                    return $post_id;
                }

            } else {

                if ( ! current_user_can( 'edit_post', $post_id ) ) {
                    return $post_id;
                }
            }

            /* OK, its safe for us to save the data now. */

            // Update the meta field.
            
            $keys = array(
                "map_radius_unit" => $_POST['map_radius_unit'], 
                "map_max_radius" => absint( $_POST['map_max_radius'] ), 
                "map_center" => sanitize_text_field($_POST['map_center']), 
                "map_height" => sanitize_text_field($_POST['map_height']), 
                "map_auto_locate" => absint($_POST['map_auto_locate'])
            );
            
            foreach($keys as $key => $sanitized) {
                if(!isset($_POST[$key]) || empty($_POST[$key])) {
                    delete_post_meta($post_id, "_".$key);
                } else {
                    update_post_meta($post_id, "_".$key, $sanitized);
                }
            }
            
	}


    /**
     * Render Meta Box content.
     *
     * @param WP_Post $post The post object.
     */
    public function render_meta_box_content( $post ) {

        // Add an nonce field so we can check for it later.
        wp_nonce_field( 'jobeleon_home_map_box', 'jobeleon_home_map_box_nonce' );

        $map_radius_unit = get_post_meta($post->ID, "_map_radius_unit", true);
        $map_max_radius = get_post_meta($post->ID, "_map_max_radius", true);
        $map_center = get_post_meta($post->ID, "_map_center", true);
        $map_height = get_post_meta($post->ID, "_map_height", true);
        $map_auto_locate = get_post_meta($post->ID, "_map_auto_locate", true);
        
        ?>

        <style type="text/css">
            .jobeleon-admin-box {
                line-height: 30px;
            }

            .jobeleon-admin-box > label {
                display: inline-block; width: 250px;
            }
        </style>

        <div class="jobeleon-admin-box">
            <label id="map_radius_unit">
                <?php _e("Radius unit of length", "jobeleon") ?>
            </label>
            <select name="map_radius_unit" id="map_radius_unit">
                <option value="km" <?php selected($map_radius_unit, "km") ?>>km</option>
                <option value="mi" <?php selected($map_radius_unit, "mi") ?>>mi</option>
            </select>
        </div>

        <div class="jobeleon-admin-box">
            <label id="map_max_radius">
                <?php _e("Map Max Radius", "jobeleon") ?>
            </label>
            <input type="text" name="map_max_radius" id="map_max_radius" value="<?php esc_attr_e($map_max_radius) ?>" placeholder="200" />
        </div>

        <div class="jobeleon-admin-box">
            <label id="map_center">
                <?php _e("Map Center", "jobeleon") ?>
            </label>
            <input type="text" name="map_center" value="<?php esc_attr_e($map_center) ?>" placeholder="USA" />
        </div>

        <div class="jobeleon-admin-box">
            <label id="map_height">
                <?php _e("Map Height", "jobeleon") ?>
            </label>
            <input type="text" name="map_height" value="<?php esc_attr_e($map_height) ?>" placeholder="550px" />
        </div>

        <div class="jobeleon-admin-box">
            <label id="map_auto_locate">
                <?php _e("Auto Locate", "jobeleon") ?>
            </label>
            <input type="checkbox" name="map_auto_locate" id="map_auto_locate" value="1" <?php checked($map_auto_locate) ?> />
            <span>If possible set map center to current user location.</span>
        </div>



        <?php
        
        // Use get_post_meta to retrieve an existing value from the database.
        //$value = get_post_meta( $post->ID, '_my_meta_value_key', true );



        // Display the form, using the current value.
        /*
        echo '<label for="myplugin_new_field">';
        _e( 'Description for this field', 'myplugin_textdomain' );
        echo '</label> ';
        echo '<input type="text" id="myplugin_new_field" name="myplugin_new_field"';
        echo ' value="' . esc_attr( $value ) . '" size="25" />';
         * 
         */
    }
}