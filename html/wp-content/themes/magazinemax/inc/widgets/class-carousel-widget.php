<?php
if (!defined('ABSPATH')) {
    exit;
}
class Magazinemax_Carousel_Widget extends Magazinemax_Widget_Base
{
    /**
     * Sets up a new widget instance.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->widget_cssclass = 'magazinemax-widget-carousel';
        $this->widget_description = __("Experience dynamic news presentation with our News Carousel Widget. Scroll through the latest updates seamlessly, enjoying a visually captivating display that brings news stories to life in an engaging and informative manner.", 'magazinemax');
        $this->widget_id = 'Magazinemax_Carousel_Widget';
        $this->widget_name = __('Magazinemax: News Carousel', 'magazinemax');
        $this->settings = array(
            'title' => array(
                'type' => 'text',
                'label' => __('Title', 'magazinemax'),
            ),
            'title_size' => array(
                'type' => 'select',
                'label' => __('Title font size', 'magazinemax'),
                'options' => array(
                    'entry-title-medium' => __('Medium', 'magazinemax'),
                    'entry-title-small' => __('Small', 'magazinemax'),
                ),
                'std' => 'entry-title-small',
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
            'slider_per_view' => array(
                'type' => 'number',
                'step' => 1,
                'min' => 2,
                'max' => 4,
                'std' => 3,
                'label' => __('Slides Per View', 'magazinemax'),
            ),
            'centered_slides' => array(
                'type' => 'checkbox',
                'label' => __('Centered Slides', 'magazinemax'),
                'std' => false,
            ),
            'autoplay' => array(
                'type' => 'checkbox',
                'label' => __('Autoplay', 'magazinemax'),
                'std' => true,
            ),
            'space_between' => array(
                'type' => 'select',
                'label' => __('space Between', 'magazinemax'),
                'options' => array(
                    '0' => __('0', 'magazinemax'),
                    '5' => __('5', 'magazinemax'),
                    '10' => __('10', 'magazinemax'),
                    '15' => __('15', 'magazinemax'),
                    '20' => __('20', 'magazinemax'),
                    '25' => __('25', 'magazinemax'),
                    '30' => __('30', 'magazinemax'),
                ),
                'std' => '20',
            ),
            'pagination' => array(
                'type' => 'checkbox',
                'label' => __('Pagination', 'magazinemax'),
                'std' => true,
            ),
            'image_size' => array(
                'type' => 'select',
                'label' => __('Image size', 'magazinemax'),
                'options' => array(
                    'entry-image-big' => __('Big', 'magazinemax'),
                    'entry-image-medium' => __('Medium', 'magazinemax'),
                ),
                'std' => 'entry-image-medium',
            ),
            'show_category' => array(
                'type' => 'checkbox',
                'label' => __('Show Category', 'magazinemax'),
                'std' => false,
            ),
            'has_category_bg' => array(
                'type' => 'checkbox',
                'label' => __('Category Background Color', 'magazinemax'),
                'std' => false,
            ),
            'show_description' => array(
                'type' => 'checkbox',
                'label' => __('Show Description', 'magazinemax'),
                'std' => true,
            ),
            'show_date' => array(
                'type' => 'checkbox',
                'label' => __('Show Date', 'magazinemax'),
                'std' => true,
            ),
            'show_share' => array(
                'type' => 'checkbox',
                'label' => __('Show Share', 'magazinemax'),
                'std' => false,
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
        return new WP_Query(apply_filters('Magazinemax_Carousel_Widget_query_args', $query_args));
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
        if (($posts = $this->get_posts($args, $instance)) && $posts->have_posts()) {
            echo $args['before_widget'];
            do_action('magazinemax_before_carousel_widget');
            ?>
            <?php if ($instance['title']) : ?>
                <h2 class="widget-title">
                    <?php echo esc_html($instance['title']); ?>
                </h2>
            <?php endif; ?>
            <div class="widget-content">
                <div class="theme-widget-carousel swiper"
                    <?php if ($instance['autoplay']) { ?>
                        data-autoplay="true"
                    <?php } else { ?>
                        data-autoplay="false"
                    <?php } ?>
                    <?php if (!empty($instance['centered_slides'])) { ?>
                        data-center-slides="<?php echo ($instance['centered_slides']) ? "true" : "false"; ?>"
                    <?php } ?>
                     data-breakpoint-lg="<?php echo isset($instance['slider_per_view']) ? $instance['slider_per_view'] : 1; ?>"
                     data-space-between="<?php echo isset($instance['space_between']) ? $instance['space_between'] : 0; ?>">
                    <div class="swiper-wrapper">
                        <?php
                        while ($posts->have_posts()): $posts->the_post();
                            ?>
                            <div class="swiper-slide">
                                <article id="carousel-article-<?php the_ID(); ?>" <?php post_class('theme-article-post theme-article-default article-overlay content-overlay image-hover'); ?>>
                                    <?php if (has_post_thumbnail()): ?>
                                        <div class="entry-image <?php echo esc_attr($instance['image_size']); ?>">
                                            <a href="<?php the_permalink() ?>">
                                                <?php
                                                the_post_thumbnail('medium_large', array(
                                                    'alt' => the_title_attribute(array(
                                                        'echo' => false,
                                                    )),
                                                ));
                                                ?>
                                            </a>
                                            <?php if ($instance['show_share']) {
                                                magazinemax_social_share();
                                            } ?>
                                        </div>
                                    <?php endif; ?>
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
                                        <?php the_title('<h3 class="entry-title ' . $instance['title_size'] . ' title-hover mb-4"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>
                                        <?php if ($instance['show_description']){ ?>
                                            <div class="theme-article-excerpt mb-4">
                                                <?php echo esc_html(wp_trim_words( get_the_content(), 16 )); ?>
                                            </div>
                                        <?php } ?>
                                        <div class="entry-meta">
                                            <?php if ($instance['show_date']) {
                                                magazinemax_posted_on();
                                            } ?>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata(); ?>
                    </div>
                </div>
                <?php if ($instance['pagination']) { ?>
                    <div class="swiper-pagination theme-swiper-pagination widget-carousel-pagination"></div>
                <?php } ?>
                <div class="swiper-button-prev carousel-slider-prev"></div>
                <div class="swiper-button-next carousel-slider-next"></div>
            </div>
            <?php if (!empty($instance['category'])) { ?>
                <footer class="section-footer site-section-footer">
                    <a href="<?php echo esc_url(get_category_link($instance['category'])); ?>"
                       class="section-footer-btn">
                        <?php magazinemax_theme_svg('chevron-down'); ?>
                    </a>
                </footer>
            <?php } ?>
            <?php
            do_action('magazinemax_after_carousel_widget');
            echo $args['after_widget'];
        }
        echo ob_get_clean();
    }
}