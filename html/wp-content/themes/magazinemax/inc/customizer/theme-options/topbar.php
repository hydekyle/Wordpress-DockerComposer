<?php
$wp_customize->add_section(
    'topbar_options',
    array(
        'title' => __('Topbar Options', 'magazinemax'),
        'panel' => 'magazinemax_option_panel',
    )
);

/*Enable Top Bar*/
$wp_customize->add_setting(
    'magazinemax_options[enable_top_bar]',
    array(
        'default' => $default_options['enable_top_bar'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_top_bar]',
    array(
        'label' => __('Enable Top Bar', 'magazinemax'),
        'section' => 'topbar_options',
        'type' => 'checkbox',
    )
);

/*Hide Top Bar on Mobile*/
$wp_customize->add_setting(
    'magazinemax_options[hide_topbar_on_mobile]',
    array(
        'default' => $default_options['hide_topbar_on_mobile'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[hide_topbar_on_mobile]',
    array(
        'label' => __('Hide Top Bar on Mobile', 'magazinemax'),
        'section' => 'topbar_options',
        'type' => 'checkbox',
        'active_callback' => 'magazinemax_is_top_bar_enabled'
    )
);

/*Enable Today's Date*/
$wp_customize->add_setting(
    'magazinemax_options[enable_topbar_time]',
    array(
        'default' => $default_options['enable_topbar_time'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_topbar_time]',
    array(
        'label' => __('Enable Current Time', 'magazinemax'),
        'section' => 'topbar_options',
        'type' => 'checkbox',
        'active_callback' => 'magazinemax_is_top_bar_enabled'
    )
);

/*Enable Today's Date*/
$wp_customize->add_setting(
    'magazinemax_options[enable_topbar_date]',
    array(
        'default' => $default_options['enable_topbar_date'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_topbar_date]',
    array(
        'label' => __('Enable Today\'s Date', 'magazinemax'),
        'section' => 'topbar_options',
        'type' => 'checkbox',
        'active_callback' => 'magazinemax_is_top_bar_enabled'
    )
);

/*Todays Date Format*/
$wp_customize->add_setting(
    'magazinemax_options[todays_date_format]',
    array(
        'default' => $default_options['todays_date_format'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'magazinemax_options[todays_date_format]',
    array(
        'label' => __('Today\'s Date Format', 'magazinemax'),
        'description' => sprintf(wp_kses(__('<a href="%s" target="_blank">Date and Time Formatting Documentation</a>.', 'magazinemax'), array('a' => array('href' => array(), 'target' => array()))), esc_url('https://wordpress.org/support/article/formatting-date-and-time')),
        'section' => 'topbar_options',
        'type' => 'text',
        'active_callback' => function ($control) {
            return (
                magazinemax_is_top_bar_enabled($control)
                &&
                magazinemax_is_todays_date_enabled($control)
            );
        }
    )
);

/*Enable Top Social Nav*/
$wp_customize->add_setting(
    'magazinemax_options[enable_topbar_social_icons]',
    array(
        'default' => $default_options['enable_topbar_social_icons'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_topbar_social_icons]',
    array(
        'label' => __('Enable Top Bar Social Nav Menu', 'magazinemax'),
        'description' => sprintf(__('You can add/edit social nav menu from <a href="%s">here</a>.', 'magazinemax'), "javascript:wp.customize.control( 'nav_menu_locations[social-menu]' ).focus();"),
        'section' => 'topbar_options',
        'type' => 'checkbox',
        'active_callback' => 'magazinemax_is_top_bar_enabled'
    )
);

/*Enable Top Nav*/
$wp_customize->add_setting(
    'magazinemax_options[enable_topbar_nav]',
    array(
        'default' => $default_options['enable_topbar_nav'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_topbar_nav]',
    array(
        'label' => __('Enable Top Bar Nav Menu', 'magazinemax'),
        'description' => sprintf(__('You can add/edit top nav menu from <a href="%s">here</a>.', 'magazinemax'), "javascript:wp.customize.control( 'nav_menu_locations[top-menu]' ).focus();"),
        'section' => 'topbar_options',
        'type' => 'checkbox',
        'active_callback' => 'magazinemax_is_top_bar_enabled'
    )
);

/*Top Bar background Color*/
$wp_customize->add_setting(
    'magazinemax_options[top_bar_bg_color]',
    array(
        'default' => $default_options['top_bar_bg_color'],
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'magazinemax_options[top_bar_bg_color]',
        array(
            'label' => __('Top Bar Background Color', 'magazinemax'),
            'section' => 'topbar_options',
            'type' => 'color',
            'active_callback' => 'magazinemax_is_top_bar_enabled'
        )
    )
);

$wp_customize->add_setting(
    'magazinemax_options[top_bar_text_color]',
    array(
        'default' => $default_options['top_bar_text_color'],
        'sanitize_callback' => 'sanitize_hex_color',
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'magazinemax_options[top_bar_text_color]',
        array(
            'label' => __('Top Bar Text Color', 'magazinemax'),
            'section' => 'topbar_options',
            'type' => 'color',
            'active_callback' => 'magazinemax_is_top_bar_enabled'
        )
    )
);

/*Enable Search*/
$wp_customize->add_setting(
    'magazinemax_options[enable_search_on_header]',
    array(
        'default' => $default_options['enable_search_on_header'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_search_on_header]',
    array(
        'label' => __('Enable Search Icon', 'magazinemax'),
        'section' => 'header_options',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting(
    'magazinemax_section_seperator_header_3',
    array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    new Magazinemax_Seperator_Control(
        $wp_customize,
        'magazinemax_section_seperator_header_3',
        array(
            'settings' => 'magazinemax_section_seperator_header_3',
            'section' => 'header_options',
        )
    )
);

$wp_customize->add_setting(
    'magazinemax_options[enable_random_post]',
    array(
        'default' => $default_options['enable_random_post'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[enable_random_post]',
    array(
        'label' => esc_html__('Enable Random Post', 'magazinemax'),
        'section' => 'header_options',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting(
    'magazinemax_options[random_post_title]',
    array(
        'default' => $default_options['random_post_title'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'magazinemax_options[random_post_title]',
    array(
        'label' => __('Random Posts Title', 'magazinemax'),
        'section' => 'header_options',
        'type' => 'text',
    )
);

$wp_customize->add_setting(
    'magazinemax_options[random_post_category]',
    array(
        'default' => $default_options['random_post_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control(new Magazinemax_Dropdown_Taxonomies_Control(
        $wp_customize,
        'magazinemax_options[random_post_category]',
        array(
            'label' => esc_html__('Random Post Category', 'magazinemax'),
            'section' => 'header_options',
        )
    )
);


/* ========== Progressbar Section. ==========*/
$wp_customize->add_section(
    'progressbar_options',
    array(
        'title' => __('Progressbar Options', 'magazinemax'),
        'panel' => 'magazinemax_option_panel',
    )
);
/*Show progressbar*/
$wp_customize->add_setting(
    'magazinemax_options[show_progressbar]',
    array(
        'default' => $default_options['show_progressbar'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[show_progressbar]',
    array(
        'label' => __('Show Progressbar', 'magazinemax'),
        'section' => 'progressbar_options',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting(
    'magazinemax_options[progressbar_position]',
    array(
        'default' => $default_options['progressbar_position'],
        'sanitize_callback' => 'magazinemax_sanitize_select',
    )
);
$wp_customize->add_control(
    'magazinemax_options[progressbar_position]',
    array(
        'label' => __('Progressbar Position', 'magazinemax'),
        'section' => 'progressbar_options',
        'type' => 'select',
        'choices' => array(
            'top' => __('Top', 'magazinemax'),
            'bottom' => __('Bottom of the browser window', 'magazinemax'),
        ),
        'active_callback' => 'magazinemax_is_progressbar_enabled',
    )
);

$wp_customize->add_setting(
    'magazinemax_options[progressbar_color]',
    array(
        'default' => $default_options['progressbar_color'],
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'magazinemax_options[progressbar_color]',
        array(
            'label' => __('Progressbar Color', 'magazinemax'),
            'section' => 'progressbar_options',
            'type' => 'color',
            'active_callback' => 'magazinemax_is_progressbar_enabled',
        )
    )
);