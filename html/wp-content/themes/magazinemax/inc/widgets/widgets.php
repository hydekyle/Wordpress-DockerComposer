<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function magazinemax_widgets_init()
{
    $sidebar_args['sidebar'] = array(
        'name' => __('Sidebar', 'magazinemax'),
        'id' => 'magazinemax-sidebar',
        'description' => __('The sidebar will display any widgets that are added to this region.', 'magazinemax'),
    );

    $sidebar_args['homepage_upper_content_area'] = array(
        'name'        => __( 'Homepage Upper Primary Area', 'magazinemax' ),
        'id'          => 'magazinemax-upper-content-area',
        'description' => __( 'The widgets added to this region will only be visible on main sidebar of the HomePage.', 'magazinemax' ),
    );
    $sidebar_args['homepage_upper_sidebar_area'] = array(
        'name'        => __( 'Homepage Upper Sidebar Area', 'magazinemax' ),
        'id'          => 'magazinemax-upper-sidebar-area',
        'description' => __( 'The widgets added to this region will only be visible on the sidebar of the HomePage.', 'magazinemax' ),
    );
    $sidebar_args['homepage_fullwidth'] = array(
        'name' => __('Homepage Fullwidth', 'magazinemax'),
        'id' => 'magazinemax-homepage-fullwidth',
        'description' => __('Any widgets that are placed in this area will be displayed as fullwidth Homepage section.', 'magazinemax'),
        'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="wrapper">',
        'after_widget'  => "</div></div>",
    );
    $sidebar_args['homepage_lower_content_area'] = array(
        'name'        => __( 'Homepage Lower Primary Area', 'magazinemax' ),
        'id'          => 'magazinemax-lower-content-area',
        'description' => __( 'The widgets added to this region will only be visible on main sidebar of the HomePage.', 'magazinemax' ),
    );
    $sidebar_args['homepage_lower_sidebar_area'] = array(
        'name'        => __( 'Homepage Lower Sidebar Area', 'magazinemax' ),
        'id'          => 'magazinemax-lower-sidebar-area',
        'description' => __( 'The widgets added to this region will only be visible on the sidebar of the HomePage.', 'magazinemax' ),
    );

    $sidebar_args['offcanvas_sidebar'] = array(
        'name' => __('Offcanvas Widget', 'magazinemax'),
        'id' => 'magazinemax-offcanvas-widget',
        'description' => __('Any widgets that are placed in this area will be displayed on the offcanvas sidebar.', 'magazinemax'),
    );


    /*Get homepage sidebar option from the customizer*/
    $front_page_enable_sidebar = magazinemax_get_option('front_page_enable_sidebar');
    if ($front_page_enable_sidebar) {
        $sidebar_args['homepage_sidebar'] = array(
            'name' => __('Homepage Sidebar', 'magazinemax'),
            'id' => 'home-page-sidebar',
            'description' => __('The widgets added to this region will only be visible on the sidebar of the homepage.', 'magazinemax'),
        );
    }

    $sidebar_args['above_footer'] = array(
        'name' => __('Footer Fullwidth', 'magazinemax'),
        'id' => 'fullwidth-footer-widgetarea',
        'description' => __('Widgets added to this region will appear above the footer.', 'magazinemax'),
        'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="wrapper">',
        'after_widget'  => "</div></div>",
    );

    /*Get the footer column from the customizer*/
    $footer_column_layout = magazinemax_get_option('footer_column_layout');
    if ($footer_column_layout) {
        switch ($footer_column_layout) {
            case "footer_layout_1":
                $footer_column = 3;
                break;
            case "footer_layout_2":
                $footer_column = 2;
                break;
            default:
                $footer_column = 3;
        }
    } else {
        $footer_column = 3;
    }

    $cols = intval(apply_filters('magazinemax_footer_widget_columns', $footer_column));

    for ($j = 1; $j <= $cols; $j++) {
        $footer = sprintf('footer_%d', $j);

        $footer_region_name = sprintf(__('Footer Column %1$d', 'magazinemax'), $j);
        $footer_region_description = sprintf(__('Widgets added here will appear in column %1$d of the footer.', 'magazinemax'), $j);

        $sidebar_args[$footer] = array(
            'name' => $footer_region_name,
            'id' => sprintf('footer-%d', $j),
            'description' => $footer_region_description,
        );
    }


    $sidebar_args = apply_filters('magazinemax_sidebar_args', $sidebar_args);

    foreach ($sidebar_args as $sidebar => $args) {
        $widget_tags = array(
            'before_widget' => '<div id="%1$s" class="widget widget-panel %2$s"><div class="widget-content">',
            'after_widget' => '</div></div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        );

        /**
         * Dynamically generated filter hooks. Allow changing widget wrapper and title tags. See example below.
         */
        $filter_hook = sprintf('magazinemax_%s_widget_tags', $sidebar);
        $widget_tags = apply_filters($filter_hook, $widget_tags);

        if (is_array($widget_tags)) {
            register_sidebar($args + $widget_tags);
        }
    }
}

add_action('widgets_init', 'magazinemax_widgets_init');