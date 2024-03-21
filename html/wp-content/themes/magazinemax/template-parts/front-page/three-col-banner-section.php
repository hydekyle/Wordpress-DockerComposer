<?php
/**
 * Displays 3 Column Hero Banner
 *
 * @package Magazinemax
 */
$enable_jumbotron_cat_meta = magazinemax_get_option('enable_jumbotron_cat_meta');
$enable_three_col_hero_banner = magazinemax_get_option('enable_three_col_hero_banner');
$three_col_banner_cat_1 = magazinemax_get_option('three_col_banner_cat_1');
$three_col_banner_cat_3 = magazinemax_get_option('three_col_banner_cat_3');
$site_fallback_image = '';
$enable_date_meta = magazinemax_get_option('enable_date_meta');

if ($enable_three_col_hero_banner) :
?>
<section class="site-section site-content-hero">
    <div class="wrapper">
        <div class="column-row">
            <?php
            $first_column_query = new WP_Query(array(
                'post_type' => 'post',
                'posts_per_page' => 3,
                'post__not_in' => get_option("sticky_posts"),
                'category_name' => esc_html($three_col_banner_cat_1)
            ));
            if ($first_column_query->have_posts()): ?>
                <div class="column column-8 column-sm-12 mb-sm-30">
                    <?php
                    $post_count = 0;
                    while ($first_column_query->have_posts()): $first_column_query->the_post();
                        $post_count++;
                        if ($post_count === 1) :
                            ?>
                            <div class="hero-prime-stories">
                                <article id="hero-first-post-<?php the_ID(); ?>" <?php post_class('theme-article-post article-overlay content-overlay image-hover'); ?>>
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="entry-image entry-image-big">
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
                                      <?php if ($enable_jumbotron_cat_meta) { ?>
                                        <div class="entry-meta entry-meta-top">
                                            <?php magazinemax_posted_categories(); ?>
                                        </div>
                                        <?php
                                      } ?>

                                      <?php the_title('<h3 class="entry-title entry-title-big title-hover mb-4"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>

                                        <?php if ($enable_date_meta) { ?>
                                            <div class="entry-meta">
                                                <?php magazinemax_posted_on(); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </article>
                            </div>
                        <?php else : ?>
                            <?php if ($post_count === 2) : ?>
                                <div class="hero-sub-stories">
                            <?php endif; ?>
                            <article id="hero-first-post-<?php the_ID(); ?>" <?php post_class('theme-article-post article-overlay content-overlay image-hover'); ?>>
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="entry-image entry-image-medium">
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
                                  <?php if ($enable_jumbotron_cat_meta) { ?>
                                    <div class="entry-meta entry-meta-top">
                                        <?php magazinemax_posted_categories(); ?>
                                    </div>
                                    <?php
                                  } ?>

                                  <?php the_title('<h3 class="entry-title entry-title-medium title-hover mb-4"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>

                                    <?php if ($enable_date_meta) { ?>
                                        <div class="entry-meta">
                                            <?php magazinemax_posted_on(); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </article>
                            <?php if ($first_column_query->current_post + 1 == $first_column_query->post_count): ?>
                                </div>
                            <?php endif; ?>
                        <?php
                        endif;
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            <?php endif; ?>
            <?php
            $third_column_query = new WP_Query(array(
                'post_type' => 'post', 'posts_per_page' => 6,
                'post__not_in' => get_option("sticky_posts"),
                'category_name' => esc_html($three_col_banner_cat_3)
            ));
            $counter = 1;
            if ($third_column_query->have_posts()): ?>
                <div class="column column-4 column-sm-12">
                    <?php while ($third_column_query->have_posts()): $third_column_query->the_post(); ?>
                        <article id="hero-third-post-<?php the_ID(); ?>" <?php post_class('theme-article-post article-border article-with-index mb-15'); ?>>
                        <div class="article-index"><?php echo absint($counter++); ?></div>

                        <div class="entry-details">
                          <?php the_title('<h3 class="entry-title entry-title-small mb-4"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>

                          <?php if ($enable_date_meta) { ?>
                              <div class="entry-meta">
                                  <?php magazinemax_posted_on(); ?>
                              </div>
                          <?php } ?>
                        </div>
                        </article>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php
endif;