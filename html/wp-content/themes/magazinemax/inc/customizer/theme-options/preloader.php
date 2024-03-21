<?php
/*Preloader Options*/
$wp_customize->add_section(
    'preloader_options',
    array(
        'title' => __('Preloader Options', 'magazinemax'),
        'panel' => 'magazinemax_option_panel',
    )
);

/*Show Preloader*/
$wp_customize->add_setting(
    'magazinemax_options[show_preloader]',
    array(
        'default' => $default_options['show_preloader'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[show_preloader]',
    array(
        'label' => __('Show Preloader', 'magazinemax'),
        'section' => 'preloader_options',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting(
    'magazinemax_options[preloader_style]',
    array(
        'default' => $default_options['preloader_style'],
        'sanitize_callback' => 'magazinemax_sanitize_select',
    )
);
$wp_customize->add_control(
    'magazinemax_options[preloader_style]',
    array(
        'label' => __('Preloader Style', 'magazinemax'),
        'section' => 'preloader_options',
        'type' => 'select',
        'choices' => array(
            'theme-preloader-spinner-1' => __('Style 1', 'magazinemax'),
            'theme-preloader-spinner-2' => __('Style 2', 'magazinemax'),
            'theme-preloader-spinner-3' => __('Style 3', 'magazinemax'),
            'theme-preloader-spinner-4' => __('Style 4', 'magazinemax'),
        ),
        'active_callback' => 'magazinemax_is_show_preloader',

    )
);
