<?php
/*Ticker Options*/
$wp_customize->add_section(
    'ticker_options' ,
    array(
        'title' => __( 'Ticker Options', 'magazinemax' ),
        'panel' => 'magazinemax_option_panel',
    )
);

$wp_customize->add_setting(
    'magazinemax_options[enable_ticker_post]',
    array(
        'default' => $default_options['enable_ticker_post'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_ticker_post]',
    array(
        'label' => esc_html__('Enable Ticker/News Post', 'magazinemax'),
        'section' => 'ticker_options',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting(
    'magazinemax_options[ticker_post_title]',
    array(
        'default' => $default_options['ticker_post_title'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'magazinemax_options[ticker_post_title]',
    array(
        'label' => __('Ticker Posts Title', 'magazinemax'),
        'section' => 'ticker_options',
        'type' => 'text',
    )
);

$wp_customize->add_setting(
    'magazinemax_options[ticker_post_category]',
    array(
        'default'           => $default_options['ticker_post_category'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control(new Magazinemax_Dropdown_Taxonomies_Control(
    $wp_customize, 
    'magazinemax_options[ticker_post_category]',
        array(
            'label'           => esc_html__('Ticker/News Post Category', 'magazinemax'),
            'section'         => 'ticker_options',
        )
    )
);