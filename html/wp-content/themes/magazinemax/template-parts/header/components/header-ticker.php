<?php
/**
 * Displays Header Ticker
 *
 * @package Magazinemax
 */
$enable_category_meta = magazinemax_get_option('enable_category_meta');
$enable_banner_date_meta = magazinemax_get_option('enable_banner_date_meta');
$ticker_post_title = magazinemax_get_option('ticker_post_title');
$ticker_post_category = magazinemax_get_option('ticker_post_category');
$ticker_post_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 7, 'post__not_in' => get_option("sticky_posts"), 'category__in' => $ticker_post_category));
if ($ticker_post_query->have_posts()): ?>
    <div class="site-header-area header-ticker-bar">
        <div class="wrapper">
            <div class="ticker-news-wrapper">
              <?php if ($ticker_post_title) { ?>
                <div class="ticker-news-title">
                  <h2 class="ticker-title"> <?php  echo esc_html( $ticker_post_title );?></h2>
                </div>
              <?php } ?>

              <div class="site-breaking-news swiper">
                  <div class="swiper-wrapper">
                      <?php while ($ticker_post_query->have_posts()):
                          $ticker_post_query->the_post();
                          ?>
                          <div class="swiper-slide breaking-news-slide">
                              <article id="ticker-post-<?php the_ID(); ?>" <?php post_class('theme-article-post'); ?>>
                                  <div class="entry-details">
                                      <?php the_title('<h3 class="entry-title entry-title-xsmall line-clamp line-clamp-2 m-0"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>
                                  </div>
                              </article>
                          </div>
                      <?php endwhile; ?>
                  </div>
              </div>
            </div>

        </div>
    </div>
    <?php
    wp_reset_postdata();
endif;
