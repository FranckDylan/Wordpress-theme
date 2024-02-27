<?php
function wpc_cpt_emplois() {

	/* emplois */
	$labels = array(
		'name'                => _x('Emplois', 'Post Type General Name', 'textdomain'),
		'singular_name'       => _x('Emploi', 'Post Type Singular Name', 'textdomain'),
		'menu_name'           => __('Emplois', 'technum-theme'),
		'name_admin_bar'      => __('Emplois', 'technum-theme'),
		'parent_item_colon'   => __('Parent Emploi:', 'technum-theme'),
		'all_items'           => __('All Jobs', 'technum-theme'),
		'add_new_item'        => __('Add New Job', 'technum-theme'),
		'add_new'             => __('Add New Job', 'technum-theme'),
		'new_item'            => __('New Job', 'technum-theme' ),
		'edit_item'           => __('Edit Job', 'technum-theme'),
		'update_item'         => __('Update Job', 'textdomain'),
		'view_item'           => __('View Job', 'technum-theme'),
		'search_items'        => __('Search Job', 'technum-theme'),
		'not_found'           => __('Not found', 'technum-theme'),
		'not_found_in_trash'  => __('Not found in Trash', 'technum-theme'),
	);
	$rewrite = array(
		'slug'                => _x('jobs', 'Emplois', 'textdomain'),
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => false,
	);
	$args = array(
		'label'               => __('Emploi', 'technum-theme'),
		'description'         => __('Emploi', 'technum-theme'),
		'labels'              => $labels,
		'supports'            => array('title', 'editor', 'revisions', 'thumbnail'),
		'taxonomies'          => array('emplois_type'),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 7,
		'menu_icon'           => 'dashicons-plus',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'query_var'           => 'emplois',
		'rewrite'             => $rewrite,
        'capability_type'     => 'page',
        // This is where we add taxonomies to our CPT
        'taxonomies'          => array( 'category' ),
	);
	register_post_type('emplois', $args);	
}

add_action('init', 'wpc_cpt_emplois', 10);

//Ajout dans les résultats de recherche
function wpc_cpt_in_search_emplois($query) {
  if (! is_admin() && $query->is_main_query()) {
    if ($query->is_search) {
      $query->set('post_type', array('post', 'emplois'));
    }
  }
}

add_action('pre_get_posts','wpc_cpt_in_search_emplois');

//Ajout d'une meta box pour le sticky post
add_action( 'add_meta_boxes', 'meta_box_add_emplois' );
add_action( 'save_post', 'emploi_param_save',10,2);
add_action('save_post', 'emploi_description_save', 10, 2);


function meta_box_add_emplois()
{
  add_meta_box('emploi_param', __('Paramètres Emplois', 'technum-theme') , 'addbox_emplois', 'emplois', 'side', 'low');
  add_meta_box(
	'description', // Metabox ID
	__('Brève Description', 'technum-theme'), // Title to display
	'add_new_box_emplois', // Function to call that contains the metabox content
	'emplois', // Post type to display metabox on
	'side', // Where to put it (normal = main colum, side = sidebar, etc.)
	'default' // Priority relative to other metaboxes
  );
}

function add_new_box_emplois($post, $metabox) {  
	// Use nonce for verification
	
	  wp_nonce_field(basename( __FILE__ ), 'emploi_description_nonce' );
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


function emploi_description_save( $post_id , $post) {
	
	if ($post->post_type != 'emplois'){
		return;
	}
  // Verify the nonce before proceeding.
    if ( !isset( $_POST['emploi_description_nonce'] ) || !wp_verify_nonce( $_POST['emploi_description_nonce'], basename( __FILE__ ) ) )
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


function addbox_emplois($post, $metabox) {  
// Use nonce for verification
  wp_nonce_field( basename( __FILE__ ), 'emploi_param_nonce' );
    ?>
    
	<label><?php echo __('Date Publication', 'technum-theme'); ?> : </label><input name="emploi_date_publication" type="date" value="<?php echo get_post_meta($post->ID, "emploi_date_publication", true); ?>" >
	<br>
	<br>
	<label><?php echo __('Date d\'expiration', 'technum-theme'); ?> : </label><input name="emploi_date_expiration" type="date" value="<?php echo get_post_meta($post->ID, "emploi_date_expiration", true); ?>" >
    
	<br>
	<br>
	<br>
	<br>
	
	<label><?php echo __('Pays', 'textdomain'); ?> :
	<select name="emploi_pays">
		<?php 
			$option_values = array("Cameroun", "France", "Niger");

			foreach($option_values as $key => $value) 
			{
				if($value == get_post_meta($post->ID, "emploi_pays", true))
				{
					?>
						<option selected><?php echo __($value, 'textdomain'); ?></option>
					<?php    
				}
				else
				{
					?>
						<option><?php echo __($value, 'textdomain'); ?></option>
					<?php
				}
			}
		?>
	</select>
	<br>
	<br>
	<label><?php echo __('Ville', 'technum-theme'); ?> : </label><input name="emploi_ville" type="text" value="<?php echo get_post_meta($post->ID, "emploi_ville", true); ?>" >
	
	<br>
	<br>
	<br>
	<br>
	
	<label><input name="emploi_mailto" type="checkbox" <?php if(get_post_meta($post->ID, "emploi_mailto", true)=="on")echo' checked="checked"';?> ><?php echo __('MailTo emploi@itgstore-consulting.com', 'textdomain'); ?></label>
	<br>
	<br>
    <label><?php echo __('Lien', 'technum-theme'); ?> : </label><input name="emploi_lien" type="text" value="<?php echo get_post_meta($post->ID, "emploi_lien", true); ?>" >
	
	<?php
}

function emploi_param_save( $post_id , $post) {
	
	if ($post->post_type != 'emplois'){
		return;
	}
  // Verify the nonce before proceeding.
    if ( !isset( $_POST['emploi_param_nonce'] ) || !wp_verify_nonce( $_POST['emploi_param_nonce'], basename( __FILE__ ) ) )
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
	
    $new_meta_value = ( isset( $_POST['emploi_param'] ) ? sanitize_html_class( $_POST['emploi_param'] ) : '' );

    // Get the meta key.
    $meta_key = 'emploi_param';

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
	
	//***********************************************Enregistrement Date Publication***************
    // Get the posted data and sanitize it for use as an HTML class.
    $new_meta_value = ( isset( $_POST['emploi_date_publication'] ) ? sanitize_html_class( $_POST['emploi_date_publication'] ) : '' );

    // Get the meta key.
    $meta_key = 'emploi_date_publication';

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
	//***********************************************Enregistrement Date expiration***************
    // Get the posted data and sanitize it for use as an HTML class.
    $new_meta_value = ( isset( $_POST['emploi_date_expiration'] ) ? sanitize_html_class( $_POST['emploi_date_expiration'] ) : '' );

    // Get the meta key.
    $meta_key = 'emploi_date_expiration';

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
	//***********************************************Enregistrement ville***************
    // Get the posted data and sanitize it for use as an HTML class.
    $new_meta_value = ( isset( $_POST['emploi_ville'] ) ? $_POST['emploi_ville']  : '' );

    // Get the meta key.
    $meta_key = 'emploi_ville';

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
	//***********************************************Enregistrement Pays***************
    // Get the posted data and sanitize it for use as an HTML class.
    $new_meta_value = ( isset( $_POST['emploi_pays'] ) ? $_POST['emploi_pays'] : '' );

    // Get the meta key.
    $meta_key = 'emploi_pays';

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
	//***********************************************Enregistrement Lien***************
    // Get the posted data and sanitize it for use as an HTML class.
    $new_meta_value = ( isset( $_POST['emploi_lien'] ) ? $_POST['emploi_lien'] : '' );

    // Get the meta key.
    $meta_key = 'emploi_lien';

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
	//***********************************************Enregistrement Lien***************
    // Get the posted data and sanitize it for use as an HTML class.
    $new_meta_value = ( isset( $_POST['emploi_mailto'] ) ? sanitize_html_class( $_POST['emploi_mailto'] ) : '' );

    // Get the meta key.
    $meta_key = 'emploi_mailto';

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

  // save the new value of the dropdown
  //$new_value = $_POST['emploi_param'];
  //update_post_meta( $post_id, 'emploi_param', $new_value );
}


/** liste des recrutements à la page liste des recrutements */
function itg_recrutements_section(){
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    
    $args = array(
		'paged'        => $paged,
        'post_type'   => 'emplois',
        'post_status' => 'publish',
        "posts_per_page" => 5,
    );
      
    $the_query = new WP_Query($args);
	
    if ($the_query->have_posts()) :
?>  

    <div id="searchEmploi">
        <section id="section-evenements" class="py-5">
                <div class="container">
                     
                    <div class="events">

                        <?php 
                           
                           while ($the_query->have_posts()) : $the_query->the_post();
                       ?>
                            <div class="event-card bg-white shadow mb-4">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="event-desc d-flex flex-column justify-content-center h-100 p-3">
                                            <a href="<?php the_permalink(); ?>"><h3><?php echo get_the_title(get_the_ID()); ?></h3></a>
                                            <a href="#">
                                                <p>
                                                    <?php 
                                                        $categories = get_the_category(get_the_ID());
                                                        foreach($categories as $category){
                                                            $category->name.', ';
                                                        }
                                                    ?>
                                                </p>
                                            </a>
                                            <div class="col-md-3 pl-0">
                                                <a href="<?php echo get_site_url().'/index.php/contactez-nous'; ?>" style=" border-radius: 0px; border-color: #3D8B0C ; position: center;  background-color: #3D8B0C; color: #fff;"  class="btn btn-primary justify-content-center d-flex  center-block  mt-2">Postuler</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="event-localisation d-flex flex-column justify-content-center h-100 p-3">
                                            <div class="mb-2"><i class="fas fa-map-marker-alt mr-3"></i><span><?php echo get_post_meta(get_the_ID(), 'emploi_ville', true).', '.get_post_meta(get_the_ID(), 'emploi_pays', true) ; ?></span></div>
                                            <div class="mt-2">
                                                <i class="far fa-clock mr-3"></i>
                                                <span>
                                                    Avant le 
                                                    <?php
                                                        $date = get_post_meta(get_the_ID(), 'emploi_date_expiration', true);
                                                        setlocale(LC_TIME, "fr_FR", "en_EN");
                                                        echo get_locale() == 'fr_FR' ? dateToFrench($date, 'd F Y') : strftime("%d %B %G", strtotime($date)); //%A 
                                                    ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php
                                
                            endwhile;
                        ?>   

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