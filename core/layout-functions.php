<?php
/*
 * Created by Artureanec
*/

# Get Featured Image Url
if (!function_exists('technum_get_featured_image_url')) {
    function technum_get_featured_image_url() {
        $featured_image_full_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
        if (isset($featured_image_full_url[0]) && strlen($featured_image_full_url[0]) > 0) {
            return esc_url($featured_image_full_url[0]);
        } else {
            return false;
        }
    }
}

if (!function_exists('technum_get_attachment_meta')) {
    function technum_get_attachment_meta($attachment_id) {
        $attachment = get_post($attachment_id);
        return array(
            'alt'           => get_post_meta($attachment->ID, '_wp_attachment_image_alt', true),
            'caption'       => $attachment->post_excerpt,
            'description'   => $attachment->post_content,
            'href'          => get_permalink($attachment->ID),
            'src'           => $attachment->guid,
            'title'         => $attachment->post_title
        );
    }
}

# Social Links Output
if (!function_exists('technum_socials_output')) {
    function technum_socials_output($container_class = '') {

        $socials_output = '<ul' . (!empty($container_class) ? ' class="' . esc_attr($container_class) . '">' : '>');

        if (technum_get_theme_mod('socials_target')) {
            $socials_target = '_blank';
        } else {
            $socials_target = '_self';
        }
        $social_items = json_decode(technum_get_theme_mod('social_buttons'), true);
        if ( !empty($social_items) && is_array($social_items) ) {
            foreach ($social_items as $item) {
                if (!empty($item['icon_value']) || !empty($item['link'])) {
                    $socials_output .= '<li>';
                        $socials_output .= '<a href="' . ( !empty($item['link']) ? esc_url($item['link']) : '#' ) . '" target="' . esc_attr($socials_target) . '"' . ( !empty($item['icon_value']) ? ' class="fab ' . esc_attr($item['icon_value']) . '"' : '' ) . ( !empty($item['title']) ? ' title="' . esc_attr($item['title']) . '"' : '') . '></a>';
                    $socials_output .= '</li>';
                }
            }
        }

        $socials_output .= '</ul>';

        return $socials_output;
    }
}

// Breadcrumbs
if ( ! function_exists( 'technum_breadcrumbs' ) ) {
    function technum_breadcrumbs(){
        /* === OPTIONS === */
        $text['home']	    = esc_html__( 'Home', 'technum' ); // text for the 'Home' link
        $text['category']   = esc_html__( 'Archive by Category "%s"', 'technum' ); // text for a category page
        $text['search']     = esc_html__( 'Search for "%s"', 'technum' ); // text for a search results page
        $text['taxonomy']   = esc_html__( 'Archive by %s "%s"', 'technum' );
        $text['tag']	    = esc_html__( 'Posts Tagged "%s"', 'technum' ); // text for a tag page
        $text['author']     = esc_html__( 'Articles Posted by %s', 'technum' ); // text for an author page
        $text['404']	    = esc_html__( '404 Page', 'technum' ); // text for the 404 page

        $show_current       = 1; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show
        $show_on_home       = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
        $show_on_404   	    = 0; // 1 - show breadcrumbs on the 404, 0 - don't show
        $show_home_link     = 1; // 1 - show the 'Home' link, 0 - don't show
        $delimiter	        = "<span class='delimiter'></span>";
        $before		        = '<span class="current">'; // tag before the current crumb
        $after		        = '</span>'; // tag after the current crumb
        /* === END OF OPTIONS === */

        global $post;
        $home_link = esc_url( home_url( '/' ) );
        $link = '<a href="%1$s">%2$s</a>';
        $parent_id = '';
        if ( isset( $post->post_parent ) ) {
            $parent_id	= $parent_id_2 = $post->post_parent;
        }

        $frontpage_id = get_option( 'page_on_front' );

        if ( !$show_on_404 && is_404() ) {
            return;
        }

        if ( is_home() || is_front_page() ) {
            if ( $show_on_home == 1 ) {
                echo '<nav class="breadcrumbs"><a href="' . $home_link . '">' . $text['home'] . '</a></nav>';
            }
        } else if ( class_exists('WooCommerce') && is_woocommerce() ) {
            woocommerce_breadcrumb(array(
                'delimiter' => $delimiter,
                'wrap_before' => '<nav class="breadcrumbs">',
                'wrap_after' => '</nav>'
            ));
        } else {
            echo '<nav class="breadcrumbs">';
            if ( $show_home_link == 1 ) {
                echo '<a href="' . $home_link . '">' . $text['home'] . '</a>';
                if ( $frontpage_id == 0 || $parent_id != $frontpage_id ) { echo sprintf("%s", $delimiter ); }
            }

            if ( is_category() ) {
                $cat = get_category( get_query_var( 'cat' ) );
                $cat_name = isset( $cat->name ) ? $cat->name : '';
                $parent_cats = array();
                $has_parent_cat = false;
                $temp_cat = $cat;
                while ( true ) {
                    if ( isset( $temp_cat->parent ) && $temp_cat->parent ) {
                        array_push( $parent_cats, $temp_cat->parent );
                        $temp_cat = get_category( $temp_cat->parent );
                    } else {
                        break;
                    }
                }
                $parent_cats = array_reverse( $parent_cats );
                for ( $i = 0; $i < count( $parent_cats ); $i++ ) {
                    $cur_cat_obj = get_category( $parent_cats[ $i ] );
                    $cur_cat_name = isset( $cur_cat_obj->name ) ? $cur_cat_obj->name : '';
                    if ( ! empty( $cur_cat_name ) && isset( $cur_cat_obj->term_id ) ) {
                        $cur_cat_link = get_category_link( $cur_cat_obj->term_id );
                        if($has_parent_cat){
                            echo sprintf("%s", $delimiter);
                        }
                        printf( $link, $cur_cat_link, $cur_cat_name );
                        $has_parent_cat = true;
                    }
                }
                if ( $show_current == 1 ) {
                    if($has_parent_cat){
                        echo sprintf("%s", $delimiter);
                    }
                    echo sprintf("%s", $before) . sprintf( $text['category'], $cat_name );
                }
            } elseif ( is_tag() ) {
                echo sprintf("%s", $before) . sprintf( $text['tag'], single_tag_title( '', false ) ) . sprintf( "%s", $after );
            } elseif ( is_author() ) {
                global $author;
                $userdata = get_userdata( $author );
                echo sprintf("%s", $before) . esc_html( sprintf( $text['author'], $userdata->display_name ) ) . sprintf( "%s", $after );

            } elseif ( is_day() ) {
                echo sprintf( $link, get_year_link( get_the_time( 'Y' ) ), get_the_time( 'Y' ) ) . sprintf("%s", $delimiter);
                echo sprintf( $link, get_month_link( get_the_time( 'Y' ),get_the_time( 'm' ) ), get_the_time( 'F' ) ) . sprintf("%s", $delimiter);
                echo sprintf("%s", $before) . get_the_time( 'd' ) . sprintf( "%s", $after );

            } elseif ( is_month() ) {
                echo sprintf( $link, get_year_link( get_the_time( 'Y' ) ), get_the_time( 'Y' ) ) . sprintf("%s", $delimiter);
                echo sprintf("%s", $before) . get_the_time( 'F' ) . sprintf( "%s", $after );

            } elseif ( is_year() ) {
                echo sprintf("%s", $before) . get_the_time( 'Y' ) . sprintf( "%s", $after );

            } elseif ( has_post_format() && ! is_singular() ) {
                echo get_post_format_string( get_post_format() );
            } else if ( is_tax( array( 'technum-portfolio', 'portfolio-category', 'technum-team', 'team-category' ) ) ) {
                $tax_slug = get_query_var( 'taxonomy' );
                $term_slug = get_query_var( $tax_slug );
                $tax_obj = get_taxonomy( $tax_slug );
                $term_obj = get_term_by( 'slug', $term_slug, $tax_slug );
                $parent_terms = array();
                $has_parent_term = false;
                if ( isset( $tax_obj->hierarchical ) && $tax_obj->hierarchical ) {
                    $temp_term_obj = $term_obj;
                    while ( true ) {
                        if ( isset( $temp_term_obj->parent ) && $temp_term_obj->parent ) {
                            array_push( $parent_terms, $temp_term_obj->parent );
                            $temp_term_obj = get_term_by( 'id', $temp_term_obj->parent, $tax_slug );
                        } else {
                            break;
                        }
                    }
                    $parent_terms = array_reverse( $parent_terms );
                    for ( $i = 0; $i < count( $parent_terms ); $i++ ) {
                        $cur_term = get_term_by( 'id', $parent_terms[ $i ], $tax_slug );
                        $cur_term_name = isset( $cur_term->name ) ? $cur_term->name : '';
                        if ( ! empty( $cur_term_name ) && isset( $cur_term->term_id ) ) {
                            $cur_term_link = get_term_link( $cur_term->term_id, $tax_slug );
                            if($has_parent_term){
                                echo sprintf("%s", $delimiter);
                            }
                            printf( $link, $cur_term_link, $cur_term_name );
                            $has_parent_term = true;
                        }
                    }
                }
                if ( $show_current == 1 ) {
                    $singular_tax_label = isset( $tax_obj->labels ) && isset( $tax_obj->labels->singular_name ) ? $tax_obj->labels->singular_name : '';
                    $term_name = isset( $term_obj->name ) ? $term_obj->name : '';
                    if($has_parent_term){
                        echo sprintf("%s", $delimiter);
                    }
                    echo sprintf("%s", $before) . esc_html( sprintf( $text['taxonomy'], $singular_tax_label, $term_name ) );
                }
            } elseif ( is_archive() ) {
                if ( $show_current ) {
                    $post_type = get_post_type();
                    $post_type_obj = get_post_type_object( $post_type );

                    if( $post_type == 'technum-portfolio' || $post_type == 'technum-team' ){
                        $post_type_name = get_theme_mod($post_type.'_slug');
                    }

                    if( empty($post_type_name) ){
                        $post_type_name = isset( $post_type_obj->label ) ? $post_type_obj->label : '';
                    }

                    echo sprintf("%s", $before) . esc_html($post_type_name) . sprintf( "%s", $after );
                }
            } elseif ( is_search() ) {
                echo sprintf("%s", $before) . sprintf( $text['search'], get_search_query() ) . sprintf( "%s", $after );
            } elseif ( is_single() ) {
                $post_type = get_post_type();
                $post_type_obj = get_post_type_object( $post_type );

                if( $post_type == 'technum-portfolio' || $post_type == 'technum-team' ){
                    $post_type_label = get_theme_mod($post_type.'_slug');
                }

                if( empty($post_type_label) ){
                    $post_type_label = isset( $post_type_obj->label ) ? $post_type_obj->label : '';
                }

                $post_type_link = get_post_type_archive_link( $post_type );
                if ( $post_type_obj->has_archive ) {
                    printf( $link, $post_type_link, $post_type_label  );
                    echo sprintf("%s", $delimiter);
                }

                if ( $show_current ) {
                    if ( empty(get_the_title()) ) {
                        echo sprintf("%s", $before) . esc_html__('(no title)', 'technum') . sprintf("%s", $after);
                    } else {
                        echo sprintf("%s", $before) . wp_kses( get_the_title(), array(
                                "b"			=> array(),
                                "em"		=> array(),
                                "sup"		=> array(),
                                "sub"		=> array(),
                                "strong"	=> array(),
                                "mark"		=> array(),
                                "br"		=> array()
                            )) . sprintf("%s", $after);
                    }
                }
            } elseif ( is_page() && ! $parent_id ) {
                if ( empty(get_the_title()) ) {
                    echo sprintf("%s", $before) . esc_html__('(no title)', 'technum') . sprintf("%s", $after);
                } else {
                    echo sprintf("%s", $before) . wp_kses( get_the_title(), array(
                            "b"			=> array(),
                            "em"		=> array(),
                            "sup"		=> array(),
                            "sub"		=> array(),
                            "strong"	=> array(),
                            "mark"		=> array(),
                            "br"		=> array()
                        )) . sprintf("%s", $after);
                }
            } elseif ( is_page() && $parent_id ) {
                if ( $parent_id != $frontpage_id ) {
                    $breadcrumbs = array();
                    while ( $parent_id ) {
                        $page = get_page( $parent_id );
                        if ( $parent_id != $frontpage_id ) {
                            $breadcrumbs[] = sprintf( $link, get_permalink( $page->ID ), wp_kses( get_the_title( $page->ID ), array(
                                "b"			=> array(),
                                "em"		=> array(),
                                "sup"		=> array(),
                                "sub"		=> array(),
                                "strong"	=> array(),
                                "mark"		=> array(),
                                "br"		=> array()
                            )) );
                        }
                        $parent_id = $page->post_parent;
                    }
                    $breadcrumbs = array_reverse( $breadcrumbs );
                    for ( $i = 0; $i < count( $breadcrumbs ); $i++ ) {
                        echo sprintf("%s", $breadcrumbs[ $i ]);
                        if ( $i != count( $breadcrumbs ) -1 ) { echo sprintf("%s", $delimiter); }
                    }
                }
                if ( $show_current == 1 ) {
                    if ( $show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id) ) { echo sprintf("%s", $delimiter); }
                    if ( empty(get_the_title()) ) {
                        echo sprintf("%s", $before) . esc_html__('(no title)', 'technum') . sprintf("%s", $after);
                    } else {
                        echo sprintf("%s", $before) . wp_kses( get_the_title(), array(
                                "b"			=> array(),
                                "em"		=> array(),
                                "sup"		=> array(),
                                "sub"		=> array(),
                                "strong"	=> array(),
                                "mark"		=> array(),
                                "br"		=> array()
                            )) . sprintf("%s", $after);
                    }
                }
            } elseif ( is_404() ) {
                echo sprintf("%s", $before) . esc_html($text['404']) . sprintf( "%s", $after );
            }

            if ( get_query_var( 'paged' ) ) {
                echo sprintf("%s", $delimiter) . esc_html__( 'Page', 'technum' ) . ' ' . get_query_var( 'paged' );
            }
            echo '</nav>';
        }
    }
}

// Single Post Media Output
if (!function_exists('technum_post_media_output')) {
    function technum_post_media_output($link = false, $columns = 1) {
        $post_format    = get_post_format();
        switch ( $columns ) {
            case 2:
                $max_width = 920;
                $max_height = 780;
                $img_size_desktop = 'technum_post_grid_2_columns';
                $img_size_mobile = 'technum_post_thumbnail_mobile';
                $img_size_table = 'technum_post_grid_4_columns';
                break;
            case 3:
                $max_width = 600;
                $max_height = 450;
                $img_size_desktop = 'technum_post_grid_3_columns';
                $img_size_mobile = 'technum_post_thumbnail_mobile';
                $img_size_table = 'technum_post_grid_4_columns';
                break;
            case 4:
                $max_width = 440;
                $max_height = 374;
                $img_size_desktop = 'technum_post_grid_4_columns';
                $img_size_mobile = 'technum_post_thumbnail_mobile';
                $img_size_table = 'technum_post_grid_4_columns';
                break;
            case 5:
                $max_width = 344;
                $max_height = 292;
                $img_size_desktop = 'technum_post_grid_5_columns';
                $img_size_mobile = 'technum_post_thumbnail_mobile';
                $img_size_table = 'technum_post_grid_4_columns';
                break;
            case 6:
                $max_width = 280;
                $max_height = 238;
                $img_size_desktop = 'technum_post_grid_6_columns';
                $img_size_mobile = 'technum_post_thumbnail_mobile';
                $img_size_table = 'technum_post_grid_4_columns';
                break;
            default:
                $max_width = 1170;
                $max_height = 471;
                $img_size_desktop = 'post-thumbnail';
                $img_size_mobile = 'technum_post_thumbnail_mobile';
                $img_size_table = 'technum_post_thumbnail_tablet';
        }
        if ( empty($post_format) ) {
            $post_format = 'standard';
        }
        if (
            $post_format == 'video' && technum_post_options() && class_exists('RWMB_Loader') &&
            (
                ( technum_get_post_option('post_media_video_type') == 'link' && !empty(technum_get_post_option('post_media_video_url')) ) ||
                ( technum_get_post_option('post_media_video_type') == 'self' && !empty(technum_get_post_option('post_media_video_select')) )
            )
        ) {
            $poster_id = get_post_thumbnail_id();
            $poster_src = wp_get_attachment_image_url($poster_id, $img_size_desktop);
            if (technum_get_post_option('post_media_video_type') == 'link' && !empty(technum_get_post_option('post_media_video_url'))) {
                $out = wp_video_shortcode(array(
                    'src'       => rwmb_get_value('post_media_video_url'),
                    'height'    => $max_height,
                    'width'     => $max_width,
                    'poster'    => $poster_src
                ));
            } elseif (technum_get_post_option('post_media_video_type') == 'self' && !empty(technum_get_post_option('post_media_video_select'))) {
                $videos = rwmb_meta('post_media_video_select');
                foreach ($videos as $video) {
                    $out = wp_video_shortcode(array(
                        'src'       => $video['src'],
                        'height'    => $max_height,
                        'width'     => $max_width,
                        'poster'    => $poster_src
                    ));
                }
            }
        } elseif ( $post_format == 'gallery' && technum_post_options() && class_exists('RWMB_Loader') && !empty(technum_get_post_option('post_media_gallery_select')) && is_array(technum_get_post_option('post_media_gallery_select')) ) {
            $slider_options = [
                'items'                 => 1,
                'nav'                   => true,
                'navText'               => ['', ''],
                'dots'                  => false,
                'autoplay'              => false,
                'loop'                  => true,
                'dotsContainer'         => false,
                'autoHeight'            => false
            ];
            $out = '<div class="wp-post-gallery post-gallery-carousel owl-carousel owl-theme" data-slider-options="' . esc_attr(wp_json_encode($slider_options)) . '">';
            foreach (technum_get_post_option('post_media_gallery_select') as $key => $image) {
                $src = $image['sizes'][$img_size_desktop]['url'];
                $title = $image['title'];
                $alt = !empty($image['alt']) ? $image['alt'] : $title;
                $out .= '<div class="item">';
                    $out .= '<picture>';
                        $out .= '<source media="(max-width: 575px)" sizes="(max-width: 535px) 535px" srcset="' . $image['sizes'][$img_size_mobile]['url'] . ' 535w">';
                        $out .= '<source media="(max-width: 991px)" sizes="(max-width: 951px) 951px" srcset="' . $image['sizes'][$img_size_table]['url'] . ' 951w">';
                        $out .= '<img alt="' . esc_attr($alt) . '" title="' . esc_attr($title) . '" src="' . esc_url($src) . '" class="attachment-' . esc_attr($img_size_desktop) . ' size-' . esc_attr($img_size_desktop) . ' wp-post-image" />';
                    $out .= '</picture>';
                $out .= '</div>';
            }
            $out .= '</div>';
        } elseif ( $post_format == 'quote' && technum_post_options() && !empty(technum_get_post_option('post_media_quote_text')) ) {
            $out = $link ? '<a href="' . esc_url(get_the_permalink()) . '" class="post-quote">' : '<div class="post-quote">';
                $out .= !empty(technum_get_post_option('post_media_quote_text')) ? '<div class="post-quote-text">' . esc_html(technum_get_post_option('post_media_quote_text')) . '</div>' : '';
                $out .= !empty(technum_get_post_option('post_media_quote_author')) ? '<div class="post-quote-author">' . esc_html(technum_get_post_option('post_media_quote_author')) . '</div>' : '';
            $out .= $link ? '</a>' : '</div>';
        } else {
            $id = get_post_thumbnail_id();
            $out = '';
            if ( $id ) {
                $src = wp_get_attachment_image_url($id, $img_size_desktop);
                $title = get_post($id)->post_title;
                $alt = ( !empty(get_post_meta($id, '_wp_attachment_image_alt', true)) ) ? get_post_meta($id, '_wp_attachment_image_alt', true) : $title;

                $out .= $link ? '<a href="' . esc_url(get_the_permalink()) . '">' : '';
                    $out .= '<picture>';
                        $out .= '<source media="(max-width: 575px)" sizes="(max-width: 535px) 535px" srcset="' . wp_get_attachment_image_url($id, $img_size_mobile) . ' 535w">';
                        $out .= '<source media="(max-width: 991px)" sizes="(max-width: 951px) 951px" srcset="' . wp_get_attachment_image_url($id, $img_size_table) . ' 951w">';
                        $out .= '<img alt="' . esc_attr($alt) . '" title="' . esc_attr($title) . '" src="' . esc_url($src) . '" class="attachment-' . esc_attr($img_size_desktop) . ' size-' . esc_attr($img_size_desktop) . ' wp-post-image" />';
                    $out .= '</picture>';
                $out .= $link ? '</a>' : '';
            }
        }

        return $out;
    }
}

// Single Portfolio Gallery Output
if (!function_exists('technum_media_gallery_output')) {
    function technum_media_gallery_output($metabox_name = null, $link = false) {
        $out = '';
        if ( !empty($metabox_name) ) {
            if (technum_post_options() && class_exists('RWMB_Loader') && !empty(technum_get_post_option($metabox_name)) && is_array(technum_get_post_option($metabox_name))) {
                foreach (technum_get_post_option($metabox_name) as $key => $image) {
                    if ( isset($image['sizes']['technum_portfolio_thumbnail']) ) {
                        $src = $image['sizes']['technum_portfolio_thumbnail']['url'];
                    } else {
                        $src = $image['sizes']['medium_large']['url'];
                    }
                    $srcset = $image['sizes']['technum_post_thumbnail_mobile']['url'] . ' 535w, ' . $src . ' 951w';
                    $sizes = '(max-width: 575px) 535px';
                    $title = $image['title'];
                    $alt = !empty($image['alt']) ? $image['alt'] : $title;
                    $out .= '<div class="single-post-gallery-image-item"><img src="' . esc_url($src) . '" alt="' . esc_attr($alt) . '" title="' . esc_attr($title) . '" srcset="' . esc_attr($srcset) . '" sizes="' . esc_attr($sizes) . '" class="attachment-technum_gallery_item wp-post-image" /></div>';
                }
            } else {
                $id = get_post_thumbnail_id();
                if ( !empty(wp_get_attachment_image_url($id, 'technum_portfolio_thumbnail')) ) {
                    $src = wp_get_attachment_image_url($id, 'technum_portfolio_thumbnail');
                } else {
                    $src = wp_get_attachment_image_url($id, 'medium_large');
                }
                $srcset = wp_get_attachment_image_url($id, 'technum_post_thumbnail_mobile') . ' 535w, ' . $src . ' 951w';
                $sizes = '(max-width: 575px) 535px';
                $title = get_post($id)->post_title;
                $alt = (!empty(get_post_meta($id, '_wp_attachment_image_alt', true))) ? get_post_meta($id, '_wp_attachment_image_alt', true) : $title;
                $out = $link ? '<a href="' . esc_url(get_the_permalink()) . '">' : '';
                $out .= '<div class="single-post-gallery-image-item"><img alt="' . esc_attr($alt) . '" title="' . esc_attr($title) . '" srcset="' . esc_attr($srcset) . '" sizes="' . esc_attr($sizes) . '" src="' . esc_url($src) . '" class="attachment-technum_gllery_item wp-post-image" /></div>';
                $out .= $link ? '</a>' : '';
            }
        }

        return $out;
    }
}

// Portfolio Grid Media Output
if ( !function_exists('technum_portfolio_grid_media_output') ) {
    function technum_portfolio_grid_media_output($post_id = null, $columns = 3, $type = '') {
        $out = '';
        $id = get_post_thumbnail_id($post_id);
        $title = get_post($id)->post_title;
        $alt = ( !empty(get_post_meta($id, '_wp_attachment_image_alt', true)) ) ? get_post_meta($id, '_wp_attachment_image_alt', true) : $title;
        switch ( $columns ) {
            case 2:
                if ( $type == 'metro' ) {
                    $img_size_desktop = 'technum_portfolio_metro_2_columns';
                    $img_size_mobile = 'technum_portfolio_metro_3_columns';
                    $img_size_table = 'technum_portfolio_metro_4_columns';
                } elseif ( $type == 'masonry' ) {
                    $img_size_desktop = 'technum_portfolio_masonry_2_columns';
                    $img_size_mobile = 'technum_portfolio_masonry_3_columns';
                    $img_size_table = 'technum_portfolio_masonry_4_columns';
                } else {
                    $img_size_desktop = 'technum_portfolio_grid_2_columns';
                    $img_size_mobile = 'technum_portfolio_grid_3_columns';
                    $img_size_table = 'technum_portfolio_grid_4_columns';
                }
                break;
            case 3:
                if ( $type == 'metro' ) {
                    $img_size_desktop = 'technum_portfolio_metro_3_columns';
                    $img_size_mobile = 'technum_portfolio_metro_3_columns';
                    $img_size_table = 'technum_portfolio_metro_5_columns';
                } elseif ( $type == 'masonry' ) {
                    $img_size_desktop = 'technum_portfolio_masonry_3_columns';
                    $img_size_mobile = 'technum_portfolio_masonry_3_columns';
                    $img_size_table = 'technum_portfolio_masonry_5_columns';
                } else {
                    $img_size_desktop = 'technum_portfolio_grid_3_columns';
                    $img_size_mobile = 'technum_portfolio_grid_3_columns';
                    $img_size_table = 'technum_portfolio_grid_5_columns';
                }
                break;
            case 4:
                if ( $type == 'metro' ) {
                    $img_size_desktop = 'technum_portfolio_metro_4_columns';
                    $img_size_mobile = 'technum_portfolio_metro_3_columns';
                    $img_size_table = 'technum_portfolio_metro_4_columns';
                } elseif ( $type == 'masonry' ) {
                    $img_size_desktop = 'technum_portfolio_masonry_4_columns';
                    $img_size_mobile = 'technum_portfolio_masonry_3_columns';
                    $img_size_table = 'technum_portfolio_masonry_4_columns';
                } else {
                    $img_size_desktop = 'technum_portfolio_grid_4_columns';
                    $img_size_mobile = 'technum_portfolio_grid_3_columns';
                    $img_size_table = 'technum_portfolio_grid_4_columns';
                }
                break;
            case 5:
                if ( $type == 'metro' ) {
                    $img_size_desktop = 'technum_portfolio_metro_5_columns';
                    $img_size_mobile = 'technum_portfolio_metro_3_columns';
                    $img_size_table = 'technum_portfolio_metro_4_columns';
                } elseif ( $type == 'masonry' ) {
                    $img_size_desktop = 'technum_portfolio_masonry_5_columns';
                    $img_size_mobile = 'technum_portfolio_masonry_3_columns';
                    $img_size_table = 'technum_portfolio_masonry_4_columns';
                } else {
                    $img_size_desktop = 'technum_portfolio_grid_5_columns';
                    $img_size_mobile = 'technum_portfolio_grid_3_columns';
                    $img_size_table = 'technum_portfolio_grid_4_columns';
                }
                break;
            case 6:
                if ( $type == 'metro' ) {
                    $img_size_desktop = 'technum_portfolio_metro_6_columns';
                    $img_size_mobile = 'technum_portfolio_metro_3_columns';
                    $img_size_table = 'technum_portfolio_metro_5_columns';
                } elseif ( $type == 'masonry' ) {
                    $img_size_desktop = 'technum_portfolio_masonry_6_columns';
                    $img_size_mobile = 'technum_portfolio_masonry_3_columns';
                    $img_size_table = 'technum_portfolio_masonry_5_columns';
                } else {
                    $img_size_desktop = 'technum_portfolio_grid_6_columns';
                    $img_size_mobile = 'technum_portfolio_grid_3_columns';
                    $img_size_table = 'technum_portfolio_grid_5_columns';
                }
                break;
            default:
                if ( $type == 'metro' ) {
                    $img_size_desktop = 'technum_portfolio_metro_1_columns';
                    $img_size_mobile = 'technum_portfolio_metro_3_columns';
                    $img_size_table = 'technum_portfolio_metro_2_columns';
                } elseif ( $type == 'masonry' ) {
                    $img_size_desktop = 'technum_portfolio_masonry_1_columns';
                    $img_size_mobile = 'technum_portfolio_masonry_3_columns';
                    $img_size_table = 'technum_portfolio_masonry_2_columns';
                } else {
                    $img_size_desktop = 'technum_portfolio_grid_1_columns';
                    $img_size_mobile = 'technum_portfolio_grid_3_columns';
                    $img_size_table = 'technum_portfolio_grid_2_columns';
                }
        }

        $src = wp_get_attachment_image_url($id, $img_size_desktop);
        $srcset = wp_get_attachment_image_url($id, $img_size_mobile) . ' 535w, ' . wp_get_attachment_image_url($id, $img_size_table) . ' 951w, ' . $src . ' 1170w';
        $sizes = '(max-width: 575px) 535px, (max-width: 991px) 951px';

        $out .= '<img alt="' . esc_attr($alt) . '" title="' . esc_attr($title) . '" srcset="' . esc_attr($srcset) . '" sizes="' . esc_attr($sizes) . '" src="' . esc_url($src) . '" class="attachment-' . esc_attr($img_size_desktop) . ' size-' . esc_attr($img_size_desktop) . ' wp-post-image" />';

        return $out;
    }
}

// Single Team Member Media Output
if (!function_exists('technum_team_member_media_output')) {
    function technum_team_member_media_output($link = false) {
        $out = '';
        if ( technum_post_options() && !empty(get_post_thumbnail_id()) ) {
            $id = get_post_thumbnail_id();
            $src = wp_get_attachment_image_url($id, 'technum_team_thumbnail');
            $title = get_post($id)->post_title;
            $alt = ( !empty(get_post_meta($id, '_wp_attachment_image_alt', true)) ) ? get_post_meta($id, '_wp_attachment_image_alt', true) : $title;

            $out = $link ? '<a href="' . esc_url(get_the_permalink()) . '">' : '';
                $out .= '<img alt="' . esc_attr($alt) . '" title="' . esc_attr($title) . '" src="' . esc_url($src) . '" class="attachment-technum_team_thumbnail size-technum_team_thumbnail wp-post-image" />';
            $out .= $link ? '</a>' : '';
        }

        return $out;
    }
}

// Get all Taxonomy Terms Array
if ( !function_exists('technum_get_all_taxonomy_terms') ) {
    function technum_get_all_taxonomy_terms($post_type = null, $taxonomy = null) {
        $terms_arr = [];
        if ( !empty($post_type) && !empty($taxonomy) ) {
            $terms = get_terms(
                [
                    'taxonomy' => $taxonomy,
                    'type' => $post_type,
                    'child_of' => 0,
                    'parent' => '',
                    'orderby' => 'name',
                    'order' => 'ASC',
                    'hierarchical' => 1,
                    'exclude' => '',
                    'include' => '',
                    'number' => 0,
                    'pad_counts' => false
                ]
            );
            if (!empty($terms)) {
                foreach ($terms as $key => $term) {
                    $terms_arr[$term->slug] = $term->name;
                }
            }
        }

        return $terms_arr;
    }
}

// Get Post Categories
if ( !function_exists('technum_post_categories_output') ) {
    function technum_post_categories_output( $link = false ) {
        $categories = get_the_category();
        $categ_code = array();
        if ( is_array($categories) && count($categories) > 0 ) {
            foreach ($categories as $category) {
                if ( $link ) {
                    $categ_code[] = '<a class="post-category-item" href="' . esc_url(get_category_link($category->cat_ID)) . '">' . esc_html($category->name) . '</a>';
                } else {
                    $categ_code[] = '<span class="post-category-item">' . esc_html($category->name) . '</span>';
                }
            }
            return '<div class="post-categories">' . join('', $categ_code) . '</div>';
        } else {
            return false;
        }
    }
};

// Get Case Studies Categories
if ( !function_exists('technum_case_studies_categories_output') ) {
    function technum_case_studies_categories_output( $link = false ) {
        $categories = get_the_terms( null, 'technum_case_study_category' );
        $categ_code = array();
        if ( is_array($categories) && count($categories) > 0 ) {
            foreach ($categories as $category) {
                if ( $link ) {
                    $categ_code[] = '<a class="post-category-item" href="' . esc_url(get_category_link($category->cat_ID)) . '">' . esc_html($category->name) . '</a>';
                } else {
                    $categ_code[] = '<span class="post-category-item">' . esc_html($category->name) . '</span>';
                }
            }
            return '<div class="post-categories">' . join('', $categ_code) . '</div>';
        } else {
            return false;
        }
    }
}

// Get all post of type list
if ( !function_exists('technum_get_all_post_list') ) {
    function technum_get_all_post_list($type = '') {
        $post_list = [];
        if ( !empty($type) ) {
            $all_posts = get_posts(
                [
                    'post_type'     => sanitize_key($type),
                    'numberposts'   => '-1'
                ]
            );

            if ($all_posts > 0) {
                foreach ($all_posts as $post) {
                    setup_postdata($post);
                    $post_list[$post->ID] = $post->post_title;
                }
            } else {
                $post_list = array(
                    'no_posts' => esc_html__('No Posts Were Found', 'technum')
                );
            }
        }

        return $post_list;
    }
}

// Get Post Tags
if ( !function_exists('technum_post_tags_output') ) {
    function technum_post_tags_output($separator = '') {
        if ( !empty(get_the_tag_list()) ) {
            return get_the_tag_list('<div class="post-meta-item post-meta-item-tags">', $separator, '</div>');
        } else {
            return false;
        }
    }
};

// Get Case Studies Tags
if ( !function_exists('technum_case_studies_tags_output') ) {
    function technum_case_studies_tags_output($separator = '') {
        $tags = get_the_terms( null, 'technum_case_study_tag' );
        $tegs_code = array();
        if ( is_array($tags) && count($tags) > 0 ) {
            foreach ($tags as $tag) {
                $tegs_code[] = '<a href="' . esc_url(get_term_link($tag->term_id)) . '" rel="tag">' . esc_html($tag->name) . '</a>';
            }
            return '<div class="post-meta-item post-meta-item-tags">' . join($separator, $tegs_code) . '</div>';
        } else {
            return false;
        }
    }
};

// Get Post Date
if ( !function_exists('technum_post_date_output') ) {
    function technum_post_date_output( $link = false ) {
        if ( !empty(get_the_date()) ) {
            if ( $link ) {
                $date = '<a href="' . get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j')) . '">' . get_the_date() . '</a>';
            } else {
                $date = get_the_date();
            }
            return '<div class="post-meta-item post-meta-item-date">' . wp_kses($date, array('a' => array('href' => true))) . '</div>';
        } else {
            return false;
        }
    }
};

// Get Post Author
if ( !function_exists('technum_post_author_output') ) {
    function technum_post_author_output( $link = false ) {
        if ( !empty(get_the_author_meta('display_name')) ) {
            if ( $link ) {
                $author = '<a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'), get_the_author_meta('nickname'))) . '">' . get_the_author_meta('display_name') . '</a>';
            } else {
                $author = get_the_author_meta('display_name');
            }
            return '<div class="post-meta-item post-meta-item-author">' . esc_html__('By', 'technum') . ' ' . wp_kses($author, array('a' => array('href' => true))) . '</div>';
        } else {
            return false;
        }
    }
};

// Recent Posts
if (!function_exists('technum_recent_posts_output')) {
    function technum_recent_posts_output($args = array(
        'orderby'               => 'rand',
        'numberposts'           => '3',
        'post_type'             => 'post',
        'order'                 => 'desc',
        'show_media'            => 'on',
        'show_category'         => 'on',
        'show_title'            => 'on',
        'show_date'             => 'on',
        'show_author'           => 'on',
        'show_excerpt'          => 'off',
        'excerpt_length'        => '120',
        'show_tags'             => 'off',
        'show_more'             => 'on',
    )) {
        global $post;
        extract($args);

        $currentID = get_the_ID();
        $args = array(
            'post_type'             => $post_type,
            'post__not_in'          => array($currentID),
            'post_status'           => 'publish',
            'orderby'               => $orderby,
            'order'                 => $order,
            'posts_per_page'        => absint($numberposts),
            'ignore_sticky_posts'   => 1,
            'suppress_filters'      => false
        );

        $recent_posts = get_posts($args);

        $wrapper_class = ' archive-listing-wrapper grid-listing columns-' . esc_attr($numberposts);
        $item_class = 'post grid-item grid-blog-item-wrapper';

        if (!empty($recent_posts)) {
            echo '
                <div class="recent-posts-wrapper">
                    <div class="container">';

                        if ( technum_get_prefered_option('recent_posts_customize') == 'on' ) {
                            if ( !empty(technum_get_prepared_option('recent_posts_section_heading', '', 'recent_posts_customize')) ) {
                                echo '<h3 class="recent-posts-wrapper-title">';
                                    echo esc_html(technum_get_prepared_option('recent_posts_section_heading', '', 'recent_posts_customize'));
                                echo '</h3>';
                            }
                        } else {
                            echo '<h3 class="recent-posts-wrapper-title">' . esc_html__('Recent Posts', 'technum') . '</h3>';
                        }

                        echo '<div class="recent-posts' . esc_attr($wrapper_class) . '">';
            $i = 1;
            foreach( $recent_posts as $post ){
                setup_postdata($post);
                $post_format = get_post_format();
                $technum_excerpt = substr(get_the_excerpt(), 0, $excerpt_length);

                echo '<div class="' . esc_attr($item_class) . '">';
                    echo '<div class="blog-item">';

                        if (
                            ( !empty(technum_post_media_output()) && $show_media == 'on' ) ||
                            ( !empty(technum_post_categories_output()) && $post_format != 'quote' && $show_category == 'on' )
                        ) {
                            echo '<div class="post-media-wrapper">';
                                if ( !empty(technum_post_media_output()) && $show_media == 'on' ) {
                                    echo technum_post_media_output(true, $numberposts);
                                }
                                echo '<div class="post-labels">';
                                if ( !empty(technum_post_categories_output()) && $post_format != 'quote' && $show_category == 'on' ) {
                                    echo technum_post_categories_output(true);
                                }
                                echo '</div>';
                            echo '</div>';
                        }

                        if ( !($post_format == 'quote' && technum_post_options() && !empty(technum_get_post_option('post_media_quote_text'))) ) {
                            if (
                                ( !empty(technum_post_date_output()) && $show_date == 'on' ) ||
                                ( !empty(technum_post_author_output()) && $show_author == 'on' )
                            ) {
                                echo '<div class="post-meta-header">';
                                    if ( !empty(technum_post_date_output()) && $show_date == 'on' ) {
                                        echo technum_post_date_output(true);
                                    }
                                    if ( !empty(technum_post_author_output()) && $show_author == 'on' ) {
                                        echo technum_post_author_output(true);
                                    }
                                echo '</div>';
                            }

                            if ( !empty(get_the_title()) && $show_title == 'on' ) {
                                echo '<h4 class="post-title"><a href="' . esc_url(get_the_permalink()) . '">' . get_the_title() . '</a></h4>';
                            }

                            if ( $show_excerpt == 'on' && !empty($technum_excerpt) ) {
                                echo '<div class="post-content">' . esc_html($technum_excerpt) . '</div>';
                            }

                            if ( !empty(technum_post_tags_output()) && $show_tags == 'on' ) {
                                echo technum_post_tags_output(', ');
                            }

                            if ($show_more == 'on') {
                                echo '<div class="post-more-button">';
                                    echo '<a href="' . esc_url(get_the_permalink()) . '">';
                                        echo '<span>' . esc_html__('Read More', 'technum') . '</span>';
                                        echo '<svg viewBox="0 0 13 20"><polyline points="0.5 19.5 3 19.5 12.5 10 3 0.5" /></svg>';
                                    echo '</a>';
                                echo '</div>';
                            }
                        }

                    echo '</div>';
                echo '</div>';

                $i++;
            }
            wp_reset_postdata();
            echo '
                        </div>
                    </div>
                </div>
            ';
        }
    }
}

// Get Taxonomy List
if ( !function_exists('technum_taxonomy_output') ) {
    function technum_taxonomy_output( $taxonomy = 'category', $separator = ', ', $link = false, $pid = null ) {
        $pid        = empty($pid) ? get_the_id() : $pid;
        $terms_arr  = wp_get_post_terms($pid, $taxonomy);
        $terms      = '';

        if ( is_wp_error($terms_arr) ) {
            return $terms;
        }
        for ($i = 0; $i < count($terms_arr); $i++) {
            $term_obj   = $terms_arr[$i];
            $term_slug  = $term_obj->slug;
            $term_name  = $term_obj->name;
            if ( $link ) {
                $term_link = get_term_link($term_slug, $taxonomy);
                $terms .= '<a href="' . esc_url($term_link) . '" class="taxonomy">' . esc_html($term_name) . '</a>' . ( $i < (count($terms_arr) - 1) ? esc_html($separator) : '' );
            } else {
                $terms .= '<span class="taxonomy">' . esc_html($term_name) . '</span>' . ( $i < (count($terms_arr) - 1) ? esc_html($separator) : '' );
            }

        }
        return $terms;
    }
}

// Get Post Navigation
if (!function_exists('technum_post_navigation')) {
    function technum_post_navigation($args = array()) {
        $def_args = array(
            'additional_classes'    => '',
            'prev_label'            => esc_html__('Prev post', 'technum'),
            'next_label'            => esc_html__('Next post', 'technum'),
            'show_labels'           => true,
            'show_posts'            => true,
            'show_archive_icon'     => true,
            'show_taxonomies'       => true,
            'taxonomy_name'         => 'category',
            'taxonomy_separator'    => ', ',
            'taxonomy_link'         => true,
            'show_thumbs'           => true
        );
        $curr_args = array_merge($def_args, $args);

        $first_post_loop = get_posts( 'post_type='.get_post_type().'&numberposts=1&order=ASC' );
        $first_post = $first_post_loop[0];

        $last_post_loop = get_posts( 'post_type='.get_post_type().'&numberposts=1' );
        $last_post = $last_post_loop[0];

        $next_post = get_next_post() ? get_next_post() : $first_post;
        $prev_post = get_previous_post() ? get_previous_post() : $last_post;

        $out = '';

        if ( get_next_post() || get_previous_post() ) {
            $out .= '<nav class="navigation post-navigation' . ( !empty($curr_args['additional_classes']) ? ' ' . esc_attr($curr_args['additional_classes']) : '' ) . '">';
                $out .= '<ul class="post-navigation-list">';
                if ( $prev_post ) {
                    $out .= '<li class="post-navigation-item prev-post">';
                        if ( $curr_args['show_labels'] === true ) {
                            $out .= '<div class="post-navigation-link">';
                                $out .= '<a href="' . get_permalink($prev_post) . '">' . esc_html($curr_args['prev_label']) . '</a>';
                            $out .= '</div>';
                        }
                        if ( $curr_args['show_posts'] === true ) {
                            $out .= '<div class="post-navigation-block">';
                                if ( $curr_args['show_thumbs'] === true ) {
                                    $thumbnail = get_the_post_thumbnail_url($prev_post->ID, array(70, 70));
                                    if ( !empty($thumbnail) ) {
                                        $out .= '<a href="' . get_permalink($prev_post) . '" class="post-navigation-image">';
                                            $out .= '<img src="' . esc_url($thumbnail) . '" alt="' . esc_attr($prev_post->post_title) . '"/>';
                                        $out .= '</a>';
                                    }
                                }
                                $out .= '<div class="post-navigation-content">';
                                    $out .= '<div class="post-navigation-title">';
                                        $out .= '<a href="' . get_permalink( $prev_post ) . '">';
                                            if ( function_exists('wpm') ) {
                                                $out .= wpm_translate_string(wp_kses_post( $prev_post->post_title ));
                                            } else {
                                                $out .= wp_kses_post( $prev_post->post_title );
                                            }
                                        $out .= '</a>';
                                    $out .= '</div>';
                                    if ( $curr_args['show_taxonomies'] === true ) {
                                        $prev_categories = technum_taxonomy_output($curr_args['taxonomy_name'], $curr_args['taxonomy_separator'], $curr_args['taxonomy_link'], $prev_post->ID);
                                        if( !empty($prev_categories) ) {
                                            $out .= '<div class="post-navigation-categories">';
                                                $out .= sprintf('%s', $prev_categories);
                                            $out .= '</div>';
                                        }
                                    }
                                $out .= '</div>';
                            $out .= '</div>';
                        }
                    $out .= '</li>';
                } else {
                    $out .= '<li class="post-navigation-item prev-post disabled"></li>';
                }

                if ( !empty( get_post_type_archive_link( get_post()->post_type ) ) && $curr_args['show_archive_icon'] === true ) {
                    $icon_class = $curr_args['show_labels'] && $curr_args['show_posts'] ? ' with-labels' : '';
                    $out .= '<li class="post-navigation-item archive-icon-link' . esc_attr($icon_class) . '">';
                        $out .= '<a href="' . get_post_type_archive_link(get_post()->post_type) . '" class="archive-icon"></a>';
                    $out .= '</li>';
                }

                if ( $next_post ) {
                    $out .= '<li class="post-navigation-item next-post">';
                        if ( $curr_args['show_labels'] === true ) {
                            $out .= '<div class="post-navigation-link">';
                                $out .= '<a href="' . get_permalink($next_post) . '">' . esc_html($curr_args['next_label']) . '</a>';
                            $out .= '</div>';
                        }
                        if ( $curr_args['show_posts'] === true ) {
                            $out .= '<div class="post-navigation-block">';
                                $out .= '<div class="post-navigation-content">';
                                    $out .= '<div class="post-navigation-title">';
                                        $out .= '<a href="' . get_permalink( $next_post ) . '">';
                                            if ( function_exists('wpm') ) {
                                                $out .= wpm_translate_string(wp_kses_post( $next_post->post_title ));
                                            } else {
                                                $out .= wp_kses_post( $next_post->post_title );
                                            }
                                        $out .= '</a>';
                                    $out .= '</div>';
                                    if ( $curr_args['show_taxonomies'] === true ) {
                                        $next_categories = technum_taxonomy_output($curr_args['taxonomy_name'], $curr_args['taxonomy_separator'], $curr_args['taxonomy_link'], $next_post->ID);
                                        if ( !empty($next_categories) ) {
                                            $out .= '<div class="post-navigation-categories">';
                                                $out .= sprintf('%s', $next_categories);
                                            $out .= '</div>';
                                        }
                                    }
                                $out .= '</div>';
                                if ( $curr_args['show_thumbs'] === true ) {
                                    $thumbnail = get_the_post_thumbnail_url($next_post->ID, array(70, 70));
                                    if ( !empty($thumbnail) ) {
                                        $out .= '<a href="' . get_permalink( $next_post ) . '" class="post-navigation-image">';
                                            $out .= '<img src="' . esc_url($thumbnail) . '" alt="' . esc_attr($next_post->post_title) . '" />';
                                        $out .= '</a>';
                                    }
                                }
                            $out .= '</div>';
                        }
                    $out .= '</li>';
                } else {
                    $out .= '<li class="post-navigation-item next-post disabled"></li>';
                }
                $out .= '</ul>';
            $out .= '</nav>';
        }

        return $out;
    }
}

// Return URL to the current page
if (!function_exists('technum_get_current_url')) {
    function technum_get_current_url() {
        global $wp;
        return home_url(add_query_arg(array(), $wp->request));
    }
}

// Double Menu Walker
class TechnUm_Double_Menu_Walker extends Walker_Nav_Menu {
    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $output .= "</li>{$n}";
        if ( !empty($args->center) && $item->ID == $args->center ) {
            $output .= '</ul>';
            $output .= technum_get_logo_output(false, 'col-auto');

            $output .= '<ul' . ($args->menu_class ? ' class="' . esc_attr($args->menu_class) . '"' : '') . '>';
        }
    }
}

// Logo Output
if ( !function_exists('technum_get_logo_output') ) {
    function technum_get_logo_output($is_mobile = false, $additional_classes = '') {
        $classes = 'logo';
        $classes .= ( !empty($additional_classes) ? ' ' . esc_attr($additional_classes) : '' );
        $classes .= ( technum_get_prefered_option('header_logo_retina') ? ' retina-logo' : ' non-retina-logo' );

        $logo_width = $logo_height = $logo_url = '';

        if ( class_exists('RWMB_Loader') && technum_get_post_option('header_logo_customize') == 'on' ) {
            if ( $is_mobile && !empty(technum_get_post_option('header_logo_mobile_image')) ) {
                $logo_metadata = rwmb_meta( 'header_logo_mobile_image', array( 'size' => 'full' ) );
                foreach ( $logo_metadata as $logo_meta ) {
                    $logo_width = (isset($logo_meta['width']) ? intval($logo_meta['width']) : '');
                    $logo_height = (isset($logo_meta['height']) ? intval($logo_meta['height']) : '');
                    $logo_url = $logo_meta['url'];
                }
                if ( technum_get_post_option('header_logo_mobile_retina') == 1 ) {
                    $logo_width = $logo_width / 2;
                    $logo_height = $logo_height / 2;
                }
            } elseif ( $is_mobile && !empty(technum_get_post_option('header_logo_image')) ) {
                $logo_metadata = rwmb_meta( 'header_logo_image', array( 'size' => 'full' ) );
                foreach ( $logo_metadata as $logo_meta ) {
                    $logo_width = (isset($logo_meta['width']) ? round(intval($logo_meta['width']) * 0.8671) : '');
                    $logo_height = (isset($logo_meta['height']) ? round(intval($logo_meta['height']) * 0.8671) : '');
                    $logo_url = $logo_meta['url'];
                }
                if ( technum_get_post_option('header_logo_retina') == 1 ) {
                    $logo_width = $logo_width / 2;
                    $logo_height = $logo_height / 2;
                }
            } else {
                $logo_metadata = rwmb_meta( 'header_logo_image', array( 'size' => 'full' ) );
                foreach ( $logo_metadata as $logo_meta ) {
                    $logo_width = (isset($logo_meta['width']) ? intval($logo_meta['width']) : '');
                    $logo_height = (isset($logo_meta['height']) ? intval($logo_meta['height']) : '');
                    $logo_url = $logo_meta['url'];
                    if ( technum_get_post_option('header_logo_retina') == 1 ) {
                        $logo_width = $logo_width / 2;
                        $logo_height = $logo_height / 2;
                    }
                }
            }
        } else {
            if ( $is_mobile && !empty(technum_get_theme_mod('header_logo_mobile_image')) ) {
                $logo_metadata = wp_get_attachment_metadata(attachment_url_to_postid(technum_get_theme_mod('header_logo_mobile_image')));
                $logo_width = (isset($logo_metadata['width']) ? $logo_metadata['width'] : 0);
                $logo_height = (isset($logo_metadata['height']) ? $logo_metadata['height'] : 0);
                $logo_url = technum_get_theme_mod('header_logo_mobile_image');
                if ( technum_get_theme_mod('header_logo_mobile_retina') == true ) {
                    $logo_width = $logo_width / 2;
                    $logo_height = $logo_height / 2;
                }
            } elseif ( $is_mobile && !empty(technum_get_theme_mod('header_logo_image')) ) {
                $logo_metadata = wp_get_attachment_metadata(attachment_url_to_postid(technum_get_theme_mod('header_logo_image')));
                $logo_width = (isset($logo_metadata['width']) ? round($logo_metadata['width'] * 0.8671) : 0);
                $logo_height = (isset($logo_metadata['height']) ? round($logo_metadata['height'] * 0.8671) : 0);
                $logo_url = technum_get_theme_mod('header_logo_image');
                if ( technum_get_theme_mod('header_logo_retina') == true ) {
                    $logo_width = $logo_width / 2;
                    $logo_height = $logo_height / 2;
                }
            } else {
                $logo_metadata = wp_get_attachment_metadata(attachment_url_to_postid(technum_get_theme_mod('header_logo_image')));
                $logo_width = (isset($logo_metadata['width']) ? $logo_metadata['width'] : 0);
                $logo_height = (isset($logo_metadata['height']) ? $logo_metadata['height'] : 0);
                $logo_url = technum_get_theme_mod('header_logo_image');
                if ( technum_get_theme_mod('header_logo_retina') == true ) {
                    $logo_width = $logo_width / 2;
                    $logo_height = $logo_height / 2;
                }
            }
        }

        $output = '<div class="' . esc_attr($classes) . '">';
            $output .= '<a class="logo-link" href="' . esc_url(home_url('/')) . '">';
                if ( !empty($logo_url) ) {
                    $output .= '<img width="' . esc_attr($logo_width) . '" height="' . esc_attr($logo_height) . '" src="' . esc_url($logo_url) . '" alt="' . get_bloginfo('name', 'display') . '" />';
                } else {
                    $output .= '<span class="logo-site-name">' . get_bloginfo('name', 'display') . '</span>';
                }
            $output .= '</a>';
        $output .= '</div>';

        return wp_kses(wp_unslash($output), array(
            'div'   => array(
                'class'     => true
            ),
            'span'  => array(
                'class'     => true
            ),
            'a'     => array(
                'class'     => true,
                'href'      => true
            ),
            'img'   => array(
                'class'     => true,
                'src'       => true,
                'width'     => true,
                'height'    => true,
                'alt'       => true
            )
        ));
    }
}

// Logo Output
if ( !function_exists('technum_icon_picker_popover') ) {
    function technum_icon_picker_popover($fa_brands = true, $fa_regular = false, $fa_solid = false, $fontello = false) {
        $icon_container = '<div class="iconpicker-popover popover bottomLeft">';
            $icon_container .= '<div class="arrow"></div>';
            $icon_container .= '<div class="popover-title">';
                $icon_container .= '<input type="search" class="form-control iconpicker-search" placeholder="' . esc_attr__('Type to filter', 'technum') . '">';
            $icon_container .= '</div>';
            $icon_container .= '<div class="popover-content">';
                $icon_container .= '<div class="iconpicker">';
                    $icon_container .= '<div class="iconpicker-items">';

                    if ( $fa_brands ) {
                        $icons = technum_get_fa_brands_icons();
                        sort( $icons );
                        foreach ( $icons as $icon ) {
                            $icon_container .= '<i data-type="iconpicker-item" title=".fa-' . esc_attr($icon) . '" class="fab fa-' . esc_attr($icon) . '"></i>';
                        }
                    }
                    if ( $fa_regular ) {
                        $icons = technum_get_fa_regular_icons();
                        sort( $icons );
                        foreach ( $icons as $icon ) {
                            $icon_container .= '<i data-type="iconpicker-item" title=".fa-' . esc_attr($icon) . '" class="fa fa-' . esc_attr($icon) . '"></i>';
                        }
                    }
                    if ( $fa_solid ) {
                        $icons = technum_get_fa_solid_icons();
                        sort( $icons );
                        foreach ( $icons as $icon ) {
                            $icon_container .= '<i data-type="iconpicker-item" title=".fa-' . esc_attr($icon) . '" class="fas fa-' . esc_attr($icon) . '"></i>';
                        }
                    }
                    if ( $fontello ) {
                        $icons = technum_get_all_fontello_icons();
                        sort( $icons );
                        foreach ( $icons as $icon ) {
                            $icon_container .= '<i data-type="iconpicker-item" title=".icon-' . esc_attr($icon) . '" class="fontello icon-' . esc_attr($icon) . '"></i>';
                        }
                    }

                    $icon_container .= '</div> <!-- /.iconpicker-items -->';
                $icon_container .= '</div> <!-- /.iconpicker -->';
            $icon_container .= '</div> <!-- /.popover-content -->';
        $icon_container .= '</div> <!-- /.iconpicker-popover -->';

        return $icon_container;
    }
}