<?php


function meta_box_join_partenaires()
{
  //add_meta_box('ispartenaire', __('Actualité sur un partenaitre ?', 'textdomain'), 'box_join_partenaires', 'post', 'side', 'high');
  add_meta_box(
	'description', // Metabox ID
	__('Origine du post', 'technum-theme'), // Title to display
	'box_join_partenaires', // Function to call that contains the metabox content
	'post', // Post type to display metabox on
	'side', // Where to put it (normal = main colum, side = sidebar, etc.)
	'high' // Priority relative to other metaboxes
  );

}

//Ajout d'une meta box pour le sticky post
add_action( 'add_meta_boxes', 'meta_box_join_partenaires' );

function box_join_partenaires($post, $metabox) {  
// Use nonce for verification
    wp_nonce_field( basename( __FILE__ ), 'ispartenaire_nonce' );
    $entered = get_post_meta($post->ID, 'ispartenaire', true);
    ?>
    <label><input id="ispartenaire" name="ispartenaire" type="checkbox"<?php if($entered=="on")echo' checked="checked"';?> ><?php echo __('Actualité sur un partenaitre ?', 'textdomain'); ?></label>
    <?php

    wp_nonce_field(basename( __FILE__ ), 'partenaire_id_nonce' );
    $partenaireId = get_post_meta( $post->ID, 'partenaire_id', true ); // Get the saved values

    ?>

    <div id="partenaire-choice">
        <label for="partenaire_id">
            <?php _e( 'Partenaire', 'technum-theme' );?>
        </label><br/>
        <select name="partenaire_id" id="partenaire_id" style="width: 80%;">
            <option > </option>
            <?php
            
            $args = array(  
                'post_type' => 'partenaires',
                'orderby' => 'title', 
                //'post_parent' => 0,       
                'order' => 'ASC',
            );

            $posts = get_posts( $args );
                
                if ( !empty( $posts ) ) {
                    foreach($posts as $post){ 
            ?>        
                        <option value="<?php echo esc_attr($post->ID); ?>" <?php  if($partenaireId == $post->ID){ echo 'selected="selected"';} ?>><?php echo get_the_title($post->ID); ?></option>
            <?php
                    }
                }
                wp_reset_postdata();   
            ?>
        </select>

    </div>
        
    <?php

}


function partenaire_id_save( $post_id , $post) {
	
	if ($post->post_type != 'post'){
		return;
	}
  // Verify the nonce before proceeding.
    if ( !isset( $_POST['partenaire_id_nonce'] ) || !wp_verify_nonce( $_POST['partenaire_id_nonce'], basename( __FILE__ ) ) )
        return $post_id;

    if ( !isset( $_POST['ispartenaire_nonce'] ) || !wp_verify_nonce( $_POST['ispartenaire_nonce'], basename( __FILE__ ) ) )
        return $post_id;

        

    // Get the post type object.
    $post_type = get_post_type_object( $post->post_type );

    // Check if the current user has permission to edit the post.
    if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
        return $post_id;

    $champs = array('ispartenaire', 'partenaire_id');

    foreach($champs as $value){

        // Get the posted data and sanitize it for use as an HTML class.
        $new_meta_value = ( isset( $_POST[$value] ) ? wp_filter_post_kses( $_POST[$value] ) : '' );

        
        // Get the meta key.
        $meta_key = $value;

        // Get the meta value of the custom field key.
        $meta_value = get_post_meta( $post_id, $meta_key, true );

        // If a new meta value was added and there was no previous value, add it.
        if ( $new_meta_value && '' == $meta_value )
            add_post_meta( $post_id, $meta_key, $new_meta_value, true );

        // If the new meta value does not match the old value, update it.
        elseif ( $new_meta_value && $new_meta_value != $meta_value )
            update_post_meta( $post_id, $meta_key, $new_meta_value );

        // If there is no new meta value but an old value exists, delete it.
        elseif ( '' == $new_meta_value && $meta_value )
            delete_post_meta( $post_id, $meta_key, $meta_value );

    }
  

  // save the new value of the dropdown
  //$new_value = $_POST['pseudosticky'];
  //update_post_meta( $post_id, 'pseudosticky', $new_value );
}


add_action('save_post', 'partenaire_id_save', 10, 2);

?>