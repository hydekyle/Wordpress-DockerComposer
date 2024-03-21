<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Magazinemax
 */
get_header();
// Add a main container in case if sidebar is present
$class = '';
$page_layout = magazinemax_get_page_layout();
global $post;
$magazinemax_page_layout = esc_html(get_post_meta($post->ID, 'magazinemax_page_layout', true));

if ($magazinemax_page_layout == "layout-2") { 
    $magazinemax_header_overlay = esc_html(get_post_meta($post->ID, 'magazinemax_header_overlay', true));
    ?>
    <div class="single-featured-banner">
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
                <header class="entry-header">
                    <?php the_title('<h1 class="entry-title entry-title-large">', '</h1>'); ?>
                </header><!-- .entry-header -->
            </div>
        </div>
    </div>
<?php } ?>
    <main id="site-content" role="main">
        <div class="wrapper">
            <div id="primary" class="content-area theme-sticky-component">
                <?php
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/content', 'page');
                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                endwhile; // End of the loop.
                ?>
            </div><!-- #primary -->
        </div>
    </main>
<?php
get_footer();