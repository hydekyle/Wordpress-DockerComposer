<?php
/**
 * Show the excerpt.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Magazinemax
 * @since Magazinemax 1.0.0
 */
if (absint(magazinemax_get_option('excerpt_length')) != '0') {
    the_excerpt();
}