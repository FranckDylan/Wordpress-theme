<?php
defined( 'ABSPATH' ) or die();
?>
<!-- Top Bar -->
<div class="top-bar">
    <div class="top-bar-row">
        <?php

            if ( technum_get_prefered_option('top_bar_contacts_email_status') == 'on' || technum_get_prefered_option('top_bar_contacts_phone_status') == 'on' || technum_get_prefered_option('top_bar_contacts_address_status') == 'on' || technum_get_prefered_option('top_bar_socials_status') == 'on' ) {
                echo '<div class="top-bar-column">';

                    // Contacts
                    if ( technum_get_prefered_option('top_bar_contacts_email_status') == 'on' || technum_get_prefered_option('top_bar_contacts_phone_status') == 'on' || technum_get_prefered_option('top_bar_contacts_address_status') == 'on' ) {
                        $email = technum_get_prepared_option('top_bar_contacts_email', '', 'top_bar_contacts_email_status');
                        $phone = technum_get_prepared_option('top_bar_contacts_phone', '', 'top_bar_contacts_phone_status');
                        $address = technum_get_prepared_option('top_bar_contacts_address', '', 'top_bar_contacts_address_status');
                        echo '<div class="top-bar-contacts wrapper-contacts">';
                            if ( !empty($email) && technum_get_prefered_option('top_bar_contacts_email_status') == 'on' ) {
                                echo '<div class="contact-item contact-item-email">';
                                    echo '<a href="mailto:' . esc_attr($email) . '">';
                                        echo esc_html($email);
                                    echo '</a>';
                                echo '</div>';
                            }
                            if ( !empty($phone) && technum_get_prefered_option('top_bar_contacts_phone_status') == 'on' ) {
                                echo '<div class="contact-item contact-item-phone">';
                                    echo '<a href="tel:' . technum_clear_phone($phone) . '">';
                                        echo esc_html($phone);
                                    echo '</a>';
                                echo '</div>';
                            }
                            if ( !empty($address) && technum_get_prefered_option('top_bar_contacts_address_status') == 'on' ) {
                                echo '<div class="contact-item contact-item-address">';
                                    echo esc_html($address);
                                echo '</div>';
                            }
                        echo '</div>';
                    }

                echo '</div>';
            }

            $additional_text_title = technum_get_prepared_option('top_bar_additional_text_title', '', 'top_bar_additional_text_status');
            $additional_text = technum_get_prepared_option('top_bar_additional_text', '', 'top_bar_additional_text_status');
            if (
                (
                    technum_get_prefered_option('top_bar_additional_text_status') == 'on' &&
                    (
                        !empty($additional_text_title) ||
                        !empty($additional_text)
                    )
                ) ||
                technum_get_prefered_option('top_bar_socials_status') == 'on'
            ) {
                echo '<div class="top-bar-column">';
                    echo '<div class="top-bar-info wrapper-info">';
                    // Additional text
                    if (
                        technum_get_prefered_option('top_bar_additional_text_status') == 'on' &&
                        (
                            !empty($additional_text_title) ||
                            !empty($additional_text)
                        )
                    ) {
                        echo '<div class="top-bar-additional-text">';
                        if ( !empty($additional_text_title) ) {
                            echo '<span class="additional-text-title">';
                                echo wp_kses($additional_text_title, array(
                                    'mark' => array(),
                                    'span' => array(
                                        'class' => true
                                    )
                                ));
                            echo '</span> ';
                        }
                        if ( !empty($additional_text) ) {
                            echo wp_kses($additional_text, array(
                                'mark' => array(),
                                'span' => array(
                                    'class' => true
                                )
                            ));
                        }
                        echo '</div>';
                    }

                    // Social Icons
                    if ( technum_get_prefered_option('top_bar_socials_status') == 'on' ) {
                        echo technum_socials_output('top-bar-socials wrapper-socials');
                    }

                    echo '</div>';
                echo '</div>';
            }

        ?>
    </div>
</div>