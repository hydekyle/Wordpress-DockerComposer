<?php

$wp_customize->add_section(
    'single_options',
    array(
        'title' => __('Single Options', 'magazinemax'),
        'panel' => 'magazinemax_option_panel',
    )
);

/* Global Layout*/
$wp_customize->add_setting(
    'magazinemax_options[single_sidebar_layout]',
    array(
        'default' => $default_options['single_sidebar_layout'],
        'sanitize_callback' => 'magazinemax_sanitize_radio',
    )
);
$wp_customize->add_control(
    new Magazinemax_Radio_Image_Control(
        $wp_customize,
        'magazinemax_options[single_sidebar_layout]',
        array(
            'label' => __('Single Sidebar Layout', 'magazinemax'),
            'section' => 'single_options',
            'choices' => magazinemax_get_general_layouts()
        )
    )
);


$wp_customize->add_setting(
    'magazinemax_options[magazinemax_single_post_layout]',
    array(
        'default' => $default_options['magazinemax_single_post_layout'],
        'sanitize_callback' => 'magazinemax_sanitize_select',
    )
);
$wp_customize->add_control(
    'magazinemax_options[magazinemax_single_post_layout]',
    array(
        'label' => __('Header Appearance Layout', 'magazinemax'),
        'section' => 'single_options',
        'type' => 'select',
        'choices' => array(
            'layout-1' => esc_html__('Header Classic Layout', 'magazinemax'),
            'layout-2' => esc_html__('Header Banner Layout', 'magazinemax'),
            'layout-3' => esc_html__('Header Banner Layout 2', 'magazinemax'),
        ),
    )
);


$wp_customize->add_setting(
    'magazinemax_options[magazinemax_single_post_header_overlay]',
    array(
        'default' => $default_options['magazinemax_single_post_header_overlay'],
        'sanitize_callback' => 'magazinemax_sanitize_select',
    )
);
$wp_customize->add_control(
    'magazinemax_options[magazinemax_single_post_header_overlay]',
    array(
        'label' => __('Single Post Header Overlay', 'magazinemax'),
        'section' => 'single_options',
        'type' => 'select',
        'choices' => array(
            'featured-banner-overlay-disable' => esc_html__('Disable Header Overlay', 'magazinemax'),
            'featured-banner-overlay' => esc_html__('Enable Header Overlay', 'magazinemax'),
        ),
    )
);


$wp_customize->add_setting(
    'magazinemax_section_seperator_single_1',
    array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);

// Hide Side Bar on Mobile
$wp_customize->add_setting(
    'magazinemax_options[hide_single_sidebar_mobile]',
    array(
        'default' => $default_options['hide_single_sidebar_mobile'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[hide_single_sidebar_mobile]',
    array(
        'label' => __('Hide Single Sidebar on Mobile', 'magazinemax'),
        'section' => 'single_options',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting(
    'magazinemax_options[magazinemax_single_post_style]',
    array(
        'default' => $default_options['magazinemax_single_post_style'],
        'sanitize_callback' => 'magazinemax_sanitize_select',
    )
);
$wp_customize->add_control(
    'magazinemax_options[magazinemax_single_post_style]',
    array(
        'label' => __('Single Post Style', 'magazinemax'),
        'section' => 'single_options',
        'type' => 'select',
        'choices' => array(
            'style-1' => esc_html__('Layout Style 1', 'magazinemax'),
            'style-2' => esc_html__('Layout Style 2', 'magazinemax'),
        ),
    )
);

$wp_customize->add_setting(
    'magazinemax_section_seperator_single_11',
    array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    new Magazinemax_Seperator_Control(
        $wp_customize,
        'magazinemax_section_seperator_single_11',
        array(
            'settings' => 'magazinemax_section_seperator_single_11',
            'section' => 'single_options',
        )
    )
);

/* Post Meta */
$wp_customize->add_setting(
    'magazinemax_options[single_post_meta]',
    array(
        'default' => $default_options['single_post_meta'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox_multiple',
    )
);
$wp_customize->add_control(
    new Magazinemax_Checkbox_Multiple(
        $wp_customize,
        'magazinemax_options[single_post_meta]',
        array(
            'label' => __('Single Post Meta', 'magazinemax'),
            'description' => __('Choose the post meta you want to be displayed on post detail page', 'magazinemax'),
            'section' => 'single_options',
            'choices' => array(
                'author' => __('Author', 'magazinemax'),
                'date' => __('Date', 'magazinemax'),
                'comment' => __('Comment', 'magazinemax'),
                'category' => __('Category', 'magazinemax'),
                'tags' => __('Tags', 'magazinemax'),
            )
        )
    )
);


$wp_customize->add_setting(
    'magazinemax_section_seperator_single_5',
    array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    new Magazinemax_Seperator_Control(
        $wp_customize,
        'magazinemax_section_seperator_single_5',
        array(
            'settings' => 'magazinemax_section_seperator_single_5',
            'section' => 'single_options',
        )
    )
);


$wp_customize->add_setting(
    'magazinemax_options[show_sticky_article_navigation]',
    array(
        'default' => $default_options['show_sticky_article_navigation'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[show_sticky_article_navigation]',
    array(
        'label' => __('Show Sticky Article Navigation', 'magazinemax'),
        'section' => 'single_options',
        'type' => 'checkbox',
    )
);

/*Show Author Info Box start
*-------------------------------*/
$wp_customize->add_setting(
    'magazinemax_section_seperator_single_2',
    array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    new Magazinemax_Seperator_Control(
        $wp_customize,
        'magazinemax_section_seperator_single_2',
        array(
            'settings' => 'magazinemax_section_seperator_single_2',
            'section' => 'single_options',
        )
    )
);

$wp_customize->add_setting(
    'magazinemax_options[show_author_info]',
    array(
        'default' => $default_options['show_author_info'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[show_author_info]',
    array(
        'label' => __('Show Author Info Box', 'magazinemax'),
        'section' => 'single_options',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting(
    'magazinemax_section_seperator_single_3',
    array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    new Magazinemax_Seperator_Control(
        $wp_customize,
        'magazinemax_section_seperator_single_3',
        array(
            'settings' => 'magazinemax_section_seperator_single_3',
            'section' => 'single_options',
        )
    )
);

/*Show Related Posts
*-------------------------------*/
$wp_customize->add_setting(
    'magazinemax_options[show_related_posts]',
    array(
        'default' => $default_options['show_related_posts'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[show_related_posts]',
    array(
        'label' => __('Show Related Posts', 'magazinemax'),
        'section' => 'single_options',
        'type' => 'checkbox',
    )
);

/*Related Posts Text.*/
$wp_customize->add_setting(
    'magazinemax_options[related_posts_text]',
    array(
        'default' => $default_options['related_posts_text'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'magazinemax_options[related_posts_text]',
    array(
        'label' => __('Related Posts Text', 'magazinemax'),
        'section' => 'single_options',
        'type' => 'text',
        'active_callback' => 'magazinemax_is_related_posts_enabled',
    )
);

/* Number of Related Posts */
$wp_customize->add_setting(
    'magazinemax_options[no_of_related_posts]',
    array(
        'default' => $default_options['no_of_related_posts'],
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control(
    'magazinemax_options[no_of_related_posts]',
    array(
        'label' => __('Number of Related Posts', 'magazinemax'),
        'section' => 'single_options',
        'type' => 'number',
        'active_callback' => 'magazinemax_is_related_posts_enabled',
    )
);

/*Related Posts Orderby*/
$wp_customize->add_setting(
    'magazinemax_options[related_posts_orderby]',
    array(
        'default' => $default_options['related_posts_orderby'],
        'sanitize_callback' => 'magazinemax_sanitize_select',
    )
);
$wp_customize->add_control(
    'magazinemax_options[related_posts_orderby]',
    array(
        'label' => __('Orderby', 'magazinemax'),
        'section' => 'single_options',
        'type' => 'select',
        'choices' => array(
            'date' => __('Date', 'magazinemax'),
            'id' => __('ID', 'magazinemax'),
            'title' => __('Title', 'magazinemax'),
            'rand' => __('Random', 'magazinemax'),
        ),
        'active_callback' => 'magazinemax_is_related_posts_enabled',
    )
);

/*Related Posts Order*/
$wp_customize->add_setting(
    'magazinemax_options[related_posts_order]',
    array(
        'default' => $default_options['related_posts_order'],
        'sanitize_callback' => 'magazinemax_sanitize_select',
    )
);
$wp_customize->add_control(
    'magazinemax_options[related_posts_order]',
    array(
        'label' => __('Order', 'magazinemax'),
        'section' => 'single_options',
        'type' => 'select',
        'choices' => array(
            'asc' => __('ASC', 'magazinemax'),
            'desc' => __('DESC', 'magazinemax'),
        ),
        'active_callback' => 'magazinemax_is_related_posts_enabled',
    )
);

$wp_customize->add_setting(
    'magazinemax_section_seperator_single_4',
    array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);

$wp_customize->add_control(
    new Magazinemax_Seperator_Control(
        $wp_customize,
        'magazinemax_section_seperator_single_4',
        array(
            'settings' => 'magazinemax_section_seperator_single_4',
            'section' => 'single_options',
        )
    )
);
/*Show Author Posts
*-----------------------------------------*/
$wp_customize->add_setting(
    'magazinemax_options[show_author_posts]',
    array(
        'default' => $default_options['show_author_posts'],
        'sanitize_callback' => 'magazinemax_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    'magazinemax_options[show_author_posts]',
    array(
        'label' => __('Show Author Posts', 'magazinemax'),
        'section' => 'single_options',
        'type' => 'checkbox',
    )
);

/*Author Posts Text.*/
$wp_customize->add_setting(
    'magazinemax_options[author_posts_text]',
    array(
        'default' => $default_options['author_posts_text'],
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    'magazinemax_options[author_posts_text]',
    array(
        'label' => __('Author Posts Text', 'magazinemax'),
        'section' => 'single_options',
        'type' => 'text',
        'active_callback' => 'magazinemax_is_author_posts_enabled',
    )
);

/* Number of Author Posts */
$wp_customize->add_setting(
    'magazinemax_options[no_of_author_posts]',
    array(
        'default' => $default_options['no_of_author_posts'],
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control(
    'magazinemax_options[no_of_author_posts]',
    array(
        'label' => __('Number of Author Posts', 'magazinemax'),
        'section' => 'single_options',
        'type' => 'number',
        'active_callback' => 'magazinemax_is_author_posts_enabled',
    )
);

/*Author Posts Orderby*/
$wp_customize->add_setting(
    'magazinemax_options[author_posts_orderby]',
    array(
        'default' => $default_options['author_posts_orderby'],
        'sanitize_callback' => 'magazinemax_sanitize_select',
    )
);
$wp_customize->add_control(
    'magazinemax_options[author_posts_orderby]',
    array(
        'label' => __('Orderby', 'magazinemax'),
        'section' => 'single_options',
        'type' => 'select',
        'choices' => array(
            'date' => __('Date', 'magazinemax'),
            'id' => __('ID', 'magazinemax'),
            'title' => __('Title', 'magazinemax'),
            'rand' => __('Random', 'magazinemax'),
        ),
        'active_callback' => 'magazinemax_is_author_posts_enabled',
    )
);

/*Author Posts Order*/
$wp_customize->add_setting(
    'magazinemax_options[author_posts_order]',
    array(
        'default' => $default_options['author_posts_order'],
        'sanitize_callback' => 'magazinemax_sanitize_select',
    )
);
$wp_customize->add_control(
    'magazinemax_options[author_posts_order]',
    array(
        'label' => __('Order', 'magazinemax'),
        'section' => 'single_options',
        'type' => 'select',
        'choices' => array(
            'asc' => __('ASC', 'magazinemax'),
            'desc' => __('DESC', 'magazinemax'),
        ),
        'active_callback' => 'magazinemax_is_author_posts_enabled',
    )
);