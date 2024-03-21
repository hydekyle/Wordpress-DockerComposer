<?php
if (!defined('ABSPATH')) {
    exit;
}
class Magazinemax_Slider_Widget extends Magazinemax_Widget_Base
{
    /**
     * Sets up a new widget instance.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->widget_cssclass = 'magazinemax-widget-slider magazinemax-fullwidth-widget';
        $this->widget_description = __("Displays featured posts with an image on slider", 'magazinemax');
        $this->widget_id = 'Magazinemax_Slider_Widget';
        $this->widget_name = __('Magazinemax: Slider Widget', 'magazinemax');
        $this->settings = array(
            'title' => array(
                'type' => 'text',
                'label' => __('Title', 'magazinemax'),
            ),
            'category' => array(
                'type' => 'dropdown-taxonomies',
                'label' => __('Select Category', 'magazinemax'),
                'desc' => __('Leave empty if you don\'t want the posts to be category specific', 'magazinemax'),
                'args' => array(
                    'taxonomy' => 'category',
                    'class' => 'widefat',
                    'hierarchical' => true,
                    'show_count' => 1,
                    'show_option_all' => __('&mdash; Select &mdash;', 'magazinemax'),
                ),
            ),
            'number' => array(
                'type' => 'number',
                'step' => 1,
                'min' => 2,
                'max' => 12,
                'std' => 6,
                'label' => __('Number of posts to show', 'magazinemax'),
            ),
            'button_text' => array(
                'type' => 'text',
                'label' => __('Button Text', 'magazinemax'),
                'std' => 'Explore in Detail Now!',

            ),
            'show_overlay' => array(
                'type' => 'checkbox',
                'label' => __('Show Overlay', 'magazinemax'),
                'std' => true,
            ),
            'title_size' => array(
                'type' => 'select',
                'label' => __('Title font size', 'magazinemax'),
                'options' => array(
                    'entry-title-large' => __('Large', 'magazinemax'),
                    'entry-title-big' => __('Big', 'magazinemax'),
                    'entry-title-medium' => __('Medium', 'magazinemax'),
                    'entry-title-small' => __('Small', 'magazinemax'),
                ),
                'std' => 'entry-title-big',
            ),
            'show_category' => array(
                'type' => 'checkbox',
                'label' => __('Show Category', 'magazinemax'),
                'std' => true,
            ),
            'has_category_bg' => array(
                'type' => 'checkbox',
                'label' => __('Category Background Color', 'magazinemax'),
                'std' => true,
            ),
            'show_description' => array(
                'type' => 'checkbox',
                'label' => __('Show Description', 'magazinemax'),
                'std' => false,
            ),
            'show_author' => array(
                'type' => 'checkbox',
                'label' => __('Show Author', 'magazinemax'),
                'std' => false,
            ),
            'show_date' => array(
                'type' => 'checkbox',
                'label' => __('Show Date', 'magazinemax'),
                'std' => true,
            ),
            'show_post_view' => array(
                'type' => 'checkbox',
                'label' => __('Show Post View', 'magazinemax'),
                'std' => false,
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
     * Query the posts and return them.
     * @param array $args
     * @param array $instance
     * @return WP_Query
     */
    public function get_posts($args, $instance)
    {
        $number = !empty($instance['number']) ? absint($instance['number']) : $this->settings['number']['std'];
        $query_args = array(
            'posts_per_page' => $number,
            'post_status' => 'publish',
            'no_found_rows' => 1,
            'ignore_sticky_posts' => 1
        );
        if (!empty($instance['category']) && -1 != $instance['category'] && 0 != $instance['category']) {
            $query_args['tax_query'][] = array(
                'taxonomy' => 'category',
                'field' => 'term_id',
                'terms' => $instance['category'],
            );
        }
        return new WP_Query(apply_filters('Magazinemax_Slider_Widget_query_args', $query_args));
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
        $style = 'background-color:' . $instance['bg_overlay_color'] . ';';
        $style .= 'opacity:' . ($instance['overlay_opacity'] / 100) . ';';
        $site_fallback_image = magazinemax_get_option('site_fallback_image');
        $widget_button_text = $instance['button_text'];
        $slider_pagenav = '';
        $banner_overlay = '';
        if ($instance['show_overlay']) {
            $banner_overlay = 'swiper-slide-has-overlay';
        }
        echo $args['before_widget'];
        do_action('magazinemax_before_slider_widget');
        ?>
        <div class="magazinemax-cover-block <?php echo esc_attr($class); ?>" style="<?php echo esc_attr($style_text); ?>">
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
            <?php
            if (($posts = $this->get_posts($args, $instance)) && $posts->have_posts()) {
                ?>
                <div class="wrapper fullwidth-widget-wrapper">
                    <?php if ($instance['title']) : ?>
                        <h2 class="widget-title">
                            <?php echo esc_html($instance['title']); ?>
                        </h2>
                    <?php endif; ?>
                    <div class="widget-content">
                        <div class="theme-swiper-wrapper d-flex">
                            <div class="site-widget-slider swiper-banner-container swiper-container">
                                <div class="swiper-wrapper">
                                    <?php while ($posts->have_posts()): $posts->the_post(); ?>
                                        <div class="swiper-slide swiper-hero-slide image-hover <?php echo esc_attr($banner_overlay); ?>">
                                            <div class="swiper-slide-image hero-slide-image entry-image">
                                                <?php if (has_post_thumbnail()) : ?>
                                                    <?php
                                                    the_post_thumbnail('large', array(
                                                        'alt' => the_title_attribute(array(
                                                            'echo' => false,
                                                        )),
                                                    ));
                                                    ?>
                                                <?php else : ?>
                                                    <img src="<?php echo esc_url($site_fallback_image); ?>"
                                                         alt="<?php echo esc_attr(get_the_title()); ?>">
                                                <?php endif; ?>
                                            </div>
                                            <div class="site-banner-description">
                                                    <div class="entry-details">
                                                        <?php if ($instance['show_category']) { ?>
                                                            <div class="entry-meta">
                                                                <?php if ($instance['has_category_bg']) {
                                                                    magazinemax_posted_categories_has_background();
                                                                } else {
                                                                    magazinemax_posted_categories();
                                                                } ?>
                                                            </div>
                                                        <?php } ?>

                                                        <?php the_title('<h3 class="entry-title ' . $instance['title_size'] . ' title-hover line-clamp line-clamp-3 mb-10"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>

                                                        <?php
                                                        if ($instance['show_description'] && has_excerpt()): ?>
                                                            <div class="entry-details mb-10">
                                                                <?php the_excerpt(); ?>
                                                            </div>
                                                        <?php elseif ($instance['show_description']): ?>
                                                            <div class="entry-details mb-10">
                                                                <?php echo esc_html(wp_trim_words(get_the_content(), 25, '...')); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                        <div class="entry-meta mb-20">
                                                            <?php if ($instance['show_date']) {
                                                                magazinemax_posted_on();
                                                            } ?>
                                                        </div>
                                                        <?php if (!empty($widget_button_text)) { ?>
                                                            <a href="<?php the_permalink() ?>" class="theme-button theme-button-medium">
                                                                <?php echo esc_html($widget_button_text); ?>
                                                            </a>
                                                        <?php } ?>
                                                    </div>
                                            </div>
                                        </div>
                                        <?php
                                        $slider_pagenav .= '<div class="swiper-slide swiper-pagination-slide">';
                                        $slider_pagenav .= '<div class="swiper-pagination-content image-hover">';
                                        $slider_pagenav .= '<div class="entry-image entry-image-thumbnail">';
                                        if (has_post_thumbnail()) {
                                          $slider_pagenav .= '<img src="' . get_the_post_thumbnail_url(get_the_ID(), 'medium_large') . '">';
                                        } else {
                                          $slider_pagenav .= '<img src="' . esc_url($site_fallback_image) . '">';
                                        }
                                        $slider_pagenav .= '</div>';
                                        $slider_pagenav .= '<div class="entry-detail">';
                                        $slider_pagenav .= '<h3 class="entry-title entry-title-xsmall mb-4">'.esc_html(wp_trim_words( get_the_title() )).'</h3>';
                                        $slider_pagenav .= '<div class="entry-meta">';
                                        $slider_pagenav .= '<div class="entry-meta-item">';
                                        $slider_pagenav .= '<span class="posted-on vcard">'.get_the_date().'</span>';
                                        $slider_pagenav .= '</div>';
                                        $slider_pagenav .= '</div>';
                                        $slider_pagenav .= '</div>';
                                        $slider_pagenav .= '</div>';
                                        $slider_pagenav .= '</div>';
                                        ?>
                                    <?php
                                    endwhile;
                                    wp_reset_postdata();
                                    ?>
                                </div>
                            </div>
                            <div class="site-pagination-panel widget-pagination-panel">
                                <div class="site-widget-pagination swiper-pagination-container  swiper-container">
                                    <div class="swiper-wrapper">
                                        <?php echo $slider_pagenav; ?>
                                    </div>
                                    <div class="theme-swiper-control swiper-control">
                                        <div class="swiper-button-prev widget-slider-prev"></div>
                                        <div class="swiper-button-next widget-slider-next"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            } ?>
        </div>
        <?php
        do_action('magazinemax_after_slider_widget');
        echo $args['after_widget'];
        echo ob_get_clean();
    }
}