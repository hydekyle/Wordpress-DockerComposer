<?php
if (!defined('ABSPATH')) {
    exit;
}

class Magazinemax_Metro_Post_Widget extends Magazinemax_Widget_Base
{
    /**
     * Sets up a new widget instance.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->widget_cssclass = 'magazinemax-widget-metro-post';
        $this->widget_description = __("Metro Widget transforms your posts into a visually appealing mosaic, creating a stylish and organized showcase for an immersive reader experience.", 'magazinemax');
        $this->widget_id = 'Magazinemax_Metro_Post_Widget';
        $this->widget_name = __('Magazinemax: Metro Post', 'magazinemax');
        $this->settings = array(
            'title' => array(
                'type' => 'text',
                'label' => __('Title', 'magazinemax'),
            ),
            'layout_style' => array(
                'type' => 'select',
                'label' => __('Style Layout', 'magazinemax'),
                'options' => array(
                    'metro-layout-1' => __('Layout 1', 'magazinemax'),
                    'metro-layout-2' => __('Layout 2', 'magazinemax'),
                    'metro-layout-3' => __('Layout 3', 'magazinemax'),
                    'metro-layout-4' => __('Layout 4', 'magazinemax'),
                    'metro-layout-5' => __('Layout 5', 'magazinemax'),
                ),
                'std' => 'metro-layout-1',
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
        $post_count = "";
        switch ($instance['layout_style']) {
            case "metro-layout-1":
                $post_count = "5";
                break;
            case "metro-layout-2":
                $post_count = "4";
                break;
            case "metro-layout-3":
                $post_count = "5";
                break;
            case "metro-layout-4":
                $post_count = "5";
                break;
            case "metro-layout-5":
                $post_count = "3";
                break;
            default:
                $post_count = "";
        }
        $query_args = array(
            'post_status' => 'publish',
            'posts_per_page' => $post_count,
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
        return new WP_Query(apply_filters('Magazinemax_Metro_Post_Widget_query_args', $query_args));
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
        echo $args['before_widget'];
        do_action('magazinemax_before_metro_widget');
        $counter = 1;

        // Provide a default value for $instance['title']
        $title = isset($instance['title']) ? esc_html($instance['title']) : '';

        if (($posts = $this->get_posts($args, $instance)) && $posts->have_posts()) {
            ?>
            <div class="metro-layout-style <?php echo esc_attr($instance['layout_style']); ?>">
                <?php if ($title) : ?>
                    <h2 class="widget-title">
                        <?php echo $title; ?>
                    </h2>
                <?php endif; ?>
                <div class="widget-content">
                    <div class="column-row-grid">
                        <?php
                        while ($posts->have_posts()): $posts->the_post();
                            $image_class = "";
                            $title_class = "";
                            switch ($instance['layout_style']) {
                                case "metro-layout-1":
                                    if ($counter == 1) {
                                        $image_class = "entry-image-large";
                                        $title_class = "entry-title-big";
                                    } else {
                                        $image_class = "entry-image-medium";
                                        $title_class = "entry-title-small";
                                    }
                                    break;
                                case "metro-layout-2":
                                    if ($counter == 1) {
                                        $image_class = "entry-image-large";
                                        $title_class = "entry-title-big";
                                    } else {
                                        $image_class = "entry-image-medium";
                                        $title_class = "entry-title-small";
                                    }
                                    break;
                                case "metro-layout-3":
                                    if ($counter == 2) {
                                        $image_class = "entry-image-large";
                                        $title_class = "entry-title-big";
                                    } else {
                                        $image_class = "entry-image-medium";
                                        $title_class = "entry-title-small";
                                    }
                                    break;
                                case "metro-layout-4":
                                    if ($counter == 5) {
                                        $image_class = "entry-image-large";
                                        $title_class = "entry-title-big";
                                    } else {
                                        $image_class = "entry-image-medium";
                                        $title_class = "entry-title-small";
                                    }
                                    break;
                                case "metro-layout-5":
                                    $image_class = "entry-image-large";
                                    $title_class = "entry-title-big";
                                    break;
                                default:
                                    $image_class = "entry-image-medium";
                                    $title_class = "entry-title-small";
                            }
                            ?>
                            <article id="metro-article-<?php the_ID(); ?>" <?php post_class('theme-article-post theme-article-overlap theme-metro-post theme-metro-post-' . $counter . ' article-overlay image-hover'); ?>>
                                <?php if (has_post_thumbnail()): ?>
                                    <div class="entry-image <?php echo esc_attr($image_class); ?>">
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
                                    <header class="entry-header">
                                        <?php the_title('<h3 class="entry-title ' . esc_attr($title_class) . ' title-hover mb-4"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>
                                    </header>
                                    <div class="entry-meta">
                                        <?php if ($instance['show_date']) {
                                            magazinemax_posted_on();
                                        } ?>
                                    </div>
                                </div>
                            </article>
                            <?php
                            $counter++;
                        endwhile;
                        wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
            <?php
        }
        do_action('magazinemax_after_metro_widget');
        echo $args['after_widget'];
        echo ob_get_clean();
    }
}