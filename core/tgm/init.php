<?php
/*
 * Created by Artureanec
*/

require_once get_template_directory() . '/core/tgm/class-tgm-plugin-activation.php';


add_action('tgmpa_register', 'technum_register_required_plugins');
if (!function_exists('technum_register_required_plugins')) {
    function technum_register_required_plugins() {

        /**
         * Array of plugin arrays. Required keys are name and slug.
         * If the source is NOT from the .org repo, then source is also required.
         */

        $plugins = array(
            array(
                'name'                  => esc_html__('TechnUm Plugin', 'technum'),
                'slug'                  => 'technum-plugin',
                'source'                => get_template_directory() . '/core/tgm/src/technum-plugin.zip',
                'required'              => true,
                'version'               => '1.0.3',
                'force_activation'      => false,
                'force_deactivation'    => false
            ),
            array(
                'name'                  => esc_html__('Elementor Page Builder', 'technum'),
                'slug'                  => 'elementor',
                'required'              => true,
                'force_activation'      => false,
                'force-deactivation'    => false
            ),
            array(
                'name'                  => esc_html__('Meta Box', 'technum'),
                'slug'                  => 'meta-box',
                'required'              => true,
                'force_activation'      => false,
                'force_deactivation'    => false
            ),
            array(
                'name'                  => esc_html__('WPForms Light', 'technum'),
                'slug'                  => 'wpforms-lite',
                'required'              => false,
                'force_activation'      => false,
                'force_deactivation'    => false
            ),
            array(
                'name'                  => esc_html__('One Click Demo Import', 'technum'),
                'slug'                  => 'one-click-demo-import',
                'required'              => false,
                'force_activation'      => false,
                'force_deactivation'    => false
            ),
            array(
                'name'                  => esc_html__('Envato Market', 'technum'),
                'slug'                  => 'envato-market',
                'source'                => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
                'required'              => false,
                'force_activation'      => false,
                'force_deactivation'    => false
            ),
            array(
                'name'                  => esc_html__('WooCommerce', 'technum'),
                'slug'                  => 'woocommerce',
                'required'              => false,
                'force_activation'      => false,
                'force_deactivation'    => false
            ),
            array(
                'name'                  => esc_html__('MailChimp for WordPress', 'technum'),
                'slug'                  => 'mailchimp-for-wp',
                'required'              => false,
                'force_activation'      => false,
                'force-deactivation'    => false
            ),
            array(
                'name'                  => esc_html__('Smash Balloon Instagram Feed', 'technum'),
                'slug'                  => 'instagram-feed',
                'required'              => false,
                'force_activation'      => false,
                'force-deactivation'    => false
            )
        );

        /**
         * Array of configuration settings. Amend each line as needed.
         * If you want the default strings to be available under your own theme domain,
         * leave the strings uncommented.
         * Some of the strings are added into a sprintf, so see the comments at the
         * end of each line for what each argument will be.
         */
        $config = array(
            'default_path'  => '',                                              // Default absolute path to pre-packaged plugins.
            'menu'          => 'tgmpa-install-plugins',                         // Menu slug.
            'has_notices'   => true,                                            // Show admin notices or not.
            'dismissable'   => true,                                            // If false, a user cannot dismiss the nag message.
            'is_automatic'  => true,                                            // Automatically activate plugins after installation or not.
            'message'       => '',                                              // Message to output right before the plugins table.
            'strings'       => array(
                'page_title'                        => esc_html__('Install Required Plugins', 'technum'),
                'menu_title'                        => esc_html__('Install Plugins', 'technum'),
                'installing'                        => esc_html__('Installing Plugin: %s', 'technum'), // %s = plugin name.
                'oops'                              => esc_html__('Something went wrong with the plugin API.', 'technum'),
                'notice_can_install_required'       => esc_html__('This theme requires the following plugins: %1$s.', 'technum'), // %1$s = plugin name(s).
                'notice_can_install_recommended'    => esc_html__('This theme recommends the following plugins: %1$s.', 'technum'), // %1$s = plugin name(s).
                'notice_cannot_install'             => esc_html__('Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'technum'), // %1$s = plugin name(s).
                'notice_can_activate_required'      => esc_html__('The following required plugins are currently inactive: %1$s.', 'technum'), // %1$s = plugin name(s).
                'notice_can_activate_recommended'   => esc_html__('The following recommended plugins are currently inactive: %1$s.', 'technum'), // %1$s = plugin name(s).
                'notice_cannot_activate'            => esc_html__('Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'technum'), // %1$s = plugin name(s).
                'notice_ask_to_update'              => esc_html__('The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'technum'), // %1$s = plugin name(s).
                'notice_cannot_update'              => esc_html__('Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'technum'), // %1$s = plugin name(s).
                'install_link'                      => esc_html__('Begin installing plugins', 'technum'),
                'activate_link'                     => esc_html__('Begin activating plugins', 'technum'),
                'return'                            => esc_html__('Return to Required Plugins Installer', 'technum'),
                'plugin_activated'                  => esc_html__('Plugin activated successfully.', 'technum'),
                'complete'                          => esc_html__('All plugins installed and activated successfully. %s', 'technum'), // %s = dashboard link.
                'nag_type'                          => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
            )
        );
        tgmpa($plugins, $config);
    }
}