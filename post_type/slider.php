<?php
function wpc_cpt() {

	/* Slider */
	$labels = array(
		'name'                => _x('Sliders', 'Post Type General Name', 'textdomain'),
		'singular_name'       => _x('Slider', 'Post Type Singular Name', 'textdomain'),
		'menu_name'           => __('Sliders', 'technum-theme'),
		'name_admin_bar'      => __('Sliders', 'technum-theme'),
		'parent_item_colon'   => __('Parent Slider:', 'technum-theme'),
		'all_items'           => __('All Sliders', 'technum-theme'),
		'add_new_item'        => __('Add New Slider', 'technum-theme'),
		'add_new'             => __('Add Slider', 'technum-theme'),
		'new_item'            => __('New Slider', 'technum-theme' ),
		'edit_item'           => __('Edit Slider', 'technum-theme'),
		'update_item'         => __('Update Slider', 'technum-theme'),
		'view_item'           => __('View Slider', 'technum-theme'),
		'search_items'        => __('Search Slider', 'technum-theme'),
		'not_found'           => __('Not found', 'technum-theme'),
		'not_found_in_trash'  => __('Not found in Trash', 'technum-theme'),
	);
	$rewrite = array(
		'slug'                => _x('slider', 'Slider', 'textdomain'),
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => false,
	);
	$args = array(
		'label'               => __('slider', 'technum-theme'),
		'description'         => __('Sliders', 'technum-theme'),
		'labels'              => $labels,
		'supports'            => array('title', 'editor', 'thumbnail', 'revisions'),
		'taxonomies'          => array('slider_type'),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-controls-play',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'query_var'           => 'slider',
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type('slider', $args);	
}

add_action('init', 'wpc_cpt', 10);

//Ajout d'une meta box pour le sticky post
add_action( 'add_meta_boxes', 'meta_box_add_slider_button' );
add_action( 'save_post', 'slider_button_param_save',10,2);


function meta_box_add_slider_button()
{
  add_meta_box('slider_param', __('Informations sur les boutons', 'technum-theme') , 'addbox_sliders', 'slider', 'side', 'low');
}

function addbox_sliders($post, $metabox) {  
// Use nonce for verification
  wp_nonce_field( basename( __FILE__ ), 'slider_param_nonce' );  
   ?>    
		<label><?php echo __('Texte', 'technum-theme'); ?> : </label><input name="slider_text" type="text" value="<?php echo get_post_meta($post->ID, "slider_text", true); ?>" >
		<br>
		<br>
		<?php
		$args = array(
			'post_type' => 'page',
			'nopaging' => true,       			
		);		
		$the_query = new WP_Query($args);
		?>
		<label><?php echo __('slider_page', 'technum-theme'); ?> :
		<select name="slider_page" id="slider_page">
			<?php 
				while ($the_query->have_posts()) : $the_query->the_post();
				
					if(get_the_ID() == get_post_meta($post->ID, "slider_page", true))
					{
						?>
							<option value="<?php echo get_the_ID(); ?>" selected><?php echo the_title(); ?></option>
						<?php    
					}
					else
					{
						?>
							<option value="<?php echo get_the_ID();?>" ><?php echo the_title(); ?></option>
						<?php
					}
				endwhile;
			?>
		</select>

		<br>
		<br>
		<label><?php echo __('slider_display_text', 'technum-theme'); ?> :
		<select name="slider_display_text" id="slider_display_text">
			<?php
				$slider_display_text = get_post_meta($post->ID, "slider_display_text", true)
			?>
			<option value="display" <?php if($slider_display_text == "display"): ?> selected <?php endif; ?> >Display</option>
			<option value="display1" <?php if($slider_display_text == "display1"): ?> selected <?php endif; ?> >Display1</option>
			<option value="display2" <?php if($slider_display_text == "display2"): ?> selected <?php endif; ?> >Display2</option>
			<option value="display3" <?php if($slider_display_text == "display3"): ?> selected <?php endif; ?> >Display3</option>
		</select>
	<?php
}

function slider_button_param_save( $post_id , $post) {
	
	if ($post->post_type != 'slider'){
		return;
	}
  // Verify the nonce before proceeding.
    if ( !isset( $_POST['slider_param_nonce'] ) || !wp_verify_nonce( $_POST['slider_param_nonce'], basename( __FILE__ ) ) )
        return $post_id;

    // Get the post type object.
    $post_type = get_post_type_object( $post->post_type );

    // Check if the current user has permission to edit the post.
    if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
        return $post_id;
	
	//***********************************************Prototype***************
    // Get the posted data and sanitize it for use as an HTML class.
	$new_meta_value ="";
	$meta_key="";
	
    $new_meta_value = ( isset( $_POST['slider_param'] ) ? sanitize_html_class( $_POST['slider_param'] ) : '' );

    // Get the meta key.
    $meta_key = 'slider_param';

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
	//*******************************************Fin Prototype***************
	
	//***********************************************Slider Texte***************
    // Get the posted data and sanitize it for use as an HTML class.
	$new_meta_value ="";
	$meta_key="";
	
    $new_meta_value = ( isset( $_POST['slider_text'] ) ? $_POST['slider_text'] : '' );

    // Get the meta key.
    $meta_key = 'slider_text';

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
	//*******************************************Fin Prototype***************
	//***********************************************Slider Texte***************
    // Get the posted data and sanitize it for use as an HTML class.
	$new_meta_value ="";
	$meta_key="";
	
    $new_meta_value = ( isset( $_POST['slider_page'] ) ? sanitize_html_class( $_POST['slider_page'] ) : '' );

    // Get the meta key.
    $meta_key = 'slider_page';

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
	//*******************************************Fin Prototype***************
	
	//***********************************************Slider Texte***************
    // Get the posted data and sanitize it for use as an HTML class.
	$new_meta_value ="";
	$meta_key="";
	
    $new_meta_value = ( isset( $_POST['slider_display_text'] ) ? sanitize_html_class( $_POST['slider_display_text'] ) : '' );

    // Get the meta key.
    $meta_key = 'slider_display_text';

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
	//*******************************************Fin Prototype***************
	
}