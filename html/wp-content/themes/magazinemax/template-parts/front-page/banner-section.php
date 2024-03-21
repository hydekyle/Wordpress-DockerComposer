<?php
/**
 * Displays Banner Section
 *
 * @package Magazinemax
 */
$is_banner_section = magazinemax_get_option('enable_banner_section');
$enable_banner_overlay = magazinemax_get_option('enable_banner_overlay');
$site_fallback_image = magazinemax_get_option('site_fallback_image');
$banner_section_cat = magazinemax_get_option('banner_section_cat');
$number_of_slider_post = magazinemax_get_option('number_of_slider_post');
$enable_banner_cat_meta = magazinemax_get_option('enable_banner_cat_meta');
$enable_banner_cat_meta_color = magazinemax_get_option('enable_banner_cat_meta_color');
$enable_banner_author_meta = magazinemax_get_option('enable_banner_author_meta');
$enable_banner_date_meta = magazinemax_get_option('enable_banner_date_meta');
$enable_banner_post_views = magazinemax_get_option('enable_banner_post_views');
$enable_banner_post_description = magazinemax_get_option('enable_banner_post_description');
$banner_button_text = magazinemax_get_option('banner_button_text');
$banner_overlay_class = '';
if ($enable_banner_overlay) {
    $banner_overlay_class = 'swiper-slide-has-overlay';
}

if ($is_banner_section) :
    ?>
    <section class="site-section site-banner-section">
      <div class="wrapper">
        <div class="theme-swiper-wrapper">
            <?php
            $slider_pagenav = '';
            $banner_post_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => absint($number_of_slider_post), 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($banner_section_cat)));
            if ($banner_post_query->have_posts()): ?>
                <div class="site-banner-hero swiper-banner-container swiper-container swiper">
                    <div class="swiper-wrapper">
                        <?php while ($banner_post_query->have_posts()): $banner_post_query->the_post(); ?>
                            <div class="swiper-slide swiper-hero-slide <?php echo $banner_overlay_class; ?> image-hover">
                                <div class="swiper-slide-image hero-slide-image entry-image">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php
                                        the_post_thumbnail('large', array(
                                            'alt' => the_title_attribute(array(
                                                'echo' => false,
                                            )),
                                        ));
                                        ?>
                                    <?php else : ?>
                                        <img src="<?php echo esc_url($site_fallback_image); ?>"
                                             alt="<?php echo esc_attr(get_the_title()); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="site-banner-description">
                                    <?php if ($enable_banner_cat_meta) { ?>
                                        <div class="entry-meta">
                                            <?php
                                            if ($enable_banner_cat_meta_color) {
                                                magazinemax_posted_categories_has_background();
                                            } else {
                                                magazinemax_posted_categories();
                                            } ?>
                                        </div>
                                        <?php
                                    } ?>

                                    <?php the_title('<h3 class="entry-title entry-title-large title-hover line-clamp line-clamp-3"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>

                                    <?php
                                    if ($enable_banner_post_description && has_excerpt()): ?>
                                        <div class="entry-details">
                                            <?php the_excerpt(); ?>
                                        </div>
                                    <?php elseif ($enable_banner_post_description): ?>
                                        <div class="entry-details mb-10">
                                            <?php echo esc_html(wp_trim_words(get_the_content(), 25, '...')); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="entry-meta mb-20">
                                        <?php if ($enable_banner_date_meta) {
                                            magazinemax_posted_on();
                                        } ?>
                                    </div>
                                    <?php if (!empty($banner_button_text)) { ?>
                                        <a href="<?php the_permalink() ?>" class="theme-button theme-button-medium">
                                            <?php echo esc_html($banner_button_text); ?>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php
                            $slider_pagenav .= '<div class="swiper-slide swiper-pagination-slide">';
                            $slider_pagenav .= '<div class="swiper-pagination-content theme-article-list article-list-center">';
                            $slider_pagenav .= '<figure class="entry-image entry-image-thumbnail m-0">';
                            if (has_post_thumbnail()) {
                              $slider_pagenav .= '<img src="' . get_the_post_thumbnail_url(get_the_ID(), 'medium_large') . '">';
                            } else {
                              $slider_pagenav .= '<img src="' . esc_url($site_fallback_image) . '">';
                            }
                            $slider_pagenav .= '</figure>';
                            $slider_pagenav .= '<div class="entry-details">';
                            $slider_pagenav .= '<h2 class="entry-title entry-title-small line-clamp line-clamp-2">'.esc_html(wp_trim_words( get_the_title() )).'</h2>';
                            $slider_pagenav .= get_the_date('',get_the_ID());
                            $slider_pagenav .= '</div>';
                            $slider_pagenav .= '</div>';
                            $slider_pagenav .= '</div>';
                            ?>
                        <?php
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>

                    <div class="swiper-pagination"></div>
                </div>
            <?php endif; ?>
        </div>
      </div>
    </section>
<?php endif;