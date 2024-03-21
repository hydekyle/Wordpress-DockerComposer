<?php
/**
 * Custom Functions.
 *
 * @package Magazinemax
 */

if (!function_exists('magazinemax_fonts_url')) :

    //Google Fonts URL
    function magazinemax_fonts_url()
    {

        $font_families = array(
            'Montserrat:wght@100..900&display=swap',
            'Source+Serif+4:opsz,wght@8..60,200..900&display=swap',
        );

        $fonts_url = add_query_arg(array(
            'family' => implode('&family=', $font_families),
            'display' => 'swap',
        ), 'https://fonts.googleapis.com/css2');

        return esc_url_raw($fonts_url);
    }

endif;

if (!function_exists('magazinemax_get_option')) :
    /**
     * Get customizer value by key.
     *
     * @param string $key Option key.
     * @return mixed Option value.
     * @since 1.0.0
     *
     */
    function magazinemax_get_option($key)
    {
        $key_value = '';
        if (!$key) {
            return $key_value;
        }
        $default_values = magazinemax_get_default_customizer_values();
        $customizer_values = get_theme_mod('magazinemax_options');
        $customizer_values = wp_parse_args($customizer_values, $default_values);

        $key_value = (isset($customizer_values[$key])) ? $customizer_values[$key] : '';
        return $key_value;
    }
endif;


/**
 * Magazinemax SVG Icon helper functions
 *
 * @package Magazinemax
 * @since 1.0.0
 */
if (!function_exists('magazinemax_theme_svg')):
    /**
     * Output and Get Theme SVG.
     * Output and get the SVG markup for an icon in the Magazinemax_SVG_Icons class.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function magazinemax_theme_svg($svg_name, $return = false)
    {

        if ($return) {

            return magazinemax_get_theme_svg($svg_name); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in magazinemax_get_theme_svg();.

        } else {

            echo magazinemax_get_theme_svg($svg_name); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in magazinemax_get_theme_svg();.

        }
    }

endif;

if (!function_exists('magazinemax_get_theme_svg')):

    /**
     * Get information about the SVG icon.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function magazinemax_get_theme_svg($svg_name)
    {

        // Make sure that only our allowed tags and attributes are included.
        $svg = wp_kses(
            Magazinemax_SVG_Icons::get_svg($svg_name),
            array(
                'svg' => array(
                    'class' => true,
                    'xmlns' => true,
                    'width' => true,
                    'height' => true,
                    'viewbox' => true,
                    'aria-hidden' => true,
                    'role' => true,
                    'focusable' => true,
                ),
                'path' => array(
                    'fill' => true,
                    'fill-rule' => true,
                    'd' => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill' => true,
                    'fill-rule' => true,
                    'points' => true,
                    'transform' => true,
                    'focusable' => true,
                ),

                'line' => array(
                    'stroke' => true,
                    'x1' => true,
                    'x2' => true,
                    'y1' => true,
                    'y2' => true,
                ),
            )
        );
        if (!$svg) {
            return false;
        }
        return $svg;

    }

endif;

if (!function_exists('magazinemax_svg_escape')):

    /**
     * Get information about the SVG icon.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function magazinemax_svg_escape($input)
    {

        // Make sure that only our allowed tags and attributes are included.
        $svg = wp_kses(
            $input,
            array(
                'svg' => array(
                    'class' => true,
                    'xmlns' => true,
                    'width' => true,
                    'height' => true,
                    'viewbox' => true,
                    'aria-hidden' => true,
                    'role' => true,
                    'focusable' => true,
                ),
                'path' => array(
                    'fill' => true,
                    'fill-rule' => true,
                    'd' => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill' => true,
                    'fill-rule' => true,
                    'points' => true,
                    'transform' => true,
                    'focusable' => true,
                ),
            )
        );

        if (!$svg) {
            return false;
        }

        return $svg;

    }

endif;

if (!function_exists('magazinemax_social_menu_icon')) :

    function magazinemax_social_menu_icon($item_output, $item, $depth, $args)
    {

        // Add Icon
        if (isset($args->theme_location) && 'social-menu' === $args->theme_location) {

            $svg = Magazinemax_SVG_Icons::get_theme_svg_name($item->url);

            if (empty($svg)) {
                $svg = magazinemax_theme_svg('link', $return = true);
            }

            $item_output = str_replace($args->link_after, '</span>' . $svg, $item_output);
        }

        return $item_output;
    }

endif;

add_filter('walker_nav_menu_start_el', 'magazinemax_social_menu_icon', 10, 4);


if (!function_exists('magazinemax_comment_form_custom_fields')) :
    /**
     * Custom comment form fields.
     *
     * @param array $fields
     *
     * @return array
     */
    function magazinemax_comment_form_custom_fields($fields)
    {

        $commenter = wp_get_current_commenter();
        $req = get_option('require_name_email');
        $aria_req = ($req ? ' aria-required="true"' : '');

        if (is_user_logged_in()) {
            $fields = array_merge($fields, array(
                'author' => '<p class="comment-form-author"><label for="author" class="show-on-ie8">' . __('Name', 'magazinemax') . '</label><input id="author" name="author" value="' . esc_attr($commenter['comment_author']) . '" type="text" placeholder="' . __('Name', 'magazinemax') . '..." size="30" ' . $aria_req . ' /></p>',
                'email' => '<p class="comment-form-email"><label for="email" class="show-on-ie8">' . __('Email', 'magazinemax') . '</label><input id="email" name="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" type="text" placeholder="' . __('your@email.com', 'magazinemax') . '..." ' . $aria_req . ' /></p>',
            ));
        } else {
            $fields = array_merge($fields, array(
                'author' => '<p class="comment-form-author"><label for="author" class="show-on-ie8">' . __('Name', 'magazinemax') . '</label><input id="author" name="author" value="' . esc_attr($commenter['comment_author']) . '" type="text" placeholder="' . __('Name', 'magazinemax') . '..." size="30" ' . $aria_req . ' /></p><!--',
                'email' => '--><p class="comment-form-email"><label for="name" class="show-on-ie8">' . __('Email', 'magazinemax') . '</label><input id="email" name="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" type="text" placeholder="' . __('your@email.com', 'magazinemax') . '..." ' . $aria_req . ' /></p><!--',
                'url' => '--><p class="comment-form-url"><label for="url" class="show-on-ie8">' . __('Url', 'magazinemax') . '</label><input id="url" name="url" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" placeholder="' . __('Website', 'magazinemax') . '..." type="text"></p>',
            ));
        }

        return $fields;
    }
endif;
add_filter('comment_form_default_fields', 'magazinemax_comment_form_custom_fields');

if (!function_exists('magazinemax_get_general_layouts')) :
    /**
     * Returns general layout options.
     *
     * @return array Options array.
     * @since 1.0.0
     *
     */
    function magazinemax_get_general_layouts()
    {
        $options = apply_filters('magazinemax_general_layouts', array(
            'left-sidebar' => array(
                'url' => get_template_directory_uri() . '/assets/images/left_sidebar.png',
                'label' => esc_html__('Left Sidebar', 'magazinemax'),
            ),
            'right-sidebar' => array(
                'url' => get_template_directory_uri() . '/assets/images/right_sidebar.png',
                'label' => esc_html__('Right Sidebar', 'magazinemax'),
            ),
            'no-sidebar' => array(
                'url' => get_template_directory_uri() . '/assets/images/no_sidebar.png',
                'label' => esc_html__('No Sidebar', 'magazinemax'),
            ),
        ));
        return $options;
    }

endif;


if (!function_exists('magazinemax_post_category_list')) :

    // Post Category List.
    function magazinemax_post_category_list($select_cat = true)
    {

        $post_cat_lists = get_categories(
            array(
                'hide_empty' => '0',
                'exclude' => '1',
            )
        );

        $post_cat_cat_array = array();
        if ($select_cat) {

            $post_cat_cat_array[''] = esc_html__('-- Select Category --', 'magazinemax');

        }

        foreach ($post_cat_lists as $post_cat_list) {

            $post_cat_cat_array[$post_cat_list->slug] = $post_cat_list->name;

        }

        return $post_cat_cat_array;
    }

endif;

if (!function_exists('magazinemax_woocommerce_product_cat')) :

    // Post Category List.
    function magazinemax_woocommerce_product_cat()
    {

        $post_cat_lists = get_categories(
            array(
                'taxonomy' => 'product_cat',
                'orderby' => 'name',
                'show_count' => 0,
                'pad_counts' => 0,
                'hide_empty' => '0',
                'exclude' => '1',
            )
        );

        $post_cat_cat_array = array();
        $post_cat_cat_array[''] = esc_html__('--Select Category--', 'magazinemax');

        foreach ($post_cat_lists as $post_cat_list) {

            $post_cat_cat_array[$post_cat_list->slug] = $post_cat_list->name;

        }

        return $post_cat_cat_array;
    }

endif;


if (!function_exists('magazinemax_get_archive_layouts')) :
    /**
     * Returns archive layout options.
     *
     * @return array Options array.
     * @since 1.0.0
     *
     */
    function magazinemax_get_archive_layouts()
    {
        $options = apply_filters('magazinemax_archive_layouts', array(
            'archive_style_1' => array(
                'url' => get_template_directory_uri() . '/assets/images/archive-style-1.png',
                'label' => esc_html__('Archive Layout Full', 'magazinemax'),
            ),
            'archive_style_2' => array(
                'url' => get_template_directory_uri() . '/assets/images/archive-style-2.png',
                'label' => esc_html__('Archive Layout Half', 'magazinemax'),
            ),
            'archive_style_3' => array(
                'url' => get_template_directory_uri() . '/assets/images/archive-style-3.png',
                'label' => esc_html__('Archive Layout Mixed', 'magazinemax'),
            ),
            'archive_style_4' => array(
                'url' => get_template_directory_uri() . '/assets/images/archive-style-4.png',
                'label' => esc_html__('Archive Layout Tiles', 'magazinemax'),
            ),
        ));
        return $options;
    }

endif;
if (!function_exists('magazinemax_get_page_layout')) :
    /**
     * Get Page Layout based on the post meta or customizer value
     *
     * @return string Page Layout.
     * @since 1.0.0
     *
     */
    function magazinemax_get_page_layout()
    {

        global $post;

        $page_layout = '';

        // For homepage regardless of static page or latest posts
        if (is_front_page()) {
            return magazinemax_get_option('front_page_layout');
        }

        // For Posts page chosen on reading settings
        if (is_home()) {
            $page_layout = magazinemax_get_option('global_sidebar_layout');
            return $page_layout;
        }

        // Fetch from customizer if everything else fails
        if (empty($page_layout)) {
            $page_layout = magazinemax_get_option('global_sidebar_layout');
        }

        if (is_single() || is_page()) {
            $magazinemax_post_sidebar = esc_attr(get_post_meta($post->ID, 'magazinemax_post_sidebar_option', true));
            if ($magazinemax_post_sidebar == 'global-sidebar' || empty($magazinemax_post_sidebar)) {

                $page_layout = magazinemax_get_option('global_sidebar_layout');
            } else {
                $page_layout = $magazinemax_post_sidebar;
            }

        }

        return $page_layout;
    }
endif;

if (!function_exists('magazinemax_get_footer_layouts')) :
    /**
     * Returns footer layout options.
     *
     * @return array Options array.
     * @since 1.0.0
     *
     */
    function magazinemax_get_footer_layouts()
    {
        $options = apply_filters('magazinemax_footer_layouts', array(
            'footer_layout_1' => array(
                'url' => get_template_directory_uri() . '/assets/images/widget-column-3.png',
                'label' => esc_html__('Three Columns', 'magazinemax'),
            ),
            'footer_layout_2' => array(
                'url' => get_template_directory_uri() . '/assets/images/widget-column-2.png',
                'label' => esc_html__('Two Columns', 'magazinemax'),
            )
        ));
        return $options;
    }
endif;

if (!function_exists('magazinemax_print_first_instance_of_block')):

    /** Print the first instance of a block in the content, and then break away.
     * @param string $block_name The full block type name, or a partial match.
     *                                Example: `core/image`, `core-embed/*`.
     * @param string|null $content The content to search in. Use null for get_the_content().
     * @param int $instances How many instances of the block will be printed (max). Default  1.
     * @return bool Returns true if a block was located & printed, otherwise false.
     */
    function magazinemax_print_first_instance_of_block($block_name, $content = null, $instances = 1)
    {
        $instances_count = 0;
        $blocks_content = '';

        if (!$content) {
            $content = get_the_content();
        }

        // Parse blocks in the content.
        $blocks = parse_blocks($content);

        // Loop blocks.
        foreach ($blocks as $block) {

            // Sanity check.
            if (!isset($block['blockName'])) {
                continue;
            }

            // Check if this the block matches the $block_name.
            $is_matching_block = false;

            // If the block ends with *, try to match the first portion.
            if ('*' === $block_name[-1]) {
                $is_matching_block = 0 === strpos($block['blockName'], rtrim($block_name, '*'));
            } else {
                $is_matching_block = $block_name === $block['blockName'];
            }

            if ($is_matching_block) {
                // Increment count.
                $instances_count++;

                // Add the block HTML.
                $blocks_content .= render_block($block);

                // Break the loop if the $instances count was reached.
                if ($instances_count >= $instances) {
                    break;
                }
            }
        }

        if ($blocks_content) {
            /** This filter is documented in wp-includes/post-template.php */
            echo apply_filters('the_content', $blocks_content); // phpcs:ignore WordPress.Security.EscapeOutput
            return true;
        }

        return false;
    }
endif;

if (!function_exists('magazinemax_excerpt_length') || (defined('DOING_AJAX'))) {

    function magazinemax_excerpt_length($excerpt_length)
    {
        if (is_admin()) {
            return $excerpt_length;
        }
        $custom_length = absint(magazinemax_get_option('excerpt_length'));
        if (absint($custom_length) > 0) {
            $excerpt_length = absint($custom_length);
        }
        return $excerpt_length;
    }

}
add_filter('excerpt_length', 'magazinemax_excerpt_length', 999);


function magazinemax_gravatar_alt($magazinemax_gravatar)
{
    if (have_comments()) {
        $alt = get_comment_author();
    } else {
        $alt = get_the_author_meta('display_name');
    }
    $magazinemax_gravatar = str_replace('alt=\'\'', 'alt=\'Avatar for ' . $alt . '\'', $magazinemax_gravatar);
    return $magazinemax_gravatar;
}

add_filter('get_avatar', 'magazinemax_gravatar_alt');

if (!function_exists('magazinemax_excerpt_more') && !is_admin() || (defined('DOING_AJAX'))):
    /**
     * Implement read more in excerpt.
     *
     * @param string $more The string shown within the more link.
     * @return string The excerpt.
     * @since 1.0.0
     *
     */
    function magazinemax_excerpt_more($more)
    {
        $excerpt_read_more = magazinemax_get_option('excerpt_read_more');

        $flag_apply_excerpt_read_more = apply_filters('magazinemax_filter_excerpt_read_more', true);
        if (true !== $flag_apply_excerpt_read_more) {
            return $more;
        }
        $enable_excerpt_read_more = magazinemax_get_option('enable_excerpt_read_more');
        if ($enable_excerpt_read_more != 1) {
            return '';
        }
        $output = $more;
        $read_more_text = esc_html($excerpt_read_more);
        if (!empty($read_more_text)) {
            $output = ' <a href="' . esc_url(get_permalink()) . '" class="read-more-link">' . esc_html($read_more_text) . '</a>';

            $output = apply_filters('magazinemax_filter_read_more_link', $output);
        }
        return $output;

    }

    add_filter('excerpt_more', 'magazinemax_excerpt_more');
endif;


if (!function_exists('magazinemax_force_dark_mode')) {

    function magazinemax_force_dark_mode()
    {
        if (magazinemax_get_option('enable_always_dark_mode') == true) {
            echo "data-theme='dark'";
        }

    }

}


if (!function_exists('magazinemax_social_share')):

    /**
     * Social Share
     **/

    function magazinemax_social_share()
    {

        $enable_facebook = magazinemax_get_option('enable_facebook');
        $enable_twitter = magazinemax_get_option('enable_twitter');
        $enable_pinterest = magazinemax_get_option('enable_pinterest');
        $enable_linkedin = magazinemax_get_option('enable_linkedin');
        $enable_telegram = magazinemax_get_option('enable_telegram');
        $enable_reddit = magazinemax_get_option('enable_reddit');
        $enable_stumbleupon = magazinemax_get_option('enable_stumbleupon');
        $enable_whatsapp = magazinemax_get_option('enable_whatsapp');
        $enable_email = magazinemax_get_option('enable_email');

        if ($enable_facebook || $enable_twitter || $enable_pinterest || $enable_linkedin || $enable_email || $enable_telegram || $enable_reddit || $enable_stumbleupon || $enable_whatsapp) {

            $permalink = urlencode(get_the_permalink());
            $post_title = html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8');
            $media_url = urlencode(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>
            <div class="twp-social-share">


                <?php if ($enable_facebook) { ?>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($permalink); ?>"
                       target="popup" class="twp-social-share-icon twp-share-icon-facebook"
                       onclick="window.open(this.href,'<?php echo esc_html__('Facebook', 'magazinemax'); ?>','width=600,height=400')">
                        <span><?php magazinemax_theme_svg('facebook'); ?></span>
                    </a>
                <?php } ?>

                <?php if ($enable_twitter) {

                    $twitter_id = magazinemax_get_option('twitter_id'); ?>
                    <a href="https://twitter.com/intent/tweet?text=<?php echo esc_html($post_title); ?>&amp;url=<?php echo esc_url($permalink); ?>&amp;via=<?php echo esc_html($twitter_id); ?>"
                       target="popup" class="twp-social-share-icon twp-share-icon-twitter"
                       onclick="window.open(this.href,'<?php echo esc_html__('Twitter', 'magazinemax'); ?>','width=600,height=400')">
                        <span><?php magazinemax_theme_svg('twitter'); ?></span>
                    </a>
                <?php } ?>

                <?php if ($enable_pinterest) { ?>
                    <a href="http://pinterest.com/pin/create/button/?url=<?php echo esc_url($permalink); ?>&amp;media=<?php echo $media_url; ?>&amp;description=<?php echo esc_html($post_title); ?>"
                       target="popup" class="twp-social-share-icon twp-share-icon-pinterest"
                       onclick="window.open(this.href,'<?php echo esc_html__('Pinterest', 'magazinemax'); ?>','width=600,height=400')">
                        <span><?php magazinemax_theme_svg('pinterest'); ?></span>
                    </a>
                <?php } ?>

                <?php if ($enable_linkedin) { ?>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url($permalink); ?>&title=<?php echo esc_html($post_title); ?>"
                       target="popup" class="twp-social-share-icon twp-share-icon-linkedin"
                       onclick="window.open(this.href,'<?php echo esc_html__('LinkedIn', 'magazinemax'); ?>','width=600,height=400')">
                        <span><?php magazinemax_theme_svg('linkedin'); ?></span>
                    </a>
                <?php } ?>

                <?php if ($enable_telegram) { ?>
                    <a href="https://telegram.me/share/url?url=<?php echo esc_attr($permalink); ?>&text=<?php echo esc_html($post_title); ?>"
                       target="popup" class="twp-social-share-icon twp-share-icon-telegram"
                       onclick="window.open(this.href,'<?php echo esc_html__('Telegram', 'magazinemax'); ?>','width=600,height=400')">
                        <span><?php magazinemax_theme_svg('telegram'); ?></span>
                    </a>
                <?php } ?>


                <?php if ($enable_reddit) { ?>
                    <a href="https://reddit.com/submit?url=<?php echo esc_attr($permalink); ?>&title=<?php echo esc_html($post_title); ?>"
                       target="popup" class="twp-social-share-icon twp-share-icon-reddit"
                       onclick="window.open(this.href,'<?php echo esc_html__('Reddit', 'magazinemax'); ?>','width=600,height=400')">
                        <span><?php magazinemax_theme_svg('reddit'); ?></span>
                    </a>
                <?php } ?>


                <?php if ($enable_stumbleupon) { ?>
                    <a href="http://www.stumbleupon.com/submit?url=<?php echo esc_attr($permalink); ?>&title=<?php echo esc_html($post_title); ?>"
                       target="popup" class="twp-social-share-icon twp-share-icon-stumbleupon"
                       onclick="window.open(this.href,'<?php echo esc_html__('Stumbleupon', 'magazinemax'); ?>','width=600,height=400')">
                        <span><?php magazinemax_theme_svg('stumbleupon'); ?></span>
                    </a>
                <?php } ?>


                <?php if ($enable_whatsapp) { ?>
                    <a href="https://api.whatsapp.com/send?text=<?php echo esc_attr($permalink); ?>"
                       target="popup" class="twp-social-share-icon twp-share-icon-whatsapp"
                       onclick="window.open(this.href,'<?php echo esc_html__('Whatsapp', 'magazinemax'); ?>','width=600,height=400')">
                        <span><?php magazinemax_theme_svg('whatsapp'); ?></span>
                    </a>
                <?php } ?>


                <?php if ($enable_email) { ?>
                    <a href="mailto:?subject=<?php echo esc_html($post_title); ?>&body=<?php echo esc_html($post_title) . " " . esc_url($permalink); ?>"
                       target="_blank" class="twp-social-share-icon twp-share-icon-email">
                        <span><?php magazinemax_theme_svg('mail'); ?></span>
                    </a>
                <?php } ?>


            </div>
            <?php
        }

    }

endif;


if (!function_exists('magazinemax_404_posts')):

    function magazinemax_404_posts()
    {

        $lead_post_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 6, 'post__not_in' => get_option("sticky_posts")));
        if ($lead_post_query->have_posts()): ?>
            <div class="wrapper">
                <div class="column-row">
                    <?php
                    while ($lead_post_query->have_posts()) {
                        $lead_post_query->the_post();
                        ?>

                        <div class="column column-4 column-sm-6 column-xs-12 mb-30">
                            <article id="theme-error-<?php the_ID(); ?>" <?php post_class('theme-article-post theme-article-default theme-404-post'); ?>>

                                <?php if (has_post_thumbnail()): ?>
                                    <div class="entry-image entry-image-medium">
                                        <a href="<?php the_permalink() ?>">
                                            <?php
                                            the_post_thumbnail('medium_large', array(
                                                'alt' => the_title_attribute(array(
                                                    'echo' => false,
                                                )),
                                            ));
                                            ?>
                                        </a>
                                        <?php magazinemax_social_share(); ?>
                                    </div>
                                <?php endif; ?>

                                <div class="entry-details">
                                    <div class="entry-meta">
                                        <?php magazinemax_posted_categories(); ?>
                                    </div>

                                    <?php the_title('<h3 class="entry-title entry-title-small"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>

                                    <div class="entry-meta">
                                        <?php
                                        magazinemax_posted_on();
                                        magazinemax_posted_by();
                                        ?>
                                    </div>
                                </div>
                            </article>
                        </div>

                    <?php } ?>


                </div>
            </div>
            <?php
            wp_reset_postdata();
        endif;

    }

endif;

function magazinemax_set_post_views($postID)
{
    $countKey = 'magazinemax_post_views_counter';
    $count = get_post_meta($postID, $countKey, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $countKey);
        add_post_meta($postID, $countKey, '1');
    } else {
        $count++;
        update_post_meta($postID, $countKey, $count);
    }
}