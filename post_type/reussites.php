<?php
function wpc_cpt_reussites() {

	/* reussites */
	$labels = array(
		'name'                => _x('Reussites', 'Post Type General Name', 'textdomain'),
		'singular_name'       => _x('Reussite', 'Post Type Singular Name', 'textdomain'),
		'menu_name'           => __('Reussites', 'technum-theme'),
		'name_admin_bar'      => __('Reussites', 'technum-theme'),
		'parent_item_colon'   => __('Parent Reussite:', 'technum-theme'),
		'all_items'           => __('All Success Stories', 'technum-theme'),
		'add_new_item'        => __('Add New Reussite', 'technum-theme'),
		'add_new'             => __('Add Reussite', 'technum-theme'),
		'new_item'            => __('New Reussite', 'technum-theme' ),
		'edit_item'           => __('Edit Reussite', 'technum-theme'),
		'update_item'         => __('Update Reussite', 'technum-theme'),
		'view_item'           => __('View Reussite', 'technum-theme'),
		'search_items'        => __('Search Reussite', 'technum-theme'),
		'not_found'           => __('Not found', 'technum-theme'),
		'not_found_in_trash'  => __('Not found in Trash', 'technum-theme'),
	);
	$rewrite = array(
		'slug'                => _x('reussites', 'reussites', 'textdomain'),
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => false,
	);
	$args = array(
		'label'               => __('reussite', 'technum-theme'),
		'description'         => __('reussite', 'technum-theme'),
		'labels'              => $labels,
		'supports'            => array('title', 'editor', 'revisions','page-attributes', 'thumbnail'),
		'taxonomies'          => array('reussites_type'),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 7,
		'menu_icon'           => 'dashicons-thumbs-up',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'query_var'           => 'reussites',
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
    register_post_type('reussites', $args);	

}

add_action('init', 'wpc_cpt_reussites', 10);

//Ajout dans les résultats de recherche
function wpc_cpt_in_search_reussites($query) {
  if (! is_admin() && $query->is_main_query()) {
    if ($query->is_search) {
      $query->set('post_type', array('post', 'reussites'));
    }
  }
}

add_action('pre_get_posts','wpc_cpt_in_search_reussites');

//Ajout d'une meta box pour le sticky post
add_action( 'add_meta_boxes', 'meta_box_add_reussites' );
add_action('save_post', 'add_partenaire_reussites_save', 10, 2);
add_action('save_post', 'description_reussite_save', 10, 2);


function meta_box_add_reussites(){

  add_meta_box(
	'reussite_box', // Metabox ID
	__('Paramètres réussites', 'technum-theme'), // Title to display
	'box_join_reussites_partenaires', // Function to call that contains the metabox content
	'reussites', // Post type to display metabox on
	'side', // Where to put it (normal = main colum, side = sidebar, etc.)
	'high' // Priority relative to other metaboxes
  );

  add_meta_box(
    'description', // Metabox ID
    __('Brève Description', 'technum-theme'), // Title to display
    'add_reussite_description_callback', // Function to call that contains the metabox content
    'reussites', // Post type to display metabox on
    'side', // Where to put it (normal = main colum, side = sidebar, etc.)
    'default' // Priority relative to other metaboxes
  );
  

}

function add_partenaire_reussites_save($post_id , $post){

    if ($post->post_type != 'reussites'){
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

}

function box_join_reussites_partenaires($post, $metabox){

    // Use nonce for verification
    wp_nonce_field( basename( __FILE__ ), 'ispartenaire_nonce' );
    $entered = get_post_meta($post->ID, 'ispartenaire', true);
    ?>
    <label><input id="ispartenaire" name="ispartenaire" type="checkbox"<?php if($entered=="on")echo' checked="checked"';?> ><?php echo __('Reussites avec un partenaitre ?', 'textdomain'); ?></label>
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
                // The Loop
                $args = array(  
                    'post_type' => 'partenaires',
                    'orderby' => 'title', 
                    //'post_parent' => 0,       
                    'order' => 'ASC',
                    "posts_per_page" => -1,
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


function description_reussite_save( $post_id , $post) {
	
	if ($post->post_type != 'reussites'){
		return;
	}
  // Verify the nonce before proceeding.
    if ( !isset( $_POST['reussite_description_nonce'] ) || !wp_verify_nonce( $_POST['reussite_description_nonce'], basename( __FILE__ ) ) )
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

function add_reussite_description_callback($post, $metabox){
	// Use nonce for verification
	
	wp_nonce_field(basename( __FILE__ ), 'reussite_description_nonce' );
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


/** Liste des reussites dans la page de détail d'un partenaire */
function itgstore_partenaire_reussites_section($slug) {

    $args = array(
		'name'        => $slug,
		'post_type'   => 'partenaires',
		'post_status' => 'publish',
		'numberposts' => 1
	  );

    $my_posts = get_posts($args);
    
	if( $my_posts ) :
		$args = array(
            //'paged'		=> $paged,
            'post_type' => 'reussites',
            //"posts_per_page" => 5,
            'nopaging' => true,       
            'meta_query'=> array(
				
			),
            'meta_query'=> array(
                array(
					'key' => 'partenaire_id',
					'value' =>   $my_posts[0]->ID,
					'compare' => '='
				),
				array(
					'key' => 'ispartenaire',
					'value' =>  'on',
					'compare' => '='
				)
            )
			
		);
	endif;

	$the_query = new WP_Query($args);
	
	if ($the_query->have_posts()) :
    ?>
    
    

    <section class="py-5">
        <div class="container  mb-5">
                <h2 class="title"><?php function_exists('pll_e') ? pll_e('Réussites') : _e('Réussites', 'textdomain'); ?></h2>
                <p class="sect-desc"><?php echo get_theme_mod('reussites_front_text_setting'); ?></p>
        </div>
        <div class="container-fluid">
            <div class="articlet">
                <div class="row">
                <?php	
					while ($the_query->have_posts()) : $the_query->the_post();
                ?>
                   
                        <div class="col-md-3 mb-4">
                            <a class="card " href="<?php the_permalink(); ?>">
                                <div class="img-article"
                                    style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')"></div>
                                <div class="card-body position-relative">
                                    <div class="description-top">
                                        <h3 class="card-subtitle mb-5"><?php the_title(); ?></h3>
                                        <p class="card-title"><?php echo get_post_meta( get_the_ID(), 'description', true ); ?></p>
                                    </div>
                                    
                                </div>
                            </a>
                        </div>
                    
				<?php
					endwhile;
			
                ?>   
            </div>     
            </div>
        </div>
    </section>
	<?php
	wp_reset_postdata();
	endif;
}

/** Liste de toutes les réussites de l'entreprise */
function itgstore_page_reussites_liste(){

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    

    $args = array(
		'paged'        => $paged,
		'post_type'   => 'reussites',
		'post_status' => 'publish',
        "posts_per_page" => 6,
    );
      
    $the_query = new WP_Query($args);
	
	if ($the_query->have_posts()) :
    ?>
   
        <section class="py-5" id="section-list-cas-clients">
            <div class="container mb-5">
                <h2 class=""><?php function_exists('pll_e') ? pll_e('Nos réussites') : _e('Nos réussites', 'textdomain'); ?></h2>
                <p class="sect-desc mb-4"><?php echo get_post_meta( get_the_ID(), 'titre_contenu', true ); ?></p>
            </div>
            <div id="searchReussite">
                <div class="container">
                    <div  class="card-deck">
                        <div class="row">
                            <?php
                                while ($the_query->have_posts()) : $the_query->the_post();
                            ?>
                                <div class="col-md-4 mb-5">
                                    <div class="card h-100 border-0" style="border: 2px solid #042F6B;">
                                        <?php if ( has_post_thumbnail($post->ID) ) { ?>
                                        <div class="green-filter" style="width: 100%; ">
                                            <img alt="..." class="card-img-top" src="<?php echo the_post_thumbnail_url('aucoeur_size'); ?>" style="height: 230px; border-top-left-radius:35px; border-top-right-radius: 35px;">
                                        </div>
                                        <?php } ?>
                                        <div class="card-body" >
                                            <h5 class="card-title"><?php the_title(); ?></h5>
                                            <p class="card-text"> <?php echo get_post_meta( get_the_ID(), 'description', true ); ?> </p>
                                        </div>
                                        <div class="card-footer d-flex align-items-center">
                                            <a href="<?php the_permalink(); ?>">En savoir plus</a> &nbsp;&nbsp;
                                            <a href="<?php the_permalink(); ?>"><i class="fas fa-angle-right fa-1x"></i></a>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                endwhile;
                            ?> 
                        </div> 
                    </div>
                </div>
            
                <?php 

                    if (function_exists("pagination")) {
                        pagination($the_query->max_num_pages);
                    } 

                ?>
            </div>
        </section>
    <?php
       
	    wp_reset_postdata();
	endif;
}
/** Correction Albert */
function itgstore_page_reussites_liste_2(){

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    

    $args = array(
		'paged'        => $paged,
		'post_type'   => 'reussites',
		'post_status' => 'publish',
        "posts_per_page" => 6,
    );
      
    $the_query = new WP_Query($args);
	
	$title = get_the_title( get_option('page_for_posts', true) );
				if ($the_query->have_posts()) : 
    ?>
   
        <section class="py-5" id="section-list-cas-clients">
            <div class="container mb-5">
                <h2 class=""><?php function_exists('pll_e') ? pll_e('Nos réussites') : _e('Nos réussites', 'textdomain'); ?></h2>
                <p class="sect-desc mb-4"><?php echo get_post_meta( get_the_ID(), 'titre_contenu', true ); ?></p>
            </div>
            <div id="searchReussite">
                <div class="container">
                    <div  class="card-deck">
                        <div class="row">
                            <?php
                                while ($the_query->have_posts()) : $the_query->the_post();
                            ?>
                                <div class="col-md-4 mb-5">
                                    <div class="card h-100 border-0" style="border: 2px solid #042F6B;">
                                        <?php if ( has_post_thumbnail(get_the_id()) ) { ?>
                                        <div class="green-filter" style="width: 100%; ">
                                            <?php the_post_thumbnail('aucoeur-size', array('class' => 'card-img-top', 'style'=>'height: 230px; border-top-left-radius:35px; border-top-right-radius: 35px;')); ?>
                                        </div>
                                        <?php } ?>
                                        <div class="card-body" >
                                            <h5 class="card-title"><?php the_title(); ?></h5>
                                            <p class="card-text"> <?php echo get_post_meta( get_the_ID(), 'description', true ); ?> </p>
                                        </div>
                                        <div class="card-footer d-flex align-items-center">
                                            <a href="<?php the_permalink(); ?>"><?php function_exists('pll_e') ? pll_e('En savoir plus') : _e('En savoir plus', 'textdomain');?></a> &nbsp;&nbsp;
                                            <a href="<?php the_permalink(); ?>"><i class="fas fa-angle-right fa-1x"></i></a>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                endwhile;
                            ?> 
                        </div> 
                    </div>
                </div>
            
                <?php 

                    if (function_exists("pagination")) {
                        pagination($the_query->max_num_pages);
                    } 

                ?>
            </div>
        </section>
    <?php
       
	    wp_reset_postdata();
	endif;
}
