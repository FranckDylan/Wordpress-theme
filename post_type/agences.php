<?php
function wpc_cpt_agences() {

	/* Agences */
	$labels = array(
		'name'                => _x('Agences', 'Post Type General Name', 'textdomain'),
		'singular_name'       => _x('Agences', 'Post Type Singular Name', 'textdomain'),
		'menu_name'           => __('Agences', 'technum-theme'),
		'name_admin_bar'      => __('Agences', 'technum-theme'),
		'parent_item_colon'   => __('Parent Agence:', 'technum-theme'),
		'all_items'           => __('All Agences', 'technum-theme'),
		'add_new_item'        => __('Add New Agence', 'technum-theme'),
		'add_new'             => __('Add New Agences', 'technum-theme'),
		'new_item'            => __('New Agence', 'technum-theme' ),
		'edit_item'           => __('Edit Agence', 'technum-theme'),
		'update_item'         => __('Update Agence', 'technum-theme'),
		'view_item'           => __('View Au Coeur', 'technum-theme'),
		'search_items'        => __('Search Agence', 'technum-theme'),
		'not_found'           => __('Not found', 'technum-theme'),
		'not_found_in_trash'  => __('Not found in Trash', 'technum-theme'),
	);
	$rewrite = array(
		'slug'                => _x('agence', 'Agences', 'textdomain'),
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => false,
	);
	$args = array(
		'label'               => __('Agences' , 'technum-theme'),
		'description'         => __('Agences', 'technum-theme'),
		'labels'              => $labels,
		'supports'            => array('title', 'editor', 'thumbnail', 'revisions'),
		'taxonomies'          => array('agences_type'),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 6,
		'menu_icon'           => 'dashicons-admin-home',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'query_var'           => 'agences',
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type('agences', $args);	
}

add_action('init', 'wpc_cpt_agences', 10);

//Ajout dans les résultats de recherche
function wpc_cpt_in_search_agence($query) {
  if (! is_admin() && $query->is_main_query()) {
    if ($query->is_search) {
      $query->set('post_type', array('post', 'agences'));
    }
  }
}

add_action('pre_get_posts','wpc_cpt_in_search_agence');
add_action('save_post', 'agence_save', 10, 2);
add_action( 'add_meta_boxes', 'meta_box_agence_add' );

function meta_box_agence_add(){
	add_meta_box(
		'agence_details', // Metabox ID
		__('Paramètres', 'technum-theme'), // Title to display
		'add_agence_callback', // Function to call that contains the metabox content
		'agences', // Post type to display metabox on
		'side', // Where to put it (normal = main colum, side = sidebar, etc.)
		'default' // Priority relative to other metaboxes
	  );
}

function add_agence_callback($post, $metabox){
	// Use nonce for verification

	wp_nonce_field(basename( __FILE__ ), 'adresse_nonce' );
    $adresse = get_post_meta( $post->ID, 'adresse', true ); // Get the saved values

    wp_nonce_field(basename( __FILE__ ), 'indication_nonce' );
    $indication = get_post_meta( $post->ID, 'indication', true ); // Get the saved values

    wp_nonce_field(basename( __FILE__ ), 'boitePostale_nonce' );
    $boitePostale = get_post_meta( $post->ID, 'boitePostale', true ); // Get the saved values

    wp_nonce_field(basename( __FILE__ ), 'phone_1_nonce' );
    $phone_1 = get_post_meta( $post->ID, 'phone_1', true ); // Get the saved values

    wp_nonce_field(basename( __FILE__ ), 'liengooglemap_nonce' );
    $liengooglemap = get_post_meta( $post->ID, 'liengooglemap', true ); // Get the saved values

    /*wp_nonce_field(basename( __FILE__ ), 'phone_2_nonce' );
    $phone_2 = get_post_meta( $post->ID, 'phone_2', true ); // Get the saved values

    wp_nonce_field(basename( __FILE__ ), 'phone_3_nonce' );
    $phone_3 = get_post_meta( $post->ID, 'phone_3', true ); // Get the saved values

    wp_nonce_field(basename( __FILE__ ), 'phone_4_nonce' );
    $phone_4 = get_post_meta( $post->ID, 'phone_4', true ); // Get the saved values

    wp_nonce_field(basename( __FILE__ ), 'phone_5_nonce' );
	$phone_5 = get_post_meta( $post->ID, 'phone_5', true ); // Get the saved values
  */
	?>
  
      <table>
            <tr>
                <td>
                    <label for="adresse">
                        <?php _e( 'Adresse', 'technum-theme' );?>
                    </label>
                </td>
                <td>
                    <input
                        type="text"
                        name="adresse"
                        id="adresse"
                        value="<?php echo esc_attr( $adresse ); ?>" 
                        style="width:100%;"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="indication">
                        <?php _e( 'Indication', 'technum-theme' );?>
                    </label>
                </td>
                <td>
                    <input
                        type="text"
                        name="indication"
                        id="indication"
                        value="<?php echo esc_attr( $indication ); ?>" 
                        style="width:100%;"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="boitePostale">
                        <?php _e( 'Boite Postale', 'technum-theme' );?>
                    </label>
                </td>
                <td>
                    <input
                        type="text"
                        name="boitePostale"
                        id="boitePostale"
                        value="<?php echo esc_attr( $boitePostale ); ?>" 
                        style="width:100%;"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="phone_1">
                        <?php _e( 'Téléphone', 'technum-theme' );?>
                    </label>
                </td>
                <td>
                    <input
                        type="text"
                        name="phone_1"
                        id="phone_1"
                        value="<?php echo esc_attr( $phone_1 ); ?>" 
                        style="width:100%;"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="phone_1">
                        <?php _e( 'Lien Google Map', 'technum-theme' );?>
                    </label>
                </td>
                <td>
                    <input
                        type="text"
                        name="liengooglemap"
                        id="liengooglemap"
                        value="<?php echo esc_attr( $liengooglemap ); ?>" 
                        style="width:100%;"/>
                </td>
            </tr>
            
            <!-- <tr>
                <td>
                    <label for="phone_2">
                        <?php //_e( 'Téléphone 2', 'technum-theme' );?>
                    </label>
                </td>
                <td>
                    <input
                        type="text"
                        name="phone_2"
                        id="phone_2"
                        value="<?php //echo esc_attr( $phone_2 ); ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="phone_3">
                        <?php //_e( 'Téléphone 3', 'technum-theme' );?>
                    </label>
                </td>
                <td>
                    <input
                        type="text"
                        name="phone_3"
                        id="phone_3"
                        value="<?php //echo esc_attr( $phone_3 ); ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="phone_4">
                        <?php //_e( 'Téléphone 4', 'technum-theme' );?>
                    </label>
                </td>
                <td>
                    <input
                        type="text"
                        name="phone_4"
                        id="phone_4"
                        value="<?php //echo esc_attr( $phone_4 ); ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="phone_5">
                        <?php //_e( 'Téléphone 5', 'technum-theme' );?>
                    </label>
                </td>
                <td>
                    <input
                        type="text"
                        name="phone_5"
                        id="phone_5"
                        value="<?php //echo esc_attr( $phone_5 ); ?>" />
                </td>
            </tr> -->

        </table>


		  
	<?php
}


function agence_save( $post_id , $post) {
	
	if ($post->post_type != 'agences'){
		return;
    }

  // Verify the nonce before proceeding.
    if ( !isset( $_POST['adresse_nonce'] ) || !wp_verify_nonce( $_POST['adresse_nonce'], basename( __FILE__ ) ) )
        return $post_id;

    if ( !isset( $_POST['indication_nonce'] ) || !wp_verify_nonce( $_POST['indication_nonce'], basename( __FILE__ ) ) )
        return $post_id;

    if ( !isset( $_POST['boitePostale_nonce'] ) || !wp_verify_nonce( $_POST['boitePostale_nonce'], basename( __FILE__ ) ) )
        return $post_id;

    if ( !isset( $_POST['phone_1_nonce'] ) || !wp_verify_nonce( $_POST['phone_1_nonce'], basename( __FILE__ ) ) )
        return $post_id;

    if ( !isset( $_POST['liengooglemap_nonce'] ) || !wp_verify_nonce( $_POST['liengooglemap_nonce'], basename( __FILE__ ) ) )
        return $post_id;
    /*if ( !isset( $_POST['phone_2_nonce'] ) || !wp_verify_nonce( $_POST['phone_2_nonce'], basename( __FILE__ ) ) )
        return $post_id;

    if ( !isset( $_POST['phone_3_nonce'] ) || !wp_verify_nonce( $_POST['phone_3_nonce'], basename( __FILE__ ) ) )
        return $post_id;

    if ( !isset( $_POST['phone_4_nonce'] ) || !wp_verify_nonce( $_POST['phone_4_nonce'], basename( __FILE__ ) ) )
        return $post_id;

    if ( !isset( $_POST['phone_5_nonce'] ) || !wp_verify_nonce( $_POST['phone_5_nonce'], basename( __FILE__ ) ) )
        return $post_id;*/

    // Get the post type object.
    $post_type = get_post_type_object( $post->post_type );

    // Check if the current user has permission to edit the post.
    if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
        return $post_id;

    $champs = array('adresse', 'indication', 'boitePostale', 'phone_1','liengooglemap'); //, 'phone_2', 'phone_3', 'phone_4', 'phone_5');

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
}


function itg_display_agences(){

    $args = array(
		//'paged'        => $paged,
		'post_type'   => 'agences',
		'post_status' => 'publish',
        //"posts_per_page" => 6,
        'nopaging' => true,   
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => 'liengooglemap',
                'value' => '',
                'compare' => '=='
            ),
            array(
                'key' => 'liengooglemap',
                'compare' => 'NOT EXISTS'
            ),

            
        )
    );
      
    $the_query = new WP_Query($args);
	
	if ($the_query->have_posts()) :
        while ($the_query->have_posts()) : $the_query->the_post();
?>
        <div class="col-md-6 mb-4">
                                                                
                <div class="emploi-card h-100 shadow">
                    <a href="#"><h4 ><?php echo get_the_title(get_the_ID()); ?></h4></a> 
                    <address class="text-color"><?php echo get_post_meta(get_the_ID(), 'adresse', true); ?></address>
                    <address class="text-color"><?php echo get_post_meta(get_the_ID(), 'indication', true); ?></address>
                    <address class="text-color"><?php echo get_post_meta(get_the_ID(), 'boitePostale', true); ?></address>
                    <address class="text-color"><?php echo get_post_meta(get_the_ID(), 'phone_1', true); ?></address>
                </div>
        
        </div>

<?php
        endwhile;
     wp_reset_postdata();
	endif;
}


function itg_display_agences_map(){

    $args = array(
		//'paged'        => $paged,
		'post_type'   => 'agences',
		'post_status' => 'publish',
        //"posts_per_page" => 6,
        'nopaging' => true,   
        'meta_query' => array(
            array(
                'key' => 'liengooglemap',
                'value' => '',
                'compare' => '!='
            )
        )
    );
      
    $the_query = new WP_Query($args);
	
	if ($the_query->have_posts()) :
        while ($the_query->have_posts()) : $the_query->the_post();
?>
        <div class="jumbotron" style="border-radius: 0%;">
            <div class="row justify-content-center h-100">     
                <div class="col-md-5 " style="position: relative;">
                    <div style="color: #042F6B;" class="contact-info mt-1" style="position: absolute;">
                        <i class="fas fa-map-marker-alt fa-x mr-4"></i><span class="contact-email " style="font-size: 20px;">
                            <?php echo get_the_title(get_the_ID()); ?>
                        </span><br>
                        <span class="contact-email ml-4" style="font-size: 20px;">
                        &nbsp; &nbsp;<?php echo get_post_meta(get_the_ID(), 'adresse', true); ?>  <?php echo get_post_meta(get_the_ID(), 'indication', true); ?>
                        </span>
                        <br><br>
                        <i class="fa fa-envelope fa-x mr-4"></i><span class="contact-email"><?php echo get_post_meta(get_the_ID(), 'boitePostale', true); ?></span>
                        <br><br>
                        <i class="fa fa-phone-alt fa-x mr-4"></i><span
                            class="contact-phone "><?php echo get_post_meta(get_the_ID(), 'phone_1', true); ?></span>                                                                       
                    </div>
                </div>
                <div class="col-md-7" id="carte">
                    <iframe src="<?php echo get_post_meta(get_the_ID(), 'liengooglemap', true); ?>"
                    width="100%" height="320" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>                                                                                 
            </div>                                                        
        </div>

<?php
        endwhile;
     wp_reset_postdata();
	endif;
}