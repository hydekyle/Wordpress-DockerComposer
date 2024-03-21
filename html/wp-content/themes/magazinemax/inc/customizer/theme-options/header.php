<?php
$wp_customize->add_setting(
    'magazinemax_options[enable_header_bg_overlay]',
    array(
        'default' => $default_options['enable_header_bg_overlay'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_header_bg_overlay]',
    array(
        'label' => __('Enable Image Overlay', 'magazinemax'),
        'section' => 'header_image',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting(
    'magazinemax_options[header_image_size]',
    array(
        'default' => $default_options['header_image_size'],
        'sanitize_callback' => 'magazinemax_sanitize_select',
    )
);
$wp_customize->add_control(
    'magazinemax_options[header_image_size]',
    array(
        'label' => __('Select Header Size', 'magazinemax'),
        'description' => __('Some options related to header may not show in the front-end based on header style chosen.', 'magazinemax'),

        'section' => 'header_image',
        'type' => 'select',
        'choices' => array(
            'none' => __('Default', 'magazinemax'),
            'small' => __('Small', 'magazinemax'),
            'medium' => __('Medium', 'magazinemax'),
            'large' => __('Large', 'magazinemax'),
        ),
    )
);
/*Header Options*/
$wp_customize->add_section(
    'header_options',
    array(
        'title' => __('Header Options', 'magazinemax'),
        'panel' => 'magazinemax_option_panel',
    )
);

$wp_customize->add_setting(
    'magazinemax_section_seperator_header_1',
    array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    new Magazinemax_Seperator_Control(
        $wp_customize,
        'magazinemax_section_seperator_header_1',
        array(
            'settings' => 'magazinemax_section_seperator_header_1',
            'section' => 'header_options',
        )
    )
);

/*Enable Sticky Menu*/
$wp_customize->add_setting(
    'magazinemax_options[enable_sticky_menu]',
    array(
        'default' => $default_options['enable_sticky_menu'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_sticky_menu]',
    array(
        'label' => __('Enable Sticky Menu', 'magazinemax'),
        'section' => 'header_options',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting(
    'magazinemax_section_seperator_header_4',
    array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    new Magazinemax_Seperator_Control(
        $wp_customize,
        'magazinemax_section_seperator_header_4',
        array(
            'settings' => 'magazinemax_section_seperator_header_4',
            'section' => 'header_options',
        )
    )
);


if (class_exists('WooCommerce')) {

    /*Enable Mini Cart Icon on header*/
    $wp_customize->add_setting(
        'magazinemax_options[enable_mini_cart_header]',
        array(
            'default' => $default_options['enable_mini_cart_header'],
            'sanitize_callback' => 'magazinemax_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
        'magazinemax_options[enable_mini_cart_header]',
        array(
            'label' => __('Enable Mini Cart Icon', 'magazinemax'),
            'section' => 'header_options',
            'type' => 'checkbox',
        )
    );

    /*Enable Myaccount Link*/
    $wp_customize->add_setting(
        'magazinemax_options[enable_woo_my_account]',
        array(
            'default' => $default_options['enable_woo_my_account'],
            'sanitize_callback' => 'magazinemax_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
        'magazinemax_options[enable_woo_my_account]',
        array(
            'label' => __('Enable My Account Icon', 'magazinemax'),
            'section' => 'header_options',
            'type' => 'checkbox',
        )
    );
}