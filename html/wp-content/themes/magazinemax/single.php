<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Magazinemax
 */

get_header();
// Add a main container in case if sidebar is present
$class = '';
$page_layout = magazinemax_get_page_layout();
$magazinemax_single_post_style = magazinemax_get_option('magazinemax_single_post_style');
$magazinemax_single_post_layout = magazinemax_get_option('magazinemax_single_post_layout');
?>
<?php
global $post;
$magazinemax_post_layout = esc_html(get_post_meta($post->ID, 'magazinemax_post_layout', true));
$author_id = get_post_field( 'post_author', get_the_ID() );
if ($magazinemax_post_layout == 'layout-2') {
    get_template_part('template-parts/single/banner/banner-layout-2');
} elseif ($magazinemax_post_layout == 'layout-3'){
    get_template_part('template-parts/single/banner/banner-layout-3');
}

switch ($magazinemax_single_post_style) {
    case 'style-1':
        get_template_part('template-parts/single/style-1');
        break;
    
    case 'style-2':
        get_template_part('template-parts/single/style-2');
        break;
    
    default:
        break;
}

get_footer();
