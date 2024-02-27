<?php
function wpc_cpt_blog() {

	/* Blog */
	$labels = array(
		'name'                => _x('Blog', 'Post Type General Name', 'textdomain'),
		'singular_name'       => _x('Blog', 'Post Type Singular Name', 'textdomain'),
		'menu_name'           => __('Blog', 'technum-theme'),
		'name_admin_bar'      => __('Blog', 'technum-theme'),
		'parent_item_colon'   => __('Parent Blog:', 'technum-theme'),
		'all_items'           => __('All Blog post', 'technum-theme'),
		'add_new_item'        => __('Add Blog Post', 'technum-theme'),
		'add_new'             => __('Add Blog Post', 'technum-theme'),
		'new_item'            => __('New Blog Post', 'technum-theme'),
		'edit_item'           => __('Edit Blog Post', 'technum-theme'),
		'update_item'         => __('Update Blog Post', 'technum-theme'),
		'view_item'           => __('View Blog Post', 'technum-theme'),
		'search_items'        => __('Search Blog Post', 'technum-theme'),
		'not_found'           => __('Not found', 'technum-theme'),
		'not_found_in_trash'  => __('Not found in Trash', 'technum-theme'),
	);
	$rewrite = array(
		'slug'                => _x('blog', 'Blog', 'textdomain'),
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => false,
	);
	$args = array(
		'label'               => __('Blog', 'technum-theme'),
		'description'         => __('Blog', 'technum-theme'),
		'labels'              => $labels,
		'supports'            => array('title', 'author', 'editor', 'thumbnail','comments'), // 'excerpt',
		'taxonomies'          => array('blog_type'),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 6,
		'menu_icon'           => 'dashicons-welcome-write-blog',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'query_var'           => 'blog',
		'rewrite'             => $rewrite,
        'capability_type'     => 'page',
        
         // This is where we add taxonomies to our CPT
         'taxonomies'          => array( 'category' ),
	);
	register_post_type('blog', $args);	
}

add_action('init', 'wpc_cpt_blog', 10);

//Ajout dans les résultats de recherche
function wpc_cpt_in_search_blog($query) {
  if (! is_admin() && $query->is_main_query()) {
    if ($query->is_search) {
      $query->set('post_type', array('post', 'blog'));
    }
  }
}

add_action('pre_get_posts','wpc_cpt_in_search_blog');

add_action('add_meta_boxes', '_namespace_create_metabox_blog');
add_action('save_post', 'description_blog_save', 10, 2);

function _namespace_create_metabox_blog($post) {

    // Can only be used on a single post type (ie. page or post or a custom post type).
    // Must be repeated for each post type you want the metabox to appear on.
    /*add_meta_box(
        '_namespace_metabox_blog', // Metabox ID
        'Options Additionnelles', // Title to display
        '_namespace_render_metabox_blog', // Function to call that contains the metabox content
        'blogs', // Post type to display metabox on
        'side', // Where to put it (normal = main colum, side = sidebar, etc.)
        'high' // Priority relative to other metaboxes
    );*/

    add_meta_box(
        'description', // Metabox ID
        __('Brève Description', 'technum-theme'), // Title to display
        'add_blog_description_callback', // Function to call that contains the metabox content
        'blog', // Post type to display metabox on
        'side', // Where to put it (normal = main colum, side = sidebar, etc.)
        'default' // Priority relative to other metaboxes
    );

}

function add_blog_description_callback($post, $metabox){
	// Use nonce for verification
	
	wp_nonce_field(basename( __FILE__ ), 'blog_description_nonce' );
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

function description_blog_save( $post_id , $post) {
	
	if ($post->post_type != 'blog'){
		return;
	}
  // Verify the nonce before proceeding.
    if ( !isset( $_POST['blog_description_nonce'] ) || !wp_verify_nonce( $_POST['blog_description_nonce'], basename( __FILE__ ) ) )
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

/** Section du code qui gère la liste des blogs postés sur le portail */
function itgstore_liste_blog_section(){


    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    
    $args = array(
		'post_type' => 'blog',
        'paged'        => $paged,
        'orderby'   => 'date',
        "posts_per_page" => 5,
        'order'     => 'DESC', // it's DESC; not DSC
        // There's no use setting posts_per_page when nopaging is enabled.
        // Because posts_per_page will be ignored when nopaging is enabled.
    );

    $the_query = new WP_Query($args);
    $posts = $the_query->get_posts();

?>
    <!-- ======================= Begin Site Banner =========================== -->
    <div class="container mt-5">
        <h2><?php echo get_post_meta( get_the_ID(), 'titre_contenu', true ); ?></h2>
        <!-- <p class="sect-desc mb-4">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
        </p> -->
    </div>
    <div id="searchBlog">
        <?php
            display_blog_list($posts);
        ?>
        <div class="col-12 text-left text-lg-center offset-custom-6 mt-5">
            <?php 

                if (function_exists("pagination")) {
                    pagination($the_query->max_num_pages);
                } 

            ?>
        </div>
    </div>
<?php
}

/** fonction qui se charge uniquement de l'affichage des blogs */
function display_blog_list($posts){
?>

    <section class="section timeline">
        
        <div class="container">
          <div class="row">

    <?php

    $_year_mon = '';   // previous year-month value
    $_has_grp = false; // TRUE if a group was opened

    for ($i=0; $i < sizeof($posts); $i++ ) {
            
            $post = $posts[$i];
            setup_postdata( $post );

            $time = strtotime( $post->post_date );
            $year = date( 'Y', $time );
            $mon = date( 'F', $time );
            $year_mon = "$year-$mon";
            $mois = get_locale() == 'fr_FR' ? dateToFrench($mon, 'F') : $mon;

            // Open a new group.
            if ( $year_mon !== $_year_mon ) {
                // Close previous group, if any.
                /*if ( $_has_grp ) {
                    echo '</div><!-- .month -->';
                    echo '</div><!-- .year -->';
                }*/
                $_has_grp = true;

                ?>
                    <div class="col-12 text-left text-lg-center offset-custom-6">
                        <time class="h4 meta-timeline" datetime=""> 
                            <?php 
                            echo  $mois.' '. $year;
                            ?>
                        </time>
                    </div>
                <?php
            }

            // Display post title.
            if ( $title = get_the_title() ) {
            ?>  
                    <div class="col-12 col-lg-4 <?php echo ($i%2 == 0 ? 'offset-lg-1' : 'offset-lg-2 inset-1 timeline-right'); ?>">
                        <article class="blog-post thumbnail view-animate <?php echo ($i%2 == 0 ? '' : 'well3'); ?>">
                            <div class="img-wrap view-animate"><img id="image-blog" src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" alt=""></div>
                            <div class="caption-mod-1">
                            <div class="blog-post-time">
                                <time datetime="2018-10-07">
                                    <?php
                                        $date = get_the_date('d, F Y', $post->ID);
                                        echo get_locale() == 'fr_FR' ? dateToFrench($date, 'd, F Y') : $date;
                                    ?>
                                    &nbsp;
                                </time>
                                <span>Par <?php the_author_meta( 'user_nicename' , $post->post_author ); ?></span>
                            </div>
                            <div class="blog-post-title">
                                <h4 ><a href="<?php echo get_the_permalink($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a></h4>
                            </div>
                            <div>
                                <p class="py-1 title-projet">
                                    <?php
                                        $categories = get_the_category($post->ID);
                                        foreach($categories as $category){
                                            echo $category->name.', ';
                                        }
                                    ?>
                                </p>
                            </div>
                            <div class="blog-post-body text-md-left">
                                <p><?php echo get_the_excerpt($post->ID); ?></p>
                            </div>
                            <div class="blog-post-footer text-md-left">
                                <div class="badge offset-custom-9"><a class="text-gray" href="#"> <?php echo get_comments_number($post->ID).' Commentaire(s)'; ?> </a></div>
                            </div>
                            </div>
                        </article>
                    </div>
            <?php 
            }else {
                echo "<div>#{$post->ID}</div>";
            }

            $_year_mon = $year_mon;
    }
    ?>
    </div>
        </div>
        
    </section>
   
    <?php
    // Close the last group, if any.
    /*if ( $_has_grp ) {
        echo '</div><!-- .month -->';
        echo '</div><!-- .year -->';
    }*/
    wp_reset_postdata();


}

function load_blog_scripts() {
    wp_enqueue_script( 'blog-script-js', get_stylesheet_directory_uri() . '/asset/js/script.js', array('jquery'), null, true );
}

add_action( 'wp_enqueue_scripts', 'load_blog_scripts');

/** Affichage des blogs les plus recents */
function itg_page_blog_plus_recents(){
    
    $args = array(
		'post_type' => 'blog',
        'paged'        => 1,
        'orderby'   => 'date',
        "posts_per_page" => 6,
        'order'     => 'DESC', // it's DESC; not DSC
        // There's no use setting posts_per_page when nopaging is enabled.
        // Because posts_per_page will be ignored when nopaging is enabled.
    );

    $the_query = new WP_Query($args);
    $posts = $the_query->get_posts();

    if($the_query->have_posts()):
?>
    <div id="plus-recent" class="col-lg-4">
        <div class="container mb-5">
            <h2 class="h2-coustomyse pt-5"><?php function_exists('pll_e') ? pll_e('Les plus recents') : _e('Les plus recents', 'textdomain'); ?></h2>
        </div>
        <div class="pl-20 pl-md-0">
            <div class="mtb-50">
                <?php while($the_query->have_posts()) : $the_query->the_post(); ?>
                    <a class="oflow-hidden pos-relative mb-20 dplay-block" href="<?php echo get_the_permalink(get_the_ID()); ?>">
                        <div class="wh-100x abs-tlr"><img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" width="110" height="210" alt="blog recent"></div>
                        <div class="ml-120 min-h-100x">
                            <h5><b> <?php $str = get_the_title(get_the_ID()); echo substr($str, 0, 40) . '...'; ?> </b></h5>
                            <h6 class="color-lite-black pt-10"><span class="color-black"><b> <?php $date = get_the_date('d, F Y', get_the_ID()); echo get_locale() == 'fr_FR' ? dateToFrench($date, 'd, F Y') : $date; ?></b></span></h6>
                        </div>
                    </a><!-- oflow-hidden -->
                <?php  endwhile; ?>
            </div>
        </div>
    </div>
<?php
    endif;
}

/** Affichage des autres blogs de la même catégorie */
function itg_page_blog_autres_blogs($slug){

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    
 
    $posts = get_posts(array(
        'post_type' => 'blog',
        'name' => $slug,
    ));
    
    $categories = get_the_category($posts[0]->ID);
   
    $categoriesIds = array();
    foreach($categories as $category){
        array_push($categoriesIds, $category->cat_ID);
    }
   
    $args = array(
		'post_type' => 'blog',
        //'paged'        => $paged,
        'category__in' => $categoriesIds,
        'post__not_in' => array($posts[0]->ID),
        'orderby'   => 'date',
        "posts_per_page" => 4,
        'order'     => 'DESC', // it's DESC; not DSC
        // There's no use setting posts_per_page when nopaging is enabled.
        // Because posts_per_page will be ignored when nopaging is enabled.
    );



    $the_query = new WP_Query($args);
    $posts = $the_query->get_posts();
   

    if($the_query->have_posts() && sizeof($categoriesIds) > 0):
?>
    <div class="container mt-5">
        <h2><?php function_exists('pll_e') ? pll_e('Autres blogs') : _e('Autres blogs', 'textdomain'); ?></h2>
    </div>

    <?php
        display_blog_list($posts);
    ?>
        <div class="col-12 text-left text-lg-center offset-custom-6 mt-5">
    <?php 

        if (function_exists("pagination")) {
            pagination($the_query->max_num_pages);
        } 
    ?>
        </div>
<?php
    

    endif;
}

/** Affichage des commentaires sur un blog */
function itg_page_blog_comments_list(){

    $comments = get_comments( array(
		'post_id'	=> get_the_ID(),
		'status'	=> 'approve'
    ));
?>
    <div class="container py-5">
        <h3><?php echo get_comments_number(get_the_ID()).' Commentaire(s)'; ?></h3>
    </div>
<?php 
    foreach($comments as $comment){
?>

    <div class="sided-70 mb-40" id="comment-<?php echo $comment->comment_post_ID ?>">
                                        
        <div class="s-left rounded">
            <img src="<?php echo get_avatar_url( $comment, 32 ); ?>" alt="">
        </div><!-- s-left -->
        
        <div class="s-right ml-100 ml-xs-85">
            <h5>
                <b><?php echo $comment->comment_author ?> </b><br>
                <span class="font-8 color-ash" style="font-size: 0.75em; color: #a39d9d ;">
                    <?php echo date('d, F Y', strtotime($comment->comment_date)); ?>
                </span>
            </h5>
            <p class="mtb-15" style="font-size: 0.9em;">
             <?php echo $comment->comment_content ?>
            </p>
            <?php
           
                // Display comment reply link
                comment_reply_link(  array(
                    'add_below' => 'div-comment',
                    'reply_to_text' => __( 'Repondre à '.get_comment_author_link()),
                ) ) ; 
            ?>
            <!--<a class="btn-brdr-grey btn-b-sm plr-15 mt-5" href="#"><b>REPLY</b></a>-->
        </div><!-- s-right -->
        
    </div><!-- sided-70 -->
    

<?php  
    }
}

/** Affichage du formulaire de commentaire sur un blog */
function itg_page_blog_comment_form(){
?>

    <h4 class="p-title py-5"><b>Laissez un commentaire</b></h4>
                                        
    <form  action="<?php echo site_url('/wp-comments-post.php') ?>" method="post" class="form-block form-bold form-mb-20 form-h-35 form-brdr-b-grey pr-50 pr-sm-0">
        <div class="row">
        
            <?php if ( is_user_logged_in() ) : ?>
                <div class="col-sm-6">
                    <p >Connecté en tant que: <?php echo get_user_option('user_nicename') ?></p>
                </div><!-- col-sm-6 -->
            <?php else : ?>
                <div class="col-sm-6">
                    <p >Nom complet *</p>
                    <div class="pos-relative">
                        <input class="pr-20" type="text" name="author" id="comment-author" required />
                        <i class="abs-tbr lh-35 font-13 color-green ion-android-done"></i>
                    </div><!-- pos-relative -->
                </div><!-- col-sm-6 -->
                
                <div class="col-sm-6">							
                    <p >Email *</p>
                    <div class="pos-relative">
                        <input class="pr-20" type="email" name="email" id="comment-email" required />
                        <i class="dplay-none abs-tbr lh-35 font-13 color-green ion-android-done"></i>
                    </div><!-- pos-relative -->
                </div><!-- col-sm-6 -->
            
                <div class="col-sm-6">	
                    <p >Téléphone *</p>
                    <div class="pos-relative">
                        <input name="phone" id="comment-phone" required class="pr-20" type="text">
                        <i class="dplay-none abs-tbr lh-35 font-13 color-green ion-android-done"></i>
                    </div><!-- pos-relative -->
                </div><!-- col-sm-6 -->
            <?php endif ?>

            <div class="col-sm-12">
                <div class="pos-relative pr-80">
                    <p >Commentaire *</p>
                    <textarea name="comment" id="comment-body" required class="mb-0"></textarea>
                    <button class="abs-br font-20 plr-15 btn-fill-primary" type="submit"> <i class="fas fa-paper-plane color-send"></i></button>
                    <?php comment_form_hidden_fields() ?>
                </div><!-- pos-relative --><br/>
            </div><!-- col-sm-6 -->
           
        </div><!-- row --> 
    </form>
   
<?php    
}

/**
 * Comment form hidden fields
 */
function comment_form_hidden_fields()
{
    comment_id_fields();

    if ( current_user_can( 'unfiltered_html' ) )
    {
        wp_nonce_field( 'unfiltered-html-comment_' . get_the_ID(), '_wp_unfiltered_html_comment', false );
    }
}