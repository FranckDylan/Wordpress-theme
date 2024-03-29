<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<div class="outer-form-wrapper">
    <?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

    <div class="tab-columns" id="customer_login">

        <div class="tab-column">

    <?php endif; ?>

            <h4><?php esc_html_e( 'Sign In', 'technum' ); ?></h4>

            <form class="woocommerce-form woocommerce-form-login login" method="post">

                <?php do_action( 'woocommerce_login_form_start' ); ?>

                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" placeholder="<?php esc_attr_e('Name', 'technum'); ?>" />
                </p>
                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" placeholder="<?php esc_attr_e( 'Password', 'technum' ); ?>" />
                </p>

                <?php do_action( 'woocommerce_login_form' ); ?>

                <p class="form-row">
                    <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
                        <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'technum' ); ?></span>
                    </label>
                    <span class="woocommerce-LostPassword lost_password">
                        <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'I forgot my password', 'technum' ); ?></a>
                    </span>
                </p>

                <p class="woocommerce-form-row form-row">
                    <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                    <button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Sign In', 'technum' ); ?>"><?php esc_html_e( 'Sign In', 'technum' ); ?></button>
                </p>

                <?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>
                <div class="form-attention">
                    <?php echo wp_kses( __('<span class="tab-columns-switcher">Sign up</span> if you don\'t have an account', 'technum'), array(
                        'span' => array(
                            'class' => true
                        )
                    ) ); ?>
                </div>
                <?php endif; ?>

                <?php do_action( 'woocommerce_login_form_end' ); ?>

            </form>

    <?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

        </div>

        <div class="tab-column hidden">

            <h4><?php esc_html_e( 'Sign Up', 'technum' ); ?></h4>

            <form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

                <?php do_action( 'woocommerce_register_form_start' ); ?>

                <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" placeholder="<?php esc_attr_e( 'Username', 'technum' ); ?>" />
                    </p>

                <?php endif; ?>

                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" placeholder="<?php esc_attr_e( 'Email', 'technum' ); ?>" />
                </p>

                <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" placeholder="<?php esc_attr_e('Password', 'technum'); ?>" />
                    </p>
                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password2" id="reg_password2" value="<?php if ( ! empty( $_POST['password2'] ) ) echo esc_attr( $_POST['password2'] ); ?>" placeholder="<?php esc_attr_e('Confirm Password', 'technum'); ?>" />
                    </p>

                <?php else : ?>

                    <p><?php esc_html_e( 'A password will be sent to your email address.', 'technum' ); ?></p>

                <?php endif; ?>

                <?php do_action( 'woocommerce_register_form' ); ?>

                <p class="woocommerce-form-row form-row">
                    <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                    <button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Sign Up', 'technum' ); ?>"><?php esc_html_e( 'Sign Up', 'technum' ); ?></button>
                </p>

                <div class="form-attention">
                    <?php echo wp_kses( __('<span class="tab-columns-switcher">Sign in</span> if you already have an account', 'technum'), array(
                        'span' => array(
                            'class' => true
                        )
                    ) ); ?>
                </div>

                <?php do_action( 'woocommerce_register_form_end' ); ?>

            </form>

        </div>

    </div>
    <?php endif; ?>
</div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
