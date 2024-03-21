<?php
/**
 * Displays recommended post on footer.
 *
 * @package magazinemax
 */

$enable_read_more_post_section = magazinemax_get_option('enable_read_more_post_section');

$enable_banner_cat_meta = magazinemax_get_option('enable_banner_cat_meta');
$enable_date_meta = magazinemax_get_option('enable_date_meta');
$enable_post_excerpt = magazinemax_get_option('enable_post_excerpt');
$read_more_post_title = magazinemax_get_option('read_more_post_title');
$enable_read_more_category_meta = magazinemax_get_option('enable_read_more_category_meta');
$enable_read_more_category_meta_color = magazinemax_get_option('enable_read_more_category_meta_color');
$select_cat_for_read_more_post = magazinemax_get_option('select_cat_for_read_more_post');
$select_cat_for_read_more_list_post = magazinemax_get_option('select_cat_for_read_more_list_post');
$flip_read_more_post_section = magazinemax_get_option('flip_read_more_post_section');
$counter = 1;
$order_column_class = "column-order-1";
$order_column_class_1 = "column-order-2 column-border-l";
if ($flip_read_more_post_section) {
    $order_column_class = "column-order-2";
    $order_column_class_1 = "column-order-1 column-border-r";
}
?>
<?php if ($enable_read_more_post_section) :
?>
<section class="site-section site-read-more-section">
    <div class="wrapper">
        <header class="section-header theme-section-header">
            <h2 class="site-section-title">
                <?php echo esc_html($read_more_post_title); ?>
            </h2>
        </header>
        <div class="column-row">
            <div class="column column-8 column-md-12 column-sm-12 <?php echo esc_attr($order_column_class); ?> mb-md-48">
                <div class="column-row column-row-small">
                    <?php $more_to_read_post_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 4, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($select_cat_for_read_more_post)));
                    if ($more_to_read_post_query->have_posts()) :
                        while ($more_to_read_post_query->have_posts()) : $more_to_read_post_query->the_post();
                            if ($counter == 1) {
                                $article_class = 'theme-article-list article-list-big article-list-center mb-15';
                                $column_class = 'column-12';
                                $image_class = 'entry-image-big';
                                $article_title_class = 'entry-title-big';
                                $counter++;
                              } else {
                                $article_class = 'theme-default-post mb-10';
                                $column_class = 'column-4';
                                $image_class = 'entry-image-medium mb-10';
                                $article_title_class = 'entry-title-small';
                            }
                            ?>
                            <div class="column <?php echo $column_class; ?> column-sm-12">
                                <article id="read-more-<?php the_ID(); ?>" <?php post_class('theme-article-post theme-more-news image-hover ' . $article_class); ?>>
                                    <?php if (has_post_thumbnail()) { ?>
                                        <div class="entry-image <?php echo $image_class; ?>">
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
                                    <?php } ?>
                                    <div class="entry-details">
                                        <?php if ($enable_read_more_category_meta) { ?>
                                            <div class="entry-meta">
                                                <?php 
                                                if ($enable_read_more_category_meta_color) {
                                                    magazinemax_posted_categories_has_background();
                                                } else {
                                                    magazinemax_posted_categories(); 
                                                }
                                                ?>
                                            </div>
                                        <?php } ?>
                                        <?php the_title('<h3 class="entry-title ' . $article_title_class . ' mb-4"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>

                                        <div class="theme-article-excerpt mb-4">
                                            <?php the_excerpt(); ?>
                                        </div>

                                        <div class="entry-meta">
                                            <?php if ($enable_date_meta) { ?>
                                                <?php magazinemax_posted_on(); ?>
                                            <?php } ?>
                                        </div>

                                    </div>
                                </article>
                            </div>
                        <?php
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="column column-4 column-md-12 column-sm-12 <?php echo esc_attr($order_column_class_1); ?>">
                <?php $more_to_read_list_post_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 6, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($select_cat_for_read_more_list_post)));
                if ($more_to_read_list_post_query->have_posts()) :
                    while ($more_to_read_list_post_query->have_posts()) : $more_to_read_list_post_query->the_post();
                        ?>
                        <article id="readmore-aside-<?php the_ID(); ?>" <?php post_class('theme-article-post theme-article-list article-list-center article-border article-border-small image-hover mb-10'); ?>>

                                <?php if (has_post_thumbnail()) { ?>
                                    <div class="entry-image entry-image-thumbnail">
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
                                <?php } ?>

                                <div class="entry-details">
                                  <?php if ($enable_banner_cat_meta) { ?>
                                      <div class="entry-meta entry-meta-top">
                                          <?php magazinemax_posted_categories(); ?>
                                      </div>
                                      <?php
                                  } ?>

                                  <?php the_title('<h3 class="entry-title entry-title-small line-clamp line-clamp-2 mb-4"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>

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
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php endif;