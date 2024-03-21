<?php
/**
 * Displays the site header.
 *
 * @package Magazinemax
 */

$wrapper_classes = 'site-header theme-site-header';

$enable_header_bg_overlay = magazinemax_get_option('enable_header_bg_overlay');
$header_image_size = magazinemax_get_option('header_image_size');
$enable_top_bar = magazinemax_get_option('enable_top_bar');
$enable_ticker_post =  magazinemax_get_option('enable_ticker_post');
?>

<?php


if ($enable_header_bg_overlay) {
    $wrapper_classes .= ' header-has-overlay';
}
$wrapper_classes .= ' header-has-height-' . $header_image_size;
if (!empty(get_header_image())) {
    $wrapper_classes .= ' data-bg';
}
?>
<header id="masthead"
        class="<?php echo esc_attr($wrapper_classes); ?> " <?php if (!empty(get_header_image())) { ?> data-background="<?php echo esc_url(get_header_image()); ?>" <?php } ?>
        role="banner">
    <?php
    if ($enable_top_bar) {
        get_template_part('template-parts/header/theme-topbar');
    }
    get_template_part('template-parts/header/components/header-trending-tags');
    get_template_part('template-parts/header/styles/style-1');
    ?>
</header><!-- #masthead -->

<?php if ($enable_ticker_post) {
    get_template_part('template-parts/header/components/header-ticker');
} ?>
