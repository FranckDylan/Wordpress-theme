<?php

function wpc_cpt_inscription_evenements() {

	/* inscription evenements */
	$labels = array(
		'name'                => _x('Inscriptions Evènements', 'Post Type General Name', 'textdomain'),
		'singular_name'       => _x('Inscription Evènement', 'Post Type Singular Name', 'textdomain'),
		'menu_name'           => __('Inscriptions Evènements', 'technum-theme'),
		'name_admin_bar'      => __('Inscriptions Evènements', 'technum-theme'),
		'parent_item_colon'   => __('Parent Event Inscription:', 'technum-theme'),
		'all_items'           => __('All Events Inscription', 'technum-theme'),
		'add_new_item'        => __('Add New Event Inscription', 'technum-theme'),
		'add_new'             => __('Add New Event Inscription', 'technum-theme'),
		'new_item'            => __('New Event Inscription', 'technum-theme' ),
		'edit_item'           => __('Edit Event Inscription', 'technum-theme'),
		'update_item'         => __('Update Event Inscription', 'technum-theme'),
		'view_item'           => __('View Event Inscription', 'technum-theme'),
		'search_items'        => __('Search Event Inscription', 'technum-theme'),
		'not_found'           => __('Not found', 'technum-theme'),
		'not_found_in_trash'  => __('Not found in Trash', 'technum-theme'),
	);

	$rewrite = array(
		'slug'                => _x('inscription-evenements', 'inscription-evenements', 'textdomain'),
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => false,
	);

	$args = array(
		'label'               => __('Inscription Evènement', 'technum-theme'),
		'description'         => __('Inscription Evènement', 'technum-theme'),
		'labels'              => $labels,
		'supports'            => array('title', 'editor', 'revisions', 'thumbnail'),
		'taxonomies'          => array('inscriptions_type'),
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
		'query_var'           => 'inscriptions',
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);

	register_post_type('inscriptions', $args);	
}

add_action('init', 'wpc_cpt_inscription_evenements', 10);

//Ajout dans les résultats de recherche
function wpc_cpt_in_search_inscription_evenements($query) {

  if (!is_admin() && $query->is_main_query()) {

    if ($query->is_search) {
      $query->set('post_type', array('post', 'inscription-evenements'));
    }

  }

}

add_action('pre_get_posts','wpc_cpt_in_search_inscription_evenements');

//Ajout d'une meta box pour le sticky post
add_action( 'add_meta_boxes', 'meta_box_add_inscription_evenements' );
add_action('save_post', 'add_inscription_save', 10, 2);

function meta_box_add_inscription_evenements() {

  add_meta_box(
	'inscription_event', // Metabox ID
	__('Options Additionnelles', 'technum-theme'), // Title to display
	'box_inscription_evenements', // Function to call that contains the metabox content
	'inscriptions', // Post type to display metabox on
	'side', // Where to put it (normal = main colum, side = sidebar, etc.)
	'high' // Priority relative to other metaboxes
  );

}

function add_inscription_save($post_id , $post) {

    if ($post->post_type != 'inscriptions') {
		return;
	}

    // Verify the nonce before proceeding.
    if (!isset( $_POST['nom_complet_nonce'] ) || !wp_verify_nonce($_POST['nom_complet_nonce'], basename( __FILE__ )))
        return $post_id;

    if (!isset( $_POST['telephone_nonce'] ) || !wp_verify_nonce($_POST['telephone_nonce'], basename( __FILE__ )))
        return $post_id;

    if (!isset( $_POST['email_nonce'] ) || !wp_verify_nonce($_POST['email_nonce'], basename( __FILE__ )))
        return $post_id;
        
    if (!isset( $_POST['entreprise_nonce'] ) || !wp_verify_nonce($_POST['entreprise_nonce'], basename( __FILE__ )))
        return $post_id;

    if (!isset( $_POST['evenement_nonce'] ) || !wp_verify_nonce($_POST['evenement_nonce'], basename( __FILE__ )))
        return $post_id;

    // Get the post type object.
    $post_type = get_post_type_object($post->post_type);

    // Check if the current user has permission to edit the post.
    if (!current_user_can($post_type->cap->edit_post, $post_id))
        return $post_id;

    $champs = array('nom_complet', 'telephone', 'email', 'entreprise', 'evenement');

    foreach($champs as $value) {

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

function box_inscription_evenements($post, $metabox) {

    // Use nonce for verification of nom_complet field
    wp_nonce_field( basename( __FILE__ ), 'nom_complet_nonce' );
    $nomComplet = get_post_meta($post->ID, 'nom_complet', true);

    // Use nonce for verification of telephone field
    wp_nonce_field( basename( __FILE__ ), 'telephone_nonce' );
    $telephone = get_post_meta($post->ID, 'telephone', true);

    // Use nonce for verification of email field
    wp_nonce_field( basename( __FILE__ ), 'email_nonce' );
    $email = get_post_meta($post->ID, 'email', true);

    // Use nonce for verification of entreprise field
    wp_nonce_field( basename( __FILE__ ), 'entreprise_nonce' );
    $entreprise = get_post_meta($post->ID, 'entreprise', true);

    // Use nonce for verification of evenement field
    wp_nonce_field( basename( __FILE__ ), 'evenement_nonce' );
    $evenement = get_post_meta($post->ID, 'evenement', true);

    ?>

        <div>
            <div class="">
                <label style="font-weight: bold;"><?php _e( 'Nom Complet', 'technum-theme' );?>: </label>
                <p> <?php echo $nomComplet; ?> </p>
            </div><br/>
            <div class="">
                <label style="font-weight: bold;"><?php _e( 'Téléphone', 'technum-theme' );?>: </label>
                <p> <?php echo $telephone; ?> </p>
            </div><br/>
            <div class="">
                <label style="font-weight: bold;"><?php _e( 'Email', 'technum-theme' );?>: </label>
                <p> <?php echo $email; ?> </p>
            </div><br/>
            <div class="">
                <label style="font-weight: bold;"><?php _e( 'Entreprise', 'technum-theme' );?>: </label>
                <p> <?php echo $entreprise; ?> </p>
            </div><br/>
            <div class="">
                <label style="font-weight: bold;"><?php _e( 'Evènement', 'technum-theme' );?>: </label>
                <p> <?php echo $evenement; ?> </p>
            </div>
        </div>
        
    <?php
}


function inscription_front_end_form() { ?>

    <form method="POST" action=""> <!--  -->
        <input type="hidden" name="action" value="inscriptions" />
        <input type="text" name="post-type" value="inscriptions" hidden />
        <div class="form-group">
            <label for="formFullName" class="btn-customize"><?php _e( 'Nom Complet', 'technum-theme' );?> *</label>
            <input type="text" name="nom_complet" class="custom-form form-control" id="formFullName" placeholder="<?php _e( 'Nom Complet', 'technum-theme' );?>" required />
        </div>
        <div class="form-group">
            <label for="formTel"><?php _e( 'Tel', 'technum-theme' );?> *</label>
            <input type="text" name="telephone" class="custom-form form-control" id="formTel" placeholder="<?php _e( 'Tel', 'technum-theme' );?>" required />
        </div>
        <div class="form-group">
            <label for="formGroupEmailAdress"><?php _e( 'Email', 'technum-theme' );?> *</label>
            <input type="email" name="email" class="custom-form form-control input-lg" id="formGroupEmailAdress" placeholder="<?php _e( 'Email', 'technum-theme' );?>" required />
        </div>
        <div class="form-group">
            <label for="formGroupEntreprise"><?php _e( 'Entreprise', 'technum-theme' );?> *</label>
            <input type="text" name="entreprise" class="custom-form form-control" id="formGroupEntreprise" placeholder="<?php _e( 'Entreprise', 'technum-theme' );?>" required />
        </div>
        <div class="form-group" >
            <label for="formGroupEvenement"><?php _e( 'Evènement', 'technum-theme' );?> </label>
            <?php
            
                $args = array(
                    'paged'        => $paged,
                    'post_type'   => 'evenements',
                    'post_status' => 'publish',
                    "posts_per_page" => -1,
                );
                

                $the_query = new WP_Query($args);
                
            ?>

            <select name="evenement" class="custom-form form-control" id="formGroupEvenement">
                <option value=""> </option>
                <?php 
                    if ($the_query->have_posts()) :
                        while ($the_query->have_posts()) : $the_query->the_post();
                            $titre = get_the_title(get_the_ID()); 
                            $date = get_post_meta(get_the_ID(), 'event_jour_debut', true);
                            $endDate = strtotime($date);
							if(strtotime(date('Y-m-d')) < $endDate) :  
                ?>
							    <option value="<?php echo $titre; ?>"> <?php echo $titre; ?> </option>
                 
                <?php 
                            endif;
                        endwhile;
                    endif;
                    wp_reset_postdata();
                ?>
            </select>

        </div>
        
        <button style="border-radius: 0px;" type="submit" class="btn btn-primary float-right"><?php _e( 'Soumettre', 'technum-theme' );?></button>
       
    </form>

    <?php

    inscriptionCss();

    if($_POST){
        ty_save_post_data();
    }
}
add_shortcode('inscriptions','inscription_front_end_form');

function ty_save_post_data() {

     // Verify the nonce before proceeding.
    /*if (!isset( $_POST['nom_complet_nonce'] ) || !wp_verify_nonce($_POST['nom_complet_nonce'], basename( __FILE__ ))) {
        print 'Sorry, your fullname nonce did not verify.';
        exit;
    } elseif (!isset( $_POST['telephone_nonce'] ) || !wp_verify_nonce($_POST['telephone_nonce'], basename( __FILE__ ))) {
        print 'Sorry, your phone number nonce did not verify.';
        exit;
    } elseif (!isset( $_POST['email_nonce'] ) || !wp_verify_nonce($_POST['email_nonce'], basename( __FILE__ ))) {
        print 'Sorry, your email nonce did not verify.';
        exit;
    } elseif (!isset( $_POST['entreprise_nonce'] ) || !wp_verify_nonce($_POST['entreprise_nonce'], basename( __FILE__ ))) {
        print 'Sorry, your entreprise nonce did not verify.';
        exit;
    } elseif (!isset( $_POST['evenement_nonce'] ) || !wp_verify_nonce($_POST['evenement_nonce'], basename( __FILE__ ))) {
        print 'Sorry, your evenement nonce did not verify.';
        exit;
    } else { */

        if (isset ($_POST['nom_complet'])) {
            $nomComplet =  $_POST['nom_complet'];
        } else {
            echo _e( 'Please enter a fullname', 'technum-theme' );
            exit;
        }

        if (isset ($_POST['telephone'])) {
            $telephone = $_POST['telephone'];
        } else {
            echo _e( 'Please enter the phone number', 'technum-theme' );
            exit;
        }

        if (isset ($_POST['email'])) {
            $email = $_POST['email'];
        } else {
            echo _e( 'Please enter the email', 'technum-theme' );
            exit;
        }

        if (isset ($_POST['entreprise'])) {
            $entreprise = $_POST['entreprise'];
        } else {
            echo _e( 'Please enter the enterprise', 'technum-theme' );
            exit;
        }

        if (isset ($_POST['evenement'])) {
            $evenement = $_POST['evenement'];
        } else {
            echo _e( 'Please enter the event', 'technum-theme' );
            exit;
        }

        $description = $nomComplet.' '.$entreprise.' '.$evenement;


        $post = array(
            'post_title' => $nomComplet. ' - '. $evenement,
            'post_content' => $description,
           // 'post_category' => $_POST['cat'], 
           // 'tags_input' => $tags,
            'post_status' => 'publish', 
            'post_type' => 'inscriptions' ,
            'meta_input' => array(
                'nom_complet' => $nomComplet,
                'telephone' => $telephone,
                'email' => $email,
                'entreprise' => $entreprise,
                'evenement' => $evenement,
            ) 
        );

        $post_id = wp_insert_post($post);

        if($post_id) {
            echo _e( 'Inscription réussit !', 'technum-theme' );
        }

        // $location = home_url(); 

        // echo "<meta http-equiv='refresh' content='0;url=$location' />";
       // exit;
   // } // end IF

}
