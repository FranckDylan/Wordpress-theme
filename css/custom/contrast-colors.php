<?php

// ----------------------------- //
// ------ Contrast Colors ------ //
// ----------------------------- //

$contrast_default_text_color = technum_get_prefered_option('contrast_default_text_color');
if ( !empty($contrast_default_text_color) ) {
    $technum_custom_css .= '
        .header .main-menu > li ul.sub-menu > li.menu-item-has-children > a:after,
        .slide-sidebar-wrapper .slide-sidebar-content,
        .slide-sidebar-wrapper .widget_technum_featured_posts_widget .featured-posts-item-link,
        .slide-sidebar-wrapper .widget_recent_entries ul li a,
        .slide-sidebar-wrapper .wp-block-latest-posts li a,
        .slide-sidebar-wrapper .widget_recent_comments ul .recentcomments,
        .slide-sidebar-wrapper .widget_nav_menu ul li a, 
        .slide-sidebar-wrapper .widget_technum_nav_menu_widget ul li a,
        .slide-sidebar-wrapper .widget_tag_cloud .tagcloud .tag-cloud-link,
        .slide-sidebar-wrapper .widget_calendar table tbody a:hover,
        .slide-sidebar-wrapper .widget_categories ul li:hover li {
            color: ' . esc_attr($contrast_default_text_color) . ';
        }
    ';
}

$contrast_dark_text_color = technum_get_prefered_option('contrast_dark_text_color');
if ( !empty($contrast_dark_text_color) ) {
    $technum_custom_css .= '
        .portfolio-item .post-title,
        .technum-price-item-widget .price-item.active .price-item-container,
        .technum-price-item-widget .price-item.price-item-type-wide.active .price-item-title,
        .technum-price-item-widget .price-item.price-item-type-wide.active .price-item-description,
        .project-listing-wrapper.text-position-inside .project-item-wrapper .post-title,
        .project-listing-wrapper.text-position-inside .project-item-wrapper .project-item-categories,
        .project-listing-wrapper.text-position-inside .project-item-wrapper .project-item-categories a,
        .header .main-menu ul.sub-menu > li > a,
        .header .main-menu > li ul.sub-menu > li.menu-item-has-children > a:hover:after,
        .widget_media_audio .mejs-container .mejs-button > button,
        .widget_media_audio .mejs-container .mejs-time,
        .widget_media_audio .mejs-container .mejs-duration,
        .mejs-audio.mejs-container .mejs-button > button,
        .mejs-audio.mejs-container .mejs-time,
        .mejs-audio.mejs-container .mejs-duration,
        .wp-video .mejs-container .mejs-button > button,
        .wp-video .mejs-container .mejs-time,
        .wp-video .mejs-container .mejs-duration,
        .widget_technum_banner_widget .banner-widget-wrapper.banner-contrast-colors,
        .widget_technum_banner_widget .banner-widget-wrapper.banner-contrast-colors .banner-title,
        .technum-price-item-widget .price-item.price-item-type-standard.active .price-item-custom-field.active,
        .slide-sidebar-wrapper .slide-sidebar-content h1, 
        .slide-sidebar-wrapper .slide-sidebar-content h2, 
        .slide-sidebar-wrapper .slide-sidebar-content h3, 
        .slide-sidebar-wrapper .slide-sidebar-content h4, 
        .slide-sidebar-wrapper .slide-sidebar-content h5, 
        .slide-sidebar-wrapper .slide-sidebar-content h6,
        .slide-sidebar-wrapper .slide-sidebar-close,
        .slide-sidebar-wrapper .slide-sidebar-close:hover,
        .slide-sidebar-wrapper .widget_technum_contacts_widget .technum-contacts-widget-field,
        .slide-sidebar-wrapper input[type="text"],
        .slide-sidebar-wrapper input[type="email"],
        .slide-sidebar-wrapper input[type="url"],
        .slide-sidebar-wrapper input[type="password"],
        .slide-sidebar-wrapper input[type="search"],
        .slide-sidebar-wrapper input[type="number"],
        .slide-sidebar-wrapper input[type="tel"],
        .slide-sidebar-wrapper input[type="range"],
        .slide-sidebar-wrapper input[type="date"],
        .slide-sidebar-wrapper input[type="month"],
        .slide-sidebar-wrapper input[type="week"],
        .slide-sidebar-wrapper input[type="time"],
        .slide-sidebar-wrapper input[type="datetime"],
        .slide-sidebar-wrapper input[type="datetime-local"],
        .slide-sidebar-wrapper input[type="color"],
        .slide-sidebar-wrapper select,
        .slide-sidebar-wrapper .select2-container .select2-selection--single,
        .slide-sidebar-wrapper textarea,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="text"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="email"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="url"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="password"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="search"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="number"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="tel"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="date"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="month"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="week"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="time"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="datetime"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="datetime-local"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="color"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form select,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form textarea,
        .slide-sidebar-wrapper .select2-container--default .select2-results__option.select2-results__option--highlighted[aria-selected], 
        .slide-sidebar-wrapper .select2-container--default .select2-results__option.select2-results__option--highlighted[data-selected],
        .slide-sidebar-wrapper .widget_search .search-form .search-form-icon,
        .slide-sidebar-wrapper .widget_technum_featured_posts_widget .featured-posts-item-link,
        .slide-sidebar-wrapper .widget_recent_entries ul li a,
        .slide-sidebar-wrapper .wp-block-latest-posts li a,
        .slide-sidebar-wrapper .widget_recent_comments ul .recentcomments a,
        .slide-sidebar-wrapper .wp-block-latest-comments li a,
        .slide-sidebar-wrapper .widget_calendar caption,
        .slide-sidebar-wrapper .widget_calendar .wp-calendar-nav a,
        .slide-sidebar-wrapper .widget_calendar table tbody td,
        .slide-sidebar-wrapper .widget_rss cite,
        .slide-sidebar-wrapper .widget_rss ul a.rsswidget,
        .slide-sidebar-wrapper .wp-block-rss .wp-block-rss__item-title a,
        .slide-sidebar-wrapper .wp-block-rss .wp-block-rss__item-author,
        .slide-sidebar-wrapper .widget .widget-title a,
        .slide-sidebar-wrapper .widget_nav_menu ul li a:hover, 
        .slide-sidebar-wrapper .widget_nav_menu ul li.current-menu-item > a, 
        .slide-sidebar-wrapper .widget_nav_menu ul li.current-menu-ancestor > a, 
        .slide-sidebar-wrapper .widget_nav_menu ul li.current-menu-parent > a, 
        .slide-sidebar-wrapper .widget_nav_menu ul li.current_page_item > a, 
        .slide-sidebar-wrapper .widget_technum_nav_menu_widget ul li a:hover, 
        .slide-sidebar-wrapper .widget_technum_nav_menu_widget ul li.current-menu-item > a,
        .slide-sidebar-wrapper .widget_technum_nav_menu_widget ul li.current-menu-ancestor > a,
        .slide-sidebar-wrapper .widget_technum_nav_menu_widget ul li.current-menu-parent > a, 
        .slide-sidebar-wrapper .widget_technum_nav_menu_widget ul li.current_page_item > a,
        .slide-sidebar-wrapper .widget_pages .widget-wrapper > ul li > a,
        .slide-sidebar-wrapper .widget_meta ul li > a,
        .slide-sidebar-wrapper .widget_categories ul li > a, 
        .slide-sidebar-wrapper .widget_categories ul li .widget-archive-trigger,
        .slide-sidebar-wrapper .widget_archive ul li > a,
        .technum-content-slider-widget .content-item,
        .technum-content-slider-widget .bottom-area,
        .technum-content-slider-widget .bottom-area .contacts .contact-item a,
        .slide-sidebar-wrapper .wp-block-search .wp-block-search__label,
        .slide-sidebar-wrapper .wp-block-search.wp-block-search__button-inside .wp-block-search__inside-wrapper .wp-block-search__button.has-icon,
        .slide-sidebar-wrapper .wp-block-loginout,
        .slide-sidebar-wrapper .wp-block-loginout a {
            color: ' . esc_attr($contrast_dark_text_color) . ';
        }
        
        .widget_media_audio .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current, 
        .widget_media_audio .mejs-controls .mejs-time-rail .mejs-time-loaded,
        .mejs-audio .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current, 
        .mejs-audio .mejs-controls .mejs-time-rail .mejs-time-loaded,
        .wp-video .mejs-overlay-play .mejs-overlay-button:before,
        .elementor-widget-video .elementor-custom-embed-play:before,
        .wp-video .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current, 
        .wp-video .mejs-controls .mejs-time-rail .mejs-time-loaded,
        .wp-video .mejs-volume-current,
        .wp-video .mejs-volume-handle {
            background-color: ' . esc_attr($contrast_dark_text_color) . ';
        }
        .widget_media_audio .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-total, 
        .widget_media_audio .mejs-controls .mejs-time-rail .mejs-time-total,
        .mejs-audio .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-total, 
        .mejs-audio .mejs-controls .mejs-time-rail .mejs-time-total,
        .wp-video .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-total, 
        .wp-video .mejs-controls .mejs-time-rail .mejs-time-total,
        .wp-video .mejs-volume-total {
            background-color: rgba(' . esc_attr(technum_hex2rgb($contrast_dark_text_color)) . ', 0.4);
        }
        .wp-video .mejs-overlay-play .mejs-overlay-button .progress__circle,
        .elementor-widget-video .elementor-custom-embed-play .progress__circle,
        .wp-video .mejs-overlay-play .mejs-overlay-button .progress__path,
        .elementor-widget-video .elementor-custom-embed-play .progress__path {
            stroke: ' . esc_attr($contrast_dark_text_color) . ';
        }
        .technum-price-item-widget .price-item.price-item-type-standard.active .price-item-custom-fields {
            border-color: rgba(' . esc_attr(technum_hex2rgb($contrast_dark_text_color)) . ', 0.1);
        }
    ';
}

$contrast_light_text_color = technum_get_prefered_option('contrast_light_text_color');
if ( !empty($contrast_light_text_color) ) {
    $technum_custom_css .= '
        .slide-sidebar-wrapper input[type="text"]::-webkit-input-placeholder,
        .slide-sidebar-wrapper input[type="email"]::-webkit-input-placeholder,
        .slide-sidebar-wrapper input[type="url"]::-webkit-input-placeholder,
        .slide-sidebar-wrapper input[type="password"]::-webkit-input-placeholder,
        .slide-sidebar-wrapper input[type="search"]::-webkit-input-placeholder,
        .slide-sidebar-wrapper input[type="tel"]::-webkit-input-placeholder,
        .slide-sidebar-wrapper input[type="number"]::-webkit-input-placeholder, 
        .slide-sidebar-wrapper input[type="date"]::-webkit-input-placeholder, 
        .slide-sidebar-wrapper input[type="month"]::-webkit-input-placeholder, 
        .slide-sidebar-wrapper input[type="week"]::-webkit-input-placeholder, 
        .slide-sidebar-wrapper input[type="time"]::-webkit-input-placeholder, 
        .slide-sidebar-wrapper input[type="datetime"]::-webkit-input-placeholder, 
        .slide-sidebar-wrapper input[type="datetime-local"]::-webkit-input-placeholder, 
        .slide-sidebar-wrapper textarea::-webkit-input-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="text"]::-webkit-input-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="email"]::-webkit-input-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="url"]::-webkit-input-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="password"]::-webkit-input-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="search"]::-webkit-input-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="number"]::-webkit-input-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="tel"]::-webkit-input-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="date"]::-webkit-input-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="month"]::-webkit-input-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="week"]::-webkit-input-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="time"]::-webkit-input-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="datetime"]::-webkit-input-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="datetime-local"]::-webkit-input-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form textarea::-webkit-input-placeholder,
        .technum-price-item-widget .price-item.price-item-type-standard.active .price-item-custom-field,
        .slide-sidebar-wrapper .widget_technum_featured_posts_widget .featured-posts-item-date,
        .slide-sidebar-wrapper .widget_recent_entries ul li .post-date,
        .slide-sidebar-wrapper .wp-block-latest-posts li .wp-block-latest-posts__post-date,
        .slide-sidebar-wrapper .widget_rss .rss-date,
        .slide-sidebar-wrapper .wp-block-rss .wp-block-rss__item-publish-date,
        .slide-sidebar-wrapper .widget_calendar table thead th,
        .slide-sidebar-wrapper .wp-block-latest-comments li .wp-block-latest-comments__comment-meta {
             color: ' . esc_attr($contrast_light_text_color) . ';
        }
        
        .slide-sidebar-wrapper input[type="text"]:-moz-placeholder,
        .slide-sidebar-wrapper input[type="url"]:-moz-placeholder,
        .slide-sidebar-wrapper input[type="email"]:-moz-placeholder,
        .slide-sidebar-wrapper input[type="password"]:-moz-placeholder,
        .slide-sidebar-wrapper input[type="search"]:-moz-placeholder,
        .slide-sidebar-wrapper input[type="tel"]:-moz-placeholder, 
        .slide-sidebar-wrapper input[type="number"]:-moz-placeholder, 
        .slide-sidebar-wrapper input[type="date"]:-moz-placeholder, 
        .slide-sidebar-wrapper input[type="month"]:-moz-placeholder, 
        .slide-sidebar-wrapper input[type="week"]:-moz-placeholder, 
        .slide-sidebar-wrapper input[type="time"]:-moz-placeholder, 
        .slide-sidebar-wrapper input[type="datetime"]:-moz-placeholder, 
        .slide-sidebar-wrapper input[type="datetime-local"]:-moz-placeholder, 
        .slide-sidebar-wrapper textarea:-moz-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="text"]:-moz-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="email"]:-moz-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="url"]:-moz-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="password"]:-moz-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="search"]:-moz-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="number"]:-moz-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="tel"]:-moz-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="date"]:-moz-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="month"]:-moz-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="week"]:-moz-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="time"]:-moz-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="datetime"]:-moz-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="datetime-local"]:-moz-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form textarea:-moz-placeholder {
             color: ' . esc_attr($contrast_light_text_color) . ';
        }
        
        .slide-sidebar-wrapper input[type="text"]::-moz-placeholder,
        .slide-sidebar-wrapper input[type="url"]::-moz-placeholder,
        .slide-sidebar-wrapper input[type="email"]::-moz-placeholder,
        .slide-sidebar-wrapper input[type="password"]::-moz-placeholder,
        .slide-sidebar-wrapper input[type="search"]::-moz-placeholder,
        .slide-sidebar-wrapper input[type="tel"]::-moz-placeholder, 
        .slide-sidebar-wrapper input[type="number"]::-moz-placeholder, 
        .slide-sidebar-wrapper input[type="date"]::-moz-placeholder, 
        .slide-sidebar-wrapper input[type="month"]::-moz-placeholder, 
        .slide-sidebar-wrapper input[type="week"]::-moz-placeholder, 
        .slide-sidebar-wrapper input[type="time"]::-moz-placeholder, 
        .slide-sidebar-wrapper input[type="datetime"]::-moz-placeholder, 
        .slide-sidebar-wrapper input[type="datetime-local"]::-moz-placeholder, 
        .slide-sidebar-wrapper textarea::-moz-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="text"]::-moz-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="email"]::-moz-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="url"]::-moz-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="password"]::-moz-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="search"]::-moz-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="number"]::-moz-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="tel"]::-moz-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="date"]::-moz-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="month"]::-moz-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="week"]::-moz-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="time"]::-moz-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="datetime"]::-moz-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="datetime-local"]::-moz-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form textarea::-moz-placeholder {
             color: ' . esc_attr($contrast_light_text_color) . ';
        }
        
        .slide-sidebar-wrapper input[type="text"]:-ms-input-placeholder,
        .slide-sidebar-wrapper input[type="email"]:-ms-input-placeholder,
        .slide-sidebar-wrapper input[type="url"]:-ms-input-placeholder,
        .slide-sidebar-wrapper input[type="password"]:-ms-input-placeholder,
        .slide-sidebar-wrapper input[type="search"]:-ms-input-placeholder,
        .slide-sidebar-wrapper input[type="tel"]:-ms-input-placeholder, 
        .slide-sidebar-wrapper input[type="number"]:-ms-input-placeholder, 
        .slide-sidebar-wrapper input[type="date"]:-ms-input-placeholder, 
        .slide-sidebar-wrapper input[type="month"]:-ms-input-placeholder, 
        .slide-sidebar-wrapper input[type="week"]:-ms-input-placeholder, 
        .slide-sidebar-wrapper input[type="time"]:-ms-input-placeholder, 
        .slide-sidebar-wrapper input[type="datetime"]:-ms-input-placeholder, 
        .slide-sidebar-wrapper input[type="datetime-local"]:-ms-input-placeholder, 
        .slide-sidebar-wrapper textarea:-ms-input-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="text"]:-ms-input-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="email"]:-ms-input-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="url"]:-ms-input-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="password"]:-ms-input-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="search"]:-ms-input-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="number"]:-ms-input-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="tel"]:-ms-input-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="date"]:-ms-input-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="month"]:-ms-input-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="week"]:-ms-input-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="time"]:-ms-input-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="datetime"]:-ms-input-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="datetime-local"]:-ms-input-placeholder,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form textarea:-ms-input-placeholder {
            color: ' . esc_attr($contrast_light_text_color) . ';
        }
        .slide-sidebar-wrapper .widget_categories ul > li:before, 
        .slide-sidebar-wrapper ul.wp-block-categories > li:before,
        .slide-sidebar-wrapper .widget_archive ul li:before,
        .slide-sidebar-wrapper .wp-block-archives li:before,
        .slide-sidebar-wrapper .widget_recent_comments ul .recentcomments:before,
        .slide-sidebar-wrapper .widget_pages .widget-wrapper > ul > li:before,
        .slide-sidebar-wrapper .widget_meta ul li:before,
        .slide-sidebar-wrapper .wp-block-latest-comments li:before {
            background-color: rgba(' . esc_attr(technum_hex2rgb($contrast_light_text_color)) . ', 0.6);
        }
        .technum-content-slider-widget .content-item .technum-heading .technum-subheading {
            -webkit-text-stroke: 1px ' . esc_attr($contrast_light_text_color) . ';
        }
    ';
}

$contrast_accent_text_color = technum_get_prefered_option('contrast_accent_text_color');
if ( !empty($contrast_accent_text_color) ) {
    $technum_custom_css .= '
        .header .main-menu ul.sub-menu > li > a:hover,
        .header .main-menu ul.sub-menu > li.current-menu-ancestor > a,
        .header .main-menu ul.sub-menu > li.current-menu-parent > a,
        .header .main-menu ul.sub-menu > li.current-menu-item > a,
        .widget_media_audio .mejs-container .mejs-button > button:hover,
        .mejs-audio.mejs-container .mejs-button > button:hover,
        .wp-video .mejs-container .mejs-button > button:hover,
        .technum-price-item-widget .price-item.price-item-type-standard.active .price-item-custom-field.active:before,
        .slide-sidebar-wrapper .widget_technum_banner_widget .technum-contacts-widget-field:before,
        .slide-sidebar-wrapper .widget_search .search-form .search-form-icon:hover,
        .slide-sidebar-wrapper .widget_categories ul > li:hover, 
        .slide-sidebar-wrapper .widget_categories ul li:hover > a, 
        .slide-sidebar-wrapper .widget_technum_featured_posts_widget .featured-posts-item-link:hover,
        .slide-sidebar-wrapper .widget_archive ul li:hover > a,
        .slide-sidebar-wrapper .widget_archive ul > li:hover,
        .slide-sidebar-wrapper .widget_pages .widget-wrapper > ul li:hover > a,
        .slide-sidebar-wrapper .widget_meta ul li:hover > a,
        .slide-sidebar-wrapper .widget_recent_entries ul li a:hover,
        .slide-sidebar-wrapper .wp-block-latest-posts li a:hover,
        .slide-sidebar-wrapper .widget_recent_comments ul .recentcomments a:hover,
        .slide-sidebar-wrapper .wp-block-latest-comments li a:hover,
        .slide-sidebar-wrapper .widget_calendar .wp-calendar-nav a:hover,
        .slide-sidebar-wrapper .widget_calendar table tbody a,
        .slide-sidebar-wrapper .widget_rss ul a.rsswidget:hover,
        .slide-sidebar-wrapper .wp-block-rss .wp-block-rss__item-title a:hover,
        .slide-sidebar-wrapper .widget .widget-title a:hover,
        .technum-content-slider-widget .bottom-area .contacts .contact-item a:hover,
        .technum-content-slider-widget .bottom-area .contacts .contact-item:before,
        .slide-sidebar-wrapper .wp-block-search.wp-block-search__button-inside .wp-block-search__inside-wrapper .wp-block-search__button.has-icon:hover,
        .slide-sidebar-wrapper .wp-block-loginout a:hover {
            color: ' . esc_attr($contrast_accent_text_color) . ';
        }
        .widget_media_audio .mejs-controls .mejs-time-rail .mejs-time-current,
        .mejs-audio .mejs-controls .mejs-time-rail .mejs-time-current,
        .wp-video .mejs-controls .mejs-time-rail .mejs-time-current,
        .widget_media_audio .mejs-controls .mejs-time-rail .mejs-time-handle-content,
        .mejs-audio .mejs-controls .mejs-time-rail .mejs-time-handle-content,
        .wp-video .mejs-controls .mejs-time-rail .mejs-time-handle-content,
        .slide-sidebar-wrapper .slide-sidebar-close:hover,
        .slide-sidebar-wrapper .widget_nav_menu ul li a:before, 
        .slide-sidebar-wrapper .widget_technum_nav_menu_widget ul li a:before,
        .slide-sidebar-wrapper .widget_categories ul > li:hover:before, 
        .slide-sidebar-wrapper .widget_archive ul li:hover:before,
        .slide-sidebar-wrapper .widget_recent_comments ul .recentcomments:hover:before,
        .slide-sidebar-wrapper .widget_pages .widget-wrapper > ul > li:hover:before,
        .slide-sidebar-wrapper .widget_meta ul li:hover:before,
        .slide-sidebar-wrapper .wp-block-latest-comments li:hover:before {
            background-color: ' . esc_attr($contrast_accent_text_color) . ';
        }
        .widget_media_audio .mejs-controls .mejs-time-rail .mejs-time-handle-content,
        .mejs-audio .mejs-controls .mejs-time-rail .mejs-time-handle-content,
        .wp-video .mejs-controls .mejs-time-rail .mejs-time-handle-content {
            border-color: ' . esc_attr($contrast_accent_text_color) . ';
        }
        .widget_media_audio .mejs-controls .mejs-time-rail .mejs-time-hovered,
        .mejs-audio .mejs-controls .mejs-time-rail .mejs-time-hovered,
        .wp-video .mejs-controls .mejs-time-rail .mejs-time-hovered {
             background-color: rgba(' . esc_attr(technum_hex2rgb($contrast_accent_text_color)) . ', 0.4);
        }
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form .wpforms-field-number-slider input[type="range"]::-webkit-slider-thumb {
            background-color: ' . esc_attr($contrast_accent_text_color) . ';
        }
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form .wpforms-field-number-slider input[type="range"]::-moz-range-thumb {
             background-color: ' . esc_attr($contrast_accent_text_color) . ';
        }
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form .wpforms-field-number-slider input[type="range"]::-ms-thumb {
             background-color: ' . esc_attr($contrast_accent_text_color) . ';
        }
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form .wpforms-field-number-slider input[type="range"]:focus::-ms-thumb {
             background-color: ' . esc_attr($contrast_accent_text_color) . ';
        }
    ';
}

$contrast_border_color = technum_get_prefered_option('contrast_border_color');
if ( !empty($contrast_border_color) ) {
    $technum_custom_css .= '';
}

$contrast_border_hover_color = technum_get_prefered_option('contrast_border_hover_color');
if ( !empty($contrast_border_hover_color) ) {
    $technum_custom_css .= '
        .slide-sidebar-wrapper input[type="text"],
        .slide-sidebar-wrapper input[type="email"],
        .slide-sidebar-wrapper input[type="url"],
        .slide-sidebar-wrapper input[type="password"],
        .slide-sidebar-wrapper input[type="search"],
        .slide-sidebar-wrapper input[type="number"],
        .slide-sidebar-wrapper input[type="tel"],
        .slide-sidebar-wrapper input[type="range"],
        .slide-sidebar-wrapper input[type="date"],
        .slide-sidebar-wrapper input[type="month"],
        .slide-sidebar-wrapper input[type="week"],
        .slide-sidebar-wrapper input[type="time"],
        .slide-sidebar-wrapper input[type="datetime"],
        .slide-sidebar-wrapper input[type="datetime-local"],
        .slide-sidebar-wrapper input[type="color"],
        .slide-sidebar-wrapper textarea,
        .slide-sidebar-wrapper input[type="checkbox"],
        .slide-sidebar-wrapper input[type="radio"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="checkbox"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="radio"],
        .slide-sidebar-wrapper .select2-container .select2-selection--single,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="text"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="email"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="url"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="password"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="search"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="number"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="tel"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="date"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="month"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="week"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="time"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="datetime"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="datetime-local"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="color"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form select,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form textarea,
        .slide-sidebar-wrapper .wp-block-search.wp-block-search__button-inside .wp-block-search__inside-wrapper,
        .slide-sidebar-wrapper .select-wrap {
            border-color: ' . esc_attr($contrast_border_hover_color) . ';
        }
        .slide-sidebar-wrapper input[type="text"],
        .slide-sidebar-wrapper input[type="email"],
        .slide-sidebar-wrapper input[type="url"],
        .slide-sidebar-wrapper input[type="password"],
        .slide-sidebar-wrapper input[type="search"],
        .slide-sidebar-wrapper input[type="number"],
        .slide-sidebar-wrapper input[type="tel"],
        .slide-sidebar-wrapper input[type="range"],
        .slide-sidebar-wrapper input[type="date"],
        .slide-sidebar-wrapper input[type="month"],
        .slide-sidebar-wrapper input[type="week"],
        .slide-sidebar-wrapper input[type="time"],
        .slide-sidebar-wrapper input[type="datetime"],
        .slide-sidebar-wrapper input[type="datetime-local"],
        .slide-sidebar-wrapper input[type="color"],
        .slide-sidebar-wrapper textarea,
        .slide-sidebar-wrapper input[type="checkbox"],
        .slide-sidebar-wrapper input[type="radio"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="checkbox"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="radio"],
        .slide-sidebar-wrapper .select2-container .select2-selection--single,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="text"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="email"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="url"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="password"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="search"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="number"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="tel"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="date"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="month"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="week"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="time"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="datetime"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="datetime-local"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form input[type="color"],
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form select,
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form textarea,
        .slide-sidebar-wrapper .widget_media_audio .mejs-container, 
        .slide-sidebar-wrapper .widget_media_audio .mejs-container .mejs-controls, 
        .slide-sidebar-wrapper .widget_media_audio .mejs-embed, 
        .slide-sidebar-wrapper .widget_media_audio .mejs-embed body,
        .slide-sidebar-wrapper .wp-video .mejs-container, 
        .slide-sidebar-wrapper .wp-video .mejs-container .mejs-controls, 
        .slide-sidebar-wrapper .wp-video .mejs-embed, 
        .slide-sidebar-wrapper .wp-video .mejs-embed body,
        .slide-sidebar-wrapper .mejs-volume-button > .mejs-volume-slider,
        .slide-sidebar-wrapper .widget_tag_cloud .tagcloud .tag-cloud-link,
        .slide-sidebar-wrapper .widget_calendar .calendar_wrap,
        .slide-sidebar-wrapper .wp-block-search.wp-block-search__button-inside .wp-block-search__inside-wrapper,
        .slide-sidebar-wrapper .select-wrap {
            background-color: ' . esc_attr($contrast_border_hover_color) . ';
        }
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form .wpforms-field-number-slider input[type="range"]::-webkit-slider-runnable-track {
            background-color: ' . esc_attr($contrast_border_hover_color) . ';
        }
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form .wpforms-field-number-slider input[type="range"]:focus::-webkit-slider-runnable-track {
            background-color: ' . esc_attr($contrast_border_hover_color) . ';
        }
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form .wpforms-field-number-slider input[type="range"]::-moz-range-track {
            background-color: ' . esc_attr($contrast_border_hover_color) . ';
        }
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form .wpforms-field-number-slider input[type="range"]::-ms-track {
            background-color: ' . esc_attr($contrast_border_hover_color) . ';
        }
    ';
}

$contrast_background_color = technum_get_prefered_option('contrast_background_color');
if ( !empty($contrast_background_color) ) {
    $technum_custom_css .= '
        .header .main-menu > li ul.sub-menu,
        .content-wrapper .widget_media_audio .mejs-container, 
        .content-wrapper .widget_media_audio .mejs-container .mejs-controls, 
        .content-wrapper .widget_media_audio .mejs-embed, 
        .content-wrapper .widget_media_audio .mejs-embed body,
        .content-wrapper .mejs-audio.mejs-container, 
        .content-wrapper .mejs-audio.mejs-container .mejs-controls, 
        .content-wrapper .mejs-audio .mejs-embed, 
        .content-wrapper .mejs-audio .mejs-embed body,
        .content-wrapper .wp-video .mejs-container, 
        .content-wrapper .wp-video .mejs-container .mejs-controls, 
        .content-wrapper .wp-video .mejs-embed, 
        .content-wrapper .wp-video .mejs-embed body,
        .content-wrapper .mejs-volume-button > .mejs-volume-slider,
        .slide-sidebar-wrapper,
        .technum-content-slider-widget .bottom-area .content-slider-video,
        .slide-sidebar-wrapper .wp-block-search.wp-block-search__button-inside .wp-block-search__inside-wrapper:focus-within,
        .slide-sidebar-wrapper .wp-block-search.wp-block-search__button-inside .wp-block-search__input:focus,
        .slide-sidebar-wrapper .select-wrap:focus-within {
            background-color: ' . esc_attr($contrast_background_color) . ';
        }
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form .wpforms-field-number-slider input[type="range"]::-webkit-slider-thumb {
            border-color: ' . esc_attr($contrast_background_color) . ';
        }
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form .wpforms-field-number-slider input[type="range"]::-moz-range-thumb {
            border-color: ' . esc_attr($contrast_background_color) . ';
        }
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form .wpforms-field-number-slider input[type="range"]::-ms-thumb {
            border-color: ' . esc_attr($contrast_background_color) . ';
        }
        .slide-sidebar-wrapper div.wpforms-container.wpforms-container-full .wpforms-form .wpforms-field-number-slider input[type="range"]:focus::-ms-thumb {
            border-color: ' . esc_attr($contrast_background_color) . ';
        }
        .technum-content-slider-widget .bottom-area .content-slider-contacts {
            background-color: rgba(' . esc_attr(technum_hex2rgb($contrast_background_color)) . ', 0.75);
        }
    ';
}

$contrast_background_alter_color = technum_get_prefered_option('contrast_background_alter_color');
if ( !empty($contrast_background_alter_color) ) {
    $technum_custom_css .= '
        .slide-sidebar-wrapper .slide-sidebar-close,
        .slide-sidebar-wrapper .wp-block-calendar,
        .slide-sidebar-wrapper .widget_calendar .calendar_wrap {
            background-color: ' . esc_attr($contrast_background_alter_color) . ';
        }
    ';
}

$contrast_button_text_color = technum_get_prefered_option('contrast_button_text_color');
if ( !empty($contrast_button_text_color) ) {
    $technum_custom_css .= '
        .technum-price-item-widget .price-item.price-item-type-standard.active .price-item-title,
        .technum-price-item-widget .price-item.price-item-type-standard.active .price-item-button-container .technum-button:hover,
        .slide-sidebar-wrapper .wrapper-socials a, 
        .slide-sidebar-wrapper .wrapper-socials a:hover,
        .slide-sidebar-wrapper .technum-button,
        .slide-sidebar-wrapper .button,
        .slide-sidebar-wrapper input[type="submit"],
        .slide-sidebar-wrapper input[type="reset"],
        .slide-sidebar-wrapper input[type="button"],
        .slide-sidebar-wrapper button,
        .slide-sidebar-wrapper .widget_mc4wp_form_widget .mc4wp-form .mc4wp-form-fields button,
        .slide-sidebar-wrapper .widget .mc4wp-form .mc4wp-form-fields button,
        .slide-sidebar-wrapper .widget_calendar table tbody td#today:before,
        .slide-sidebar-wrapper .wp-block-gallery .blocks-gallery-grid .blocks-gallery-item a:after, 
        .slide-sidebar-wrapper .media_gallery .blocks-gallery-grid .blocks-gallery-item a:after,
        .slide-sidebar-wrapper .gallery .gallery-item .gallery-icon a:after,
        .slide-sidebar-wrapper .wp-block-button:not(.is-style-outline) .wp-block-button__link:not(.has-text-color),
        .wp-block-cover .wp-block-button:not(.is-style-outline) .wp-block-button__link:not(.has-text-color) {
            color: ' . esc_attr($contrast_button_text_color) . ';
        }
        .slide-sidebar-wrapper .wp-block-social-links.is-style-default:not(.has-icon-color) .wp-social-link a.wp-block-social-link-anchor svg,
        .slide-sidebar-wrapper .wp-block-social-links.is-style-default:not(.has-icon-color) .wp-social-link:hover a.wp-block-social-link-anchor svg {
            fill: ' . esc_attr($contrast_button_text_color) . ';
        }
    ';
}

$contrast_button_border_color = technum_get_prefered_option('contrast_button_border_color');
if ( !empty($contrast_button_border_color) ) {
    $technum_custom_css .= '
        .wp-video .mejs-overlay-play .mejs-overlay-button:before,
        .elementor-widget-video .elementor-custom-embed-play:before {
            color: ' . esc_attr($contrast_button_border_color) . ';
        }
        .widget_technum_banner_widget .banner-widget-wrapper.banner-contrast-colors,
        .technum-price-item-widget .price-item.active,
        .slide-sidebar-wrapper .wrapper-socials a,
        .slide-sidebar-wrapper .wp-block-social-links.is-style-default:not(.has-icon-background-color) .wp-social-link a.wp-block-social-link-anchor {
            background-color: ' . esc_attr($contrast_button_border_color) . ';
        }
        .slide-sidebar-wrapper .wrapper-socials a {
            border-color: ' . esc_attr($contrast_button_border_color) . ';
        }
        .slide-sidebar-wrapper .wp-block-gallery .blocks-gallery-grid .blocks-gallery-item a:before, 
        .slide-sidebar-wrapper .media_gallery .blocks-gallery-grid .blocks-gallery-item a:before,
        .slide-sidebar-wrapper .gallery .gallery-item .gallery-icon a:before,
        .widget_instagram-feed-widget #sb_instagram #sbi_images .sbi_photo:before, 
        .widget_instagram-feed-widget#sb_instagram #sbi_images .sbi_photo:before, 
        .widget #sb_instagram #sbi_images .sbi_photo:before, 
        .widget#sb_instagram #sbi_images .sbi_photo:before {
             background-color: rgba(' . esc_attr(technum_hex2rgb($contrast_button_border_color)) . ', 0.5);
        }
    ';
}

$contrast_button_background_color = technum_get_prefered_option('contrast_button_background_color');
if ( !empty($contrast_button_background_color) ) {
    $technum_custom_css .= '
        .technum-price-item-widget .price-item.price-item-type-standard.active .price-item-title,
        .slide-sidebar-wrapper .wrapper-socials a:hover,
        .slide-sidebar-wrapper .widget_calendar table tbody td#today:before,
        .slide-sidebar-wrapper .wp-block-social-links.is-style-default:not(.has-icon-background-color) .wp-social-link:hover a.wp-block-social-link-anchor {
            background-color: ' . esc_attr($contrast_button_background_color) . ';
        }
        .slide-sidebar-wrapper .wrapper-socials a:hover {
            border-color: ' . esc_attr($contrast_button_background_color) . ';
        }
    ';
}

$contrast_button_text_hover = technum_get_prefered_option('contrast_button_text_hover');
if ( !empty($contrast_button_text_hover) ) {
    $technum_custom_css .= '
        .slide-sidebar-wrapper .technum-button:hover,
        .slide-sidebar-wrapper .button:hover,
        .slide-sidebar-wrapper .wp-block-button:not(.is-style-outline) .wp-block-button__link:not(.has-text-color):hover,
        .wp-block-cover .wp-block-button:not(.is-style-outline) .wp-block-button__link:not(.has-text-color):hover,
        .slide-sidebar-wrapper input[type="submit"]:hover,
        .slide-sidebar-wrapper input[type="reset"]:hover,
        .slide-sidebar-wrapper input[type="button"]:hover,
        .slide-sidebar-wrapper button:hover,
        .slide-sidebar-wrapper .widget_mc4wp_form_widget .mc4wp-form .mc4wp-form-fields button:hover,
        .slide-sidebar-wrapper .widget .mc4wp-form .mc4wp-form-fields button:hover,
        .slide-sidebar-wrapper .widget_tag_cloud .tagcloud .tag-cloud-link:hover {
            color: ' . esc_attr($contrast_button_text_hover) . ';
        }
    ';
}

$contrast_button_border_hover = technum_get_prefered_option('contrast_button_border_hover');
if ( !empty($contrast_button_border_hover) ) {
    $technum_custom_css .= '
        .wp-video .mejs-layers .mejs-poster {
            background-color: ' . esc_attr($contrast_button_border_hover) . ';
        }
        .wp-video .mejs-layers .mejs-overlay-play {
            background-color: rgba(' . esc_attr(technum_hex2rgb($contrast_button_border_hover)) . ', 0.2);
        }
    ';
}

$contrast_button_background_hover = technum_get_prefered_option('contrast_button_background_hover');
if ( !empty($contrast_button_background_hover) ) {
    $technum_custom_css .= '
        .slide-sidebar-wrapper .widget_tag_cloud .tagcloud .tag-cloud-link:hover {
            background-color: ' . esc_attr($contrast_button_background_hover) . ';
        }
    ';
}

if ( !empty($contrast_button_background_hover) && !empty($contrast_button_background_color) ) {
    $technum_custom_css .= '
        .widget_technum_banner_widget .banner-widget-wrapper.banner-contrast-colors .technum-button:after {
            background: ' . esc_attr($contrast_button_background_hover) . ';
            background: -moz-linear-gradient(left, ' . esc_attr($contrast_button_background_color) . ' 0%, ' . esc_attr($contrast_button_background_color) . ' 50%, ' . esc_attr($contrast_button_background_hover) . ' 50%);
            background: -webkit-gradient(linear, left top, right top, color-stop(0%, ' . esc_attr($contrast_button_background_color) . '), color-stop(50%, ' . esc_attr
            ($contrast_button_background_color) . '), color-stop(50%, ' . esc_attr($contrast_button_background_hover) . '));
            background: -webkit-linear-gradient(left, ' . esc_attr($contrast_button_background_color) . ' 0%, ' . esc_attr($contrast_button_background_color) . ' 50%, ' . esc_attr($contrast_button_background_hover) .
            ' 50%);
            background: -o-linear-gradient(left, ' . esc_attr($contrast_button_background_color) . ' 0%, ' . esc_attr($contrast_button_background_hover) . ' 50%, ' . esc_attr($contrast_button_background_hover) . ' 50%);
            background: -ms-linear-gradient(left, ' . esc_attr($contrast_button_background_color) . ' 0%, ' . esc_attr($contrast_button_background_color) . ' 50%, ' . esc_attr($contrast_button_background_hover) . ' 50%);
            background: linear-gradient(to right, ' . esc_attr($contrast_button_background_color) . ' 0%, ' . esc_attr($contrast_button_background_color) . ' 50%, ' . esc_attr($contrast_button_background_hover) . ' 50%);
        }
        
        .technum-price-item-widget .price-item.active .price-item-button-container .technum-button:after,
        .slide-sidebar-wrapper .technum-button:after,
        .slide-sidebar-wrapper .button:after,
        .slide-sidebar-wrapper input[type="submit"]:after,
        .slide-sidebar-wrapper input[type="reset"]:after,
        .slide-sidebar-wrapper input[type="button"]:after,
        .slide-sidebar-wrapper button:after,
        .slide-sidebar-wrapper .widget_mc4wp_form_widget .mc4wp-form .mc4wp-form-fields button:after,
        .slide-sidebar-wrapper .widget .mc4wp-form .mc4wp-form-fields button:after,
        .slide-sidebar-wrapper .wp-block-button:not(.is-style-outline) .wp-block-button__link:not(.has-background):after,
        .wp-block-cover .wp-block-button:not(.is-style-outline) .wp-block-button__link:not(.has-background):after {
            background: ' . esc_attr($contrast_button_background_color) . ';
            background: -moz-linear-gradient(left, ' . esc_attr($contrast_button_background_hover) . ' 0%, ' . esc_attr($contrast_button_background_hover) . ' 50%, ' . esc_attr
            ($contrast_button_background_color) . ' 50%);
            background: -webkit-gradient(linear, left top, right top, color-stop(0%, ' . esc_attr($contrast_button_background_hover) . '), color-stop(50%, ' . esc_attr
            ($contrast_button_background_hover) . '), color-stop(50%, ' . esc_attr($contrast_button_background_color) . '));
            background: -webkit-linear-gradient(left, ' . esc_attr($contrast_button_background_hover) . ' 0%, ' . esc_attr($contrast_button_background_hover) . ' 50%, ' . esc_attr
            ($contrast_button_background_color) .
            ' 50%);
            background: -o-linear-gradient(left, ' . esc_attr($contrast_button_background_hover) . ' 0%, ' . esc_attr($contrast_button_background_color) . ' 50%, ' . esc_attr
            ($contrast_button_background_color) . ' 50%);
            background: -ms-linear-gradient(left, ' . esc_attr($contrast_button_background_hover) . ' 0%, ' . esc_attr($contrast_button_background_hover) . ' 50%, ' . esc_attr
            ($contrast_button_background_color) . ' 50%);
            background: linear-gradient(to right, ' . esc_attr($contrast_button_background_hover) . ' 0%, ' . esc_attr($contrast_button_background_hover) . ' 50%, ' . esc_attr
            ($contrast_button_background_color) . ' 50%);
        }
    ';
}