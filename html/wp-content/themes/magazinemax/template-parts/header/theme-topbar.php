<?php
/**
 * Displays the Topbar
 *
 * @package Magazinemax
 */
$hide_topbar_on_mobile = magazinemax_get_option('hide_topbar_on_mobile');

$enable_topbar_nav = magazinemax_get_option('enable_topbar_nav');
$enable_topbar_social_icons = magazinemax_get_option('enable_topbar_social_icons');

$enable_topbar_date = magazinemax_get_option('enable_topbar_date');
$enable_topbar_time = magazinemax_get_option('enable_topbar_time');
?>
<div class="masthead-top-header <?php echo ($hide_topbar_on_mobile) ? 'hide-on-mobile' : ''; ?>">
    <div class="wrapper">
        <div class="site-header-wrapper">
            <div class="site-header-area site-header-left hide-on-mobile">
                <?php
                if ($enable_topbar_nav) :
                    wp_nav_menu(
                        array(
                            'theme_location' => 'top-menu',
                            'container_class' => 'site-header-component header-component-topnav',
                            'fallback_cb' => false,
                            'depth' => 2,
                            'menu_class' => 'theme-menu theme-top-menu theme-topbar-navigation',
                        )
                    );
                endif;
                ?>
            </div>

            <div class="site-header-area site-header-center">
                <?php if ($enable_topbar_date) :
                    $date_format = magazinemax_get_option('todays_date_format', 'l ,  j  F Y');
                    ?>
                    <div class="site-header-component header-component-date">
                        <?php echo date_i18n($date_format, current_time('timestamp')); ?>
                    </div>
                <?php endif; ?>
                <?php if ($enable_topbar_time) : ?>
                    <div class="site-header-component header-component-time">
                        <div class="theme-display-clock"></div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="site-header-area site-header-right">
                <?php
                if ($enable_topbar_social_icons) :
                    wp_nav_menu(
                        array(
                            'theme_location' => 'social-menu',
                            'container_class' => 'site-header-component header-component-socialnav',
                            'fallback_cb' => false,
                            'depth' => 1,
                            'menu_class' => 'theme-menu theme-social-menu theme-topbar-navigation',
                            'link_before' => '<span class="screen-reader-text">',
                            'link_after' => '</span>',
                        )
                    );
                endif;
                ?>
            </div>
        </div>
    </div>
</div>
