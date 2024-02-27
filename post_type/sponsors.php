<?php
function wpc_cpt_sponsors() {

	/* Slider */
	$labels = array(
		'name'                => _x('sponsors', 'Post Type General Name', 'textdomain'),
		'singular_name'       => _x('sponsor', 'Post Type Singular Name', 'textdomain'),
		'menu_name'           => __('Sponsors', 'textdomain'),
		'name_admin_bar'      => __('Sponsors', 'textdomain'),
		'parent_item_colon'   => __('Parent Sponsor:', 'technum-theme'),
		'all_items'           => __('All Sponsors', 'technum-theme'),
		'add_new_item'        => __('Add New Sponsor', 'technum-theme'),
		'add_new'             => __('Add Sponsor', 'technum-theme'),
		'new_item'            => __('New Sponsor', 'technum-theme' ),
		'edit_item'           => __('Edit Sponsor', 'technum-theme'),
		'update_item'         => __('Update Sponsor', 'technum-theme'),
		'view_item'           => __('View Sponsor', 'technum-theme'),
		'search_items'        => __('Search Sponsor', 'technum-theme'),
		'not_found'           => __('Not found', 'technum-theme'),
		'not_found_in_trash'  => __('Not found in Trash', 'technum-theme'),
	);
	$rewrite = array(
		'slug'                => _x('sponsor', 'sponsor', 'textdomain'),
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => false,
	);
	$args = array(
		'label'               => __('sponsor', 'technum-theme'),
		'description'         => __('Sponsors', 'technum-theme'),
		'labels'              => $labels,
		'supports'            => array('title', 'editor', 'thumbnail', 'revisions'),
		'taxonomies'          => array('sponsor_type'),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-welcome-learn-more',
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
	register_post_type('sponsors', $args);	
}

add_action('init', 'wpc_cpt_sponsors', 10);

//Ajout dans les résultats de recherche
function wpc_cpt_in_search_sponsors($query) {
	if (! is_admin() && $query->is_main_query()) {
		if ($query->is_search) {
		$query->set('post_type', array('post', 'sponsors'));
		}
	}
}

add_action('pre_get_posts','wpc_cpt_in_search_sponsors');

//Ajout d'une meta box pour le sticky post
add_action( 'add_meta_boxes', 'meta_box_add_sponsors' );
add_action( 'save_post', 'sponsors_param_save',10,2);


function meta_box_add_sponsors()
{
  add_meta_box(
	'lien', // Metabox ID
	__('Lien du site web', 'technum-theme'), // Title to display
	'add_new_box_sponsors', // Function to call that contains the metabox content
	'sponsors', // Post type to display metabox on
	'side', // Where to put it (normal = main colum, side = sidebar, etc.)
	'default' // Priority relative to other metaboxes
  );
}

function add_new_box_sponsors($post, $metabox) {  
	// Use nonce for verification
	wp_nonce_field(basename( __FILE__ ), 'lien_nonce' );
	$lien = get_post_meta( $post->ID, 'lien', true ); // Get the saved values

	?>

	<div>
		<label for="lien" class="required">
			<?php _e( 'Lien du Site Web', 'technum-theme' );?>
		</label><br/>
		<input name="lien" required id="lien" value="<?php echo esc_attr( $lien ); ?>" style="width:100%;"/>
	</div>
		
	<?php
}

function sponsors_param_save( $post_id , $post) {
	
	if ($post->post_type != 'sponsors'){
		return;
	}
  // Verify the nonce before proceeding.
    if ( !isset( $_POST['lien_nonce'] ) || !wp_verify_nonce( $_POST['lien_nonce'], basename( __FILE__ ) ) )
        return $post_id;

    // Get the post type object.
    $post_type = get_post_type_object( $post->post_type );

    // Check if the current user has permission to edit the post.
    if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
        return $post_id;

    // Get the posted data and sanitize it for use as an HTML class.
    $new_meta_value = ( isset( $_POST['lien'] ) ? wp_filter_post_kses( $_POST['lien'] ) : '' );

    // Get the meta key.
    $meta_key = 'lien';

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


/** function pour l'affiche de la liste des sponsors d'un évènement */
function itg_evenement_sponsors_section($post_id){

	$allSponsors = Many_To_Many_Linker::get_all_of_post_type('sponsors');
	$sponsorsIds = Many_To_Many_Linker::get_event_sponsor_ids($post_id);
?>
	<section class="py-5" id="section-partenaire">
		<div class="container mb-4">
			<h2 style="color: #042F6B;" class="title"><?php function_exists('pll_e') ? pll_e('Sponsors') : _e('Sponsors', 'textdomain'); ?></h2>
		</div>
		<div class="container text-center">
			<div class="logos d-flex justify-content-start align-items-center flex-wrap">
		<?php
		foreach($allSponsors as $sponsor){
			if(in_array($sponsor->ID, $sponsorsIds)){
		?>
				<a href="<?php echo get_post_meta($sponsor->ID, 'lien', true);?>"><img alt="logo-partenaire" src="<?php echo get_the_post_thumbnail_url($sponsor->ID, 'aucoeur-size');?>"></a>
		<?php
			}
		}
		?>
			</div>
		</div>
	</section>
<?php
}