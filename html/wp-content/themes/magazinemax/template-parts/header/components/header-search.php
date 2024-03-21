<?php
/**
 * Displays Search
 *
 * @package Magazinemax
 */

?>

<div class="theme-search-panel">
    <div class="wrapper">
        <div id="theme-header-search" class="search-panel-wrapper">
            <?php
            get_search_form(
                array(
                    'aria_label' => __('Search for:', 'magazinemax'),
                )
            );
            ?>
            <button id="magazinemax-search-canvas-close" class="theme-button theme-button-transparent search-close">
                <span class="screen-reader-text">
                    <?php _e('Close search', 'magazinemax'); ?>
                </span>
                <?php magazinemax_theme_svg('close'); ?>
            </button><!-- .search-toggle -->
        </div>
    </div>
</div> <!-- theme-search-panel -->