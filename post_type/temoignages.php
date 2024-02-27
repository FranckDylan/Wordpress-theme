<?php
function wpc_cpt_temoignages() {

	/* reussites */
	$labels = array(
		'name'                => _x('Témoignages', 'Post Type General Name', 'textdomain'),
		'singular_name'       => _x('Témoignage', 'Post Type Singular Name', 'textdomain'),
		'menu_name'           => __('Témoignages', 'technum-theme'),
		'name_admin_bar'      => __('Témoignages', 'technum-theme'),
		'parent_item_colon'   => __('Parent Temoignage:', 'technum-theme'),
		'all_items'           => __('All Testimony', 'technum-theme'),
		'add_new_item'        => __('Add New Temoignage', 'technum-theme'),
		'add_new'             => __('Add Temoignage', 'technum-theme'),
		'new_item'            => __('New Temoignage', 'technum-theme' ),
		'edit_item'           => __('Edit Temoignage', 'technum-theme'),
		'update_item'         => __('Update Temoignage', 'technum-theme'),
		'view_item'           => __('View Temoignage', 'technum-theme'),
		'search_items'        => __('Search Temoignage', 'technum-theme'),
		'not_found'           => __('Not found', 'technum-theme'),
		'not_found_in_trash'  => __('Not found in Trash', 'technum-theme'),
	);
	$rewrite = array(
		'slug'                => _x('temoignages', 'temoignages', 'textdomain'),
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => false,
	);
	$args = array(
		'label'               => __('témoignage', 'technum-theme'),
		'description'         => __('témoignage', 'technum-theme'),
		'labels'              => $labels,
		'supports'            => array('title', 'editor', 'revisions', 'thumbnail', 'headway-seo'),
		'taxonomies'          => array('temoignages_type'),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 7,
		'menu_icon'           => 'dashicons-admin-network',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'query_var'           => 'temoignages',
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
    register_post_type('temoignages', $args);	
    

}

add_action('init', 'wpc_cpt_temoignages', 10);

//Ajout dans les résultats de recherche
function wpc_cpt_in_search_temoignages($query) {
  if (! is_admin() && $query->is_main_query()) {
    if ($query->is_search) {
      $query->set('post_type', array('post', 'temoignages'));
    }
  }
}

add_action('pre_get_posts','wpc_cpt_in_search_temoignages');

//Ajout d'une meta box pour le sticky post
add_action( 'add_meta_boxes', 'meta_box_add_temoignages' );
add_action('save_post', 'add_reussites_temoignages_save', 10, 2);

function meta_box_add_temoignages(){

  add_meta_box(
	'description', // Metabox ID
	__('Options Additionnelles', 'technum-theme'), // Title to display
	'box_join_temoignages_reussites', // Function to call that contains the metabox content
	'temoignages', // Post type to display metabox on
	'side', // Where to put it (normal = main colum, side = sidebar, etc.)
	'high' // Priority relative to other metaboxes
  );

}

function add_reussites_temoignages_save($post_id , $post){

    if ($post->post_type != 'temoignages'){
		return;
	}
  // Verify the nonce before proceeding.
    if ( !isset( $_POST['reussite_id_nonce'] ) || !wp_verify_nonce( $_POST['reussite_id_nonce'], basename( __FILE__ ) ) )
        return $post_id;

    if ( !isset( $_POST['isreussite_nonce'] ) || !wp_verify_nonce( $_POST['isreussite_nonce'], basename( __FILE__ ) ) )
        return $post_id;

        

    // Get the post type object.
    $post_type = get_post_type_object( $post->post_type );

    // Check if the current user has permission to edit the post.
    if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
        return $post_id;

    $champs = array('isreussite', 'reussite_id');

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

function box_join_temoignages_reussites($post, $metabox){

    // Use nonce for verification
    wp_nonce_field( basename( __FILE__ ), 'isreussite_nonce' );
    $entered = get_post_meta($post->ID, 'isreussite', true);
    ?>
    <label><input id="isreussite" name="isreussite" type="checkbox"<?php if($entered=="on")echo' checked="checked"';?> ><?php echo __('Témoignages sur une reussite ?', 'technum-theme'); ?></label>
    <?php

    wp_nonce_field(basename( __FILE__ ), 'reussite_id_nonce' );
    $reussiteId = get_post_meta( $post->ID, 'reussite_id', true ); // Get the saved values

    ?>

    <div id="reussite-choice">
        <label for="reussite_id">
            <?php _e( 'Reussites', 'technum-theme' );?>
        </label><br/>
     
        <select name="reussite_id" id="reussite_id" style="width: 80%;">
            <option > </option>
            <?php
            
            $args = array(  
                'post_type' => 'reussites',
                'orderby' => 'title', 
                'order' => 'ASC',
                'nopaging' => true,  
            );

            $posts = get_posts( $args );
                
                if ( !empty( $posts ) ) {
                    foreach($posts as $post){ 
            ?>        
                        <option value="<?php echo esc_attr($post->ID); ?>" <?php  if($reussiteId == $post->ID){ echo 'selected="selected"';} ?>><?php echo get_the_title($post->ID); ?></option>
            <?php
                    }
                }
                wp_reset_postdata();   
            ?>
        </select>

    </div>
        
    <?php

}


/** Liste des reussites dans la page de détail d'un partenaire */

function itgstore_reussite_temoignages_section($reussiteId) {

    
	if( $reussiteId ) :
		$args = array(
            //'paged'		=> $paged,
            'post_type' => 'temoignages',
            //"posts_per_page" => 5,
            'nopaging' => true,  
            'meta_query'=> array(
				
			),
            'meta_query'=> array(
                array(
					'key' => 'reussite_id',
					'value' =>   $reussiteId,
					'compare' => '='
				),
				array(
					'key' => 'isreussite',
					'value' =>  'on',
					'compare' => '='
				)
            )
			
		);
	endif;

	$the_query = new WP_Query($args);
	
	$title = get_the_title( get_option('page_for_posts', true) );
				if ($the_query->have_posts()) :
    ?>
    
    <section  id="section-ala-une" >
        <div class="container  py-5">
            <h2 class="title"><?php function_exists('pll_e') ? pll_e('Témoignages') : _e('Témoignages', 'textdomain'); ?></h2>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class=" col-md-12">
                        <div class="container ">
                                <div class="cards " style="background-color: transparent; border: 2px solid #042F6B;" >              
                                    <?php	
                                        while ($the_query->have_posts()) : $the_query->the_post();
                                    ?>

                                        <div> 
                                            <div class="row p-0">
                                                <div class="col-md-5" style="width: 100%; ">
                                                    <img class="imgbox" src="<?php echo get_the_post_thumbnail_url(); ?>" style=" height: 270px;" alt="cas client image ...">
                                                </div>
                                                <div class="col-md-5">
                                                    <h3 style="color: #042F6B;" class="mb-4"><?php the_title(); ?></h3>
                                                    <p style="color: #042F6B;"><?php the_excerpt(); ?></p>
                                                </div>
                                            </div>
                                        </div>  
                                    <?php
                                        endwhile;
                                    ?>       
                                </div>
                        </div>
                </div> 
            </div>
        </div>
    </section>
	<?php
	wp_reset_postdata();
	endif;
}

