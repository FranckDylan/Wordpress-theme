<?php
# One Click Demo Content Import
if (!function_exists('technum_ocdi_import_files')) {
    function technum_ocdi_import_files() {
        return array(
            array(
                'import_file_name'              => 'TechnUm',
                'categories'                    => array('With Images'),
                'import_file_url'               => trailingslashit(get_template_directory_uri()) . 'core/import/import.xml',
                'import_widget_file_url'        => trailingslashit(get_template_directory_uri()) . 'core/import/widgets.xml',
                'import_customizer_file_url'    => trailingslashit(get_template_directory_uri()) . 'core/import/customizer.xml',
                'import_preview_image_url'      => trailingslashit(get_template_directory_uri()) . 'screenshot.png',
                'preview_url'                   => 'https://demo.artureanec.com/themes/technum',
            ),
        );
    }
}
add_filter( 'pt-ocdi/import_files', 'technum_ocdi_import_files' );

# Remove Branding Message
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

# Disable Regenerate for Thumbs
//add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' ); // This will greatly improve the time needed to import the content (images), but only the original sized images will be imported.

if (!function_exists('technum_after_activation')) {
    function technum_after_activation() {
        function technum_after_switch_theme_message() {
            echo '<div class="updated notice is-dismissible"><p>' . esc_html__('After activating all the recommended plugins, you can import all demo content in one-touch. Appearance > Import Demo Data.', 'technum') . '</p></div>';
        }
        add_action('admin_notices', 'technum_after_switch_theme_message');
    }
}
add_action('after_switch_theme', 'technum_after_activation', 10 , 2);

# Remove all posts, pages and products before content import
if ( !function_exists('technum_ocdi_before_content_import') ) {
    function technum_ocdi_before_content_import() {
        $allposts= get_posts( array(
            'post_type'     => array('post', 'page', 'products', 'attachment', ''),
            'numberposts'   => -1
        ) );
        foreach ($allposts as $eachpost) {
            wp_delete_post( $eachpost->ID, true );
        }
    }
}
add_action( 'pt-ocdi/before_content_import', 'technum_ocdi_before_content_import' );

# Clear sidebars before the widgets get imported
if ( !function_exists('technum_ocdi_before_widgets_import') ) {
    function technum_ocdi_before_widgets_import() {
        update_option( 'sidebars_widgets', array() );
    }
}
add_action( 'pt-ocdi/before_widgets_import', 'technum_ocdi_before_widgets_import' );


if (!function_exists('technum_ocdi_after_import_setup')) {
    function technum_ocdi_after_import_setup() {
        // Assign menus to their locations.
        $main_menu              = get_term_by('name', 'Main Menu', 'nav_menu');
        $top_bar_user_menu      = get_term_by('name', 'Top Bar User Menu', 'nav_menu');
        $footer_menu            = get_term_by('name', 'Footer Menu', 'nav_menu');
        $footer_additional_menu = get_term_by('name', 'Footer Additional Menu', 'nav_menu');

        set_theme_mod('nav_menu_locations', array(
            'main'              => $main_menu->term_id,
            'top_bar_user_menu' => $top_bar_user_menu->term_id,
            'footer_menu'       => $footer_menu->term_id,
            'footer_add_menu'   => $footer_additional_menu->term_id,
        ));

        // Assign front page and posts page (blog page).
        $front_page_id = get_page_by_title('Home 1');
        # $blog_page_id  = get_page_by_title( 'Blog' );
        update_option('show_on_front', 'page');
        update_option('page_on_front', $front_page_id->ID);
        // update_option( 'page_for_posts', $blog_page_id->ID );

        // Set Mailchimp for WP options
        if ( function_exists( 'mc4wp' ) ) {
            $has_forms = get_posts(
                array(
                    'post_type'   => 'mc4wp-form',
                    'post_status' => 'publish',
                    'numberposts' => 1,
                )
            );
            update_option( 'mc4wp_default_form_id', $has_forms[0]->ID );
        }

        // Set WooCommerce options
        if ( class_exists('WooCommerce') ) {
            if (!wc_update_product_lookup_tables_is_running()) {
                wc_update_product_lookup_tables();
            }
            $args = array(
                'post_type'     => 'product',
                'post_status'   => 'publish',
                'orderby'       => 'date',
                'order'         => 'ASC'
            );
            $loop = new WP_Query($args);
            while ($loop->have_posts()) {
                $loop->the_post();
                global $product;
                wc_delete_product_transients($product->get_id());
            }

            $shop_page_id       = get_page_by_title('Shop');
            $cart_page_id       = get_page_by_title('Cart');
            $checkout_page_id   = get_page_by_title('Checkout');
            $account_page_id    = get_page_by_title('My account');
            update_option( 'woocommerce_shop_page_id', $shop_page_id->ID );
            update_option( 'woocommerce_cart_page_id', $cart_page_id->ID );
            update_option( 'woocommerce_checkout_page_id', $checkout_page_id->ID );
            update_option( 'woocommerce_myaccount_page_id', $account_page_id->ID );
            update_option( 'permalink_structure', '/%postname%/' );
        }

        // Set Elementor options
        if ( did_action('elementor/loaded') ) {
            update_option('elementor_disable_color_schemes', 'yes');
            update_option('elementor_disable_typography_schemes', 'yes');

            update_option('elementor_experiment-e_dom_optimization', 'inactive');
            update_option('elementor_experiment-a11y_improvements', 'inactive');
            update_option('elementor_experiment-additional_custom_breakpoints', 'inactive');

            $kit = \Elementor\Plugin::$instance->kits_manager->get_active_kit_for_frontend();
            $kit->update_settings(
                [
                    'container_width'       => [
                        'unit'  => 'px',
                        'size'  => 1170,
                        'sizes' => []
                    ],
                    'space_between_widgets' => [
                        'unit'  => 'px',
                        'size'  => 30,
                        'sizes' => []
                    ],
                    'viewport_mobile'       => 767,
                    'viewport_tablet'       => 991,
                    'system_colors'         => [
                        0       => [
                            '_id'   => 'primary',
                            'title' => esc_html__('Primary', 'technum'),
                            'color' => '#a9b5c9'
                        ],
                        1       => [
                            '_id'   => 'secondary',
                            'title' => esc_html__('Secondary', 'technum'),
                            'color' => '#1f2531'
                        ],
                        2       => [
                            '_id'   => 'text',
                            'title' => esc_html__('Text', 'technum'),
                            'color' => '#797e89'
                        ],
                        3       => [
                            '_id'   => 'accent',
                            'title' => esc_html__('Accent', 'technum'),
                            'color' => '#00bbee'
                        ]
                    ]
                ]
            );
        }

        // Import forms
        if ( function_exists('wpforms') ) {
            $title = esc_html__('Get a Quote with Message', 'technum');
            $form_id = wpforms()->form->add($title);
            $form_id = wpforms()->form->update(
                $form_id,
                array(
                    'id'        => '6203',
                    'field_id'  => 6,
                    'fields'    => array(
                        '0'                         => array(
                            'id'                        => '0',
                            'type'                      => 'text',
                            'label'                     => esc_html__('Name', 'technum'),
                            'description'               => '',
                            'required'                  => '1',
                            'size'                      => 'large',
                            'placeholder'               => esc_attr__('Name *', 'technum'),
                            'default_value'             => '',
                            'input_mask'                => '',
                            'css'                       => '',
                            'label_hide'                => '1',
                            'sublabel_hide'             => '1',
                        ),
                        '1'                         => array(
                            'id'                        => '1',
                            'type'                      => 'email',
                            'label'                     => esc_html__('Email', 'technum'),
                            'description'               => '',
                            'required'                  => '1',
                            'size'                      => 'large',
                            'placeholder'               => esc_attr__('Email *', 'technum'),
                            'confirmation_placeholder'  => '',
                            'default_value'             => '',
                            'filter_type'               => '',
                            'allowlist'                 => '',
                            'denylist'                  => '',
                            'css'                       => '',
                            'label_hide'                => '1',
                            'sublabel_hide'             => '1',
                        ),
                        '4'                         => array(
                            'id'                        => '4',
                            'type'                      => 'text',
                            'label'                     => esc_html__('Phone', 'technum'),
                            'description'               => '',
                            'required'                  => '1',
                            'size'                      => 'large',
                            'placeholder'               => esc_attr__('Phone *', 'technum'),
                            'limit_count'               => '17',
                            'limit_mode'                => 'characters',
                            'default_value'             => '',
                            'input_mask'                => '+9 (999)-999-9999',
                            'css'                       => '',
                            'label_hide'                => '1',
                            'sublabel_hide'             => '1',
                        ),
                        '5'                         => array(
                            'id'                        => '5',
                            'type'                      => 'textarea',
                            'label'                     => esc_html__('Message', 'technum'),
                            'description'               => '',
                            'size'                      => 'small',
                            'placeholder'               => esc_attr__('Message...', 'technum'),
                            'limit_count'               => '1',
                            'limit_mode'                => 'characters',
                            'default_value'             => '',
                            'css'                       => '',
                            'label_hide'                => '1',
                            'sublabel_hide'             => '1',
                        ),
                    ),
                    'settings' => array(
                        'form_title'                => $title,
                        'form_desc'                 => esc_html__('Thank you for reaching out to UtechSoftware! Please fill the form right. Our team will contact you shortly.', 'technum'),
                        'submit_text'               => esc_html__('Send a Message', 'technum'),
                        'submit_text_processing'    => esc_html__('Sending...', 'technum'),
                        'antispam'                  => '1',
                        'form_class'                => '',
                        'submit_class'              => '',
                        'ajax_submit'               => '1',
                        'notification_enable'       => '1',
                        'notifications'             => array(
                            '1'                         => array(
                                'email'                     => '{admin_email}',
                                'subject'                   => esc_html__('New Get a Quote Entry', 'technum'),
                                'sender_name'               => 'TechnUm',
                                'sender_address'            => '{admin_email}',
                                'replyto'                   => '',
                                'message'                   => '{all_fields}',
                            ),
                        ),
                        'confirmations'             => array(
                            '1'                         => array(
                                'type'                      => 'message',
                                'message'                   => '<p>' . esc_html__('Thanks for contacting us! We will be in touch with you shortly.', 'technum') . '</p>',
                                'message_scroll'            => '1',
                                'page'                      => '172',
                                'redirect'                  => '',
                            ),
                        ),
                    ),
                    'meta'                      => array(
                        'template'                  => '4dbf022985a4fe4bda4a80365011a3a0',
                    ),
                )
            );
            wp_update_post(
                array(
                    'ID'         => $form_id,
                    'post_title' => $title,
                )
            );

            $title2 = esc_html__('Get a Quote', 'technum');
            $form_id2 = wpforms()->form->add($title2);
            $form_id2 = wpforms()->form->update(
                $form_id2,
                array(
                    'id'        => '3002',
                    'field_id'  => 5,
                    'fields'    => array(
                        '0'                         => array(
                            'id'                        => '0',
                            'type'                      => 'text',
                            'label'                     => esc_html__('Name', 'technum'),
                            'description'               => '',
                            'required'                  => '1',
                            'size'                      => 'large',
                            'placeholder'               => esc_attr__('Name *', 'technum'),
                            'default_value'             => '',
                            'input_mask'                => '',
                            'css'                       => '',
                            'label_hide'                => '1',
                            'sublabel_hide'             => '1',
                        ),
                        '1'                         => array(
                            'id'                        => '1',
                            'type'                      => 'email',
                            'label'                     => esc_html__('Email', 'technum'),
                            'description'               => '',
                            'required'                  => '1',
                            'size'                      => 'large',
                            'placeholder'               => esc_attr__('Email *', 'technum'),
                            'confirmation_placeholder'  => '',
                            'default_value'             => '',
                            'filter_type'               => '',
                            'allowlist'                 => '',
                            'denylist'                  => '',
                            'css'                       => '',
                            'label_hide'                => '1',
                            'sublabel_hide'             => '1',
                        ),
                        '3'                         => array(
                            'id'                        => '3',
                            'type'                      => 'text',
                            'label'                     => esc_html__('Company', 'technum'),
                            'description'               => '',
                            'size'                      => 'large',
                            'placeholder'               => esc_attr__('Company', 'technum'),
                            'limit_count'               => '1',
                            'limit_mode'                => 'characters',
                            'default_value'             => '',
                            'input_mask'                => '',
                            'css'                       => '',
                            'label_hide'                => '1',
                            'sublabel_hide'             => '1',
                        ),
                        '4'                         => array(
                            'id'                        => '4',
                            'type'                      => 'text',
                            'label'                     => esc_html__('Phone', 'technum'),
                            'description'               => '',
                            'required'                  => '1',
                            'size'                      => 'large',
                            'placeholder'               => esc_attr__('Phone *', 'technum'),
                            'limit_count'               => '17',
                            'limit_mode'                => 'characters',
                            'default_value'             => '',
                            'input_mask'                => '+9 (999)-999-9999',
                            'css'                       => '',
                            'label_hide'                => '1',
                            'sublabel_hide'             => '1',
                        ),
                    ),
                    'settings' => array(
                        'form_title'                => $title2,
                        'form_desc'                 => esc_html__('Thank you for reaching out to UtechSoftware! Please fill the form right. Our team will contact you shortly.', 'technum'),
                        'submit_text'               => esc_html__('Get Pricing Now', 'technum'),
                        'submit_text_processing'    => esc_html__('Sending...', 'technum'),
                        'antispam'                  => '1',
                        'form_class'                => '',
                        'submit_class'              => '',
                        'ajax_submit'               => '1',
                        'notification_enable'       => '1',
                        'notifications'             => array(
                            '1'                         => array(
                                'email'                     => '{admin_email}',
                                'subject'                   => esc_html__('New Get a Quote Entry', 'technum'),
                                'sender_name'               => 'TechnUm',
                                'sender_address'            => '{admin_email}',
                                'replyto'                   => '',
                                'message'                   => '{all_fields}',
                            ),
                        ),
                        'confirmations'             => array(
                            '1'                         => array(
                                'type'                      => 'message',
                                'message'                   => '<p>' . esc_html__('Thanks for contacting us! We will be in touch with you shortly.', 'technum') . '</p>',
                                'message_scroll'            => '1',
                                'page'                      => '172',
                                'redirect'                  => '',
                            ),
                        ),
                    ),
                    'meta'                      => array(
                        'template'                  => '4dbf022985a4fe4bda4a80365011a3a0',
                    ),
                )
            );
            wp_update_post(
                array(
                    'ID'         => $form_id2,
                    'post_title' => $title2,
                )
            );

            $title3 = esc_html__('Send Us Message', 'technum');
            $form_id3 = wpforms()->form->add($title3);
            $form_id3 = wpforms()->form->update(
                $form_id3,
                array(
                    'id'        => '1966',
                    'field_id'  => 3,
                    'fields'    => array(
                        '0'                         => array(
                            'id'                        => '0',
                            'type'                      => 'text',
                            'label'                     => esc_html__('Name', 'technum'),
                            'description'               => '',
                            'required'                  => '1',
                            'size'                      => 'large',
                            'placeholder'               => esc_attr__('Name *', 'technum'),
                            'default_value'             => '',
                            'input_mask'                => '',
                            'css'                       => '',
                            'label_hide'                => '1',
                            'sublabel_hide'             => '1',
                        ),
                        '1'                         => array(
                            'id'                        => '1',
                            'type'                      => 'email',
                            'label'                     => esc_html__('Email', 'technum'),
                            'description'               => '',
                            'required'                  => '1',
                            'size'                      => 'large',
                            'placeholder'               => esc_attr__('Email *', 'technum'),
                            'confirmation_placeholder'  => '',
                            'default_value'             => '',
                            'filter_type'               => '',
                            'allowlist'                 => '',
                            'denylist'                  => '',
                            'css'                       => '',
                            'label_hide'                => '1',
                            'sublabel_hide'             => '1',
                        ),
                        '2'                         => array(
                            'id'                        => '2',
                            'type'                      => 'textarea',
                            'label'                     => esc_html__('Message', 'technum'),
                            'description'               => '',
                            'required'                  => '1',
                            'size'                      => 'small',
                            'placeholder'               => esc_attr__('Message...', 'technum'),
                            'limit_count'               => '1',
                            'limit_mode'                => 'characters',
                            'default_value'             => '',
                            'css'                       => '',
                            'label_hide'                => '1',
                            'sublabel_hide'             => '1',
                        ),
                    ),
                    'settings' => array(
                        'form_title'                => $title3,
                        'form_desc'                 => '',
                        'submit_text'               => esc_html__('Send a Message', 'technum'),
                        'submit_text_processing'    => esc_html__('Sending...', 'technum'),
                        'antispam'                  => '1',
                        'form_class'                => '',
                        'submit_class'              => '',
                        'ajax_submit'               => '1',
                        'notification_enable'       => '1',
                        'notifications'             => array(
                            '1'                         => array(
                                'email'                     => '{admin_email}',
                                'subject'                   => esc_html__('New Send Us Message Entry', 'technum'),
                                'sender_name'               => 'TechnUm',
                                'sender_address'            => '{admin_email}',
                                'replyto'                   => '',
                                'message'                   => '{all_fields}',
                            ),
                        ),
                        'confirmations'             => array(
                            '1'                         => array(
                                'type'                      => 'message',
                                'message'                   => '<p>' . esc_html__('Thanks for contacting us! We will be in touch with you shortly.', 'technum') . '</p>',
                                'message_scroll'            => '1',
                                'page'                      => '172',
                                'redirect'                  => '',
                            ),
                        ),
                    ),
                    'meta'                      => array(
                        'template'                  => '4dbf022985a4fe4bda4a80365011a3a0',
                    ),
                )
            );
            wp_update_post(
                array(
                    'ID'         => $form_id3,
                    'post_title' => $title3,
                )
            );
        }

    }
}
add_action( 'pt-ocdi/after_import', 'technum_ocdi_after_import_setup' );