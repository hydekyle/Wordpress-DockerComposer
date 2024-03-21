<?php

/* Theme Widget sidebars. */
require get_template_directory() . '/inc/widgets/widgets.php';
require get_template_directory() . '/inc/widgets/widget-base/widgetbase.php';

require get_template_directory() . '/inc/widgets/class-recent-widget.php';
require get_template_directory() . '/inc/widgets/class-social-widget.php';
require get_template_directory() . '/inc/widgets/class-newsletter-widget.php';
require get_template_directory() . '/inc/widgets/class-tab-widget.php';
require get_template_directory() . '/inc/widgets/class-cta-widget.php';
require get_template_directory() . '/inc/widgets/class-image-widget.php';
require get_template_directory() . '/inc/widgets/class-recent-grid-widget.php';
require get_template_directory() . '/inc/widgets/class-carousel-widget.php';
require get_template_directory() . '/inc/widgets/class-metro-post-widget.php';
require get_template_directory() . '/inc/widgets/class-slider-widget.php';
require get_template_directory() . '/inc/widgets/class-simple-post-widget.php';
require get_template_directory() . '/inc/widgets/class-category-lead-news.php';
require get_template_directory() . '/inc/widgets/class-two-column-widget.php';


/* Register site widgets */
if (!function_exists('magazinemax_widgets')) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function magazinemax_widgets()
    {
        register_widget('Magazinemax_Recent_Posts');
        register_widget('Magazinemax_Social_Menu');
        register_widget('Magazinemax_Mailchimp_Form');
        register_widget('Magazinemax_Tab_Posts');
        register_widget('Magazinemax_Call_To_Action');
        register_widget('Magazinemax_Image_Widget');
        register_widget('Magazinemax_Recent_Grid_Widget');
        register_widget('Magazinemax_Carousel_Widget');
        register_widget('Magazinemax_Metro_Post_Widget');
        register_widget('Magazinemax_Slider_Widget');
        register_widget('Magazinemax_Simple_Post_Widget');
        register_widget('Magazinemax_Category_Lead_News_Widget');
        register_widget('Magazinemax_Category_Two_Column_Widget');
    }
endif;
add_action('widgets_init', 'magazinemax_widgets');