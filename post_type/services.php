<?php
function wpc_cpt_services() {

	/* reussites */
	$labels = array(
		'name'                => _x('Service', 'Post Type General Name', 'textdomain'),
		'singular_name'       => _x('Service', 'Post Type Singular Name', 'textdomain'),
		'menu_name'           => __('Services', 'technum-theme'),
		'name_admin_bar'      => __('Services', 'technum-theme'),
		'parent_item_colon'   => __('Parent Service:', 'technum-theme'),
		'all_items'           => __('All Services', 'technum-theme'),
		'add_new_item'        => __('Add New Service', 'technum-theme'),
		'add_new'             => __('Add Service', 'technum-theme'),
		'new_item'            => __('New Service', 'technum-theme' ),
		'edit_item'           => __('Edit Service', 'technum-theme'),
		'update_item'         => __('Update Service', 'technum-theme'),
		'view_item'           => __('View Service', 'technum-theme'),
		'search_items'        => __('Search Service', 'technum-theme'),
		'not_found'           => __('Not found', 'textdomain'),
		'not_found_in_trash'  => __('Not found in Trash', 'textdomain'),
	);
	$rewrite = array(
		'slug'                => _x('services', 'services', 'textdomain'),
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => false,
	);
	$args = array(
		'label'               => __('service', 'technum-theme'),
		'description'         => __('service', 'technum-theme'),
		'labels'              => $labels,
		'supports'            => array('title', 'editor', 'revisions','page-attributes', 'thumbnail'),
        'taxonomies'          => array( 'category' ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 7,
		'menu_icon'           => 'dashicons-welcome-write-blog',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'query_var'           => 'services',
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
    register_post_type('services', $args);	

}

add_action('init', 'wpc_cpt_services', 10);

//Ajout dans les résultats de recherche
function wpc_cpt_in_search_services($query) {
  if (! is_admin() && $query->is_main_query()) {
    if ($query->is_search) {
      $query->set('post_type', array('post', 'services'));
    }
  }
}

add_action('pre_get_posts','wpc_cpt_in_search_services');

/** To display your custom post types on the same category page as your default posts */
function query_post_type($query) {

  if( is_category() ) {
    $post_type = get_query_var('post_type');
    if($post_type)
        $post_type = $post_type;
    else
        $post_type = array('nav_menu_item', 'post', 'services'); // don't forget nav_menu_item to allow menus to work!
    $query->set('post_type',$post_type);
    return $query;
  }
}
add_filter('pre_get_posts', 'query_post_type');
add_action('save_post', 'description_service_save', 10, 2);
add_action('add_meta_boxes', '_namespace_create_metabox_service');


function _namespace_create_metabox_service($post) {

    // Can only be used on a single post type (ie. page or post or a custom post type).
    // Must be repeated for each post type you want the metabox to appear on.
    /*add_meta_box(
        '_namespace_metabox_service', // Metabox ID
        'Options Additionnelles', // Title to display
        '_namespace_render_metabox_service', // Function to call that contains the metabox content
        'services', // Post type to display metabox on
        'side', // Where to put it (normal = main colum, side = sidebar, etc.)
        'high' // Priority relative to other metaboxes
    );*/

    add_meta_box(
        'description', // Metabox ID
        __('Brève Description', 'technum-theme'), // Title to display
        'add_service_description_callback', // Function to call that contains the metabox content
        'services', // Post type to display metabox on
        'side', // Where to put it (normal = main colum, side = sidebar, etc.)
        'default' // Priority relative to other metaboxes
    );

}
//add_action( 'add_meta_boxes', '_namespace_create_metabox_service' );


/**
* Render the metabox markup
* This is the function called in `_namespace_create_metabox()`
*/
function _namespace_render_metabox_service() {
// Variables
global $post; // Get the current post data
$titreContenu = get_post_meta( $post->ID, 'titre_contenu', true ); // Get the saved values

?>


<table>
    
    <tr>
        <td>
            <label for="titre_contenu">
                <?php _e( 'Titre contenu', 'technum-theme' ); ?>
            </label><br/><br/>
        </td>
        <td>
            <input type="text" name="titre_contenu" id="titre_contenu" value="<?php echo esc_attr( $titreContenu ); ?>" style="width:180px;" />
        </td>
       
    </tr>

</table>
    
<?php
// Security field
// This validates that submission came from the
// actual dashboard and not the front end or
// a remote server.
wp_nonce_field( '_namespace_form_metabox_nonce_service', '_namespace_form_metabox_process_service' );

}

/**
* Save the metabox
* @param  Number $post_id The post ID
* @param  Array  $post    The post data
*/
function _namespace_save_metabox_service( $post_id, $post ) {

// Verify that our security field exists. If not, bail.
if ( !isset( $_POST['_namespace_form_metabox_process_service'] ) ) return;

// Verify data came from edit/dashboard screen
if ( !wp_verify_nonce( $_POST['_namespace_form_metabox_process_service'], '_namespace_form_metabox_nonce_service' ) ) {
    return $post->ID;
}

// Verify user has permission to edit post
if ( !current_user_can( 'edit_post', $post->ID )) {
    return $post->ID;
}

// Check that our custom fields are being passed along
// This is the `name` value array. We can grab all
// of the fields and their values at once.
if ( !isset( $_POST['titre_contenu'] ) ) {
    return $post->ID;
}

/**
 * Sanitize the submitted data
 * This keeps malicious code out of our database.
 * `wp_filter_post_kses` strips our dangerous server values
 * and allows through anything you can include a post.
 */
$sanitizedTitreContenu = wp_filter_post_kses( $_POST['titre_contenu'] );
// Save our submissions to the database
update_post_meta( $post->ID, 'titre_contenu', $sanitizedTitreContenu );

}
add_action( 'save_post', '_namespace_save_metabox_service', 1, 2 );

/**
* Save events data to revisions
* @param  Number $post_id The post ID
*/
function _namespace_save_revisions_service( $post_id ) {

// Check if it's a revision
$parent_id = wp_is_post_revision( $post_id );

// If is revision
if ( $parent_id ) {

    // Get the saved data
    $parent = get_post( $parent_id );
    $titreContenu = get_post_meta( $parent->ID, 'titre_contenu', true ); 

    // If data exists and is an array, add to revision
    if ( !empty( $titreContenu ) ) {
        add_metadata( 'post', $post_id, 'titre_contenu', $titreContenu );
    }

}

}
add_action( 'save_post', '_namespace_save_revisions_service' );

/**
* Restore events data with post revisions
* @param  Number $post_id     The post ID
* @param  Number $revision_id The revision ID
*/
function _namespace_restore_revisions_service( $post_id, $revision_id ) {

// Variables
$post = get_post( $post_id ); // The post
$revision = get_post( $revision_id ); // The revision

$titreContenu = get_post_meta( $revision->ID, 'titre_contenu', true ); // The historic version

// Replace our saved data with the old version
update_post_meta( $post_id, 'titre_contenu', $titreContenu );

}
add_action( 'wp_restore_post_revision', '_namespace_restore_revisions_service', 10, 2 );

/**
* Get the data to display on the revisions page
* @param  Array $fields The fields
* @return Array The fields
*/
function _namespace_get_revisions_fields_service( $fields ) {
// Set a title
$fields['titre_contenu'] = 'Titre Contenu ';

return $fields;
}
add_filter( '_wp_post_revision_fields', '_namespace_get_revisions_fields_service' ); 


function description_service_save( $post_id , $post) {
	
	if ($post->post_type != 'services'){
		return;
	}
  // Verify the nonce before proceeding.
    if ( !isset( $_POST['service_description_nonce'] ) || !wp_verify_nonce( $_POST['service_description_nonce'], basename( __FILE__ ) ) )
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

function add_service_description_callback($post, $metabox){
	// Use nonce for verification
	
	wp_nonce_field(basename( __FILE__ ), 'service_description_nonce' );
	$description = get_post_meta( $post->ID, 'description', true ); // Get the saved values

    $category_validation = _e( 'Please select a category!', 'technum-theme' );
  
	  ?>
  
        <script type="text/javascript">
            var category_validation = "<?php echo $category_validation; ?>";
            jQuery(function($) {
                    /********** Form Validation ***********/
                $('form').submit(function(event) {

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



/** Gestion des catégories de services */
function itg_categories_services_section(){

    $args = array(
		//'paged'        => $paged,
		'post_type'   => 'services',
        'post_status' => 'publish',
        'post_parent' => 0,
        'posts_per_page' => -1,
    );
      
    $the_query = get_posts($args);
	
    if (sizeof($the_query) != 0){
?> 
    <section class="py-5">
            <div class="container  mb-5">
                    <h2 class="title"><?php function_exists('pll_e') ? pll_e('Catégories de service') : _e('Catégories de service', 'textdomain'); ?></h2>
            </div>
            <div class="container">
                <div class="jumbotron">
                    <div class="row">
                        <?php
                            foreach($the_query as $post){

                        ?>
                                    <div class="col-md-4 mb-4">
                                        <a class="card shadow" href="<?php echo get_the_permalink($post->ID); ?>" >
                                            <div class="card-inner">
                                                <h3 class="card-title-first mb-3"><?php echo get_the_title($post->ID); ?></h3>
                                                 <?php if ( has_post_thumbnail($post->ID) ) { ?>
                                                <div style="width:100%;">
                                                    <?php echo get_the_post_thumbnail($post->ID, 'aucoeur-size', array('class' => 'card-image', 'alt' => 'Catégories de services')) ?>
                                                </div>
                                                 <?php } ?>
                                            </div>
                                            <div class="card-hover">
                                                <h3 class="card-title-second mb-3"><?php echo get_the_title($post->ID); ?></h3>
                                                <p class="card-text"> 
                                                    <?php echo get_post_meta( $post->ID, 'description', true ); ?>
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                        <?php
                                
                            }
                        ?>   
                    </div>
                </div>
            </div>
        </section>
    <?php
	    wp_reset_postdata();
    }
}
/** Modifier par albert */
function itg_categories_services_section_2(){

    $args = array(
		//'paged'        => $paged,
		'post_type'   => 'services',
        'post_status' => 'publish',
        'post_parent' => 0,
        'posts_per_page' => -1,
    );
      
    $the_query = new WP_Query($args);
	
    if ($the_query->have_posts()){
?> 
    <section class="py-5">
            <div class="container  mb-5">
                    <h2 class="title"><?php function_exists('pll_e') ? pll_e('Catégories de service') : _e('Catégories de service', 'textdomain'); ?></h2>
            </div>
            <div class="container">
                <div class="jumbotron">
                    <div class="row">
                        <?php
                           while($the_query->have_posts()) : $the_query->the_post(); 
                        ?>

                                    <div class="col-md-4 mb-4">
                                        <a class="card shadow" href="<?php the_permalink(); ?>" >
                                            <div class="card-inner">
                                                <h3 class="card-title-first mb-3"><?php the_title(); ?></h3>
                                                 <?php if ( has_post_thumbnail(get_the_id()) ) { ?>
                                                <div style="width:100%;">
                                                    <?php the_post_thumbnail('aucoeur-size', array('class' => 'card-image')); ?>
                                                </div>
                                                 <?php } ?>
                                                 
                                            </div>
                                            <div class="card-hover">
                                                <h3 class="card-title-second mb-3"><?php the_title(); ?></h3>
                                                <p class="card-text"> 
                                                    <?php echo get_post_meta(get_the_id(), 'description', true ); ?>
                                                </p>
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
    }
}
/** End Gestion des catégories de services */

/** Gestion des services */
function itg_liste_services_section(){

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    
    $args = array(
		'paged'        => $paged,
		'post_type'   => 'services',
        'post_parent__not_in' => array(0),
        'post_status' => 'publish',
        "posts_per_page" => 9,
    );
      
    $the_query = new WP_Query($args);

    $check = false;
    while ($the_query->have_posts()) : 
        $the_query->the_post();
        if(get_post(get_the_ID())->post_parent != 0){
            $check = true;
        }
    endwhile;
	
    if ($check) :
?>         
 <div id="searchService">       
        <section class="py-5">
            <div class="container  mb-5">
                <h2 class="title"><?php function_exists('pll_e') ? pll_e('Tous les services') : _e('Tous les services', 'textdomain'); ?></h2>
            </div>
            <div class="container">
                <div class="">
                    <div class="row">
                        <?php 
                           
                            while ($the_query->have_posts()) : $the_query->the_post();
                                if(get_post(get_the_ID())->post_parent != 0){
                        ?>

                                    <div class="col-md-4 mb-4">
                                        <a class="card shadow" href="<?php the_permalink(); ?>" >
                                                <div class="card-inner">
                                                    <h3 class="card-title-first mb-5 "><?php the_title(); ?></h3>
                                                    <p  class="card-title-first-text" style="color: #3D8B0C;">
                                                        <?php
                                                            $categories = get_the_category(get_the_ID());
                                                            foreach($categories as $category){
                                                               echo $category->name.', ';
                                                            }
                                                        ?>
                                                    </p>
                                                    
                                                </div>
                                                <div class="card-hover">
                                                    <h3 class="card-title-second mb-3"><?php the_title(); ?></h3>
                                                    <p class="card-text">
                                                        <?php echo get_post_meta(get_the_id(), 'description', true ); ?>
                                                    </p>
                                                </div>
                                        </a>
                                    </div>

                        <?php
                                }
                               
                            endwhile;
                        ?>   
                   </div>
                </div>
            </div>
            <?php
                if(function_exists("pagination")){
                    pagination($the_query->max_num_pages);
                }
            ?>
        </section>
    </div>
    <?php
	    wp_reset_postdata();
    endif;

}
/** End Gestion des services */

/** Autres expertises section */
function itgs_site_autres_expertises_section($has_parent, $choosedPostId){
?>

        <?php 
            // Vérifie si le service dispose d'un parent (Catégorie de service)
            if($has_parent){

                
                // Affichage des services ne disposants pas d'un parent(Liste des autres services de la même catégorie)
                
                $args = array(
                    'paged'        => $paged,
                    'post_type'   => 'services',
                    'post_status' => 'publish', 
                    'post_parent'  => $choosedPostId,  
                    "posts_per_page" => -1,
                );
                
                $the_query = new WP_Query($args);
            
                
                if ($the_query->have_posts()) :
        ?>
                    <section class="py-5">
                        <div class="container  mb-5">
                            <h2 class="title"><?php function_exists('pll_e') ? pll_e('les services') : _e('les services', 'textdomain'); ?></h2>
                        </div>
                        <div class="container">
                            <div class="">
                                <div class="row">
                                <?php 
                                    while ($the_query->have_posts()) : $the_query->the_post();
                                        if(get_post(get_the_ID())->post_parent != 0){
                                ?>
                                        <div class="col-md-4 mb-4">
                                            <a class="card shadow" href="<?php the_permalink(); ?>" >
                                                    <div class="card-inner">
                                                        <h3 class="card-title-first mb-5 "><?php the_title(); ?></h3>
                                                        <p  class="card-title-first-text" style="color: #3D8B0C;">
                                                            <?php
                                                                $categories = get_the_category(get_the_ID());
                                                                foreach($categories as $category){
                                                                    echo $category->name.', ';
                                                                }
                                                            ?>
                                                        </p>
                                                        
                                                    </div>
                                                    <div class="card-hover">
                                                        <h3 class="card-title-second mb-3"><?php the_title(); ?></h3>
                                                        <p class="card-text">
                                                            <?php echo get_the_excerpt(get_the_ID()); ?>
                                                        </p>
                                                    </div>
                                            </a>
                                        </div>
                                
                                <?php
                                        }
                                    endwhile;
                                ?>    
                                </div>
                            </div>
                        </div>
                        <?php
                            if(function_exists("pagination")){
                                pagination($the_query->max_num_pages);
                            }
                        ?>
                    </section>
        <?php 
                wp_reset_postdata();
                endif;



                // Affichage des autres catégories de service 
                $args = array(
                    //'paged'        => $paged,
                    'post_type'   => 'services',
                    'post_status' => 'publish',
                    'post__not_in' => array($choosedPostId),    
                    'post_parent' => 0,
                    "posts_per_page" => -1,
                );
                
                $the_query =new WP_Query($args);

                if (sizeof($the_query) != 0){

        ?>
                    <section class="py-5">
                        <div class="container  mb-5">
                            <h2 class="title"><?php function_exists('pll_e') ? pll_e('Autres catégories de service') : _e('Autres catégories de service', 'textdomain'); ?></h2>
                        </div>
                        <div class="container">
                            <div class="">
                                <div class="row">

                                    <?php
                                        while ($the_query->have_posts()) : $the_query->the_post();
                                    ?>
                                        <div class="col-md-4 mb-4">
                                            <a class="card shadow" href="<?php the_permalink(); ?>" >
                                                <div class="card-inner">
                                                    <h3 class="card-title-first mb-3"><?php the_title(); ?></h3>
                                                    <?php if ( has_post_thumbnail($post->ID) ) { ?>
                                                    <div style="width:100%;">
                                                        <?php the_post_thumbnail('aucoeur-size', array('class' => 'card-image')); ?>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="card-hover">
                                                    <h3 class="card-title-second mb-3"><?php the_title(); ?></h3>
                                                    <p class="card-text"> <?php echo get_post_meta(get_the_id(), 'description', true ); ?> </p>
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
                }
            } else{
        
        //afficher la categorie parente
         $parent_id = wp_get_post_parent_id(get_the_ID()); 
         $args = array(
            //'paged'        => $paged,
            'post_type'   => 'services',
            'post_status' => 'publish',
            'post__in' => array($parent_id),
            "posts_per_page" => -1,
        );
        
        $the_query =new WP_Query($args);
         ?>
        <section class="py-5">
                        <div class="container  mb-5">
                            <h2 class="title"><?php function_exists('pll_e') ? pll_e('catégorie principale') : _e('catégorie principale', 'textdomain'); ?></h2>
                        </div>
                        <div class="container">
                            <div class="">
                                <div class="row">
                                <?php
                                    while ($the_query->have_posts()) : $the_query->the_post();
                                ?>
                                    <div class="col-md-4 mb-4">
                                        <a class="card shadow" href="<?php the_permalink(); ?>" >
                                            <div class="card-inner">
                                                <h3 class="card-title-first mb-3"><?php the_title(); ?></h3>
                                                <?php if ( has_post_thumbnail($parent_id) ) { ?>
                                                <div style="width:100%;">
                                                    <?php the_post_thumbnail('aucoeur-size', array('class' => 'card-image')); ?>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <div class="card-hover">
                                                <h3 class="card-title-second mb-3"><?php the_title(); ?></h3>
                                                <p class="card-text"> <?php echo get_post_meta(get_the_id(), 'description', true ); ?> </p>
                                            </div>
                                        </a>
                                    </div>
                                <?php endwhile; ?>
                                </div>
                            </div>
                        </div>
                    </section>
                                                 
        <?php 
                wp_reset_postdata();   

                $categories = get_the_category($choosedPostId);
                $categoriesIds = array();

                foreach($categories as $category){
                    array_push($categoriesIds, $category->term_id);
                }
                
                
                $args = array(
                    'paged'        => $paged,
                    'post_type'   => 'services',
                    'post_status' => 'publish',
                    'category__in' => $categoriesIds,  
                    'post__not_in' => array($choosedPostId),    
                    "posts_per_page" => -1,
                    'post_parent' => $parent_id
                );
                
                $the_query = new WP_Query($args);
            
                $check = false;
                while ($the_query->have_posts()) : 
                    $the_query->the_post();
                    if(get_post(get_the_ID())->post_parent != 0){
                        $check = true;
                    }
                endwhile;
                
                if ($check) :
        ?>
                    <section class="py-5">
                        <div class="container  mb-5">
                            <h2 class="title"><?php function_exists('pll_e') ? pll_e('Autres services de la même catégorie') : _e('Autres services de la même catégorie', 'textdomain'); ?></h2>
                        </div>
                        <div class="container">
                            <div class="">
                                <div class="row">
                                <?php 
                                    while ($the_query->have_posts()) : $the_query->the_post();
                                        if(get_post(get_the_ID())->post_parent != 0){
                                ?>
                                        <div class="col-md-4 mb-4">
                                            <a class="card shadow" href="<?php the_permalink(); ?>" >
                                                    <div class="card-inner">
                                                        <h3 class="card-title-first mb-5 "><?php the_title(); ?></h3>
                                                        <p  class="card-title-first-text" style="color: #3D8B0C;">
                                                            <?php
                                                                $categories = get_the_category(get_the_ID());
                                                                foreach($categories as $category){
                                                                    echo $category->name.', ';
                                                                }
                                                            ?>
                                                        </p>
                                                        
                                                    </div>
                                                    <div class="card-hover">
                                                        <h3 class="card-title-second mb-3"><?php the_title(); ?></h3>
                                                        <p class="card-text">
                                                            <?php echo get_the_excerpt(get_the_ID()); ?>
                                                        </p>
                                                    </div>
                                            </a>
                                        </div>
                                
                                <?php
                                        }
                                    endwhile;
                                ?>    
                                </div>
                            </div>
                        </div>
                        <?php
                            if(function_exists("pagination")){
                                pagination($the_query->max_num_pages);
                            }
                        ?>
                    </section>
        <?php 
                wp_reset_postdata();
                endif;
            }
        ?>

<?php
}
/** End expertises section */
?>