<?php
/**
 * Displays recommended post on footer.
 *
 * @package Magazinemax
 */
$enable_footer_recommended_post_section = magazinemax_get_option('enable_footer_recommended_post_section');

$enable_category_meta = magazinemax_get_option('enable_category_meta');
$enable_date_meta = magazinemax_get_option('enable_date_meta');
$enable_post_excerpt = magazinemax_get_option('enable_post_excerpt');
$enable_author_meta = magazinemax_get_option('enable_author_meta');
$enable_post_views = magazinemax_get_option('enable_post_views');
$footer_recommended_post_title = magazinemax_get_option('footer_recommended_post_title');
$select_cat_for_footer_recommended_post = magazinemax_get_option('select_cat_for_footer_recommended_post');
if ($enable_footer_recommended_post_section) :
    ?>
    <section class="site-section site-recommendation-section">
        <div class="wrapper">
            <header class="section-header theme-section-header">
                <h2 class="site-section-title">
                    <?php echo esc_html($footer_recommended_post_title); ?>
                </h2>
            </header>
        </div>
        <div class="wrapper">
            <div class="column-row">

            <?php $footer_recommended_post_query = new WP_Query(array(
            'post_type' => 'post', 'posts_per_page' => 7,
            'post__not_in' => get_option("sticky_posts"),
            'category_name' => esc_html($select_cat_for_footer_recommended_post)
            ));
            $counter = 1;
            if ($footer_recommended_post_query->have_posts()):
                while ($footer_recommended_post_query->have_posts()): $footer_recommended_post_query->the_post();
                    ?>
                    <?php if ($counter <= 3) { 
                        $column_class = "column-4";
                        $font_size="entry-title-medium";
                        }else {
                        $column_class = "column-3";
                        $font_size="entry-title-small";
                        }
                        $counter++;
                        ?>
                        <div class="column <?php echo esc_attr($column_class); ?> column-sm-6 column-xs-12 mb-30">
                        <article id="recommended-post-<?php the_ID(); ?>" <?php post_class('theme-article-post theme-article-default theme-recommended-post image-hover'); ?>>

                            <?php if (has_post_thumbnail()): ?>
                                <div class="entry-image entry-image-medium">
                                    <a href="<?php the_permalink() ?>">
                                        <?php
                                        the_post_thumbnail('medium_large', array(
                                            'alt' => the_title_attribute(array(
                                                'echo' => false,
                                            )),
                                        ));
                                        ?>
                                    </a>
                                    <?php magazinemax_social_share(); ?>
                                </div>
                            <?php endif; ?>
                            <div class="entry-details">
                                <?php if ($enable_category_meta) { ?>
                                    <div class="entry-meta entry-meta-top">
                                        <?php magazinemax_posted_categories(); ?>
                                    </div>
                                <?php } ?>


                                <?php the_title('<h3 class="entry-title '.$font_size.' mb-4"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>

                                <div class="entry-meta">
                                    <?php if ($enable_date_meta) {
                                        magazinemax_posted_on();
                                    } ?>
                                </div>
                            </div>
                         </article>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
    <?php
    wp_reset_postdata();
    endif;
endif;
?>