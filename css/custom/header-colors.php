<?php

// ---------------------------- //
// ------ Header Colors ------- //
// ---------------------------- //
$header_default_text_color = technum_get_prepared_option('header_default_text_color', 'standard_default_text_color', 'header_customize');
if ( !empty($header_default_text_color) ) {
    $technum_custom_css .= '
        .header,
        .mobile-header,
        .callback .callback-title {
            color: ' . esc_attr($header_default_text_color) . ';
        }
    ';
}

$header_dark_text_color = technum_get_prepared_option('header_dark_text_color', 'standard_dark_text_color', 'header_customize');
if ( !empty($header_dark_text_color) ) {
    $technum_custom_css .= '
        .header a,
        .header .main-menu > li > a,
        .header .logo-link .logo-site-name,
        .header .header-icon,
        .mobile-header a,
        .mobile-header .logo-link .logo-site-name,
        .mobile-header .header-icon,
        .mobile-header-menu-container a,
        .mobile-header-menu-container .logo-link .logo-site-name,
        .mobile-header-menu-container .header-icon,
        .error-404-header .logo-link .logo-site-name,
        .mini-cart .mini-cart-trigger,
        .mini-cart .mini-cart-trigger:hover,
        .mobile-header-menu-container,
        .header-type-2 .dropdown-trigger .dropdown-trigger-item:before,
        .header-type-3 .dropdown-trigger .dropdown-trigger-item:before,
        .callback .callback-text {
            color: ' . esc_attr($header_dark_text_color) . ';
        }
        .mobile-header .menu-trigger .hamburger span,
        .header .main-menu > li.menu-item-has-children > a:after {
            background-color: ' . esc_attr($header_dark_text_color) . ';
        }
    ';
}

$header_light_text_color = technum_get_prepared_option('header_light_text_color', 'standard_light_text_color', 'header_customize');
if ( !empty($header_light_text_color) ) {
    $technum_custom_css .= '
        .mobile-header-menu-container .main-menu > li .sub-menu-trigger {
             color: ' . esc_attr($header_light_text_color) . ';
        }
        .site-search .search-form .search-form-field::-webkit-input-placeholder {
             color: ' . esc_attr($header_light_text_color) . ';
        }
        .site-search .search-form .search-form-field:-moz-placeholder {
             color: ' . esc_attr($header_light_text_color) . ';
        }
        .site-search .search-form .search-form-field::-moz-placeholder {
             color: ' . esc_attr($header_light_text_color) . ';
        }
        .site-search .search-form .search-form-field:-ms-input-placeholder {
            color: ' . esc_attr($header_light_text_color) . ';
        }
    ';
}

$header_accent_text_color = technum_get_prepared_option('header_accent_text_color', 'standard_accent_text_color', 'header_customize');
if ( !empty($header_accent_text_color) ) {
    $technum_custom_css .= '
        .mobile-header-menu-container .header-mobile-contacts .contact-item:before,
        .mobile-header-menu-container .main-menu > li.active .sub-menu-trigger,
        .header .main-menu > li > a:hover,
        .header .main-menu > li.current-menu-ancestor > a,
        .header .main-menu > li.current-menu-parent > a,
        .header .main-menu > li.current-menu-item > a,
        .mobile-header-menu-container .main-menu li.active > a,
        .mobile-header-menu-container .main-menu li.current-menu-ancestor > a,
        .mobile-header-menu-container .main-menu li.current-menu-parent > a,
        .mobile-header-menu-container .main-menu li.current-menu-item > a,
        .mobile-header-menu-container .main-menu li.active > .sub-menu-trigger,
        .mobile-header-menu-container .main-menu li.current-menu-ancestor > .sub-menu-trigger,
        .mobile-header-menu-container .main-menu li.current-menu-parent > .sub-menu-trigger,
        .header-type-2 .dropdown-trigger .dropdown-trigger-item:hover:before,
        .header-type-3 .dropdown-trigger .dropdown-trigger-item:hover:before,
        .callback:before {
            color: ' . esc_attr($header_accent_text_color) . ';
        }
        .header .main-menu > li > a:before,
        .header .main-menu > li.menu-item-has-children > a:hover:after,
        .header .main-menu > li.menu-item-has-children.current-menu-ancestor > a:after,
        .header .main-menu > li.menu-item-has-children.current-menu-parent > a:after,
        .header .main-menu > li.menu-item-has-children.current-menu-item > a:after {
            background-color: ' . esc_attr($header_accent_text_color) . ';
        }
    ';
}

$header_border_color = technum_get_prepared_option('header_border_color', 'standard_border_color', 'header_customize');
if ( !empty($header_border_color) ) {
    $technum_custom_css .= '
        .site-search,
        .header-type-3 .dropdown-trigger {
            border-color: ' . esc_attr($header_border_color) . ';
        }
        .mobile-header-menu-container .main-menu > li > ul.sub-menu,
        .mobile-header-menu-container .main-menu > li {
            border-color: rgba(' . esc_attr(technum_hex2rgb($header_border_color)) . ', 0.4);
        }
    ';
}

$header_border_hover_color = technum_get_prepared_option('header_border_hover_color', 'standard_border_hover_color', 'header_customize');
if ( !empty($header_border_hover_color) ) {
    $technum_custom_css .= '';
}

$header_background_color = technum_get_prepared_option('header_background_color', 'standard_background_color', 'header_customize');
if ( !empty($header_background_color) ) {
    $technum_custom_css .= '
        .header,
        .mobile-header,
        .site-search,
        .mobile-header-menu-container,
        .header.sticky-header-on.sticky-ready .sticky-wrapper,
        .mobile-header.sticky-header-on.sticky-ready .sticky-wrapper {
            background-color: ' . esc_attr($header_background_color) . ';
        }
    ';
}

$header_background_alter_color = technum_get_prepared_option('header_background_alter_color', 'standard_background_alter_color', 'header_customize');
if ( !empty($header_background_alter_color) ) {
    $technum_custom_css .= '';
}

$header_button_text_color = technum_get_prepared_option('header_button_text_color', 'standard_button_text_color', 'header_customize');
if ( !empty($header_button_text_color) ) {
    $technum_custom_css .= '
        .header .technum-button, 
        .mobile-header .technum-button, 
        .mobile-header-menu-container .technum-button, 
        .mobile-header-menu-container .header-mobile-socials .mobile-menu-socials li a,
        .header-type-1 .dropdown-trigger .dropdown-trigger-item:before {
            color: ' . esc_attr($header_button_text_color) . ';
        }
    ';
}

$header_button_border_color = technum_get_prepared_option('header_button_border_color', 'standard_button_border_color', 'header_customize');
if ( !empty($header_button_border_color) ) {
    $technum_custom_css .= '';
    $technum_custom_css .= '
        .mobile-header-menu-container .header-mobile-socials .mobile-menu-socials li a,
        .header-type-1 .dropdown-trigger .dropdown-trigger-item {
            background-color: ' . esc_attr($header_button_border_color) . ';
        }
    ';
}

$header_button_background_color = technum_get_prepared_option('header_button_background_color', 'standard_button_background_color', 'header_customize');
if ( !empty($header_button_background_color) ) {
    $technum_custom_css .= '';
}

$header_button_text_hover = technum_get_prepared_option('header_button_text_hover', 'standard_button_text_hover', 'header_customize');
if ( !empty($header_button_text_hover) ) {
    $technum_custom_css .= '
        .header .technum-button:hover, 
        .mobile-header .technum-button:hover, 
        .mobile-header-menu-container .technum-button:hover,
        .mobile-header-menu-container .header-mobile-socials .mobile-menu-socials li a:hover {
            color: ' . esc_attr($header_button_text_hover) . ';
        }
    ';
}

$header_button_border_hover = technum_get_prepared_option('header_button_border_hover', 'standard_button_border_hover', 'header_customize');
if ( !empty($header_button_border_hover) ) {
    $technum_custom_css .= '
        .mobile-header-menu-container .header-mobile-socials .mobile-menu-socials li a:hover {
            background-color: ' . esc_attr($header_button_border_hover) . ';
        }
    ';
}

$header_button_background_hover = technum_get_prepared_option('header_button_background_hover', 'standard_button_background_hover', 'header_customize');
if ( !empty($header_button_background_hover) ) {
    $technum_custom_css .= '';
}

if ( !empty($header_button_background_hover) && !empty($header_button_background_color) ) {
    $technum_custom_css .= '
        .header .technum-button:after, 
        .mobile-header .technum-button:after, 
        .mobile-header-menu-container .technum-button:after {
            background: ' . esc_attr($header_button_background_color) . ';
            background: -moz-linear-gradient(left, ' . esc_attr($header_button_background_hover) . ' 0%, ' . esc_attr($header_button_background_hover) . ' 50%, ' . esc_attr($header_button_background_color) . ' 50%);
            background: -webkit-gradient(linear, left top, right top, color-stop(0%, ' . esc_attr($header_button_background_hover) . '), color-stop(50%, ' . esc_attr($header_button_background_hover) . '), color-stop(50%, ' . esc_attr($header_button_background_color) . '));
            background: -webkit-linear-gradient(left, ' . esc_attr($header_button_background_hover) . ' 0%, ' . esc_attr($header_button_background_hover) . ' 50%, ' . esc_attr($header_button_background_color) . ' 50%);
            background: -o-linear-gradient(left, ' . esc_attr($header_button_background_hover) . ' 0%, ' . esc_attr($header_button_background_hover) . ' 50%, ' . esc_attr($header_button_background_color) . ' 50%);
            background: -ms-linear-gradient(left, ' . esc_attr($header_button_background_hover) . ' 0%, ' . esc_attr($header_button_background_hover) . ' 50%, ' . esc_attr($header_button_background_color) . ' 50%);
            background: linear-gradient(to right, ' . esc_attr($header_button_background_hover) . ' 0%, ' . esc_attr($header_button_background_hover) . ' 50%, ' . esc_attr($header_button_background_color) . ' 50%);
        }
    ';
}