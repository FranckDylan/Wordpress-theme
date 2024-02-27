<?php

// ----------------------------- //
// ------ Standard Colors ------ //
// ----------------------------- //

$standard_default_text_color = technum_get_prefered_option('standard_default_text_color');
if ( !empty($standard_default_text_color) ) {
    $technum_custom_css .= '
        .content-wrapper,
        .content-pagination .page-numbers,
        .content-pagination .post-page-numbers,
        .single-post .post-meta-footer .post-meta-item.post-meta-item-tags a,
        .widget_tag_cloud .tagcloud .tag-cloud-link,
        .wp-block-tag-cloud .tag-cloud-link,
        .project-item-wrapper .project-item-categories,
        .project-item-wrapper .project-item-categories a,
        .technum-price-item-widget .price-item.price-item-type-standard .price-item-custom-field.active,
        .error-404-info-text,
        .widget_categories ul li:hover li,
        .woocommerce-product-gallery .flex-control-nav .slick-button,
        .single-product.woocommerce div.product .product_meta .product_meta_item.tagged_as a {
            color: ' . esc_attr($standard_default_text_color) . ';
        }
        .content-wrapper input[type="text"]::-webkit-input-placeholder,
        .content-wrapper input[type="email"]::-webkit-input-placeholder,
        .content-wrapper input[type="url"]::-webkit-input-placeholder,
        .content-wrapper input[type="password"]::-webkit-input-placeholder,
        .content-wrapper input[type="search"]::-webkit-input-placeholder,
        .content-wrapper input[type="tel"]::-webkit-input-placeholder,
        .content-wrapper input[type="number"]::-webkit-input-placeholder, 
        .content-wrapper input[type="date"]::-webkit-input-placeholder, 
        .content-wrapper input[type="month"]::-webkit-input-placeholder, 
        .content-wrapper input[type="week"]::-webkit-input-placeholder, 
        .content-wrapper input[type="time"]::-webkit-input-placeholder, 
        .content-wrapper input[type="datetime"]::-webkit-input-placeholder, 
        .content-wrapper input[type="datetime-local"]::-webkit-input-placeholder, 
        .content-wrapper textarea::-webkit-input-placeholder,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="text"]::-webkit-input-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="email"]::-webkit-input-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="url"]::-webkit-input-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="password"]::-webkit-input-placeholder, 
        .footer div.wpforms-container.wpforms-container-full .wpforms-form input[type="search"]::-webkit-input-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="number"]::-webkit-input-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="tel"]::-webkit-input-placeholder,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="date"]::-webkit-input-placeholder,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="month"]::-webkit-input-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="week"]::-webkit-input-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="time"]::-webkit-input-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="datetime"]::-webkit-input-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="datetime-local"]::-webkit-input-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form textarea::-webkit-input-placeholder,
        #form-preview .mc4wp-form .mc4wp-form-fields input[type="email"]::-webkit-input-placeholder {
             color: ' . esc_attr($standard_default_text_color) . ';
        }
        
        .content-wrapper input[type="text"]:-moz-placeholder,
        .content-wrapper input[type="url"]:-moz-placeholder,
        .content-wrapper input[type="email"]:-moz-placeholder,
        .content-wrapper input[type="password"]:-moz-placeholder,
        .content-wrapper input[type="search"]:-moz-placeholder,
        .content-wrapper input[type="tel"]:-moz-placeholder,
        .content-wrapper input[type="number"]:-moz-placeholder, 
        .content-wrapper input[type="date"]:-moz-placeholder, 
        .content-wrapper input[type="month"]:-moz-placeholder, 
        .content-wrapper input[type="week"]:-moz-placeholder, 
        .content-wrapper input[type="time"]:-moz-placeholder, 
        .content-wrapper input[type="datetime"]:-moz-placeholder, 
        .content-wrapper input[type="datetime-local"]:-moz-placeholder, 
        .content-wrapper textarea:-moz-placeholder,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="text"]:-moz-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="email"]:-moz-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="url"]:-moz-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="password"]:-moz-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="search"]:-moz-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="number"]:-moz-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="tel"]:-moz-placeholder,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="date"]:-moz-placeholder,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="month"]:-moz-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="week"]:-moz-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="time"]:-moz-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="datetime"]:-moz-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="datetime-local"]:-moz-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form textarea:-moz-placeholder,
        #form-preview .mc4wp-form .mc4wp-form-fields input[type="email"]:-moz-placeholder {
             color: ' . esc_attr($standard_default_text_color) . ';
        }
        
        .content-wrapper input[type="text"]::-moz-placeholder,
        .content-wrapper input[type="url"]::-moz-placeholder,
        .content-wrapper input[type="email"]::-moz-placeholder,
        .content-wrapper input[type="password"]::-moz-placeholder,
        .content-wrapper input[type="search"]::-moz-placeholder,
        .content-wrapper input[type="tel"]::-moz-placeholder,
        .content-wrapper input[type="number"]::-moz-placeholder, 
        .content-wrapper input[type="date"]::-moz-placeholder, 
        .content-wrapper input[type="month"]::-moz-placeholder, 
        .content-wrapper input[type="week"]::-moz-placeholder, 
        .content-wrapper input[type="time"]::-moz-placeholder, 
        .content-wrapper input[type="datetime"]::-moz-placeholder, 
        .content-wrapper input[type="datetime-local"]::-moz-placeholder, 
        .content-wrapper textarea::-moz-placeholder,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="text"]::-moz-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="email"]::-moz-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="url"]::-moz-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="password"]::-moz-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="search"]::-moz-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="number"]::-moz-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="tel"]::-moz-placeholder,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="date"]::-moz-placeholder,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="month"]::-moz-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="week"]::-moz-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="time"]::-moz-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="datetime"]::-moz-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="datetime-local"]::-moz-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form textarea::-moz-placeholder,
        #form-preview .mc4wp-form .mc4wp-form-fields input[type="email"]::-moz-placeholder {
             color: ' . esc_attr($standard_default_text_color) . ';
        }
        
        .content-wrapper input[type="text"]:-ms-input-placeholder,
        .content-wrapper input[type="email"]:-ms-input-placeholder,
        .content-wrapper input[type="url"]:-ms-input-placeholder,
        .content-wrapper input[type="password"]:-ms-input-placeholder,
        .content-wrapper input[type="search"]:-ms-input-placeholder,
        .content-wrapper input[type="tel"]:-ms-input-placeholder,
        .content-wrapper input[type="number"]:-ms-input-placeholder, 
        .content-wrapper input[type="date"]:-ms-input-placeholder, 
        .content-wrapper input[type="month"]:-ms-input-placeholder, 
        .content-wrapper input[type="week"]:-ms-input-placeholder, 
        .content-wrapper input[type="time"]:-ms-input-placeholder, 
        .content-wrapper input[type="datetime"]:-ms-input-placeholder, 
        .content-wrapper input[type="datetime-local"]:-ms-input-placeholder, 
        .content-wrapper textarea:-ms-input-placeholder,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="text"]:-ms-input-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="email"]:-ms-input-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="url"]:-ms-input-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="password"]:-ms-input-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="search"]:-ms-input-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="number"]:-ms-input-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="tel"]:-ms-input-placeholder,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="date"]:-ms-input-placeholder,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="month"]:-ms-input-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="week"]:-ms-input-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="time"]:-ms-input-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="datetime"]:-ms-input-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="datetime-local"]:-ms-input-placeholder, 
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form textarea:-ms-input-placeholder,
        #form-preview .mc4wp-form .mc4wp-form-fields input[type="email"]:-ms-input-placeholder {
            color: ' . esc_attr($standard_default_text_color) . ';
        }
    ';
}

$standard_dark_text_color = technum_get_prefered_option('standard_dark_text_color');
if ( !empty($standard_dark_text_color) ) {
    $technum_custom_css .= '
        .content-wrapper h1,
        .content-wrapper h2,
        .content-wrapper h3,
        .content-wrapper h4,
        .content-wrapper h5,
        .wpforms-form .wpforms-title,
        .content-wrapper h6,
        .content-wrapper strong,
        .body-container a:hover,
        body .content-wrapper blockquote,
        body .technum_comments__item-text blockquote,
        .content-wrapper .post-title,
        .content-wrapper .post-title a,
        .owl-theme .owl-nav [class*="owl-"]:before,
        .post-comment-author,
        .select2-container--default .select2-results__option.select2-results__option--highlighted[aria-selected],
        .select2-container--default .select2-results__option.select2-results__option--highlighted[data-selected],
        .content-wrapper .select2-container--default .select2-results__option.select2-results__option--highlighted[aria-selected],
        .content-wrapper .select2-container--default .select2-results__option.select2-results__option--highlighted[data-selected],
        .content-wrapper .wp-block-pullquote blockquote:before,
        .technum-format-quote .post-quote:before,
        .widget_search .search-form .search-form-icon,
        .widget_categories ul li > a, 
        body .content-wrapper ul.wp-block-categories li > a,
        .widget_categories ul li .widget-archive-trigger, 
        .widget_categories ul li .block-archive-trigger, 
        body .content-wrapper ul.wp-block-categories li .widget-archive-trigger, 
        body .content-wrapper ul.wp-block-categories li .block-archive-trigger,
        .widget_technum_featured_posts_widget .featured-posts-item-link,
        .widget_archive ul li > a,
        .wp-block-archives li > a,
        body .content-wrapper .wp-block-archives li > a,
        .widget_recent_entries ul li a,
        .content-wrapper .wp-block-latest-posts li a,
        .widget_recent_comments ul .recentcomments a,
        .content-wrapper .wp-block-latest-comments li a,
        body .content-wrapper .widget_calendar caption, 
        body .content-wrapper .wp-block-calendar caption,
        body .content-wrapper .widget_calendar .wp-calendar-nav a,
        body .content-wrapper .wp-block-calendar .wp-calendar-nav a,
        body .content-wrapper .widget_calendar table tbody td, 
        body .content-wrapper .wp-block-calendar table tbody td,
        .widget_pages .widget-wrapper > ul li > a,
        .widget_meta ul li > a,
        .sidebar .widget .widget-title a,
        .widget_rss cite,
        .widget_rss ul a.rsswidget,
        .wp-block-rss .wp-block-rss__item-title a,
        .wp-block-rss .wp-block-rss__item-author,
        .widget_nav_menu ul li .widget-menu-trigger, 
        .widget_technum_nav_menu_widget ul li .widget-menu-trigger,
        .widget_nav_menu ul li a, 
        .widget_technum_nav_menu_widget ul li a,
        .result-box .result-box-title,
        .results-wrapper ul li,
        .portfolio-post-meta .portfolio-post-meta-label,
        .post-navigation .post-navigation-title a,
        .post-navigation .archive-icon-link .archive-icon,
        .team-experience-item-title,
        .team-item .post-title,
        .project-item-wrapper .post-title,
        .project-post-meta .project-post-meta-label,
        .vacancy-salary .vacancy-salary-value,
        .header-icon.login-logout a.link-login, 
        .header-icon.login-logout a.link-logout,
        .help-item .help-item-title,
        .service-item .service-post-title a,
        .technum-price-item-widget .price-item .price-item-container,
        .technum-price-item-widget .price-item.price-item-type-wide .price-item-title,
        .elementor-counter .elementor-counter-title,
        .technum-testimonial-carousel-widget .testimonial-carousel-wrapper .author-name,
        .elementor-widget-accordion .elementor-accordion .elementor-tab-title .elementor-accordion-title,
        .elementor-widget-toggle .elementor-toggle .elementor-tab-title .elementor-toggle-title,
        .elementor-widget-accordion .elementor-accordion .elementor-tab-title .elementor-accordion-icon i:before,
        .elementor-widget-toggle .elementor-toggle .elementor-tab-title .elementor-toggle-icon i:before,
        .filter-control-wrapper .filter-control-list .dots .dot,
        .error-404-title,
        .content-wrapper input[type="text"],
        .content-wrapper input[type="email"],
        .content-wrapper input[type="url"],
        .content-wrapper input[type="password"],
        .content-wrapper input[type="search"],
        .content-wrapper input[type="number"],
        .content-wrapper input[type="tel"],
        .content-wrapper input[type="range"],
        .content-wrapper input[type="date"],
        .content-wrapper input[type="month"],
        .content-wrapper input[type="week"],
        .content-wrapper input[type="time"],
        .content-wrapper input[type="datetime"],
        .content-wrapper input[type="datetime-local"],
        .content-wrapper input[type="color"],
        .content-wrapper select,
        .content-wrapper .select2-container .select2-selection--single,
        .content-wrapper textarea,
        .select2-container--default .select2-search--dropdown .select2-search__field,
        body .select2-container--default .select2-search--dropdown .select2-search__field,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="text"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="email"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="url"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="password"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="search"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="number"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="tel"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="date"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="month"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="week"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="time"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="datetime"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="datetime-local"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="color"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form select,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form textarea,
        .content-wrapper .select2-container--default .select2-results__option.select2-results__option--highlighted[aria-selected], 
        .content-wrapper .select2-container--default .select2-results__option.select2-results__option--highlighted[data-selected],
        #form-preview .mc4wp-form .mc4wp-form-fields input[type="email"],
        .single-product.woocommerce div.product .product_meta .product_meta_item a,
        .elementor-widget-image-box .elementor-image-box-wrapper .elementor-image-box-content .elementor-image-box-title,
        .elementor-widget-technum_vertical_text .vertical-text,
        .technum-image-slider-widget .slider-item-title,
        .elementor-widget-progress .elementor-widget-container .elementor-title,
        .elementor-widget-progress .elementor-progress-bar,
        .swiper-container .elementor-swiper-button i,
        .wp-block-search .wp-block-search__label,
        .wp-block-search.wp-block-search__button-inside .wp-block-search__inside-wrapper .wp-block-search__button.has-icon,
        .elementor-widget-technum_custom_menu ul li a,
        .content-wrapper .wp-block-loginout,
        .content-wrapper .wp-block-loginout a,
        .sidebar .shop-hidden-sidebar-close {
            color: ' . esc_attr($standard_dark_text_color) . ';
        }
        .single-team .team-personal-info-item,
        .single-team .team-skills ul li,
        .single-team .team-values ul li {
            color: rgba(' . esc_attr(technum_hex2rgb($standard_dark_text_color)) . ', 0.85);
        }
        .owl-dots .owl-dot.active span,
        .owl-dots .owl-dot span:after,
        .swiper-container .swiper-pagination-bullets .swiper-pagination-bullet.swiper-pagination-bullet-active,
        .swiper-container .swiper-pagination-bullets .swiper-pagination-bullet:after,
        .swiper-container-horizontal > .swiper-pagination-bullets .swiper-pagination-bullet.swiper-pagination-bullet-active, 
        .swiper-container-horizontal > .swiper-pagination-bullets .swiper-pagination-bullet:after {
            border-color: ' . esc_attr($standard_dark_text_color) . ';
        }
        .technum-price-item-widget .price-item.price-item-type-standard .price-item-custom-fields {
            border-color: rgba(' . esc_attr(technum_hex2rgb($standard_dark_text_color)) . ', 0.1);
        }
    ';
}

$standard_light_text_color = technum_get_prefered_option('standard_light_text_color');
if ( !empty($standard_light_text_color) ) {
    $technum_custom_css .= '
        .post-meta-header .post-meta-item,
        .post-meta-header .post-meta-item a,
        .post-meta-item-tags,
        .body-container .post-meta-item-tags a,
        .single-post .post-meta-footer .post-meta-item-author,
        .single-post .post-meta-footer .post-meta-item-author a,
        .post-comment-date,
        div.wpforms-container.wpforms-container-full .wpforms-form .wpforms-field-number-slider .wpforms-field-number-slider-hint,
        .widget_technum_featured_posts_widget .featured-posts-item-date,
        .content-wrapper .wp-block-latest-posts li .wp-block-latest-posts__post-date,
        .widget_recent_entries ul li .post-date,
        .widget_recent_comments ul .recentcomments,
        .content-wrapper .wp-block-latest-comments li .wp-block-latest-comments__comment-meta,
        .widget_rss .rss-date,
        .wp-block-rss .wp-block-rss__item-publish-date,
        body .content-wrapper .widget_calendar table thead th, 
        body .content-wrapper .wp-block-calendar table thead th,
        body .content-wrapper .gallery .gallery-item .gallery-caption,
        .post-navigation .post-navigation-categories,
        .post-navigation .post-navigation-categories a,
        .team-experience-item-period,
        .technum-price-item-widget .price-item.price-item-type-standard .price-item-custom-field {
            color: ' . esc_attr($standard_light_text_color) . ';
        }
        .widget_categories ul > li:before, 
        ul.wp-block-categories > li:before,
        .widget_archive ul li:before,
        .wp-block-archives li:before,
        .widget_recent_comments ul .recentcomments:before,
        .content-wrapper .wp-block-latest-comments li:before,
        .widget_pages .widget-wrapper > ul > li:before,
        .widget_meta ul li:before {
            background-color: rgba(' . esc_attr(technum_hex2rgb($standard_light_text_color)) . ', 0.6);
        }
        .special-title .special-title-backward,
        .elementor-widget-technum_special_text .special-text.special-text-effect-stroke,
        .technum-heading .technum-subheading {
            -webkit-text-stroke: 1px ' . esc_attr($standard_light_text_color) . ';
        }
    ';
}

$standard_accent_text_color = technum_get_prefered_option('standard_accent_text_color');
if ( !empty($standard_accent_text_color) ) {
    $technum_custom_css .= '
        .body-container a,
        ol > li::marker,
        body .content-wrapper blockquote:before, 
        body .technum_comments__item-text blockquote:before,
        .post-meta-header .post-meta-item a:hover,
        .content-wrapper .post-title a:hover,
        .post-more-button a,
        .post-more-button a:hover,
        .body-container .post-meta-item-tags a:hover,
        .content-pagination .page-numbers.current,
        .content-pagination .page-numbers:hover,
        .content-pagination .post-page-numbers.current,
        .content-pagination .post-page-numbers:hover,
        .single-post .post-meta-footer .post-meta-item-author a:hover,
        .widget_search .search-form .search-form-icon:hover,
        .widget_categories ul > li:hover, 
        .widget_categories ul li:hover > a, 
        body .content-wrapper ul.wp-block-categories > li:hover,
        body .content-wrapper ul.wp-block-categories li:hover > a,
        .widget_technum_featured_posts_widget .featured-posts-item-link:hover,
        .widget_archive ul li:hover > a,
        .widget_archive ul > li:hover,
        .wp-block-archives li:hover > a,
        .wp-block-archives > li:hover,
        body .content-wrapper .wp-block-archives li:hover > a,
        body .content-wrapper .wp-block-archives > li:hover,
        .widget_recent_entries ul li a:hover,
        .content-wrapper .wp-block-latest-posts li a:hover,
        .widget_recent_comments ul .recentcomments a:hover,
        .content-wrapper .wp-block-latest-comments li a:hover,
        body .content-wrapper .widget_calendar .wp-calendar-nav a:hover,
        body .content-wrapper .wp-block-calendar .wp-calendar-nav a:hover,
        .widget_pages .widget-wrapper > ul li:hover > a,
        .widget_meta ul li:hover > a,
        .sidebar .widget .widget-title a:hover,
        .widget_rss ul a.rsswidget:hover,
        .wp-block-rss .wp-block-rss__item-title a:hover,
        .widget_technum_contacts_widget .technum-contacts-widget-field:before,
        .results-wrapper ul li:before,
        .post-navigation .post-navigation-title a:hover,
        .post-navigation .post-navigation-categories a:hover,
        .post-navigation .archive-icon-link .archive-icon:hover,
        .team-short-info-position,
        .team-item .team-item-position,
        .service-item .service-post-title a:hover,
        .technum-price-item-widget .price-item.price-item-type-standard .price-item-custom-field.active:before,
        .technum-step-widget .step-item.step-item-type-standard .step-number,
        .technum-testimonial-carousel-widget .testimonial-carousel-wrapper .author-position,
        .filter-control-wrapper .filter-control-list .dots .dot.active,
        .filter-control-wrapper .filter-control-list .dots .dot:hover,
        .single-product.woocommerce div.product .product_meta .product_meta_item a:hover,
        .wp-block-search.wp-block-search__button-inside .wp-block-search__inside-wrapper .wp-block-search__button.has-icon:hover,
        .elementor-widget-technum_custom_menu ul li a:hover,
        .elementor-widget-technum_custom_menu ul li.active a,
        .content-wrapper .wp-block-loginout a:hover {
            color: ' . esc_attr($standard_accent_text_color) . ';
        }
        .post-more-button a svg {
            stroke: ' . esc_attr($standard_accent_text_color) . ';
        }
        .post-more-button a span {
            background-image: linear-gradient(0deg, ' . esc_attr($standard_accent_text_color) . ' 0%, ' . esc_attr($standard_accent_text_color) . ' 100%);
        }
        ul > li:before,
        .widget_categories ul > li:hover:before,
        body .content-wrapper ul.wp-block-categories > li:hover:before,
        .widget_archive ul li:hover:before,
        .wp-block-archives li:hover:before,
        body .content-wrapper .wp-block-archives li:hover:before,
        body .content-wrapper .widget_recent_comments ul .recentcomments:hover:before,
        .content-wrapper .wp-block-latest-comments li:hover:before,
        .widget_pages .widget-wrapper > ul > li:hover:before,
        .widget_meta ul li:hover:before,
        .widget_nav_menu ul li a:before, 
        .widget_technum_nav_menu_widget ul li a:before,
        .elementor-widget-technum_special_text .special-text.special-text-effect-fill,
        .elementor-widget-progress .elementor-progress-wrapper .elementor-progress-bar,
        .filter-control-wrapper .filter-control-list .dots .dot:after {
            background-color: ' . esc_attr($standard_accent_text_color) . ';
        }
        .team-experience-list .team-experience-item:before {
            border-color: ' . esc_attr($standard_accent_text_color) . ';
        }
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form .wpforms-field-number-slider input[type="range"]::-webkit-slider-thumb {
            background-color: ' . esc_attr($standard_accent_text_color) . ';
        }
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form .wpforms-field-number-slider input[type="range"]::-moz-range-thumb {
             background-color: ' . esc_attr($standard_accent_text_color) . ';
        }
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form .wpforms-field-number-slider input[type="range"]::-ms-thumb {
             background-color: ' . esc_attr($standard_accent_text_color) . ';
        }
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form .wpforms-field-number-slider input[type="range"]:focus::-ms-thumb {
             background-color: ' . esc_attr($standard_accent_text_color) . ';
        }
    ';
}

$standard_border_color = technum_get_prefered_option('standard_border_color');
if ( !empty($standard_border_color) ) {
    $technum_custom_css .= '
        .single-post .post-meta-footer:not(:first-child):before,
        .team-biography-wrapper .team-biography-text:before {
            background-color: ' . esc_attr($standard_border_color) . ';
        }
        .site-search,
        .simple-sidebar-trigger,
        .header-extra-socials.wrapper-socials a,
        .wp-block-search.wp-block-search__button-inside .wp-block-search__inside-wrapper,
        body .content-wrapper table tr td, 
        body .content-wrapper table tr th, 
        body .technum_comments__item-text table tr td, 
        body .technum_comments__item-text table tr th,
        .project-post-meta .project-post-meta-item,
        .vacancy-item,
        .single-service .benefits-wrapper .benefit-item,
        .service-listing-wrapper .service-item,
        .content-pagination .page-numbers, 
        .content-pagination .post-page-numbers,
        .post-comments-list .post-comment-wrapper.depth-1 {
            border-color: ' . esc_attr($standard_border_color) . ';
        }
        .technum-step-widget .step-item.step-item-type-extended .step-image:before {
            border-color: rgba(' . esc_attr(technum_hex2rgb($standard_border_color)) . ', 0.3);
        }
    ';
}

$standard_border_hover_color = technum_get_prefered_option('standard_border_hover_color');
if ( !empty($standard_border_hover_color) ) {
    $technum_custom_css .= '
        .single-post .post-meta-footer .post-meta-item.post-meta-item-tags a,
        .content-wrapper input[type="text"],
        .content-wrapper input[type="email"],
        .content-wrapper input[type="url"],
        .content-wrapper input[type="password"],
        .content-wrapper input[type="search"],
        .content-wrapper input[type="number"],
        .content-wrapper input[type="tel"],
        .content-wrapper input[type="range"],
        .content-wrapper input[type="date"],
        .content-wrapper input[type="month"],
        .content-wrapper input[type="week"],
        .content-wrapper input[type="time"],
        .content-wrapper input[type="datetime"],
        .content-wrapper input[type="datetime-local"],
        .content-wrapper input[type="color"],
        .content-wrapper .select-wrap,
        .content-wrapper .select2-container .select2-selection--single,
        .content-wrapper textarea,
        .content-wrapper input[type="checkbox"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="checkbox"],
        .woocommerce form .form-row input[type="checkbox"].input-checkbox,
        .content-wrapper input[type="radio"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="radio"],
        .select2-dropdown,
        body .select2-dropdown,
        .select2-container--default .select2-search--dropdown .select2-search__field,
        body .select2-container--default .select2-search--dropdown .select2-search__field,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="text"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="email"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="url"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="password"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="search"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="number"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="tel"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="date"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="month"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="week"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="time"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="datetime"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="datetime-local"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="color"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form select,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form textarea,
        .select2-container--default .select2-results__option.select2-results__option--highlighted[aria-selected], 
        .select2-container--default .select2-results__option.select2-results__option--highlighted[data-selected],
        .content-wrapper .select2-container--default .select2-results__option.select2-results__option--highlighted[aria-selected], 
        .content-wrapper .select2-container--default .select2-results__option.select2-results__option--highlighted[data-selected],
        .widget_tag_cloud .tagcloud .tag-cloud-link,
        .wp-block-tag-cloud .tag-cloud-link,
        body .content-wrapper .widget_calendar .calendar_wrap,
        body .content-wrapper .wp-block-calendar,
        #form-preview .mc4wp-form .mc4wp-form-fields input[type="email"],
        .woocommerce-product-gallery .flex-control-nav .slick-button,
        .single-product.woocommerce div.product .product_meta .product_meta_item.tagged_as a,
        .wp-block-search.wp-block-search__button-inside .wp-block-search__inside-wrapper {
            background-color: ' . esc_attr($standard_border_hover_color) . ';
        }
        .content-wrapper input[type="text"],
        .content-wrapper input[type="email"],
        .content-wrapper input[type="url"],
        .content-wrapper input[type="password"],
        .content-wrapper input[type="search"],
        .content-wrapper input[type="number"],
        .content-wrapper input[type="tel"],
        .content-wrapper input[type="range"],
        .content-wrapper input[type="date"],
        .content-wrapper input[type="month"],
        .content-wrapper input[type="week"],
        .content-wrapper input[type="time"],
        .content-wrapper input[type="datetime"],
        .content-wrapper input[type="datetime-local"],
        .content-wrapper input[type="color"],
        .content-wrapper .select-wrap,
        .content-wrapper .select2-container .select2-selection--single,
        .content-wrapper textarea,
        .content-wrapper input[type="checkbox"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="checkbox"],
        .woocommerce form .form-row input[type="checkbox"].input-checkbox,
        .content-wrapper input[type="radio"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="radio"],
        .select2-dropdown,
        body .select2-dropdown,
        .select2-container--default .select2-search--dropdown .select2-search__field,
        body .select2-container--default .select2-search--dropdown .select2-search__field,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="text"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="email"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="url"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="password"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="search"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="number"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="tel"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="date"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="month"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="week"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="time"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="datetime"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="datetime-local"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="color"],
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form select,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form textarea,
        #form-preview .mc4wp-form .mc4wp-form-fields input[type="email"],
        .wp-block-search.wp-block-search__button-inside .wp-block-search__inside-wrapper {
            border-color: ' . esc_attr($standard_border_hover_color) . ';
        }
        .content-wrapper div.wpforms-container-full .wpforms-form ul.wpforms-image-choices-classic label:not(.wpforms-error) {
            border-color: ' . esc_attr($standard_border_hover_color) . ' !important;
        }
    ';
}

$standard_background_color = technum_get_prefered_option('standard_background_color');
if ( !empty($standard_background_color) ) {
    $technum_custom_css .= '
        body,
        .simple-sidebar-trigger,
        .blog-item,
        .content-pagination .page-numbers, 
        .content-pagination .post-page-numbers,
        .content-wrapper input[type="text"]:focus,
        .content-wrapper input[type="email"]:focus,
        .content-wrapper input[type="url"]:focus,
        .content-wrapper input[type="password"]:focus,
        .content-wrapper input[type="search"]:focus,
        .content-wrapper input[type="number"]:focus,
        .content-wrapper input[type="tel"]:focus,
        .content-wrapper input[type="range"]:focus,
        .content-wrapper input[type="date"]:focus,
        .content-wrapper input[type="month"]:focus,
        .content-wrapper input[type="week"]:focus,
        .content-wrapper input[type="time"]:focus,
        .content-wrapper input[type="datetime"]:focus,
        .content-wrapper input[type="datetime-local"]:focus,
        .content-wrapper input[type="color"]:focus,
        .content-wrapper .select-wrap:focus-within,
        .content-wrapper textarea:focus,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="text"]:focus,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="email"]:focus,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="url"]:focus,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="password"]:focus,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="search"]:focus,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="number"]:focus,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="tel"]:focus,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="date"]:focus,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="month"]:focus,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="week"]:focus,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="time"]:focus,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="datetime"]:focus,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="datetime-local"]:focus,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="color"]:focus,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form select:focus,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form textarea:focus,
        .select2-container--default .select2-results > .select2-results__options,
        .select2-container--default.select2-container--open .select2-selection,
        .select2-container--default.select2-container--open .select2-dropdown,
        .select2-container--default .select2-search--dropdown .select2-search__field:focus,
        .content-wrapper .select2-container--default .select2-results > .select2-results__options,
        .content-wrapper .select2-container--default.select2-container--open .select2-selection,
        body .select2-container--default.select2-container--open .select2-dropdown,
        body .select2-container--default .select2-search--dropdown .select2-search__field:focus,
        #form-preview .mc4wp-form .mc4wp-form-fields input[type="email"]:focus,
        .team-item .team-item-socials,
        .vacancy-item,
        .single-service .benefits-wrapper .benefit-item,
        .service-listing-wrapper .service-item,
        .technum-price-item-widget .price-item.price-item-type-standard,
        .technum-content-slider-widget .owl-theme .owl-nav [class*="owl-"],
        .post-gallery-carousel.owl-carousel.owl-theme:hover .owl-nav  [class*="owl-"],
        .technum-content-slider-widget .bottom-area .content-slider-video .elementor-custom-embed-play .eicon-play,
        .swiper-container .elementor-swiper-button i,
        .wp-block-search.wp-block-search__button-inside .wp-block-search__inside-wrapper:focus-within {
            background-color: ' . esc_attr($standard_background_color) . ';
        }
        .technum-content-slider-widget .owl-theme .owl-nav [class*="owl-"],
        .swiper-container .elementor-swiper-button i {
            border-color: ' . esc_attr($standard_background_color) . ';
        }
        .owl-theme .owl-nav [class*="owl-"] {
            border-color: rgba(' . esc_attr(technum_hex2rgb($standard_background_color)) . ', 0.5);
        }
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form .wpforms-field-number-slider input[type="range"]::-webkit-slider-thumb {
            border-color: ' . esc_attr($standard_background_color) . ';
        }
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form .wpforms-field-number-slider input[type="range"]::-moz-range-thumb {
            border-color: ' . esc_attr($standard_background_color) . ';
        }
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form .wpforms-field-number-slider input[type="range"]::-ms-thumb {
            border-color: ' . esc_attr($standard_background_color) . ';
        }
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form .wpforms-field-number-slider input[type="range"]:focus::-ms-thumb {
            border-color: ' . esc_attr($standard_background_color) . ';
        }
    ';
}

$standard_background_alter_color = technum_get_prefered_option('standard_background_alter_color');
if ( !empty($standard_background_alter_color) ) {
    $technum_custom_css .= '
        .widget_technum_banner_widget .banner-widget-wrapper.banner-default-colors,
        .section-accent-bg,
        .help-item .help-item-title,
        .elementor-widget-accordion .elementor-accordion .elementor-tab-title,
        .elementor-widget-toggle .elementor-toggle .elementor-tab-title,
        .elementor-widget-progress .elementor-progress-wrapper {
            background-color: ' . esc_attr($standard_background_alter_color) . ';
        }
    ';
}

$standard_button_text_color = technum_get_prefered_option('standard_button_text_color');
if ( !empty($standard_button_text_color) ) {
    $technum_custom_css .= '
        .post-categories a.post-category-item,
        .content-wrapper .wrapper-socials a,
        .post-comment-buttons a.comment-edit-link,
        .post-comment-buttons a.comment-reply-link:hover,
        #form-preview button,
        .content-wrapper input[type="checkbox"]:checked:before,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="checkbox"]:checked:before,
        .woocommerce form .form-row input[type="checkbox"].input-checkbox:checked:before,
        .content-wrapper input[type="radio"]:checked:before,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="radio"]:checked:before,
        .technum-button,
        .sidebar .wp-block-button:not(.is-style-outline) .wp-block-button__link:not(.has-text-color),
        .content-wrapper .technum-button,
        .body-container button:not(.customize-partial-edit-shortcut-button),
        .body-container input[type="submit"],
        .body-container input[type="button"],
        .body-container input[type="reset"],
        .content-wrapper div.wpforms-container-full .wpforms-form input[type=submit], 
        .content-wrapper div.wpforms-container-full .wpforms-form button[type=submit], 
        .content-wrapper div.wpforms-container-full .wpforms-form .wpforms-page-button,
        body .content-wrapper .widget_calendar table tbody td#today, 
        body .content-wrapper .wp-block-calendar table tbody td#today
        body .content-wrapper .widget_calendar table tbody td#today a, 
        body .content-wrapper .wp-block-calendar table tbody td#today a,
        .widget_media_gallery .gallery .gallery-icon a:after,
        .widget_technum_banner_widget .banner-widget-wrapper.banner-contrast-colors .technum-button:hover,
        .widget_technum_banner_widget .banner-widget-wrapper.banner-default-colors .technum-button,
        .team-short-contact-button .technum-button:hover,
        .project-post-button .technum-button:hover,
        .vacancy-post-button .technum-button:hover,
        .vacancy-item-button .technum-button:hover,
        .vacancy-post-meta .vacancy-occupation,
        #sb_instagram .sbi_item .sbi_photo:after,
        .swiper-container .elementor-swiper-button:hover i,
        .wp-block-gallery .blocks-gallery-grid .blocks-gallery-item a:after, 
        .media_gallery .blocks-gallery-grid .blocks-gallery-item a:after,
        body .content-wrapper .gallery .gallery-item .gallery-icon a:after {
            color: ' . esc_attr($standard_button_text_color) . ';
        }
        .content-wrapper .wp-block-social-links.is-style-default:not(.has-icon-color) .wp-social-link a.wp-block-social-link-anchor svg {
            fill: ' . esc_attr($standard_button_text_color) . ';
        }
    ';
}

$standard_button_border_color = technum_get_prefered_option('standard_button_border_color');
if ( !empty($standard_button_border_color) ) {
    $technum_custom_css .= '
        .content-wrapper input[type="checkbox"]:checked,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="checkbox"]:checked,
        .woocommerce form .form-row input[type="checkbox"].input-checkbox:checked,
        .technum-content-slider-widget .owl-theme .owl-nav [class*="owl-"]:not(.disabled):hover,
        .swiper-container .elementor-swiper-button:hover i {
            border-color: ' . esc_attr($standard_button_border_color) . ';
        }
        .content-wrapper .wrapper-socials a,
        .content-wrapper input[type="checkbox"]:checked,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="checkbox"]:checked,
        .woocommerce form .form-row input[type="checkbox"].input-checkbox:checked,
        .content-wrapper input[type="radio"]:checked:before,
        .content-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="radio"]:checked:before,
        .widget_media_gallery .gallery .gallery-icon a:before,
        #sb_instagram .sbi_item .sbi_photo:before,
        .technum-content-slider-widget .owl-theme .owl-nav [class*="owl-"]:not(.disabled):hover,
        .swiper-container .elementor-swiper-button:hover i,
        .content-wrapper .wp-block-social-links.is-style-default:not(.has-icon-background-color) .wp-social-link a.wp-block-social-link-anchor {
            background-color: ' . esc_attr($standard_button_border_color) . ';
        }
        .content-wrapper div.wpforms-container-full .wpforms-form ul.wpforms-image-choices-classic .wpforms-selected label {
            border-color: ' . esc_attr($standard_button_border_color) . ' !important;
        }
        .result-box .result-box-value,
        .elementor-counter .elementor-counter-number-wrapper {
            -webkit-text-stroke: 1px ' . esc_attr($standard_button_border_color) . ';
        }
        .technum-content-slider-widget .owl-carousel.owl-theme .slider-item:before,
        .wp-block-gallery .blocks-gallery-grid .blocks-gallery-item a:before, 
        .media_gallery .blocks-gallery-grid .blocks-gallery-item a:before,
        body .content-wrapper .gallery .gallery-item .gallery-icon a:before {
             background-color: rgba(' . esc_attr(technum_hex2rgb($standard_button_border_color)) . ', 0.5);
        }
        .technum-content-slider-widget .bottom-area .content-slider-video .elementor-custom-embed-play .eicon-play:before {
            color: ' . esc_attr($standard_button_border_color) . ';
        }
    ';
}

$standard_button_background_color = technum_get_prefered_option('standard_button_background_color');
if ( !empty($standard_button_background_color) ) {
    $technum_custom_css .= '
        .post-categories a.post-category-item,
        .post-meta-header .post-meta-item:not(:last-child):before,
        .post-comment-buttons a.comment-edit-link,
        .post-comment-buttons a.comment-reply-link:hover,
        div.wpforms-container.wpforms-container-full .wpforms-form .wpforms-field-number-slider input[type="range"],
        .body-container input[type="submit"],
        .body-container input[type="button"],
        .body-container input[type="reset"],
        body .content-wrapper .widget_calendar table tbody td#today:before, 
        body .content-wrapper .wp-block-calendar table tbody td#today:before,
        .vacancy-post-meta .vacancy-occupation,
        .technum-heading .technum-heading-content span[style*="text-decoration: underline"]:before {
            background-color: ' . esc_attr($standard_button_background_color) . ';
        }
        body .content-wrapper .widget_calendar table tbody a, 
        body .content-wrapper .wp-block-calendar table tbody a {
            color: ' . esc_attr($standard_button_background_color) . ';
        }
    ';
}

$standard_button_text_hover = technum_get_prefered_option('standard_button_text_hover');
if ( !empty($standard_button_text_hover) ) {
    $technum_custom_css .= '
        .post-categories a.post-category-item:hover,
        .sticky .post-labels:before, 
        .status-sticky .post-labels:before,
        .owl-theme .owl-nav [class*="owl-"]:not(.disabled):hover:before,
        .technum-content-slider-widget .owl-theme .owl-nav [class*="owl-"]:not(.disabled):hover:before,
        .single-post .post-meta-footer .post-meta-item.post-meta-item-tags a:hover,
        .content-wrapper .wrapper-socials a:hover,
        .post-comment-buttons a.comment-edit-link:hover,
        .post-comment-buttons a.comment-reply-link,
        .technum-format-quote .post-quote,
        .technum-format-quote .post-quote:hover,
        .widget_tag_cloud .tagcloud .tag-cloud-link:hover,
        .wp-block-tag-cloud .tag-cloud-link:hover,
        .technum-button:hover,
        .sidebar .wp-block-button:not(.is-style-outline) .wp-block-button__link:not(.has-text-color):hover,
        .content-wrapper .technum-button:hover,
        .body-container button:not(.customize-partial-edit-shortcut-button):hover,
        .body-container input[type="submit"]:hover,
        .body-container input[type="button"]:hover,
        .body-container input[type="reset"]:hover,
        .select2-container--default .select2-results__option[aria-selected=true], 
        .select2-container--default .select2-results__option[data-selected=true],
        .content-wrapper .select2-container--default .select2-results__option[aria-selected=true], 
        .content-wrapper .select2-container--default .select2-results__option[data-selected=true],
        .content-wrapper div.wpforms-container-full .wpforms-form input[type=submit]:hover, 
        .content-wrapper div.wpforms-container-full .wpforms-form button[type=submit]:hover, 
        .content-wrapper div.wpforms-container-full .wpforms-form .wpforms-page-button:hover,
        .widget_technum_banner_widget .banner-widget-wrapper.banner-contrast-colors .technum-button,
        .widget_technum_banner_widget .banner-widget-wrapper.banner-default-colors .technum-button:hover,
        .team-short-contact-button .technum-button,
        .project-post-button .technum-button,
        .vacancy-post-button .technum-button,
        .vacancy-item-button .technum-button,
        .help-item.active .help-item-title,
        .technum-price-item-widget .price-item.price-item-type-standard .price-item-title,
        .technum-step-widget .step-item.step-item-type-standard .step-bg-number,
        .elementor-widget-accordion .elementor-accordion .elementor-tab-title.elementor-active .elementor-accordion-title,
        .elementor-widget-toggle .elementor-toggle .elementor-tab-title.elementor-active .elementor-toggle-title,
        .elementor-widget-accordion .elementor-accordion .elementor-tab-title.elementor-active .elementor-accordion-icon i:before,
        .elementor-widget-toggle .elementor-toggle .elementor-tab-title.elementor-active .elementor-toggle-icon i:before,
        .woocommerce-product-gallery .flex-control-nav .slick-button:not(.slick-disabled):hover,
        .single-product.woocommerce div.product .product_meta .product_meta_item.tagged_as a:hover,
        .technum-step-widget .step-item.step-item-type-extended .step-image .step-number {
            color: ' . esc_attr($standard_button_text_hover) . ';
        }
        .content-wrapper .wp-block-social-links.is-style-default:not(.has-icon-color) .wp-social-link:hover a.wp-block-social-link-anchor svg {
            fill: ' . esc_attr($standard_button_text_hover) . ';
        }
    ';
}

$standard_button_border_hover = technum_get_prefered_option('standard_button_border_hover');
if ( !empty($standard_button_border_hover) ) {
    $technum_custom_css .= '
        .content-wrapper .wrapper-socials a:hover,
        .content-wrapper .wp-block-social-links.is-style-default:not(.has-icon-background-color) .wp-social-link:hover a.wp-block-social-link-anchor {
            background-color: ' . esc_attr($standard_button_border_hover) . ';
        }
    ';
}

$standard_button_background_hover = technum_get_prefered_option('standard_button_background_hover');
if ( !empty($standard_button_background_hover) ) {
    $technum_custom_css .= '
        .post-categories a.post-category-item:hover,
        .sticky .post-labels:before, 
        .status-sticky .post-labels:before,
        .owl-theme .owl-nav [class*="owl-"]:not(.disabled):hover,
        .post-gallery-carousel.owl-carousel.owl-theme .owl-nav [class*="owl-"]:not(.disabled):hover,
        .single-post .post-meta-footer .post-meta-item.post-meta-item-tags a:hover,
        .post-comment-buttons a.comment-edit-link:hover,
        .post-comment-buttons a.comment-reply-link,
        .technum-format-quote .post-quote,
        .widget_tag_cloud .tagcloud .tag-cloud-link:hover,
        .wp-block-tag-cloud .tag-cloud-link:hover,
        .body-container input[type="submit"]:hover,
        .body-container input[type="button"]:hover,
        .body-container input[type="reset"]:hover,
        .select2-container--default .select2-results__option[aria-selected=true], 
        .select2-container--default .select2-results__option[data-selected=true],
        .content-wrapper .select2-container--default .select2-results__option[aria-selected=true], 
        .content-wrapper .select2-container--default .select2-results__option[data-selected=true],
        .help-item.active .help-item-title,
        .technum-price-item-widget .price-item.price-item-type-standard .price-item-title,
        .elementor-widget-accordion .elementor-accordion .elementor-tab-title.elementor-active,
        .elementor-widget-toggle .elementor-toggle .elementor-tab-title.elementor-active,
        .woocommerce-product-gallery .flex-control-nav .slick-button:not(.slick-disabled):hover,
        .single-product.woocommerce div.product .product_meta .product_meta_item.tagged_as a:hover {
            background-color: ' . esc_attr($standard_button_background_hover) . ';
        }
        body .content-wrapper .widget_calendar table tbody a:hover, 
        body .content-wrapper .wp-block-calendar table tbody a:hover {
            color: ' . esc_attr($standard_button_background_hover) . ';
        }
        .owl-theme .owl-nav [class*="owl-"]:not(.disabled):hover {
            border-color: ' . esc_attr($standard_button_background_hover) . ';
        }
        .technum-step-widget .step-item.step-item-type-standard {
            background-color: rgba(' . esc_attr(technum_hex2rgb($standard_button_background_hover)) . ', 0.07);
        }
        .technum-step-widget .step-item.step-item-type-extended .step-image .step-image-box:after {
            background-image: linear-gradient(0deg, ' . esc_attr($standard_button_background_hover) . ' 0%, ' . esc_attr($standard_button_background_hover) . ' 10%, transparent 68%);
        }
    ';
}

if ( !empty($standard_button_background_hover) && !empty($standard_button_background_color) ) {
    $technum_custom_css .= '
        .technum-button:after,
        .content-wrapper .technum-button:after,
        .body-container button:not(.customize-partial-edit-shortcut-button):after,
        #form-preview button:after,
        .sidebar .wp-block-button:not(.is-style-outline) .wp-block-button__link:not(.has-background):after {
            background: ' . esc_attr($standard_button_background_color) . ';
            background: -moz-linear-gradient(left, ' . esc_attr($standard_button_background_hover) . ' 0%, ' . esc_attr($standard_button_background_hover) . ' 50%, ' . esc_attr($standard_button_background_color) . ' 50%);
            background: -webkit-gradient(linear, left top, right top, color-stop(0%, ' . esc_attr($standard_button_background_hover) . '), color-stop(50%, ' . esc_attr($standard_button_background_hover) . '), color-stop(50%, ' . esc_attr($standard_button_background_color) . '));
            background: -webkit-linear-gradient(left, ' . esc_attr($standard_button_background_hover) . ' 0%, ' . esc_attr($standard_button_background_hover) . ' 50%, ' . esc_attr($standard_button_background_color) . ' 50%);
            background: -o-linear-gradient(left, ' . esc_attr($standard_button_background_hover) . ' 0%, ' . esc_attr($standard_button_background_color) . ' 50%, ' . esc_attr($standard_button_background_color) . ' 50%);
            background: -ms-linear-gradient(left, ' . esc_attr($standard_button_background_hover) . ' 0%, ' . esc_attr($standard_button_background_hover) . ' 50%, ' . esc_attr($standard_button_background_color) . ' 50%);
            background: linear-gradient(to right, ' . esc_attr($standard_button_background_hover) . ' 0%, ' . esc_attr($standard_button_background_hover) . ' 50%, ' . esc_attr($standard_button_background_color) . ' 50%);
        }
        .team-short-contact-button .technum-button:after,
        .project-post-button .technum-button:after,
        .vacancy-post-button .technum-button:after,
        .vacancy-item-button .technum-button:after,
        .technum-price-item-widget .price-item .price-item-button-container .technum-button:after {
                background: ' . esc_attr($standard_button_background_hover) . ';
                background: -moz-linear-gradient(left, ' . esc_attr($standard_button_background_color) . ' 0%, ' . esc_attr($standard_button_background_color) . ' 50%, ' . esc_attr($standard_button_background_hover) .
            ' 50%);
                background: -webkit-gradient(linear, left top, right top, color-stop(0%, ' . esc_attr($standard_button_background_color) . '), color-stop(50%, ' . esc_attr($standard_button_background_color) . '), color-stop(50%, ' . esc_attr($standard_button_background_color) . '));
                background: -webkit-linear-gradient(left, ' . esc_attr($standard_button_background_color) . ' 0%, ' . esc_attr($standard_button_background_color) . ' 50%, ' . esc_attr($standard_button_background_hover)
            . ' 50%);
                background: -o-linear-gradient(left, ' . esc_attr($standard_button_background_color) . ' 0%, ' . esc_attr($standard_button_background_hover) . ' 50%, ' . esc_attr($standard_button_background_hover) . ' 50%);
                background: -ms-linear-gradient(left, ' . esc_attr($standard_button_background_color) . ' 0%, ' . esc_attr($standard_button_background_color) . ' 50%, ' . esc_attr($standard_button_background_hover) .
            ' 50%);
                background: linear-gradient(to right, ' . esc_attr($standard_button_background_color) . ' 0%, ' . esc_attr($standard_button_background_color) . ' 50%, ' . esc_attr($standard_button_background_hover) .
            ' 50%);
            }
    ';
}

if ( !empty($standard_background_color) && !empty($standard_button_background_hover) ) {
    $technum_custom_css .= '
        div.wpforms-container.wpforms-container-full .wpforms-form .wpforms-field-number-slider input[type="range"]::-webkit-slider-thumb {
            border-color: ' . esc_attr($standard_background_color) . ';
            background: ' . esc_attr($standard_button_background_hover) . ';
            -webkit-box-shadow: 0px 0px 0px 1px ' . esc_attr($standard_button_background_hover) . ', 0px 0px 0px 5px ' . esc_attr($standard_background_color) . ';
            -moz-box-shadow: 0px 0px 0px 1px ' . esc_attr($standard_button_background_hover) . ', 0px 0px 0px 5px ' . esc_attr($standard_background_color) . ';
            box-shadow: 0px 0px 0px 1px ' . esc_attr($standard_button_background_hover) . ', 0px 0px 0px 5px ' . esc_attr($standard_background_color) . ';
        }
        div.wpforms-container.wpforms-container-full .wpforms-form .wpforms-field-number-slider input[type="range"]::-moz-range-thumb {
            border-color: ' . esc_attr($standard_background_color) . ';
            background: ' . esc_attr($standard_button_background_hover) . ';
            -webkit-box-shadow: 0px 0px 0px 1px ' . esc_attr($standard_button_background_hover) . ', 0px 0px 0px 5px ' . esc_attr($standard_background_color) . ';
            -moz-box-shadow: 0px 0px 0px 1px ' . esc_attr($standard_button_background_hover) . ', 0px 0px 0px 5px ' . esc_attr($standard_background_color) . ';
            box-shadow: 0px 0px 0px 1px ' . esc_attr($standard_button_background_hover) . ', 0px 0px 0px 5px ' . esc_attr($standard_background_color) . ';
        }
        div.wpforms-container.wpforms-container-full .wpforms-form .wpforms-field-number-slider input[type="range"]::-ms-thumb {
            border-color: ' . esc_attr($standard_background_color) . ';
            background: ' . esc_attr($standard_button_background_hover) . ';
            -webkit-box-shadow: 0px 0px 0px 1px ' . esc_attr($standard_button_background_hover) . ', 0px 0px 0px 5px ' . esc_attr($standard_background_color) . ';
            -moz-box-shadow: 0px 0px 0px 1px ' . esc_attr($standard_button_background_hover) . ', 0px 0px 0px 5px ' . esc_attr($standard_background_color) . ';
            box-shadow: 0px 0px 0px 1px ' . esc_attr($standard_button_background_hover) . ', 0px 0px 0px 5px ' . esc_attr($standard_background_color) . ';
        }
        div.wpforms-container.wpforms-container-full .wpforms-form .wpforms-field-number-slider input[type="range"]:focus::-ms-thumb {
            border-color: ' . esc_attr($standard_background_color) . ';
            background: ' . esc_attr($standard_button_background_hover) . ';
            -webkit-box-shadow: 0px 0px 0px 1px ' . esc_attr($standard_button_background_hover) . ', 0px 0px 0px 5px ' . esc_attr($standard_background_color) . ';
            -moz-box-shadow: 0px 0px 0px 1px ' . esc_attr($standard_button_background_hover) . ', 0px 0px 0px 5px ' . esc_attr($standard_background_color) . ';
            box-shadow: 0px 0px 0px 1px ' . esc_attr($standard_button_background_hover) . ', 0px 0px 0px 5px ' . esc_attr($standard_background_color) . ';
        }
    ';
}