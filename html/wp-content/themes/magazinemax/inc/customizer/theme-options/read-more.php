<?php
/**/
$wp_customize->add_section(
    'read_more_post_section',
    array(
        'title'      => __( 'Read More Post', 'magazinemax' ),
        'panel'      => 'theme_home_option_panel',
    )
);

/* Home Page Layout */
$wp_customize->add_setting(
    'magazinemax_options[enable_read_more_post_section]',
    array(
        'default'           => $default_options['enable_read_more_post_section'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_read_more_post_section]',
    array(
        'label'   => __( 'Enable Read More Post Section', 'magazinemax' ),
        'section' => 'read_more_post_section',
        'type'    => 'checkbox',
    )
);

$wp_customize->add_setting(
    'magazinemax_options[read_more_post_title]',
    array(
        'default'           => $default_options['read_more_post_title'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'magazinemax_options[read_more_post_title]',
    array(
        'label'    => __( 'Read More Posts Title', 'magazinemax' ),
        'section'  => 'read_more_post_section',
        'type'     => 'text',
    )
);

$wp_customize->add_setting(
    'magazinemax_options[flip_read_more_post_section]',
    array(
        'default'           => $default_options['flip_read_more_post_section'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[flip_read_more_post_section]',
    array(
        'label'   => __( 'Flip Read More Post Section', 'magazinemax' ),
        'section' => 'read_more_post_section',
        'type'    => 'checkbox',
    )
);



$wp_customize->add_setting(
    'magazinemax_options[select_cat_for_read_more_post]',
    array(
        'default'           => $default_options['select_cat_for_read_more_post'],
        'sanitize_callback' => 'magazinemax_sanitize_select',
    )
);
$wp_customize->add_control(
    'magazinemax_options[select_cat_for_read_more_post]',
    array(
        'label'   => __( 'Choose Read More Grid Post Category', 'magazinemax' ),
        'section' => 'read_more_post_section',
            'type'        => 'select',
        'choices'     => magazinemax_post_category_list(),
    )
);


$wp_customize->add_setting(
    'magazinemax_options[select_cat_for_read_more_list_post]',
    array(
        'default'           => $default_options['select_cat_for_read_more_list_post'],
        'sanitize_callback' => 'magazinemax_sanitize_select',
    )
);
$wp_customize->add_control(
    'magazinemax_options[select_cat_for_read_more_list_post]',
    array(
        'label'   => __( 'Choose Read More List Post Category', 'magazinemax' ),
        'section' => 'read_more_post_section',
            'type'        => 'select',
        'choices'     => magazinemax_post_category_list(),
    )
);

$wp_customize->add_setting(
    'magazinemax_options[enable_read_more_category_meta]',
    array(
        'default'           => $default_options['enable_read_more_category_meta'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_read_more_category_meta]',
    array(
        'label'   => __( 'Enable Cateogry Meta', 'magazinemax' ),
        'section' => 'read_more_post_section',
        'type'    => 'checkbox',
    )
);


$wp_customize->add_setting(
    'magazinemax_options[enable_read_more_category_meta_color]',
    array(
        'default'           => $default_options['enable_read_more_category_meta_color'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_read_more_category_meta_color]',
    array(
        'label'   => __( 'Enable Background on Categories', 'magazinemax' ),
        'section' => 'read_more_post_section',
        'type'    => 'checkbox',
        'active_callback' => 'magazinemax_is_enable_read_more_category_meta'
    )
);


$wp_customize->add_setting(
    'magazinemax_options[enable_date_meta]',
    array(
        'default'           => $default_options['enable_date_meta'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_date_meta]',
    array(
        'label'   => __( 'Enable Date Meta', 'magazinemax' ),
        'section' => 'read_more_post_section',
        'type'    => 'checkbox',
    )
);

