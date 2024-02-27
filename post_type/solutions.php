<?php
function wpc_cpt_solutions() {

	/* reussites */
	$labels = array(
		'name'                => _x('Solutions', 'Post Type General Name', 'textdomain'),
		'singular_name'       => _x('Solution', 'Post Type Singular Name', 'textdomain'),
		'menu_name'           => __('Solutions', 'technum-theme'),
		'name_admin_bar'      => __('Solutions', 'technum-theme'),
		'parent_item_colon'   => __('Parent Solution:', 'technum-theme'),
		'all_items'           => __('All solutions', 'technum-theme'),
		'add_new_item'        => __('Add New Solution', 'technum-theme'),
		'add_new'             => __('Add Solution', 'technum-theme'),
		'new_item'            => __('New Solution', 'technum-theme' ),
		'edit_item'           => __('Edit Solution', 'technum-theme'),
		'update_item'         => __('Update Solution', 'technum-theme'),
		'view_item'           => __('View Solution', 'technum-theme'),
		'search_items'        => __('Search Solution', 'technum-theme'),
		'not_found'           => __('Not found', 'technum-theme'),
		'not_found_in_trash'  => __('Not found in Trash', 'technum-theme'),
	);
	$rewrite = array(
		'slug'                => _x('solutions', 'solutions', 'textdomain'),
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => false,
	);
	$args = array(
		'label'               => __('solution', 'technum-theme'),
		'description'         => __('solution', 'technum-theme'),
		'labels'              => $labels,
		'supports'            => array('title', 'editor', 'thumbnail', 'revisions'),
		'taxonomies'          => array('solutions_type'),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 7,
		'menu_icon'           => 'dashicons-book',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'query_var'           => 'solutions',
		'rewrite'             => $rewrite,
        'capability_type'     => 'page',
        // This is where we add taxonomies to our CPT
        'taxonomies'          => array( 'category' ),
	);
    register_post_type('solutions', $args);	

}

add_action('init', 'wpc_cpt_solutions', 10);

//Ajout dans les résultats de recherche
function wpc_cpt_in_search_solutions($query) {
  if (! is_admin() && $query->is_main_query()) {
    if ($query->is_search) {
      $query->set('post_type', array('post', 'solutions'));
    }
  }
}

add_action('pre_get_posts','wpc_cpt_in_search_solutions');

//Ajout d'une meta box pour le sticky post
add_action( 'add_meta_boxes', 'meta_box_add_solutions' );
add_action('save_post', 'description_solution_save', 10, 2);


function meta_box_add_solutions(){

  add_meta_box(
    'description', // Metabox ID
    __('Brève Description', 'technum-theme'), // Title to display
    'add_solution_description_callback', // Function to call that contains the metabox content
    'solutions', // Post type to display metabox on
    'side', // Where to put it (normal = main colum, side = sidebar, etc.)
    'default' // Priority relative to other metaboxes
  );
  

}


function description_solution_save( $post_id , $post) {
	
	if ($post->post_type != 'solutions'){
		return;
	}
  // Verify the nonce before proceeding.
    if ( !isset( $_POST['solution_description_nonce'] ) || !wp_verify_nonce( $_POST['solution_description_nonce'], basename( __FILE__ ) ) )
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

function add_solution_description_callback($post, $metabox){
	// Use nonce for verification
	
	wp_nonce_field(basename( __FILE__ ), 'solution_description_nonce' );
	$description = get_post_meta( $post->ID, 'description', true ); // Get the saved values
    
    $category_validation = _e( 'Please select a category!', 'technum-theme' );

	  ?>

        <script type="text/javascript">
            
            jQuery(function($) {
                    /********** Form Validation ***********/
                $('form').submit(function(event) {
                    var category_validation = "<?php echo esc_attr($category_validation); ?>";
                    if ($('.categorydiv input[type="checkbox"]:checked').length == 0) {
                        alert('Please select a category !');
                        $('#ajax-loading').css('visibility', 'hidden');  // hide the ajax loading graphic
                        // $('input#publish').removeClass('button-primary-disabled');
                        event.preventDefault();  // cancel form submission
                    }
                })
            });
        </script>
  
	  <div>
		  <label for="description">
			  <?php _e( 'Description', 'technum-theme' );?>
		  </label><br/>
		  <textarea name="description" id="description" rows="6" style="width:100%;"><?php echo esc_attr( $description ); ?> </textarea>
	  </div>
		  
	  <?php
}



function itg_site_solutions_section(){

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
 
    $args = array(
		'paged'        => $paged,
        'post_type'   => 'solutions',
        'orderby'   => 'date',
		'post_status' => 'publish',
        "posts_per_page" => 6,
        'order'     => 'DESC', // it's DESC; not DSC
    );
      
    $the_query = new WP_Query($args);
	
    if ($the_query->have_posts()) :
        $posts = $the_query->get_posts();
    ?>
    <div id="solutionSearchResult">
        <section >
            <div class="container py-5">
                <?php
                    for ($i=0; $i<sizeof($posts); $i++){
                        if($i%2==0){
                ?>
                            <div class="row py-5">
                                <div class="col-md-6 pr-3 d-none d-sm-block d-md-block d-lg-block d-xl-block"  >
                                     <?php echo get_the_post_thumbnail($posts[$i]->ID, 'aucoeur-size'); ?>
                                </div>

                                <div class="col-md-6 px-5">
                                    <h2>
                                        <?php echo get_the_title($posts[$i]->ID)?>
                                    </h2>
                                    <p>
                                        <?php echo get_post_meta( $posts[$i]->ID, 'description', true ); ?>
                                    </p>
                                    <div class="lien-footer d-flex align-items-center py-5">
                                        <a href="<?php echo get_the_permalink($posts[$i]->ID)?>"><?php function_exists('pll_e') ? pll_e('En savoir plus') : _e('En savoir plus', 'textdomain'); ?></a> &nbsp;&nbsp;
                                        <a href="<?php echo get_the_permalink($posts[$i]->ID)?>"><i class="fas fa-angle-right fa-1x"></i></a>
                                    </div>
                                </div>
                            </div>

                        <?php 
                        }else{
                        ?>

                            <div class="row py-5">                    
                                <div class="col-md-6 pr-5 ">
                                    <h2>
                                        <?php echo get_the_title($posts[$i]->ID)?>
                                    </h2>
                                    <p>
                                        <?php echo get_post_meta( $posts[$i]->ID, 'description', true ); ?>
                                    </p>
                                        <div class="lien-footer d-flex align-items-center py-5">
                                            <a href="<?php echo get_the_permalink($posts[$i]->ID)?>"><?php function_exists('pll_e') ? pll_e('En savoir plus') : _e('En savoir plus', 'textdomain'); ?></a> &nbsp;&nbsp;
                                            <a href="<?php echo get_the_permalink($posts[$i]->ID)?>"><i class="fas fa-angle-right fa-1x"></i></a>
                                        </div>
                                </div>
                                <div class="col-md-6 d-none d-sm-none d-md-block d-lg-block d-xl-block" >
                                     <?php echo get_the_post_thumbnail($posts[$i]->ID, 'aucoeur-size'); ?>
                                </div>

                            </div>

                <?php
                        }   
                    }
                ?> 
         </div>
    </section>
<?php

    if(function_exists("pagination")){
        pagination($the_query->max_num_pages);
    }

    wp_reset_postdata();
    endif;
?>
 </div>
<?php
}



function itg_site_autres_solutions_section(){

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    
    $categories = get_the_category(get_the_ID());
   
    $categoriesIds = array();
    foreach($categories as $category){
        array_push($categoriesIds, $category->cat_ID);
    }
   

    $args = array(
		//'paged'        => $paged,
        'post_type'   => 'solutions',
        'category__in' => $categoriesIds,
        'post__not_in' => array(get_the_ID()),
        'orderby'   => 'date',
		'post_status' => 'publish',
        "posts_per_page" => 5,
        'order'     => 'DESC', // it's DESC; not DSC
    );
      
    $the_query = new WP_Query($args);
	
    if ($the_query->have_posts() && sizeof($categoriesIds)!=0) :
        $posts = $the_query->get_posts();
    ?>

        <section>
            <div class="container py-5">
                <div class="container">
                    <h2 class="title"><?php function_exists('pll_e') ? pll_e('Autres solutions') : _e('Autres solutions', 'textdomain'); ?></h2>
                </div>  
                <?php
                    for ($i=0; $i<sizeof($posts); $i++){
                        if($i%2==0){
                ?>
                            <div class="row py-5">
                                <div class="col-md-6 d-none d-sm-none d-md-block d-lg-block d-xl-block">
                                    <?php echo get_the_post_thumbnail($posts[$i]->ID, 'aucoeur-size'); ?>
                                </div>
                                <div class="col-md-6 px-5">
                                    <h2>
                                        <?php echo get_the_title($posts[$i]->ID)?>
                                    </h2>
                                    <p>
                                        <?php echo get_post_meta( $posts[$i]->ID, 'description', true ); ?>
                                    </p>
                                    <div class="lien-footer d-flex align-items-center py-5">
                                        <a href="<?php echo get_the_permalink($posts[$i]->ID)?>"><?php function_exists('pll_e') ? pll_e('En savoir plus') : _e('En savoir plus', 'textdomain'); ?></a> &nbsp;&nbsp;
                                        <a href="<?php echo get_the_permalink($posts[$i]->ID)?>"><i class="fas fa-angle-right fa-1x"></i></a>
                                    </div>
                                </div>
                            </div>

                        <?php 
                        }else{
                        ?>

                            <div class="row py-5">                    
                                <div class="col-md-6 pr-5 ">
                                    <h2>
                                        <?php echo get_the_title($posts[$i]->ID)?>
                                    </h2>
                                    <p>
                                        <?php echo get_post_meta( $posts[$i]->ID, 'description', true ); ?>
                                    </p>
                                        <div class="lien-footer d-flex align-items-center py-5">
                                            <a href="<?php echo get_the_permalink($posts[$i]->ID)?>"><?php function_exists('pll_e') ? pll_e('En savoir plus') : _e('En savoir plus', 'textdomain'); ?></a> &nbsp;&nbsp;
                                            <a href="<?php echo get_the_permalink($posts[$i]->ID)?>"><i class="fas fa-angle-right fa-1x"></i></a>
                                        </div>
                                </div>
                                <div class="col-md-6 d-none d-sm-none d-md-block d-lg-block d-xl-block" >
                                    <?php echo get_the_post_thumbnail($posts[$i]->ID, 'aucoeur-size'); ?>
                                </div>
                            </div>

                <?php
                        }   
                    }
                ?> 
            </div>
        </section>


<?php
    wp_reset_postdata();
	endif;
}