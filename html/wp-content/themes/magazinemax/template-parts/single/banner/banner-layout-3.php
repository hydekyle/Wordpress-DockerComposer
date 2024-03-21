<?php
/**
 * The template for displaying all single banner layout 3
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Magazinemax
 */
global $post;
$magazinemax_post_layout = esc_html(get_post_meta($post->ID, 'magazinemax_post_layout', true));
if (empty($magazinemax_post_layout)) {
    $magazinemax_post_layout = 'layout-3';
}
if ($magazinemax_post_layout == "layout-3") {
    $magazinemax_header_overlay = esc_html(get_post_meta($post->ID, 'magazinemax_header_overlay', true));
    ?>
    <header class="single-banner-header single-featured-banner single-banner-3">
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
    </header><!-- .entry-header -->
<?php } ?>