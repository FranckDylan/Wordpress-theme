<?php

// ---------------------------- //
// ------ 404 Error Page ------ //
// ---------------------------- //

$error_background_color     = technum_get_prepared_option('error_background_color', 'standard_background_alter_color', 'error_background_customize');
$error_background_position  = technum_get_prepared_option('error_background_position', '', 'error_background_customize');
$error_background_repeat    = technum_get_prepared_option('error_background_repeat', '', 'error_background_customize');
$error_background_size      = technum_get_prepared_option('error_background_size', '', 'error_background_customize');
$error_background_image     = technum_get_prepared_img_url('error_background_image');
if ( !empty($error_background_color) ) {
    $technum_custom_css .= '
        .error-404-container {
            background-color: ' . esc_attr($error_background_color) . ';
        }
    ';
}
if ( !empty($error_background_position) || !empty($error_background_repeat) || !empty($error_background_size) || !empty($error_background_image) ) {
    $technum_custom_css .= '
        @media only screen and (min-width: 768px) {
            .error-404-container {' .
                ( !empty($error_background_position) ? 'background-position: ' . esc_attr($error_background_position) . ';' : '' ) .
                ( !empty($error_background_repeat) ? 'background-repeat: ' . esc_attr($error_background_repeat) . ';' : '' ) .
                ( !empty($error_background_size) ? '-webkit-background-size: ' . esc_attr($error_background_size) . ';' : '' ) .
                ( !empty($error_background_size) ? 'background-size: ' . esc_attr($error_background_size) . ';' : '' ) .
                ( !empty($error_background_image) ? 'background-image: url("' . esc_attr($error_background_image) . '");' : '' ) .
            '}
        }
    ';
}