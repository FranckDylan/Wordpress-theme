<?php

// --------------------------------- //
// ------ Typography Settings ------ //
// --------------------------------- //

# Main Font
$main_font          = technum_get_prepared_option('main_font');
$main_font_array    = json_decode($main_font, true);
if (
    !empty($main_font_array['font_family']) ||
    !empty($main_font_array['font_size']) ||
    !empty($main_font_array['line_height']) ||
    !empty($main_font_array['text_transform']) ||
    !empty($main_font_array['letter_spacing']) ||
    !empty($main_font_array['word_spacing']) ||
    !empty($main_font_array['font_style']) ||
    !empty($main_font_array['font_weight'])
) {
    $technum_custom_css .= '
        body,
        body input,
        body textarea,
        body select,
        .grid-listing .grid-item,
        .case-study-grid-listing .grid-item,
        .elementor-widget-image-box .elementor-image-box-wrapper .elementor-image-box-content .elementor-image-box-description,
        div.wpforms-container.wpforms-container-full .wpforms-form input[type="date"],
        div.wpforms-container.wpforms-container-full .wpforms-form input[type="datetime"],
        div.wpforms-container.wpforms-container-full .wpforms-form input[type="datetime-local"],
        div.wpforms-container.wpforms-container-full .wpforms-form input[type="email"],
        div.wpforms-container.wpforms-container-full .wpforms-form input[type="month"],
        div.wpforms-container.wpforms-container-full .wpforms-form input[type="number"],
        div.wpforms-container.wpforms-container-full .wpforms-form input[type="password"],
        div.wpforms-container.wpforms-container-full .wpforms-form input[type="range"],
        div.wpforms-container.wpforms-container-full .wpforms-form input[type="search"],
        div.wpforms-container.wpforms-container-full .wpforms-form input[type="tel"],
        div.wpforms-container.wpforms-container-full .wpforms-form input[type="text"],
        div.wpforms-container.wpforms-container-full .wpforms-form input[type="time"],
        div.wpforms-container.wpforms-container-full .wpforms-form input[type="url"],
        div.wpforms-container.wpforms-container-full .wpforms-form input[type="week"],
        div.wpforms-container.wpforms-container-full .wpforms-form select,
        div.wpforms-container.wpforms-container-full .wpforms-form textarea,
        .error-404-info-text,
        .elementor-widget-technum_image_carousel .technum-image-slider-widget .slider-item .elementor-image-carousel-caption,
        .technum-image-slider-widget .slider-item-description {' .
            technum_print_font_styles( $main_font, array('font_family', 'font_size', 'line_height', 'text_transform', 'letter_spacing', 'word_spacing', 'font_style', 'font_weight') ) .
        '}
    ';
}
if (
    !empty($main_font_array['font_size'])
) {
    $technum_custom_css .= '
        .post-more-button,
        .filter-control-wrapper .filter-control-list .dots .dot {' .
            technum_print_font_styles( $main_font, array('font_size') ) .
        '}
    ';
}
if (
    !empty($main_font_array['line_height'])
) {
    $technum_custom_css .= '
        p,
        .filter-control-wrapper .filter-control-list .dots .dot {' .
            technum_print_font_styles( $main_font, array('line_height') ) .
        '}
    ';
}
if (
    !empty($main_font_array['font_size']) ||
    !empty($main_font_array['line_height']) ||
    !empty($main_font_array['font_weight'])
) {
    $technum_custom_css .= '
        .post-excerpt,
        .woocommerce form label,
        .post-content,
        .service-item .service-item-excerpt {' .
            technum_print_font_styles( $main_font, array('font_size', 'line_height', 'font_weight') ) .
        '}
        .woocommerce form .form-row input::-webkit-input-placeholder,
        .woocommerce form .form-row textarea::-webkit-input-placeholder {' .
            technum_print_font_styles( $main_font, array('font_size', 'line_height', 'font_weight') ) .
        '}
        .woocommerce form .form-row input:-moz-placeholder,
        .woocommerce form .form-row textarea:-moz-placeholder {' .
            technum_print_font_styles( $main_font, array('font_size', 'line_height', 'font_weight') ) .
        '}
        .woocommerce form .form-row input::-moz-placeholder,
        .woocommerce form .form-row textarea::-moz-placeholder {' .
            technum_print_font_styles( $main_font, array('font_size', 'line_height', 'font_weight') ) .
        '}
        .woocommerce form .form-row input:-ms-input-placeholder,
        .woocommerce form .form-row textarea:-ms-input-placeholder {' .
            technum_print_font_styles( $main_font, array('font_size', 'line_height', 'font_weight') ) .
        '}
    ';
}
if (
    !empty($main_font_array['font_family'])
) {
    $technum_custom_css .= '
        body .content-wrapper .elementor-widget-text-editor,
        .elementor-icon-list-items .elementor-icon-list-item .elementor-icon-list-text,
        .footer .widget_nav_menu ul li,
        .footer .widget_archive ul li,
        .footer .widget_categories ul li,
        .widget_pages ul li {' .
            technum_print_font_styles( $main_font, array('font_family') ) .
        '}
    ';
}

# Additional Font
$additional_font = technum_get_prepared_option('additional_font');
$additional_font_array = json_decode($additional_font, true);
if (
    !empty($additional_font_array['font_family']) ||
    !empty($additional_font_array['font_weight'])
) {
    $technum_custom_css .= '
        .result-box .result-box-value,
        .special-title .special-title-backward,
        .elementor-widget-counter .elementor-counter .elementor-counter-number-wrapper,
        .technum-heading .technum-subheading,
        .elementor-widget-technum_special_text .special-text,
        .page-title-wrapper .page-title-additional {' .
            technum_print_font_styles( $additional_font, array('font_family', 'font_weight') ) .
        '}
    ';
}

# Headings
$headings_font          = technum_get_prepared_option('headings_font');
$headings_font_array    = json_decode($headings_font, true);
if (
    !empty($headings_font_array['font_family']) ||
    !empty($headings_font_array['text_transform']) ||
    !empty($headings_font_array['font_style'])
) {
    $technum_custom_css .= '
        h1, h2, h3, h4, h5, h6,
        .page-title-container .page-title-box .page-title,
        body .elementor-widget-heading .elementor-heading-title,
        .woocommerce-Reviews-title,
        .woocommerce .comment-reply-title,
        .cart_totals h2,
        .woocommerce-account .woocommerce-EditAccountForm fieldset legend,
        .elementor-widget-image-box .elementor-image-box-wrapper .elementor-image-box-content .elementor-image-box-title,
        .wpforms-form .wpforms-title,
        .wp-block-search .wp-block-search__label {' .
            technum_print_font_styles( $headings_font, array('font_family', 'text_transform', 'font_style') ) .
        '}
    ';
}
if (
    !empty($headings_font_array['font_family'])
) {
    $technum_custom_css .= '
        .logo,
        .mobile-header-menu-container .header-mobile-contacts .contact-item,
        .top-bar,
        .wrapper-info .additional-text-title,
        .post-categories a.post-category-item,
        .post-meta-header .post-meta-item,
        .single-post .post-meta-footer .post-meta-item,
        .post-comment-buttons a,
        .post-comment-author,
        .post-comment-date,
        div.wpforms-container.wpforms-container-full .wpforms-form .wpforms-field-number-slider .wpforms-field-number-slider-hint,
        div.wpforms-container.wpforms-container-full .wpforms-form .wpforms-field-label,
        .widget_technum_featured_posts_widget .featured-posts-item-link,
        .widget_technum_featured_posts_widget .featured-posts-item-date,
        .wp-block-latest-posts .wp-block-latest-posts__post-date,
        .wp-block-latest-comments .wp-block-latest-comments__comment-date,
        .portfolio-item .post-title,
        .team-experience-item-title,
        .team-experience-item-period,
        .team-item .post-title,
        .project-item-wrapper .post-title,
        .project-post-meta .project-post-meta-label,
        .vacancy-info,
        .vacancy-item .vacancy-item-header,
        .vacancy-item .vacancy-item-salary,
        .help-item .help-item-title,
        .technum-step-widget .step-bg-number,
        .technum-step-widget .step-number,
        .technum-testimonial-carousel-widget .testimonial-carousel-wrapper .author-name,
        .elementor-widget-accordion .elementor-accordion .elementor-tab-title,
        .filter-control-wrapper .filter-control-list .dots .dot,
        .widget_recent_comments ul .recentcomments,
        .wp-block-latest-comments .wp-block-latest-comments__comment-meta,
        .widget_archive ul li,
        .wp-block-archives li,
        .widget_categories ul li,
        .wp-block-categories li,
        .widget_technum_featured_posts_widget .featured-posts-item-link,
        .widget_recent_entries li,
        .wp-block-latest-posts li a,
        .widget_meta ul li,
        .widget_pages ul li,
        .widget_nav_menu ul li,
        .widget_rss ul a.rsswidget,
        .wp-block-rss .wp-block-rss__item-title,
        .widget_tag_cloud .tagcloud .tag-cloud-link,
        .wp-block-tag-cloud .tag-cloud-link,
        .post-meta-footer .post-meta-item-tags,
        .post-comment-author,
        .content-wrapper .wp-block-pullquote blockquote cite,
        .post-more-button a,
        .post-quote .post-quote-author,
        .content-pagination .page-numbers,
        .content-pagination .post-page-numbers,
        .post-navigation-link,
        .post-navigation-title,
        .post-navigation-categories,
        .technum-price-item-widget .price-item .price-item-title,
        .technum-price-item-widget .price-item .price-item-container,
        .technum-person-widget .person-name,
        .elementor-widget-counter .elementor-counter .elementor-counter-title,
        .banner-widget .banner-subtitle,
        .technum_tabs_widget .technum_tabs_titles_container .technum_tab_title_item,
        .elementor-widget-technum_countdown .countdown_separator,
        .elementor-widget-technum_countdown .countdown_digits,
        .elementor-widget-technum_countdown .countdown_digits_placeholder,
        .technum_content_slider_widget .technum_content_slider_title,
        body .content-wrapper blockquote cite,
        .elementor-widget-image-box .elementor-image-box-wrapper .elementor-image-box-content .elementor-image-box-title,
        .technum_content_slider_widget .slick-navigation .slick-arrow,
        .widget_calendar caption, 
        .wp-block-calendar caption,
        .widget_rss ul a.rsswidget,
        .widget_rss .rss-date,
        .widget_rss cite,
        .widget_technum_contacts_widget .technum-contacts-widget-field,
        .result-box,
        .technum-heading .technum-heading-content,
        .single-product.woocommerce div.product .product_meta .product_meta_item.tagged_as a,
        .elementor-widget-technum_vertical_text .vertical-text,
        .technum-image-slider-widget .slider-item-title,
        .elementor-widget-progress .elementor-widget-container .elementor-title,
        .elementor-widget-progress .elementor-progress-bar,
        .technum-content-slider-widget .bottom-area .content-slider-contacts,
        .callback,
        .elementor-widget-technum_custom_menu ul li a {' .
            technum_print_font_styles( $headings_font, array('font_family') ) .
        '}
    ';
}
$h1_font        = technum_get_prepared_option('h1_font');
$h1_font_array  = json_decode($h1_font, true);
if (
    !empty($h1_font_array['font_weight']) ||
    !empty($h1_font_array['letter_spacing']) ||
    !empty($h1_font_array['word_spacing'])
) {
    $technum_custom_css .= '
        h1,
        body .elementor-widget-heading h1.elementor-heading-title {' .
            technum_print_font_styles( $h1_font, array('font_weight','letter_spacing','word_spacing') ) .
        '}
    ';
}
if (
    !empty($h1_font_array['font_size']) ||
    !empty($h1_font_array['line_height'])
) {
    if ( (int)$h1_font_array['font_size'] > 60 ) {
        $technum_custom_css .= '
            @media only screen and (min-width: 576px) {
                h1,
                .page-title-container .page-title-box,
                body .elementor-widget-heading h1.elementor-heading-title {
                    font-size: 60px;
                }
            }
        ';
    }
    $technum_custom_css .= '
        @media only screen and (min-width: 992px) {
            h1,
            .page-title-container .page-title-box,
            body .elementor-widget-heading h1.elementor-heading-title {' .
            technum_print_font_styles( $h1_font, array('font_size', 'line_height' ) ) .
            '}
        }
    ';
}
$h2_font        = technum_get_prepared_option('h2_font');
$h2_font_array  = json_decode($h2_font, true);
if (
    !empty($h2_font_array['font_weight']) ||
    !empty($h2_font_array['letter_spacing']) ||
    !empty($h2_font_array['word_spacing'])
) {
    $technum_custom_css .= '
        h2,
        body .elementor-widget-heading h2.elementor-heading-title {' .
            technum_print_font_styles( $h2_font, array('font_weight','letter_spacing','word_spacing') ) .
        '}
    ';
}
if (
    !empty($h2_font_array['font_size']) ||
    !empty($h2_font_array['line_height'])
) {
    $technum_custom_css .= '
        @media only screen and (min-width: 576px) {
            h2,
            body .elementor-widget-heading h2.elementor-heading-title {' .
                technum_print_font_styles( $h2_font, array('font_size', 'line_height') ) .
            '}
        }
    ';
}
$h3_font        = technum_get_prepared_option('h3_font');
$h3_font_array  = json_decode($h3_font, true);
if (
    !empty($h3_font_array['font_weight']) ||
    !empty($h3_font_array['letter_spacing']) ||
    !empty($h3_font_array['word_spacing'])
) {
    $technum_custom_css .= '
        h3,
        body .elementor-widget-heading h3.elementor-heading-title,
        .woocommerce .comment-reply-title,
        .woocommerce-Reviews-title {' .
            technum_print_font_styles( $h3_font, array('font_weight','letter_spacing','word_spacing') ) .
        '}
    ';
}
if (
    !empty($h3_font_array['font_size']) ||
    !empty($h3_font_array['line_height'])
) {
    $technum_custom_css .= '
        @media only screen and (min-width: 576px) {
            h3,
            body .elementor-widget-heading h3.elementor-heading-title,
            .woocommerce .comment-reply-title,
            .woocommerce-Reviews-title {' .
            technum_print_font_styles(  $h3_font, array('font_size', 'line_height') ) .
            '}
        }
    ';
}
$h4_font        = technum_get_prepared_option('h4_font');
$h4_font_array  = json_decode($h4_font, true);
if (
    !empty($h4_font_array['font_weight']) ||
    !empty($h4_font_array['letter_spacing']) ||
    !empty($h4_font_array['word_spacing'])
) {
    $technum_custom_css .= '
        h4,
        body .elementor-widget-heading h4.elementor-heading-title,
        .cart_totals h2,
        .woocommerce-checkout h3,
        .widget_block .widget-wrapper h1,
        .widget_block .widget-wrapper h2,
        .widget_block .widget-wrapper h3 {' .
            technum_print_font_styles( $h4_font, array('font_weight','letter_spacing','word_spacing') ) .
        '}
    ';
}
if (
    !empty($h4_font_array['font_size']) ||
    !empty($h4_font_array['line_height'])
) {
    $technum_custom_css .= '
        @media only screen and (min-width: 576px) {
            h4,
            body .elementor-widget-heading h4.elementor-heading-title,
            .woocommerce-checkout h3,
            .cart_totals h2,
            .wp-block-search .wp-block-search__label,
            .widget_block .widget-wrapper h1,
            .widget_block .widget-wrapper h2,
            .widget_block .widget-wrapper h3 {' .
                technum_print_font_styles( $h4_font, array('font_size', 'line_height') ) .
            '}
        }
    ';
}
$h5_font        = technum_get_prepared_option('h5_font');
$h5_font_array  = json_decode($h5_font, true);
if (
    !empty($h5_font_array['font_weight']) ||
    !empty($h5_font_array['letter_spacing']) ||
    !empty($h5_font_array['word_spacing'])
) {
    $technum_custom_css .= '
        h5,
        .wpforms-form .wpforms-title,
        body .elementor-widget-heading h5.elementor-heading-title,
        .woocommerce-account h3,
        .woocommerce-account .woocommerce-EditAccountForm fieldset legend,
        .outer-form-wrapper h2,
        .woocommerce-MyAccount-content h2,
        .woocommerce-order h2 {' .
            technum_print_font_styles( $h5_font, array('font_weight','letter_spacing','word_spacing') ) .
        '}
    ';
}
if (
    !empty($h5_font_array['font_size']) ||
    !empty($h5_font_array['line_height'])
) {
    $technum_custom_css .= '
        @media only screen and (min-width: 576px) {
            h5,
            .wpforms-form .wpforms-title,
            body .elementor-widget-heading h5.elementor-heading-title,
            .woocommerce-account h3,
            .woocommerce-account .woocommerce-EditAccountForm fieldset legend,
            .outer-form-wrapper h2,
            .woocommerce-MyAccount-content h2,
            .woocommerce-order h2 {' .
                technum_print_font_styles( $h5_font, array('font_size', 'line_height') ) .
            '}
        }
    ';
}
$h6_font        = technum_get_prepared_option('h6_font');
$h6_font_array  = json_decode($h6_font, true);
if (
    !empty($h6_font_array['font_weight']) ||
    !empty($h6_font_array['letter_spacing']) ||
    !empty($h6_font_array['word_spacing'])
) {
    $technum_custom_css .= '
        h6,
        body .elementor-widget-heading h6.elementor-heading-title {' .
            technum_print_font_styles( $h6_font, array('font_weight','letter_spacing','word_spacing') ) .
        '}
    ';
}
if (
    !empty($h6_font_array['font_size']) ||
    !empty($h6_font_array['line_height'])
) {
    $technum_custom_css .= '
        @media only screen and (min-width: 576px) {
            h6,
            body .elementor-widget-heading h6.elementor-heading-title,
            
            .footer-widgets .wp-block-search .wp-block-search__label {' .
                technum_print_font_styles( $h6_font, array('font_size', 'line_height') ) .
            '}
        }
    ';
}

# Buttons
$buttons_font       = technum_get_prepared_option('buttons_font');
$buttons_font_array = json_decode($buttons_font, true);
if (
    !empty($buttons_font_array['font_family']) ||
    !empty($buttons_font_array['font_size']) ||
    !empty($buttons_font_array['text_transform']) ||
    !empty($buttons_font_array['letter_spacing']) ||
    !empty($buttons_font_array['word_spacing']) ||
    !empty($buttons_font_array['font_style']) ||
    !empty($buttons_font_array['font_weight'])
) {
    $technum_custom_css .= '
        .technum-button,
        .wp-block-button .wp-block-button__link,
        button,
        input[type="submit"],
        input[type="button"],
        input[type="reset"],
        div.wpforms-container.wpforms-container-full .wpforms-form input[type="submit"],
        div.wpforms-container.wpforms-container-full .wpforms-form button[type="submit"],
        div.wpforms-container.wpforms-container-full .wpforms-form .wpforms-page-button {' .
            technum_print_font_styles( $buttons_font, array('font_family', 'font_size', 'text_transform', 'letter_spacing', 'word_spacing', 'font_style', 'font_weight') ) .
        '}
    ';
}