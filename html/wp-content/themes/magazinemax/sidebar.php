<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Magazinemax
 */

if (!is_active_sidebar('magazinemax-sidebar')) {
    return;
}
?>

<aside id="secondary" class="widget-area theme-sticky-component">
    <?php dynamic_sidebar('magazinemax-sidebar'); ?>
</aside><!-- #secondary -->
