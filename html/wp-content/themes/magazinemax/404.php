<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Magazinemax
 */
get_header();
?>

    <section class="site-section site-error-section error-block-top">
        <div class="wrapper">
            <h1 class="entry-title entry-title-large"><?php esc_html_e('Dang', 'magazinemax'); ?></h1>
            <div class="site-section-subtitle">
                <?php esc_html_e('No page found. Sorry about that, let\'s keep you moving.', 'magazinemax'); ?>
            </div>
        </div>
    </section>
    <section class="site-section site-error-section error-block-middle">
        <div class="wrapper">
            <div class="column-row">
                <div class="column column-12">
                    <h2 class="entry-title entry-title-large"><?php esc_html_e('Maybe it’s out there, somewhere...', 'magazinemax'); ?></h2>
                    <div class="entry-subtitle">
                        <?php esc_html_e('In the meantime you can go back to on our', 'magazinemax'); ?>
                        <a href="<?php echo esc_url(home_url()); ?>"><span class="highlight"><?php esc_html_e('Homepage', 'magazinemax'); ?></span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="site-section site-error-section error-block-bottom">
        <div class="wrapper">
            <div class="column-row">
                <div class="column column-12">
                    <h3 class="entry-title entry-title-big"><?php esc_html_e('Still feeling lost? You’re not alone.', 'magazinemax'); ?></h3>
                    <p><?php esc_html_e('Enjoy these stories about getting lost, losing things, and finding what you never knew you were looking for.', 'magazinemax'); ?></p>
                </div>
            </div>
        </div>
        <?php
        magazinemax_404_posts();
        ?>
    </section>

<?php
get_footer();

