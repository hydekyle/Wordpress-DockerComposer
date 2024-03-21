<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Magazinemax
 */

?>
    <!doctype html>
<html <?php language_attributes();
magazinemax_force_dark_mode(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="profile" href="https://gmpg.org/xfn/11">

        <?php wp_head(); ?>
    </head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<?php do_action('magazinemax_before_site'); ?>

<div id="page" class="site">

<?php get_template_part('template-parts/header/loader'); ?>

<?php get_template_part('template-parts/header/welcome-screen-banner'); ?>

<?php get_template_part('template-parts/header/progressbar'); ?>

    <a class="skip-link screen-reader-text" href="#site-main-content"><?php esc_html_e('Skip to content', 'magazinemax'); ?></a>

<?php do_action('magazinemax_before_header'); ?>

<?php get_template_part('template-parts/header/theme-header'); ?>

<?php do_action('magazinemax_before_content'); ?>
    <div id="site-main-content" class="site-content-area">


<?php $is_banner_section = magazinemax_get_option('enable_banner_section');
if ((is_front_page() || is_home()) && !is_paged()) {

    get_template_part('template-parts/front-page/banner-section');

    get_template_part('template-parts/front-page/jumbotron-section');

    get_template_part('template-parts/front-page/three-col-banner-section');

    get_template_part('template-parts/front-page/more-to-read');
}