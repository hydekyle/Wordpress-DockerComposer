<?php
/**/
$wp_customize->add_section(
    'three_col_banner_option',
    array(
        'title' => __('3 Column Hero Banner', 'magazinemax'),
        'panel' => 'theme_home_option_panel',
    )
);

/* Home Page Layout */
$wp_customize->add_setting(
    'magazinemax_options[enable_three_col_hero_banner]',
    array(
        'default' => $default_options['enable_three_col_hero_banner'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_three_col_hero_banner]',
    array(
        'label' => __('Enable 3 Column Hero Banner', 'magazinemax'),
        'section' => 'three_col_banner_option',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting(
    'magazinemax_options[three_col_banner_cat_1]',
    array(
        'default' => $default_options['three_col_banner_cat_1'],
        'sanitize_callback' => 'magazinemax_sanitize_select',
    )
);
$wp_customize->add_control(
    'magazinemax_options[three_col_banner_cat_1]',
    array(
        'label' => __('Choose Column Banner Category Sec - 1', 'magazinemax'),
        'section' => 'three_col_banner_option',
        'type' => 'select',
        'choices' => magazinemax_post_category_list(),
    )
);


$wp_customize->add_setting(
    'magazinemax_options[three_col_banner_cat_3]',
    array(
        'default' => $default_options['three_col_banner_cat_3'],
        'sanitize_callback' => 'magazinemax_sanitize_select',
    )
);
$wp_customize->add_control(
    'magazinemax_options[three_col_banner_cat_3]',
    array(
        'label' => __('Choose Column Banner Category Sec - 3', 'magazinemax'),
        'section' => 'three_col_banner_option',
        'type' => 'select',
        'choices' => magazinemax_post_category_list(),
    )
);