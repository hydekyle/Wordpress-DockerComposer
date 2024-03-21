<?php
/**/
$wp_customize->add_section(
    'home_page_jumbotron_option',
    array(
        'title' => __('Jumbotron Options', 'magazinemax'),
        'panel' => 'theme_home_option_panel',
    )
);

/* Home Page Layout */
$wp_customize->add_setting(
    'magazinemax_options[enable_jumbotron_section]',
    array(
        'default' => $default_options['enable_jumbotron_section'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_jumbotron_section]',
    array(
        'label' => __('Enable Jumbotron Section', 'magazinemax'),
        'section' => 'home_page_jumbotron_option',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting(
    'magazinemax_options[jumbotron_section_cat]',
    array(
        'default' => $default_options['jumbotron_section_cat'],
        'sanitize_callback' => 'magazinemax_sanitize_select',
    )
);
$wp_customize->add_control(
    'magazinemax_options[jumbotron_section_cat]',
    array(
        'label' => __('Choose Jumbotron Category', 'magazinemax'),
        'section' => 'home_page_jumbotron_option',
        'type' => 'select',
        'choices' => magazinemax_post_category_list(),
    )
);


$wp_customize->add_setting(
    'magazinemax_options[enable_jumbotron_cat_meta]',
    array(
        'default' => $default_options['enable_jumbotron_cat_meta'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_jumbotron_cat_meta]',
    array(
        'label' => __('Enable Category', 'magazinemax'),
        'section' => 'home_page_jumbotron_option',
        'type' => 'checkbox',
    )
);



$wp_customize->add_setting(
    'magazinemax_options[enable_jumbotron_cat_meta_bg_color]',
    array(
        'default' => $default_options['enable_jumbotron_cat_meta_bg_color'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_jumbotron_cat_meta_bg_color]',
    array(
        'label' => __('Enable Background on Categories', 'magazinemax'),
        'section' => 'home_page_jumbotron_option',
        'type' => 'checkbox',
        'active_callback' => 'magazinemax_is_enable_jumbotron_cat_meta'
    )
);


$wp_customize->add_setting(
    'magazinemax_options[enable_jumbotron_author_meta]',
    array(
        'default' => $default_options['enable_jumbotron_author_meta'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_jumbotron_author_meta]',
    array(
        'label' => __('Enable Author', 'magazinemax'),
        'section' => 'home_page_jumbotron_option',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting(
    'magazinemax_options[enable_jumbotron_date_meta]',
    array(
        'default' => $default_options['enable_jumbotron_date_meta'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_jumbotron_date_meta]',
    array(
        'label' => __('Enable Date', 'magazinemax'),
        'section' => 'home_page_jumbotron_option',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting(
    'magazinemax_options[enable_jumbotron_post_views]',
    array(
        'default' => $default_options['enable_jumbotron_post_views'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_jumbotron_post_views]',
    array(
        'label' => __('Enable Post Views', 'magazinemax'),
        'section' => 'home_page_jumbotron_option',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting(
    'magazinemax_options[jumbotron_bg_color]',
    array(
        'default' => $default_options['jumbotron_bg_color'],
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'magazinemax_options[jumbotron_bg_color]',
        array(
            'label' => __('Background Color', 'magazinemax'),
            'section' => 'home_page_jumbotron_option',
            'type' => 'color',
        )
    )
);

$wp_customize->add_setting(
    'magazinemax_options[jumbotron_text_color]',
    array(
        'default' => $default_options['jumbotron_text_color'],
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'magazinemax_options[jumbotron_text_color]',
        array(
            'label' => __('Text Color', 'magazinemax'),
            'section' => 'home_page_jumbotron_option',
            'type' => 'color',
        )
    )
);
