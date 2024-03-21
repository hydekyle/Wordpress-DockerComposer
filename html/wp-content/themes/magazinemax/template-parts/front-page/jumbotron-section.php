<?php
/**
 * Displays Jumbotron Section
 *
 * @package Magazinemax
 */
$enable_jumbotron_section = magazinemax_get_option('enable_jumbotron_section');
$jumbotron_section_cat = magazinemax_get_option('jumbotron_section_cat');


$enable_jumbotron_cat_meta = magazinemax_get_option('enable_jumbotron_cat_meta');
$enable_jumbotron_date_meta = magazinemax_get_option('enable_jumbotron_date_meta');
$enable_jumbotron_author_meta = magazinemax_get_option('enable_jumbotron_author_meta');
$enable_jumbotron_post_views = magazinemax_get_option('enable_jumbotron_post_views');
$enable_jumbotron_cat_meta_bg_color = magazinemax_get_option('enable_jumbotron_cat_meta_bg_color');

if ($enable_jumbotron_section) :
    ?>
    <section class="site-section site-jumbotron-section">
        <div class="wrapper">
            <div class="site-jumbotron-area">
                <?php
                $jumbotron_post_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 5, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($jumbotron_section_cat)));
                $count = 1;

                if ($jumbotron_post_query->have_posts()):
                    while ($jumbotron_post_query->have_posts()): $jumbotron_post_query->the_post();
                        ?>
                        <?php if ($count == 1): ?>
                            <div class="jumbotron-left-area">
                                <article id="jumbotron-post-<?php the_ID(); ?>" <?php post_class('theme-article-post article-overlay content-overlay image-hover'); ?>>

                                <div class="jumbotron-content entry-details">
                                  <?php if ($enable_jumbotron_cat_meta) { ?>
                                      <div class="entry-meta">
                                          <?php
                                          if ($enable_jumbotron_cat_meta_bg_color) {
                                              magazinemax_posted_categories_has_background();
                                          } else {
                                              magazinemax_posted_categories();
                                          } ?>
                                      </div>
                                      <?php
                                  } ?>

                                  <?php the_title('<h3 class="entry-title entry-title-big title-hover mb-4"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>

                                  <div class="theme-article-excerpt mb-4">
                                      <?php the_excerpt(); ?>
                                  </div>

                                  <div class="entry-meta">
                                      <?php if ($enable_jumbotron_date_meta) {
                                          magazinemax_posted_on();
                                      } ?>
                                  </div>
                                </div>

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
                            </div>
                            <div class="jumbotron-right-area">
                            <?php $count++; ?>
                        <?php else: ?>
                            <article id="jumbotron-post-<?php the_ID(); ?>" <?php post_class('theme-article-post article-overlay content-overlay image-hover'); ?>>
                            
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="entry-image">
                                        <a href="<?php the_permalink() ?>">
                                            <?php
                                            the_post_thumbnail('small', array(
                                                'alt' => the_title_attribute(array(
                                                    'echo' => false,
                                                )),
                                            ));
                                            ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <div class="jumbotron-content entry-details">
                                  <?php if ($enable_jumbotron_cat_meta) { ?>
                                      <div class="entry-meta entry-meta-top">
                                          <?php magazinemax_posted_categories(); ?>
                                      </div>
                                      <?php
                                  } ?>

                                    <?php the_title('<h3 class="entry-title entry-title-small title-hover mb-4"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>

                                    <?php if ($enable_jumbotron_date_meta) { ?>
                                        <div class="entry-meta hide-on-tablet">
                                            <?php magazinemax_posted_on(); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </article>
                            <?php if ($jumbotron_post_query->current_post + 1 == $jumbotron_post_query->post_count): ?>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </section>
<?php endif;