<?php

// ----------------------------- //
// ------ Top Bar Colors ------- //
// ----------------------------- //
$top_bar_default_text_color = technum_get_prepared_option('top_bar_default_text_color', 'standard_default_text_color', 'top_bar_customize');
if ( !empty($top_bar_default_text_color) ) {
    $technum_custom_css .= '
        .top-bar {
            color: ' . esc_attr($top_bar_default_text_color) . ';
        }
    ';
}

$top_bar_dark_text_color = technum_get_prepared_option('top_bar_dark_text_color', 'standard_dark_text_color', 'top_bar_customize');
if ( !empty($top_bar_dark_text_color) ) {
    $technum_custom_css .= '
        .wrapper-info .top-bar-additional-text,
        .wrapper-contacts .contact-item,
        .wrapper-contacts .contact-item a,
        .wrapper-socials.top-bar-socials a {
            color: ' . esc_attr($top_bar_dark_text_color) . ';
        }
    ';
}

$top_bar_light_text_color = technum_get_prepared_option('top_bar_light_text_color', 'standard_light_text_color', 'top_bar_customize');
if ( !empty($top_bar_light_text_color) ) {
    $technum_custom_css .= '';
}

$top_bar_accent_text_color = technum_get_prepared_option('top_bar_accent_text_color', 'standard_accent_text_color', 'top_bar_customize');
if ( !empty($top_bar_accent_text_color) ) {
    $technum_custom_css .= '
        .wrapper-contacts .contact-item:before,
        .wrapper-contacts .contact-item a:hover,
        .wrapper-socials.top-bar-socials a:hover {
            color: ' . esc_attr($top_bar_accent_text_color) . ';
        }
    ';
}

$top_bar_border_color = technum_get_prepared_option('top_bar_border_color', 'standard_border_color', 'top_bar_customize');
if ( !empty($top_bar_border_color) ) {
    $technum_custom_css .= '
        .top-bar {
            border-color: ' . esc_attr($top_bar_border_color) . ';
        }
        .wrapper-contacts .contact-item:not(:last-child):after {
            background-color: ' . esc_attr($top_bar_border_color) . ';
        }
    ';
}

$top_bar_border_hover_color = technum_get_prepared_option('top_bar_border_hover_color', 'standard_border_hover_color', 'top_bar_customize');
if ( !empty($top_bar_border_hover_color) ) {
    $technum_custom_css .= '';
}

$top_bar_background_color = technum_get_prepared_option('top_bar_background_color', 'standard_background_color', 'top_bar_customize');
if ( !empty($top_bar_background_color) ) {
    $technum_custom_css .= '
        .top-bar {
            background-color: ' . esc_attr($top_bar_background_color) . ';
        }
    ';
}

$top_bar_background_alter_color = technum_get_prepared_option('top_bar_background_alter_color', 'standard_background_alter_color', 'top_bar_customize');
if ( !empty($top_bar_background_alter_color) ) {
    $technum_custom_css .= '';
}

$top_bar_button_text_color = technum_get_prepared_option('top_bar_button_text_color', 'standard_button_text_color', 'top_bar_customize');
if ( !empty($top_bar_button_text_color) ) {
    $technum_custom_css .= '';
}

$top_bar_button_border_color = technum_get_prepared_option('top_bar_button_border_color', 'standard_button_border_color', 'top_bar_customize');
if ( !empty($top_bar_button_border_color) ) {
    $technum_custom_css .= '';
}

$top_bar_button_background_color = technum_get_prepared_option('top_bar_button_background_color', 'standard_button_background_color', 'top_bar_customize');
if ( !empty($top_bar_button_background_color) ) {
    $technum_custom_css .= '';
}

$top_bar_button_text_hover = technum_get_prepared_option('top_bar_button_text_hover', 'standard_button_text_hover', 'top_bar_customize');
if ( !empty($top_bar_button_text_hover) ) {
    $technum_custom_css .= '';
}

$top_bar_button_border_hover = technum_get_prepared_option('top_bar_button_border_hover', 'standard_button_border_hover', 'top_bar_customize');
if ( !empty($top_bar_button_border_hover) ) {
    $technum_custom_css .= '';
}

$top_bar_button_background_hover = technum_get_prepared_option('top_bar_button_background_hover', 'standard_button_background_hover', 'top_bar_customize');
if ( !empty($top_bar_button_background_hover) ) {
    $technum_custom_css .= '';
}