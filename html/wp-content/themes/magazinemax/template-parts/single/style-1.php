<?php
/**
 * The template for displaying all single posts style 1
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Magazinemax
 */
$page_layout = magazinemax_get_page_layout();

?>
    <main id="site-content" role="main">
        <div class="wrapper">
            <div id="primary" class="content-area theme-sticky-component">

                <?php
                while (have_posts()) :
                    the_post();
                    $magazinemax_post_layout = esc_html(get_post_meta($post->ID, 'magazinemax_post_layout', true));
                    if ($magazinemax_post_layout == 'layout-1' || empty($magazinemax_post_layout)) {
                        get_template_part('template-parts/single/banner/banner-layout-1');
                    }
                    get_template_part('template-parts/content', get_post_type());

                    the_post_navigation(
                        array(
                            'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'magazinemax') . '</span> <span class="nav-title">%title</span>',
                            'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'magazinemax') . '</span> <span class="nav-title">%title</span>',
                        )
                    );

                    if ('post' === get_post_type()) :

                        // Get Author Info & related/Author posts
                        $show_author_info = magazinemax_get_option('show_author_info');
                        $show_related_posts = magazinemax_get_option('show_related_posts');
                        $show_author_posts = magazinemax_get_option('show_author_posts');

                        if ($show_author_info):
                            get_template_part('template-parts/single/author-info');
                        endif;

                        if ($show_related_posts):
                            get_template_part('template-parts/single/related-posts');
                        endif;

                        if ($show_author_posts):
                            get_template_part('template-parts/single/author-posts');
                        endif;

                    endif;

                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;

                endwhile; // End of the loop.
                ?>

            </div><!-- #primary -->
            <?php
            if ('no-sidebar' != $page_layout) {
                get_sidebar();
            }
            ?>
        </div>
    </main>


    <!--sticky-article-navigation starts-->
<?php $show_sticky_article_navigation = magazinemax_get_option('show_sticky_article_navigation');
if ($show_sticky_article_navigation) {
    $next_post = get_next_post();
    $prev_post = get_previous_post(); ?>
    <div class="sticky-article-navigation">
        <?php if (isset($prev_post->ID)) {

            $prev_link = get_permalink($prev_post->ID); ?>
            <a class="sticky-article-link sticky-article-prev" href="<?php echo esc_url($prev_link); ?>">
                <div class="sticky-article-icon">
                    <?php magazinemax_theme_svg('arrow-left'); ?>
                </div>
                <article id="post-<?php the_ID(); ?>" <?php post_class('theme-article-post theme-sticky-article'); ?>>
                    <?php if (has_post_thumbnail()): ?>
                        <div class="entry-image entry-image-thumbnail">
                            <?php if (get_the_post_thumbnail($prev_post->ID, 'medium')) { ?>
                                <?php echo wp_kses_post(get_the_post_thumbnail($prev_post->ID, 'medium')); ?>
                            <?php } ?>
                        </div>
                    <?php endif; ?>
                    <div class="entry-details">
                        <h3 class="entry-title entry-title-small">
                            <?php echo esc_html(get_the_title($prev_post->ID)); ?>
                        </h3>
                    </div>
                </article>
            </a>

        <?php }

        if (isset($next_post->ID)) {

            $next_link = get_permalink($next_post->ID); ?>

            <a class="sticky-article-link sticky-article-next" href="<?php echo esc_url($next_link); ?>">
                <div class="sticky-article-icon">
                    <?php magazinemax_theme_svg('arrow-right'); ?>
                </div>
                <article id="post-<?php the_ID(); ?>" <?php post_class('theme-article-post theme-sticky-article'); ?>>
                    <?php if (has_post_thumbnail()): ?>
                        <div class="entry-image entry-image-thumbnail">
                            <?php if (get_the_post_thumbnail($next_post->ID, 'medium')) { ?>
                                <?php echo wp_kses_post(get_the_post_thumbnail($next_post->ID, 'medium')); ?>
                            <?php } ?>
                        </div>
                    <?php endif; ?>
                    <div class="entry-details">
                        <h3 class="entry-title entry-title-small">
                            <?php echo esc_html(get_the_title($next_post->ID)); ?>
                        </h3>
                    </div>
                </article>
            </a>

            <?php
        } ?>
    </div>


<?php } ?>
    <!--sticky-article-navigation ends-->
<?php
magazinemax_set_post_views(get_the_ID());//single.php
?>