<?php

if (!defined('ABSPATH')) {
    exit;
}

class Magazinemax_Social_Menu extends Magazinemax_Widget_Base
{

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->widget_cssclass = 'magazinemax-widget-social-menu';
        $this->widget_description = __("Displays social menu if you have set it.", 'magazinemax');
        $this->widget_id = 'magazinemax_social_menu';
        $this->widget_name = __('Magazinemax: Social Menu', 'magazinemax');
        $this->settings = array(
            'title' => array(
                'type' => 'text',
                'label' => __('Title', 'magazinemax'),
            ),
            'style' => array(
                'type' => 'select',
                'label' => __('Style', 'magazinemax'),
                'options' => array(
                    'style_1' => __('Style 1', 'magazinemax'),
                    'style_2' => __('Style 2', 'magazinemax'),
                    'style_3' => __('Style 3', 'magazinemax'),
                ),
                'std' => 'style_1',
            ),
        );

        parent::__construct();
    }

    /**
     * Output widget.
     *
     * @param array $args
     * @param array $instance
     * @see WP_Widget
     *
     */
    public function widget($args, $instance)
    {
        ob_start();

        $this->widget_start($args, $instance);

        do_action('magazinemax_before_social_menu');

        $style = $instance['style'];

        ?>
        <div class="magazinemax-social-menu-widget <?php echo esc_attr($style); ?>">
            <?php

            if (has_nav_menu('social-menu')) {
                wp_nav_menu(array(
                    'theme_location' => 'social-menu',
                    'container_class' => 'footer-navigation',
                    'fallback_cb' => false,
                    'depth' => 1,
                    'menu_class' => 'magazinemax-social-icons reset-list-style',
                    'link_before' => '<span class="social-media-title">',
                    'link_after' => '</span>',
                ));
            } else {
                esc_html_e('Social menu is not set. You need to create menu and assign it to Social Menu on Menu Settings.', 'magazinemax');
            }
            ?>
        </div>
        <?php

        do_action('magazinemax_after_social_menu');

        $this->widget_end($args);

        echo ob_get_clean();
    }
}