<?php
if (!defined('ABSPATH')) {
    exit;
}
class Magazinemax_Category_Lead_News_Widget extends Magazinemax_Widget_Base
{
    /**
     * Sets up a new widget instance.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->widget_cssclass = 'magazinemax-widget-category-lead-news';
        $this->widget_description = __("Two-Column Layout: The initial column features the most recent post from a selected category, while the second column displays the posts in a clean and organized list view.", 'magazinemax');
        $this->widget_id = 'Magazinemax_Category_Lead_News_Widget';
        $this->widget_name = __('Magazinemax: Lead News from Category', 'magazinemax');
        $this->settings = array(
            'title' => array(
                'type' => 'text',
                'label' => __('Title', 'magazinemax'),
            ),
            'title_size_1' => array(
                'type' => 'select',
                'label' => __('Font size for Prime Article', 'magazinemax'),
                'options' => array(
                    'entry-title-big' => __('Big', 'magazinemax'),
                    'entry-title-medium' => __('Medium', 'magazinemax'),
                ),
                'std' => 'entry-title-medium',
            ),
            'title_size_2' => array(
                'type' => 'select',
                'label' => __('Font size for Sub Articles', 'magazinemax'),
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
            'show_description' => array(
                'type' => 'checkbox',
                'label' => __('Show Description', 'magazinemax'),
                'std' => true,
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
        $query_args = array(
            'posts_per_page' => 8,
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
        return new WP_Query(apply_filters('Magazinemax_Category_Lead_News_Widget_query_args', $query_args));
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
        $count = 1;
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
                <div class="column-row">
                    <?php while ($posts->have_posts()):
                    $posts->the_post();
                    ?>

                    <?php if ($count == 1) { ?>
                        <div class="column column-4 column-sm-12 mb-20">
                    <?php } ?>
                    <?php if ($count < 5) { ?>
                        <article id="advanced-multiple-<?php the_ID(); ?>" <?php post_class('theme-article-post theme-article-list article-list-center article-border image-hover mb-15'); ?>>
                            <?php $this->output_list_content($instance); ?>
                        </article>
                    <?php $count++; ?>
                            <?php if ($count == 5) { ?>
                                </div>
                                <div class="column column-8 column-sm-12 mb-20">
                                  <div class='lead-news-inner'>
                            <?php } ?>
                    <?php } elseif ($count > 3) {
                        if ($count == 5) { ?>
                        <article class="theme-article-post image-hover mb-sm-20">
                          <?php if (has_post_thumbnail()) : ?>
                              <div class="entry-image entry-image-large">
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
                        </article>
                        <?php }

                        ?>
                        <article id="advanced-multiple-<?php the_ID(); ?>" <?php post_class('theme-article-post theme-widget-article theme-article-list article-list-center article-border article-border-small image-hover mb-sm-20'); ?>>
                            <?php $this->output_prime_content($instance); ?>
                        </article>
                     <?php $count++; } ?>
                     <?php if ($posts->current_post + 1 == $posts->post_count): ?>
                        </div>
                        </div>
                     <?php endif; ?>
                     <?php
                     endwhile;
                     wp_reset_postdata();
                     ?> 
                </div>
            </div>
            <?php
            do_action('magazinemax_after_simplepost_widget');
            echo $args['after_widget'];
        }
        echo ob_get_clean();
    }
    /**
     * Output post content.
     *
     * @param array $instance
     */
    private function output_prime_content($instance)
    {
        ?>
          <?php if (has_post_thumbnail()): ?>
            <div class="entry-image entry-image-thumbnail">
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

            <?php the_title('<h3 class="entry-title ' . $instance['title_size_1'] . ' line-clamp line-clamp-2 mb-4"><a href="' .     esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>
            <?php
            if ($instance['show_description'] && has_excerpt()): ?>
                <div class="theme-article-excerpt mb-4">
                    <?php the_excerpt(); ?>
                </div>
            <?php elseif ($instance['show_description']): ?>
                <div class="theme-article-excerpt mb-4">
                    <?php echo esc_html(wp_trim_words(get_the_content(), 15, '...')); ?>
                </div>
            <?php endif; ?>

            <div class="entry-meta">
              <?php if ($instance['show_date']) {
                  magazinemax_posted_on();
              } ?>
            </div>
          </div>
        <?php
    }
    /**
     * Output post content.
     *
     * @param array $instance
     */
    private function output_list_content($instance)
    {
        ?>
        <?php if (has_post_thumbnail()): ?>
        <div class="entry-image entry-image-thumbnail">
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
            <?php the_title('<h3 class="entry-title ' . $instance['title_size_2'] . ' line-clamp line-clamp-2 mb-4"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>
            <div class="entry-meta">
                <?php if ($instance['show_date']) {
                    magazinemax_posted_on();
                } ?>
            </div>
        </div>
        <?php
    }
}