<?php
/* ------------------------------------------------------------------------- *
 *  Dynamic styles
/* ------------------------------------------------------------------------- */
/*  Convert hexadecimal to rgb
/* ------------------------------------ */
if (!function_exists('magazinemax_hex2rgb')) {
    function magazinemax_hex2rgb($colour, $opacity = 1)
    {
        if ($colour[0] == '#') {
            $colour = substr($colour, 1);
        }
        if (strlen($colour) == 6) {
            list($r, $g, $b) = array($colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5]);
        } elseif (strlen($colour) == 3) {
            list($r, $g, $b) = array($colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2]);
        } else {
            return false;
        }
        $r = hexdec($r);
        $g = hexdec($g);
        $b = hexdec($b);
        return 'rgba(' . $r . ',' . $g . ',' . $b . ',' . $opacity . ')';
    }
}
if (!function_exists('magazinemax_get_inline_css')) :
    /**
     * Outputs theme custom CSS.
     *
     * @since 1.0.0
     */
    function magazinemax_get_inline_css()
    {
        $defaults = magazinemax_get_default_customizer_values();
        $background_color = get_theme_mod('background_color');
        $site_title_text_size = magazinemax_get_option('site_title_text_size');
        $site_tagline_text_size = magazinemax_get_option('site_tagline_text_size');
        $header_bg_color = magazinemax_get_option('header_bg_color');
        $progressbar_color = magazinemax_get_option('progressbar_color');
        $jumbotron_bg_color = magazinemax_get_option('jumbotron_bg_color');
        $jumbotron_text_color = magazinemax_get_option('jumbotron_text_color');
        $footer_widgetarea_bg_color = magazinemax_get_option('footer_widgetarea_bg_color');
        $footer_widgetarea_text_color = magazinemax_get_option('footer_widgetarea_text_color');
        $footer_middlearea_bg_color = magazinemax_get_option('footer_middlearea_bg_color');
        $footer_middlearea_text_color = magazinemax_get_option('footer_middlearea_text_color');
        $footer_credit_bg_color = magazinemax_get_option('footer_credit_bg_color');
        $footer_credit_text_color = magazinemax_get_option('footer_credit_text_color');
        ob_start();
        ?>
        <?php if (!empty($background_color) && $background_color != 'ffffff') :
        ?>
        :root {
        --theme-bg-color: #<?php echo esc_attr($background_color); ?>;
        }
    <?php endif; ?>
        <?php if ($site_title_text_size != $defaults['site_title_text_size']) : ?>
        @media (min-width: 1000px){
        .site-title {
        font-size: <?php echo esc_attr($site_title_text_size) . 'px'; ?>;
        }
        }
    <?php endif; ?>
        <?php if ($site_tagline_text_size != $defaults['site_tagline_text_size']) : ?>
        @media (min-width: 1000px){
        .site-description {
        font-size: <?php echo esc_attr($site_tagline_text_size) . 'px'; ?>;
        }
        }
    <?php endif; ?>
        <?php if ($header_bg_color != $defaults['header_bg_color']) : ?>
        .site-header{
        background-color: <?php echo esc_attr($header_bg_color); ?>;
        }
    <?php endif; ?>
        <?php if ($progressbar_color != $defaults['progressbar_color']) : ?>
        #magazinemax-progress-bar{
        background-color: <?php echo esc_attr($progressbar_color); ?>;
        }
    <?php endif; ?>
        <?php if ($jumbotron_bg_color != $defaults['jumbotron_bg_color']) : ?>
        .site-jumbotron-section{
        --jumbotron-background-color: <?php echo esc_attr($jumbotron_bg_color); ?>;
        }
    <?php endif; ?>
        <?php if ($jumbotron_text_color != $defaults['jumbotron_text_color']) : ?>
        .site-jumbotron-section{
        --jumbotron-text-color: <?php echo esc_attr($jumbotron_text_color); ?>;
        }
        .site-jumbotron-area .jumbotron-bottom-area {
        border-color: <?php echo esc_attr(magazinemax_hex2rgb($jumbotron_text_color, 0.2)); ?>;
        }
        .site-jumbotron-area .jumbotron-bottom-area .theme-article-list:not(:first-child):after {
        background-color: <?php echo esc_attr(magazinemax_hex2rgb($jumbotron_text_color, 0.2)); ?>;
        }
    <?php endif; ?>
        <?php if ($footer_widgetarea_bg_color != $defaults['footer_widgetarea_bg_color']) : ?>
        :root {
        --theme-footer-widgetarea-bg: <?php echo esc_attr($footer_widgetarea_bg_color); ?>;
        }
    <?php endif; ?>
        <?php if ($footer_widgetarea_text_color != $defaults['footer_widgetarea_text_color']) : ?>
        :root {
        --theme-footer-widgetarea-color: <?php echo esc_attr($footer_widgetarea_text_color); ?>;
        }
    <?php endif; ?>
        <?php if ($footer_middlearea_bg_color != $defaults['footer_middlearea_bg_color']) : ?>
        :root {
        --theme-footer-middlearea-bg: <?php echo esc_attr($footer_middlearea_bg_color); ?>;
        }
    <?php endif; ?>
        <?php if ($footer_middlearea_text_color != $defaults['footer_middlearea_text_color']) : ?>
        :root {
        --theme-footer-middlearea-color: <?php echo esc_attr($footer_middlearea_text_color); ?>;
        }
    <?php endif; ?>
        <?php if ($footer_credit_bg_color != $defaults['footer_credit_bg_color']) : ?>
        :root {
        --theme-footer-credit-bg: <?php echo esc_attr($footer_credit_bg_color); ?>;
        }
    <?php endif; ?>
        <?php if ($footer_credit_text_color != $defaults['footer_credit_text_color']) : ?>
        :root {
        --theme-footer-credit-color: <?php echo esc_attr($footer_credit_text_color); ?>;
        }
    <?php endif; ?>
        <?php
        return ob_get_clean();
    }
endif;
if (!function_exists('magazinemax_get_dark_mode_inline_css')) :
    /**
     * Outputs theme dark mode custom CSS.
     *
     * @since 1.0.0
     */
    function magazinemax_get_dark_mode_inline_css()
    {
        $defaults = magazinemax_get_default_customizer_values();
        $dark_mode_accent_color = magazinemax_get_option('dark_mode_accent_color');
        $dark_mode_bg_color = magazinemax_get_option('dark_mode_bg_color');
        $dark_mode_text_color = magazinemax_get_option('dark_mode_text_color');
        ob_start();
        ?>
        <?php if ($dark_mode_bg_color !== $defaults['dark_mode_bg_color']) : ?>
        :root {
        --theme-darkmode-bg-color: <?php echo esc_attr($dark_mode_bg_color); ?>
        }
    <?php endif; ?>
        <?php if ($dark_mode_text_color !== $defaults['dark_mode_text_color']) : ?>
        :root {
        --theme-darkmode-text-color: <?php echo esc_attr($dark_mode_text_color); ?>
        }
    <?php endif; ?>
        <?php if ($dark_mode_accent_color !== $defaults['dark_mode_accent_color']) : ?>
        :root {
        --theme-darkmode-accent-color: <?php echo esc_attr($dark_mode_accent_color); ?>;
        }
    <?php endif; ?>
        <?php
        $css = ob_get_clean();
        return $css;
    }
endif;
