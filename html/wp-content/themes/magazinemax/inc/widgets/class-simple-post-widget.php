<?php
if (!defined('ABSPATH')) {
    exit;
}

class Magazinemax_Simple_Post_Widget extends Magazinemax_Widget_Base
{
    /**
     * Sets up a new widget instance.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->widget_cssclass = 'magazinemax-widget-simple-post';
        $this->widget_description = __("Displays featured posts with an image on simple post", 'magazinemax');
        $this->widget_id = 'Magazinemax_Simple_Post_Widget';
        $this->widget_name = __('Magazinemax: Simple Post Widget', 'magazinemax');
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
        return new WP_Query(apply_filters('Magazinemax_Simple_Post_Widget_query_args', $query_args));
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
            do_action('magazinemax_before_simplepost_widget');
            ?>

                    <?php if ($instance['title']) : ?>
                        <h2 class="widget-title">
                            <?php echo esc_html($instance['title']); ?>
                        </h2>
                    <?php endif; ?>
                    <div class="widget-content">
                        <ul class="theme-trending-list">
                            <?php while ($posts->have_posts()): $posts->the_post(); ?>
                                <li class="theme-article-list article-list-center article-border image-hover">
                                  <?php if (has_post_thumbnail()) : ?>
                                      <div class="entry-image">
                                          <a href="<?php the_permalink() ?>">
                                              <?php
                                              the_post_thumbnail('medium', array(
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
                                    <?php the_title('<h3 class="entry-title ' . $instance['title_size'] . ' mb-4"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>
                                    <div class="entry-meta">
                                        <?php if ($instance['show_date']) {
                                            magazinemax_posted_on();
                                        } ?>
                                    </div>
                                  </div>
                                </li>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                            ?>
                        </ul>
                    </div>

            <?php
            do_action('magazinemax_after_simplepost_widget');
            echo $args['after_widget'];
        }
        echo ob_get_clean();
    }
}