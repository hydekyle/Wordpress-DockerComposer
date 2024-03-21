<?php
if (!defined('ABSPATH')) {
    exit;
}

class Magazinemax_Category_Two_Column_Widget extends Magazinemax_Widget_Base
{
    /**
     * Sets up a new widget instance.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->widget_cssclass = 'magazinemax-category-two-column-post';
        $this->widget_description = __("Displays featured posts with an image on simple post", 'magazinemax');
        $this->widget_id = 'Magazinemax_Category_Two_Column_Widget';
        $this->widget_name = __('Magazinemax: Two Column Post Widget', 'magazinemax');
        $this->settings = array(
            'title_1' => array(
                'type' => 'text',
                'label' => __('Title Column - 1', 'magazinemax'),
            ),
            'title_2' => array(
                'type' => 'text',
                'label' => __('Title Column - 2', 'magazinemax'),
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
                'std' => true,
            ),
            'has_category_bg' => array(
                'type' => 'checkbox',
                'label' => __('Category Background Color', 'magazinemax'),
                'std' => true,
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
            'posts_per_page' => 4,
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
        return new WP_Query(apply_filters('Magazinemax_Category_Two_Column_Widget_query_args', $query_args));
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
        $counter = 1;
        echo $args['before_widget'];
        if (($posts = $this->get_posts($args, $instance)) && $posts->have_posts()) {
            do_action('magazinemax_before_simplepost_widget');
            ?>

                    <div class="theme-article-block">
                        <div class="column-row">
                            <?php while ($posts->have_posts()): $posts->the_post(); ?>
                                <?php if($counter == 1) { ?>
                                    <div class="column column-7 column-sm-12">
                                      <div class="article-block-left">
                                        <?php if ($instance['title_1']) : ?>
                                            <h2 class="widget-title">
                                                <?php echo esc_html($instance['title_1']); ?>
                                            </h2>
                                        <?php endif; ?>

                                        <div class="widget-content">
                                          <article class="theme-news-article image-hover mb-20">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <div class="entry-image entry-image-large">
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
                                              <?php the_title('<h3 class="entry-title entry-title-big mb-4"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>
                                              <?php if ($instance['show_description']): ?>
                                                  <div class="theme-excerpt mb-10">
                                                      <?php the_excerpt(); ?>
                                                  </div>
                                              <?php endif; ?>
                                              <div class="entry-meta">
                                                  <?php if ($instance['show_date']) {
                                                      magazinemax_posted_on();
                                                  } ?>
                                              </div>
                                            </div>
                                          </article>
                                        </div>
                                      </div>
                                    </div>
                                <?php $counter++; } else { ?>
                                    <?php if ($counter == 2) { ?>
                                        <div class="column column-5 column-sm-12">
                                          <div class="article-block-right">
                                        <?php if ($instance['title_2']) : ?>
                                            <h2 class="widget-title">
                                                <?php echo esc_html($instance['title_2']); ?>
                                            </h2>
                                        <?php endif; ?>
                                          <div class="widget-content">
                                    <?php } ?>
                                      <article class="theme-news-article image-hover">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <div class="entry-image entry-image-small mb-10">
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
                                          <?php the_title('<h3 class="entry-title entry-title-small mb-4"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>
                                          <?php if ($instance['show_description']): ?>
                                              <div class="theme-excerpt mb-4">
                                                  <?php the_excerpt(); ?>
                                              </div>
                                          <?php endif; ?>
                                          <div class="entry-meta">
                                              <?php if ($instance['show_date']) {
                                                  magazinemax_posted_on();
                                              } ?>
                                          </div>
                                        </div>
                                      </article>
                                <?php $counter++; 
                                if ($posts->current_post + 1 == $posts->post_count): ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php } ?>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>

            <?php
            do_action('magazinemax_after_simplepost_widget');
        }
        echo $args['after_widget'];

        echo ob_get_clean();
    }
}