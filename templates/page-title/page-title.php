<?php
    defined( 'ABSPATH' ) or die();

    if ( is_home() ) {
        $page_title = esc_html__('Home', 'technum');
    } elseif ( class_exists('WooCommerce') && is_product() ) {
        $page_title = sprintf(stripslashes(technum_get_theme_mod('woo_single_product_title')), get_the_title());
    } elseif ( class_exists('WooCommerce') && is_product_category()  ) {
        $page_title = sprintf(stripslashes(technum_get_theme_mod('woo_product_categories_title')), single_term_title('', false));
    } elseif ( class_exists('WooCommerce') && is_product_tag() ) {
        $page_title = sprintf(stripslashes(technum_get_theme_mod('woo_product_tags_title')), single_term_title('', false));
    } elseif ( class_exists('WooCommerce') && is_search() ) {
        $page_title = sprintf(esc_html__('Search Results By "%s"', 'technum'), get_search_query());
    } elseif (is_archive()) {
        if ( class_exists('WooCommerce') && is_woocommerce() ) {
            $page_title = get_the_title();
        } elseif ( !empty(get_queried_object()) && get_queried_object()->name == 'technum_portfolio') {
            $page_title = sprintf(esc_html(technum_get_theme_mod('portfolio_archive_page_title')), post_type_archive_title('', false));
        } elseif ( !empty(get_queried_object()) && get_queried_object()->name == 'technum_project') {
            $page_title = sprintf(esc_html(technum_get_theme_mod('project_archive_page_title')), post_type_archive_title('', false));
        } elseif ( !empty(get_queried_object()) && get_queried_object()->name == 'technum_case_study') {
            $page_title = sprintf(esc_html(technum_get_theme_mod('case_studies_archive_page_title')), post_type_archive_title('', false));
        } elseif ( !empty(get_queried_object()) && get_queried_object()->name == 'technum_team_member') {
            $page_title = sprintf(esc_html(technum_get_theme_mod('team_archive_page_title')), post_type_archive_title('', false));
        } elseif ( !empty(get_queried_object()) && get_queried_object()->name == 'technum_vacancy') {
            $page_title = sprintf(esc_html(technum_get_theme_mod('vacancy_archive_page_title')), post_type_archive_title('', false));
        } elseif ( !empty(get_queried_object()) && get_queried_object()->name == 'technum_service') {
            $page_title = sprintf(esc_html(technum_get_theme_mod('service_archive_page_title')), post_type_archive_title('', false));
        } else {
            $page_title = get_the_archive_title();
        }
    } elseif (is_search()) {
        $page_title = sprintf(esc_html__('Search Results By "%s"', 'technum'), get_search_query());
    } elseif (is_singular('technum_portfolio')) {
        $page_title = sprintf(stripslashes(technum_get_theme_mod('portfolio_single_page_title')), get_the_title());
    } elseif (is_singular('technum_project')) {
        $page_title = sprintf(stripslashes(technum_get_theme_mod('project_single_page_title')), get_the_title());
    } elseif (is_singular('technum_case_study')) {
        $page_title = sprintf(stripslashes(technum_get_theme_mod('case_studies_single_page_title')), get_the_title());
    } elseif (is_singular('technum_team_member')) {
        $page_title = sprintf(stripslashes(technum_get_theme_mod('team_single_page_title')), get_the_title());
    } elseif (is_singular('technum_vacancy')) {
        $page_title = sprintf(stripslashes(technum_get_theme_mod('vacancy_single_page_title')), get_the_title());
    } elseif (is_singular('technum_service')) {
        $page_title = sprintf(stripslashes(technum_get_theme_mod('service_single_page_title')), get_the_title());
    } elseif (is_single()) {
        $page_title = sprintf(stripslashes(technum_get_theme_mod('post_page_title')), get_the_title());
    } else {
        $page_title = get_the_title();
    }
    $breadcrumbs_status = technum_get_prefered_option('page_title_breadcrumbs_status');
?>

<!-- Page Title -->
<div class="page-title-container">
    <div class="page-title-bg"></div>
    <div class="page-title-row">
        <div class="page-title-wrapper">
            <div class="page-title-box">
                <?php
                    if ( !empty(technum_get_prefered_option('page_title_additional_text')) ) {
                        echo '<div class="page-title-additional">' . esc_html(technum_get_prefered_option('page_title_additional_text')) . '</div>';
                    }
                ?>
                <h1 class="page-title"><?php echo sprintf('%s', $page_title); ?></h1>
            </div>
            <?php
                if ( $breadcrumbs_status == 'on' ) {
                    technum_breadcrumbs();
                }
            ?>
        </div>
    </div>
</div>