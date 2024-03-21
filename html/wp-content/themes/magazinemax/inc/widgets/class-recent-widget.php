<?php
if (!defined('ABSPATH')) {
    exit;
}

class Magazinemax_Recent_Posts extends Magazinemax_Widget_Base
{
    /**
     * Sets up a new widget instance.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->widget_cssclass = 'magazinemax-widget-recent-news';
        $this->widget_description = __("Displays recent news with an image", 'magazinemax');
        $this->widget_id = 'magazinemax_recent_posts';
        $this->widget_name = __('Magazinemax: Recent News', 'magazinemax');
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
                'min' => 1,
                'max' => '',
                'std' => 5,
                'label' => __('Number of posts to show', 'magazinemax'),
            ),
            'orderby' => array(
                'type' => 'select',
                'std' => 'date',
                'label' => __('Order by', 'magazinemax'),
                'options' => array(
                    'date' => __('Date', 'magazinemax'),
                    'ID' => __('ID', 'magazinemax'),
                    'title' => __('Title', 'magazinemax'),
                    'rand' => __('Random', 'magazinemax'),
                ),
            ),
            'order' => array(
                'type' => 'select',
                'std' => 'desc',
                'label' => __('Order', 'magazinemax'),
                'options' => array(
                    'asc' => __('ASC', 'magazinemax'),
                    'desc' => __('DESC', 'magazinemax'),
                ),
            ),
            'show_date' => array(
                'type' => 'checkbox',
                'label' => __('Show Date', 'magazinemax'),
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
            'show_featured_image' => array(
                'type' => 'checkbox',
                'label' => __('Show Featured Image', 'magazinemax'),
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
        $orderby = !empty($instance['orderby']) ? sanitize_text_field($instance['orderby']) : $this->settings['orderby']['std'];
        $order = !empty($instance['order']) ? sanitize_text_field($instance['order']) : $this->settings['order']['std'];
        $query_args = array(
            'posts_per_page' => $number,
            'post_status' => 'publish',
            'no_found_rows' => 1,
            'orderby' => $orderby,
            'order' => $order,
            'ignore_sticky_posts' => 1
        );
        if (!empty($instance['category']) && $instance['category'] > 0) {
            $query_args['tax_query'][] = array(
                'taxonomy' => 'category',
                'field' => 'term_id',
                'terms' => $instance['category'],
            );
        }
        return new WP_Query(apply_filters('magazinemax_recent_posts_query_args', $query_args));
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
            $this->widget_start($args, $instance);
            do_action('magazinemax_before_recent_posts_with_image');
            $style = $instance['style'];
            ?>
            <div class="theme-recent-widget theme-widget-list <?php echo esc_attr($style); ?>">
                <?php
                while ($posts->have_posts()): $posts->the_post();

                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('theme-article-post theme-widget-article image-hover'); ?>>
                        <?php
                        if ($instance['show_featured_image'] && has_post_thumbnail()) {
                            ?>
                            <div class="entry-image entry-image-thumbnail">
                                <a href="<?php the_permalink() ?>">
                                    <?php
                                    the_post_thumbnail('thumbnail', array(
                                        'alt' => the_title_attribute(array(
                                            'echo' => false,
                                        )),
                                    ));
                                    ?>
                                </a>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="entry-details">
                            <div class="entry-meta mb-4">
                                <?php if ($instance['show_date']) {
                                    magazinemax_posted_on();
                                } ?>
                            </div>
                            <?php the_title('<h3 class="entry-title entry-title-small"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>

                        </div>
                    </article>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>
            <?php
            do_action('magazinemax_after_recent_posts_with_image');
            $this->widget_end($args);
        }
        echo ob_get_clean();
    }
}