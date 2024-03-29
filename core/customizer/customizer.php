<?php
/*
 * Created by Artureanec
*/

require_once(get_template_directory() . "/core/customizer/customizer-sanitize-functions.php");
require_once(get_template_directory() . "/core/customizer/customizer-defaults.php");
require_once(get_template_directory() . "/core/customizer/customizer-controls.php");

# Register Customizer
add_action('customize_register', 'technum_customizer_register');
if (!function_exists('technum_customizer_register')) {
    function technum_customizer_register($wp_customize) {
        global $technum_customizer_default_values;

        // -------------------------------------------- //
        // ---------- Top Bar Settings Panel ---------- //
        // -------------------------------------------- //
        $wp_customize->add_panel('technum_top_bar_settings',
            array(
                'title'     => esc_html__('Top Bar Settings', 'technum'),
                'priority'  => 130
            )
        );

        // ---#######################--- //
        // ---### Top Bar General ###--- //
        // ---#######################--- //
        $wp_customize->add_section('technum_top_bar_general',
            array(
                'title' => esc_html__('General', 'technum'),
                'panel' => 'technum_top_bar_settings'
            )
        );

        // ---------------------- //
        // --- Top Bar Status --- //
        // ---------------------- //
        $wp_setting_name = 'top_bar_status';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Show Top Bar', 'technum'),
                'section'   => 'technum_top_bar_general',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // ------------------------- //
        // --- Top Bar Customize --- //
        // ------------------------- //
        $wp_setting_name = 'top_bar_customize';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Customize', 'technum'),
                'section'   => 'technum_top_bar_general',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // ---------------------------------- //
        // --- Top Bar Default Text Color --- //
        // ---------------------------------- //
        $wp_setting_name = 'top_bar_default_text_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Default Text Color', 'technum'),
                'section'       => 'technum_top_bar_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'top_bar_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ],
                'separator'     => 'before'
            )
        ));

        // ------------------------------- //
        // --- Top Bar Dark Text Color --- //
        // ------------------------------- //
        $wp_setting_name = 'top_bar_dark_text_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Dark Text Color', 'technum'),
                'section'       => 'technum_top_bar_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'top_bar_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // -------------------------------- //
        // --- Top Bar Light Text Color --- //
        // -------------------------------- //
        $wp_setting_name = 'top_bar_light_text_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Light Text Color', 'technum'),
                'section'       => 'technum_top_bar_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'top_bar_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // --------------------------------- //
        // --- Top Bar Accent Text Color --- //
        // --------------------------------- //
        $wp_setting_name = 'top_bar_accent_text_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Accent Text Color', 'technum'),
                'section'       => 'technum_top_bar_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'top_bar_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ---------------------------- //
        // --- Top Bar Border Color --- //
        // ---------------------------- //
        $wp_setting_name = 'top_bar_border_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Border Color', 'technum'),
                'section'       => 'technum_top_bar_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'top_bar_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ],
                'separator'     => 'before'
            )
        ));

        // ------------------------------------ //
        // --- Top Bar Hovered Border Color --- //
        // ------------------------------------ //
        $wp_setting_name = 'top_bar_border_hover_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Hovered Border Color', 'technum'),
                'section'       => 'technum_top_bar_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'top_bar_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // -------------------------------- //
        // --- Top Bar Background Color --- //
        // -------------------------------- //
        $wp_setting_name = 'top_bar_background_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Background Color', 'technum'),
                'section'       => 'technum_top_bar_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'top_bar_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ],
                'separator'     => 'before'
            )
        ));

        // -------------------------------------------- //
        // --- Top Bar Alternative Background Color --- //
        // -------------------------------------------- //
        $wp_setting_name = 'top_bar_background_alter_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Alternative Background Color', 'technum'),
                'section'       => 'technum_top_bar_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'top_bar_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // --------------------------------- //
        // --- Top Bar Button Text Color --- //
        // --------------------------------- //
        $wp_setting_name = 'top_bar_button_text_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Button Text Color', 'technum'),
                'section'       => 'technum_top_bar_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'top_bar_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ],
                'separator'     => 'before'
            )
        ));

        // ----------------------------------- //
        // --- Top Bar Button Border Color --- //
        // ----------------------------------- //
        $wp_setting_name = 'top_bar_button_border_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Button Border Color', 'technum'),
                'section'       => 'technum_top_bar_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'top_bar_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // --------------------------------------- //
        // --- Top Bar Button Background Color --- //
        // --------------------------------------- //
        $wp_setting_name = 'top_bar_button_background_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Button Background Color', 'technum'),
                'section'       => 'technum_top_bar_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'top_bar_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // --------------------------------- //
        // --- Top Bar Button Text Hover --- //
        // --------------------------------- //
        $wp_setting_name = 'top_bar_button_text_hover';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Button Text Hover', 'technum'),
                'section'       => 'technum_top_bar_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'top_bar_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ----------------------------------- //
        // --- Top Bar Button Border Hover --- //
        // ----------------------------------- //
        $wp_setting_name = 'top_bar_button_border_hover';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Button Border Hover', 'technum'),
                'section'       => 'technum_top_bar_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'top_bar_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // --------------------------------------- //
        // --- Top Bar Button Background Hover --- //
        // --------------------------------------- //
        $wp_setting_name = 'top_bar_button_background_hover';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Button Background Hover', 'technum'),
                'section'       => 'technum_top_bar_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'top_bar_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));


        // ---##############################--- //
        // ---### Top Bar Social Buttons ###--- //
        // ---##############################--- //
        $wp_customize->add_section('technum_top_bar_socials',
            array(
                'title' => esc_html__('Social Buttons', 'technum'),
                'panel' => 'technum_top_bar_settings'
            )
        );

        // ------------------------------ //
        // --- Top Bar Socials Status --- //
        // ------------------------------ //
        $wp_setting_name = 'top_bar_socials_status';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Show Social Buttons', 'technum'),
                'section'   => 'technum_top_bar_socials',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));


        // ---###############################--- //
        // ---### Top Bar Additional Text ###--- //
        // ---###############################--- //
        $wp_customize->add_section('technum_top_bar_additional_text',
            array(
                'title' => esc_html__('Additional Text', 'technum'),
                'panel' => 'technum_top_bar_settings'
            )
        );

        // -------------------------------------- //
        // --- Top Bar Additional Text Status --- //
        // -------------------------------------- //
        $wp_setting_name = 'top_bar_additional_text_status';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Show Additional Text', 'technum'),
                'section'   => 'technum_top_bar_additional_text',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // ------------------------------------- //
        // --- Top Bar Additional Text Title --- //
        // ------------------------------------- //
        $wp_setting_name = 'top_bar_additional_text_title';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'wp_kses_post'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Additional Text Title', 'technum'),
                'section'       => 'technum_top_bar_additional_text',
                'type'          => 'text',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'top_bar_additional_text_status',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ------------------------------- //
        // --- Top Bar Additional Text --- //
        // ------------------------------- //
        $wp_setting_name = 'top_bar_additional_text';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'wp_kses_post'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Additional Text', 'technum'),
                'section'       => 'technum_top_bar_additional_text',
                'type'          => 'text',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'top_bar_additional_text_status',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));


        // ---########################--- //
        // ---### Top Bar Contacts ###--- //
        // ---########################--- //
        $wp_customize->add_section('technum_top_bar_contacts',
            array(
                'title' => esc_html__('Contacts', 'technum'),
                'panel' => 'technum_top_bar_settings'
            )
        );

        // ------------------------------------ //
        // --- Top Bar Email Address Status --- //
        // ------------------------------------ //
        $wp_setting_name = 'top_bar_contacts_email_status';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Show Email Address', 'technum'),
                'section'   => 'technum_top_bar_contacts',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // ----------------------------- //
        // --- Top Bar Email Address --- //
        // ----------------------------- //
        $wp_setting_name = 'top_bar_contacts_email';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_email'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Email Address', 'technum'),
                'section'       => 'technum_top_bar_contacts',
                'type'          => 'email',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'top_bar_contacts_email_status',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ----------------------------------- //
        // --- Top Bar Phone Number Status --- //
        // ----------------------------------- //
        $wp_setting_name = 'top_bar_contacts_phone_status';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Show Phone Number', 'technum'),
                'section'   => 'technum_top_bar_contacts',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // ---------------------------- //
        // --- Top Bar Phone Number --- //
        // ---------------------------- //
        $wp_setting_name = 'top_bar_contacts_phone';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Phone Number', 'technum'),
                'section'       => 'technum_top_bar_contacts',
                'type'          => 'text',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'top_bar_contacts_phone_status',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ------------------------------ //
        // --- Top Bar Address Status --- //
        // ------------------------------ //
        $wp_setting_name = 'top_bar_contacts_address_status';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Show Address', 'technum'),
                'section'   => 'technum_top_bar_contacts',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // ----------------------- //
        // --- Top Bar Address --- //
        // ----------------------- //
        $wp_setting_name = 'top_bar_contacts_address';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Address', 'technum'),
                'section'       => 'technum_top_bar_contacts',
                'type'          => 'text',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'top_bar_contacts_address_status',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));


        // ------------------------------------------- //
        // ---------- Header Settings Panel ---------- //
        // ------------------------------------------- //
        $wp_customize->add_panel('technum_header_settings',
            array(
                'title'     => esc_html__('Header Settings', 'technum'),
                'priority'  => 130
            )
        );

        // ---######################--- //
        // ---### Header General ###--- //
        // ---######################--- //
        $wp_customize->add_section('technum_header_general',
            array(
                'title' => esc_html__('General', 'technum'),
                'panel' => 'technum_header_settings'
            )
        );

        // --------------------- //
        // --- Header Status --- //
        // --------------------- //
        $wp_setting_name = 'header_status';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Show Header', 'technum'),
                'section'   => 'technum_header_general',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // ------------------- //
        // --- Header Type --- //
        // ------------------- //
        $wp_setting_name = 'header_style';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Header Style', 'technum'),
                'section'   => 'technum_header_general',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'type-1'    => esc_html__('Style Type 1', 'technum'),
                    'type-2'    => esc_html__('Style Type 2', 'technum'),
                    'type-3'    => esc_html__('Style Type 3', 'technum')
                )
            )
        ));

        // ----------------------- //
        // --- Header Position --- //
        // ----------------------- //
        $wp_setting_name = 'header_position';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Header Position', 'technum'),
                'section'   => 'technum_header_general',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'above'     => esc_html__('Above', 'technum'),
                    'over'      => esc_html__('Over', 'technum')
                )
            )
        ));

        // ------------------------ //
        // --- Header Customize --- //
        // ------------------------ //
        $wp_setting_name = 'header_customize';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Customize', 'technum'),
                'section'   => 'technum_header_general',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // --------------------------------- //
        // --- Header Default Text Color --- //
        // --------------------------------- //
        $wp_setting_name = 'header_default_text_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Default text color', 'technum'),
                'section'       => 'technum_header_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'header_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ],
                'separator'     => 'before'
            )
        ));

        // ------------------------------ //
        // --- Header Dark Text Color --- //
        // ------------------------------ //
        $wp_setting_name = 'header_dark_text_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Dark text color', 'technum'),
                'section'       => 'technum_header_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'header_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ------------------------------- //
        // --- Header Light Text Color --- //
        // ------------------------------- //
        $wp_setting_name = 'header_light_text_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Light text color', 'technum'),
                'section'       => 'technum_header_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'header_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // -------------------------------- //
        // --- Header Accent Text Color --- //
        // -------------------------------- //
        $wp_setting_name = 'header_accent_text_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Accent text color', 'technum'),
                'section'       => 'technum_header_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'header_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // --------------------------- //
        // --- Header Border Color --- //
        // --------------------------- //
        $wp_setting_name = 'header_border_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Border color', 'technum'),
                'section'       => 'technum_header_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'header_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ],
                'separator'     => 'before'
            )
        ));

        // ----------------------------------- //
        // --- Header Hovered Border Color --- //
        // ----------------------------------- //
        $wp_setting_name = 'header_border_hover_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Hovered Border color', 'technum'),
                'section'       => 'technum_header_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'header_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ------------------------------- //
        // --- Header Background Color --- //
        // ------------------------------- //
        $wp_setting_name = 'header_background_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Background color', 'technum'),
                'section'       => 'technum_header_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'header_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ],
                'separator'     => 'before'
            )
        ));

        // ------------------------------------------- //
        // --- Header Background Alternative Color --- //
        // ------------------------------------------- //
        $wp_setting_name = 'header_background_alter_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Alternative background color', 'technum'),
                'section'       => 'technum_header_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'header_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // -------------------------------- //
        // --- Header Button Text Color --- //
        // -------------------------------- //
        $wp_setting_name = 'header_button_text_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Button Text color', 'technum'),
                'section'       => 'technum_header_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'header_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ],
                'separator'     => 'before'
            )
        ));

        // ---------------------------------- //
        // --- Header Button Border Color --- //
        // ---------------------------------- //
        $wp_setting_name = 'header_button_border_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Button Border color', 'technum'),
                'section'       => 'technum_header_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'header_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // -------------------------------------- //
        // --- Header Button Background Color --- //
        // -------------------------------------- //
        $wp_setting_name = 'header_button_background_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Button Background Color', 'technum'),
                'section'       => 'technum_header_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'header_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // -------------------------------- //
        // --- Header Button Text Hover --- //
        // -------------------------------- //
        $wp_setting_name = 'header_button_text_hover';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Button Text Hover', 'technum'),
                'section'       => 'technum_header_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'header_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ---------------------------------- //
        // --- Header Button Border Hover --- //
        // ---------------------------------- //
        $wp_setting_name = 'header_button_border_hover';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Button Border Hover', 'technum'),
                'section'       => 'technum_header_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'header_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // -------------------------------------- //
        // --- Header Button Background Hover --- //
        // -------------------------------------- //
        $wp_setting_name = 'header_button_background_hover';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Button Background Hover', 'technum'),
                'section'       => 'technum_header_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'header_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));


        // ---#######################--- //
        // ---### Header Callback ###--- //
        // ---#######################--- //
        $wp_customize->add_section('technum_header_callback',
            array(
                'title' => esc_html__('Header Callback', 'technum'),
                'panel' => 'technum_header_settings'
            )
        );

        // ----------------------- //
        // --- Header Callback --- //
        // ----------------------- //
        $wp_setting_name = 'header_callback_status';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Show header callback block', 'technum'),
                'section'       => 'technum_header_callback',
                'type'          => 'select',
                'settings'      => $wp_setting_name,
                'choices'       => array(
                    'on'            => esc_html__('Yes', 'technum'),
                    'off'           => esc_html__('No', 'technum')
                ),
                'dependency'    => [
                    [
                        'control'   => 'header_style',
                        'operator'  => '==',
                        'value'     => 'type-3'
                    ]
                ]
            )
        ));

        // ----------------------------- //
        // --- Header Callback Title --- //
        // ----------------------------- //
        $wp_setting_name = 'header_callback_title';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Header callback title', 'technum'),
                'section'       => 'technum_header_callback',
                'type'          => 'text',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'header_style',
                        'operator'  => '==',
                        'value'     => 'type-3'
                    ],
                    [
                        'control'   => 'header_callback_status',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ---------------------------- //
        // --- Header Callback Text --- //
        // ---------------------------- //
        $wp_setting_name = 'header_callback_text';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Header callback text', 'technum'),
                'section'       => 'technum_header_callback',
                'type'          => 'text',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'header_style',
                        'operator'  => '==',
                        'value'     => 'type-3'
                    ],
                    [
                        'control'   => 'header_callback_status',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));


        // ---#####################--- //
        // ---### Sticky Header ###--- //
        // ---#####################--- //
        $wp_customize->add_section('technum_header_sticky',
            array(
                'title' => esc_html__('Sticky Header', 'technum'),
                'panel' => 'technum_header_settings'
            )
        );


        // --------------------- //
        // --- Sticky Header --- //
        // --------------------- //
        $wp_setting_name = 'sticky_header_status';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Show Sticky Header', 'technum'),
                'section'   => 'technum_header_sticky',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));


        // ---#####################--- //
        // ---### Mobile Header ###--- //
        // ---#####################--- //
        $wp_customize->add_section('technum_header_mobile',
            array(
                'title' => esc_html__('Mobile Header', 'technum'),
                'panel' => 'technum_header_settings'
            )
        );

        // -------------------------------- //
        // --- Mobile Header Breakpoint --- //
        // -------------------------------- //
        $wp_setting_name = 'mobile_header_breakpoint';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'absint'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Mobile Header Breakpoint, in px', 'technum'),
                'section'       => 'technum_header_mobile',
                'type'          => 'number',
                'settings'      => $wp_setting_name
            )
        ));


        // ---#####################--- //
        // ---### Logo Settings ###--- //
        // ---#####################--- //
        $wp_customize->add_section('technum_header_logo',
            array(
                'title' => esc_html__('Logo', 'technum'),
                'panel' => 'technum_header_settings'
            )
        );

        // -------------------------- //
        // --- Header Logo Status --- //
        // -------------------------- //
        $wp_setting_name = 'header_logo_status';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Show Logo', 'technum'),
                'section'   => 'technum_header_logo',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // ----------------------------- //
        // --- Header Logo Customize --- //
        // ----------------------------- //
        $wp_setting_name = 'header_logo_customize';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Customize', 'technum'),
                'section'   => 'technum_header_logo',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // ------------------- //
        // --- Header Logo --- //
        // ------------------- //
        $wp_setting_name = 'header_logo_image';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'esc_url_raw'
            )
        );
        $wp_customize->add_control(new Technum_Image_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Logo Image', 'technum'),
                'section'       => 'technum_header_logo',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'header_logo_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ------------------- //
        // --- Logo Retina --- //
        // ------------------- //
        $wp_setting_name = 'header_logo_retina';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_checkbox'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Logo Retina', 'technum'),
                'section'       => 'technum_header_logo',
                'type'          => 'checkbox',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'header_logo_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // -------------------------- //
        // --- Mobile Header Logo --- //
        // -------------------------- //
        $wp_setting_name = 'header_logo_mobile_image';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'esc_url_raw'
            )
        );
        $wp_customize->add_control(new Technum_Image_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Mobile Logo Image', 'technum'),
                'section'       => 'technum_header_logo',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'header_logo_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ],
                'separator'     => 'before'
            )
        ));

        // -------------------------- //
        // --- Mobile Logo Retina --- //
        // -------------------------- //
        $wp_setting_name = 'header_logo_mobile_retina';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_checkbox'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Mobile Logo Retina', 'technum'),
                'section'       => 'technum_header_logo',
                'type'          => 'checkbox',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'header_logo_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));


        // ---#####################--- //
        // ---### Header Button ###--- //
        // ---#####################--- //
        $wp_customize->add_section('technum_header_button',
            array(
                'title' => esc_html__('Header Button', 'technum'),
                'panel' => 'technum_header_settings'
            )
        );

        // --------------------- //
        // --- Header Button --- //
        // --------------------- //
        $wp_setting_name = 'header_button_status';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Show header button', 'technum'),
                'section'   => 'technum_header_button',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // -------------------------- //
        // --- Header Button Text --- //
        // -------------------------- //
        $wp_setting_name = 'header_button_text';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Header button text', 'technum'),
                'section'       => 'technum_header_button',
                'type'          => 'text',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'header_button_status',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // -------------------------- //
        // --- Header Button URL ---- //
        // -------------------------- //
        $wp_setting_name = 'header_button_url';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'esc_url_raw'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Header button link', 'technum'),
                'section'       => 'technum_header_button',
                'type'          => 'text',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'header_button_status',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));


        // ---############################--- //
        // ---### Header Menu Settings ###--- //
        // ---############################--- //
        $wp_customize->add_section('technum_header_menu',
            array(
                'title' => esc_html__('Header Menu', 'technum'),
                'panel' => 'technum_header_settings'
            )
        );

        // -------------------------- //
        // --- Header Menu Status --- //
        // -------------------------- //
        $wp_setting_name = 'header_menu_status';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Show header menu', 'technum'),
                'section'   => 'technum_header_menu',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // -------------------------- //
        // --- Header Menu Select --- //
        // -------------------------- //
        $wp_setting_name = 'header_menu_select';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Select Menu', 'technum'),
                'section'       => 'technum_header_menu',
                'type'          => 'select',
                'settings'      => $wp_setting_name,
                'choices'       => technum_get_all_menu_list()
            )
        ));

        // ----------------------------- //
        // --- Header Menu Customize --- //
        // ----------------------------- //
        $wp_setting_name = 'header_menu_customize';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Customize', 'technum'),
                'section'   => 'technum_header_menu',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // ------------------- //
        // --- Header Font --- //
        // ------------------- //
        $wp_setting_name = 'header_menu_font';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Google_Font_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Menu Font', 'technum'),
                'section'       => 'technum_header_menu',
                'settings'      => $wp_setting_name,
                'show_field'    => [
                    'font_family'       => true,
                    'font_backup'       => true,
                    'font_styles'       => true,
                    'font_subset'       => true,
                    'font_size'         => true,
                    'line_height'       => true,
                    'text_transform'    => true,
                    'letter_spacing'    => true,
                    'word_spacing'      => true,
                    'font_style'        => true,
                    'font_weight'       => true
                ],
                'dependency'            => [
                    [
                        'control'           => 'header_menu_customize',
                        'operator'          => '==',
                        'value'             => 'on'
                    ]
                ]
            )
        ));

        // --------------------- //
        // --- Sub Menu Font --- //
        // --------------------- //
        $wp_setting_name = 'header_sub_menu_font';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Google_Font_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Sub Menu Font', 'technum'),
                'section'       => 'technum_header_menu',
                'settings'      => $wp_setting_name,
                'show_field'    => [
                    'font_family'       => true,
                    'font_backup'       => true,
                    'font_styles'       => true,
                    'font_subset'       => true,
                    'font_size'         => true,
                    'line_height'       => true,
                    'text_transform'    => true,
                    'letter_spacing'    => true,
                    'word_spacing'      => true,
                    'font_style'        => true,
                    'font_weight'       => true
                ],
                'separator'     => 'before',
                'dependency'    => [
                    [
                        'control'           => 'header_menu_customize',
                        'operator'          => '==',
                        'value'             => 'on'
                    ]
                ]
            )
        ));


        // ---####################--- //
        // ---### Header Icons ###--- //
        // ---####################--- //
        $wp_customize->add_section('header_icons',
            array(
                'title' => esc_html__('Header Icons', 'technum'),
                'panel' => 'technum_header_settings'
            )
        );

        // ------------------------- //
        // --- Header Side Panel --- //
        // ------------------------- //
        $wp_setting_name = 'side_panel_status';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Show side panel trigger', 'technum'),
                'section'   => 'header_icons',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // --------------------- //
        // --- Header Search --- //
        // --------------------- //
        $wp_setting_name = 'header_search_status';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Show header search', 'technum'),
                'section'   => 'header_icons',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));


        if ( class_exists('WooCommerce') ) {
            // ------------------------ //
            // --- Header Mini Cart --- //
            // ------------------------ //
            $wp_setting_name = 'header_minicart_status';
            $wp_customize->add_setting(
                $wp_setting_name,
                array(
                    'default'           => $technum_customizer_default_values[$wp_setting_name],
                    'sanitize_callback'	=> 'technum_sanitize_choice'
                )
            );
            $wp_customize->add_control(new Technum_Customize_Control(
                $wp_customize,
                $wp_setting_name,
                array(
                    'label'     => esc_html__('Show product cart', 'technum'),
                    'section'   => 'header_icons',
                    'type'      => 'select',
                    'settings'  => $wp_setting_name,
                    'choices'   => array(
                        'on'        => esc_html__('Yes', 'technum'),
                        'off'       => esc_html__('No', 'technum')
                    )
                )
            ));
        }


        // ------------------------------- //
        // ---------- Page Tile ---------- //
        // ------------------------------- //
        $wp_customize->add_panel('technum_page_title_settings',
            array(
                'title'     => esc_html__('Page Title Settings', 'technum'),
                'priority'  => 140
            )
        );

        // ---########################--- //
        // ---### General Settings ###--- //
        // ---########################--- //
        $wp_customize->add_section('technum_page_title_general',
            array(
                'title' => esc_html__('General', 'technum'),
                'panel' => 'technum_page_title_settings'
            )
        );

        // ------------------------- //
        // --- Page Title Status --- //
        // ------------------------- //
        $wp_setting_name = 'page_title_status';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Show page title', 'technum'),
                'section'   => 'technum_page_title_general',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // -------------------------- //
        // --- Page Title Overlay --- //
        // -------------------------- //
        $wp_setting_name = 'page_title_overlay_status';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Show overlay', 'technum'),
                'section'   => 'technum_page_title_general',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // -------------------------------- //
        // --- Page Title Overlay Color --- //
        // -------------------------------- //
        $wp_setting_name = 'page_title_overlay_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_alpha_color'
            )
        );
        $wp_customize->add_control(new Technum_Alpha_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Overlay color', 'technum'),
                'section'       => 'technum_page_title_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'page_title_overlay_status',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ---------------------------- //
        // --- Page Title Customize --- //
        // ---------------------------- //
        $wp_setting_name = 'page_title_customize';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Customize', 'technum'),
                'section'   => 'technum_page_title_general',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                ),
                'separator' => 'before'
            )
        ));

        // ------------------------------- //
        // --- Page Title Block Height --- //
        // ------------------------------- //
        $wp_setting_name = 'page_title_height';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Page title height, in px', 'technum'),
                'section'       => 'technum_page_title_general',
                'type'          => 'number',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'page_title_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ------------------------------------- //
        // --- Page Title Default Text Color --- //
        // ------------------------------------- //
        $wp_setting_name = 'page_title_default_text_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Default text color', 'technum'),
                'section'       => 'technum_page_title_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'page_title_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ],
                'separator'     => 'before'
            )
        ));

        // ---------------------------------- //
        // --- Page Title Dark Text Color --- //
        // ---------------------------------- //
        $wp_setting_name = 'page_title_dark_text_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Dark text color', 'technum'),
                'section'       => 'technum_page_title_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'page_title_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ----------------------------------- //
        // --- Page Title Light Text Color --- //
        // ----------------------------------- //
        $wp_setting_name = 'page_title_light_text_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Light text color', 'technum'),
                'section'       => 'technum_page_title_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'page_title_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ------------------------------------ //
        // --- Page Title Accent Text Color --- //
        // ------------------------------------ //
        $wp_setting_name = 'page_title_accent_text_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Accent text color', 'technum'),
                'section'       => 'technum_page_title_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'page_title_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ------------------------------- //
        // --- Page Title Border Color --- //
        // ------------------------------- //
        $wp_setting_name = 'page_title_border_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Border color', 'technum'),
                'section'       => 'technum_page_title_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'page_title_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ],
                'separator'     => 'before'
            )
        ));

        // --------------------------------------- //
        // --- Page Title Hovered Border Color --- //
        // --------------------------------------- //
        $wp_setting_name = 'page_title_border_hover_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Hovered border color', 'technum'),
                'section'       => 'technum_page_title_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'page_title_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ----------------------------------- //
        // --- Page Title Background Color --- //
        // ----------------------------------- //
        $wp_setting_name = 'page_title_background_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Background color', 'technum'),
                'section'       => 'technum_page_title_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'page_title_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ],
                'separator'     => 'before'
            )
        ));

        // ----------------------------------------------- //
        // --- Page Title Alternative Background Color --- //
        // ----------------------------------------------- //
        $wp_setting_name = 'page_title_background_alter_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Alternative background color', 'technum'),
                'section'       => 'technum_page_title_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'page_title_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ------------------------------------ //
        // --- Page Title Button Text Color --- //
        // ------------------------------------ //
        $wp_setting_name = 'page_title_button_text_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Button Text Color', 'technum'),
                'section'       => 'technum_page_title_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'page_title_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ],
                'separator'     => 'before'
            )
        ));

        // -------------------------------------- //
        // --- Page Title Button Border Color --- //
        // -------------------------------------- //
        $wp_setting_name = 'page_title_button_border_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Button Border Color', 'technum'),
                'section'       => 'technum_page_title_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'page_title_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ------------------------------------------ //
        // --- Page Title Button Background Color --- //
        // ------------------------------------------ //
        $wp_setting_name = 'page_title_button_background_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Button Background Color', 'technum'),
                'section'       => 'technum_page_title_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'page_title_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ------------------------------------ //
        // --- Page Title Button Text Hover --- //
        // ------------------------------------ //
        $wp_setting_name = 'page_title_button_text_hover';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Button Text Hover', 'technum'),
                'section'       => 'technum_page_title_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'page_title_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // -------------------------------------- //
        // --- Page Title Button Border Hover --- //
        // -------------------------------------- //
        $wp_setting_name = 'page_title_button_border_hover';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Button Border Hover', 'technum'),
                'section'       => 'technum_page_title_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'page_title_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ------------------------------------------ //
        // --- Page Title Button Background Hover --- //
        // ------------------------------------------ //
        $wp_setting_name = 'page_title_button_background_hover';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Button Background Hover', 'technum'),
                'section'       => 'technum_page_title_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'page_title_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ----------------------------------- //
        // --- Page Title Background Image --- //
        // ----------------------------------- //
        $wp_setting_name = 'page_title_background_image';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'esc_url_raw'
            )
        );
        $wp_customize->add_control(new Technum_Image_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Background Image', 'technum'),
                'section'       => 'technum_page_title_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'page_title_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ],
                'separator'     => 'before'
            )
        ));

        // -------------------------------------- //
        // --- Page Title Background Position --- //
        // -------------------------------------- //
        $wp_setting_name = 'page_title_background_position';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Background Position', 'technum'),
                'section'       => 'technum_page_title_general',
                'type'          => 'select',
                'settings'      => $wp_setting_name,
                'choices'       => technum_get_background_position_options(),
                'dependency'    => [
                    [
                        'control'   => 'page_title_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ------------------------------------ //
        // --- Page Title Background Repeat --- //
        // ------------------------------------ //
        $wp_setting_name = 'page_title_background_repeat';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Background Repeat', 'technum'),
                'section'       => 'technum_page_title_general',
                'type'          => 'select',
                'settings'      => $wp_setting_name,
                'choices'       => technum_get_background_repeat_options(),
                'dependency'    => [
                    [
                        'control'   => 'page_title_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ---------------------------------- //
        // --- Page Title Background Size --- //
        // ---------------------------------- //
        $wp_setting_name = 'page_title_background_size';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Background Size', 'technum'),
                'section'       => 'technum_page_title_general',
                'type'          => 'select',
                'settings'      => $wp_setting_name,
                'choices'       => technum_get_background_size_options(),
                'dependency'    => [
                    [
                        'control'   => 'page_title_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ---------------------------------------------------- //
        // --- Hide Page Title Background on Mobile Devices --- //
        // ---------------------------------------------------- //
        $wp_setting_name = 'hide_page_title_background_mobile';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_checkbox'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Hide Background Image on Mobile Devices', 'technum'),
                'section'       => 'technum_page_title_general',
                'type'          => 'checkbox',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'page_title_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ---------------------------------------------------- //
        // --- Hide Page Title Background on Tablet Devices --- //
        // ---------------------------------------------------- //
        $wp_setting_name = 'hide_page_title_background_tablet';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_checkbox'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Hide Background Image on Tablet Devices', 'technum'),
                'section'       => 'technum_page_title_general',
                'type'          => 'checkbox',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'page_title_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));


        // ---########################--- //
        // ---### Heading Settings ###--- //
        // ---########################--- //
        $wp_customize->add_section('technum_page_title_heading',
            array(
                'title' => esc_html__('Heading', 'technum'),
                'panel' => 'technum_page_title_settings'
            )
        );

        // ------------------------------------ //
        // --- Page Title Heading Customize --- //
        // ------------------------------------ //
        $wp_setting_name = 'page_title_heading_customize';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Customize', 'technum'),
                'section'       => 'technum_page_title_heading',
                'type'          => 'select',
                'settings'      => $wp_setting_name,
                'choices'       => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // ------------------------------- //
        // --- Page Title Heading Font --- //
        // ------------------------------- //
        $wp_setting_name = 'page_title_heading_font';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Google_Font_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Heading Font', 'technum'),
                'section'       => 'technum_page_title_heading',
                'settings'      => $wp_setting_name,
                'show_field'    => [
                    'font_family'       => true,
                    'font_backup'       => true,
                    'font_styles'       => true,
                    'font_subset'       => true,
                    'font_size'         => true,
                    'line_height'       => true,
                    'text_transform'    => true,
                    'letter_spacing'    => true,
                    'word_spacing'      => true,
                    'font_style'        => true,
                    'font_weight'       => true
                ],
                'dependency'            => [
                    [
                        'control'           => 'page_title_heading_customize',
                        'operator'          => '==',
                        'value'             => 'on'
                    ]
                ]
            )
        ));


        // ---###########################--- //
        // ---### Subheading Settings ###--- //
        // ---###########################--- //
        $wp_customize->add_section('technum_page_title_breadcrumbs',
            array(
                'title' => esc_html__('Breadcrumbs', 'technum'),
                'panel' => 'technum_page_title_settings'
            )
        );

        // ------------------------------------- //
        // --- Page Title Breadcrumbs Status --- //
        // ------------------------------------- //
        $wp_setting_name = 'page_title_breadcrumbs_status';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Show page title breadcrumbs', 'technum'),
                'section'   => 'technum_page_title_breadcrumbs',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // ---------------------------------------- //
        // --- Page Title Breadcrumbs Customize --- //
        // ---------------------------------------- //
        $wp_setting_name = 'page_title_breadcrumbs_customize';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Customize', 'technum'),
                'section'   => 'technum_page_title_breadcrumbs',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // ----------------------------------- //
        // --- Page Title Breadcrumbs Font --- //
        // ----------------------------------- //
        $wp_setting_name = 'page_title_breadcrumbs_font';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Google_Font_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Breadcrumbs Font', 'technum'),
                'section'       => 'technum_page_title_breadcrumbs',
                'settings'      => $wp_setting_name,
                'show_field'    => [
                    'font_family'       => true,
                    'font_backup'       => true,
                    'font_styles'       => true,
                    'font_subset'       => true,
                    'font_size'         => true,
                    'line_height'       => true,
                    'text_transform'    => true,
                    'letter_spacing'    => true,
                    'word_spacing'      => true,
                    'font_style'        => true,
                    'font_weight'       => true
                ],
                'dependency'            => [
                    [
                        'control'           => 'page_title_breadcrumbs_customize',
                        'operator'          => '==',
                        'value'             => 'on'
                    ]
                ]
            )
        ));


        // ---################################--- //
        // ---### Additional Text Settings ###--- //
        // ---################################--- //
        $wp_customize->add_section('technum_page_title_additional',
            array(
                'title' => esc_html__('Heading Additional Text', 'technum'),
                'panel' => 'technum_page_title_settings'
            )
        );

        // ----------------------- //
        // --- Additional Text --- //
        // ----------------------- //
        $wp_setting_name = 'page_title_additional_text';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Additional Text', 'technum'),
                'section'       => 'technum_page_title_additional',
                'type'          => 'text',
                'settings'      => $wp_setting_name
            )
        ));

        // --------------------------------- //
        // --- Additional Text Customize --- //
        // --------------------------------- //
        $wp_setting_name = 'page_title_additional_customize';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Customize', 'technum'),
                'section'   => 'technum_page_title_additional',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // ----------------------------- //
        // --- Additional Text Color --- //
        // ----------------------------- //
        $wp_setting_name = 'page_title_additional_text_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Additional text color', 'technum'),
                'section'       => 'technum_page_title_additional',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'page_title_additional_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));


        // -------------------------------- //
        // ---------- Typography ---------- //
        // -------------------------------- //
        $wp_customize->add_panel('technum_typography_settings',
            array(
                'title'     => esc_html__('Typography Settings', 'technum'),
                'priority'  => 140
            )
        );

        // ---#################--- //
        // ---### Main Font ###--- //
        // ---#################--- //
        $wp_customize->add_section('technum_typography_main_font',
            array(
                'title' => esc_html__('Main Font', 'technum'),
                'panel' => 'technum_typography_settings'
            )
        );

        // ----------------- //
        // --- Main Font --- //
        // ----------------- //
        $wp_setting_name = 'main_font';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Google_Font_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Main Font', 'technum'),
                'section'       => 'technum_typography_main_font',
                'settings'      => $wp_setting_name,
                'show_field'    => [
                    'font_family'       => true,
                    'font_backup'       => true,
                    'font_styles'       => true,
                    'font_subset'       => true,
                    'font_size'         => true,
                    'line_height'       => true,
                    'text_transform'    => true,
                    'letter_spacing'    => true,
                    'word_spacing'      => true,
                    'font_style'        => true,
                    'font_weight'       => true
                ]
            )
        ));

        // ---#######################--- //
        // ---### Additional Font ###--- //
        // ---#######################--- //
        $wp_customize->add_section('technum_typography_additional_font',
            array(
                'title' => esc_html__('Additional Font', 'technum'),
                'panel' => 'technum_typography_settings'
            )
        );

        // ----------------------- //
        // --- Additional Font --- //
        // ----------------------- //
        $wp_setting_name = 'additional_font';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Google_Font_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Additional Font', 'technum'),
                'section'       => 'technum_typography_additional_font',
                'settings'      => $wp_setting_name,
                'show_field'    => [
                    'font_family'       => true,
                    'font_backup'       => true,
                    'font_styles'       => true,
                    'font_subset'       => true,
                    'font_weight'       => true
                ]
            )
        ));

        // ---################--- //
        // ---### Headings ###--- //
        // ---################--- //
        $wp_customize->add_section('technum_typography_headings',
            array(
                'title' => esc_html__('Headings', 'technum'),
                'panel' => 'technum_typography_settings'
            )
        );

        // --------------------- //
        // --- Headings Font --- //
        // --------------------- //
        $wp_setting_name = 'headings_font';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Google_Font_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Headings Font', 'technum'),
                'section'       => 'technum_typography_headings',
                'settings'      => $wp_setting_name,
                'show_field'    => [
                    'font_family'       => true,
                    'font_backup'       => true,
                    'font_styles'       => true,
                    'font_subset'       => true,
                    'text_transform'    => true,
                    'font_style'        => true
                ]
            )
        ));

        // --------------- //
        // --- H1 Font --- //
        // --------------- //
        $wp_setting_name = 'h1_font';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Google_Font_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('H1 Font', 'technum'),
                'section'       => 'technum_typography_headings',
                'settings'      => $wp_setting_name,
                'show_field'    => [
                    'font_size'         => true,
                    'line_height'       => true,
                    'letter_spacing'    => true,
                    'word_spacing'      => true,
                    'font_weight'       => true
                ],
                'separator'             => 'before'
            )
        ));

        // --------------- //
        // --- H2 Font --- //
        // --------------- //
        $wp_setting_name = 'h2_font';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Google_Font_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('H2 Font', 'technum'),
                'section'       => 'technum_typography_headings',
                'settings'      => $wp_setting_name,
                'show_field'    => [
                    'font_size'         => true,
                    'line_height'       => true,
                    'letter_spacing'    => true,
                    'word_spacing'      => true,
                    'font_weight'       => true
                ],
                'separator'             => 'before'
            )
        ));

        // --------------- //
        // --- H3 Font --- //
        // --------------- //
        $wp_setting_name = 'h3_font';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Google_Font_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('H3 Font', 'technum'),
                'section'       => 'technum_typography_headings',
                'settings'      => $wp_setting_name,
                'show_field'    => [
                    'font_size'         => true,
                    'line_height'       => true,
                    'letter_spacing'    => true,
                    'word_spacing'      => true,
                    'font_weight'       => true
                ],
                'separator'             => 'before'
            )
        ));

        // --------------- //
        // --- H4 Font --- //
        // --------------- //
        $wp_setting_name = 'h4_font';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Google_Font_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('H4 Font', 'technum'),
                'section'       => 'technum_typography_headings',
                'settings'      => $wp_setting_name,
                'show_field'    => [
                    'font_size'         => true,
                    'line_height'       => true,
                    'letter_spacing'    => true,
                    'word_spacing'      => true,
                    'font_weight'       => true
                ],
                'separator'             => 'before'
            )
        ));

        // --------------- //
        // --- H5 Font --- //
        // --------------- //
        $wp_setting_name = 'h5_font';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Google_Font_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('H5 Font', 'technum'),
                'section'       => 'technum_typography_headings',
                'settings'      => $wp_setting_name,
                'show_field'    => [
                    'font_size'         => true,
                    'line_height'       => true,
                    'letter_spacing'    => true,
                    'word_spacing'      => true,
                    'font_weight'       => true
                ],
                'separator'             => 'before'
            )
        ));

        // --------------- //
        // --- H6 Font --- //
        // --------------- //
        $wp_setting_name = 'h6_font';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Google_Font_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('H6 Font', 'technum'),
                'section'       => 'technum_typography_headings',
                'settings'      => $wp_setting_name,
                'show_field'    => [
                    'font_size'         => true,
                    'line_height'       => true,
                    'letter_spacing'    => true,
                    'word_spacing'      => true,
                    'font_weight'       => true
                ],
                'separator'             => 'before'
            )
        ));

        // ---###############--- //
        // ---### Buttons ###--- //
        // ---###############--- //
        $wp_customize->add_section('technum_typography_buttons',
            array(
                'title' => esc_html__('Buttons', 'technum'),
                'panel' => 'technum_typography_settings'
            )
        );

        // --------------------------- //
        // --- Buttons Font Family --- //
        // --------------------------- //
        $wp_setting_name = 'buttons_font';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Google_Font_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Buttons Font', 'technum'),
                'section'       => 'technum_typography_buttons',
                'settings'      => $wp_setting_name,
                'show_field'    => [
                    'font_family'       => true,
                    'font_backup'       => true,
                    'font_styles'       => true,
                    'font_subset'       => true,
                    'font_size'         => true,
                    'text_transform'    => true,
                    'letter_spacing'    => true,
                    'word_spacing'      => true,
                    'font_style'        => true,
                    'font_weight'       => true
                ]
            )
        ));


        // ---------------------------------- //
        // ---------- Social Links ---------- //
        // ---------------------------------- //
        $wp_customize->add_section('technum_socials_settings',
            array(
                'title'     => esc_html__('Social Links', 'technum'),
                'priority'  => 145
            )
        );

        // ---------------------- //
        // --- Socials Target --- //
        // ---------------------- //
        $wp_setting_name = 'socials_target';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_checkbox'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Open Socials in New Tab', 'technum'),
                'section'       => 'technum_socials_settings',
                'type'          => 'checkbox',
                'settings'      => $wp_setting_name
            )
        ));

        // ---------------------- //
        // --- Social Buttons --- //
        // ---------------------- //
        $wp_setting_name = 'social_buttons';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'sanitize_callback' => 'technum_sanitize_repeater'
            )
        );
        $wp_customize->add_control( new Technum_Customize_Socials_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'                 => esc_html__('Social Buttons', 'technum'),
                'section'               => 'technum_socials_settings',
                'separator'             => 'before'
            )
        ));


        // ------------------------------------ //
        // ---------- Color Settings ---------- //
        // ------------------------------------ //
        $wp_customize->add_panel('technum_color_settings',
            array(
                'title'     => esc_html__('Color Settings', 'technum'),
                'priority'  => 150
            )
        );

        // ---################--- //
        // ---### STANDARD ###--- //
        // ---################--- //
        $wp_customize->add_section('technum_standard_colors',
            array(
                'title' => esc_html__('Standard Colors', 'technum'),
                'panel' => 'technum_color_settings'
            )
        );

        // ----------------------------------- //
        // --- Standard Default Text Color --- //
        // ----------------------------------- //
        $wp_setting_name = 'standard_default_text_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Default Text Color', 'technum'),
                'section'       => 'technum_standard_colors',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette()
            )
        ));

        // -------------------------------- //
        // --- Standard Dark Text Color --- //
        // -------------------------------- //
        $wp_setting_name = 'standard_dark_text_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Dark Text Color', 'technum'),
                'section'       => 'technum_standard_colors',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette()
            )
        ));

        // --------------------------------- //
        // --- Standard Light Text Color --- //
        // --------------------------------- //
        $wp_setting_name = 'standard_light_text_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Light Text Color', 'technum'),
                'section'       => 'technum_standard_colors',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette()
            )
        ));

        // ---------------------------------- //
        // --- Standard Accent Text Color --- //
        // ---------------------------------- //
        $wp_setting_name = 'standard_accent_text_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Accent Text Color', 'technum'),
                'section'       => 'technum_standard_colors',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette()
            )
        ));

        // ----------------------------- //
        // --- Standard Border Color --- //
        // ----------------------------- //
        $wp_setting_name = 'standard_border_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Border Color', 'technum'),
                'section'       => 'technum_standard_colors',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette(),
                'separator'     => 'before'
            )
        ));

        // ----------------------------------- //
        // --- Standard Border Hover Color --- //
        // ----------------------------------- //
        $wp_setting_name = 'standard_border_hover_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Border Hover Color', 'technum'),
                'section'       => 'technum_standard_colors',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette()
            )
        ));

        // --------------------------------- //
        // --- Standard Background Color --- //
        // --------------------------------- //
        $wp_setting_name = 'standard_background_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Background Color', 'technum'),
                'section'       => 'technum_standard_colors',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette(),
                'separator'     => 'before'
            )
        ));

        // --------------------------------------- //
        // --- Standard Background Alter Color --- //
        // --------------------------------------- //
        $wp_setting_name = 'standard_background_alter_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Alternative Background Color', 'technum'),
                'section'       => 'technum_standard_colors',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette()
            )
        ));

        // ---------------------------------- //
        // --- Standard Button Text Color --- //
        // ---------------------------------- //
        $wp_setting_name = 'standard_button_text_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Button Text Color', 'technum'),
                'section'       => 'technum_standard_colors',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette(),
                'separator'     => 'before'
            )
        ));

        // ------------------------------------ //
        // --- Standard Button Border Color --- //
        // ------------------------------------ //
        $wp_setting_name = 'standard_button_border_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Button Border Color', 'technum'),
                'section'       => 'technum_standard_colors',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette()
            )
        ));

        // ---------------------------------------- //
        // --- Standard Button Background Color --- //
        // ---------------------------------------- //
        $wp_setting_name = 'standard_button_background_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Button Background Color', 'technum'),
                'section'       => 'technum_standard_colors',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette()
            )
        ));

        // ---------------------------------- //
        // --- Standard Button Text Hover --- //
        // ---------------------------------- //
        $wp_setting_name = 'standard_button_text_hover';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Button Text Hover', 'technum'),
                'section'       => 'technum_standard_colors',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette()
            )
        ));

        // ------------------------------------ //
        // --- Standard Button Border Hover --- //
        // ------------------------------------ //
        $wp_setting_name = 'standard_button_border_hover';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Button Border Hover', 'technum'),
                'section'       => 'technum_standard_colors',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette()
            )
        ));

        // ---------------------------------------- //
        // --- Standard Button Background Hover --- //
        // ---------------------------------------- //
        $wp_setting_name = 'standard_button_background_hover';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Button Background Hover', 'technum'),
                'section'       => 'technum_standard_colors',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette()
            )
        ));

        // ---################--- //
        // ---### CONTRAST ###--- //
        // ---################--- //
        $wp_customize->add_section('technum_contrast_colors',
            array(
                'title' => esc_html__('Contrast Colors', 'technum'),
                'panel' => 'technum_color_settings'
            )
        );

        // ----------------------------------- //
        // --- Contrast Default Text Color --- //
        // ----------------------------------- //
        $wp_setting_name = 'contrast_default_text_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Default Text Color', 'technum'),
                'section'       => 'technum_contrast_colors',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette()
            )
        ));

        // -------------------------------- //
        // --- Contrast Dark Text Color --- //
        // -------------------------------- //
        $wp_setting_name = 'contrast_dark_text_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Dark Text Color', 'technum'),
                'section'       => 'technum_contrast_colors',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette()
            )
        ));

        // --------------------------------- //
        // --- Contrast Light Text Color --- //
        // --------------------------------- //
        $wp_setting_name = 'contrast_light_text_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Light Text Color', 'technum'),
                'section'       => 'technum_contrast_colors',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette()
            )
        ));

        // ---------------------------------- //
        // --- Contrast Accent Text Color --- //
        // ---------------------------------- //
        $wp_setting_name = 'contrast_accent_text_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Accent Text Color', 'technum'),
                'section'       => 'technum_contrast_colors',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette()
            )
        ));

        // ----------------------------- //
        // --- Contrast Border Color --- //
        // ----------------------------- //
        $wp_setting_name = 'contrast_border_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Border Color', 'technum'),
                'section'       => 'technum_contrast_colors',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette(),
                'separator'     => 'before'
            )
        ));

        // ----------------------------------- //
        // --- Contrast Border Hover Color --- //
        // ----------------------------------- //
        $wp_setting_name = 'contrast_border_hover_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Border Hover Color', 'technum'),
                'section'       => 'technum_contrast_colors',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette()
            )
        ));

        // --------------------------------- //
        // --- Contrast Background Color --- //
        // --------------------------------- //
        $wp_setting_name = 'contrast_background_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Background Color', 'technum'),
                'section'       => 'technum_contrast_colors',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette(),
                'separator'     => 'before'
            )
        ));

        // --------------------------------------- //
        // --- Contrast Background Alter Color --- //
        // --------------------------------------- //
        $wp_setting_name = 'contrast_background_alter_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Alternative Background Color', 'technum'),
                'section'       => 'technum_contrast_colors',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette()
            )
        ));

        // ---------------------------------- //
        // --- Contrast Button Text Color --- //
        // ---------------------------------- //
        $wp_setting_name = 'contrast_button_text_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Button Text Color', 'technum'),
                'section'       => 'technum_contrast_colors',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette(),
                'separator'     => 'before'
            )
        ));

        // ------------------------------------ //
        // --- Contrast Button Border Color --- //
        // ------------------------------------ //
        $wp_setting_name = 'contrast_button_border_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Button Border Color', 'technum'),
                'section'       => 'technum_contrast_colors',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette()
            )
        ));

        // ---------------------------------------- //
        // --- Contrast Button Background Color --- //
        // ---------------------------------------- //
        $wp_setting_name = 'contrast_button_background_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Button Background Color', 'technum'),
                'section'       => 'technum_contrast_colors',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette()
            )
        ));

        // ---------------------------------- //
        // --- Contrast Button Text Hover --- //
        // ---------------------------------- //
        $wp_setting_name = 'contrast_button_text_hover';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Button Text Hover', 'technum'),
                'section'       => 'technum_contrast_colors',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette()
            )
        ));

        // ------------------------------------ //
        // --- Contrast Button Border Hover --- //
        // ------------------------------------ //
        $wp_setting_name = 'contrast_button_border_hover';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Button Border Hover', 'technum'),
                'section'       => 'technum_contrast_colors',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette()
            )
        ));

        // ---------------------------------------- //
        // --- Contrast Button Background Hover --- //
        // ---------------------------------------- //
        $wp_setting_name = 'contrast_button_background_hover';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Button Background Hover', 'technum'),
                'section'       => 'technum_contrast_colors',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette()
            )
        ));


        // ------------------------------------------- //
        // ---------- Footer Settings Panel ---------- //
        // ------------------------------------------- //
        $wp_customize->add_panel('technum_footer_settings',
            array(
                'title'     => esc_html__('Footer Settings', 'technum'),
                'priority'  => 160
            )
        );

        // ---###############--- //
        // ---### General ###--- //
        // ---###############--- //
        $wp_customize->add_section('technum_footer_general',
            array(
                'title' => esc_html__('General', 'technum'),
                'panel' => 'technum_footer_settings'
            )
        );

        // --------------------- //
        // --- Footer Status --- //
        // --------------------- //
        $wp_setting_name = 'footer_status';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Show Footer', 'technum'),
                'section'   => 'technum_footer_general',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // -------------------- //
        // --- Footer Style --- //
        // -------------------- //
        $wp_setting_name = 'footer_style';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Footer Style', 'technum'),
                'section'       => 'technum_footer_general',
                'type'          => 'select',
                'settings'      => $wp_setting_name,
                'choices'       => array(
                    'type-1'        => esc_html__('Style 1', 'technum'),
                    'type-2'        => esc_html__('Style 2', 'technum')
                ),
                'dependency'    => [
                    [
                        'control'   => 'footer_status',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ------------------------ //
        // --- Footer Customize --- //
        // ------------------------ //
        $wp_setting_name = 'footer_customize';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Customize', 'technum'),
                'section'   => 'technum_footer_general',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // --------------------------------- //
        // --- Footer Default Text Color --- //
        // --------------------------------- //
        $wp_setting_name = 'footer_default_text_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Default Text Color', 'technum'),
                'section'       => 'technum_footer_general',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette(),
                'dependency'    => [
                    [
                        'control'   => 'footer_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ],
                'separator'     => 'before'
            )
        ));

        // ------------------------------ //
        // --- Footer Dark Text Color --- //
        // ------------------------------ //
        $wp_setting_name = 'footer_dark_text_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Dark Text Color', 'technum'),
                'section'       => 'technum_footer_general',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette(),
                'dependency'    => [
                    [
                        'control'   => 'footer_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ------------------------------- //
        // --- Footer Light Text Color --- //
        // ------------------------------- //
        $wp_setting_name = 'footer_light_text_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Light Text Color', 'technum'),
                'section'       => 'technum_footer_general',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette(),
                'dependency'    => [
                    [
                        'control'   => 'footer_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // -------------------------------- //
        // --- Footer Accent Text Color --- //
        // -------------------------------- //
        $wp_setting_name = 'footer_accent_text_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Accent Text Color', 'technum'),
                'section'       => 'technum_footer_general',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette(),
                'dependency'    => [
                    [
                        'control'   => 'footer_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // -------------------------------- //
        // --- Footer Border Text Color --- //
        // -------------------------------- //
        $wp_setting_name = 'footer_border_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Border Color', 'technum'),
                'section'       => 'technum_footer_general',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette(),
                'dependency'    => [
                    [
                        'control'   => 'footer_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ],
                'separator'     => 'before'
            )
        ));

        // ---------------------------------------- //
        // --- Footer Hovered Border Text Color --- //
        // ---------------------------------------- //
        $wp_setting_name = 'footer_border_hover_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Hovered Border Color', 'technum'),
                'section'       => 'technum_footer_general',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette(),
                'dependency'    => [
                    [
                        'control'   => 'footer_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ------------------------------- //
        // --- Footer Background Color --- //
        // ------------------------------- //
        $wp_setting_name = 'footer_background_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Background Color', 'technum'),
                'section'       => 'technum_footer_general',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette(),
                'dependency'    => [
                    [
                        'control'   => 'footer_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ],
                'separator'     => 'before'
            )
        ));

        // ------------------------------------------- //
        // --- Footer Alternative Background Color --- //
        // ------------------------------------------- //
        $wp_setting_name = 'footer_background_alter_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Alternative Background Color', 'technum'),
                'section'       => 'technum_footer_general',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette(),
                'dependency'    => [
                    [
                        'control'   => 'footer_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ------------------------------------ //
        // --- Page Title Button Text Color --- //
        // ------------------------------------ //
        $wp_setting_name = 'page_title_button_text_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Button Text Color', 'technum'),
                'section'       => 'technum_footer_general',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette(),
                'dependency'    => [
                    [
                        'control'   => 'footer_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ],
                'separator'     => 'before'
            )
        ));

        // ---------------------------------- //
        // --- Footer Button Border Color --- //
        // ---------------------------------- //
        $wp_setting_name = 'footer_button_border_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Button Border Color', 'technum'),
                'section'       => 'technum_footer_general',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette(),
                'dependency'    => [
                    [
                        'control'   => 'footer_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // -------------------------------------- //
        // --- Footer Button Background Color --- //
        // -------------------------------------- //
        $wp_setting_name = 'footer_button_background_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Button Background Color', 'technum'),
                'section'       => 'technum_footer_general',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette(),
                'dependency'    => [
                    [
                        'control'   => 'footer_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // -------------------------------- //
        // --- Footer Button Text Hover --- //
        // -------------------------------- //
        $wp_setting_name = 'footer_button_text_hover';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Button Text Hover', 'technum'),
                'section'       => 'technum_footer_general',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette(),
                'dependency'    => [
                    [
                        'control'   => 'footer_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ---------------------------------- //
        // --- Footer Button Border Hover --- //
        // ---------------------------------- //
        $wp_setting_name = 'footer_button_border_hover';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Button Border Hover', 'technum'),
                'section'       => 'technum_footer_general',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette(),
                'dependency'    => [
                    [
                        'control'   => 'footer_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // -------------------------------------- //
        // --- Footer Button Background Hover --- //
        // -------------------------------------- //
        $wp_setting_name = 'footer_button_background_hover';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_color'
            )
        );
        $wp_customize->add_control(new Technum_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Button Background Hover', 'technum'),
                'section'       => 'technum_footer_general',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette(),
                'dependency'    => [
                    [
                        'control'   => 'footer_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ------------------------------- //
        // --- Footer Background Image --- //
        // ------------------------------- //
        $wp_setting_name = 'footer_background_image';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'esc_url_raw'
            )
        );
        $wp_customize->add_control(new Technum_Image_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Bottom Image', 'technum'),
                'section'       => 'technum_footer_general',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'footer_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ],
                'separator'     => 'before'
            )
        ));

        // ---------------------------------- //
        // --- Footer Background Position --- //
        // ---------------------------------- //
        $wp_setting_name = 'footer_background_position';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Background Position', 'technum'),
                'section'       => 'technum_footer_general',
                'type'          => 'select',
                'settings'      => $wp_setting_name,
                'choices'       => technum_get_background_position_options(),
                'dependency'    => [
                    [
                        'control'   => 'footer_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // -------------------------------- //
        // --- Footer Background Repeat --- //
        // -------------------------------- //
        $wp_setting_name = 'footer_background_repeat';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Background Repeat', 'technum'),
                'section'       => 'technum_footer_general',
                'type'          => 'select',
                'settings'      => $wp_setting_name,
                'choices'       => technum_get_background_repeat_options(),
                'dependency'    => [
                    [
                        'control'   => 'footer_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ------------------------------ //
        // --- Footer Background Size --- //
        // ------------------------------ //
        $wp_setting_name = 'footer_background_size';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Background Size', 'technum'),
                'section'       => 'technum_footer_general',
                'type'          => 'select',
                'settings'      => $wp_setting_name,
                'choices'       => technum_get_background_size_options(),
                'dependency'    => [
                    [
                        'control'   => 'footer_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));


        // ---######################--- //
        // ---### Footer Widgets ###--- //
        // ---######################--- //
        $wp_customize->add_section('technum_footer_sidebar',
            array(
                'title' => esc_html__('Footer Sidebar', 'technum'),
                'panel' => 'technum_footer_settings'
            )
        );

        // ----------------------------- //
        // --- Footer Widgets Status --- //
        // ----------------------------- //
        $wp_setting_name = 'footer_sidebar_status';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Show Footer Widgets', 'technum'),
                'section'   => 'technum_footer_sidebar',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // ----------------------------- //
        // --- Footer Sidebar Select --- //
        // ----------------------------- //
        $wp_setting_name = 'footer_sidebar_select';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Select Sidebar', 'technum'),
                'section'       => 'technum_footer_sidebar',
                'type'          => 'select',
                'settings'      => $wp_setting_name,
                'choices'       => technum_get_all_sidebar_list(),
                'dependency'    => [
                    [
                        'control'   => 'footer_sidebar_status',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));


        // ---#################--- //
        // ---### Copyright ###--- //
        // ---#################--- //
        $wp_customize->add_section('technum_footer_copyright',
            array(
                'title' => esc_html__('Copyright', 'technum'),
                'panel' => 'technum_footer_settings'
            )
        );

        // ------------------------ //
        // --- Copyright Status --- //
        // ------------------------ //
        $wp_setting_name = 'footer_copyright_status';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Show Copyright', 'technum'),
                'section'   => 'technum_footer_copyright',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // ---------------------- //
        // --- Copyright Text --- //
        // ---------------------- //
        $wp_setting_name = 'footer_copyright_text';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Copyright Text', 'technum'),
                'section'       => 'technum_footer_copyright',
                'type'          => 'text',
                'settings'      => $wp_setting_name
            )
        ));

        // ---###################--- //
        // ---### Footer Menu ###--- //
        // ---###################--- //
        $wp_customize->add_section('technum_footer_menu',
            array(
                'title' => esc_html__('Footer Menu', 'technum'),
                'panel' => 'technum_footer_settings'
            )
        );

        // -------------------------- //
        // --- Footer Menu Status --- //
        // -------------------------- //
        $wp_setting_name = 'footer_menu_status';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Show Footer Menu', 'technum'),
                'section'   => 'technum_footer_menu',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // -------------------------- //
        // --- Footer Menu Select --- //
        // -------------------------- //
        $wp_setting_name = 'footer_menu_select';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Select Menu', 'technum'),
                'section'   => 'technum_footer_menu',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => technum_get_all_menu_list()
            )
        ));

        // ---##############################--- //
        // ---### Footer Additional Menu ###--- //
        // ---##############################--- //
        $wp_customize->add_section('technum_footer_additional_menu',
            array(
                'title' => esc_html__('Footer Additional Menu', 'technum'),
                'panel' => 'technum_footer_settings'
            )
        );

        // ------------------------------------- //
        // --- Footer Additional Menu Status --- //
        // ------------------------------------- //
        $wp_setting_name = 'footer_additional_menu_status';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Show Additional Footer Menu', 'technum'),
                'section'   => 'technum_footer_additional_menu',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // ------------------------------------- //
        // --- Footer Additional Menu Select --- //
        // ------------------------------------- //
        $wp_setting_name = 'footer_additional_menu_select';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Select Menu', 'technum'),
                'section'   => 'technum_footer_additional_menu',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => technum_get_all_menu_list()
            )
        ));

        // ------------------------------ //
        // ---------- Sidebars ---------- //
        // ------------------------------ //
        $wp_customize->add_section('technum_sidebar_settings',
            array(
                'title'     => esc_html__('Sidebars', 'technum'),
                'priority'  => 190
            )
        );

        // ----------------------------- //
        // --- Page Sidebar Position --- //
        // ----------------------------- //
        $wp_setting_name = 'sidebar_position';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Page Sidebar Position', 'technum'),
                'section'   => 'technum_sidebar_settings',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'left'      => esc_html__('Left', 'technum'),
                    'right'     => esc_html__('Right', 'technum'),
                    'none'      => esc_html__('None', 'technum')
                )
            )
        ));

        // -------------------------------- //
        // --- Archive Sidebar Position --- //
        // -------------------------------- //
        $wp_setting_name = 'archive_sidebar_position';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Archive Sidebar Position', 'technum'),
                'section'   => 'technum_sidebar_settings',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'left'      => esc_html__('Left', 'technum'),
                    'right'     => esc_html__('Right', 'technum'),
                    'none'      => esc_html__('None', 'technum')
                )
            )
        ));

        // ------------------------------------ //
        // --- Single Post Sidebar Position --- //
        // ------------------------------------ //
        $wp_setting_name = 'post_sidebar_position';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Single Post Sidebar Position', 'technum'),
                'section'   => 'technum_sidebar_settings',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'left'      => esc_html__('Left', 'technum'),
                    'right'     => esc_html__('Right', 'technum'),
                    'none'      => esc_html__('None', 'technum')
                )
            )
        ));

        // -------------------------------- //
        // --- Vacancy Sidebar Position --- //
        // -------------------------------- //
        $wp_setting_name = 'vacancy_sidebar_position';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Vacancy Sidebar Position', 'technum'),
                'section'   => 'technum_sidebar_settings',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'left'      => esc_html__('Left', 'technum'),
                    'right'     => esc_html__('Right', 'technum'),
                    'none'      => esc_html__('None', 'technum')
                )
            )
        ));

        // -------------------------------- //
        // --- Service Sidebar Position --- //
        // -------------------------------- //
        $wp_setting_name = 'service_sidebar_position';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Service Sidebar Position', 'technum'),
                'section'   => 'technum_sidebar_settings',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'left'      => esc_html__('Left', 'technum'),
                    'right'     => esc_html__('Right', 'technum'),
                    'none'      => esc_html__('None', 'technum')
                )
            )
        ));

        if ( class_exists('WooCommerce')) {
            // -------------------------------------------- //
            // --- WooCommerce Catalog Sidebar Position --- //
            // -------------------------------------------- //
            $wp_setting_name = 'catalog_sidebar_position';
            $wp_customize->add_setting(
                $wp_setting_name,
                array(
                    'default'           => $technum_customizer_default_values[$wp_setting_name],
                    'sanitize_callback'	=> 'technum_sanitize_choice'
                )
            );
            $wp_customize->add_control(new Technum_Customize_Control(
                $wp_customize,
                $wp_setting_name,
                array(
                    'label'     => esc_html__('Catalog Sidebar Position', 'technum'),
                    'section'   => 'technum_sidebar_settings',
                    'type'      => 'select',
                    'settings'  => $wp_setting_name,
                    'choices'   => array(
                        'left'      => esc_html__('Left', 'technum'),
                        'right'     => esc_html__('Right', 'technum'),
                        'none'      => esc_html__('None', 'technum')
                    )
                )
            ));
        }

        // --------------------------------- //
        // ---------- Single Post ---------- //
        // --------------------------------- //
        $wp_customize->add_section('technum_single_post_settings',
            array(
                'title'     => esc_html__('Single Post', 'technum'),
                'priority'  => 200
            )
        );

        // ------------------------------ //
        // --- Single Post Page Title --- //
        // ------------------------------ //
        $wp_setting_name = 'post_page_title';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => stripslashes($technum_customizer_default_values[$wp_setting_name]),
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Single Post Page Title', 'technum'),
                'section'       => 'technum_single_post_settings',
                'type'          => 'text',
                'settings'      => $wp_setting_name,
                'description'   => esc_html__('Use variable \'%s\' for display Post name', 'technum')
            )
        ));

        // ------------------------------- //
        // --- Post Media Image Status --- //
        // ------------------------------- //
        $wp_setting_name = 'post_media_image_status';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Show Media Image', 'technum'),
                'section'   => 'technum_single_post_settings',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // ---------------------------- //
        // --- Post Category Status --- //
        // ---------------------------- //
        $wp_setting_name = 'post_category_status';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Show Post Categories', 'technum'),
                'section'   => 'technum_single_post_settings',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // ------------------------ //
        // --- Post Date Status --- //
        // ------------------------ //
        $wp_setting_name = 'post_date_status';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Show Post Date', 'technum'),
                'section'   => 'technum_single_post_settings',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // -------------------------- //
        // --- Post Author Status --- //
        // -------------------------- //
        $wp_setting_name = 'post_author_status';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Show Post Author', 'technum'),
                'section'   => 'technum_single_post_settings',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // ------------------------- //
        // --- Post Title Status --- //
        // ------------------------- //
        $wp_setting_name = 'post_title_status';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Show Post Title', 'technum'),
                'section'   => 'technum_single_post_settings',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // ------------------------ //
        // --- Post Tags Status --- //
        // ------------------------ //
        $wp_setting_name = 'post_tags_status';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Show Post Tags', 'technum'),
                'section'   => 'technum_single_post_settings',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // --------------------------- //
        // --- Post Socials Status --- //
        // --------------------------- //
        $wp_setting_name = 'post_socials_status';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Show Post Social Buttons', 'technum'),
                'section'   => 'technum_single_post_settings',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // --------------------------- //
        // --- Recent Posts Status --- //
        // --------------------------- //
        $wp_setting_name = 'recent_posts_status';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Show Recent Posts', 'technum'),
                'section'   => 'technum_single_post_settings',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // ------------------------------ //
        // --- Recent Posts Customize --- //
        // ------------------------------ //
        $wp_setting_name = 'recent_posts_customize';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Customize', 'technum'),
                'section'   => 'technum_single_post_settings',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                ),
                'separator' => 'before'
            )
        ));

        // ---------------------------- //
        // --- Recent Posts Heading --- //
        // ---------------------------- //
        $wp_setting_name = 'recent_posts_section_heading';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Recent Posts Section Title', 'technum'),
                'section'       => 'technum_single_post_settings',
                'type'          => 'text',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'recent_posts_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ----------------------- //
        // --- Number of Posts --- //
        // ----------------------- //
        $wp_setting_name = 'recent_posts_number';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Number of Posts', 'technum'),
                'section'       => 'technum_single_post_settings',
                'type'          => 'select',
                'settings'      => $wp_setting_name,
                'choices'       => array(
                    '2'         => esc_html__('2 Items', 'technum'),
                    '3'         => esc_html__('3 Items', 'technum'),
                    '4'         => esc_html__('4 Items', 'technum')
                ),
                'dependency'    => [
                    [
                        'control'   => 'recent_posts_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ---------------- //
        // --- Order By --- //
        // ---------------- //
        $wp_setting_name = 'recent_posts_order_by';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Order By', 'technum'),
                'section'       => 'technum_single_post_settings',
                'type'          => 'select',
                'settings'      => $wp_setting_name,
                'choices'       => array(
                    'random'        => esc_html__('Random', 'technum'),
                    'date'          => esc_html__('Date', 'technum'),
                    'name'          => esc_html__('Name', 'technum')
                ),
                'dependency'    => [
                    [
                        'control'   => 'recent_posts_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ------------------ //
        // --- Sort Order --- //
        // ------------------ //
        $wp_setting_name = 'recent_posts_order';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Sort Order', 'technum'),
                'section'       => 'technum_single_post_settings',
                'type'          => 'select',
                'settings'      => $wp_setting_name,
                'choices'       => array(
                    'desc'  => esc_html__('Descending', 'technum'),
                    'asc'   => esc_html__('Ascending', 'technum')
                ),
                'dependency'    => [
                    [
                        'control'   => 'recent_posts_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ------------------------------ //
        // --- Show Recent Post Image --- //
        // ------------------------------ //
        $wp_setting_name = 'recent_posts_image';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Recent Posts Featured Image', 'technum'),
                'section'       => 'technum_single_post_settings',
                'type'          => 'select',
                'settings'      => $wp_setting_name,
                'choices'       => array(
                    'on'    => esc_html__('Show', 'technum'),
                    'off'   => esc_html__('Hide', 'technum')
                ),
                'dependency'    => [
                    [
                        'control'   => 'recent_posts_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // --------------------------------- //
        // --- Show Recent Post Category --- //
        // --------------------------------- //
        $wp_setting_name = 'recent_posts_category';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Recent Posts Categories', 'technum'),
                'section'       => 'technum_single_post_settings',
                'type'          => 'select',
                'settings'      => $wp_setting_name,
                'choices'       => array(
                    'on'    => esc_html__('Show', 'technum'),
                    'off'   => esc_html__('Hide', 'technum')
                ),
                'dependency'    => [
                    [
                        'control'   => 'recent_posts_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ----------------------------- //
        // --- Show Recent Post Date --- //
        // ----------------------------- //
        $wp_setting_name = 'recent_posts_date';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Recent Posts Date', 'technum'),
                'section'       => 'technum_single_post_settings',
                'type'          => 'select',
                'settings'      => $wp_setting_name,
                'choices'       => array(
                    'on'    => esc_html__('Show', 'technum'),
                    'off'   => esc_html__('Hide', 'technum')
                ),
                'dependency'    => [
                    [
                        'control'   => 'recent_posts_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ------------------------------- //
        // --- Show Recent Post Author --- //
        // ------------------------------- //
        $wp_setting_name = 'recent_posts_author';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Recent Posts Author', 'technum'),
                'section'       => 'technum_single_post_settings',
                'type'          => 'select',
                'settings'      => $wp_setting_name,
                'choices'       => array(
                    'on'    => esc_html__('Show', 'technum'),
                    'off'   => esc_html__('Hide', 'technum')
                ),
                'dependency'    => [
                    [
                        'control'   => 'recent_posts_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ------------------------------ //
        // --- Show Recent Post Title --- //
        // ------------------------------ //
        $wp_setting_name = 'recent_posts_title';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Recent Posts Title', 'technum'),
                'section'       => 'technum_single_post_settings',
                'type'          => 'select',
                'settings'      => $wp_setting_name,
                'choices'       => array(
                    'on'    => esc_html__('Show', 'technum'),
                    'off'   => esc_html__('Hide', 'technum')
                ),
                'dependency'    => [
                    [
                        'control'   => 'recent_posts_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // -------------------------------- //
        // --- Show Recent Post Excerpt --- //
        // -------------------------------- //
        $wp_setting_name = 'recent_posts_excerpt';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Recent Posts Excerpt', 'technum'),
                'section'       => 'technum_single_post_settings',
                'type'          => 'select',
                'settings'      => $wp_setting_name,
                'choices'       => array(
                    'on'    => esc_html__('Show', 'technum'),
                    'off'   => esc_html__('Hide', 'technum')
                ),
                'dependency'    => [
                    [
                        'control'   => 'recent_posts_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // --------------------------------------- //
        // --- Show Recent Post Excerpt Length --- //
        // --------------------------------------- //
        $wp_setting_name = 'recent_posts_excerpt_length';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'absint'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Recent Posts Excerpt Length', 'technum'),
                'section'       => 'technum_single_post_settings',
                'type'          => 'number',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'recent_posts_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ],
                'input_attrs' => [
                    'min'   => 0,
                    'step'  => 1
                ]
            )
        ));

        // ----------------------------- //
        // --- Show Recent Post Tags --- //
        // ----------------------------- //
        $wp_setting_name = 'recent_posts_tags';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Recent Posts Tags', 'technum'),
                'section'       => 'technum_single_post_settings',
                'type'          => 'select',
                'settings'      => $wp_setting_name,
                'choices'       => array(
                    'on'    => esc_html__('Show', 'technum'),
                    'off'   => esc_html__('Hide', 'technum')
                ),
                'dependency'    => [
                    [
                        'control'   => 'recent_posts_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ----------------------------------------- //
        // --- Show Recent Post Read More Button --- //
        // ----------------------------------------- //
        $wp_setting_name = 'recent_posts_more';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Recent Posts \'Read More\' Button', 'technum'),
                'section'       => 'technum_single_post_settings',
                'type'          => 'select',
                'settings'      => $wp_setting_name,
                'choices'       => array(
                    'on'    => esc_html__('Show', 'technum'),
                    'off'   => esc_html__('Hide', 'technum')
                ),
                'dependency'    => [
                    [
                        'control'   => 'recent_posts_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));


        // ------------------------------------- //
        // ---------- Portfolio Panel ---------- //
        // ------------------------------------- //
        $wp_customize->add_panel('technum_portfolio_settings',
            array(
                'title'     => esc_html__('Portfolio', 'technum'),
                'priority'  => 205
            )
        );

        // ---#########################--- //
        // ---### Portfolio Archive ###--- //
        // ---#########################--- //
        $wp_customize->add_section('technum_portfolio_archive',
            array(
                'title' => esc_html__('Archive Settings', 'technum'),
                'panel' => 'technum_portfolio_settings'
            )
        );

        // ------------------------------------ //
        // --- Portfolio Archive Page Title --- //
        // ------------------------------------ //
        $wp_setting_name = 'portfolio_archive_page_title';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => stripslashes($technum_customizer_default_values[$wp_setting_name]),
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Portfolio Archive Page Title', 'technum'),
                'section'       => 'technum_portfolio_archive',
                'type'          => 'text',
                'settings'      => $wp_setting_name,
                'description'   => esc_html__('Use variable \'%s\' for display Post type name', 'technum')
            )
        ));

        // ---------------------------------------- //
        // --- Portfolio Archive Columns Number --- //
        // ---------------------------------------- //
        $wp_setting_name = 'portfolio_archive_columns_number';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'absint'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Portfolio Archive Columns Number', 'technum'),
                'section'       => 'technum_portfolio_archive',
                'type'          => 'number',
                'settings'      => $wp_setting_name,
                'input_attrs' => [
                    'min'   => 1,
                    'max'   => 4,
                    'step'  => 1
                ]
            )
        ));

        // ---------------------------------------- //
        // --- Portfolio Archive Posts per Page --- //
        // ---------------------------------------- //
        $wp_setting_name = 'portfolio_archive_posts_per_page';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'absint'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Portfolio Posts Per Page', 'technum'),
                'section'       => 'technum_portfolio_archive',
                'type'          => 'number',
                'settings'      => $wp_setting_name,
                'input_attrs' => [
                    'min'   => 1,
                    'step'  => 1
                ]
            )
        ));

        // ---########################--- //
        // ---### Portfolio Single ###--- //
        // ---########################--- //
        $wp_customize->add_section('technum_portfolio_single',
            array(
                'title' => esc_html__('Single Page Settings', 'technum'),
                'panel' => 'technum_portfolio_settings'
            )
        );

        // ------------------------------------ //
        // --- Portfolio Single Page Title --- //
        // ------------------------------------ //
        $wp_setting_name = 'portfolio_single_page_title';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => stripslashes($technum_customizer_default_values[$wp_setting_name]),
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Portfolio Single Page Title', 'technum'),
                'section'       => 'technum_portfolio_single',
                'type'          => 'text',
                'settings'      => $wp_setting_name,
                'description'   => esc_html__('Use variable \'%s\' for display Post name', 'technum')
            )
        ));


        // ------------------------------------ //
        // ---------- Projects Panel ---------- //
        // ------------------------------------ //
        $wp_customize->add_panel('technum_projects_settings',
            array(
                'title'     => esc_html__('Projects', 'technum'),
                'priority'  => 206
            )
        );

        // ---########################--- //
        // ---### Projects Archive ###--- //
        // ---########################--- //
        $wp_customize->add_section('technum_project_archive',
            array(
                'title' => esc_html__('Archive Settings', 'technum'),
                'panel' => 'technum_projects_settings'
            )
        );

        // ---------------------------------- //
        // --- Project Archive Page Title --- //
        // ---------------------------------- //
        $wp_setting_name = 'project_archive_page_title';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => stripslashes($technum_customizer_default_values[$wp_setting_name]),
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Project Archive Page Title', 'technum'),
                'section'       => 'technum_project_archive',
                'type'          => 'text',
                'settings'      => $wp_setting_name,
                'description'   => esc_html__('Use variable \'%s\' for display Post type name', 'technum')
            )
        ));

        // -------------------------------------- //
        // --- Project Archive Columns Number --- //
        // -------------------------------------- //
        $wp_setting_name = 'project_archive_columns_number';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'absint'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Project Archive Columns Number', 'technum'),
                'section'       => 'technum_project_archive',
                'type'          => 'number',
                'settings'      => $wp_setting_name,
                'input_attrs' => [
                    'min'   => 1,
                    'max'   => 4,
                    'step'  => 1
                ]
            )
        ));

        // -------------------------------------- //
        // --- Project Archive Posts per Page --- //
        // -------------------------------------- //
        $wp_setting_name = 'project_archive_posts_per_page';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'absint'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Project Posts Per Page', 'technum'),
                'section'       => 'technum_project_archive',
                'type'          => 'number',
                'settings'      => $wp_setting_name,
                'input_attrs' => [
                    'min'   => 1,
                    'step'  => 1
                ]
            )
        ));

        // ---######################--- //
        // ---### Project Single ###--- //
        // ---######################--- //
        $wp_customize->add_section('technum_project_single',
            array(
                'title' => esc_html__('Single Page Settings', 'technum'),
                'panel' => 'technum_projects_settings'
            )
        );

        // --------------------------------- //
        // --- Project Single Page Title --- //
        // --------------------------------- //
        $wp_setting_name = 'project_single_page_title';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => stripslashes($technum_customizer_default_values[$wp_setting_name]),
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Project Single Page Title', 'technum'),
                'section'       => 'technum_project_single',
                'type'          => 'text',
                'settings'      => $wp_setting_name,
                'description'   => esc_html__('Use variable \'%s\' for display Post name', 'technum')
            )
        ));


        // ---------------------------------------- //
        // ---------- Case Studies Panel ---------- //
        // ---------------------------------------- //
        $wp_customize->add_panel('technum_case_studies_settings',
            array(
                'title'     => esc_html__('Case Studies', 'technum'),
                'priority'  => 207
            )
        );

        // ---############################--- //
        // ---### Case Studies Archive ###--- //
        // ---############################--- //
        $wp_customize->add_section('technum_case_studies_archive',
            array(
                'title' => esc_html__('Archive Settings', 'technum'),
                'panel' => 'technum_case_studies_settings'
            )
        );

        // --------------------------------------- //
        // --- Case Studies Archive Page Title --- //
        // --------------------------------------- //
        $wp_setting_name = 'case_studies_archive_page_title';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => stripslashes($technum_customizer_default_values[$wp_setting_name]),
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Case Studies Archive Page Title', 'technum'),
                'section'       => 'technum_case_studies_archive',
                'type'          => 'text',
                'settings'      => $wp_setting_name,
                'description'   => esc_html__('Use variable \'%s\' for display Post type name', 'technum')
            )
        ));

        // ------------------------------------------- //
        // --- Case Studies Archive Excerpt Length --- //
        // ------------------------------------------- //
        $wp_setting_name = 'case_studies_archive_excerpt_length';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'absint'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Case Studies Excerpt Length', 'technum'),
                'section'       => 'technum_case_studies_archive',
                'type'          => 'number',
                'settings'      => $wp_setting_name,
                'input_attrs' => [
                    'min'   => 0,
                    'step'  => 1
                ]
            )
        ));

        // ------------------------------------------- //
        // --- Case Studies Archive Columns Number --- //
        // ------------------------------------------- //
        $wp_setting_name = 'case_studies_archive_columns_number';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'absint'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Case Studies Columns Number', 'technum'),
                'section'       => 'technum_case_studies_archive',
                'type'          => 'number',
                'settings'      => $wp_setting_name,
                'input_attrs' => [
                    'min'   => 1,
                    'max'   => 4,
                    'step'  => 1
                ]
            )
        ));

        // ------------------------------------------- //
        // --- Case Studies Archive Posts per Page --- //
        // ------------------------------------------- //
        $wp_setting_name = 'case_studies_archive_posts_per_page';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'absint'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Case Studies Posts Per Page', 'technum'),
                'section'       => 'technum_case_studies_archive',
                'type'          => 'number',
                'settings'      => $wp_setting_name,
                'input_attrs' => [
                    'min'   => 1,
                    'step'  => 1
                ]
            )
        ));

        // ---###########################--- //
        // ---### Case Studies Single ###--- //
        // ---###########################--- //
        $wp_customize->add_section('technum_case_studies_single',
            array(
                'title' => esc_html__('Single Page Settings', 'technum'),
                'panel' => 'technum_case_studies_settings'
            )
        );

        // ------------------------------------ //
        // --- Portfolio Single Page Title --- //
        // ------------------------------------ //
        $wp_setting_name = 'case_studies_single_page_title';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => stripslashes($technum_customizer_default_values[$wp_setting_name]),
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Case Study Single Page Title', 'technum'),
                'section'       => 'technum_case_studies_single',
                'type'          => 'text',
                'settings'      => $wp_setting_name,
                'description'   => esc_html__('Use variable \'%s\' for display Post name', 'technum')
            )
        ));


        // ---------------------------------------- //
        // ---------- Team Members Panel ---------- //
        // ---------------------------------------- //
        $wp_customize->add_panel('technum_team_settings',
            array(
                'title'     => esc_html__('Team Members', 'technum'),
                'priority'  => 208
            )
        );

        // ---############################--- //
        // ---### Team Members Archive ###--- //
        // ---############################--- //
        $wp_customize->add_section('technum_team_archive',
            array(
                'title' => esc_html__('Archive Settings', 'technum'),
                'panel' => 'technum_team_settings'
            )
        );

        // --------------------------------------- //
        // --- Team Members Archive Page Title --- //
        // --------------------------------------- //
        $wp_setting_name = 'team_archive_page_title';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => stripslashes($technum_customizer_default_values[$wp_setting_name]),
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Team Members Archive Page Title', 'technum'),
                'section'       => 'technum_team_archive',
                'type'          => 'text',
                'settings'      => $wp_setting_name,
                'description'   => esc_html__('Use variable \'%s\' for display Post type name', 'technum')
            )
        ));

        // ------------------------------------------- //
        // --- Team Members Archive Columns Number --- //
        // ------------------------------------------- //
        $wp_setting_name = 'team_archive_columns_number';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'absint'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Team Members Archive Columns Number', 'technum'),
                'section'       => 'technum_team_archive',
                'type'          => 'number',
                'settings'      => $wp_setting_name,
                'input_attrs' => [
                    'min'   => 1,
                    'max'   => 4,
                    'step'  => 1
                ]
            )
        ));

        // ------------------------------------------- //
        // --- Team Members Archive Posts per Page --- //
        // ------------------------------------------- //
        $wp_setting_name = 'team_archive_posts_per_page';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'absint'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Team Members Posts Per Page', 'technum'),
                'section'       => 'technum_team_archive',
                'type'          => 'number',
                'settings'      => $wp_setting_name,
                'input_attrs' => [
                    'min'   => 1,
                    'step'  => 1
                ]
            )
        ));

        // ---##########################--- //
        // ---### Team Member Single ###--- //
        // ---##########################--- //
        $wp_customize->add_section('technum_team_single',
            array(
                'title' => esc_html__('Single Page Settings', 'technum'),
                'panel' => 'technum_team_settings'
            )
        );

        // ------------------------------------- //
        // --- Team Member Single Page Title --- //
        // ------------------------------------- //
        $wp_setting_name = 'team_single_page_title';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => stripslashes($technum_customizer_default_values[$wp_setting_name]),
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Team Member Single Page Title', 'technum'),
                'section'       => 'technum_team_single',
                'type'          => 'text',
                'settings'      => $wp_setting_name,
                'description'   => esc_html__('Use variable \'%s\' for display Post name', 'technum')
            )
        ));


        // ------------------------------------- //
        // ---------- Vacancies Panel ---------- //
        // ------------------------------------- //
        $wp_customize->add_panel('technum_vacancies_settings',
            array(
                'title'     => esc_html__('Vacancies', 'technum'),
                'priority'  => 209
            )
        );

        // ---#########################--- //
        // ---### Vacancies Archive ###--- //
        // ---#########################--- //
        $wp_customize->add_section('technum_vacancy_archive',
            array(
                'title' => esc_html__('Archive Settings', 'technum'),
                'panel' => 'technum_vacancies_settings'
            )
        );

        // ------------------------------------ //
        // --- Vacancies Archive Page Title --- //
        // ------------------------------------ //
        $wp_setting_name = 'vacancy_archive_page_title';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => stripslashes($technum_customizer_default_values[$wp_setting_name]),
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Vacancies Archive Page Title', 'technum'),
                'section'       => 'technum_vacancy_archive',
                'type'          => 'text',
                'settings'      => $wp_setting_name,
                'description'   => esc_html__('Use variable \'%s\' for display Post type name', 'technum')
            )
        ));

        // ---------------------------------------- //
        // --- Vacancies Archive Excerpt Length --- //
        // ---------------------------------------- //
        $wp_setting_name = 'vacancy_archive_excerpt_length';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'absint'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Vacancy Excerpt Length', 'technum'),
                'section'       => 'technum_vacancy_archive',
                'type'          => 'number',
                'settings'      => $wp_setting_name,
                'input_attrs' => [
                    'min'   => 0,
                    'step'  => 1
                ]
            )
        ));

        // ---------------------------------------- //
        // --- Vacancies Archive Posts per Page --- //
        // ---------------------------------------- //
        $wp_setting_name = 'vacancy_archive_posts_per_page';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'absint'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Vacancy Posts Per Page', 'technum'),
                'section'       => 'technum_vacancy_archive',
                'type'          => 'number',
                'settings'      => $wp_setting_name,
                'input_attrs' => [
                    'min'   => 1,
                    'step'  => 1
                ]
            )
        ));

        // ---######################--- //
        // ---### Vacancy Single ###--- //
        // ---######################--- //
        $wp_customize->add_section('technum_vacancy_single',
            array(
                'title' => esc_html__('Single Page Settings', 'technum'),
                'panel' => 'technum_vacancies_settings'
            )
        );

        // --------------------------------- //
        // --- Vacancy Single Page Title --- //
        // --------------------------------- //
        $wp_setting_name = 'vacancy_single_page_title';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => stripslashes($technum_customizer_default_values[$wp_setting_name]),
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Vacancy Single Page Title', 'technum'),
                'section'       => 'technum_vacancy_single',
                'type'          => 'text',
                'settings'      => $wp_setting_name,
                'description'   => esc_html__('Use variable \'%s\' for display Post name', 'technum')
            )
        ));

        // ------------------------------- //
        // --- Recent Vacancies Status --- //
        // ------------------------------- //
        $wp_setting_name = 'recent_vacancies_status';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Show Recent Vacancies', 'technum'),
                'section'   => 'technum_vacancy_single',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // ---------------------------------- //
        // --- Recent Vacancies Customize --- //
        // ---------------------------------- //
        $wp_setting_name = 'recent_vacancies_customize';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Customize', 'technum'),
                'section'   => 'technum_vacancy_single',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                ),
                'separator' => 'before'
            )
        ));

        // -------------------------------- //
        // --- Recent Vacancies Heading --- //
        // -------------------------------- //
        $wp_setting_name = 'recent_vacancies_section_heading';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Recent Vacancies Section Title', 'technum'),
                'section'       => 'technum_vacancy_single',
                'type'          => 'text',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'recent_vacancies_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ----------------------- //
        // --- Number of Posts --- //
        // ----------------------- //
        $wp_setting_name = 'recent_vacancies_number';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'absint'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Number of Posts', 'technum'),
                'section'       => 'technum_vacancy_single',
                'type'          => 'number',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'recent_vacancies_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ],
                'input_attrs'   => [
                    'min'   => 1,
                    'max'   => 20,
                    'step'  => 1
                ]
            )
        ));

        // ---------------- //
        // --- Order By --- //
        // ---------------- //
        $wp_setting_name = 'recent_vacancies_order_by';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Order By', 'technum'),
                'section'       => 'technum_vacancy_single',
                'type'          => 'select',
                'settings'      => $wp_setting_name,
                'choices'       => array(
                    'random'        => esc_html__('Random', 'technum'),
                    'date'          => esc_html__('Date', 'technum'),
                    'name'          => esc_html__('Name', 'technum')
                ),
                'dependency'    => [
                    [
                        'control'   => 'recent_vacancies_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ------------------ //
        // --- Sort Order --- //
        // ------------------ //
        $wp_setting_name = 'recent_vacancies_order';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Sort Order', 'technum'),
                'section'       => 'technum_vacancy_single',
                'type'          => 'select',
                'settings'      => $wp_setting_name,
                'choices'       => array(
                    'desc'  => esc_html__('Descending', 'technum'),
                    'asc'   => esc_html__('Ascending', 'technum')
                ),
                'dependency'    => [
                    [
                        'control'   => 'recent_vacancies_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));


        // ------------------------------------ //
        // ---------- Services Panel ---------- //
        // ------------------------------------ //
        $wp_customize->add_panel('technum_services_settings',
            array(
                'title'     => esc_html__('Services', 'technum'),
                'priority'  => 210
            )
        );

        // ---########################--- //
        // ---### Services Archive ###--- //
        // ---########################--- //
        $wp_customize->add_section('technum_service_archive',
            array(
                'title' => esc_html__('Archive Settings', 'technum'),
                'panel' => 'technum_services_settings'
            )
        );

        // ----------------------------------- //
        // --- Services Archive Page Title --- //
        // ----------------------------------- //
        $wp_setting_name = 'service_archive_page_title';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => stripslashes($technum_customizer_default_values[$wp_setting_name]),
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Services Archive Page Title', 'technum'),
                'section'       => 'technum_service_archive',
                'type'          => 'text',
                'settings'      => $wp_setting_name,
                'description'   => esc_html__('Use variable \'%s\' for display Post type name', 'technum')
            )
        ));

        // --------------------------------------- //
        // --- Services Archive Excerpt Length --- //
        // --------------------------------------- //
        $wp_setting_name = 'service_archive_excerpt_length';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'absint'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Services Excerpt Length', 'technum'),
                'section'       => 'technum_service_archive',
                'type'          => 'number',
                'settings'      => $wp_setting_name,
                'input_attrs' => [
                    'min'   => 0,
                    'step'  => 1
                ]
            )
        ));

        // -------------------------------------- //
        // --- Service Archive Columns Number --- //
        // -------------------------------------- //
        $wp_setting_name = 'service_archive_columns_number';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'absint'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Service Archive Columns Number', 'technum'),
                'section'       => 'technum_service_archive',
                'type'          => 'number',
                'settings'      => $wp_setting_name,
                'input_attrs' => [
                    'min'   => 1,
                    'max'   => 4,
                    'step'  => 1
                ]
            )
        ));

        // --------------------------------------- //
        // --- Services Archive Posts per Page --- //
        // --------------------------------------- //
        $wp_setting_name = 'service_archive_posts_per_page';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'absint'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Service Posts Per Page', 'technum'),
                'section'       => 'technum_service_archive',
                'type'          => 'number',
                'settings'      => $wp_setting_name,
                'input_attrs' => [
                    'min'   => 1,
                    'step'  => 1
                ]
            )
        ));

        // ---######################--- //
        // ---### Service Single ###--- //
        // ---######################--- //
        $wp_customize->add_section('technum_service_single',
            array(
                'title' => esc_html__('Single Page Settings', 'technum'),
                'panel' => 'technum_services_settings'
            )
        );

        // ---------------------------------- //
        // --- Services Single Page Title --- //
        // ---------------------------------- //
        $wp_setting_name = 'service_single_page_title';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => stripslashes($technum_customizer_default_values[$wp_setting_name]),
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Service Single Page Title', 'technum'),
                'section'       => 'technum_service_single',
                'type'          => 'text',
                'settings'      => $wp_setting_name,
                'description'   => esc_html__('Use variable \'%s\' for display Post name', 'technum')
            )
        ));


        // ------------------------------ //
        // ------- 404 Error Page ------- //
        // ------------------------------ //
        $wp_customize->add_section('technum_error_page_settings',
            array(
                'title'     => esc_html__('Error 404 Page', 'technum'),
                'priority'  => 210
            )
        );

        // ----------------------- //
        // --- 404 Error Title --- //
        // ----------------------- //
        $wp_setting_name = 'error_title';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'wp_kses_post'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('404 Error Title', 'technum'),
                'section'       => 'technum_error_page_settings',
                'type'          => 'textarea',
                'settings'      => $wp_setting_name
            )
        ));

        // ---------------------- //
        // --- 404 Error Text --- //
        // ---------------------- //
        $wp_setting_name = 'error_text';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'wp_kses_post'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('404 Error Info Text', 'technum'),
                'section'       => 'technum_error_page_settings',
                'type'          => 'textarea',
                'settings'      => $wp_setting_name
            )
        ));

        // --------------------------- //
        // --- 404 Page Main Image --- //
        // --------------------------- //
        $wp_setting_name = 'error_main_image';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'esc_url_raw'
            )
        );
        $wp_customize->add_control(new Technum_Image_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Main Image', 'technum'),
                'section'       => 'technum_error_page_settings',
                'settings'      => $wp_setting_name
            )
        ));

        // ----------------------------- //
        // --- 404 Error Logo Status --- //
        // ----------------------------- //
        $wp_setting_name = 'error_logo_status';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Show Header Logo', 'technum'),
                'section'       => 'technum_error_page_settings',
                'type'          => 'select',
                'settings'      => $wp_setting_name,
                'choices'       => array(
                    'on'    => esc_html__('Yes', 'technum'),
                    'off'   => esc_html__('No', 'technum')
                ),
                'description'   => esc_html__('Works only if the logo image is set in "Header Settings"', 'technum')
            )
        ));

        // ------------------------------------ //
        // --- 404 Error Home Button Status --- //
        // ------------------------------------ //
        $wp_setting_name = 'error_button_status';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Show Home Button', 'technum'),
                'section'   => 'technum_error_page_settings',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // ----------------------------- //
        // --- 404 Error Button Text --- //
        // ----------------------------- //
        $wp_setting_name = 'error_button_text';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Home Button Text', 'technum'),
                'section'       => 'technum_error_page_settings',
                'type'          => 'text',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'error_button_status',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // -------------------------------------- //
        // --- 404 Error Background Customize --- //
        // -------------------------------------- //
        $wp_setting_name = 'error_background_customize';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Customize Background', 'technum'),
                'section'   => 'technum_error_page_settings',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // --------------------------------- //
        // --- 404 Page Background Color --- //
        // --------------------------------- //
        $wp_setting_name = 'error_background_color';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_alpha_color'
            )
        );
        $wp_customize->add_control(new Technum_Alpha_Color_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Background Color', 'technum'),
                'section'       => 'technum_error_page_settings',
                'settings'      => $wp_setting_name,
                'show_opacity'  => true,
                'palette'       => technum_get_custom_color_palette(),
                'dependency'    => [
                    [
                        'control'   => 'error_background_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // --------------------------------- //
        // --- 404 Page Background Image --- //
        // --------------------------------- //
        $wp_setting_name = 'error_background_image';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'esc_url_raw'
            )
        );
        $wp_customize->add_control(new Technum_Image_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Background Image', 'technum'),
                'section'       => 'technum_error_page_settings',
                'settings'      => $wp_setting_name,
                'dependency'    => [
                    [
                        'control'   => 'error_background_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ------------------------------------ //
        // --- 404 Page Background Position --- //
        // ------------------------------------ //
        $wp_setting_name = 'error_background_position';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Background Position', 'technum'),
                'section'       => 'technum_error_page_settings',
                'type'          => 'select',
                'settings'      => $wp_setting_name,
                'choices'       => technum_get_background_position_options(),
                'dependency'    => [
                    [
                        'control'   => 'error_background_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // ---------------------------------- //
        // --- 404 Page Background Repeat --- //
        // ---------------------------------- //
        $wp_setting_name = 'error_background_repeat';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Background Repeat', 'technum'),
                'section'       => 'technum_error_page_settings',
                'type'          => 'select',
                'settings'      => $wp_setting_name,
                'choices'       => technum_get_background_repeat_options(),
                'dependency'    => [
                    [
                        'control'   => 'error_background_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        // -------------------------------- //
        // --- 404 Page Background Size --- //
        // -------------------------------- //
        $wp_setting_name = 'error_background_size';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Background Size', 'technum'),
                'section'       => 'technum_error_page_settings',
                'type'          => 'select',
                'settings'      => $wp_setting_name,
                'choices'       => technum_get_background_size_options(),
                'dependency'    => [
                    [
                        'control'   => 'error_background_customize',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

        if ( class_exists('WooCommerce') ) {

            // ------------------------------------------ //
            // ---------- WooCommerce Settings ---------- //
            // ------------------------------------------ //

            // ---######################--- //
            // ---### Single Product ###--- //
            // ---######################--- //
            $wp_customize->add_section('technum_woocommerce_single_product',
                array(
                    'title' => esc_html__('Single Product', 'technum'),
                    'panel' => 'woocommerce'
                )
            );

            // ----------------------------------------------- //
            // --- Single Product Related Products Section --- //
            // ----------------------------------------------- //
            $wp_setting_name = 'woo_single_product_show_related_section';
            $wp_customize->add_setting(
                $wp_setting_name,
                array(
                    'default'           => $technum_customizer_default_values[$wp_setting_name],
                    'sanitize_callback'	=> 'technum_sanitize_choice'
                )
            );
            $wp_customize->add_control(new Technum_Customize_Control(
                $wp_customize,
                $wp_setting_name,
                array(
                    'label'     => esc_html__('Show Related Products', 'technum'),
                    'section'   => 'technum_woocommerce_single_product',
                    'type'      => 'select',
                    'settings'  => $wp_setting_name,
                    'choices'   => array(
                        'on'        => esc_html__('Yes', 'technum'),
                        'off'       => esc_html__('No', 'technum')
                    )
                )
            ));

            // -------------------------------- //
            // --- Related Products Heading --- //
            // -------------------------------- //
            $wp_setting_name = 'woo_related_title';
            $wp_customize->add_setting(
                $wp_setting_name,
                array(
                    'default'           => $technum_customizer_default_values[$wp_setting_name],
                    'sanitize_callback'	=> 'sanitize_text_field'
                )
            );
            $wp_customize->add_control(new Technum_Customize_Control(
                $wp_customize,
                $wp_setting_name,
                array(
                    'label'         => esc_html__('Related Products Section Title', 'technum'),
                    'section'       => 'technum_woocommerce_single_product',
                    'type'          => 'text',
                    'settings'      => $wp_setting_name,
                    'dependency'    => [
                        [
                            'control'   => 'woo_single_product_show_related_section',
                            'operator'  => '==',
                            'value'     => 'on'
                        ]
                    ]
                )
            ));

            // --------------------------------- //
            // --- Single Product Page Title --- //
            // --------------------------------- //
            $wp_setting_name = 'woo_single_product_title';
            $wp_customize->add_setting(
                $wp_setting_name,
                array(
                    'default'           => stripslashes($technum_customizer_default_values[$wp_setting_name]),
                    'sanitize_callback'	=> 'sanitize_text_field'
                )
            );
            $wp_customize->add_control(new Technum_Customize_Control(
                $wp_customize,
                $wp_setting_name,
                array(
                    'label'         => esc_html__('Single Product Page Title', 'technum'),
                    'section'       => 'technum_woocommerce_single_product',
                    'type'          => 'text',
                    'settings'      => $wp_setting_name,
                    'description'   => esc_html__('Use variable \'%s\' for display Product title', 'technum')
                )
            ));

            // ------------------------- //
            // --- Show Product Name --- //
            // ------------------------- //
            $wp_setting_name = 'woo_single_product_show_name';
            $wp_customize->add_setting(
                $wp_setting_name,
                array(
                    'default'           => $technum_customizer_default_values[$wp_setting_name],
                    'sanitize_callback'	=> 'technum_sanitize_checkbox'
                )
            );
            $wp_customize->add_control(new Technum_Customize_Control(
                $wp_customize,
                $wp_setting_name,
                array(
                    'label'         => esc_html__('Show Product name above the Price', 'technum'),
                    'section'       => 'technum_woocommerce_single_product',
                    'type'          => 'checkbox',
                    'settings'      => $wp_setting_name
                )
            ));


            // --------------------------------- //
            // --- Up-sells Products Heading --- //
            // --------------------------------- //
            $wp_setting_name = 'woo_upsells_title';
            $wp_customize->add_setting(
                $wp_setting_name,
                array(
                    'default'           => stripslashes($technum_customizer_default_values[$wp_setting_name]),
                    'sanitize_callback'	=> 'sanitize_text_field'
                )
            );
            $wp_customize->add_control(new Technum_Customize_Control(
                $wp_customize,
                $wp_setting_name,
                array(
                    'label'         => esc_html__('Up-sells Section Title', 'technum'),
                    'section'       => 'technum_woocommerce_single_product',
                    'type'          => 'text',
                    'settings'      => $wp_setting_name
                )
            ));

            // ---##########################--- //
            // ---### Product Categories ###--- //
            // ---##########################--- //
            $wp_customize->add_section('technum_woocommerce_product_archive',
                array(
                    'title' => esc_html__('Product Archive', 'technum'),
                    'panel' => 'woocommerce'
                )
            );

            // -------------------------------- //
            // --- Product Categories Title --- //
            // -------------------------------- //
            $wp_setting_name = 'woo_product_categories_title';
            $wp_customize->add_setting(
                $wp_setting_name,
                array(
                    'default'           => stripslashes($technum_customizer_default_values[$wp_setting_name]),
                    'sanitize_callback'	=> 'sanitize_text_field'
                )
            );
            $wp_customize->add_control(new Technum_Customize_Control(
                $wp_customize,
                $wp_setting_name,
                array(
                    'label'         => esc_html__('Product Category Page Title', 'technum'),
                    'section'       => 'technum_woocommerce_product_archive',
                    'type'          => 'text',
                    'settings'      => $wp_setting_name,
                    'description'   => esc_html__('Use variable \'%s\' for display Product category name', 'technum')
                )
            ));

            // -------------------------- //
            // --- Product Tags Title --- //
            // -------------------------- //
            $wp_setting_name = 'woo_product_tags_title';
            $wp_customize->add_setting(
                $wp_setting_name,
                array(
                    'default'           => stripslashes($technum_customizer_default_values[$wp_setting_name]),
                    'sanitize_callback'	=> 'sanitize_text_field'
                )
            );
            $wp_customize->add_control(new Technum_Customize_Control(
                $wp_customize,
                $wp_setting_name,
                array(
                    'label'         => esc_html__('Product Tag Page Title', 'technum'),
                    'section'       => 'technum_woocommerce_product_archive',
                    'type'          => 'text',
                    'settings'      => $wp_setting_name,
                    'description'   => esc_html__('Use variable \'%s\' for display Product tag name', 'technum')
                )
            ));

        }

        // ----------------------------------------------- //
        // ---------- Additional Settings Panel ---------- //
        // ----------------------------------------------- //
        $wp_customize->add_panel('technum_additional_settings',
            array(
                'title'     => esc_html__('Additional Settings', 'technum'),
                'priority'  => 220
            )
        );

        // ---###################--- //
        // ---### Page Loader ###--- //
        // ---###################--- //
        $wp_customize->add_section('technum_page_loader',
            array(
                'title' => esc_html__('Page Loader', 'technum'),
                'panel' => 'technum_additional_settings'
            )
        );

        // -------------------------- //
        // --- Page Loader Status --- //
        // -------------------------- //
        $wp_setting_name = 'page_loader_status';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'technum_sanitize_choice'
            )
        );
        $wp_customize->add_control(new Technum_Customize_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'     => esc_html__('Show Page Loader', 'technum'),
                'section'   => 'technum_page_loader',
                'type'      => 'select',
                'settings'  => $wp_setting_name,
                'choices'   => array(
                    'on'        => esc_html__('Yes', 'technum'),
                    'off'       => esc_html__('No', 'technum')
                )
            )
        ));

        // ------------------------- //
        // --- Page Loader Image --- //
        // ------------------------- //
        $wp_setting_name = 'page_loader_image';
        $wp_customize->add_setting(
            $wp_setting_name,
            array(
                'default'           => $technum_customizer_default_values[$wp_setting_name],
                'sanitize_callback'	=> 'esc_url_raw'
            )
        );
        $wp_customize->add_control(new Technum_Image_Custom_Control(
            $wp_customize,
            $wp_setting_name,
            array(
                'label'         => esc_html__('Page Loader Image', 'technum'),
                'section'       => 'technum_page_loader',
                'settings'      => $wp_setting_name,
                'description'   => esc_html__('Maximum 100x100px', 'technum'),
                'dependency'    => [
                    [
                        'control'   => 'page_loader_status',
                        'operator'  => '==',
                        'value'     => 'on'
                    ]
                ]
            )
        ));

    }
}
