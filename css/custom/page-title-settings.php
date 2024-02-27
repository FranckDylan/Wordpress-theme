<?php

// --------------------------------- //
// ------ Page Title Settings ------ //
// --------------------------------- //

# General
$page_title_height              = technum_get_prepared_option('page_title_height', '', 'page_title_customize');
$page_title_background_position = technum_get_prepared_option('page_title_background_position', '', 'page_title_customize');
$page_title_background_repeat   = technum_get_prepared_option('page_title_background_repeat', '', 'page_title_customize');
$page_title_background_size     = technum_get_prepared_option('page_title_background_size', '', 'page_title_customize');

$hide_page_title_background_mobile = (bool)technum_get_prepared_option('hide_page_title_background_mobile', '', 'page_title_customize');
$hide_page_title_background_tablet = (bool)technum_get_prepared_option('hide_page_title_background_tablet', '', 'page_title_customize');

$page_title_background_image = technum_get_prepared_img_url('page_title_background_image', 'page_title_customize');
if ( !empty($page_title_height) ) {
    $technum_custom_css .= '
        @media only screen and (min-width: 992px) {
            .page-title-container {' .
                ( !empty($page_title_height) ? 'min-height: ' . esc_attr($page_title_height) . 'px;' : '' ) .
            '}
        }
    ';
}
if ( !empty($page_title_background_position) || !empty($page_title_background_repeat) || !empty($page_title_background_size) ) {
    $technum_custom_css .= '
        .page-title-container .page-title-bg {' .
            ( !empty($page_title_background_position) ? 'background-position: ' . esc_attr($page_title_background_position) . ';' : '' ) .
            ( !empty($page_title_background_repeat) ? 'background-repeat: ' . esc_attr($page_title_background_repeat) . ';' : '' ) .
            ( !empty($page_title_background_size) ? '-webkit-background-size: ' . esc_attr($page_title_background_size) . ';' : '' ) .
            ( !empty($page_title_background_size) ? 'background-size: ' . esc_attr($page_title_background_size) . ';' : '' ) .
        '}
    ';
}
if ( !empty($page_title_background_image) ) {
    $technum_custom_css .= '
        .page-title-container .page-title-bg {' .
            ( !empty($page_title_background_image) ? 'background-image: url("' . esc_attr($page_title_background_image) . '");' : '' ) .
        '}';
    }
    if ( $hide_page_title_background_mobile ) {
        $technum_custom_css .= '
            @media only screen and (max-width: 767px) {
                .page-title-container .page-title-bg {
                    background-image: none;
                }
            }
        ';
    }
    if ( $hide_page_title_background_mobile ) {
        $technum_custom_css .= '
            @media only screen and (min-width: 768px) and (max-width: 991px) {
                .page-title-container .page-title-bg {
                    background-image: none;
                }
            }
        ';
    }

# Heading
$page_title_heading_font        = technum_get_prepared_option('page_title_heading_font', '', 'page_title_heading_customize');
$page_title_heading_font_array  = json_decode($page_title_heading_font, true);
if (
    !empty($page_title_heading_font_array['font_family']) ||
    !empty($page_title_heading_font_array['text_transform']) ||
    !empty($page_title_heading_font_array['letter_spacing']) ||
    !empty($page_title_heading_font_array['word_spacing']) ||
    !empty($page_title_heading_font_array['font_style']) ||
    !empty($page_title_heading_font_array['font_weight'])
) {
    $technum_custom_css .= '
        .page-title-container h1.page-title,
        .page-title-container .page-title-wrapper .page-title-box {' .
            technum_print_font_styles( $page_title_heading_font, array('font_family', 'text_transform', 'letter_spacing', 'word_spacing', 'font_style', 'font_weight') ) .
        '}
    ';
}
if (
    !empty($page_title_heading_font_array['font_size']) ||
    !empty($page_title_heading_font_array['line_height'])
) {
    $technum_custom_css .= '
        @media only screen and (min-width: 576px) {
            .page-title-container h1.page-title,
            .page-title-container .page-title-wrapper .page-title-box {' .
                technum_print_font_styles( $page_title_heading_font, array('font_size', 'line_height') ) .
            '}
        }
    ';
}

# Additional
$page_title_additional_text_color = technum_get_prepared_option('page_title_additional_text_color', '', 'page_title_additional_customize');
if ( !empty($page_title_additional_text_color) ) {
    $technum_custom_css .= '
        .page-title-container .page-title-additional {
            color: ' . esc_attr($page_title_additional_text_color) . ';
        }
    ';
}