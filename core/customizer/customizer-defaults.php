<?php
/*
 * Created by Artureanec
*/

global $technum_customizer_default_values;
$technum_customizer_default_values = array(
    # General
        # Page Loader
        'page_loader_status'                        => 'on',
        'page_loader_image'                         => '',

    # Top Bar
        # Top Bar General
        'top_bar_status'                            => 'off',
        'top_bar_customize'                         => 'off',
        'top_bar_default_text_color'                => '',
        'top_bar_dark_text_color'                   => '',
        'top_bar_light_text_color'                  => '',
        'top_bar_accent_text_color'                 => '',
        'top_bar_border_color'                      => '',
        'top_bar_border_hover_color'                => '',
        'top_bar_background_color'                  => '',
        'top_bar_background_alter_color'            => '',
        'top_bar_button_text_color'                 => '',
        'top_bar_button_border_color'               => '',
        'top_bar_button_background_color'           => '',
        'top_bar_button_text_hover'                 => '',
        'top_bar_button_border_hover'               => '',
        'top_bar_button_background_hover'           => '',

        # Top Bar Social Buttons
        'top_bar_socials_status'                    => 'off',

        # Top Bar Additional Text
        'top_bar_additional_text_status'            => 'off',
        'top_bar_additional_text'                   => '',
        'top_bar_additional_text_title'             => '',

        # Top Bar Contacts
        'top_bar_contacts_email_status'             => 'off',
        'top_bar_contacts_email'                    => '',
        'top_bar_contacts_phone_status'             => 'off',
        'top_bar_contacts_phone'                    => '',
        'top_bar_contacts_address_status'           => 'off',
        'top_bar_contacts_address'                  => '',

    # Header Settings
        #General
        'header_status'                             => 'on',
        'header_style'                              => 'type-1',
        'header_position'                           => 'above',
        'header_customize'                          => 'off',
        'header_default_text_color'                 => '',
        'header_dark_text_color'                    => '',
        'header_light_text_color'                   => '',
        'header_accent_text_color'                  => '',
        'header_border_color'                       => '',
        'header_border_hover_color'                 => '',
        'header_background_color'                   => '',
        'header_background_alter_color'             => '',
        'header_button_text_color'                  => '',
        'header_button_border_color'                => '',
        'header_button_background_color'            => '',
        'header_button_text_hover'                  => '',
        'header_button_border_hover'                => '',
        'header_button_background_hover'            => '',

        # Sticky Header
        'sticky_header_status'                      => 'off',

        # Mobile Header
        'mobile_header_breakpoint'                  => '1365',

        # Header Logo
        'header_logo_status'                        => 'on',
        'header_logo_customize'                     => 'off',
        'header_logo_image'                         => '',
        'header_logo_retina'                        => false,
        'header_logo_mobile_image'                  => '',
        'header_logo_mobile_retina'                 => false,

        # Header Button
        'header_button_status'                      => 'off',
        'header_button_text'                        => esc_html__('Request Quote', 'technum'),
        'header_button_url'                         => '#',

        # Header Menu
        'header_menu_status'                        => 'on',
        'header_menu_select'                        => 'default',
        'header_menu_customize'                     => 'on',
        'header_menu_font'                          => '{"font_family":"Inter","font_backup":"Arial, Helvetica, sans-serif","font_styles":"600","font_subset":"latin","font_size":"13","font_size_unit":"px","line_height":"1.5","line_height_unit":"em","text_transform":"uppercase","letter_spacing":"0","letter_spacing_unit":"em","word_spacing":"0","word_spacing_unit":"px","font_style":"normal","font_weight":"600"}',
        'header_sub_menu_font'                      => '{"font_family":"Inter","font_backup":"Arial, Helvetica, sans-serif","font_styles":"600","font_subset":"latin","font_size":"14","font_size_unit":"px","line_height":"1.5","line_height_unit":"em","text_transform":"none","letter_spacing":"0","letter_spacing_unit":"em","word_spacing":"0","word_spacing_unit":"px","font_style":"normal","font_weight":"400"}',

        # Header Callback
        'header_callback_status'                    => 'off',
        'header_callback_title'                     => '',
        'header_callback_text'                      => '',

        # Header Side Panel
        'side_panel_status'                         => 'off',

        # Header Search
        'header_search_status'                      => 'on',

        # Header Minicart
        'header_minicart_status'                    => 'on',

        # Header Login/Logout
        'header_login_status'                       => 'off',

    # Page Title
        # General
        'page_title_status'                         => 'on',
        'page_title_overlay_status'                 => 'off',
        'page_title_overlay_color'                  => '',
        'page_title_customize'                      => 'on',
        'page_title_height'                         => '350',
        'page_title_default_text_color'             => '',
        'page_title_dark_text_color'                => '#ffffff',
        'page_title_light_text_color'               => '#c6d1e6',
        'page_title_accent_text_color'              => '#3ad5fc',
        'page_title_border_color'                   => '',
        'page_title_border_hover_color'             => '',
        'page_title_background_color'               => '#2f5aa8',
        'page_title_background_alter_color'         => '',
        'page_title_button_text_color'              => '',
        'page_title_button_border_color'            => '',
        'page_title_button_background_color'        => '',
        'page_title_button_text_hover'              => '',
        'page_title_button_border_hover'            => '',
        'page_title_button_background_hover'        => '',
        'page_title_background_image'               => '',
        'page_title_background_position'            => 'center center',
        'page_title_background_repeat'              => 'no-repeat',
        'page_title_background_size'                => 'cover',
        'hide_page_title_background_mobile'         => false,
        'hide_page_title_background_tablet'         => false,

        # Heading
        'page_title_heading_customize'              => 'off',
        'page_title_heading_font'                   => '{"font_family":"Inter","font_backup":"Arial, Helvetica, sans-serif","font_styles":"700,800","font_subset":"latin","font_size":"80","font_size_unit":"px","line_height":"1.2","line_height_unit":"em","text_transform":"none","letter_spacing":"-0.02","letter_spacing_unit":"em","word_spacing":"0","word_spacing_unit":"px","font_style":"normal","font_weight":"700"}',

        # Breadcrumbs
        'page_title_breadcrumbs_status'             => 'on',
        'page_title_breadcrumbs_customize'          => 'off',
        'page_title_breadcrumbs_font'               => '{"font_family":"Nunito","font_backup":"Arial, Helvetica, sans-serif","font_styles":"400","font_subset":"latin","font_size":"16","font_size_unit":"px","line_height":"30","line_height_unit":"px","text_transform":"none","letter_spacing":"0","letter_spacing_unit":"em","word_spacing":"0","word_spacing_unit":"px","font_style":"normal","font_weight":"400"}',

        # Additional
        'page_title_additional_text'                => '',
        'page_title_additional_customize'           => 'off',
        'page_title_additional_text_color'          => '',

    # Typography
        # Main Font
        'main_font'                                 => '{"font_family":"Nunito","font_backup":"Arial, Helvetica, sans-serif","font_styles":"400","font_subset":"latin","font_size":"16","font_size_unit":"px","line_height":"1.875","line_height_unit":"em","text_transform":"none","letter_spacing":"0","letter_spacing_unit":"em","word_spacing":"0","word_spacing_unit":"px","font_style":"normal","font_weight":"400"}',

        # Additional Font
        'additional_font'                           => '{"font_family":"Roboto","font_backup":"Arial, Helvetica, sans-serif","font_styles":"900","font_subset":"latin","font_weight":"900"}',

        # Headings
        'headings_font'                             => '{"font_family":"Inter","font_backup":"Arial, Helvetica, sans-serif","font_styles":"500,600,700,800","font_subset":"latin","text_transform":"none","font_style":"normal"}',
        'h1_font'                                   => '{"font_size":"80","font_size_unit":"px","line_height":"1.1","line_height_unit":"em","letter_spacing":"0","letter_spacing_unit":"em","word_spacing":"0","word_spacing_unit":"px","font_weight":"700"}',
        'h2_font'                                   => '{"font_size":"40","font_size_unit":"px","line_height":"1.25","line_height_unit":"em","letter_spacing":"0","letter_spacing_unit":"em","word_spacing":"0","word_spacing_unit":"px","font_weight":"700"}',
        'h3_font'                                   => '{"font_size":"24","font_size_unit":"px","line_height":"1.4167","line_height_unit":"em","font_weight":"700"}',
        'h4_font'                                   => '{"font_size":"20","font_size_unit":"px","line_height":"1.6","line_height_unit":"em","letter_spacing":"0","letter_spacing_unit":"em","word_spacing":"0","word_spacing_unit":"px","font_weight":"700"}',
        'h5_font'                                   => '{"font_size":"18","font_size_unit":"px","line_height":"1.7776","line_height_unit":"em","letter_spacing":"0","letter_spacing_unit":"em","word_spacing":"0","word_spacing_unit":"px","font_weight":"700"}',
        'h6_font'                                   => '{"font_size":"16","font_size_unit":"px","line_height":"1.75","line_height_unit":"em","letter_spacing":"0","letter_spacing_unit":"em","word_spacing":"0","word_spacing_unit":"px","font_weight":"700"}',

        # Buttons
        'buttons_font'                              => '{"font_family":"Inter","font_backup":"Arial, Helvetica, sans-serif","font_styles":"600","font_subset":"latin","font_size":"12","font_size_unit":"px","text_transform":"uppercase","letter_spacing":"0","letter_spacing_unit":"em","word_spacing":"0","word_spacing_unit":"px","font_style":"normal","font_weight":"600"}',

    # Social Links
        'socials_target'                            => true,
        'social_buttons'                            => '',

    # Color Options
        # Standard colors
        'standard_default_text_color'               => '#797e89',
        'standard_dark_text_color'                  => '#1f2531',
        'standard_light_text_color'                 => '#a9b5c9',
        'standard_accent_text_color'                => '#00bbee',
        'standard_border_color'                     => '#e0e0e0',
        'standard_border_hover_color'               => '#e8edf6',
        'standard_background_color'                 => '#ffffff',
        'standard_background_alter_color'           => '#f2f5fa',
        'standard_button_text_color'                => '#ffffff',
        'standard_button_border_color'              => '#005aac',
        'standard_button_background_color'          => '#00dbb0',
        'standard_button_text_hover'                => '#ffffff',
        'standard_button_border_hover'              => '#00bbee',
        'standard_button_background_hover'          => '#00bbee',

        # Contrast colors
        'contrast_default_text_color'               => '#aeb3bd',
        'contrast_dark_text_color'                  => '#ffffff',
        'contrast_light_text_color'                 => '#aeb3bd',
        'contrast_accent_text_color'                => '#00bbee',
        'contrast_border_color'                     => '#2d3340',
        'contrast_border_hover_color'               => '#31394b',
        'contrast_background_color'                 => '#1f2531',
        'contrast_background_alter_color'           => '#272e3b',
        'contrast_button_text_color'                => '#ffffff',
        'contrast_button_border_color'              => '#005aac',
        'contrast_button_background_color'          => '#00dbb0',
        'contrast_button_text_hover'                => '#ffffff',
        'contrast_button_border_hover'              => '#00bbee',
        'contrast_button_background_hover'          => '#00bbee',

    # Footer
        # General
        'footer_status'                             => 'on',
        'footer_style'                              => 'type-1',
        'footer_customize'                          => 'off',
        'footer_default_text_color'                 => '',
        'footer_dark_text_color'                    => '',
        'footer_light_text_color'                   => '',
        'footer_accent_text_color'                  => '',
        'footer_border_color'                       => '',
        'footer_border_hover_color'                 => '',
        'footer_background_color'                   => '',
        'footer_background_alter_color'             => '',
        'footer_button_text_color'                  => '',
        'footer_button_border_color'                => '',
        'footer_button_background_color'            => '',
        'footer_button_text_hover'                  => '',
        'footer_button_border_hover'                => '',
        'footer_button_background_hover'            => '',
        'footer_background_image'                   => '',
        'footer_background_position'                => 'center center',
        'footer_background_repeat'                  => 'no-repeat',
        'footer_background_size'                    => 'cover',

        # Footer Widgets
        'footer_sidebar_status'                     => 'on',
        'footer_sidebar_select'                     => 'sidebar-footer-style1',

        # Copyright
        'footer_copyright_status'                   => 'on',
        'footer_copyright_text'                     => esc_html__('© 2021 TechnUm Theme', 'technum'),

        # Footer Menu
        'footer_menu_status'                        => 'on',
        'footer_menu_select'                        => '',

        # Footer Additional Menu
        'footer_additional_menu_status'             => 'on',
        'footer_additional_menu_select'             => '',

    # Sidebars
        'sidebar_position'                          => 'right',
        'archive_sidebar_position'                  => 'none',
        'post_sidebar_position'                     => 'right',
        'vacancy_sidebar_position'                  => 'left',
        'service_sidebar_position'                  => 'right',
        'catalog_sidebar_position'                  => 'right',

    # Single Post
        # Post Settings
        'post_page_title'                           => esc_html__('Blog', 'technum'),
        'post_media_image_status'                   => 'on',
        'post_category_status'                      => 'on',
        'post_date_status'                          => 'on',
        'post_author_status'                        => 'on',
        'post_title_status'                         => 'on',
        'post_tags_status'                          => 'on',
        'post_socials_status'                       => 'off',

        # Recent Posts Settings
        'recent_posts_status'                       => 'off',
        'recent_posts_customize'                    => 'off',
        'recent_posts_section_heading'              => esc_html__('Recent Posts', 'technum'),
        'recent_posts_number'                       => '2',
        'recent_posts_order_by'                     => 'random',
        'recent_posts_order'                        => 'desc',
        'recent_posts_image'                        => 'on',
        'recent_posts_category'                     => 'on',
        'recent_posts_date'                         => 'on',
        'recent_posts_author'                       => 'on',
        'recent_posts_title'                        => 'on',
        'recent_posts_excerpt'                      => 'off',
        'recent_posts_excerpt_length'               => '120',
        'recent_posts_tags'                         => 'off',
        'recent_posts_more'                         => 'on',

    # Portfolio
        # Archive
        'portfolio_archive_page_title'              => esc_html__('Portfolios', 'technum'),
        'portfolio_archive_columns_number'          => 3,
        'portfolio_archive_posts_per_page'          => 9,

        # Single
        'portfolio_single_page_title'               => esc_html__('Portfolio', 'technum'),

    # Projects
        # Archive
        'project_archive_page_title'                => esc_html__('Projects', 'technum'),
        'project_archive_columns_number'            => 3,
        'project_archive_posts_per_page'            => 9,

        # Single
        'project_single_page_title'                 => esc_html__('Project Details', 'technum'),

    # Case Studies
        # Archive
        'case_studies_archive_page_title'           => esc_html__('Case Studies', 'technum'),
        'case_studies_archive_excerpt_length'       => 83,
        'case_studies_archive_columns_number'       => 3,
        'case_studies_archive_posts_per_page'       => 9,

        #Single
        'case_studies_single_page_title'            => esc_html__('Case Study', 'technum'),

    # Team
        # Archive
        'team_archive_page_title'                   => esc_html__('Team', 'technum'),
        'team_archive_columns_number'               => 3,
        'team_archive_posts_per_page'               => 12,

        # Single
        'team_single_page_title'                    => esc_html__('Team Member', 'technum'),

    # Vacancies
        # Archive
        'vacancy_archive_page_title'                => esc_html__('Career', 'technum'),
        'vacancy_archive_excerpt_length'            => 152,
        'vacancy_archive_posts_per_page'            => 5,

        # Single
        'vacancy_single_page_title'                 => esc_html__('Vacancy Details', 'technum'),
        'recent_vacancies_status'                   => 'on',
        'recent_vacancies_customize'                => 'off',
        'recent_vacancies_section_heading'          => esc_html__('Recent Vacancies', 'technum'),
        'recent_vacancies_number'                   => 3,
        'recent_vacancies_order_by'                 => 'date',
        'recent_vacancies_order'                    => 'desc',

    # Services
        # Archive
        'service_archive_page_title'                => esc_html__('Services', 'technum'),
        'service_archive_excerpt_length'            => 50,
        'service_archive_columns_number'            => 3,
        'service_archive_posts_per_page'            => 9,

        # Single
        'service_single_page_title'                 => esc_html__('Service', 'technum'),

    # 404 Error Page
        'error_main_image'                          => get_template_directory_uri() . '/img/404.png',
        'error_title'                               => esc_html__("Oops! Page not found!", 'technum'),
        'error_text'                                => esc_html__("ragonfish sheepshead minnow finback cat shark stingfish goblin shark cuskfish? Zebra tilapia yellow tang eeltail catfish Blenny goldfish zebra", 'technum'),
        'error_logo_status'                         => 'on',
        'error_socials_status'                      => 'on',
        'error_button_status'                       => 'on',
        'error_button_text'                         => esc_html__('Home Page', 'technum'),
        'error_background_customize'                => 'off',
        'error_background_color'                    => '',
        'error_background_image'                    => '',
        'error_background_position'                 => 'center center',
        'error_background_repeat'                   => 'no-repeat',
        'error_background_size'                     => 'cover',

    # WooCommerce
        'woo_single_product_show_related_section'   => 'on',
        'woo_related_title'                         => esc_html__('Best Sellers Products', 'technum'),
        'woo_single_product_title'                  => esc_html__('%\s', 'technum'),
        'woo_single_product_show_name'              => false,
        'woo_upsells_title'                         => esc_html__('Up-Sells Products', 'technum'),
        'woo_product_categories_title'              => esc_html__('Shop Category: %\s', 'technum'),
        'woo_product_tags_title'                    => esc_html__('Product Tag: %\s', 'technum')
);
