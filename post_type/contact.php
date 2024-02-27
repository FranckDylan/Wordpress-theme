<?php

   /**
     * Create the metabox
     * @link https://developer.wordpress.org/reference/functions/add_meta_box/
     */
    function _namespace_create_metabox($post) {

            // Can only be used on a single post type (ie. page or post or a custom post type).
            // Must be repeated for each post type you want the metabox to appear on.
            add_meta_box(
                '_namespace_metabox', // Metabox ID
                __('Paramètres page', 'technum-theme'), // Title to display
                '_namespace_render_metabox', // Function to call that contains the metabox content
                'page', // Post type to display metabox on
                'normal', // Where to put it (normal = main colum, side = sidebar, etc.)
                'default' // Priority relative to other metaboxes
            );

            // To add the metabox to a page, too, you'd repeat it, changing the location
            add_meta_box( '_namespace_metabox', 'Paramètres page', '_namespace_render_metabox', 'page', 'normal', 'default' // Priority relative to other metaboxes 
            );

    }
    add_action( 'add_meta_boxes', '_namespace_create_metabox' );


    /**
     * Render the metabox markup
     * This is the function called in `_namespace_create_metabox()`
     */
    function _namespace_render_metabox() {
        // Variables
        global $post; // Get the current post data
        $sousTitre = get_post_meta( $post->ID, 'sous_titre', true ); // Get the saved values
        $titreContenu = get_post_meta( $post->ID, 'titre_contenu', true ); // Get the saved values
        $imageLeft = get_post_meta( $post->ID, 'image_left', true ); // Get the saved values
        $contactForm = get_post_meta( $post->ID, 'contact_form', true ); // Get the saved values

        ?>


        <table>
            <tr>
                <td>
                    <label for="sous_titre">
                        <?php _e( 'Sous titre', 'sous_titre' );?>
                    </label>
                </td>
                <td>
                    <input
                        type="text"
                        name="sous_titre"
                        id="sous_titre"
                        value="<?php echo esc_attr( $sousTitre ); ?>" style="width:300px;" />
                </td>
                <td>
                    <label for="contact_form">
                        <?php _e( 'Identifiant du formulaire de contact', 'contact_form' ); ?>
                    </label>
                </td><br/>
                <td>
                    <input type="text" name="contact_form" id="contact_form" value="<?php echo esc_attr( $contactForm ); ?>" style="width:300px;" />
                </td>
            </tr>
            <br/><br/>
            <tr>
                <td>
                    <label for="titre_contenu">
                        <?php _e( 'Titre contenu', 'titre_contenu' ); ?>
                    </label>
                </td>
                <td>
                    <input type="text" name="titre_contenu" id="titre_contenu" value="<?php echo esc_attr( $titreContenu ); ?>" style="width:300px;" />
                </td>

                <td>
                    <label for="image_left">
                        <?php _e( 'Image Left', 'image_left' );?>
                    </label>
                </td>
                <td>
                    <div id="upload_image"> </div>
                    <?php if($imageLeft){ ?>
                        <img src="<?php echo $imageLeft; ?>"  height="150" width="250"/> <br/><br/>
                    <?php } ?>
                    <a href="#" class="aw_upload_image_button button button-secondary"><?php _e('Upload Image'); ?></a>
                </td> 
                <td hidden><input type="text" name="image_left" id="image_left" value="<?php echo $imageLeft; ?>" style="width:500px;" /></td>
            </tr>
        </table>
	        
        <?php
        // Security field
        // This validates that submission came from the
        // actual dashboard and not the front end or
        // a remote server.
        wp_nonce_field( '_namespace_form_metabox_nonce', '_namespace_form_metabox_process' );
        
    }

    /**
     * Save the metabox
     * @param  Number $post_id The post ID
     * @param  Array  $post    The post data
     */
    function _namespace_save_metabox( $post_id, $post ) {

        // Verify that our security field exists. If not, bail.
        if ( !isset( $_POST['_namespace_form_metabox_process'] ) ) return;

        // Verify data came from edit/dashboard screen
        if ( !wp_verify_nonce( $_POST['_namespace_form_metabox_process'], '_namespace_form_metabox_nonce' ) ) {
            return $post->ID;
        }

        // Verify user has permission to edit post
        if ( !current_user_can( 'edit_post', $post->ID )) {
            return $post->ID;
        }

        // Check that our custom fields are being passed along
        // This is the `name` value array. We can grab all
        // of the fields and their values at once.
        if ( !isset( $_POST['sous_titre'] ) ) {
            return $post->ID;
        }
        if ( !isset( $_POST['titre_contenu'] ) ) {
            return $post->ID;
        }
        if ( !isset( $_POST['contact_form'] ) ) {
            return $post->ID;
        }
  


        /**
         * Sanitize the submitted data
         * This keeps malicious code out of our database.
         * `wp_filter_post_kses` strips our dangerous server values
         * and allows through anything you can include a post.
         */
        $sanitized = wp_filter_post_kses( $_POST['sous_titre'] );
        $sanitizedTitreContenu = wp_filter_post_kses( $_POST['titre_contenu'] );
        $sanitizedContactForm = wp_filter_post_kses( $_POST['contact_form'] );
        //$sanitizedImageLeft = wp_filter_post_kses( $_POST['image_left'] );
        // Save our submissions to the database
        update_post_meta( $post->ID, 'sous_titre', $sanitized );
        update_post_meta( $post->ID, 'titre_contenu', $sanitizedTitreContenu );
        update_post_meta( $post->ID, 'contact_form', $sanitizedContactForm );
        //update_post_meta( $post->ID, 'image_left', $sanitizedImageLeft );

    }
    add_action( 'save_post', '_namespace_save_metabox', 1, 2 );

    /**
     * Save events data to revisions
     * @param  Number $post_id The post ID
     */
    function _namespace_save_revisions( $post_id ) {

        // Check if it's a revision
        $parent_id = wp_is_post_revision( $post_id );

        // If is revision
        if ( $parent_id ) {

            // Get the saved data
            $parent = get_post( $parent_id );
            $sousTitre = get_post_meta( $parent->ID, 'sous_titre', true ); 
            $titreContenu = get_post_meta( $parent->ID, 'titre_contenu', true ); 
            $imageLeft = get_post_meta( $parent->ID, 'image_left', true ); 
            $contactForm = get_post_meta( $parent->ID, 'contact_form', true ); 

            // If data exists and is an array, add to revision
            if ( !empty( $sousTitre ) ) {
                add_metadata( 'post', $post_id, 'sous_titre', $sousTitre );
            }
            if ( !empty( $titreContenu ) ) {
                add_metadata( 'post', $post_id, 'titre_contenu', $titreContenu );
            }
            if ( !empty( $imageLeft ) ) {
                add_metadata( 'post', $post_id, 'image_left', $imageLeft );
            }
            if ( !empty( $contactForm ) ) {
                add_metadata( 'post', $post_id, 'contact_form', $contactForm );
            }

        }

    }
    add_action( 'save_post', '_namespace_save_revisions' );

    /**
     * Restore events data with post revisions
     * @param  Number $post_id     The post ID
     * @param  Number $revision_id The revision ID
     */
    function _namespace_restore_revisions( $post_id, $revision_id ) {

        // Variables
        $post = get_post( $post_id ); // The post
        $revision = get_post( $revision_id ); // The revision

        $sousTitre = get_post_meta( $revision->ID, 'sous_titre', true ); // The historic version
        $titreContenu = get_post_meta( $revision->ID, 'titre_contenu', true ); // The historic version
        $imageLeft = get_post_meta( $revision->ID, 'image_left', true ); // The historic version
        $contactForm = get_post_meta( $revision->ID, 'contact_form', true ); // The historic version

        // Replace our saved data with the old version
        update_post_meta( $post_id, 'sous_titre', $sousTitre );
        update_post_meta( $post_id, 'titre_contenu', $titreContenu );
        update_post_meta( $post_id, 'image_left', $imageLeft );
        update_post_meta( $post_id, 'contact_form', $contactForm );
      
    }
    add_action( 'wp_restore_post_revision', '_namespace_restore_revisions', 10, 2 );

    /**
     * Get the data to display on the revisions page
     * @param  Array $fields The fields
     * @return Array The fields
     */
    function _namespace_get_revisions_fields( $fields ) {
        // Set a title
        $fields['sous_titre'] = 'Sous Titre ';
        $fields['titre_contenu'] = 'Titre Contenu ';
        $fields['image_left'] = 'Image Left ';
        $fields['contact_form'] = 'Identifiant du formulaire de contact ';
       
        return $fields;
    }
    add_filter( '_wp_post_revision_fields', '_namespace_get_revisions_fields' ); 

    function aw_include_script() {
 
        if ( ! did_action( 'wp_enqueue_media' ) ) {
            wp_enqueue_media();
        }
      
        wp_enqueue_script( 'awscript', get_stylesheet_directory_uri() . '/asset/js/awscript.js', array('jquery'), null, false );
    }
    add_action( 'admin_enqueue_scripts', 'aw_include_script' );

    function aw_save_postdata($post_id){

        if (array_key_exists('image_left', $_POST)) {
            update_post_meta(
                $post_id,
                'image_left',
                $_POST['image_left']
            );
        }
    }
    add_action('save_post', 'aw_save_postdata');


    /** Section nous écrire */

    /** End section nous écrire */

    /** Section nos agences */

    /** End section nos agences */