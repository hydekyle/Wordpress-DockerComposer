<?php
if (!defined('ABSPATH')) {
    exit;
}
class Magazinemax_Tab_Posts extends Magazinemax_Widget_Base
{
    /**
     * Sets up a new widget instance.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->widget_cssclass = 'magazinemax-widget-tab';
        $this->widget_description = __("Displays Tab Widget", 'magazinemax');
        $this->widget_id = 'magazinemax_tab_posts';
        $this->widget_name = __('Magazinemax: Tab Posts', 'magazinemax');
        $this->settings = array(
            'category_1_heading' => array(
                'label' => esc_html__('Category 1', 'magazinemax'),
                'type' => 'heading',
            ),
            'cat_1_title' => array(
                'type' => 'text',
                'label' => __('Title', 'magazinemax'),
            ),
            'cat_1_number' => array(
                'label' => esc_html__('No. of Posts:', 'magazinemax'),
                'type' => 'number',
                'css' => 'max-width:60px;',
                'std' => 5,
                'min' => 1,
                'max' => 10,
            ),
            'select_categroy_1' => array(
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
            'category_2_heading' => array(
                'label' => esc_html__('Category 2', 'magazinemax'),
                'type' => 'heading',
            ),
            'cat_2_title' => array(
                'type' => 'text',
                'label' => __('Title', 'magazinemax'),
            ),
            'cat_2_number' => array(
                'label' => esc_html__('No. of Posts:', 'magazinemax'),
                'type' => 'number',
                'css' => 'max-width:60px;',
                'std' => 5,
                'min' => 1,
                'max' => 10,
            ),
            'select_categroy_2' => array(
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
            'cat_3_heading' => array(
                'label' => esc_html__('Category 3', 'magazinemax'),
                'type' => 'heading',
            ),
            'cat_3_title' => array(
                'type' => 'text',
                'label' => __('Title', 'magazinemax'),
            ),
            'cat_3_number' => array(
                'label' => esc_html__('No. of post:', 'magazinemax'),
                'type' => 'number',
                'css' => 'max-width:60px;',
                'std' => 5,
                'min' => 1,
                'max' => 10,
            ),
            'select_categroy_3' => array(
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
     * Outputs the content for the current widget instance.
     *
     * @param array $args Display arguments.
     * @param array $instance Settings for the current widget instance.
     * @since 1.0.0
     *
     */
    function widget($args, $instance)
    {
        echo $args['before_widget'];
        ?>
        <div class="theme-widget-tab">
            <div class="widget-tab-header">
                <ul class="tab-header-list" role="tablist">
                    <li role="presentation" tab-data="tab-cat-1" class="widget-tab-presentation tab-cat-1 active">
                        <a href="javascript:void(0)" aria-controls="<?php echo $args['widget_id']; ?>-cat-1-tabpanel" role="tab">
                            <?php if ($instance['cat_1_title']) {
                                echo esc_html($instance['cat_1_title']);
                            } ?>
                        </a>
                    </li>
                    <li role="presentation" tab-data="tab-cat-2" class="widget-tab-presentation tab-cat-2">
                        <a href="javascript:void(0)" aria-controls="<?php echo $args['widget_id']; ?>-cat-2-tabpanel" role="tab">
                            <?php if ($instance['cat_2_title']) {
                                echo esc_html($instance['cat_2_title']);
                            } ?>
                        </a>
                    </li>
                    <li role="presentation" tab-data="tab-cat-3" class="widget-tab-presentation tab-cat-3">
                        <a href="javascript:void(0)" aria-controls="<?php echo $args['widget_id']; ?>-cat-3-tabpanel" role="tab">
                            <?php if ($instance['cat_3_title']) {
                                echo esc_html($instance['cat_3_title']);
                            } ?>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="widget-tab-content">
                <div id="<?php echo $args['widget_id']; ?>-cat-1-tabpanel" role="tabpanel" class="tab-content-panel content-tab-cat-1 active">
                    <?php $this->render_news('cat-1', $instance); ?>
                </div>
                <div id="<?php echo $args['widget_id']; ?>-cat-2-tabpanel" role="tabpanel" class="tab-content-panel content-tab-cat-2">
                    <?php $this->render_news('cat-2', $instance); ?>
                </div>
                <div id="<?php echo $args['widget_id']; ?>-cat-3-tabpanel" role="tabpanel" class="tab-content-panel content-tab-cat-3">
                    <?php $this->render_news('cat-3', $instance); ?>
                </div>
            </div>
        </div>
        <?php
        echo $args['after_widget'];
    }
    /**
     * Render news.
     *
     * @param array $types Type.
     * @param array $instance Parameters.
     * @return void
     * @since 1.0.0
     *
     */
    function render_news($types, $instance)
    {
        if (!in_array($types, array('cat-1', 'cat-2', 'cat-3'))) {
            return;
        }
        switch ($types) {
            case 'cat-1':
                $qargs = array(
                    'posts_per_page' => $instance['cat_1_number'],
                    'post_status' => 'publish',
                    'no_found_rows' => 1,
                    'ignore_sticky_posts' => 1,
                );
                if (!empty($instance['select_categroy_1']) && -1 != $instance['select_categroy_1'] && 0 != $instance['select_categroy_1']) {
                    $qargs['tax_query'][] = array(
                        'taxonomy' => 'category',
                        'field' => 'term_id',
                        'terms' => $instance['select_categroy_1'],
                    );
                }
                break;
            case 'cat-2':
                $qargs = array(
                    'posts_per_page' => $instance['cat_2_number'],
                    'post_status' => 'publish',
                    'no_found_rows' => 1,
                    'ignore_sticky_posts' => 1,
                );
                if (!empty($instance['select_categroy_2']) && -1 != $instance['select_categroy_2'] && 0 != $instance['select_categroy_2']) {
                    $qargs['tax_query'][] = array(
                        'taxonomy' => 'category',
                        'field' => 'term_id',
                        'terms' => $instance['select_categroy_2'],
                    );
                }
                break;
            case 'cat-3':
                $qargs = array(
                    'posts_per_page' => $instance['cat_3_number'],
                    'post_status' => 'publish',
                    'no_found_rows' => 1,
                    'ignore_sticky_posts' => 1,
                );
                if (!empty($instance['select_categroy_3']) && -1 != $instance['select_categroy_3'] && 0 != $instance['select_categroy_3']) {
                    $qargs['tax_query'][] = array(
                        'taxonomy' => 'category',
                        'field' => 'term_id',
                        'terms' => $instance['select_categroy_3'],
                    );
                }
                break;
            default:
                break;
        }
        $tab_posts_query = new WP_Query($qargs);
        $style = $instance['style'];
        $show_featured_image = $instance['show_featured_image'];
        if ($tab_posts_query->have_posts()):
            ?>
            <div class="theme-widget-list <?php echo esc_attr($style); ?>">
                <?php
                while ($tab_posts_query->have_posts()):
                    $tab_posts_query->the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('theme-article-post theme-widget-article'); ?>>
                        <?php
                        if ($show_featured_image && has_post_thumbnail()) {
                            ?>
                            <div class="entry-image">
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
                            <div class="entry-meta">
                                <?php if ($instance['show_date']) {
                                    magazinemax_posted_on();
                                } ?>
                            </div>
                            <?php the_title('<h3 class="entry-title entry-title-small"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
            <?php wp_reset_postdata();
        endif;
    }
}
