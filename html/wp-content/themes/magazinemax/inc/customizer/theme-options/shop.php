<?php
$wp_customize->add_section(
    'home_page_shop_option',
    array(
        'title' => __('Shop  Section Options', 'magazinemax'),
        'panel' => 'theme_home_option_panel',
    )
);

/* Home Page Layout */
$wp_customize->add_setting(
    'magazinemax_options[enable_shop_section]',
    array(
        'default' => $default_options['enable_shop_section'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_shop_section]',
    array(
        'label' => __('Enable Shop Section', 'magazinemax'),
        'section' => 'home_page_shop_option',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting(
    'magazinemax_options[shop_post_title]',
    array(
        'default' => $default_options['shop_post_title'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'magazinemax_options[shop_post_title]',
    array(
        'label' => __('Shop Post Title', 'magazinemax'),
        'section' => 'home_page_shop_option',
        'type' => 'text',
    )
);

$wp_customize->add_setting(
    'magazinemax_options[shop_post_description]',
    array(
        'default' => $default_options['shop_post_description'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'magazinemax_options[shop_post_description]',
    array(
        'label' => __('Shop Post Description', 'magazinemax'),
        'section' => 'home_page_shop_option',
        'type' => 'textarea',
    )
);

$wp_customize->add_setting(
    'magazinemax_options[shop_select_product_from]',
    array(
        'default' => $default_options['shop_select_product_from'],
        'sanitize_callback' => 'magazinemax_sanitize_select',
    )
);
$wp_customize->add_control(
    'magazinemax_options[shop_select_product_from]',
    array(
        'label' => __('Select Product From', 'magazinemax'),
        'section' => 'home_page_shop_option',
        'type' => 'select',
        'choices' => array(
            'custom' => __('Custom Select', 'magazinemax'),
            'recent-products' => __('Recent Products', 'magazinemax'),
            'popular-products' => __('Popular Products', 'magazinemax'),
            'sale-products' => __('Sale Products', 'magazinemax'),
        )
    )
);


$wp_customize->add_setting(
    'magazinemax_options[select_product_category]',
    array(
        'default' => $default_options['select_product_category'],
        'sanitize_callback' => 'magazinemax_sanitize_select',
    )
);
$wp_customize->add_control(
    'magazinemax_options[select_product_category]',
    array(
        'label' => __('Select Product Category', 'magazinemax'),
        'section' => 'home_page_shop_option',
        'type' => 'select',
        'choices' => magazinemax_woocommerce_product_cat(),
        'active_callback' => 'magazinemax_shop_select_product_from'
    )
);

$wp_customize->add_setting(
    'magazinemax_options[shop_number_of_column]',
    array(
        'default' => $default_options['shop_number_of_column'],
        'sanitize_callback' => 'magazinemax_sanitize_select',
    )
);
$wp_customize->add_control(
    'magazinemax_options[shop_number_of_column]',
    array(
        'label' => __('Select Number Of Column', 'magazinemax'),
        'section' => 'home_page_shop_option',
        'type' => 'select',
        'choices' => array(
            '2' => __('2', 'magazinemax'),
            '3' => __('3', 'magazinemax'),
            '4' => __('4', 'magazinemax'),
        )
    )
);

$wp_customize->add_setting(
    'magazinemax_options[shop_number_of_product]',
    array(
        'default' => $default_options['shop_number_of_product'],
        'sanitize_callback' => 'magazinemax_sanitize_select',
    )
);
$wp_customize->add_control(
    'magazinemax_options[shop_number_of_product]',
    array(
        'label' => __('Select Number Of Product', 'magazinemax'),
        'section' => 'home_page_shop_option',
        'type' => 'select',
        'choices' => array(
            '2' => __('2', 'magazinemax'),
            '3' => __('3', 'magazinemax'),
            '4' => __('4', 'magazinemax'),
            '5' => __('5', 'magazinemax'),
            '6' => __('6', 'magazinemax'),
            '7' => __('7', 'magazinemax'),
            '8' => __('8', 'magazinemax'),
            '9' => __('9', 'magazinemax'),
            '10' => __('10', 'magazinemax'),
            '11' => __('11', 'magazinemax'),
            '12' => __('12', 'magazinemax'),
        )
    )
);

$wp_customize->add_setting(
    'magazinemax_options[shop_post_button_text]',
    array(
        'default' => $default_options['shop_post_button_text'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'magazinemax_options[shop_post_button_text]',
    array(
        'label' => __('Shop section Button Text', 'magazinemax'),
        'section' => 'home_page_shop_option',
        'type' => 'text',
    )
);
$wp_customize->add_setting(
    'magazinemax_options[shop_post_button_url]',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control(
    'magazinemax_options[shop_post_button_url]',
    array(
        'label' => __('Button Link', 'magazinemax'),
        'section' => 'home_page_shop_option',
        'type' => 'text',
        'description' => __('Leave empty if you don\'t want the image to have a link', 'magazinemax'),
    )
);