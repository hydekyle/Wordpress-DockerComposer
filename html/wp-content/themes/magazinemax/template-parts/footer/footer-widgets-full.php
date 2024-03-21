<?php
/**
 * Displays before footer widget area.
 *
 * @package Magazinemax
 */

if (is_active_sidebar('fullwidth-footer-widgetarea')) : ?>

    <section class="site-section site-section-widgets section-widgets-fullwidth footer-fullwidth-widgets" role="complementary">
        <?php dynamic_sidebar('fullwidth-footer-widgetarea'); ?>
    </section>

<?php endif; ?>