<?php
/*
 * Created by Artureanec
*/

// Hex 2 RGB
if (!function_exists('technum_hex2rgb')) {
    function technum_hex2rgb($hex) {
        $hex = str_replace("#", "", $hex);

        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
            return $r . "," . $g . "," . $b;
        } elseif (strlen($hex) == 6) {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
            return $r . "," . $g . "," . $b;
        } else {
            return '';
        }
    }
}

// Custom get_theme_mod
if (!function_exists('technum_get_theme_mod')) {
    function technum_get_theme_mod($name) {
        if (func_num_args() > 1) {
            die(sprintf(esc_html__('The technum_get_theme_mod("%s") function takes only one argument. Define default values in core/customizer/customizer.php', 'technum'), $name));
        }

        global $technum_customizer_default_values;

        if (!isset($technum_customizer_default_values[$name])) {
            die(sprintf(esc_html__('Error! You did not add the default value for the "%s" option! core/customizer/customizer.php', 'technum'), $name));
        }
        return get_theme_mod($name, $technum_customizer_default_values[$name]);
    }
}

// Get WooCommerce Endpoint Page ID
if (!function_exists('technum_get_wc_endpoint_page_id')) {
    function technum_get_wc_endpoint_page_id() {
        global $post;
        $page_id = get_the_ID();
        if ( class_exists('WooCommerce') &&  is_woocommerce() ) {
            if ( is_shop() || is_product_category() || is_product_taxonomy() || is_product_tag() ) {
                $page_id = wc_get_page_id('shop');
            } elseif ( is_cart() ) {
                $page_id = wc_get_page_id('cart');
            } elseif ( is_checkout() ) {
                $page_id = wc_get_page_id('checkout');
            } elseif ( is_account_page() ) {
                $page_id = wc_get_page_id('myaccount');
            } elseif ( is_product() ) {
                global $product;
                if ( is_object($product) ) {
                    $page_id = $product->get_id();
                } else {
                    $product_obj = get_page_by_path( $product, OBJECT, 'product' );
                    $page_id = $product_obj->ID;
                }
            }
            $post = get_post($page_id);
        }
    }
}

// Get Preferred Option
if (!function_exists('technum_get_prefered_option')) {
    function technum_get_prefered_option($name) {
        if (func_num_args() > 1) {
            die (sprintf(esc_html__('The technum_get_prefered_option ("%s") function may takes only one argument.', 'technum'), $name));
        }

        global $technum_customizer_default_values;
        technum_get_wc_endpoint_page_id();


        if (!isset($technum_customizer_default_values[$name])) {
            die (sprintf(esc_html__('Error! You did not add the default value for the "%s" option! core/customizer/customizer.php.', 'technum'), $name));
        }

        if (technum_get_post_option($name) && technum_get_post_option($name) !== 'default') {
            return technum_get_post_option($name, $technum_customizer_default_values[$name]);
        } else {
            return technum_get_theme_mod($name);
        }
    }
}

// Get Prepared Color
if ( !function_exists('technum_get_prepared_option') ) {
    function technum_get_prepared_option( $name = '', $default = '', $dependency = '' ) {
        $value = '';
        technum_get_wc_endpoint_page_id();

        if ( !empty($name) ) {
            if ( !empty($dependency) ) {
                if (
                    technum_get_post_option($dependency) == 'on' &&
                    !empty(technum_get_post_option($name))
                ) {
                    $value = technum_get_post_option($name);
                } elseif ( technum_get_post_option($dependency) == 'off' && !empty($default) ) {
                    $value = technum_get_prefered_option($default);
                } elseif ( technum_get_post_option($dependency) == 'off' && empty($default) ) {
                    $value = '';
                } elseif (
                    technum_get_theme_mod($dependency) == 'on' &&
                    !empty(technum_get_theme_mod($name))
                ) {
                    $value = technum_get_theme_mod($name);
                } elseif ( !empty($default) ) {
                    $value = technum_get_prefered_option($default);
                }
            } else {
                $value = technum_get_prefered_option($name);
            }
        }

        return $value;
    }
}

// Get Prepared Image
if ( !function_exists('technum_get_prepared_img_url') ) {
    function technum_get_prepared_img_url( $name = '', $dependency = '' ) {
        $img_url = '';

        if ( !empty($name) ) {
            if ( !empty($dependency) ) {
                if (
                    technum_get_post_option($dependency) == 'on' &&
                    !empty(technum_get_post_option($name)) &&
                    class_exists('RWMB_Loader')
                ) {
                    $img_metadata = rwmb_meta( $name, array( 'size' => 'full', 'limit' => 1 ) );
                    $image = reset( $img_metadata );
                    $img_url = $image['url'];
                } else {
                    $img_url = technum_get_theme_mod($name);
                }
            } else {
                if ( !empty(technum_get_post_option($name)) && class_exists('RWMB_Loader') ) {
                    $img_metadata = rwmb_meta( $name, array( 'size' => 'full', 'limit' => 1 ) );
                    $image = reset( $img_metadata );
                    $img_url = $image['url'];
                } else {
                    $img_url = technum_get_theme_mod($name);
                }
            }
        }

        return esc_url($img_url);
    }
}

if (!function_exists('technum_objectToArray')) {
    function technum_objectToArray ($object) {
        if(!is_object($object) && !is_array($object))
            return $object;

        return array_map('technum_objectToArray', (array) $object);
    }
}

// Output Code
if (!function_exists('technum_output_code')) {
    function technum_output_code($code) {
        return $code;
    }
}

// Widget Callback Function
if (!function_exists('technum_widget_callback_function')) {
    function technum_widget_callback_function() {
        global $wp_registered_widgets;
        $original_callback_params = func_get_args();
        $widget_id = $original_callback_params[0]['widget_id'];

        $original_callback = $wp_registered_widgets[$widget_id]['original_callback'];
        $wp_registered_widgets[$widget_id]['callback'] = $original_callback;

        $widget_id_base = $wp_registered_widgets[$widget_id]['callback'][0]->id_base;

        if (is_callable($original_callback)) {

            ob_start();
            call_user_func_array($original_callback, $original_callback_params);
            $widget_output = ob_get_clean();

            echo apply_filters('widget_output', $widget_output, $widget_id_base, $widget_id);

        }
    }
}

// Get sidebar args
if ( !function_exists('technum_get_sidebar_args') ) {
    function technum_get_sidebar_args() {
        $additional_class = ' simple-sidebar';
        if (
            // is WooCommerce catalog
            class_exists('WooCommerce') &&
            is_woocommerce() &&
            ( is_shop() || is_product_category() || is_product_taxonomy() || is_product_tag() )
        ) {
            $sidebar_name = 'sidebar-woocommerce';
            $sidebar_position = technum_get_prefered_option('catalog_sidebar_position');
            $additional_class = ' shop-hidden-sidebar';
        } elseif (
            // is archive page
            is_archive()
        ) {
            $sidebar_name = 'sidebar-archive';
            $sidebar_position = technum_get_prefered_option('archive_sidebar_position');
        } elseif (
            // is single post page
            get_post_type() == 'post' &&
            ( is_single() ||  is_attachment() )
        ) {
            $sidebar_name = ( technum_get_post_option('post_sidebar_select') != 'default' && !empty(technum_get_post_option('post_sidebar_select')) ? technum_get_post_option('post_sidebar_select') : 'sidebar-post' );
            $sidebar_position = technum_get_prefered_option('post_sidebar_position');
        } elseif (
            // is portfolio single page
            get_post_type() == 'technum_portfolio'
        ) {
            $sidebar_name = '';
            $sidebar_position = 'none';
        } elseif (
            // is project single page
            get_post_type() == 'technum_project'
        ) {
            $sidebar_name = '';
            $sidebar_position = 'none';
        } elseif (
            // is team member page
            get_post_type() == 'technum_team_member'
        ) {
            $sidebar_name = '';
            $sidebar_position = 'none';
        } elseif (
            // is vacancy page
            get_post_type() == 'technum_vacancy'
        ) {
            $sidebar_name = 'sidebar-vacancy';
            $sidebar_position = technum_get_prefered_option('vacancy_sidebar_position');
        } elseif (
            // is service page
            get_post_type() == 'technum_service'
        ) {
//            $sidebar_name = 'sidebar-service';
//            $sidebar_position = technum_get_prefered_option('service_sidebar_position');
            $sidebar_name = ( technum_get_post_option('service_sidebar_select') != 'default' && !empty(technum_get_post_option('service_sidebar_select')) ? technum_get_post_option('service_sidebar_select') : 'sidebar-service' );
            $sidebar_position = technum_get_prefered_option('service_sidebar_position');
        } elseif (
            // is case study page
            get_post_type() == 'technum_case_study'
        ) {
            $sidebar_name = '';
            $sidebar_position = 'none';
        } elseif (
            // is regular page
            is_page()
        ) {
            $sidebar_name = ( technum_get_post_option('page_sidebar_select') != 'default' && !empty(technum_get_post_option('page_sidebar_select')) ? technum_get_post_option('page_sidebar_select') : 'sidebar' );
            $sidebar_position = technum_get_prefered_option('sidebar_position');
        } elseif (
            // is home page with latest posts
            is_home()
        ) {
            $sidebar_name = 'sidebar';
            $sidebar_position = technum_get_prefered_option('sidebar_position');
        } else {
            $sidebar_name = 'sidebar';
            $sidebar_position = 'none';
        }
        $args['sidebar_name'] = $sidebar_name;
        $args['sidebar_position'] = ( is_active_sidebar($sidebar_name) ? $sidebar_position : 'none' );
        $args['additional_class'] = ( is_active_sidebar($sidebar_name) ? $additional_class : '' );
        return $args;
    }
}

// Get all menu list
if ( !function_exists('technum_get_all_menu_list') ) {
    function technum_get_all_menu_list() {
        $menu_list_default = array(
            'default' => esc_html__('Default', 'technum')
        );
        $menu_list = array();
        $menus = wp_get_nav_menus();
        if ( !empty($menus) ) {
            foreach ($menus as $menu) {
                $menu_list[$menu->term_id] = $menu->name;
            }
        }
        $menu_list = $menu_list_default + $menu_list;
        return $menu_list;
    }
}

// Get all sidebar list
if ( !function_exists('technum_get_all_sidebar_list') ) {
    function technum_get_all_sidebar_list() {
        $sidebar_list = array();
        foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
            $sidebar_list[$sidebar['id']] = $sidebar['name'];
        }
        return $sidebar_list;
    }
}

// Phone number formatting
if ( !function_exists('technum_clear_phone') ) {
    function technum_clear_phone($string) {
        $string = '+' . preg_replace('~\D+~','', $string);
        return $string;
    }
}

// Get All Fonts Name
if (!function_exists('technum_get_all_font_names')) {
    function technum_get_all_font_names() {
        global $technum_fonts_array;

        if (is_array($technum_fonts_array['items'])) {
            foreach ($technum_fonts_array['items'] as $key => $font) {
                $font_names[$font['family']] = $font['family'];
            }
        }

        return $font_names;
    }
}

// Get Current Font Weight Options List
if (!function_exists('technum_get_current_font_weight_options')) {
    function technum_get_current_font_weight_options( $font_name ) {
        global $technum_fonts_array;
        if (is_array($technum_fonts_array['items'])) {
            foreach ($technum_fonts_array['items'] as $key => $font) {
                if ( $font['family'] == $font_name && is_array($font['variants'])) {
                    foreach ($font['variants'] as $variant) {
                        $font_weight_options[$variant] = $variant;
                    }
                    return $font_weight_options;
                }
            }
        }
        return array('' => esc_html__('Not Available', 'technum'));
    }
}

// Get Current Font Subset Options List
if (!function_exists('technum_get_current_font_subset_options')) {
    function technum_get_current_font_subset_options( $font_name ) {
        global $technum_fonts_array;
        if (is_array($technum_fonts_array['items'])) {
            foreach ($technum_fonts_array['items'] as $key => $font) {
                if ( $font['family'] == $font_name && is_array($font['subsets'])) {
                    foreach ($font['subsets'] as $subsets) {
                        $font_subset_options[$subsets] = $subsets;
                    }
                    return $font_subset_options;
                }
            }
        }
        return array('' => esc_html__('Not Available', 'technum'));
    }
}

// Get Backup Fonts List
if (!function_exists('technum_get_backup_fonts')) {
    function technum_get_backup_fonts() {
        return array(
            "Arial, Helvetica, sans-serif"                          => "Arial, Helvetica, sans-serif",
            "'Arial Black', Gadget, sans-serif"                     => "'Arial Black', Gadget, sans-serif",
            "'Bookman Old Style', serif"                            => "'Bookman Old Style', serif",
            "'Comic Sans MS', cursive"                              => "'Comic Sans MS', cursive",
            "Courier, monospace"                                    => "Courier, monospace",
            "Garamond, serif"                                       => "Garamond, serif",
            "Georgia, serif"                                        => "Georgia, serif",
            "Impact, Charcoal, sans-serif"                          => "Impact, Charcoal, sans-serif",
            "'Lucida Console', Monaco, monospace"                   => "'Lucida Console', Monaco, monospace",
            "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"    => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
            "'MS Sans Serif', Geneva, sans-serif"                   => "'MS Sans Serif', Geneva, sans-serif",
            "'MS Serif', 'New York', sans-serif"                    => "'MS Serif', 'New York', sans-serif",
            "'Palatino Linotype', 'Book Antiqua', Palatino, serif"  => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
            "Tahoma,Geneva, sans-serif"                             => "Tahoma,Geneva, sans-serif",
            "'Times New Roman', Times,serif"                        => "'Times New Roman', Times,serif",
            "'Trebuchet MS', Helvetica, sans-serif"                 => "'Trebuchet MS', Helvetica, sans-serif",
            "Verdana, Geneva, sans-serif"                           => "Verdana, Geneva, sans-serif"
        );
    }
}

// Get Text Transform Options List
if (!function_exists('technum_get_text_transform_options')) {
    function technum_get_text_transform_options() {
        return array(
            "none"          => esc_html__('None', 'technum'),
            "capitalize"    => esc_html__('Capitalize', 'technum'),
            "uppercase"     => esc_html__('Uppercase', 'technum'),
            "lowercase"     => esc_html__('Lowercase', 'technum'),
            "initial"       => esc_html__('Initial', 'technum'),
            "inherit"       => esc_html__('Inherit', 'technum')
        );
    }
}

// Get Font Style Options List
if (!function_exists('technum_get_font_style_options')) {
    function technum_get_font_style_options() {
        return array(
            "normal"        => esc_html__('Normal', 'technum'),
            "italic"        => esc_html__('Italic', 'technum'),
            "initial"       => esc_html__('Initial', 'technum'),
            "inherit"       => esc_html__('Inherit', 'technum')
        );
    }
}

// Get Font Weight Options List
if (!function_exists('technum_get_font_weight_options')) {
    function technum_get_font_weight_options() {
        return array(
            "100"   => esc_html__('100', 'technum'),
            "200"   => esc_html__('200', 'technum'),
            "300"   => esc_html__('300', 'technum'),
            "400"   => esc_html__('400', 'technum'),
            "500"   => esc_html__('500', 'technum'),
            "600"   => esc_html__('600', 'technum'),
            "700"   => esc_html__('700', 'technum'),
            "800"   => esc_html__('800', 'technum'),
            "900"   => esc_html__('900', 'technum')
        );
    }
}

// Get Unit List
if (!function_exists('technum_get_unit_options')) {
    function technum_get_unit_options() {
        return array(
            "px"            => "px",
            "em"            => "em",
            "%"             => "%"
        );
    }
}

// Get Background Position Options List
if (!function_exists('technum_get_background_position_options')) {
    function technum_get_background_position_options() {
        return array(
            'center center' => esc_html__('Center Center', 'technum'),
            'center left'   => esc_html__('Center Left', 'technum'),
            'center right'  => esc_html__('Center Right', 'technum'),
            'top center'    => esc_html__('Top Center', 'technum'),
            'top left'      => esc_html__('Top Left', 'technum'),
            'top right'     => esc_html__('Top Right', 'technum'),
            'bottom center' => esc_html__('Bottom Center', 'technum'),
            'bottom left'   => esc_html__('Bottom Left', 'technum'),
            'bottom right'  => esc_html__('Bottom Right', 'technum')
        );
    }
}

// Get Background Repeat Options List
if (!function_exists('technum_get_background_repeat_options')) {
    function technum_get_background_repeat_options() {
        return array(
            'no-repeat' => esc_html__('No-repeat', 'technum'),
            'repeat'    => esc_html__('Repeat', 'technum'),
            'repeat-x'  => esc_html__('Repeat-x', 'technum'),
            'repeat-y'  => esc_html__('Repeat-y', 'technum')
        );
    }
}

// Get Background Size Options List
if (!function_exists('technum_get_background_size_options')) {
    function technum_get_background_size_options() {
        return array(
            'initial'   => esc_html__('Default', 'technum'),
            'auto'      => esc_html__('Auto', 'technum'),
            'cover'     => esc_html__('Cover', 'technum'),
            'contain'   => esc_html__('Contain', 'technum')
        );
    }
}

// Only allow values between a certain minimum & maxmium range
if ( !function_exists( 'technum_in_range' ) ) {
    function technum_in_range( $input, $min, $max ){
        if ( $input < $min ) {
            $input = $min;
        }
        if ( $input > $max ) {
            $input = $max;
        }
        return $input;
    }
}

// Get current palette array
if ( !function_exists('technum_get_custom_color_palette') ) {
    function technum_get_custom_color_palette() {
        global $technum_customizer_default_values;
        $colors = array();
        $colors[0] = !empty(technum_get_theme_mod('standard_default_text_color')) ? technum_get_theme_mod('standard_default_text_color') : $technum_customizer_default_values['standard_default_text_color'];
        $colors[1] = !empty(technum_get_theme_mod('standard_dark_text_color')) ? technum_get_theme_mod('standard_dark_text_color') : $technum_customizer_default_values['standard_dark_text_color'];
        $colors[2] = !empty(technum_get_theme_mod('standard_light_text_color')) ? technum_get_theme_mod('standard_light_text_color') : $technum_customizer_default_values['standard_light_text_color'];
        $colors[3] = !empty(technum_get_theme_mod('standard_accent_text_color')) ? technum_get_theme_mod('standard_accent_text_color') : $technum_customizer_default_values['standard_accent_text_color'];
        $colors[4] = !empty(technum_get_theme_mod('standard_background_alter_color')) ? technum_get_theme_mod('standard_background_alter_color') : $technum_customizer_default_values['standard_background_alter_color'];
        $colors[5] = !empty(technum_get_theme_mod('standard_button_background_color')) ? technum_get_theme_mod('standard_button_background_color') : $technum_customizer_default_values['standard_button_background_color'];
        return $colors;
    }
}

// Get Font Awesome Brands Icons
if ( !function_exists('technum_get_fa_brands_icons') ) {
    function technum_get_fa_brands_icons() {
        global $wp_filesystem;
        if (empty($wp_filesystem)) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            WP_Filesystem();
        }
        $file = get_template_directory() . '/fonts/fa-brands-400.svg';
        if ($wp_filesystem && $wp_filesystem->exists($file)) {
            $fa_content = $wp_filesystem->get_contents($file);
            if (preg_match_all('/glyph-name="((\w+|-?)+)"/', $fa_content, $matches, PREG_PATTERN_ORDER)) {
                return $matches[1];
            }
        } else {
            $fa_content_all = wp_remote_get($file);
            $fa_content = $fa_content_all['body'];
            if (preg_match_all('/glyph-name="((\w+|-?)+)"/', $fa_content, $matches, PREG_PATTERN_ORDER)) {
                return $matches[1];
            }
        }
    }
}

// Get Font Awesome Regular Icons
if ( !function_exists('technum_get_fa_regular_icons') ) {
    function technum_get_fa_regular_icons() {
        global $wp_filesystem;
        if (empty($wp_filesystem)) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            WP_Filesystem();
        }
        $file = get_template_directory() . '/fonts/fa-regular-400.svg';
        if ($wp_filesystem && $wp_filesystem->exists($file)) {
            $fa_content = $wp_filesystem->get_contents($file);
            if (preg_match_all('/glyph-name="((\w+|-?)+)"/', $fa_content, $matches, PREG_PATTERN_ORDER)) {
                return $matches[1];
            }
        } else {
            $fa_content_all = wp_remote_get($file);
            $fa_content = $fa_content_all['body'];
            if (preg_match_all('/glyph-name="((\w+|-?)+)"/', $fa_content, $matches, PREG_PATTERN_ORDER)) {
                return $matches[1];
            }
        }
    }
}

// Get Font Awesome Solid Icons
if ( !function_exists('technum_get_fa_solid_icons') ) {
    function technum_get_fa_solid_icons() {
        global $wp_filesystem;
        if (empty($wp_filesystem)) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            WP_Filesystem();
        }
        $file = get_template_directory() . '/fonts/fa-solid-900.svg';
        if ($wp_filesystem && $wp_filesystem->exists($file)) {
            $fa_content = $wp_filesystem->get_contents($file);
            if (preg_match_all('/glyph-name="((\w+|-?)+)"/', $fa_content, $matches, PREG_PATTERN_ORDER)) {
                return $matches[1];
            }
        } else {
            $fa_content_all = wp_remote_get($file);
            $fa_content = $fa_content_all['body'];
            if (preg_match_all('/glyph-name="((\w+|-?)+)"/', $fa_content, $matches, PREG_PATTERN_ORDER)) {
                return $matches[1];
            }
        }
    }
}

// Get All Font Awesome Icons
if ( !function_exists('technum_get_all_fa_icons') ) {
    function technum_get_all_fa_icons() {
        $fa_icons = array_merge(technum_get_fa_brands_icons(), technum_get_fa_regular_icons());
        $fa_icons = array_merge($fa_icons, technum_get_fa_solid_icons());
        return $fa_icons;
    }
}

// Get All Fontello Icons
if ( !function_exists('technum_get_all_fontello_icons') ) {
    function technum_get_all_fontello_icons() {
        global $wp_filesystem;
        if (empty($wp_filesystem)) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            WP_Filesystem();
        }
        $file = get_template_directory() . '/fonts/fontello.svg';
        if ($wp_filesystem && $wp_filesystem->exists($file)) {
            $fa_content = $wp_filesystem->get_contents($file);
            if (preg_match_all('/glyph-name="((\w+|-?)+)"/', $fa_content, $matches, PREG_PATTERN_ORDER)) {
                return $matches[1];
            }
        } else {
            $fa_content_all = wp_remote_get($file);
            $fa_content = $fa_content_all['body'];
            if (preg_match_all('/glyph-name="((\w+|-?)+)"/', $fa_content, $matches, PREG_PATTERN_ORDER)) {
                return $matches[1];
            }
        }
    }
}

if ( !function_exists('technum_get_all_icons') ) {
    function technum_get_all_icons() {
        $all_icons = array_merge(technum_get_all_fa_icons(), technum_get_all_fontello_icons());
        return $all_icons;
    }
}

// Print Resolution Styles
if (!function_exists('technum_print_dimensions_styles')) {
    function technum_print_dimensions_styles($values, $unit = 'px') {
        $out = '';
        $values = json_decode( $values, true );
        $out .= isset($values['width']) && ( !empty($values['width']) || $values['width'] == 0 ) ? 'width: ' . esc_attr($values['width']) . esc_attr($unit) . '; ' : '';
        $out .= isset($values['height']) && ( !empty($values['height']) || $values['height'] == 0 ) ? 'height: ' . esc_attr($values['height']) . esc_attr($unit) . '; ' : '';
        return $out;
    }
}

// Print Dimension Styles
if (!function_exists('technum_print_dimensions_styles')) {
    function technum_print_dimensions_styles($values, $property = 'margin') {
        $out = '';
        $values = json_decode( $values, true );
        $unit   = !empty($values['unit']) ? $values['unit'] : 'px';
        $out .= isset($values['top']) && ( !empty($values['top']) || $values['top'] == 0 ) ? esc_attr($property) . '-top: ' . esc_attr($values['top']) . esc_attr($unit) . '; ' : '';
        $out .= isset($values['right']) && ( !empty($values['right']) || $values['right'] == 0 ) ? esc_attr($property) . '-right: ' . esc_attr($values['right']) . esc_attr($unit) . '; ' : '';
        $out .= isset($values['bottom']) && ( !empty($values['bottom']) || $values['bottom'] == 0 ) ? esc_attr($property) . '-bottom: ' . esc_attr($values['bottom']) . esc_attr($unit) . '; ' : '';
        $out .= isset($values['left']) && ( !empty($values['left']) || $values['left'] == 0 ) ? esc_attr($property) . '-left: ' . esc_attr($values['left']) . esc_attr($unit) . '; ' : '';
        return $out;
    }
}

// Print Font Styles
if (!function_exists('technum_print_font_styles')) {
    function technum_print_font_styles($values, $args = array()) {
        $out            = '';
        $values         = json_decode( $values, true );
        if ( in_array('font_family', $args) ) {
            $family = isset($values['font_family']) && !empty($values['font_family']) ? $values['font_family'] : '';
            $backup = isset($values['font_backup']) && !empty($values['font_backup']) ? $values['font_backup'] : '';
            if ( !empty($family) && !empty($backup) ) {
                $out .= 'font-family: ' . esc_attr($family) . ', ' . esc_attr($backup) . '; ';
            } elseif ( !empty($family) ) {
                $out .= 'font-family: ' . esc_attr($family) . '; ';
            } else {
                $out .= 'font-family: ' . esc_attr($backup) . '; ';
            }
        }
        if ( in_array('font_size', $args) ) {
            $size   = isset($values['font_size']) && ( !empty($values['font_size']) || $values['font_size'] == 0 ) ? technum_sanitize_float($values['font_size']) : '';
            $unit   = isset($values['font_size_unit']) && !empty($values['font_size_unit']) ? $values['font_size_unit'] : 'px';
            $out .= !empty($size) || $size == 0 ? 'font-size: ' . esc_attr($size) . esc_attr($unit) . '; ' : '';
        }
        if ( in_array('line_height', $args) ) {
            $height = isset($values['line_height']) && ( !empty($values['line_height']) || $values['line_height'] == 0 ) ? technum_sanitize_float($values['line_height']) : '';
            $unit   = isset($values['line_height_unit']) && !empty($values['line_height_unit']) ? $values['line_height_unit'] : 'px';
            $out .= !empty($height) || $height == 0 ? 'line-height: ' . esc_attr($height) . esc_attr($unit) . '; ' : '';
        }
        if ( in_array('text_transform', $args) ) {
            $out .= isset($values['text_transform']) && !empty($values['text_transform']) ? 'text-transform: ' . esc_attr($values['text_transform']) . '; ' : '';
        }
        if ( in_array('letter_spacing', $args) ) {
            $space  = isset($values['letter_spacing']) && ( !empty($values['letter_spacing']) || $values['letter_spacing'] == 0 ) ? $values['letter_spacing'] : '';
            $unit   = isset($values['letter_spacing_unit']) && !empty($values['letter_spacing_unit']) ? $values['letter_spacing_unit'] : 'px';
            $out .= ( !empty($space) || $space == 0 ) ? 'letter-spacing: ' . esc_attr($space) . esc_attr($unit) . '; ' : '';
        }
        if ( in_array('word_spacing', $args) ) {
            $space  = isset($values['word_spacing']) && ( !empty($values['word_spacing']) || $values['word_spacing'] == 0 ) ? $values['word_spacing'] : '';
            $unit   = isset($values['word_spacing_unit']) && !empty($values['word_spacing_unit']) ? $values['word_spacing_unit'] : 'px';
            $out .= !empty($space) || $space == 0 ? 'word-spacing: ' . esc_attr($space) . esc_attr($unit) . '; ' : '';
        }
        if ( in_array('font_style', $args) ) {
            $style  = isset($values['font_style']) && !empty($values['font_style']) ? $values['font_style'] : '';
            $out .= !empty($style) ? 'font-style: ' . esc_attr($style) . '; ' : '';
        }
        if ( in_array('font_weight', $args) ) {
            $weight  = isset($values['font_weight']) && !empty($values['font_weight']) ? $values['font_weight'] : '';
            $out .= !empty($weight) ? 'font-weight: ' . esc_attr($weight) . '; ' : '';
        }
        return $out;
    }
}