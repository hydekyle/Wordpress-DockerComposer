<?php
if (!defined('ABSPATH')) {
    exit;
}

class Magazinemax_Image_Widget extends Magazinemax_Widget_Base
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->widget_cssclass = 'magazinemax-widget-image';
        $this->widget_description = __("The Image Widget offers versatile design with two style variations. Effortlessly incorporate images, titles, descriptions, and links for dynamic and engaging content presentation in a single widget.", 'magazinemax');
        $this->widget_id = 'magazinemax_image_widget';
        $this->widget_name = __('Magazinemax: Image Widget', 'magazinemax');
        $this->settings = array(
            'title' => array(
                'type' => 'text',
                'label' => __('Widget Title', 'magazinemax'),
            ),
            'title_text' => array(
                'type' => 'text',
                'label' => __('Widget Description', 'magazinemax'),
            ),
            'bg_image' => array(
                'type' => 'image',
                'label' => __('Background Image', 'magazinemax'),
            ),
            'btn_text' => array(
                'type' => 'text',
                'label' => __('Button Text', 'magazinemax'),
            ),
            'btn_link' => array(
                'type' => 'url',
                'label' => __('Link to URL', 'magazinemax'),
                'desc' => __('Please make sure to provide a complete URL that includes either "http://" or "https://" to ensure the widget operates correctly.', 'magazinemax'),
            ),
            'link_target' => array(
                'type' => 'checkbox',
                'label' => __('Open Link in new Tab', 'magazinemax'),
                'std' => true,
            ),
            'style' => array(
                'type' => 'select',
                'label' => __('Style', 'magazinemax'),
                'options' => array(
                    'style_1' => __('Style 1', 'magazinemax'),
                    'style_2' => __('Style 2', 'magazinemax'),
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
        $class = '';
        ob_start();
        echo $args['before_widget'];
        $class .= $instance['style'];
        do_action('magazinemax_before_image');
        ?>
        <div class="magazinemax-image-widget <?php echo esc_attr($class); ?>">
            <div class="widget-image-wrapper">
                <?php echo wp_get_attachment_image($instance['bg_image'], 'full'); ?>
            </div>
            <div class="widget-desc-wrapper">
                <?php if ($instance['title']) : ?>
                    <h2 class="entry-title">
                        <?php echo esc_html($instance['title']); ?>
                    </h2>
                <?php endif; ?>
                <?php if ($instance['title_text']) : ?>
                    <div class="entry-details">
                        <?php echo esc_html($instance['title_text']); ?>
                    </div>
                <?php endif; ?>
                <?php if ($instance['btn_text']) : ?>
                    <a href="<?php echo ($instance['btn_link']) ? esc_url($instance['btn_link']) : ''; ?>"
                       target="<?php echo ($instance['link_target']) ? "_blank" : '_self'; ?>"
                       class="theme-widget-button">
                        <?php echo esc_html(($instance['btn_text'])); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <?php
        do_action('magazinemax_after_image');
        echo $args['after_widget'];
        echo ob_get_clean();
    }
}