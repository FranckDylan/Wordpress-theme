<?php

// --------------------------- //
// ------- WooCommerce ------- //
// --------------------------- //
if ( class_exists('WooCommerce') ) {

    # Header Colors
    $header_accent_text_color = technum_get_prepared_option('header_accent_text_color', 'standard_accent_text_color', 'header_customize');
    if ( !empty($header_accent_text_color) ) {
        $technum_custom_css .= '
            .header .mini-cart .mini-cart-count > span, 
            .mobile-header .mini-cart .mini-cart-count > span, 
            .mobile-header-menu-container .mini-cart .mini-cart-count > span {
                background-color: ' . esc_attr($header_accent_text_color) . ';
            }
        ';
    }

    $header_button_text_color = technum_get_prepared_option('header_button_text_color', 'standard_button_text_color', 'header_customize');
    if ( !empty($header_button_text_color) ) {
        $technum_custom_css .= '
            .header .woocommerce a.button, 
            .woocommerce .header a.button,
            .header .mini-cart .mini-cart-panel .woocommerce-mini-cart-buttons a.button:not(.checkout):hover {
                color: ' . esc_attr($header_button_text_color) . ';
            }
        ';
    }

    $header_background_color = technum_get_prepared_option('header_background_color', 'standard_background_color', 'header_customize');
    if ( !empty($header_background_color) ) {
        $technum_custom_css .= '
            .mini-cart .mini-cart-count > span {
                color: ' . esc_attr($header_background_color) . ';
            }
            .mini-cart .mini-cart-count > span {
                border-color: ' . esc_attr($header_background_color) . ';
            }
        ';
    }

    $header_button_border_color = technum_get_prepared_option('header_button_border_color', 'standard_button_border_color', 'header_customize');
    if ( !empty($header_button_border_color) ) {
        $technum_custom_css .= '';
    }

    $header_button_background_color = technum_get_prepared_option('header_button_background_color', 'standard_button_background_color', 'header_customize');
    if ( !empty($header_button_background_color) ) {
        $technum_custom_css .= '';
    }

    $header_button_text_hover = technum_get_prepared_option('header_button_text_hover', 'standard_button_text_hover', 'header_customize');
    if ( !empty($header_button_text_hover) ) {
        $technum_custom_css .= '
            .header .woocommerce a.button:hover, 
            .woocommerce .header a.button:hover,
            .header .mini-cart .mini-cart-panel .woocommerce-mini-cart-buttons a.button:not(.checkout) {
                color: ' . esc_attr($header_button_text_hover) . ';
            }
        ';
    }

    $header_button_border_hover = technum_get_prepared_option('header_button_border_hover', 'standard_button_border_hover', 'header_customize');
    if ( !empty($header_button_border_hover) ) {
        $technum_custom_css .= '';
    }

    $header_button_background_hover = technum_get_prepared_option('header_button_background_hover', 'standard_button_background_hover', 'header_customize');
    if ( !empty($header_button_background_hover) ) {
        $technum_custom_css .= '';
    }

    if ( !empty($header_button_background_hover) && !empty($header_button_background_color) ) {
        $technum_custom_css .= '
            .header .woocommerce a.button:after, 
            .woocommerce .header a.button:after {
                background: ' . esc_attr($header_button_background_color) . ';
                background: -moz-linear-gradient(left, ' . esc_attr($header_button_background_hover) . ' 0%, ' . esc_attr($header_button_background_hover) . ' 50%, ' . esc_attr($header_button_background_color) . ' 50%);
                background: -webkit-gradient(linear, left top, right top, color-stop(0%, ' . esc_attr($header_button_background_hover) . '), color-stop(50%, ' . esc_attr($header_button_background_hover) . '), color-stop(50%, ' . esc_attr($header_button_background_color) . '));
                background: -webkit-linear-gradient(left, ' . esc_attr($header_button_background_hover) . ' 0%, ' . esc_attr($header_button_background_hover) . ' 50%, ' . esc_attr($header_button_background_color) . ' 50%);
                background: -o-linear-gradient(left, ' . esc_attr($header_button_background_hover) . ' 0%, ' . esc_attr($header_button_background_color) . ' 50%, ' . esc_attr($header_button_background_color) . ' 50%);
                background: -ms-linear-gradient(left, ' . esc_attr($header_button_background_hover) . ' 0%, ' . esc_attr($header_button_background_hover) . ' 50%, ' . esc_attr($header_button_background_color) . ' 50%);
                background: linear-gradient(to right, ' . esc_attr($header_button_background_hover) . ' 0%, ' . esc_attr($header_button_background_hover) . ' 50%, ' . esc_attr($header_button_background_color) . ' 50%);
            }
        ';
    }

    if ( !empty($header_button_background_hover) && !empty($header_button_background_color) ) {
        $technum_custom_css .= '
            .header .mini-cart .mini-cart-panel .woocommerce-mini-cart-buttons a.button:not(.checkout):after {
                background: ' . esc_attr($header_button_background_hover) . ';
                background: -moz-linear-gradient(left, ' . esc_attr($header_button_background_color) . ' 0%, ' . esc_attr($header_button_background_color) . ' 50%, ' . esc_attr($header_button_background_hover) .
                ' 50%);
                background: -webkit-gradient(linear, left top, right top, color-stop(0%, ' . esc_attr($header_button_background_color) . '), color-stop(50%, ' . esc_attr($header_button_background_color) . '), color-stop(50%, ' . esc_attr($header_button_background_color) . '));
                background: -webkit-linear-gradient(left, ' . esc_attr($header_button_background_color) . ' 0%, ' . esc_attr($header_button_background_color) . ' 50%, ' . esc_attr($header_button_background_hover)
                . ' 50%);
                background: -o-linear-gradient(left, ' . esc_attr($header_button_background_color) . ' 0%, ' . esc_attr($header_button_background_hover) . ' 50%, ' . esc_attr($header_button_background_hover) . ' 50%);
                background: -ms-linear-gradient(left, ' . esc_attr($header_button_background_color) . ' 0%, ' . esc_attr($header_button_background_color) . ' 50%, ' . esc_attr($header_button_background_hover) .
                ' 50%);
                background: linear-gradient(to right, ' . esc_attr($header_button_background_color) . ' 0%, ' . esc_attr($header_button_background_color) . ' 50%, ' . esc_attr($header_button_background_hover) .
                ' 50%);
            }
        ';
    }


    # Footer Colors
    $footer_dark_text_color = technum_get_prepared_option('footer_dark_text_color', 'contrast_dark_text_color', 'footer_customize');
    if ( !empty($footer_dark_text_color) ) {
        $technum_custom_css .= '
            .footer .widget_product_search .woocommerce-product-search button,
            .footer .wp-block-woocommerce-product-search .wc-block-product-search__fields .wc-block-product-search__button,
            .footer .widget_product_categories .post-count,
            .footer .wc-block-product-categories-list .wc-block-product-categories-list-item .wc-block-product-categories-list-item-count,
            .footer ul.product_list_widget li .product-title {
                color: ' . esc_attr($footer_dark_text_color) . ';
            }
        ';
    }

    $footer_light_text_color = technum_get_prepared_option('footer_light_text_color', 'contrast_light_text_color', 'footer_customize');
    if ( !empty($footer_light_text_color) ) {
        $technum_custom_css .= '
            .footer .widget_product_categories li.cat-item-hierarchical,
            .footer .wc-block-product-categories-list .wc-block-product-categories-list-item,
            .footer .wc-block-product-categories-list .wc-block-product-categories-list-item .wc-block-product-categories-list-item-count,
            .footer .widget ul.product_list_widget li .price_wrapper del,
            .footer-widgets .widget div[class*="wp-block-"] .wc-block-review-list-item__item .wc-block-review-list-item__published-date {
                color: ' . esc_attr($footer_light_text_color) . ';
            }
        ';
    }

    $footer_accent_text_color = technum_get_prepared_option('footer_accent_text_color', 'contrast_accent_text_color', 'footer_customize');
    if ( !empty($footer_accent_text_color) ) {
        $technum_custom_css .= '
            .footer .widget ul.product_list_widget li .price_wrapper del {
                color: ' . esc_attr($footer_accent_text_color) . ';
            }
        ';
    }

    $footer_border_color = technum_get_prepared_option('footer_border_color', 'contrast_border_color', 'footer_customize');
    if ( !empty($footer_border_color) ) {
        $technum_custom_css .= '
            .footer .widget ul.product_list_widget li a imgl,
            .footer-widgets .widget div[class*="wp-block-"].has-content .wc-block-review-list-item__item:not(:first-child) {
                border-color: ' . esc_attr($footer_border_color) . ';
            }
        ';
    }

    $footer_border_hover_color = technum_get_prepared_option('footer_border_hover_color', 'contrast_border_hover_color', 'footer_customize');
    if ( !empty($footer_border_hover_color) ) {
        $technum_custom_css .= '
            .footer .widget ul.product_list_widget li a:hover img {
                border-color: ' . esc_attr($footer_border_hover_color) . ';
            }
        ';
    }

    $footer_background_color = technum_get_prepared_option('footer_background_color', 'contrast_background_color', 'footer_customize');
    if ( !empty($footer_background_color) ) {
        $technum_custom_css .= '';
    }

    $footer_button_text_color = technum_get_prepared_option('footer_button_text_color', 'contrast_button_text_color', 'footer_customize');
    if ( !empty($footer_button_text_color) ) {
        $technum_custom_css .= '
            .footer .woocommerce a.button,
            .woocommerce .footer a.button,
            .footer .woocommerce button.button,
            .woocommerce .footer button.button,
            .footer .woocommerce input.button,
            .woocommerce .footer input.button,
            .footer .woocommerce #respond input#submit,
            .woocommerce .footer #respond input#submit,
            .footer .woocommerce .added_to_cart,
            .woocommerce .footer .added_to_cart {
                color: ' . esc_attr($footer_button_text_color) . ';
            }
        ';
    }

    $footer_button_border_color = technum_get_prepared_option('footer_button_border_color', 'contrast_button_border_color', 'footer_customize');
    if ( !empty($footer_button_border_color) ) {
        $technum_custom_css .= '
            .footer .woocommerce a.button,
            .woocommerce .footer a.button,
            .footer .woocommerce button.button,
            .woocommerce .footer button.button,
            .footer .woocommerce input.button,
            .woocommerce .footer input.button,
            .footer .woocommerce #respond input#submit,
            .woocommerce .footer #respond input#submit,
            .footer .woocommerce .added_to_cart,
            .woocommerce .footer .added_to_cart {
                border-color: ' . esc_attr($footer_button_border_color) . ';
            }
        ';
    }

    $footer_button_background_color = technum_get_prepared_option('footer_button_background_color', 'contrast_button_background_color', 'footer_customize');
    if ( !empty($footer_button_background_color) ) {
        $technum_custom_css .= '
            .footer .woocommerce a.button:after,
            .woocommerce .footer a.button:after,
            .footer .woocommerce button.button:after,
            .woocommerce .footer button.button:after,
            .footer .woocommerce input.button:after,
            .woocommerce .footer input.button:after,
            .footer .woocommerce #respond input#submit:after,
            .woocommerce .footer #respond input#submit:after,
            .footer .woocommerce .added_to_cart:after,
            .woocommerce .footer .added_to_cart:after {
                background-color: ' . esc_attr($footer_button_background_color) . ';
            }
        ';
    }

    $footer_button_text_hover = technum_get_prepared_option('footer_button_text_hover', 'contrast_button_text_hover', 'footer_customize');
    if ( !empty($footer_button_text_hover) ) {
        $technum_custom_css .= '
            .footer .woocommerce a.button:hover,
            .woocommerce .footer a.button:hover,
            .footer .woocommerce button.button:hover,
            .woocommerce .footer button.button:hover,
            .footer .woocommerce input.button:hover,
            .woocommerce .footer input.button:hover,
            .footer .woocommerce #respond input#submit:hover,
            .woocommerce .footer #respond input#submit:hover,
            .footer .woocommerce .added_to_cart:hover,
            .woocommerce .footer .added_to_cart:hover {
                color: ' . esc_attr($footer_button_text_hover) . ';
            }
        ';
    }

    $footer_button_border_hover = technum_get_prepared_option('footer_button_border_hover', 'contrast_button_border_hover', 'footer_customize');
    if ( !empty($footer_button_border_hover) ) {
        $technum_custom_css .= '
            .footer .woocommerce a.button:hover,
            .woocommerce .footer a.button:hover,
            .footer .woocommerce button.button:hover,
            .woocommerce .footer button.button:hover,
            .footer .woocommerce input.button:hover,
            .woocommerce .footer input.button:hover,
            .footer .woocommerce #respond input#submit:hover,
            .woocommerce .footer #respond input#submit:hover,
            .footer .woocommerce .added_to_cart:hover,
            .woocommerce .footer .added_to_cart:hover {
                border-color: ' . esc_attr($footer_button_border_hover) . ';
            }
        ';
    }

    $footer_button_background_hover = technum_get_prepared_option('footer_button_background_hover', 'contrast_button_background_hover', 'footer_customize');
    if ( !empty($footer_button_background_hover) ) {
        $technum_custom_css .= '
            .footer .woocommerce a.button:hover:after,
            .woocommerce .footer a.button:hover:after,
            .footer .woocommerce button.button:hover:after,
            .woocommerce .footer button.button:hover:after,
            .footer .woocommerce input.button:hover:after,
            .woocommerce .footer input.button:hover:after,
            .footer .woocommerce #respond input#submit:hover:after,
            .woocommerce .footer #respond input#submit:hover:after,
            .footer .woocommerce .added_to_cart:hover:after,
            .woocommerce .footer .added_to_cart:hover:after {
                background-color: ' . esc_attr($footer_button_background_hover) . ';
            }
        ';
    }


    # Standard Colors
    $standard_default_text_color = technum_get_prefered_option('standard_default_text_color');
    if ( !empty($standard_default_text_color) ) {
        $technum_custom_css .= '
            .content-wrapper .widget_product_tag_cloud .tagcloud .tag-cloud-link,
            .content-wrapper .widget_layered_nav_filters ul .chosen a,
            .header .mini-cart .mini-cart-panel .cart_list li .content-woocommerce-wrapper .quantity,
            .woocommerce-pagination .page-numbers,
            .woocommerce-pagination .post-page-numbers {
                color: ' . esc_attr($standard_default_text_color) . ';
            }
        ';
    }

    $standard_light_text_color = technum_get_prefered_option('standard_light_text_color');
    if ( !empty($standard_light_text_color) ) {
        $technum_custom_css .= '
            .content-wrapper .widget ul.product_list_widget li .price_wrapper del,
            .woocommerce ul.products li.product .woocommerce-loop-product__wrapper .content-woocommerce-wrapper .price del, 
            .woocommerce-page ul.products li.product .woocommerce-loop-product__wrapper .content-woocommerce-wrapper .price del,
            .single-product.woocommerce div.product .price del,
            .commentlist li.review .comment_container .comment-date,
            .woocommerce div.product form.cart .group_table .price_wrapper del,
            .woocommerce form .show-password-input:after, 
            .woocommerce-page form .show-password-input:after,
            .wc-block-grid__product .wc-block-grid__product-price .price_wrapper del,
            .content-wrapper .widget_price_filter .price_slider_amount .price_label,
            .content-wrapper .product_list_widget li .reviewer,
            .content-wrapper .widget_layered_nav ul li,
            ul.products li.product .woocommerce-loop-product__wrapper .content-woocommerce-wrapper .woocommerce-loop-category-title mark,
            .widget div[class*="wp-block-"] .wc-block-review-list-item__item .wc-block-review-list-item__published-date {
                color: ' . esc_attr($standard_light_text_color) . ';
            }
            .widget_product_categories ul > li:before,
            .content-wrapper .wc-block-product-categories-list .wc-block-product-categories-list-item:before,
            .widget div[class*="wp-block-"] .wc-block-review-list-item__item:before {
                background-color: rgba(' . esc_attr(technum_hex2rgb($standard_light_text_color)) . ', 0.6);
            }
        ';
    }

    $standard_dark_text_color = technum_get_prefered_option('standard_dark_text_color');
    if ( !empty($standard_dark_text_color) ) {
        $technum_custom_css .= '
            .woocommerce-info,
            .woocommerce-error,
            .woocommerce-message,
            .content-wrapper .widget_product_search .woocommerce-product-search button,
            .content-wrapper .wp-block-woocommerce-product-search .wc-block-product-search__fields .wc-block-product-search__button,
            .content-wrapper .widget_product_categories .post-count, 
            .content-wrapper ul.product_list_widget li .product-title,
            .content-wrapper .widget_shopping_cart .total,
            .header .mini-cart .mini-cart-panel .total,
            .catalog-top-info-wrapper .woocommerce-result-count,
            .woocommerce-ordering select,
            .checkout_cart_table .product-name .product-name-title,
            .woocommerce-checkout-review-total .checkout_total_table td,
            .woocommerce .woocommerce-form-login .woocommerce-form-login__rememberme, 
            .woocommerce-page .woocommerce-form-login .woocommerce-form-login__rememberme,
            .woocommerce-account .form-attention,
            .woocommerce .woocommerce-cart-form table.shop_table th, 
            .woocommerce-page .woocommerce-cart-form table.shop_table th, 
            .woocommerce .woocommerce-cart-form table.shop_table .product-price .amount, 
            .woocommerce-page .woocommerce-cart-form table.shop_table .product-price .amount,
            .woocommerce .quantity-wrapper .quantity,
            .woocommerce .cart-collaterals .cart_totals table.shop_table td, 
            .woocommerce .cart-collaterals .cart_totals table.shop_table th, 
            .woocommerce-page .cart-collaterals .cart_totals table.shop_table td, 
            .woocommerce-page .cart-collaterals .cart_totals table.shop_table th,
            .woocommerce div.product .product_meta,
            .single-product.woocommerce div.product .product_meta .tagged_as a,
            .single-product.woocommerce div.product .product_meta .tagged_as a:hover,
            .woocommerce div.product .woocommerce-tabs ul.tabs li a,
            .woocommerce div.product .woocommerce-tabs ul.tabs li a:hover,
            .commentlist li.review .comment_container .woocommerce-review__author,
            .woocommerce #respond input#submit.alt.disabled, 
            .woocommerce #respond input#submit.alt.disabled:hover, 
            .woocommerce #respond input#submit.alt:disabled, 
            .woocommerce #respond input#submit.alt:disabled:hover, 
            .woocommerce #respond input#submit.alt:disabled[disabled], 
            .woocommerce #respond input#submit.alt:disabled[disabled]:hover, 
            .filter-control-wrapper .filter-control-list .filter-control-item,
            .woocommerce .comment-reply-title,
            .woocommerce .post-comments-title,
            .woocommerce form .show-password-input.display-password::after, 
            .woocommerce-page form .show-password-input.display-password::after,
            .woocommerce table.shop_table_responsive tr td::before, 
            .woocommerce-page table.shop_table_responsive tr td::before,
            .content-wrapper .widget_product_search .woocommerce-product-search button:before,
            .content-wrapper .wp-block-woocommerce-product-search .wc-block-product-search__fields .wc-block-product-search__button:before,
            .content-wrapper .widget_product_categories ul li > a,
            .content-wrapper .wc-block-product-categories-list .wc-block-product-categories-list-item > a,
            .content-wrapper .widget_layered_nav ul li a,
            .widget_shopping_cart .cart_list li a,
            .header .mini-cart .mini-cart-panel .cart_list li a,
            .woocommerce .catalog-top-info-wrapper .woocommerce-ordering:after,
            ul.products li.product .woocommerce-loop-product__wrapper .content-woocommerce-wrapper h3 a,
            .woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
            .single-product.woocommerce .content-wrapper .woocommerce-tabs table.shop_attributes tr td, 
            .single-product.woocommerce .content-wrapper .woocommerce-tabs table.shop_attributes tr th,
            .woocommerce .woocommerce-cart-form table.shop_table .product-name a, 
            .woocommerce-page .woocommerce-cart-form table.shop_table .product-name a,
            .woocommerce-checkout-review-order .checkout_cart_table .product-name .product-name-title a,
            .woocommerce-checkout-review-order .shop_table.woocommerce-checkout-review-order-table th,
            .woocommerce-checkout-review-order .shop_table.woocommerce-checkout-review-order-table .amount,
            .woocommerce-account .woocommerce-MyAccount-navigation ul li a,
            .woocommerce .woocommerce-order table.shop_table thead th, 
            .woocommerce .woocommerce-MyAccount-content table.shop_table thead th, 
            .woocommerce-page .woocommerce-order table.shop_table thead th, 
            .woocommerce-page .woocommerce-MyAccount-content table.shop_table thead th,
            .woocommerce .woocommerce-customer-details address,
            .woocommerce .woocommerce-table--order-details .product-name a,
            .woocommerce .woocommerce-table--order-details tfoot th,
            .wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-title,
            .widget div[class*="wp-block-"] .wc-block-review-list-item__item .wc-block-review-list-item__meta,
            .widget div[class*="wp-block-"] .wc-block-review-list-item__item .wc-block-review-list-item__meta a {
                color: ' . esc_attr($standard_dark_text_color) . ';
            }
            .woocommerce .checkout_cart_table .product-remove a.remove:hover {
                color: ' . esc_attr($standard_dark_text_color) . ' !important;
            }
            .woocommerce .quantity-wrapper.styled .btn-plus .icon:before, 
            .woocommerce .quantity-wrapper.styled .btn-plus .icon:after, 
            .woocommerce .quantity-wrapper.styled .btn-minus .icon:before,
            .woocommerce .quantity-wrapper.styled .btn-minus .icon:after,
            .filter-control-wrapper .filter-control-list .filter-control-item:after {
                background-color: ' . esc_attr($standard_dark_text_color) . ';
            }
            .widget_product_categories ul > li:before,
            .content-wrapper .wc-block-product-categories-list .wc-block-product-categories-list-item:before {
                border-color: ' . esc_attr($standard_dark_text_color) . ';
            }
        ';
    }

    $standard_accent_text_color = technum_get_prefered_option('standard_accent_text_color');
    if ( !empty($standard_accent_text_color) ) {
        $technum_custom_css .= '
            .content-wrapper .widget ul.product_list_widget li .price_wrapper,
            .woocommerce ul.products li.product .price,
            .product-filters-trigger-wrapper,
            .checkout_cart_table .product-total .amount,
            .woocommerce .outer-form-wrapper form.login a, 
            .woocommerce .outer-form-wrapper form.register a,
            .woocommerce-account .form-attention span,
            .woocommerce-account .form-attention a, 
            .woocommerce-page .woocommerce-cart-form table.shop_table .product-subtotal .amount,
            .woocommerce .woocommerce-cart-form table.shop_table .product-subtotal .amount,
            .single-product.woocommerce div.product .price,
            .woocommerce div.product form.cart .group_table .price_wrapper,
            .wc-block-grid__product .wc-block-grid__product-price .price_wrapper,
            .wc-block-grid__product .wc-block-grid__product-price .price,
            .single-product.woocommerce .content-wrapper .woocommerce-tabs .woocommerce-Tabs-panel--description > ul > li:before,
            body .content-wrapper .woocommerce-form-coupon-toggle .woocommerce-info:before,
            .content-wrapper .widget_product_search .woocommerce-product-search button:hover:before,
            .content-wrapper .wp-block-woocommerce-product-search .wc-block-product-search__fields .wc-block-product-search__button:hover:before,
            .widget_product_categories ul > li:hover,
            .widget_product_categories ul li:hover > a,
            .content-wrapper .wc-block-product-categories-list .wc-block-product-categories-list-item:hover,
            .content-wrapper .wc-block-product-categories-list .wc-block-product-categories-list-item:hover > a,
            .content-wrapper .wc-block-product-categories-list .wc-block-product-categories-list-item:hover .wc-block-product-categories-list-item-count,
            .content-wrapper ul.product_list_widget li a:hover .product-title,
            .content-wrapper .widget_layered_nav ul li:hover,
            .content-wrapper .widget_layered_nav ul li:hover a,
            .widget_shopping_cart .cart_list li a:hover,
            .header .mini-cart .mini-cart-panel .cart_list li a:hover,
            ul.products li.product .woocommerce-loop-product__wrapper .content-woocommerce-wrapper h3 a:hover,
            .woocommerce-pagination .page-numbers.current,
            .woocommerce-pagination .page-numbers:hover,
            .woocommerce-pagination .post-page-numbers.current,
            .woocommerce-pagination .post-page-numbers:hover,
            .woocommerce .woocommerce-cart-form table.shop_table .product-name a:hover, 
            .woocommerce-page .woocommerce-cart-form table.shop_table .product-name a:hover,
            .woocommerce-checkout-review-order .checkout_cart_table .product-name .product-name-title a:hover,
            .woocommerce-checkout-review-order .checkout_cart_table .product-total,
            .woocommerce-account .woocommerce-MyAccount-navigation ul li:not(.is-active) a:hover,
            .woocommerce .woocommerce-table--order-details .product-name a:hover,
            .woocommerce .woocommerce-table--order-details .amount,
            .wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-title:hover,
            .sidebar .wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-link:hover .wc-block-grid__product-title,
            .footer-widgets .wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-link:hover .wc-block-grid__product-title,
            .slide-sidebar-content .wc-block-grid__products .wc-block-grid__product .wc-block-grid__product-link:hover .wc-block-grid__product-title,
            .widget div[class*="wp-block-"] .wc-block-review-list-item__item .wc-block-review-list-item__meta a:hover {
                color: ' . esc_attr($standard_accent_text_color) . ';
            }
            .woocommerce .checkout_cart_table .product-remove a.remove:hover,
            .woocommerce .woocommerce-cart-form table.shop_table .product-remove .remove:hover, 
            .woocommerce-page .woocommerce-cart-form table.shop_table .product-remove .remove:hover {
                color: ' . esc_attr($standard_accent_text_color) . ' !important;
            }
            .single-product.woocommerce div.product .product_meta .tagged_as a:hover,
            body .content-wrapper .woocommerce-form-coupon-toggle .woocommerce-info,
            .content-wrapper .widget_price_filter .price_slider_wrapper .ui-slider .ui-slider-handle {
                border-color: ' . esc_attr($standard_accent_text_color) . ';
            }
            .woocommerce-checkout .content h3:before,
            .woocommerce-account .woocommerce-MyAccount-content h3:before,
            .woocommerce .outer-form-wrapper h5:before,
            .single-product.woocommerce div.product .product_meta .tagged_as a:hover,
             
            .widget_product_categories ul > li:hover:before,
            .content-wrapper .wc-block-product-categories-list .wc-block-product-categories-list-item:hover:before,
            .content-wrapper .widget_price_filter .price_slider_wrapper .ui-slider .ui-slider-handle:before,
            .widget div[class*="wp-block-"] .wc-block-review-list-item__item:hover:before {
                background-color: ' . esc_attr($standard_accent_text_color) . ';
            }
        ';
    }

    $standard_border_color = technum_get_prefered_option('standard_border_color');
    if ( !empty($standard_border_color) ) {
        $technum_custom_css .= '
            .mobile-header .mini-cart .mini-cart-panel .cart_list li,
            .mobile-header .mini-cart .mini-cart-panel .cart_list li .thumbnail-woocommerce_wrapper img,
            .mobile-header-menu-container .mini-cart .mini-cart-panel .cart_list li,
            .mobile-header-menu-container .mini-cart .mini-cart-panel .cart_list li .thumbnail-woocommerce_wrapper img,
            .content-wrapper .widget ul.product_list_widget li a img,
            .content-wrapper .widget_shopping_cart .total,
            .header .mini-cart .mini-cart-panel .total,
            .checkout_cart_table .product-thumbnail a img,
            .woocommerce form.checkout_coupon, 
            .woocommerce form.login, 
            .woocommerce form.register,
            .woocommerce .woocommerce-cart-form table.shop_table td, 
            .woocommerce-page .woocommerce-cart-form table.shop_table td,
            .woocommerce .woocommerce-cart-form table.shop_table img, 
            .woocommerce-page .woocommerce-cart-form table.shop_table img,
            .woocommerce .woocommerce-cart-form table.shop_table td.actions .coupon .input-text, 
            .woocommerce-page .woocommerce-cart-form table.shop_table td.actions .coupon .input-text, 
            .single-product.woocommerce div.product .woocommerce-product-gallery .flex-viewport, 
            .single-product.woocommerce div.product .woocommerce-product-gallery .flex-control-nav.flex-control-thumbs li img,
            .woocommerce .woocommerce-cart-form table.shop_table tr:first-child td, 
            .woocommerce-page .woocommerce-cart-form table.shop_table tr:first-child td,
            .widget_shopping_cart .cart_list li:not(:first-child),
            .header .mini-cart .mini-cart-panel .cart_list li:not(:first-child),
            .woocommerce-pagination .page-numbers,
            .woocommerce-pagination .post-page-numbers,
            .woocommerce #reviews #comments ol.commentlist li.review,
            .woocommerce .cart-collaterals .cart_totals, 
            .woocommerce-page .cart-collaterals .cart_totals,
            .woocommerce .woocommerce-checkout-review-order .checkout_cart_table tr:not(:first-child) td, 
            .woocommerce-page .woocommerce-checkout-review-order .checkout_cart_table tr:not(:first-child) td,
            .woocommerce table.shop_table.checkout_cart_table tbody tr td,
            .woocommerce table.shop_table.checkout_cart_table tbody tr:first-child td,
            .woocommerce ul.order_details li:not(:first-child),
            .woocommerce .woocommerce-order table.shop_table td, 
            .woocommerce .woocommerce-order table.shop_table tbody th, 
            .woocommerce .woocommerce-order table.shop_table tfoot th, 
            .woocommerce .woocommerce-MyAccount-content table.shop_table td, 
            .woocommerce .woocommerce-MyAccount-content table.shop_table tbody th, 
            .woocommerce .woocommerce-MyAccount-content table.shop_table tfoot th, 
            .woocommerce-page .woocommerce-order table.shop_table td, 
            .woocommerce-page .woocommerce-order table.shop_table tbody th, 
            .woocommerce-page .woocommerce-order table.shop_table tfoot th, 
            .woocommerce-page .woocommerce-MyAccount-content table.shop_table td, 
            .woocommerce-page .woocommerce-MyAccount-content table.shop_table tbody th, 
            .woocommerce-page .woocommerce-MyAccount-content table.shop_table tfoot th,
            .woocommerce .woocommerce-order table.shop_table, 
            .woocommerce .woocommerce-MyAccount-content table.shop_table,
            .woocommerce-page .woocommerce-order table.shop_table, 
            .woocommerce-page .woocommerce-MyAccount-content table.shop_table,
            .woocommerce .woocommerce-order table.woocommerce-table--order-details tfoot tr:first-child th, 
            .woocommerce .woocommerce-order table.woocommerce-table--order-details tfoot tr:first-child td, 
            .woocommerce-page .woocommerce-order table.woocommerce-table--order-details tfoot tr:first-child th, 
            .woocommerce-page .woocommerce-order table.woocommerce-table--order-details tfoot tr:first-child td,
            .woocommerce-account .woocommerce-EditAccountForm fieldset,
            .widget div[class*="wp-block-"].has-content .wc-block-review-list-item__item:not(:first-child) {
                border-color: ' . esc_attr($standard_border_color) . ';
            }
            .woocommerce .woocommerce-cart-form table.shop_table, 
            .woocommerce-page .woocommerce-cart-form table.shop_table {
                border-color: ' . esc_attr($standard_border_color) . ' !important;
            }
            .content-wrapper .widget_price_filter .price_slider_wrapper .ui-widget-content {
                background-color: ' . esc_attr($standard_border_color) . ';
            }
        ';
    }

    $standard_border_hover_color = technum_get_prefered_option('standard_border_hover_color');
    if ( !empty($standard_border_hover_color) ) {
        $technum_custom_css .= '
            .content-wrapper .widget ul.product_list_widget li a:hover img,
            .woocommerce .shop_mode_list .woocommerce-loop-product__wrapper:hover, 
            .woocommerce-page .shop_mode_list .woocommerce-loop-product__wrapper:hover,
            .checkout_cart_table .product-thumbnail a:hover img,
            .woocommerce .woocommerce-cart-form table.shop_table a:hover img, 
            .woocommerce-page .woocommerce-cart-form table.shop_table a:hover img,
            .woocommerce .quantity-wrapper .quantity,
            .woocommerce .quantity-wrapper.styled .btn-plus, 
            .woocommerce .quantity-wrapper.styled .btn-minus,
            .single-product.woocommerce div.product .product_meta .tagged_as a,
            .woocommerce div.product .woocommerce-tabs ul.tabs li a,
            .woocommerce div.product .woocommerce-tabs ul.tabs li a:hover,
            .single-product.woocommerce div.product .woocommerce-product-gallery .flex-control-nav.flex-control-thumbs li img.flex-active,
            .products-widget ul.products li.product .woocommerce-loop-product__wrapper .attachment-woocommerce_wrapper .attachment-woocommerce_link,
            .woocommerce .shop_mode_grid ul.products li.product .woocommerce-loop-product__wrapper .attachment-woocommerce_wrapper .attachment-woocommerce_link,
            .woocommerce-page .shop_mode_grid ul.products li.product .woocommerce-loop-product__wrapper .attachment-woocommerce_wrapper .attachment-woocommerce_link,
            .wc-block-grid__product .wc-block-grid__product-image:before,
            .content-wrapper .widget_product_search .woocommerce-product-search .search-field,
            .content-wrapper .wp-block-woocommerce-product-search .wc-block-product-search__fields .wc-block-product-search__field,
            .content-wrapper .widget_rating_filter ul li a:before,
            .content-wrapper .widget_layered_nav ul li a:before,
            .woocommerce .woocommerce-cart-form table.shop_table td.actions .coupon .input-text, 
            .woocommerce-page .woocommerce-cart-form table.shop_table td.actions .coupon .input-text {
                border-color: ' . esc_attr($standard_border_hover_color) . ';
            }
            .content-wrapper .widget_product_search .woocommerce-product-search .search-field,
            .content-wrapper .wp-block-woocommerce-product-search .wc-block-product-search__fields .wc-block-product-search__field,
            .content-wrapper .widget_product_tag_cloud .tagcloud .tag-cloud-link,
            .content-wrapper .widget_rating_filter ul li a:before,
            .content-wrapper .widget_layered_nav ul li a:before,
            .content-wrapper .widget_layered_nav_filters ul .chosen a,
            .woocommerce div.product .woocommerce-tabs ul.tabs,
            .woocommerce-account .woocommerce-MyAccount-navigation ul,
            .woocommerce .woocommerce-order table.shop_table thead th, 
            .woocommerce .woocommerce-MyAccount-content table.shop_table thead th, 
            .woocommerce-page .woocommerce-order table.shop_table thead th, 
            .woocommerce-page .woocommerce-MyAccount-content table.shop_table thead th,
            .woocommerce .woocommerce-customer-details address {
                background-color: ' . esc_attr($standard_border_hover_color) . ';
            }
            .woocommerce .star-rating:before,
            .woocommerce-page .star-rating:before,
            .star-rating:before,
            .wc-block-components-review-list-item__rating > .wc-block-components-review-list-item__rating__stars,
            .woocommerce #review_form #respond p.stars a:before,
            .woocommerce #review_form #respond p.stars.selected a.active~a:before,
            .woocommerce #review_form #respond p.stars:not(.selected) a:hover~a:before {
                color: ' . esc_attr($standard_border_hover_color) . ';
            }
        ';
    }

    $standard_background_color = technum_get_prefered_option('standard_background_color');
    if ( !empty($standard_background_color) ) {
        $technum_custom_css .= '
            .header .mini-cart .mini-cart-panel,
            .woocommerce .shop_mode_list .woocommerce-loop-product__wrapper, 
            .woocommerce-page .shop_mode_list .woocommerce-loop-product__wrapper,
            .content-wrapper .widget_price_filter .price_slider_wrapper .ui-slider .ui-slider-handle, 
            .content-wrapper .widget_product_search .woocommerce-product-search .search-field:focus,
            .content-wrapper .wp-block-woocommerce-product-search .wc-block-product-search__fields .wc-block-product-search__field:focus,
            .woocommerce-pagination .page-numbers,
            .woocommerce-pagination .post-page-numbers {
                background-color: ' . esc_attr($standard_background_color) . ';
            }
            .content-wrapper .widget_price_filter .price_slider_wrapper .ui-slider .ui-slider-handle {
                -webkit-box-shadow: 0 0 0 4px ' . esc_attr($standard_background_color) . ';
                -moz-box-shadow: 0 0 0 4px ' . esc_attr($standard_background_color) . ';
                box-shadow: 0 0 0 4px ' . esc_attr($standard_background_color) . ';
            }
        ';
    }

    $standard_background_alter_color = technum_get_prefered_option('standard_background_alter_color');
    if ( !empty($standard_background_alter_color) ) {
        $technum_custom_css .= '
            #add_payment_method #payment div.payment_box, 
            .woocommerce-cart #payment div.payment_box, 
            .woocommerce-checkout #payment div.payment_box,
            .woocommerce .woocommerce-cart-form table.shop_table th, 
            .woocommerce-page .woocommerce-cart-form table.shop_table th {
                background-color: ' . esc_attr($standard_background_alter_color) . ';
            }
            #add_payment_method #payment div.payment_box:before, 
            .woocommerce-cart #payment div.payment_box:before, 
            .woocommerce-checkout #payment div.payment_box:before {
                border-bottom-color: ' . esc_attr($standard_background_alter_color) . ';
            }
        ';
    }

    $standard_button_text_color = technum_get_prefered_option('standard_button_text_color');
    if ( !empty($standard_button_text_color) ) {
        $technum_custom_css .= '
            .content-wrapper .woocommerce a.button,
            .woocommerce .content-wrapper a.button,
            .content-wrapper .woocommerce button.button,
            .woocommerce .content-wrapper button.button,
            .content-wrapper .woocommerce input.button,
            .woocommerce .content-wrapper input.button,
            .content-wrapper .woocommerce #respond input#submit,
            .woocommerce .content-wrapper #respond input#submit,
            .content-wrapper .woocommerce .added_to_cart,
            .woocommerce .content-wrapper .added_to_cart,
            .woocommerce a.button.alt.disabled, 
            .woocommerce a.button.alt.disabled:hover, 
            .woocommerce a.button.alt:disabled, 
            .woocommerce a.button.alt:disabled:hover, 
            .woocommerce a.button.alt:disabled[disabled], 
            .woocommerce a.button.alt:disabled[disabled]:hover, 
            .woocommerce button.button.alt.disabled, 
            .woocommerce button.button.alt.disabled:hover, 
            .woocommerce button.button.alt:disabled, 
            .woocommerce button.button.alt:disabled:hover, 
            .woocommerce button.button.alt:disabled[disabled], 
            .woocommerce button.button.alt:disabled[disabled]:hover, 
            .woocommerce input.button.alt.disabled, 
            .woocommerce input.button.alt.disabled:hover, 
            .woocommerce input.button.alt:disabled, 
            .woocommerce input.button.alt:disabled:hover, 
            .woocommerce input.button.alt:disabled[disabled], 
            .woocommerce input.button.alt:disabled[disabled]:hover,
            .content-wrapper .widget_price_filter .price_slider_amount .button:hover,
            .content-wrapper .widget_rating_filter ul li a:after,
            .content-wrapper .widget_layered_nav ul li a:after,
            .content-wrapper .widget_shopping_cart .woocommerce-mini-cart-buttons a.button:not(.checkout):hover,
            ul.products li.product .woocommerce-loop-product__wrapper .product-buttons-wrapper a.button:hover,
            .single-product.woocommerce div.product .cart .button:hover, 
            .single-product.woocommerce div.product .cart .added_to_cart:hover,
            .woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
            .woocommerce div.product .woocommerce-tabs ul.tabs li.active a:hover,
            .woocommerce #review_form #respond .submit:hover,
            .woocommerce .woocommerce-cart-form table.shop_table td.actions .coupon .button:hover, 
            .woocommerce-page .woocommerce-cart-form table.shop_table td.actions .coupon .button:hover,
            .woocommerce .cart-collaterals .cart_totals .wc-proceed-to-checkout .button:hover, 
            .woocommerce-page .cart-collaterals .cart_totals .wc-proceed-to-checkout .button:hover,
            .woocommerce #payment #place_order:hover, 
            .woocommerce-page #payment #place_order:hover,
            .content-wrapper .woocommerce .outer-form-wrapper .button:hover,
            .woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a,
            .wc-block-grid__products .wc-block-grid__product .wp-block-button .wp-block-button__link:hover,
            .sidebar .wc-block-grid__products .wc-block-grid__product .wp-block-button .wp-block-button__link:hover,
            .footer-widgets .wc-block-grid__products .wc-block-grid__product .wp-block-button .wp-block-button__link:hover,
            .slide-sidebar-wrapper .wc-block-grid__products .wc-block-grid__product .wp-block-button .wp-block-button__link:hover {
                color: ' . esc_attr($standard_button_text_color) . ';
            }
        ';
    }

    $standard_button_border_color = technum_get_prefered_option('standard_button_border_color');
    if ( !empty($standard_button_border_color) ) {
        $technum_custom_css .= '
            .content-wrapper .widget_rating_filter ul li.chosen a:before,
            .content-wrapper .widget_layered_nav ul li.chosen a:before {
                border-color: ' . esc_attr($standard_button_border_color) . ';
            }
            .content-wrapper .widget_rating_filter ul li.chosen a:before,
            .content-wrapper .widget_layered_nav ul li.chosen a:before {
                background-color: ' . esc_attr($standard_button_border_color) . ';
            }
        ';
    }

    $standard_button_background_color = technum_get_prefered_option('standard_button_background_color');
    if ( !empty($standard_button_background_color) ) {
        $technum_custom_css .= '
            .content-wrapper .woocommerce #respond input#submit,
            .woocommerce .content-wrapper #respond input#submit,
            .content-wrapper .widget_price_filter .price_slider_wrapper .ui-slider .ui-slider-range,
            .woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
            .woocommerce div.product .woocommerce-tabs ul.tabs li.active a:hover,
            .woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a {
                background-color: ' . esc_attr($standard_button_background_color) . ';
            }
        ';
    }

    $standard_button_text_hover = technum_get_prefered_option('standard_button_text_hover');
    if ( !empty($standard_button_text_hover) ) {
        $technum_custom_css .= '
            .content-wrapper .woocommerce a.button:hover,
            .woocommerce .content-wrapper a.button:hover,
            .content-wrapper .woocommerce button.button:hover,
            .woocommerce .content-wrapper button.button:hover,
            .content-wrapper .woocommerce input.button:hover,
            .woocommerce .content-wrapper input.button:hover,
            .content-wrapper .woocommerce #respond input#submit:hover,
            .woocommerce .content-wrapper #respond input#submit:hover,
            .content-wrapper .woocommerce .added_to_cart:hover,
            .woocommerce .content-wrapper .added_to_cart:hover,
            .woocommerce .woocommerce-cart-form table.shop_table td.actions .button:disabled, 
            .woocommerce .woocommerce-cart-form table.shop_table td.actions .button[disabled],
            .content-wrapper .widget_price_filter .price_slider_amount .button,
            .content-wrapper .widget_product_tag_cloud .tagcloud .tag-cloud-link:hover,
            .content-wrapper .widget_shopping_cart .woocommerce-mini-cart-buttons a.button:not(.checkout),
            .content-wrapper .widget_layered_nav_filters ul .chosen a:hover,
            ul.products li.product .woocommerce-loop-product__wrapper .product-buttons-wrapper a.button,
            .single-product.woocommerce div.product .cart .button, 
            .single-product.woocommerce div.product .cart .added_to_cart,
            .woocommerce #review_form #respond .submit,
            .woocommerce .woocommerce-cart-form table.shop_table td.actions .coupon .button, 
            .woocommerce-page .woocommerce-cart-form table.shop_table td.actions .coupon .button,
            .woocommerce .cart-collaterals .cart_totals .wc-proceed-to-checkout .button, 
            .woocommerce-page .cart-collaterals .cart_totals .wc-proceed-to-checkout .button,
            .woocommerce #payment #place_order, 
            .woocommerce-page #payment #place_order,
            .content-wrapper .woocommerce .outer-form-wrapper .button,
            .wc-block-grid__products .wc-block-grid__product .wp-block-button .wp-block-button__link,
            .sidebar .wc-block-grid__products .wc-block-grid__product .wp-block-button .wp-block-button__link,
            .footer-widgets .wc-block-grid__products .wc-block-grid__product .wp-block-button .wp-block-button__link,
            .slide-sidebar-wrapper .wc-block-grid__products .wc-block-grid__product .wp-block-button .wp-block-button__link {
                color: ' . esc_attr($standard_button_text_hover) . ';
            }
            .woocommerce .quantity-wrapper.styled .btn-plus:hover .icon:before, 
            .woocommerce .quantity-wrapper.styled .btn-plus:hover .icon:after, 
            .woocommerce .quantity-wrapper.styled .btn-minus:hover .icon:before,
            .woocommerce .quantity-wrapper.styled .btn-minus:hover .icon:after {
                background-color: ' . esc_attr($standard_button_text_hover) . ';
            }
        ';
    }

    $standard_button_border_hover = technum_get_prefered_option('standard_button_border_hover');
    if ( !empty($standard_button_border_hover) ) {
        $technum_custom_css .= '';
    }

    $standard_button_background_hover = technum_get_prefered_option('standard_button_background_hover');
    if ( !empty($standard_button_background_hover) ) {
        $technum_custom_css .= '
            .content-wrapper .woocommerce #respond input#submit:hover:after,
            .woocommerce .content-wrapper #respond input#submit:hover:after,
            .content-wrapper .widget_product_tag_cloud .tagcloud .tag-cloud-link:hover,
            .content-wrapper .widget_layered_nav_filters ul .chosen a:hover,
            .woocommerce .quantity-wrapper.styled .btn-plus:hover, 
            .woocommerce .quantity-wrapper.styled .btn-minus:hover {
                background-color: ' . esc_attr($standard_button_background_hover) . ';
            }
            .woocommerce .quantity-wrapper.styled .btn-plus:hover, 
            .woocommerce .quantity-wrapper.styled .btn-minus:hover {
                border-color: ' . esc_attr($standard_button_background_hover) . ';
            }
        ';
    }

    if ( !empty($standard_button_background_hover) && !empty($standard_button_background_color) ) {
        $technum_custom_css .= '
            .content-wrapper .woocommerce a.button:after,
            .woocommerce .content-wrapper a.button:after,
            .content-wrapper .woocommerce button.button:after,
            .woocommerce .content-wrapper button.button:after,
            .content-wrapper .woocommerce input.button:after,
            .woocommerce .content-wrapper input.button:after,
            .content-wrapper .woocommerce #respond input#submit:after,
            .woocommerce .content-wrapper #respond input#submit:after,
            .content-wrapper .woocommerce .added_to_cart:after,
            .woocommerce .content-wrapper .added_to_cart:after {
                background: ' . esc_attr($standard_button_background_color) . ';
                background: -moz-linear-gradient(left, ' . esc_attr($standard_button_background_hover) . ' 0%, ' . esc_attr($standard_button_background_hover) . ' 50%, ' . esc_attr($standard_button_background_color) . ' 50%);
                background: -webkit-gradient(linear, left top, right top, color-stop(0%, ' . esc_attr($standard_button_background_hover) . '), color-stop(50%, ' . esc_attr($standard_button_background_hover) . '), color-stop(50%, ' . esc_attr($standard_button_background_color) . '));
                background: -webkit-linear-gradient(left, ' . esc_attr($standard_button_background_hover) . ' 0%, ' . esc_attr($standard_button_background_hover) . ' 50%, ' . esc_attr($standard_button_background_color) . ' 50%);
                background: -o-linear-gradient(left, ' . esc_attr($standard_button_background_hover) . ' 0%, ' . esc_attr($standard_button_background_color) . ' 50%, ' . esc_attr($standard_button_background_color) . ' 50%);
                background: -ms-linear-gradient(left, ' . esc_attr($standard_button_background_hover) . ' 0%, ' . esc_attr($standard_button_background_hover) . ' 50%, ' . esc_attr($standard_button_background_color) . ' 50%);
                background: linear-gradient(to right, ' . esc_attr($standard_button_background_hover) . ' 0%, ' . esc_attr($standard_button_background_hover) . ' 50%, ' . esc_attr($standard_button_background_color) . ' 50%);
            }
        ';
    }

    if ( !empty($standard_button_background_hover) && !empty($standard_button_background_color) ) {
        $technum_custom_css .= '
            .content-wrapper .widget_price_filter .price_slider_amount .button:after,
            .content-wrapper .widget_shopping_cart .woocommerce-mini-cart-buttons a.button:not(.checkout):after,
            ul.products li.product .woocommerce-loop-product__wrapper .product-buttons-wrapper a.button:after,
            .single-product.woocommerce div.product .cart .button:after, 
            .single-product.woocommerce div.product .cart .added_to_cart:after,
            .woocommerce #review_form #respond .submit:after,
            .woocommerce .woocommerce-cart-form table.shop_table td.actions .coupon .button:after, 
            .woocommerce-page .woocommerce-cart-form table.shop_table td.actions .coupon .button:after,
            .woocommerce .cart-collaterals .cart_totals .wc-proceed-to-checkout .button:after, 
            .woocommerce-page .cart-collaterals .cart_totals .wc-proceed-to-checkout .button:after,
            .woocommerce #payment #place_order:after, 
            .woocommerce-page #payment #place_order:after,
            .content-wrapper .woocommerce .outer-form-wrapper .button:after,
            .wc-block-grid__products .wc-block-grid__product .wp-block-button .wp-block-button__link:after,
            .sidebar .wc-block-grid__products .wc-block-grid__product .wp-block-button .wp-block-button__link:after,
            .footer-widgets .wc-block-grid__products .wc-block-grid__product .wp-block-button .wp-block-button__link:after,
            .slide-sidebar-wrapper .wc-block-grid__products .wc-block-grid__product .wp-block-button .wp-block-button__link:after {
                background: ' . esc_attr($standard_button_background_hover) . ';
                background: -moz-linear-gradient(left, ' . esc_attr($standard_button_background_color) . ' 0%, ' . esc_attr($standard_button_background_color) . ' 50%, ' . esc_attr($standard_button_background_hover) .
                ' 50%);
                background: -webkit-gradient(linear, left top, right top, color-stop(0%, ' . esc_attr($standard_button_background_color) . '), color-stop(50%, ' . esc_attr($standard_button_background_color) . '), color-stop(50%, ' . esc_attr($standard_button_background_color) . '));
                background: -webkit-linear-gradient(left, ' . esc_attr($standard_button_background_color) . ' 0%, ' . esc_attr($standard_button_background_color) . ' 50%, ' . esc_attr($standard_button_background_hover)
                . ' 50%);
                background: -o-linear-gradient(left, ' . esc_attr($standard_button_background_color) . ' 0%, ' . esc_attr($standard_button_background_hover) . ' 50%, ' . esc_attr($standard_button_background_hover) . ' 50%);
                background: -ms-linear-gradient(left, ' . esc_attr($standard_button_background_color) . ' 0%, ' . esc_attr($standard_button_background_color) . ' 50%, ' . esc_attr($standard_button_background_hover) .
                ' 50%);
                background: linear-gradient(to right, ' . esc_attr($standard_button_background_color) . ' 0%, ' . esc_attr($standard_button_background_color) . ' 50%, ' . esc_attr($standard_button_background_hover) .
                ' 50%);
            }
        ';
    }

    # Contrast Colors
    $contrast_default_text_color = technum_get_prefered_option('contrast_default_text_color');
    if ( !empty($contrast_default_text_color) ) {
        $technum_custom_css .= '
            .woocommerce-store-notice,
            .woocommerce-store-notice.demo_store {
                color: ' . esc_attr($contrast_default_text_color) . ';
            }
        ';
    }

    $contrast_dark_text_color = technum_get_prefered_option('contrast_dark_text_color');
    if ( !empty($contrast_dark_text_color) ) {
        $technum_custom_css .= '
            .slide-sidebar-wrapper .widget_product_search .woocommerce-product-search button,
            .slide-sidebar-wrapper .wp-block-woocommerce-product-search .wc-block-product-search__fields .wc-block-product-search__button,
            .slide-sidebar-wrapper .widget_product_categories .post-count,
            .slide-sidebar-wrapper .wc-block-product-categories-list .wc-block-product-categories-list-item .wc-block-product-categories-list-item-count,
            .slide-sidebar-wrapper ul.product_list_widget li .product-title,
            .wc-block-grid__product .wc-block-grid__product-onsale,
            .woocommerce-store-notice .woocommerce-store-notice__dismiss-link:before {
                color: ' . esc_attr($contrast_dark_text_color) . ';
            }
            .woocommerce .quantity-wrapper.styled .btn-plus:hover .icon:before, 
            .woocommerce .quantity-wrapper.styled .btn-plus:hover .icon:after, 
            .woocommerce .quantity-wrapper.styled .btn-minus:hover .icon:before,
            .woocommerce .quantity-wrapper.styled .btn-minus:hover .icon:after {
                background-color: ' . esc_attr($contrast_dark_text_color) . ';
            }
        ';
    }

    $contrast_light_text_color = technum_get_prefered_option('contrast_light_text_color');
    if ( !empty($contrast_light_text_color) ) {
        $technum_custom_css .= '
            .slide-sidebar-wrapper .widget_product_categories li.cat-item-hierarchical,
            .slide-sidebar-wrapper .wc-block-product-categories-list .wc-block-product-categories-list-item,
            .slide-sidebar-wrapper .widget ul.product_list_widget li .price_wrapper del,
            .slide-sidebar-wrapper .widget div[class*="wp-block-"] .wc-block-review-list-item__item .wc-block-review-list-item__published-date {
                color: ' . esc_attr($contrast_light_text_color) . ';
            }
        ';
    }

    $contrast_accent_text_color = technum_get_prefered_option('contrast_accent_text_color');
    if ( !empty($contrast_accent_text_color) ) {
        $technum_custom_css .= '
            .slide-sidebar-wrapper .widget ul.product_list_widget li .price_wrapper {
                color: ' . esc_attr($contrast_accent_text_color) . ';
            }
        ';
    }

    $contrast_border_color = technum_get_prefered_option('contrast_border_color');
    if ( !empty($contrast_border_color) ) {
        $technum_custom_css .= '
            .slide-sidebar-wrapper .widget ul.product_list_widget li a img,
            .slide-sidebar-wrapper .widget div[class*="wp-block-"].has-content .wc-block-review-list-item__item:not(:first-child) {
                border-color: ' . esc_attr($contrast_border_color) . ';
            }
        ';
    }

    $contrast_border_hover_color = technum_get_prefered_option('contrast_border_hover_color');
    if ( !empty($contrast_border_hover_color) ) {
        $technum_custom_css .= '
            .slide-sidebar-wrapper .widget ul.product_list_widget li a:hover img {
                border-color: ' . esc_attr($contrast_border_hover_color) . ';
            }
        ';
    }

    $contrast_background_color = technum_get_prefered_option('contrast_background_color');
    if ( !empty($contrast_background_color) ) {
        $technum_custom_css .= '
            .wc-block-grid__product .wc-block-grid__product-onsale,
            .woocommerce-store-notice,
            .woocommerce-store-notice.demo_store {
                background-color: ' . esc_attr($contrast_background_color) . ';
            }
        ';
    }

    $contrast_button_text_color = technum_get_prefered_option('contrast_button_text_color');
    if ( !empty($contrast_button_text_color) ) {
        $technum_custom_css .= '
            .slide-sidebar-wrapper .woocommerce a.button,
            .woocommerce .slide-sidebar-wrapper a.button,
            .slide-sidebar-wrapper .woocommerce button.button,
            .woocommerce .slide-sidebar-wrapper button.button,
            .slide-sidebar-wrapper .woocommerce input.button,
            .woocommerce .slide-sidebar-wrapper input.button,
            .slide-sidebar-wrapper .woocommerce #respond input#submit,
            .woocommerce .slide-sidebar-wrapper #respond input#submit,
            .slide-sidebar-wrapper .woocommerce .added_to_cart, 
            .woocommerce .slide-sidebar-wrapper .added_to_cart {
                color: ' . esc_attr($contrast_button_text_color) . ';
            }
        ';
    }

    $contrast_button_border_color = technum_get_prefered_option('contrast_button_border_color');
    if ( !empty($contrast_button_border_color) ) {
        $technum_custom_css .= '
            .slide-sidebar-wrapper .woocommerce a.button,
            .woocommerce .slide-sidebar-wrapper a.button,
            .slide-sidebar-wrapper .woocommerce button.button,
            .woocommerce .slide-sidebar-wrapper button.button,
            .slide-sidebar-wrapper .woocommerce input.button,
            .woocommerce .slide-sidebar-wrapper input.button,
            .slide-sidebar-wrapper .woocommerce #respond input#submit,
            .woocommerce .slide-sidebar-wrapper #respond input#submit,
            .slide-sidebar-wrapper .woocommerce .added_to_cart, 
            .woocommerce .slide-sidebar-wrapper .added_to_cart {
                border-color: ' . esc_attr($contrast_button_border_color) . ';
            }
        ';
    }

    $contrast_button_background_color = technum_get_prefered_option('contrast_button_background_color');
    if ( !empty($contrast_button_background_color) ) {
        $technum_custom_css .= '
            .slide-sidebar-wrapper .woocommerce a.button:after,
            .woocommerce .slide-sidebar-wrapper a.button:after,
            .slide-sidebar-wrapper .woocommerce button.button:after,
            .woocommerce .slide-sidebar-wrapper button.button:after,
            .slide-sidebar-wrapper .woocommerce input.button:after,
            .woocommerce .slide-sidebar-wrapper input.button:after,
            .slide-sidebar-wrapper .woocommerce #respond input#submit:after,
            .woocommerce .slide-sidebar-wrapper #respond input#submit:after,
            .slide-sidebar-wrapper .woocommerce .added_to_cart:after, 
            .woocommerce .slide-sidebar-wrapper .added_to_cart:after {
                background-color: ' . esc_attr($contrast_button_background_color) . ';
            }
        ';
    }

    $contrast_button_text_hover = technum_get_prefered_option('contrast_button_text_hover');
    if ( !empty($contrast_button_text_hover) ) {
        $technum_custom_css .= '
            .slide-sidebar-wrapper .woocommerce a.button:hover,
            .woocommerce .slide-sidebar-wrapper a.button:hover,
            .slide-sidebar-wrapper .woocommerce button.button:hover,
            .woocommerce .slide-sidebar-wrapper button.button:hover,
            .slide-sidebar-wrapper .woocommerce input.button:hover,
            .woocommerce .slide-sidebar-wrapper input.button:hover,
            .slide-sidebar-wrapper .woocommerce #respond input#submit:hover,
            .woocommerce .slide-sidebar-wrapper #respond input#submit:hover,
            .slide-sidebar-wrapper .woocommerce .added_to_cart:hover, 
            .woocommerce .slide-sidebar-wrapper .added_to_cart:hover {
                color: ' . esc_attr($contrast_button_text_hover) . ';
            }
        ';
    }

    $contrast_button_border_hover = technum_get_prefered_option('contrast_button_border_hover');
    if ( !empty($contrast_button_border_hover) ) {
        $technum_custom_css .= '
            .slide-sidebar-wrapper .woocommerce a.button:hover,
            .woocommerce .slide-sidebar-wrapper a.button:hover,
            .slide-sidebar-wrapper .woocommerce button.button:hover,
            .woocommerce .slide-sidebar-wrapper button.button:hover,
            .slide-sidebar-wrapper .woocommerce input.button:hover,
            .woocommerce .slide-sidebar-wrapper input.button:hover,
            .slide-sidebar-wrapper .woocommerce #respond input#submit:hover,
            .woocommerce .slide-sidebar-wrapper #respond input#submit:hover,
            .slide-sidebar-wrapper .woocommerce .added_to_cart:hover, 
            .woocommerce .slide-sidebar-wrapper .added_to_cart:hover {
                border-color: ' . esc_attr($contrast_button_border_hover) . ';
            }
        ';
    }

    $contrast_button_background_hover = technum_get_prefered_option('contrast_button_background_hover');
    if ( !empty($contrast_button_background_hover) ) {
        $technum_custom_css .= '
            .slide-sidebar-wrapper .woocommerce a.button:hover:after,
            .woocommerce .slide-sidebar-wrapper a.button:hover:after,
            .slide-sidebar-wrapper .woocommerce button.button:hover:after,
            .woocommerce .slide-sidebar-wrapper button.button:hover:after,
            .slide-sidebar-wrapper .woocommerce input.button:hover:after,
            .woocommerce .slide-sidebar-wrapper input.button:hover:after,
            .slide-sidebar-wrapper .woocommerce #respond input#submit:hover:after,
            .woocommerce .slide-sidebar-wrapper #respond input#submit:hover:after,
            .slide-sidebar-wrapper .woocommerce .added_to_cart:hover:after, 
            .woocommerce .slide-sidebar-wrapper .added_to_cart:hover:after {
                background-color: ' . esc_attr($contrast_button_background_hover) . ';
            }
        ';
    }

    # Buttons
    $buttons_font       = technum_get_prepared_option('buttons_font');
    $buttons_font_array = json_decode($buttons_font, true);
    if (
        !empty($buttons_font_array['font_family']) ||
        !empty($buttons_font_array['font_size']) ||
        !empty($buttons_font_array['text_transform']) ||
        !empty($buttons_font_array['letter_spacing']) ||
        !empty($buttons_font_array['word_spacing']) ||
        !empty($buttons_font_array['font_style']) ||
        !empty($buttons_font_array['font_weight'])
    ) {
        $technum_custom_css .= '
            .woocommerce a.button,
            .woocommerce button.button,
            .woocommerce input.button,
            .woocommerce #respond input#submit,
            .woocommerce .added_to_cart,
            #add_payment_method .wc-proceed-to-checkout a.checkout-button,
            .woocommerce-cart .wc-proceed-to-checkout a.checkout-button,
            .woocommerce-checkout .wc-proceed-to-checkout a.checkout-button {' .
                technum_print_font_styles( $buttons_font, array('font_family', 'font_size', 'text_transform', 'letter_spacing', 'word_spacing', 'font_style', 'font_weight') ) .
            '}
        ';
    }

    # Main Font
    $main_font          = technum_get_prepared_option('main_font');
    $main_font_array    = json_decode($main_font, true);
    if (
        !empty($main_font_array['font_family'])
    ) {
        $technum_custom_css .= '
            h3#ship-to-different-address {' .
                technum_print_font_styles( $main_font, array('font_family') ) .
            '}
        ';
    }

    # Typography Headings
    $headings_font          = technum_get_prepared_option('headings_font');
    $headings_font_array    = json_decode($buttons_font, true);
    if (
        !empty($headings_font_array['font_family'])
    ) {
        $technum_custom_css .= '
            .widget_product_categories ul li,
            ul.product_list_widget li .product-title,
            .widget_layered_nav_filters .tagcloud .tag-cloud-link,
            .widget_product_tag_cloud .tagcloud .tag-cloud-link,
            .attachment-woocommerce_flash .flash-item,
            .checkout_cart_table .product-name .product-name-title,
            .woocommerce-checkout-review-total .checkout_total_table td:first-child,
            .woocommerce .woocommerce-cart-form table.shop_table th,
            .woocommerce-page .woocommerce-cart-form table.shop_table th,
            .woocommerce .woocommerce-cart-form table.shop_table td.product-name,
            .woocommerce-page .woocommerce-cart-form table.shop_table td.product-name,
            .cart-collaterals .cart_totals table.shop_table th,
            .cart-collaterals .cart_totals table.shop_table td,
            .woocommerce-tabs ul.tabs li a,
            .commentlist li.review .comment_container .woocommerce-review__author,
            .commentlist li.review .comment_container .comment-date,
            .filter-control-wrapper .filter-control-list .filter-control-item,
            .wc-block-grid__product .wc-block-grid__product-title,
            .wc-block-grid__product .wc-block-grid__product-onsale,
            .product-category-widget .product-category-header,
            .content-wrapper .widget_price_filter .price_slider_amount .price_label,
            .price_wrapper,
            .widget_rating_filter ul li,
            .widget_layered_nav ul li,
            .product_list_widget li .reviewer,
            .widget_shopping_cart .cart_list li .content-woocommerce-wrapper .quantity,
            .header .mini-cart .mini-cart-panel .cart_list li .content-woocommerce-wrapper .quantity,
            .woocommerce-pagination .page-numbers,
            .woocommerce-pagination .post-page-numbers,
            .woocommerce .woocommerce-cart-form table.shop_table th, 
            .woocommerce-page .woocommerce-cart-form table.shop_table th,
            .woocommerce-cart-form table.shop_table td.product-price,
            .woocommerce-cart-form table.shop_table td.product-subtotal,
            .cart-collaterals table.shop_table tbody:first-child tr:first-child td, 
            .woocommerce table.shop_table tbody:first-child tr:first-child th,
            .woocommerce-checkout-review-order .checkout_cart_table .product-name .product-name-info,
            .woocommerce-checkout-review-order .checkout_cart_table .product-total,
            .woocommerce-checkout-review-order .shop_table.woocommerce-checkout-review-order-table th,
            .woocommerce-checkout-review-order .shop_table.woocommerce-checkout-review-order-table .amount,
            .woocommerce table.shop_table.checkout_cart_table td:before,
            .woocommerce-account .woocommerce-MyAccount-navigation ul li a,
            .woocommerce .woocommerce-order table.shop_table thead th, 
            .woocommerce .woocommerce-MyAccount-content table.shop_table thead th, 
            .woocommerce-page .woocommerce-order table.shop_table thead th, 
            .woocommerce-page .woocommerce-MyAccount-content table.shop_table thead th,
            .woocommerce .woocommerce-order table.shop_table .woocommerce-orders-table__cell-order-status, 
            .woocommerce .woocommerce-MyAccount-content table.shop_table .woocommerce-orders-table__cell-order-status, 
            .woocommerce-page .woocommerce-order table.shop_table .woocommerce-orders-table__cell-order-status, 
            .woocommerce-page .woocommerce-MyAccount-content table.shop_table .woocommerce-orders-table__cell-order-status,
            .woocommerce .woocommerce-table--order-details .product-name a,
            .woocommerce .woocommerce-table--order-details .amount,
            .woocommerce .woocommerce-table--order-details tfoot th,
            .wc-block-product-categories-list .wc-block-product-categories-list-item,
            .widget div[class*="wp-block-"] .wc-block-review-list-item__item .wc-block-review-list-item__meta {' .
                technum_print_font_styles( $headings_font, array('font_family') ) .
            '}
        ';
    }

}