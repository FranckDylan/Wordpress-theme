<?php
function wpc_cpt_partenaires() {

	/* partenaires */
	$labels = array(
		'name'                => _x('Partenaires', 'Post Type General Name', 'textdomain'),
		'singular_name'       => _x('partenaire', 'Post Type Singular Name', 'textdomain'),
		'menu_name'           => __('Partenaires', 'technum-theme'),
		'name_admin_bar'      => __('Partenaires', 'technum-theme'),
		'parent_item_colon'   => __('Parent partner:', 'technum-theme'),
		'all_items'           => __('All Partners', 'technum-theme'),
		'add_new_item'        => __('Add New partner', 'technum-theme'),
		'add_new'             => __('Add partner', 'technum-theme'),
		'new_item'            => __('New partner', 'technum-theme' ),
		'edit_item'           => __('Edit partner', 'technum-theme'),
		'update_item'         => __('Update partner', 'technum-theme'),
		'view_item'           => __('View partner', 'technum-theme'),
		'search_items'        => __('Search partner', 'technum-theme'),
		'not_found'           => __('Not found', 'technum-theme'),
		'not_found_in_trash'  => __('Not found in Trash', 'technum-theme'),
	);
	$rewrite = array(
		'slug'                => _x('Partenaires', 'Partenaires', 'textdomain'),
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => false,
	);
	$args = array(
		'label'               => __('Partenaire', 'technum-theme'),
		'description'         => __('Partenaire', 'technum-theme'),
		'labels'              => $labels,
		'supports'            => array('title', 'editor', 'revisions','page-attributes', 'thumbnail'),
		'taxonomies'          => array('partenaires_type'),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 6,
		'menu_icon'           => 'dashicons-admin-plugins',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'query_var'           => 'partenaires',
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type('partenaires', $args);	
}

add_action('init', 'wpc_cpt_partenaires', 10);

//Ajout dans les résultats de recherche
function wpc_cpt_in_search_partenaires($query) {
  if (! is_admin() && $query->is_main_query()) {
    if ($query->is_search) {
      $query->set('post_type', array('post', 'partenaires'));
    }
  }
}

add_action('pre_get_posts','wpc_cpt_in_search_partenaires');

//Ajout d'une meta box pour le sticky post
add_action( 'add_meta_boxes', 'meta_box_add_partenaires' );
add_action( 'save_post', 'pseudosticky_save',10,2);
add_action('save_post', 'description_save', 10, 2);


function meta_box_add_partenaires()
{
  add_meta_box('pseudosticky', __('Mettre en avant sur la page d\'acceuil', 'technum-theme'), 'addbox_partenaires', 'partenaires', 'side', 'high');
  add_meta_box(
	'description', // Metabox ID
	__('Brève Description', 'technum-theme'), // Title to display
	'add_new_box_partenaires', // Function to call that contains the metabox content
	'partenaires', // Post type to display metabox on
	'side', // Where to put it (normal = main colum, side = sidebar, etc.)
	'default' // Priority relative to other metaboxes
  );

}

function add_new_box_partenaires($post, $metabox) {  
	// Use nonce for verification
	
	  wp_nonce_field(basename( __FILE__ ), 'partenaire_description_nonce' );
	  $description = get_post_meta( $post->ID, 'description', true ); // Get the saved values
	  $url = get_post_meta( $post->ID, 'url_partenaire', true ); // Get the saved values
	
		?>
	
		<div>
			<label for="description">
				<?php _e( 'Description', 'technum-theme' );?>
			</label><br/>
			<textarea name="description" id="description" rows="6" style="width:100%;"><?php echo esc_attr( $description ); ?> </textarea>
		</div>
		<div>
			<label for="url">
				<?php _e( 'URL Partemaire', 'technum-theme' );?>
			</label><br/>
			<input type="url" id="url" name="url_partenaire" rows="6" style="width:100%;" value="<?php echo esc_attr( $url ); ?>" >
		</div>
			
		<?php
}


function addbox_partenaires($post, $metabox) {  
// Use nonce for verification
  wp_nonce_field( basename( __FILE__ ), 'pseudosticky_nonce' );
 $entered = get_post_meta($post->ID, 'pseudosticky', true);
    ?>
    <label><input name="pseudosticky" type="checkbox"<?php if($entered=="on")echo' checked="checked"';?> ><?php echo __('Mettre en Avant', 'technum-theme'); ?></label>
	<?php

}

function description_save( $post_id , $post) {
	
	if ($post->post_type != 'partenaires'){
		return;
	}
  // Verify the nonce before proceeding.
    if ( !isset( $_POST['partenaire_description_nonce'] ) || !wp_verify_nonce( $_POST['partenaire_description_nonce'], basename( __FILE__ ) ) )
        return $post_id;

    // Get the post type object.
    $post_type = get_post_type_object( $post->post_type );

    // Check if the current user has permission to edit the post.
    if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
        return $post_id;
  

		$new_meta_value ="";
    	$meta_key="";
		$champs = array('description', 'url_partenaire');

		foreach($champs as $value){
	
			// Get the posted data and sanitize it for use as an HTML class.
			$new_meta_value = ( isset( $_POST[$value] ) ? wp_filter_post_kses( $_POST[$value] ) : '' );
	
			echo "value :".$value." = ".$_POST[$value];
			// Get the meta key.
			$meta_key = $value;
	
			// Get the meta value of the custom field key.
			$meta_value = get_post_meta( $post_id, $meta_key, true );
	
			// If a new meta value was added and there was no previous value, add it.
			if ( $new_meta_value && '' == $meta_value ){
				add_post_meta( $post_id, $meta_key, $new_meta_value, true );
			}
				
	
			// If the new meta value does not match the old value, update it.
			elseif ( $new_meta_value && $new_meta_value != $meta_value ) {
				update_post_meta( $post_id, $meta_key, $new_meta_value );
			}
				
	
			// If there is no new meta value but an old value exists, delete it.
			elseif ( '' == $new_meta_value && $meta_value ){
				delete_post_meta( $post_id, $meta_key );
				
			}
				

				$new_meta_value ="";
				$meta_key="";
	
		}
		//dd();
		
  // save the new value of the dropdown
  //$new_value = $_POST['pseudosticky'];
  //update_post_meta( $post_id, 'pseudosticky', $new_value );
}

function pseudosticky_save( $post_id , $post) {
	
	if ($post->post_type != 'partenaires'){
		return;
	}
  // Verify the nonce before proceeding.
    if ( !isset( $_POST['pseudosticky_nonce'] ) || !wp_verify_nonce( $_POST['pseudosticky_nonce'], basename( __FILE__ ) ) )
        return $post_id;

    // Get the post type object.
    $post_type = get_post_type_object( $post->post_type );

    // Check if the current user has permission to edit the post.
    if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
        return $post_id;

    // Get the posted data and sanitize it for use as an HTML class.
    $new_meta_value = ( isset( $_POST['pseudosticky'] ) ? sanitize_html_class( $_POST['pseudosticky'] ) : '' );

    // Get the meta key.
    $meta_key = 'pseudosticky';

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
  

  // save the new value of the dropdown
  //$new_value = $_POST['pseudosticky'];
  //update_post_meta( $post_id, 'pseudosticky', $new_value );
}

/**
 * Liste des partenaires dans la page des partenaires
 */
function itgstore_page_partenaires_liste(){

	/**
	 * Setup query to show the ‘services’ post type with all posts filtered by 'home' category.
	 * Output is linked title with featured image and excerpt.
	 */
	
	$args = array(  
		'post_type' => 'partenaires',
		'orderby' => 'title',
		"posts_per_page" => -1, 
		//'post_parent' => 0,       
		'order' => 'ASC',
	);

	$loop = new WP_Query( $args ); 
	
	?>

<div id="searchPartenaire">
	<section class="py-5" id="section-partenaire">
        <div class="container mb-4">
            <!--<h2 class="">Partenaires</h2>-->
            <p class="sect-desc mb-0"><?php echo get_post_meta( get_the_ID(), 'titre_contenu', true ); ?></p>
        </div>
        <div class="container text-center">
			<div class="logos d-flex justify-content-center align-items-center flex-wrap">
			   <?php
                // The Loop
				if ( $loop->have_posts() ) {
					while ( $loop->have_posts() ) : $loop->the_post(); 
						$url = get_post_meta( get_the_ID(), 'url_partenaire', true );
						$url = trim($url);
						if($url==null):
							?>
								<a href="<?php the_permalink(); ?>"><img alt="logo-partenaire" src="<?php the_post_thumbnail_url();?>"></a>
							<?php
						else:
							?>
								<a href="<?php echo $url; ?>" target="_blank" rel="noopener"><img alt="logo-partenaire" src="<?php the_post_thumbnail_url();?>"></a>
							<?php
						endif;
						//the_excerpt(); 
					endwhile;
				}
				wp_reset_postdata(); 
				?>
            </div>
        </div>
    </section>
</div>
<?php
	
}


/**
 * Liste actualités de l'entreprise
 */

function itgstore_front_actualite_section($slug){

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
			'post_type' => 'post',
			'nopaging' => true, 
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
			//,"posts_per_page" => 6
			
		);
	endif;
	
	$the_query = new WP_Query($args);
	
	$title = get_the_title( get_option('page_for_posts', true) );
	if ($the_query->have_posts()) :
	
	?>

	<section class="py-5">
		<div class="container mb-5">
			<h2 class=""><?php function_exists('pll_e') ? pll_e('Actualité') : _e('Actualité', 'textdomain'); ?></h2>
			<p class="sect-desc mb-4"><?php echo get_theme_mod('alaune_front_text_setting'); ?></p>
		</div>
		<div class="container-fluid">
			<div class="article">
				<div class="row">
				<?php
					while ($the_query->have_posts()) : $the_query->the_post();
					$categories = get_the_category();
				?>
					<div class="col-md-3 mb-4">
						<a class="card shadow" href="article-detail.html">
							<div class="img-article"
								style="background-image: url('<?php the_post_thumbnail_url('alaune-size' ); ?>')"></div>
							<div class="card-body position-relative">
								<div class="description-top">
									<p class="card-subtitle"><?php echo $categories[0]->name ?></p>
									<h3 class="card-title"><?php the_title(); ?></h3>
								</div>
								<div class="description-bottom">
									<div class="description mb-2">
										<?php the_excerpt(); ?>
									</div>
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

function itgstore_get_reussites_partenaires($reussiteId){

	?>
	<div class="partenaire shadow p-5 ml-3">
		<div  class="container mb-4 pl-0 ml-0">
			<h2 style="color: #042F6B; margin-left: auto;
			margin-right: auto;" class="title"><?php function_exists('pll_e') ? pll_e('Partenaire') : _e('Partenaire', 'textdomain'); ?></h2>
		</div>
		<?php  ?>
		<div style="width:100%; ">
			<img style="width:150px; height: 150px;" src="<?php echo get_the_post_thumbnail_url(get_post_meta($reussiteId, 'partenaire_id', true)) ?>" />
		</div>
		<?php ?>
	</div>
	<?php
}