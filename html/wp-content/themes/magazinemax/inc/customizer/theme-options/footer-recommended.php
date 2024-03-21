<?php
/**/
$wp_customize->add_section(
    'footer_recommended_post_section',
    array(
        'title' => __('Footer Related Post', 'magazinemax'),
        'panel' => 'magazinemax_option_panel',
    )
);
/* Home Page Layout */
$wp_customize->add_setting(
    'magazinemax_options[enable_footer_recommended_post_section]',
    array(
        'default' => $default_options['enable_footer_recommended_post_section'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_footer_recommended_post_section]',
    array(
        'label' => __('Enable Footer Related Post Section', 'magazinemax'),
        'section' => 'footer_recommended_post_section',
        'type' => 'checkbox',
    )
);
$wp_customize->add_setting(
    'magazinemax_options[footer_recommended_post_title]',
    array(
        'default' => $default_options['footer_recommended_post_title'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'magazinemax_options[footer_recommended_post_title]',
    array(
        'label' => __('Footer Recoommended Posts Title', 'magazinemax'),
        'section' => 'footer_recommended_post_section',
        'type' => 'text',
    )
);
$wp_customize->add_setting(
    'magazinemax_options[select_cat_for_footer_recommended_post]',
    array(
        'default' => $default_options['select_cat_for_footer_recommended_post'],
        'sanitize_callback' => 'magazinemax_sanitize_select',
    )
);
$wp_customize->add_control(
    'magazinemax_options[select_cat_for_footer_recommended_post]',
    array(
        'label' => __('Choose Footer Related Post Category', 'magazinemax'),
        'section' => 'footer_recommended_post_section',
        'type' => 'select',
        'choices' => magazinemax_post_category_list(),
    )
);
$wp_customize->add_setting(
    'magazinemax_options[enable_category_meta]',
    array(
        'default' => $default_options['enable_category_meta'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_category_meta]',
    array(
        'label' => __('Enable Category Meta', 'magazinemax'),
        'section' => 'footer_recommended_post_section',
        'type' => 'checkbox',
    )
);
$wp_customize->add_setting(
    'magazinemax_options[enable_post_excerpt]',
    array(
        'default' => $default_options['enable_post_excerpt'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_post_excerpt]',
    array(
        'label' => __('Enable Post Excerpt Meta', 'magazinemax'),
        'section' => 'footer_recommended_post_section',
        'type' => 'checkbox',
    )
);
$wp_customize->add_setting(
    'magazinemax_options[enable_date_meta]',
    array(
        'default' => $default_options['enable_date_meta'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_date_meta]',
    array(
        'label' => __('Enable Date Meta', 'magazinemax'),
        'section' => 'footer_recommended_post_section',
        'type' => 'checkbox',
    )
);
$wp_customize->add_setting(
    'magazinemax_options[enable_author_meta]',
    array(
        'default' => $default_options['enable_author_meta'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_author_meta]',
    array(
        'label' => __('Enable Author Meta', 'magazinemax'),
        'section' => 'footer_recommended_post_section',
        'type' => 'checkbox',
    )
);
$wp_customize->add_setting(
    'magazinemax_options[enable_post_views]',
    array(
        'default' => $default_options['enable_post_views'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_post_views]',
    array(
        'label' => __('Enable Post Views', 'magazinemax'),
        'section' => 'footer_recommended_post_section',
        'type' => 'checkbox',
    )
);
