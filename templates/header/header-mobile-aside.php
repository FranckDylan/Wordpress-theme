<?php
    defined( 'ABSPATH' ) or die();
?>
    <div class="mobile-header-menu-container">
        <div class="mobile-header-row">

            <!-- Icons Block -->
            <div class="header-icons-container">
                <?php

                // Close Button
                echo '<div class="header-icon menu-close">';
                    echo '<span class="menu-close-icon"></span>';
                echo '</div>';

                ?>
            </div>

        </div>
        <!-- Menu Block -->
        <?php
            if ( technum_get_prefered_option('header_menu_status') == 'on' ) {
                if ( !empty(technum_get_prefered_option('header_menu_select')) && technum_get_prefered_option('header_menu_select') != 'default' ) {
                    wp_nav_menu(
                        array(
                            'menu'          => technum_get_prefered_option('header_menu_select'),
                            'menu_class'    => 'main-menu',
                            'depth'         => '0',
                            'container'     => '',
                            'fallback_cb'   => '',
                            'items_wrap'    => '<nav><ul id="%1$s" class="%2$s">%3$s</ul></nav>'
                        )
                    );
                } else {
                    $menu_locations = get_nav_menu_locations();
                    if ( isset($menu_locations['main']) && $menu_locations['main'] !== 0 ) {
                        wp_nav_menu(
                            array(
                                'theme_location'    => 'main',
                                'menu_class'        => 'main-menu',
                                'depth'             => '0',
                                'container'         => '',
                                'fallback_cb'       => '',
                                'items_wrap'        => '<nav><ul id="%1$s" class="%2$s">%3$s</ul></nav>'
                            )
                        );
                    }
                }
            }
        ?>

        <?php
        if (
            technum_get_prefered_option('top_bar_status') == 'on' &&
            (
                technum_get_prefered_option('top_bar_contacts_email_status') == 'on' ||
                technum_get_prefered_option('top_bar_contacts_phone_status') == 'on' ||
                technum_get_prefered_option('top_bar_contacts_address_status') == 'on'
            )
        ) {
            echo '<div class="header-mobile-contacts">';
                if ( !empty(technum_get_prefered_option('top_bar_contacts_address')) && technum_get_prefered_option('top_bar_contacts_address_status') == 'on' ) {
                    echo '<div class="contact-item contact-item-address">';
                        echo esc_html(technum_get_prefered_option('top_bar_contacts_address'));
                    echo '</div>';
                }
                if ( !empty(technum_get_prefered_option('top_bar_contacts_phone')) && technum_get_prefered_option('top_bar_contacts_phone_status') == 'on' ) {
                    echo '<div class="contact-item contact-item-phone">';
                        echo '<a href="tel:' . technum_clear_phone(technum_get_prefered_option('top_bar_contacts_phone')) . '">';
                            echo esc_html(technum_get_prefered_option('top_bar_contacts_phone'));
                        echo '</a>';
                    echo '</div>';
                }
                if ( !empty(technum_get_prefered_option('top_bar_contacts_email')) && technum_get_prefered_option('top_bar_contacts_email_status') == 'on' ) {
                    echo '<div class="contact-item contact-item-email">';
                        echo '<a href="mailto:' . esc_attr(technum_get_prefered_option('top_bar_contacts_email')) . '">';
                            echo esc_html(technum_get_prefered_option('top_bar_contacts_email'));
                        echo '</a>';
                    echo '</div>';
                }
            echo '</div>';
        }
        ?>

        <?php
        if (
            technum_get_prefered_option('top_bar_status') == 'on' &&
            technum_get_prefered_option('top_bar_additional_text_status') == 'on' &&
            (
                !empty(technum_get_prefered_option('top_bar_additional_text_status')) ||
                !empty(technum_get_prefered_option('top_bar_additional_text'))
            )
        ) {
            echo '<div class="header-mobile-additional-text">';
                if ( !empty(technum_get_prefered_option('top_bar_additional_text_title')) ) {
                    echo '<span class="additional-text-title">';
                        echo wp_kses(technum_get_prefered_option('top_bar_additional_text_title'), array(
                            'mark' => array(),
                            'span' => array(
                                'class' => true
                            )
                        ));
                    echo '</span>';
                }
                if ( !empty(technum_get_prefered_option('top_bar_additional_text')) ) {
                    echo wp_kses(technum_get_prefered_option('top_bar_additional_text'), array(
                        'mark' => array(),
                        'span' => array(
                            'class' => true
                        )
                    ));
                }
            echo '</div>';
        }
        ?>

        <?php
        if (
            technum_get_prefered_option('top_bar_status') == 'on' &&
            technum_get_prefered_option('top_bar_socials_status') == 'on'
        ) {
            echo '<div class="header-mobile-socials">';
                echo technum_socials_output('mobile-menu-socials wrapper-socials');
            echo '</div>';
        }
        ?>

        <?php
        if (
            technum_get_prefered_option('header_callback_status') == 'on' &&
            technum_get_prefered_option('header_style') == 'type-3' &&
            (
                !empty(technum_get_prefered_option('header_callback_text')) ||
                !empty(technum_get_prefered_option('header_callback_title'))
            )
        ) {
            echo '<div class="callback">';
                if ( !empty(technum_get_prefered_option('header_callback_title')) ) {
                    echo '<div class="callback-title">';
                        echo esc_html(technum_get_prefered_option('header_callback_title'));
                    echo '</div>';
                }
                if ( !empty(technum_get_prefered_option('header_callback_text')) ) {
                    echo '<div class="callback-text">';
                        echo esc_html(technum_get_prefered_option('header_callback_text'));
                    echo '</div>';
                }
            echo '</div>';
        }
        ?>

        <?php
        if (
            technum_get_prefered_option('header_button_status') == 'on' &&
            !empty(technum_get_prefered_option('header_button_text'))
        ) {
            echo '<div class="header-mobile-button">';
                echo '<a class="technum-button" href="' . ( !empty(technum_get_prefered_option('header_button_url')) ? esc_url(technum_get_prefered_option('header_button_url')) : esc_js('javascript:void(0);')) . '">';
                    echo esc_html(technum_get_prefered_option('header_button_text'));
                echo '</a>';
            echo '</div>';
        }
        ?>

    </div>