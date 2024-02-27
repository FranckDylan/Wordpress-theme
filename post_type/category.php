<?php
/** Gestion de l'ajout d'un champ de chargement de la feautured image sur une catégorie */
    
    add_action('init', 'my_category_module');

    function my_category_module() {
        add_action ( 'edit_category_form_fields', 'add_image_cat');
        add_action ( 'edited_category', 'save_image');
    }

    function add_image_cat($tag){

        $category_images = get_option( 'category_images' );
        $category_image = '';

        if ( is_array( $category_images ) && array_key_exists( $tag->term_id, $category_images ) ) {
            $category_image = $category_images[$tag->term_id] ;
        }
        ?>
        <tr>
            <th scope="row" valign="top"><label for="auteur_revue_image">Image</label></th>
            <td>
                <?php
                    if ($category_image !=""){
                ?>
                        <img src="<?php echo $category_image;?>" alt="" title=""/>
                <?php
                    }
                ?>

                <br/>
                <input type="text" name="category_image" id="category_image" value="<?php echo $category_image; ?>"/><br />
                <span>This field allows you to add a picture to illustrate the category. Upload the image from the media tab WordPress and paste its URL here.</span>
            </td>
        </tr>
        <?php
    }

    function save_image($term_id){

        if ( isset( $_POST['category_image'] ) ) {

            //load existing category featured option
            $category_images = get_option( 'category_images' );
            //set featured post ID to proper category ID in options array
            $category_images[$term_id] =  $_POST['category_image'];
            //save the option array
            update_option( 'category_images', $category_images );
        }
    }

    if(is_category()){
        $category_images = get_option( 'category_images' );
        $category_image = '';
        if ( is_array( $category_images ) && array_key_exists( get_query_var('cat'), $category_images ) ){
        
       $category_image = $category_images[get_query_var('cat')] ;
        ?>
        <img src="<?php echo $category_image;?>"/>
        <?php
        }
    }
    ?>
    
 /** Fin de la gestion de l'ajout d'un champ de chargement de la feautured image sur une catégorie */