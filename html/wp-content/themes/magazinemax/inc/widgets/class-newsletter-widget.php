<?php
if (!defined('ABSPATH')) {
    exit;
}

class Magazinemax_Mailchimp_Form extends Magazinemax_Widget_Base
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->widget_cssclass = 'magazinemax-widget-newsletter magazinemax-fullwidth-widget';
        $this->widget_description = __("This widget effortlessly incorporates with third-party email marketing services through Shortcode, enabling you to establish a newsletter subscriptions.", 'magazinemax');
        $this->widget_id = 'magazinemax_mailchimp_form';
        $this->widget_name = __('Magazinemax: Full Width Newsletter', 'magazinemax');
        $this->settings = array(
            'title' => array(
                'label' => esc_html__('Widget Title', 'magazinemax'),
                'type' => 'text',
                'class' => 'widefat',
            ),
            'desc' => array(
                'type' => 'textarea',
                'label' => __('Description', 'magazinemax'),
                'rows' => 10,
            ),
            'form_shortcode' => array(
                'type' => 'text',
                'label' => __('MailChimp Form Shortcode', 'magazinemax'),
            ),
            'msg' => array(
                'type' => 'message',
                'label' => __('Additonal Settings', 'magazinemax'),
            ),
            'text_align' => array(
                'type' => 'select',
                'label' => __('Text Alignment', 'magazinemax'),
                'options' => array(
                    'left' => __('Left Align', 'magazinemax'),
                    'center' => __('Center Align', 'magazinemax'),
                    'right' => __('Right Align', 'magazinemax'),
                ),
                'std' => 'left',
            ),
            'height' => array(
                'type' => 'number',
                'step' => 20,
                'min' => 300,
                'max' => 700,
                'std' => 500,
                'label' => __('Height: Between 300px and 700px (Default 400px)', 'magazinemax'),
            ),
            'bg_color_option' => array(
                'type' => 'color',
                'label' => __('Background Color', 'magazinemax'),
                'std' => '#000000',
            ),
            'text_color_option' => array(
                'type' => 'color',
                'label' => __('Text Color', 'magazinemax'),
                'std' => '#ffffff',
            ),
            'bg_image' => array(
                'type' => 'image',
                'label' => __('Background Image', 'magazinemax'),
                'desc' => __('Don\'t upload any image if you do not want to show the background image.', 'magazinemax'),
            ),
            'overlay_opacity' => array(
                'type' => 'number',
                'step' => 10,
                'min' => 0,
                'max' => 100,
                'std' => 50,
                'label' => __('Overlay Opacity (Default 50%)', 'magazinemax'),
            ),
            'bg_overlay_color' => array(
                'type' => 'color',
                'label' => __('Overlay Background Color', 'magazinemax'),
                'std' => '#000000',
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
        $class = '';
        $image_enabled = !empty($instance['bg_image']);

        $bg_color_option = "";
        if (isset($instance['bg_color_option'])) {
            $bg_color_option = $instance['bg_color_option'];
        }

        $class .= ' newsletter-align-'.$instance['text_align'] ;

        $style_text = 'color:' . $instance['text_color_option'] . ';';
        $style_text .= 'background-color:' . $bg_color_option . ';';
        $style_text .= 'min-height:' . $instance['height'] . 'px;';
        echo $args['before_widget'];
        do_action('magazinemax_before_mailchimp');
        ?>
        <div class="magazinemax-cover-block magazinemax-cover-block-space <?php echo esc_attr($class); ?>" style="<?php echo esc_attr($style_text); ?>">
            <?php
            if ($image_enabled) {
                $style = 'background-color:' . $instance['bg_overlay_color'] . ';';
                $style .= 'opacity:' . ($instance['overlay_opacity'] / 100) . ';';
                ?>
                <span aria-hidden="true" class="magazinemax-block-overlay" style="<?php echo esc_attr($style); ?>"></span>
                <?php echo wp_get_attachment_image($instance['bg_image'], 'full', false, array('class' => 'magazinemax-cover-image')); ?>
                <?php
            }
            ?>
            <div class="wrapper fullwidth-widget-wrapper">
                <div class="mailchimp-content-group_1">
                    <?php if ($instance['title']) : ?>
                        <h2 class="entry-title entry-title-large">
                            <?php echo esc_html($instance['title']); ?>
                        </h2>
                    <?php endif; ?>
                    <div class="entry-summary">
                        <?php
                        if ($instance['desc']) {
                            echo wpautop(wp_kses_post($instance['desc']));
                        }
                        ?>
                    </div>
                </div>
                <div class="mailchimp-content-group_2">
                    <?php echo do_shortcode($instance['form_shortcode']); ?>
                </div>
            </div>
        </div>
        <?php
        do_action('magazinemax_after_mailchimp');
        echo $args['after_widget'];
        echo ob_get_clean();
    }
}