<?php

function wpc_cpt_evenements() {

	/* evenements */
	$labels = array(
		'name'                => _x('Evènements', 'Post Type General Name', 'textdomain'),
		'singular_name'       => _x('Evènement', 'Post Type Singular Name', 'textdomain'),
		'menu_name'           => __('Evènements', 'technum-theme'),
		'name_admin_bar'      => __('Evènements', 'technum-theme'),
		'parent_item_colon'   => __('Parent Event:', 'technum-theme'),
		'all_items'           => __('All Events', 'technum-theme'),
		'add_new_item'        => __('Add New Event', 'technum-theme'),
		'add_new'             => __('Add New Event', 'technum-theme'),
		'new_item'            => __('New Event', 'technum-theme' ),
		'edit_item'           => __('Edit Event', 'technum-theme'),
		'update_item'         => __('Update Event', 'technum-theme'),
		'view_item'           => __('View Event', 'technum-theme'),
		'search_items'        => __('Search Event', 'technum-theme'),
		'not_found'           => __('Not found', 'technum-theme'),
		'not_found_in_trash'  => __('Not found in Trash', 'technum-theme'),
	);
	$rewrite = array(
		'slug'                => _x('evenements', 'evenements', 'textdomain'),
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => false,
	);
	$args = array(
		'label'               => __('Evènement', 'technum-theme'),
		'description'         => __('Evènement', 'technum-theme'),
		'labels'              => $labels,
		'supports'            => array('title', 'editor', 'revisions', 'thumbnail'),
		'taxonomies'          => array('evenements_type'),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 7,
		'menu_icon'           => 'dashicons-calendar-alt',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'query_var'           => 'evenements',
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type('evenements', $args);	
}

add_action('init', 'wpc_cpt_evenements', 10);

//Ajout dans les résultats de recherche
function wpc_cpt_in_search_evenements($query) {
  if (! is_admin() && $query->is_main_query()) {
    if ($query->is_search) {
      $query->set('post_type', array('post', 'evenements'));
    }
  }
}

add_action('pre_get_posts','wpc_cpt_in_search_evenements');

//Ajout d'une meta box pour le sticky post
add_action( 'add_meta_boxes', 'meta_box_add_evenements' );
add_action( 'save_post', 'evenement_param_save',10,2);
add_action('save_post', 'add_partenaire_save', 10, 2);
add_action('save_post', 'description_evenement_save', 10, 2);
add_action('save_post', 'save_event_sector_meta_box_data', 10, 2);


function meta_box_add_evenements()
{
  add_meta_box('evenement_param', __('Paramètres evenements', 'technum-theme') , 'addbox_evenements', 'evenements', 'normal', 'high');
  add_meta_box(
	'partenaire_id', // Metabox ID
	__('Origine de l\'évènement', 'technum-theme'), // Title to display
	'box_join_new_partenaires', // Function to call that contains the metabox content
	'evenements', // Post type to display metabox on
	'side', // Where to put it (normal = main colum, side = sidebar, etc.)
	'high' // Priority relative to other metaboxes
  );

  add_meta_box(
    'description', // Metabox ID
    __('Brève Description', 'technum-theme'), // Title to display
    'add_evenement_description_callback', // Function to call that contains the metabox content
    'evenements', // Post type to display metabox on
    'side', // Where to put it (normal = main colum, side = sidebar, etc.)
    'default' // Priority relative to other metaboxes
  );

  add_meta_box(
    'event_related_sector_box',
    __('Secteur associés', 'technum-theme'),
    'draw_event_sector_box',
    'evenements',
    'side', 
    'default'
  );

}

function draw_event_sector_box($post, $metabox){

    // Recupère toutes les catégories de services
    $args = array(
		//'paged'        => $paged,
		'post_type'   => 'services',
        'post_status' => 'publish',
        'post_parent' => 0,
        'posts_per_page' => -1,
    );
      
    $all_sectors = get_posts($args);

    $linked_sector_ids = get_event_sector_ids( $post->ID );

    if ( 0 == count($all_sectors) ) {
        $choice_block = '<p>'. _e('No sector found in the system', 'technum-theme') .'.</p>';
    } else {
        $choices = array();
        foreach ( $all_sectors as $sector ) {
            $checked = ( in_array( $sector->ID, $linked_sector_ids ) ) ? ' checked="checked"' : '';

            $display_name = esc_attr( $sector->post_title );
            array_push($choices,
                '<label><input type="checkbox" name="sector_ids[]" value="'.$sector->ID.'"'. $checked .'/>'. $display_name .'</label><br/>'
            );

        }
        $choice_block = implode("\r\n", $choices);
    }

    # Make sure the user intended to do this.
    wp_nonce_field(
        'updating_'.$post->post_type.'_meta_fields',
        $post->post_type . '_meta_nonce'
    );

    echo $choice_block;

}

function get_event_sector_ids($event_id = 0){

    $ids = array();
    if ( 0 < $event_id ) {
        $args = array(
            'post_type' => 'services',
            'posts_per_page' => -1,
            'order' => 'ASC',
            'post_parent' => 0,
            'orderby' => 'title',
            'meta_query' => array(
                array(
                    'key' => '_event_id',
                    'value' => (int)$event_id,
                    'type' => 'NUMERIC',
                    'compare' => '='
                )
            )
        );
        $results = new \WP_Query( $args );
        if ( $results->have_posts() ) {
            while ( $results->have_posts() ) {
                $item = $results->next_post();
                if ( !in_array($item->ID, $ids) ) {
                    array_push($ids, $item->ID);
                }
            }
        }
    }
    return $ids;

}

/** Sauvegarde des données issus de la jointure one to many entre evenement et categorie de service */
function save_event_sector_meta_box_data($post_id , $post){

    $do_save = true;
    $post_ID = 'post_ID';
    $_already_saved = false; 

    $allowed_post_types = array(
        'evenements'
    );

    # Do not save if we have already saved our updates
    if ( $_already_saved ) {
        $do_save = false;
    }

    # Do not save if there is no post id or post
    if ( empty($post_id) || empty( $post ) ) {
        $do_save = false;
    } else if ( ! in_array( $post->post_type, $allowed_post_types ) ) {
        $do_save = false;
    }

    # Do not save for revisions or autosaves
    if (
        defined('DOING_AUTOSAVE')
        && (
            is_int( wp_is_post_revision( $post ) )
            || is_int( wp_is_post_autosave( $post ) )
        )
    ) {
        $do_save = false;
    }

    # Make sure proper post is being worked on
    if ( !isset($_POST[$post_ID]) || $_POST[$post_ID] != $post_id) {  
        $do_save = false;
    }

    # Make sure we have the needed permissions to save [ assumes both types use edit_post ]
    if ( !current_user_can( 'edit_post', $post_id ) ) {
        $do_save = false;
    }

    # Make sure the nonce and referrer check out.
    $nonce_field_name = $post->post_type . '_meta_nonce';
    if ( !array_key_exists( $nonce_field_name, $_POST) ) {
        $do_save = false;
    } else if ( !wp_verify_nonce( $_POST[$nonce_field_name], 'updating_'.$post->post_type.'_meta_fields' ) ) {
        $do_save = false;
    } else if ( !check_admin_referer( "updating_{$post->post_type}_meta_fields", $nonce_field_name ) ) {
        $do_save = false;
    }

    if ( $do_save ) {
        switch ( $post->post_type ) {
            case "evenements":
                handle_event_sector_meta_changes( $post_id, $_POST );
                break;
            default:
                # We do nothing about other post types
                break;
        }

        # Note that we saved our data
        $_already_saved = true;
    }
    return;


}


function handle_event_sector_meta_changes( $post_id = 0, $data = array() ) {


    # META BOX - Related sponsors
    $sector_Ids = 'sector_ids';

    # Get the currently linked sponsors for this author
    $linked_sector_ids = get_event_sector_ids( $post_id );

    # Get the list of sponsors checked by the user
    if ( isset($data[$sector_Ids]) && is_array( $data ) ) {
        $chosen_sector_ids = $data[$sector_Ids];
    } else {
        $chosen_sector_ids = array();
    }

    # Build a list of sponsors to be linked or unlinked from this event
    $to_remove = array();
    $to_add = array();

    if ( 0 < count( $chosen_sector_ids ) ) {
        # The user chose at least one sponsor to link to
        if ( 0 < count( $linked_sector_ids ) ) {
            # We already had at least one sponsor linked

            # Cycle through existing and note any that the user did not have checked
            foreach ( $linked_sector_ids as $sector_id ) {
                if ( ! in_array( $sector_id, $chosen_sector_ids ) ) {
                    # Currently linked, but not chosen. Remove it.
                    array_push($to_remove, $sector_id);
                }
            }

            # Cycle through checked and note any that are not currently linked
            foreach ( $chosen_sector_ids as $sector_id ) {
                if ( ! in_array( $sector_id, $linked_sector_ids ) ) {
                    # Chosen but not in currently linked. Add it.
                    array_push($to_add, $sector_id);
                }
            }

        } else {
            # No previously chosen ids, simply add them all
            $to_add = $chosen_sector_ids;
        }

    } else if ( 0 < count( $linked_sector_ids ) ) {
        # No properties chosen to be linked. Remove all currently linked.
        $to_remove = $linked_sector_ids;
    }

    if ( 0 < count($to_add) ) {
        foreach ( $to_add as $sector_id ) {
            # We use add post meta with 4th parameter false to let us link
            # sponsor to as many events as we want.
            add_post_meta( $sector_id, '_event_id', $post_id, false );
        }
    }

    if ( 0 < count( $to_remove ) ) {
        foreach ( $to_remove as $sector_id ) {
            # We specify parameter 3 as we only want to delete the link
            # to this event
            delete_post_meta( $sector_id, '_event_id', $post_id );
        }
    }
}


function add_partenaire_save($post_id , $post){

    if ($post->post_type != 'evenements'){
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

function description_evenement_save( $post_id , $post) {
	
	if ($post->post_type != 'evenements'){
		return;
	}
  // Verify the nonce before proceeding.
    if ( !isset( $_POST['evenement_description_nonce'] ) || !wp_verify_nonce( $_POST['evenement_description_nonce'], basename( __FILE__ ) ) )
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

function add_evenement_description_callback($post, $metabox){
	// Use nonce for verification
	
	wp_nonce_field(basename( __FILE__ ), 'evenement_description_nonce' );
	$description = get_post_meta( $post->ID, 'description', true ); // Get the saved values
  
	  ?>
  
	  <div>
		  <label for="description">
			  <?php _e( 'Description', 'description' );?>
		  </label><br/>
		  <textarea name="description" id="description" rows="6" style="width:100%;"><?php echo esc_attr( $description ); ?> </textarea>
	  </div>
		  
	  <?php
}


function box_join_new_partenaires($post, $metabox){

    // Use nonce for verification
    wp_nonce_field( basename( __FILE__ ), 'ispartenaire_nonce' );
    $entered = get_post_meta($post->ID, 'ispartenaire', true);
    ?>
    <label><input id="ispartenaire" name="ispartenaire" type="checkbox"<?php if($entered=="on")echo' checked="checked"';?> ><?php echo __('Evènement avec un partenaitre ?', 'textdomain'); ?></label>
    <?php

    wp_nonce_field(basename( __FILE__ ), 'partenaire_id_nonce' );
    $partenaireId = get_post_meta( $post->ID, 'partenaire_id', true ); // Get the saved values

    ?>

    <div id="partenaire-choice">
        <label for="partenaire_id">
            <?php _e( 'Partenaire', 'partenaire' );?>
        </label><br/>
        <select name="partenaire_id" id="partenaire_id" style="width: 80%;">
            <option > </option>
            <?php
            
            $args = array(  
                'post_type' => 'partenaires',
                'orderby' => 'title', 
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

function addbox_evenements($post, $metabox) {  
// Use nonce for verification
  wp_nonce_field( basename( __FILE__ ), 'evenement_param_nonce' );
  echo get_post_meta($post->ID, "event_heure_fin", true);
    ?>
    <table style="width:100%">
	<tr>
		<td><label><?php echo __('Jour de debut', 'textdomain'); ?> : </label></td>
		<td><input name="event_jour_debut" id="event_jour_debut" type="date" style="width:220px;" value="<?php echo get_post_meta($post->ID, "event_jour_debut", true); ?>" ></td>
		<td></td>
		<td></td>
		<td><label><?php echo __('Heure de debut', 'textdomain'); ?> : </label></td>
		<td><input name="event_heure_debut" type="time" style="width:220px;" value="<?php echo get_post_meta(get_the_ID(), "event_heure_debut", true); ?>" ><td>
	</tr>
	<tr>
		<td><label><?php echo __('Jour de fin', 'textdomain'); ?> : </label></td>
		<td><input name="event_jour_fin" id="event_jour_fin" type="date" style="width:220px;" value="<?php echo get_post_meta($post->ID, "event_jour_fin", true); ?>" ></td>
		<td></td>
		<td></td>
		<td><label><?php echo __('Heure de fin', 'textdomain'); ?> : </label></td>
		<td><input name="event_heure_fin" type="time" style="width:220px;" value="<?php echo get_post_meta($post->ID, "event_heure_fin", true); ?>" ></td>
    </tr>
	<tr>
		<td><label><?php echo __('Pays', 'textdomain'); ?> :</label></td>
		<td><select name="event_pays" style="width:220px;">
			<?php 
				$option_values = array("Cameroun", "France", "Niger","Congo","Tchad","Maroc","Nigéria");

				foreach($option_values as $key => $value) 
				{
					if($value == get_post_meta($post->ID, "event_pays", true))
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
		</select></td>
		<td></td>
		<td></td>
		<td><label><?php echo __('Ville', 'textdomain'); ?> : </label></td>
		<td><input name="event_ville" type="text" style="width:220px;" value="<?php echo get_post_meta($post->ID, "event_ville", true); ?>" ></td>
	</tr>
	<tr>
        <td><label><?php echo __('Lieu de l\'évènement', 'textdomain'); ?> : </label></td>
		<td><input name="event_lieu" type="text" style="width:220px;" value="<?php echo get_post_meta($post->ID, "event_lieu", true); ?>" ></td>
		<td></td>
		<td></td>
		<td><label><?php echo __('Lien d\'inscription', 'textdomain'); ?> : </label></td>
		<td><input name="event_lien" type="text" style="width:220px;" value="<?php echo get_post_meta($post->ID, "event_lien", true); ?>" ></td>
    </tr>
    <tr>
        <td><label><?php echo __('MailTo evenement@itgstore-consulting.com', 'textdomain'); ?></label></td>
		<td><input name="event_mailto" type="checkbox" <?php if(get_post_meta($post->ID, "event_mailto", true)=="on")echo' checked="checked"';?> ></td>		
       
    </tr>
	</table>
	<?php
}

function evenement_param_save( $post_id , $post) {
	
	if ($post->post_type != 'evenements'){
		return;
	}
  // Verify the nonce before proceeding.
    if ( !isset( $_POST['evenement_param_nonce'] ) || !wp_verify_nonce( $_POST['evenement_param_nonce'], basename( __FILE__ ) ) )
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
    
    $list_of_fields = array('evenement_param', 'event_lieu', 'event_mailto', 'event_jour_debut', 'event_jour_fin', 'event_lien', 'event_heure_debut', 'event_heure_fin', 'event_ville', 'event_pays');
    
   
    foreach($list_of_fields as $field){

        //***********************************************Enregistrement ***************
        // Get the posted data and sanitize it for use as an HTML class.
        $new_meta_value = ( isset( $_POST[$field] ) ?  $_POST[$field]  : '' );

        // Get the meta key.
        $meta_key = $field;

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

}


/** Liste des évènements dans la page de détail d'un partenaire */
function itgstore_partenaire_evenements_section($slug) {

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    

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
            'post_type' => 'evenements',
            //"posts_per_page" => 5,
            'nopaging' => true, 
            'meta_query'=> array(
				
			),
            'meta_query'=> array(
                'date_debut' => array(
                    'key' => 'event_jour_debut',
                    'compare' => 'EXISTS'
                ),
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
            ),
            'order_by' => 'date_debut'
			
		);
	endif;

	$the_query = new WP_Query($args);
	
				if ($the_query->have_posts()) :
	?>
	<section id="section-evenements" class="py-5">
        <div class="container">
            <div class="mb-5">
                <h2 class=""><?php function_exists('pll_e') ? pll_e('Evenements') : _e('Evenements', 'textdomain'); ?></h2>
                <p class="sect-desc"><?php echo get_theme_mod('evenements_front_text_setting'); ?></p>
            </div>
            <div class="events">
			<?php
						
					while ($the_query->have_posts()) : $the_query->the_post();
				?>
					<div class="event-card bg-white shadow-sm mb-4">
						<div class="row">
							<div class="col-md-2">
								<div class="event-date d-flex justify-content-center align-items-center">
									<span>
                                            <?php 
                                                $date = get_post_meta(get_the_ID(), 'event_jour_debut', true);
                                                setlocale(LC_TIME, "fr_FR", "en_EN");
                                                echo get_locale() == 'fr_FR' ? dateToFrench($date, 'd F Y') : strftime("%d %B", strtotime($date)); //%A 
                                            ?>
                                    </span>
								</div>
							</div>
							<div class="col-md-7">
								<div class="event-desc d-flex flex-column justify-content-center h-100 p-3">
									<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
                                    <?php 
                                        $endDate = strtotime($date);
										if(strtotime(date('Y-m-d')) < $endDate) :  
                                            $pageTitle = get_locale() == 'fr_FR' ? 'Inscription aux évènements' : 'Events Registration';
                                            $pageCheck = get_page_by_title($pageTitle);
                                    ?>
									    <a href="<?php echo get_the_permalink($pageCheck->ID); ?>"><p><?php function_exists('pll_e') ? pll_e('Inscription à l\'evenement') : _e('Inscription à l\'evenement', 'textdomain'); pll_e( 'Inscription à l\'evenement' )?></p></a>
                                    <?php endif ?>
                                </div>
							</div>
							<div class="col-md-3">
								<div class="event-localisation d-flex flex-column justify-content-center h-100 p-3">
									<div class="mb-2"><i class="fa fa-map-marker-alt mr-3"></i><span><?php echo get_post_meta(get_the_ID(), "event_ville", true);  ?></span></div>
									<div class="mt-2"><i class="far fa-clock mr-3"></i><span><?php echo get_post_meta(get_the_ID(), "event_heure_debut", true);  ?></span></div>
								</div>
							</div>
						</div>
					</div>
				<?php
					endwhile;
			
			?>
		</div>
        </div>
    </section>
	<?php
	wp_reset_postdata();
	endif;
}


/** Liste des évènements à la page liste des évènements */
function itg_evenements_section(){
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    
    $args = array(
		'paged'        => $paged,
        'post_type'   => 'evenements',
        'post_status' => 'publish',
        "posts_per_page" => 6,
    );
    

    $the_query = new WP_Query($args);
	
    if ($the_query->have_posts()) :
?>  

<div id="searchEvent">
        <section id="section-evenements" class="py-5">
                <div class="container">
                     
                    <div class="events">

                        <?php 
                           
                           while ($the_query->have_posts()) : $the_query->the_post();
                       ?>

                            <div class="event-card bg-white shadow mb-4">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="event-date d-flex justify-content-center align-items-center">
                                            <span>
                                                <?php 
                                                    $date = get_post_meta(get_the_ID(), 'event_jour_debut', true);
                                                    setlocale(LC_TIME, "fr_FR", "en_EN");
                                                    echo get_locale() == 'fr_FR' ? dateToFrench($date, 'd F Y') : strftime("%d %B", strtotime($date)); //%A 
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="event-desc d-flex flex-column justify-content-center h-100 p-3">
                                            <a href="<?php the_permalink(); ?>"><h3><?php echo get_the_title(get_the_ID()); ?></h3></a>
                                            
                                            <?php 
                                                $endDate = strtotime($date);
                                                if(strtotime(date('Y-m-d')) < $endDate) : 
                                                    $pageTitle = get_locale() == 'fr_FR' ? 'Inscription aux évènements' : 'Events Registration';
                                                    $pageCheck = get_page_by_title($pageTitle);
                                            ?>
                                              <a href="<?php echo get_the_permalink($pageCheck->ID); ?>"><p><?php function_exists('pll_e') ? pll_e('Inscription à l\'evenement') : _e('Inscription à l\'evenement', 'textdomain'); ?></p></a>
                                            <?php endif ?>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="event-localisation d-flex flex-column justify-content-center h-100 p-3">
                                            <div class="mb-2"><i class="fas fa-map-marker-alt mr-3"></i><span><?php echo get_post_meta(get_the_ID(), 'event_ville', true); ?></span></div>
                                            <div class="mt-2"><i class="far fa-clock mr-3"></i><span><?php echo get_post_meta(get_the_ID(), 'event_heure_debut', true); ?></span></div>
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

