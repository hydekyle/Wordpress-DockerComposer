<?php
/**
 * The template for displaying all single banner layout 1
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Magazinemax
 */
global $post;
$magazinemax_post_layout = esc_html(get_post_meta($post->ID, 'magazinemax_post_layout', true));
if (empty($magazinemax_post_layout)) {
    $magazinemax_post_layout = 'layout-1';
}
if ($magazinemax_post_layout == "layout-1") { ?>
    <header class="single-banner-header single-banner-default">
            <?php magazinemax_post_thumbnail(); ?>

            <?php
            the_title('<h1 class="entry-title entry-title-big">', '</h1>');

            if ('post' === get_post_type()) :
                ?>
                <div class="entry-meta">
                    <?php
                    magazinemax_posted_on();
                    magazinemax_posted_by();
                    ?>
                </div><!-- .entry-meta -->
            <?php endif; ?>
    </header><!-- .entry-header -->

<?php } ?>