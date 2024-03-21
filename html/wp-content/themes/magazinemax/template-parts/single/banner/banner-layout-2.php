<?php
/**
 * The template for displaying all single posts banner layout 2
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Magazinemax
 */
global $post;
$magazinemax_post_layout = esc_html(get_post_meta($post->ID, 'magazinemax_post_layout', true));
$author_id = get_post_field('post_author', get_the_ID());
if ($magazinemax_post_layout == "layout-2") {
    $magazinemax_header_overlay = esc_html(get_post_meta($post->ID, 'magazinemax_header_overlay', true));
    ?>
    <header class="single-banner-header single-featured-banner single-banner-2">
        <div class="featured-banner-media <?php echo esc_attr($magazinemax_header_overlay); ?>">
            <?php if (has_post_thumbnail()) : ?>
                <?php
                the_post_thumbnail('full', array(
                    'alt' => get_the_title(),
                    'class' => 'single-featured-attachment',
                ));
                ?>
            <?php endif; ?>
        </div>
        <div class="featured-banner-content">
            <div class="wrapper">
                <?php
                the_title('<h1 class="entry-title entry-title-large">', '</h1>');
                if ('post' === get_post_type()) :
                    ?>
                    <div class="entry-meta">
                        <?php
                        magazinemax_posted_on();
                        magazinemax_posted_by();
                        ?>
                    </div><!-- .entry-meta -->
                <?php endif; ?>
                <?php
                if (has_excerpt()): ?>
                    <div class="entry-summary">
                        <?php the_excerpt(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </header>
<?php } ?>