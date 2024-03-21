<?php
if (!defined('ABSPATH')) {
    exit;
}
class Magazinemax_Recent_Grid_Widget extends Magazinemax_Widget_Base
{
    /**
     * Sets up a new widget instance.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->widget_cssclass = 'magazinemax-widget-recent-grid magazinemax-fullwidth-widget';
        $this->widget_description = __("Displays Recent News in Grid orientation", 'magazinemax');
        $this->widget_id = 'Magazinemax_Recent_Grid_Widget';
        $this->widget_name = __('Magazinemax: Recent Grid News', 'magazinemax');
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
            'number_of_coll' => array(
                'type' => 'select',
                'label' => __('Number of Column to Show', 'magazinemax'),
                'options' => array(
                    'column-6' => __('Column 2', 'magazinemax'),
                    'column-4' => __('Column 3', 'magazinemax'),
                    'column-3' => __('Column 4', 'magazinemax'),
                ),
                'std' => 'column-3',
            ),
            'number' => array(
                'type' => 'number',
                'step' => 1,
                'min' => 2,
                'max' => 12,
                'std' => 4,
                'label' => __('Number of posts to show', 'magazinemax'),
            ),
            'image_size' => array(
                'type' => 'select',
                'label' => __('Image size', 'magazinemax'),
                'options' => array(
                    'entry-image-medium' => __('Medium', 'magazinemax'),
                    'entry-image-small' => __('Small', 'magazinemax'),
                    'entry-image-thumbnail' => __('Thumbnail', 'magazinemax'),
                ),
                'std' => 'entry-image-small',
            ),
            'display_style' => array(
                'type' => 'select',
                'label' => __('Display Style', 'magazinemax'),
                'options' => array(
                    'theme-article-default' => __('Grid Layout', 'magazinemax'),
                    'theme-article-list' => __('List Layout', 'magazinemax'),
                ),
                'std' => 'theme-article-default',
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
            'show_date' => array(
                'type' => 'checkbox',
                'label' => __('Show Date', 'magazinemax'),
                'std' => true,
            ),
            'bg_color_option' => array(
                'type' => 'color',
                'label' => __('Background Color', 'magazinemax'),
                'std' => '#444444',
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
                'std' => 40,
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
        if (!empty($instance['category'])) {
            $query_args['tax_query'][] = array(
                'taxonomy' => 'category',
                'field' => 'term_id',
                'terms' => $instance['category'],
            );
        }
        return new WP_Query(apply_filters('Magazinemax_Recent_Grid_Widget_query_args', $query_args));
    }
    /**
     * Output widget.
     *
     * @param array $args
     * @param array $instance
     * @see WP_Widget
     */
    public function widget($args, $instance)
    {
        ob_start();
        $class = '';
        $image_enabled = !empty($instance['bg_image']);
        $bg_color_option = isset($instance['bg_color_option']) ? $instance['bg_color_option'] : '';
        $style_text = '--recent-grid-color:' . esc_attr($instance['text_color_option']) . ';';
        $style_text .= 'background-color:' . esc_attr($bg_color_option) . ';';
        $style = 'background-color:' . esc_attr($instance['bg_overlay_color']) . ';';
        $style .= 'opacity:' . (absint($instance['overlay_opacity']) / 100) . ';';
        $class .= esc_attr($instance['display_style']);
        echo $args['before_widget'];
        do_action('magazinemax_before_recent_grid');
        ?>
        <div class="magazinemax-cover-block">
          <div class="wrapper fullwidth-widget-wrapper" style="<?php echo $style_text; ?>">
            <?php
            if (($posts = $this->get_posts($args, $instance)) && $posts->have_posts()) {
                if ($image_enabled && $instance['bg_image'] && wp_get_attachment_url($instance['bg_image'])) {
                    $style = 'background-color:' . esc_attr($instance['bg_overlay_color']) . ';';
                    $style .= 'opacity:' . (absint($instance['overlay_opacity']) / 100) . ';';
                    ?>
                    <span aria-hidden="true" class="magazinemax-block-overlay" style="<?php echo esc_attr($style); ?>"></span>
                    <?php echo wp_get_attachment_image($instance['bg_image'], 'full', false, array('class' => 'magazinemax-cover-image')); ?>
                <?php } ?>
                    <?php if ($instance['title']) : ?>
                        <h2 class="widget-title">
                            <?php echo esc_html($instance['title']); ?>
                        </h2>
                    <?php endif; ?>
                    <div class="widget-content">
                        <div class="column-row column-row-small">
                            <?php
                            while ($posts->have_posts()): $posts->the_post();
                                ?>
                                <div class="column column-xs-12 mb-20 column-md-6 column-sm-6 <?php echo esc_attr($instance['number_of_coll']); ?>">
                                    <article
                                            id="recent-grid-<?php the_ID(); ?>" <?php post_class('theme-article-post image-hover ' . esc_attr($instance['display_style']) . ''); ?>>
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
                                            <?php the_title('<h3 class="entry-title ' . esc_attr($instance['title_size']) . ' title-hover mb-4"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>
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
                    <?php if (!empty($instance['category'])) {
                        ?>
                        <footer class="section-footer site-section-footer">
                            <a href="<?php echo esc_url(get_category_link($instance['category'])); ?>" class="section-footer-btn">
                                <?php magazinemax_theme_svg('chevron-down'); ?>
                            </a>
                        </footer>
                    <?php } ?>
                </div>
                <?php
            } ?>
        </div>
        <?php
        do_action('magazinemax_after_recent_grid');
        echo $args['after_widget'];
        echo ob_get_clean();
    }
}