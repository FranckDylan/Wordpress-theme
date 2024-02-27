<?php
function wpc_cpt_aucoeur() {

	/* Au Coeur */
	$labels = array(
		'name'                => _x('Au Coeur', 'Post Type General Name', 'textdomain'),
		'singular_name'       => _x('Au Coeur', 'Post Type Singular Name', 'textdomain'),
		'menu_name'           => __('Au Coeur', 'technum-theme'),
		'name_admin_bar'      => __('Au Coeur', 'technum-theme'),
		'parent_item_colon'   => __('Parent Au Coeur:', 'technum-theme'),
		'all_items'           => __('All Au Coeur', 'technum-theme'),
		'add_new_item'        => __('Add New Au Coeur', 'technum-theme'),
		'add_new'             => __('Add New Au Coeur', 'technum-theme'),
		'new_item'            => __('New Au Coeur', 'technum-theme' ),
		'edit_item'           => __('Edit Au Coeur', 'technum-theme'),
		'update_item'         => __('Update Au Coeur', 'technum-theme'),
		'view_item'           => __('View Au Coeur', 'technum-theme'),
		'search_items'        => __('Search Au Coeur', 'technum-theme'),
		'not_found'           => __('Not found', 'technum-theme'),
		'not_found_in_trash'  => __('Not found in Trash', 'technum-theme'),
	);
	$rewrite = array(
		'slug'                => _x('aucoeur', 'Au Coeur', 'textdomain'),
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => false,
	);
	$args = array(
		'label'               => __('Au Coeur' , 'technum-theme'),
		'description'         => __('Au Coeur', 'technum-theme'),
		'labels'              => $labels,
		'supports'            => array('title', 'editor', 'thumbnail', 'revisions'),
		'taxonomies'          => array('aucoeur_type'),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 6,
		'menu_icon'           => 'dashicons-lightbulb',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'query_var'           => 'aucoeur',
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type('aucoeur', $args);	
}

add_action('init', 'wpc_cpt_aucoeur', 10);

//Ajout dans les résultats de recherche
function wpc_cpt_in_search_aucoeur($query) {
  if (! is_admin() && $query->is_main_query()) {
    if ($query->is_search) {
      $query->set('post_type', array('post', 'aucoeur'));
    }
  }
}

add_action('pre_get_posts','wpc_cpt_in_search_aucoeur');
add_action('save_post', 'description_aucoeur_save', 10, 2);
add_action( 'add_meta_boxes', 'meta_box_aucoeur_add' );

function meta_box_aucoeur_add(){
	add_meta_box(
		'description', // Metabox ID
		__('Brève Description', 'technum-theme'), // Title to display
		'add_aucoeur_description_callback', // Function to call that contains the metabox content
		'aucoeur', // Post type to display metabox on
		'side', // Where to put it (normal = main colum, side = sidebar, etc.)
		'default' // Priority relative to other metaboxes
	  );
}

function add_aucoeur_description_callback($post, $metabox){
	// Use nonce for verification
	
	wp_nonce_field(basename( __FILE__ ), 'aucoeur_description_nonce' );
	$description = get_post_meta( $post->ID, 'description', true ); // Get the saved values
  
	  ?>
  
	  <div>
		  <label for="description">
			  <?php _e( 'Description', 'technum-theme' );?>
		  </label><br/>
		  <textarea name="description" id="description" rows="6" style="width:100%;"><?php echo esc_attr( $description ); ?> </textarea>
	  </div>
		  
	  <?php
}


function description_aucoeur_save( $post_id , $post) {
	
	if ($post->post_type != 'aucoeur'){
		return;
	}
  // Verify the nonce before proceeding.
    if ( !isset( $_POST['aucoeur_description_nonce'] ) || !wp_verify_nonce( $_POST['aucoeur_description_nonce'], basename( __FILE__ ) ) )
        return $post_id;

    // Get the post type object.
    $post_type = get_post_type_object( $post->post_type );

    // Check if the current user has permission to edit the post.
    if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
        return $post_id;

    // Get the posted data and sanitize it for use as an HTML class.
    $new_meta_value = ( isset( $_POST['description'] ) ? wp_filter_post_kses( $_POST['description'] ) : '' );

    // Get the meta key.
    $meta_key = 'description';

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