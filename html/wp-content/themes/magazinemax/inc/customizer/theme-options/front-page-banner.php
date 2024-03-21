<?php
/*Add Home Page Options Panel.*/
$wp_customize->add_panel(
    'theme_home_option_panel',
    array(
        'title' => __('Front Page Options', 'magazinemax'),
        'description' => __('Contains all front page settings', 'magazinemax'),
        'priority' => 150
    )
);
/**/
$wp_customize->add_section(
    'home_page_banner_option',
    array(
        'title' => __('Main Banner Options', 'magazinemax'),
        'panel' => 'theme_home_option_panel',
    )
);

/* Home Page Layout */
$wp_customize->add_setting(
    'magazinemax_options[enable_banner_section]',
    array(
        'default' => $default_options['enable_banner_section'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_banner_section]',
    array(
        'label' => __('Enable Banner Section', 'magazinemax'),
        'section' => 'home_page_banner_option',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting(
    'magazinemax_options[number_of_slider_post]',
    array(
        'default' => $default_options['number_of_slider_post'],
        'sanitize_callback' => 'magazinemax_sanitize_select',
    )
);
$wp_customize->add_control(
    'magazinemax_options[number_of_slider_post]',
    array(
        'label' => __('Post In Slider', 'magazinemax'),
        'section' => 'home_page_banner_option',
        'type' => 'select',
        'choices' => array(
            '3' => __('3', 'magazinemax'),
            '4' => __('4', 'magazinemax'),
            '5' => __('5', 'magazinemax'),
            '6' => __('6', 'magazinemax'),
        ),
    )
);

$wp_customize->add_setting(
    'magazinemax_options[banner_section_cat]',
    array(
        'default' => $default_options['banner_section_cat'],
        'sanitize_callback' => 'magazinemax_sanitize_select',
    )
);
$wp_customize->add_control(
    'magazinemax_options[banner_section_cat]',
    array(
        'label' => __('Choose Banner Category', 'magazinemax'),
        'section' => 'home_page_banner_option',
        'type' => 'select',
        'choices' => magazinemax_post_category_list(),
    )
);

$wp_customize->add_setting(
    'magazinemax_options[enable_banner_post_description]',
    array(
        'default' => $default_options['enable_banner_post_description'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_banner_post_description]',
    array(
        'label' => __('Enable Post Description', 'magazinemax'),
        'section' => 'home_page_banner_option',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting(
    'magazinemax_options[enable_banner_cat_meta]',
    array(
        'default' => $default_options['enable_banner_cat_meta'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_banner_cat_meta]',
    array(
        'label' => __('Enable Category Meta', 'magazinemax'),
        'section' => 'home_page_banner_option',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting(
    'magazinemax_options[enable_banner_cat_meta_color]',
    array(
        'default' => $default_options['enable_banner_cat_meta_color'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_banner_cat_meta_color]',
    array(
        'label' => __('Enable Background on Categories', 'magazinemax'),
        'section' => 'home_page_banner_option',
        'type' => 'checkbox',
        'active_callback' => 'magazinemax_is_enable_banner_cat_meta'
    )
);


$wp_customize->add_setting(
    'magazinemax_options[enable_banner_author_meta]',
    array(
        'default' => $default_options['enable_banner_author_meta'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_banner_author_meta]',
    array(
        'label' => __('Enable Author Meta', 'magazinemax'),
        'section' => 'home_page_banner_option',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting(
    'magazinemax_options[enable_banner_date_meta]',
    array(
        'default' => $default_options['enable_banner_date_meta'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_banner_date_meta]',
    array(
        'label' => __('Enable Date On Banner', 'magazinemax'),
        'section' => 'home_page_banner_option',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting(
    'magazinemax_options[enable_banner_post_views]',
    array(
        'default' => $default_options['enable_banner_post_views'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_banner_post_views]',
    array(
        'label' => __('Enable Post Views', 'magazinemax'),
        'section' => 'home_page_banner_option',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting(
    'magazinemax_options[enable_banner_overlay]',
    array(
        'default' => $default_options['enable_banner_overlay'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_banner_overlay]',
    array(
        'label' => __('Enable Banner Overlay', 'magazinemax'),
        'section' => 'home_page_banner_option',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting(
    'magazinemax_options[banner_button_text]',
    array(
        'default' => $default_options['banner_button_text'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'magazinemax_options[banner_button_text]',
    array(
        'label' => __('Banner Button Text', 'magazinemax'),
        'section' => 'home_page_banner_option',
        'type' => 'text',
    )
);
