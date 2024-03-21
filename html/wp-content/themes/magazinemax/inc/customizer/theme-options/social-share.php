<?php
/**
 * Social Share Settings.
 *
 * @package Magazinemax
 **/
// Layout Section.
$wp_customize->add_section('social_share',
    array(
        'title' => esc_html__('Social Share Settings', 'magazinemax'),
        'capability' => 'edit_theme_options',
        'panel' => 'magazinemax_option_panel',
    )
);

$wp_customize->add_setting(
    'magazinemax_options[enable_facebook]',
    array(
        'default' => $default_options['enable_facebook'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_facebook]',
    array(
        'label' => esc_html__('Enable Facebook', 'magazinemax'),
        'section' => 'social_share',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting(
    'magazinemax_options[enable_twitter]',
    array(
        'default' => $default_options['enable_twitter'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_twitter]',
    array(
        'label' => esc_html__('Enable Twitter', 'magazinemax'),
        'section' => 'social_share',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting(
    'magazinemax_options[enable_pinterest]',
    array(
        'default' => $default_options['enable_pinterest'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_pinterest]',
    array(
        'label' => esc_html__('Enable Pinterest', 'magazinemax'),
        'section' => 'social_share',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting(
    'magazinemax_options[enable_linkedin]',
    array(
        'default' => $default_options['enable_linkedin'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_linkedin]',
    array(
        'label' => esc_html__('Enable LinkedIn', 'magazinemax'),
        'section' => 'social_share',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting(
    'magazinemax_options[enable_telegram]',
    array(
        'default' => $default_options['enable_telegram'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_telegram]',
    array(
        'label' => esc_html__('Enable Telegram', 'magazinemax'),
        'section' => 'social_share',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting(
    'magazinemax_options[enable_reddit]',
    array(
        'default' => $default_options['enable_reddit'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_reddit]',
    array(
        'label' => esc_html__('Enable Reddit', 'magazinemax'),
        'section' => 'social_share',
        'type' => 'checkbox',
    )
);




$wp_customize->add_setting(
    'magazinemax_options[enable_stumbleupon]',
    array(
        'default' => $default_options['enable_stumbleupon'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_stumbleupon]',
    array(
        'label' => esc_html__('Enable Stumbleupon', 'magazinemax'),
        'section' => 'social_share',
        'type' => 'checkbox',
    )
);



$wp_customize->add_setting(
    'magazinemax_options[enable_whatsapp]',
    array(
        'default' => $default_options['enable_whatsapp'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_whatsapp]',
    array(
        'label' => esc_html__('Enable Whatsapp', 'magazinemax'),
        'section' => 'social_share',
        'type' => 'checkbox',
    )
);



$wp_customize->add_setting(
    'magazinemax_options[enable_email]',
    array(
        'default' => $default_options['enable_email'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_email]',
    array(
        'label' => esc_html__('Enable Email', 'magazinemax'),
        'section' => 'social_share',
        'type' => 'checkbox',
    )
);

