<?php
if (!defined('ABSPATH')) {
    exit;
}

class Magazinemax_Call_To_Action extends Magazinemax_Widget_Base
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->widget_cssclass = 'magazinemax-widget-cta magazinemax-fullwidth-widget';
        $this->widget_description = __("Integrate a Call to Action (CTA) section into your website, featuring a button and other clear instructions. This section guides your readers precisely on the next steps to take or where to navigate next.", 'magazinemax');
        $this->widget_id = 'magazinemax_call_to_action';
        $this->widget_name = __('Magazinemax: Full Width Call To Action', 'magazinemax');
        $this->settings = array(
            'title' => array(
                'type' => 'text',
                'label' => __('CTA Title', 'magazinemax'),
            ),
            'title_text' => array(
                'type' => 'text',
                'label' => __('CTA Subtitle', 'magazinemax'),
            ),
            'desc' => array(
                'type' => 'textarea',
                'label' => __('CTA Description', 'magazinemax'),
                'rows' => 10,
            ),
            'btn_text' => array(
                'type' => 'text',
                'label' => __('Button Text', 'magazinemax'),
            ),
            'btn_link' => array(
                'type' => 'url',
                'label' => __('Link to url', 'magazinemax'),
                'desc' => __('Enter a proper url with http: OR https:', 'magazinemax'),
            ),
            'link_target' => array(
                'type' => 'checkbox',
                'label' => __('Open Link in new Tab', 'magazinemax'),
                'std' => true,
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
                'step' => 50,
                'min' => 300,
                'max' => 700,
                'std' => 500,
                'label' => __('Height: Between 300px and 700px (Default 400px)', 'magazinemax'),
            ),
            'bg_color_option' => array(
                'type' => 'color',
                'label' => __('Background Color', 'magazinemax'),
                'std' => '#222222',
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

        $style_text = 'color:' . $instance['text_color_option'] . ';';
        $style_text .= 'background-color:' . $bg_color_option . ';';
        $style_text .= 'min-height:' . $instance['height'] . 'px;';
        $style_text .= 'text-align:' . $instance['text_align'] . ';';
        $style = 'background-color:' . $instance['bg_overlay_color'] . ';';
        $style .= 'opacity:' . ($instance['overlay_opacity'] / 100) . ';';

        echo $args['before_widget'];
        do_action('magazinemax_before_cta');
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
                <?php if ($instance['title']) : ?>
                    <h2 class="entry-title entry-title-large">
                        <?php echo esc_html($instance['title']); ?>
                    </h2>
                <?php endif; ?>
                <?php if ($instance['title_text']) : ?>
                    <h3 class="entry-title entry-title-big">
                        <?php echo esc_html($instance['title_text']); ?>
                    </h3>
                <?php endif; ?>
                <?php if ($instance['desc']) : ?>
                    <div class="entry-summary">
                        <?php echo wpautop(wp_kses_post($instance['desc'])); ?>
                    </div>
                <?php endif; ?>
                <?php if ($instance['btn_text']) : ?>
                    <footer class="entry-footer">
                        <a href="<?php echo ($instance['btn_link']) ? esc_url($instance['btn_link']) : ''; ?>"
                           target="<?php echo ($instance['link_target']) ? "_blank" : '_self'; ?>" class="theme-button">
                            <?php echo esc_html(($instance['btn_text'])); ?>
                        </a>
                    </footer>
                <?php endif; ?>
            </div>
        </div>
        <?php
        do_action('magazinemax_after_cta');
        echo $args['after_widget'];
        echo ob_get_clean();
    }
}