<?php

$is_sticky = magazinemax_get_option('enable_sticky_menu');

$enable_dark_mode = magazinemax_get_option('enable_dark_mode');
$enable_dark_mode_switcher = magazinemax_get_option('enable_dark_mode_switcher');

?>
<div class="masthead-bottom-header">
  <div class="wrapper">
    <div class="site-header-area site-header-top">
      <?php if (is_active_sidebar('magazinemax-offcanvas-widget')): ?>

        <button id="theme-offcanvas-widget-button"
                class="theme-button theme-button-transparent theme-button-offcanvas">
            <span class="screen-reader-text"><?php _e('Offcanvas Widget', 'magazinemax'); ?></span>
            <span class="toggle-icon"><?php magazinemax_theme_svg('menu-alt'); ?></span>
        </button>

      <?php endif; ?>

      <?php get_template_part('template-parts/header/site-branding'); ?>
    </div>

    <div class="site-header-area site-header-bottom  <?php echo ($is_sticky) ? 'has-sticky-header' : ''; ?>">
      <div class="site-header-wrapper">

        <div class="site-header-left">
          <div id="site-navigation" class="main-navigation theme-primary-menu">
              <?php
              if (has_nav_menu('primary-menu')) {
                  ?>
                  <nav class="primary-menu-wrapper"
                        aria-label="<?php echo esc_attr_x('Primary', 'menu', 'magazinemax'); ?>">
                      <ul class="primary-menu reset-list-style">
                          <?php
                          wp_nav_menu(
                              array(
                                  'container' => '',
                                  'items_wrap' => '%3$s',
                                  'theme_location' => 'primary-menu'
                              )
                          );
                          ?>
                      </ul>
                  </nav><!-- .primary-menu-wrapper -->
                  <?php
              } else { ?>
                  <nav class="primary-menu-wrapper"
                        aria-label="<?php echo esc_attr_x('Primary', 'menu', 'magazinemax'); ?>">
                      <ul class="primary-menu reset-list-style">
                          <?php
                          wp_list_pages(
                              array(
                                  'match_menu_classes' => true,
                                  'show_sub_menu_icons' => true,
                                  'title_li' => false,
                              )
                          );

                          ?>
                      </ul>
                  </nav><!-- .primary-menu-wrapper -->

              <?php } ?>
          </div><!-- .main-navigation -->
        </div>

        <div class="site-header-right">
          <?php if ($enable_dark_mode && $enable_dark_mode_switcher) : ?>
              <button class="theme-button theme-button-transparent theme-button-colormode"
                      title="<?php _e('Toggle light/dark mode', 'magazinemax'); ?>" aria-label="auto"
                      aria-live="polite">
                  <span class="screen-reader-text"><?php _e('Switch color mode', 'magazinemax'); ?></span>
                  <span id="colormode-switch-area">
                      <span id="mode-icon-switch"></span>
                      <span class="mode-icon-change"></span>
                  </span>
              </button>
          <?php endif; ?>

          <?php $blog_mini_cart = magazinemax_get_option('enable_mini_cart_header');
          if ($blog_mini_cart && class_exists('WooCommerce')) {
              magazinemax_woocommerce_cart_count();
          } ?>

          <?php
          $enable_random_post = magazinemax_get_option('enable_random_post');
          if ($enable_random_post) {
              $random_post_category = magazinemax_get_option('random_post_category');
              $random_post_title = magazinemax_get_option('random_post_title');
              $rand_posts_arg = array(
                  'posts_per_page' => 1,
                  'orderby' => 'rand'
              );
              if ($random_post_category) {
                  $rand_posts_arg['cat'] = absint($random_post_category);
              }
              $rand_posts = get_posts($rand_posts_arg);

              if ($rand_posts) {
                  ?>
                  <a href="<?php echo esc_url(get_permalink($rand_posts[0]->ID)); ?>" class="theme-button theme-button-secondary theme-button-small">
                      <?php magazinemax_theme_svg('shuffle'); ?>
                      <?php echo esc_html($random_post_title); ?>
                  </a>
                  <?php
              }
          }
          ?>

          <button id="theme-toggle-search-button"
                  class="theme-button theme-button-transparent theme-button-search" aria-expanded="false"
                  aria-controls="theme-header-search">
              <span class="screen-reader-text"><?php _e('Search', 'magazinemax'); ?></span>
              <?php magazinemax_theme_svg('search'); ?>
          </button>

          <button id="theme-toggle-offcanvas-button"
                  class="hide-on-desktop theme-button theme-button-transparent theme-button-offcanvas"
                  aria-expanded="false" aria-controls="theme-offcanvas-navigation">
              <span class="screen-reader-text"><?php _e('Menu', 'magazinemax'); ?></span>
              <span class="toggle-icon"><?php magazinemax_theme_svg('menu'); ?></span>
          </button>
        </div>

      </div>
    </div>
  </div>
</div>