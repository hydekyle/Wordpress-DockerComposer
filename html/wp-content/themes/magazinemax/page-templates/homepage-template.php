<?php
/**
 * Template Name: Homepage Page Template
 * Template Post Type: post, page, product
 * Displays the Page Template provided via the theme.
 *
 * @package    Magazinemax
 * @since      Magazinemax 1.0.0
 */

get_header();

if (!function_exists('display_fullwidth_sidebar')) {
    function display_fullwidth_sidebar($area) {
        if (is_active_sidebar($area)) {
            do_action("magazinemax_homepage_fullwidth_before_widgets"); ?>

            <section class="site-section site-section-widgets section-widgets-fullwidth homepage-fullwidth-widgets">
                <?php dynamic_sidebar($area); ?>
            </section>

            <?php do_action("magazinemax_homepage_fullwidth_after_widgets");
        }
    }
}

if (!function_exists('display_sidebar')) {
    function display_sidebar($area) {
        $content_active = is_active_sidebar("magazinemax-{$area}-content-area");
        $sidebar_active = is_active_sidebar("magazinemax-{$area}-sidebar-area");

        if ($content_active || $sidebar_active) {
            do_action("magazinemax_homepage_{$area}_before_widgets"); ?>

            <section class="site-section site-section-widgets widgets-column-two homepage-<?php echo "{$area}-widgets"; ?>">
                <div class="wrapper">
                    <div class="column-row">
                        <?php
                        $content_class = $sidebar_class = 'column column-12';

                        if ($content_active && $sidebar_active) {
                            $content_class = 'column column-8 column-sm-12';
                            $sidebar_class = 'column column-4 column-sm-12';
                        }

                        ?>
                        <div class="<?php echo $content_class; ?>">
                            <?php dynamic_sidebar("magazinemax-{$area}-content-area"); ?>
                        </div>

                        <div class="<?php echo $sidebar_class; ?>">
                            <?php dynamic_sidebar("magazinemax-{$area}-sidebar-area"); ?>
                        </div>
                    </div>
                </div>
            </section>

            <?php do_action("magazinemax_homepage_{$area}_after_widgets");
        }
    }
}

display_sidebar('upper');
display_fullwidth_sidebar('magazinemax-homepage-fullwidth');
display_sidebar('lower');

get_footer();
?>