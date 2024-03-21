<?php
/*Header Options*/
$wp_customize->add_section(
    'general_settings',
    array(
        'title' => __('General Settings', 'magazinemax'),
        'panel' => 'magazinemax_option_panel',
    )
);


$wp_customize->add_setting(
    'magazinemax_options[enable_cursor_dot_outline]',
    array(
        'default' => $default_options['enable_cursor_dot_outline'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_cursor_dot_outline]',
    array(
        'label' => esc_html__('Enable Cursor Dot Outline', 'magazinemax'),
        'section' => 'general_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting(
    'magazinemax_options[site_fallback_image]',
    array(
        'default' => $default_options['site_fallback_image'],
        'sanitize_callback' => 'magazinemax_sanitize_image',
    )
);
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'magazinemax_options[site_fallback_image]',
        array(
            'label' => __('Upload Fallback Image', 'magazinemax'),
            'section' => 'general_settings',
        )
    )
);


$wp_customize->add_setting(
    'magazinemax_options[enable_category_meta_color]',
    array(
        'default' => $default_options['enable_category_meta_color'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_category_meta_color]',
    array(
        'label' => esc_html__('Enable Category Meta Color', 'magazinemax'),
        'section' => 'general_settings',
        'type' => 'checkbox',
    )
);
