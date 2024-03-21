<?php
/**
 * Default customizer values.
 *
 * @package Magazinemax
 */
if (!function_exists('magazinemax_get_default_customizer_values')) :
    /**
     * Get default customizer values.
     *
     * @return array Default customizer values.
     * @since 1.0.0
     *
     */
    function magazinemax_get_default_customizer_values()
    {

        $defaults = array();

        $defaults['background_color'] = 'ffffff';

        // header image section
        $defaults['enable_header_bg_overlay'] = false;
        $defaults['header_image_size'] = 'none';

        //Site title options
        $defaults['hide_title'] = false;
        $defaults['hide_tagline'] = false;
        $defaults['site_title_text_size'] = 54;
        $defaults['site_tagline_text_size'] = 18;

        // General options
        $defaults['enable_cursor_dot_outline'] = false;
        $defaults['enable_category_meta_color'] = false;
        $defaults['site_fallback_image'] = get_template_directory_uri() . '/assets/images/no-image.jpg';

        $defaults['show_preloader'] = true;
        $defaults['preloader_style'] = 'theme-preloader-spinner-3';
        $defaults['show_progressbar'] = false;
        $defaults['progressbar_position'] = 'top';
        $defaults['progressbar_color'] = '#f7775e';
        // header full page add
        $defaults['ed_header_ad'] = false;
        $defaults['ed_header_type'] = 'welcome-banner-default';
        $defaults['advertisement_section_title'] = esc_html__('Welcome Advertisement Message', 'magazinemax');

        // Top bar.
        $defaults['enable_top_bar'] = true;
        $defaults['hide_topbar_on_mobile'] = true;
        $defaults['enable_topbar_time'] = true;
        $defaults['enable_topbar_date'] = true;
        $defaults['todays_date_format'] = 'l, F j Y';
        $defaults['enable_topbar_social_icons'] = true;
        $defaults['enable_topbar_nav'] = true;
        $defaults['top_bar_bg_color'] = '#000000';
        $defaults['top_bar_text_color'] = '#fff';

        // Header
        $defaults['header_bg_color'] = '#ffffff';
        $defaults['enable_top_nav'] = true;

        // tagged section
        $defaults['top_tagged_title'] = esc_html__('Trending', 'magazinemax');
        $defaults['show_top_tagged_section'] = true;
        $defaults['top_tagged_number'] = 8;

        // ticker section
        $defaults['enable_ticker_post']          = true;
        $defaults['ticker_post_title'] = esc_html__('Breaking News', 'magazinemax');
        $defaults['ticker_post_category'] = '';

        $defaults['enable_random_post'] = true;
        $defaults['random_post_category'] = '';
        $defaults['random_post_title'] = __("I'm Feeling Lucky", 'magazinemax');

        $defaults['enable_search_on_header'] = true;
        $defaults['header_search_btn_style'] = 'style_1';
        $defaults['enable_mini_cart_header'] = true;
        $defaults['enable_woo_my_account'] = true;
        $defaults['enable_sticky_menu'] = true;

        // Dark Mode.
        $defaults['enable_always_dark_mode'] = false;
        $defaults['enable_dark_mode'] = true;
        $defaults['enable_dark_mode_switcher'] = true;
        $defaults['dark_mode_accent_color'] = '#066ac6';
        $defaults['dark_mode_bg_color'] = '#1e1e1e';
        $defaults['dark_mode_text_color'] = '#ffffff';

        // shop page
        $defaults['enable_shop_section'] = true;
        $defaults['shop_post_title'] = __('Shop Now', 'magazinemax');
        $defaults['shop_post_description'] = '';
        $defaults['shop_number_of_column'] = 4;
        $defaults['shop_number_of_product'] = 4;
        $defaults['shop_select_product_from'] = 'recent-products';
        $defaults['select_product_category'] = '';
        $defaults['shop_post_button_text'] = __('Shop Now', 'magazinemax');

        // Front Page
        $defaults['front_page_enable_sidebar'] = false;
        $defaults['hide_front_page_sidebar_mobile'] = false;
        $defaults['front_page_layout'] = 'right-sidebar';

        // Jumbotron
        $defaults['enable_jumbotron_section'] = false;
        $defaults['jumbotron_section_cat'] = '';
        $defaults['jumbotron_bg_color'] = '#ffffff';
        $defaults['jumbotron_text_color'] = '#000';
        $defaults['enable_jumbotron_cat_meta'] = false;
        $defaults['enable_jumbotron_cat_meta_bg_color'] = false;
        $defaults['enable_jumbotron_author_meta'] = false;
        $defaults['enable_jumbotron_date_meta'] = true;
        $defaults['enable_jumbotron_post_views'] = false;


        $defaults['enable_three_col_hero_banner'] = false;
        $defaults['three_col_banner_cat_1'] = '';
        $defaults['three_col_banner_cat_3'] = '';

        // front page banner sectiion
        $defaults['enable_banner_section'] = true;
        $defaults['enable_banner_overlay'] = true;
        $defaults['number_of_slider_post'] = '4';
        $defaults['banner_section_cat'] = '';
        $defaults['enable_banner_cat_meta'] = true;
        $defaults['enable_banner_cat_meta_color'] = true;
        $defaults['enable_banner_post_description'] = false;
        $defaults['enable_banner_author_meta'] = true;
        $defaults['enable_banner_date_meta'] = true;
        $defaults['enable_banner_post_views'] = true;
        $defaults['banner_button_text'] = __('The Full Picture: Navigate to News Details!', 'magazinemax');


        // front page read more section
        $defaults['enable_read_more_post_section'] = true;
        $defaults['flip_read_more_post_section'] = false;
        $defaults['read_more_post_title'] = __('More To Read', 'magazinemax');
        $defaults['select_cat_for_read_more_post'] = '';
        $defaults['select_cat_for_read_more_list_post'] = '';
        $defaults['enable_post_excerpt'] = true;
        $defaults['enable_read_more_category_meta'] = false;
        $defaults['enable_read_more_category_meta_color'] = false;
        $defaults['enable_date_meta'] = true;


        // archive options
        $defaults['global_sidebar_layout'] = 'right-sidebar';
        $defaults['hide_global_sidebar_mobile'] = false;
        $defaults['excerpt_length'] = 25;
        $defaults['enable_excerpt_read_more'] = true;
        $defaults['excerpt_read_more'] = __('[Read More...]', 'magazinemax');


        // Single options
        $defaults['single_sidebar_layout'] = 'right-sidebar';
        $defaults['magazinemax_single_post_layout'] = 'layout-1';
        $defaults['magazinemax_single_post_style'] = 'style-1';
        $defaults['magazinemax_single_post_header_overlay'] = 'featured-banner-overlay-disable';
        $defaults['hide_single_sidebar_mobile'] = false;
        $defaults['single_post_meta'] = array('author', 'date', 'comment', 'category', 'tags');

        $defaults['show_author_info'] = true;
        $defaults['show_sticky_article_navigation'] = true;

        $defaults['show_related_posts'] = true;
        $defaults['related_posts_text'] = __('You May Also Like', 'magazinemax');
        $defaults['no_of_related_posts'] = 3;
        $defaults['related_posts_orderby'] = 'date';
        $defaults['related_posts_order'] = 'desc';
        $defaults['author_posts_orderby'] = 'date';
        $defaults['author_posts_order'] = 'desc';

        $defaults['show_author_posts'] = true;
        $defaults['author_posts_text'] = __('More From Author', 'magazinemax');
        $defaults['no_of_author_posts'] = 3;

        // Archive
        $defaults['archive_style'] = 'archive_style_1';
        $defaults['archive_post_meta_1'] = array('author', 'date', 'comment', 'category', 'tags');
        $defaults['archive_post_meta_2'] = array('author', 'date', 'category');
        $defaults['archive_post_meta_3'] = array('author', 'date', 'category');
        $defaults['archive_post_meta_4'] = array('category');

        // pagination
        $defaults['pagination_type'] = 'default';

        // footer related post
        $defaults['enable_footer_recommended_post_section'] = true;
        $defaults['footer_recommended_post_title'] = esc_html__('You May Also Like:', 'magazinemax');
        $defaults['enable_category_meta'] = true;
        $defaults['enable_post_excerpt'] = false;
        $defaults['enable_date_meta'] = true;
        $defaults['enable_author_meta'] = true;
        $defaults['enable_post_views'] = true;
        $defaults['select_cat_for_footer_recommended_post'] = '';

        /*Footer*/
        $defaults['footer_column_layout'] = 'footer_layout_1';
        $defaults['enable_footer_sticky'] = false;
        $defaults['enable_footer_image_overlay'] = false;
        $defaults['copyright_text'] = esc_html__('Copyright &copy;', 'magazinemax');
        $defaults['copyright_date_format'] = 'Y';
        $defaults['enable_footer_nav'] = false;
        $defaults['enable_footer_social_nav'] = false;
        $defaults['enable_scroll_to_top'] = true;

        $defaults['footer_widgetarea_bg_color'] = '#000';
        $defaults['footer_widgetarea_text_color'] = '#fff';
        $defaults['footer_middlearea_bg_color'] = '#000';
        $defaults['footer_middlearea_text_color'] = '#fff';
        $defaults['footer_credit_bg_color'] = '#000';
        $defaults['footer_credit_text_color'] = '#fff';

        $defaults['enable_facebook'] = 1;
        $defaults['enable_twitter'] = 1;
        $defaults['enable_pinterest'] = 1;
        $defaults['enable_linkedin'] = 0;
        $defaults['enable_telegram'] = 1;
        $defaults['enable_reddit'] = 1;
        $defaults['enable_stumbleupon'] = 0;
        $defaults['enable_whatsapp'] = 1;
        $defaults['enable_email'] = 1;

        $defaults = apply_filters('magazinemax_default_customizer_values', $defaults);
        return $defaults;
    }
endif;