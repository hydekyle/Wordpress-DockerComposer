<?php
$wp_customize->add_section(
    'pagination_options',
    array(
        'title' => __('Pagination Options', 'magazinemax'),
        'panel' => 'magazinemax_option_panel',
    )
);

/* Pagination Type*/
$wp_customize->add_setting(
    'magazinemax_options[pagination_type]',
    array(
        'default' => $default_options['pagination_type'],
        'sanitize_callback' => 'magazinemax_sanitize_select',
    )
);
$wp_customize->add_control(
    'magazinemax_options[pagination_type]',
    array(
        'label' => __('Pagination Type', 'magazinemax'),
        'section' => 'pagination_options',
        'type' => 'select',
        'choices' => array(
            'default' => __('Default (Older / Newer Post)', 'magazinemax'),
            'numeric' => __('Numeric', 'magazinemax'),
            'ajax_load_on_click' => __('Load more post on click', 'magazinemax'),
            'ajax_load_on_scroll' => __('Load more posts on scroll', 'magazinemax'),
        ),
    )
);
