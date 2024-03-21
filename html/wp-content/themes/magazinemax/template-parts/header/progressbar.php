<?php
/**
 * Displays progressbar
 *
 * @package Magazinemax
 */

$show_progressbar = magazinemax_get_option('show_progressbar');

if ($show_progressbar) :
    $progressbar_position = magazinemax_get_option('progressbar_position');
    echo '<div id="magazinemax-progress-bar" class="theme-progress-bar ' . esc_attr($progressbar_position) . '"></div>';
endif;
