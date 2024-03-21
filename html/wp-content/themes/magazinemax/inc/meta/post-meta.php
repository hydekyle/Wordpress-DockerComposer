<?php
/**
 * Sidebar Metabox.
 *
 * @package Magazinemax
 */
if (!function_exists('magazinemax_sanitize_sidebar_option_meta')) :

    // Sidebar Option Sanitize.
    function magazinemax_sanitize_sidebar_option_meta($input)
    {

        $metabox_options = array('global-sidebar', 'left-sidebar', 'right-sidebar', 'no-sidebar');
        if (in_array($input, $metabox_options)) {

            return $input;

        } else {

            return '';

        }
    }

endif;

if (!function_exists('magazinemax_sanitize_meta_pagination')):

    /** Sanitize Enable Disable Checkbox **/
    function magazinemax_sanitize_meta_pagination($input)
    {

        $valid_keys = array('global-layout', 'no-navigation', 'norma-navigation', 'ajax-next-post-load');
        if (in_array($input, $valid_keys)) {
            return $input;
        }
        return '';

    }

endif;

if (!function_exists('magazinemax_sanitize_post_layout_option_meta')) :

    // Sidebar Option Sanitize.
    function magazinemax_sanitize_post_layout_option_meta($input)
    {

        $metabox_options = array('global-layout', 'layout-1', 'layout-2','layout-3');
        if (in_array($input, $metabox_options)) {

            return $input;

        } else {

            return '';

        }

    }

endif;


if (!function_exists('magazinemax_sanitize_header_overlay_option_meta')) :

    // Sidebar Option Sanitize.
    function magazinemax_sanitize_header_overlay_option_meta($input)
    {

        $metabox_options = array('global-layout', 'featured-banner-overlay');
        if (in_array($input, $metabox_options)) {

            return $input;

        } else {

            return '';

        }

    }

endif;

add_action('add_meta_boxes', 'magazinemax_metabox');

if (!function_exists('magazinemax_metabox')):


    function magazinemax_metabox()
    {

        add_meta_box(
            'theme-custom-metabox',
            esc_html__('Layout Settings', 'magazinemax'),
            'magazinemax_post_metafield_callback',
            'post',
            'normal',
            'high'
        );
        add_meta_box(
            'theme-custom-metabox',
            esc_html__('Layout Settings', 'magazinemax'),
            'magazinemax_post_metafield_callback',
            'page',
            'normal',
            'high'
        );
    }

endif;

$magazinemax_page_layout_options = array(
    'layout-1' => esc_html__('Simple Layout', 'magazinemax'),
    'layout-2' => esc_html__('Banner Layout', 'magazinemax'),
    'layout-3' => esc_html__('Banner Layout - 2', 'magazinemax'),
);

$magazinemax_post_sidebar_fields = array(
    'global-sidebar' => array(
        'id' => 'post-global-sidebar',
        'value' => 'global-sidebar',
        'label' => esc_html__('Global sidebar', 'magazinemax'),
    ),
    'right-sidebar' => array(
        'id' => 'post-left-sidebar',
        'value' => 'right-sidebar',
        'label' => esc_html__('Right sidebar', 'magazinemax'),
    ),
    'left-sidebar' => array(
        'id' => 'post-right-sidebar',
        'value' => 'left-sidebar',
        'label' => esc_html__('Left sidebar', 'magazinemax'),
    ),
    'no-sidebar' => array(
        'id' => 'post-no-sidebar',
        'value' => 'no-sidebar',
        'label' => esc_html__('No sidebar', 'magazinemax'),
    ),
);

$magazinemax_post_layout_options = array(
    'layout-1' => esc_html__('Simple Layout', 'magazinemax'),
    'layout-2' => esc_html__('Banner Layout', 'magazinemax'),
    'layout-3' => esc_html__('Banner Layout 3', 'magazinemax'),
);

$magazinemax_header_overlay_options = array(
    'featured-banner-overlay-disable' => esc_html__('Disable Header Overlay', 'magazinemax'),
    'featured-banner-overlay' => esc_html__('Enable Header Overlay', 'magazinemax'),
);


/**
 * Callback function for post option.
 */
if (!function_exists('magazinemax_post_metafield_callback')):

    function magazinemax_post_metafield_callback()
    {
        global $post, $magazinemax_post_sidebar_fields, $magazinemax_post_layout_options, $magazinemax_page_layout_options, $magazinemax_header_overlay_options;
        $post_type = get_post_type($post->ID);
        wp_nonce_field(basename(__FILE__), 'magazinemax_post_meta_nonce'); ?>

        <div class="metabox-main-block">

            <div class="metabox-navbar">
                <ul>

                    <li>
                        <a id="metabox-navbar-appearance" class="metabox-navbar-active" href="javascript:void(0)">

                            <?php esc_html_e('Appearance Settings', 'magazinemax'); ?>

                        </a>
                    </li>

                    <?php if ($post_type != 'page') { ?>
                        <li>
                            <a id="metabox-navbar-general" href="javascript:void(0)">

                                <?php esc_html_e('General Settings', 'magazinemax'); ?>

                            </a>
                        </li>
                    <?php } ?>


                    <?php if ($post_type == 'post' && class_exists('Booster_Extension_Class')): ?>
                        <li>
                            <a id="twp-tab-booster" href="javascript:void(0)">

                                <?php esc_html_e('Booster Extension Settings', 'magazinemax'); ?>

                            </a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>

            <div class="twp-tab-content">

                <div id="metabox-navbar-general-content" class="metabox-content-wrap">

                    <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Sidebar Layout', 'magazinemax'); ?></h3>

                        <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                            <?php
                            $magazinemax_post_sidebar = esc_html(get_post_meta($post->ID, 'magazinemax_post_sidebar_option', true));
                            if ($magazinemax_post_sidebar == '') {
                                $magazinemax_post_sidebar = 'global-sidebar';
                            }

                            foreach ($magazinemax_post_sidebar_fields as $magazinemax_post_sidebar_field) { ?>

                                <label class="description">

                                    <input type="radio" name="magazinemax_post_sidebar_option"
                                           value="<?php echo esc_attr($magazinemax_post_sidebar_field['value']); ?>" <?php if ($magazinemax_post_sidebar_field['value'] == $magazinemax_post_sidebar) {
                                        echo "checked='checked'";
                                    }
                                    if (empty($magazinemax_post_sidebar) && $magazinemax_post_sidebar_field['value'] == 'right-sidebar') {
                                        echo "checked='checked'";
                                    } ?>/>&nbsp;<?php echo esc_html($magazinemax_post_sidebar_field['label']); ?>

                                </label>

                            <?php } ?>

                        </div>

                    </div>

                </div>


                <div id="metabox-navbar-appearance-content" class="metabox-content-wrap metabox-content-wrap-active">

                    <?php if ($post_type == 'page'): ?>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Banner Layout', 'magazinemax'); ?></h3>

                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <?php
                                $magazinemax_page_layout = esc_html(get_post_meta($post->ID, 'magazinemax_page_layout', true));
                                $magazinemax_single_post_layout = magazinemax_get_option('magazinemax_single_post_layout');

                                if ($magazinemax_page_layout == '') {
                                    $magazinemax_page_layout = $magazinemax_single_post_layout;
                                }


                                foreach ($magazinemax_page_layout_options as $key => $magazinemax_page_layout_option) { ?>

                                    <label class="description">
                                        <input type="radio" name="magazinemax_page_layout"
                                               value="<?php echo esc_attr($key); ?>" <?php if ($key == $magazinemax_page_layout) {
                                            echo "checked='checked'";
                                        } ?>/>&nbsp;<?php echo esc_html($magazinemax_page_layout_option); ?>
                                    </label>

                                <?php } ?>

                            </div>

                        </div>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Header Overlay', 'magazinemax'); ?></h3>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                <?php
                                $magazinemax_ed_header_overlay = esc_attr(get_post_meta($post->ID, 'magazinemax_ed_header_overlay', true)); ?>

                                <input type="checkbox" id="magazinemax-header-overlay" name="magazinemax_ed_header_overlay"
                                       value="1" <?php if ($magazinemax_ed_header_overlay) {
                                    echo "checked='checked'";
                                } ?>/>

                                <label for="magazinemax-header-overlay"><?php esc_html_e('Enable Header Overlay', 'magazinemax'); ?></label>

                            </div>

                        </div>

                    <?php endif; ?>

                    <?php if ($post_type == 'post'): ?>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Header Title Layout', 'magazinemax'); ?></h3>

                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <?php
                                $magazinemax_post_layout = esc_html(get_post_meta($post->ID, 'magazinemax_post_layout', true));
                                $magazinemax_single_post_layout = magazinemax_get_option('magazinemax_single_post_layout');

                                if ($magazinemax_post_layout == '') {
                                    $magazinemax_post_layout = $magazinemax_single_post_layout;
                                }

                                foreach ($magazinemax_post_layout_options as $key => $magazinemax_post_layout_option) { ?>

                                    <label class="description">
                                        <input type="radio" name="magazinemax_post_layout"
                                               value="<?php echo esc_attr($key); ?>" <?php if ($key == $magazinemax_post_layout) {
                                            echo "checked='checked'";
                                        } ?>/>&nbsp;<?php echo esc_html($magazinemax_post_layout_option); ?>
                                    </label>

                                <?php } ?>

                            </div>

                        </div>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Header Overlay', 'magazinemax'); ?></h3>

                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <?php
                                $magazinemax_header_overlay = esc_html(get_post_meta($post->ID, 'magazinemax_header_overlay', true));
                                $magazinemax_single_post_header_overlay = magazinemax_get_option('magazinemax_single_post_header_overlay');
                                if ($magazinemax_header_overlay == '') {
                                    $magazinemax_header_overlay = $magazinemax_single_post_header_overlay;
                                }

                                foreach ($magazinemax_header_overlay_options as $key => $magazinemax_header_overlay_option) { ?>

                                    <label class="description">
                                        <input type="radio" name="magazinemax_header_overlay"
                                               value="<?php echo esc_attr($key); ?>" <?php if ($key == $magazinemax_header_overlay) {
                                            echo "checked='checked'";
                                        } ?>/>&nbsp;<?php echo esc_html($magazinemax_header_overlay_option); ?>
                                    </label>

                                <?php } ?>

                            </div>

                        </div>

                    <?php endif; ?>

                </div>

                <?php if ($post_type == 'post' && class_exists('Booster_Extension_Class')):


                    $magazinemax_ed_post_views = esc_html(get_post_meta($post->ID, 'magazinemax_ed_post_views', true));
                    $magazinemax_ed_post_like_dislike = esc_html(get_post_meta($post->ID, 'magazinemax_ed_post_like_dislike', true));
                    $magazinemax_ed_post_author_box = esc_html(get_post_meta($post->ID, 'magazinemax_ed_post_author_box', true));
                    $magazinemax_ed_post_social_share = esc_html(get_post_meta($post->ID, 'magazinemax_ed_post_social_share', true));
                    $magazinemax_ed_post_reaction = esc_html(get_post_meta($post->ID, 'magazinemax_ed_post_reaction', true));
                    $magazinemax_ed_post_rating = esc_html(get_post_meta($post->ID, 'magazinemax_ed_post_rating', true));
                    ?>

                    <div id="twp-tab-booster-content" class="metabox-content-wrap">

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Booster Extension Plugin Content', 'magazinemax'); ?></h3>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                <input type="checkbox" id="magazinemax-ed-post-views" name="magazinemax_ed_post_views"
                                       value="1" <?php if ($magazinemax_ed_post_views) {
                                    echo "checked='checked'";
                                } ?>/>
                                <label for="magazinemax-ed-post-views"><?php esc_html_e('Disable Post Views', 'magazinemax'); ?></label>

                            </div>


                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                <input type="checkbox" id="magazinemax-ed-post-like-dislike"
                                       name="magazinemax_ed_post_like_dislike"
                                       value="1" <?php if ($magazinemax_ed_post_like_dislike) {
                                    echo "checked='checked'";
                                } ?>/>
                                <label for="magazinemax-ed-post-like-dislike"><?php esc_html_e('Disable Post Like Dislike', 'magazinemax'); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                <input type="checkbox" id="magazinemax-ed-post-author-box"
                                       name="magazinemax_ed_post_author_box"
                                       value="1" <?php if ($magazinemax_ed_post_author_box) {
                                    echo "checked='checked'";
                                } ?>/>
                                <label for="magazinemax-ed-post-author-box"><?php esc_html_e('Disable Post Author Box', 'magazinemax'); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                <input type="checkbox" id="magazinemax-ed-post-social-share"
                                       name="magazinemax_ed_post_social_share"
                                       value="1" <?php if ($magazinemax_ed_post_social_share) {
                                    echo "checked='checked'";
                                } ?>/>
                                <label for="magazinemax-ed-post-social-share"><?php esc_html_e('Disable Post Social Share', 'magazinemax'); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                <input type="checkbox" id="magazinemax-ed-post-reaction" name="magazinemax_ed_post_reaction"
                                       value="1" <?php if ($magazinemax_ed_post_reaction) {
                                    echo "checked='checked'";
                                } ?>/>
                                <label for="magazinemax-ed-post-reaction"><?php esc_html_e('Disable Post Reaction', 'magazinemax'); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                <input type="checkbox" id="magazinemax-ed-post-rating" name="magazinemax_ed_post_rating"
                                       value="1" <?php if ($magazinemax_ed_post_rating) {
                                    echo "checked='checked'";
                                } ?>/>
                                <label for="magazinemax-ed-post-rating"><?php esc_html_e('Disable Post Rating', 'magazinemax'); ?></label>

                            </div>

                        </div>

                    </div>

                <?php endif; ?>

            </div>

        </div>

    <?php }
endif;

// Save metabox value.
add_action('save_post', 'magazinemax_save_post_meta');

if (!function_exists('magazinemax_save_post_meta')):

    function magazinemax_save_post_meta($post_id)
    {

        global $post, $magazinemax_post_sidebar_fields, $magazinemax_post_layout_options, $magazinemax_header_overlay_options, $magazinemax_page_layout_options;

        if (!isset($_POST['magazinemax_post_meta_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['magazinemax_post_meta_nonce'])), basename(__FILE__))) {

            return;

        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {

            return;

        }

        if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {

            if (!current_user_can('edit_page', $post_id)) {

                return $post_id;

            }

        } elseif (!current_user_can('edit_post', $post_id)) {

            return $post_id;

        }


        foreach ($magazinemax_post_sidebar_fields as $magazinemax_post_sidebar_field) {


            $old = esc_html(get_post_meta($post_id, 'magazinemax_post_sidebar_option', true));
            $new = isset($_POST['magazinemax_post_sidebar_option']) ? magazinemax_sanitize_sidebar_option_meta(wp_unslash($_POST['magazinemax_post_sidebar_option'])) : '';

            if ($new && $new != $old) {

                update_post_meta($post_id, 'magazinemax_post_sidebar_option', $new);

            } elseif ('' == $new && $old) {

                delete_post_meta($post_id, 'magazinemax_post_sidebar_option', $old);

            }


        }

        $twp_disable_ajax_load_next_post_old = esc_html(get_post_meta($post_id, 'twp_disable_ajax_load_next_post', true));
        $twp_disable_ajax_load_next_post_new = isset($_POST['twp_disable_ajax_load_next_post']) ? magazinemax_sanitize_meta_pagination(wp_unslash($_POST['twp_disable_ajax_load_next_post'])) : '';

        if ($twp_disable_ajax_load_next_post_new && $twp_disable_ajax_load_next_post_new != $twp_disable_ajax_load_next_post_old) {

            update_post_meta($post_id, 'twp_disable_ajax_load_next_post', $twp_disable_ajax_load_next_post_new);

        } elseif ('' == $twp_disable_ajax_load_next_post_new && $twp_disable_ajax_load_next_post_old) {

            delete_post_meta($post_id, 'twp_disable_ajax_load_next_post', $twp_disable_ajax_load_next_post_old);

        }


        foreach ($magazinemax_post_layout_options as $magazinemax_post_layout_option) {

            $magazinemax_post_layout_old = esc_html(get_post_meta($post_id, 'magazinemax_post_layout', true));
            $magazinemax_post_layout_new = isset($_POST['magazinemax_post_layout']) ? magazinemax_sanitize_post_layout_option_meta(wp_unslash($_POST['magazinemax_post_layout'])) : '';

            if ($magazinemax_post_layout_new && $magazinemax_post_layout_new != $magazinemax_post_layout_old) {

                update_post_meta($post_id, 'magazinemax_post_layout', $magazinemax_post_layout_new);

            } elseif ('' == $magazinemax_post_layout_new && $magazinemax_post_layout_old) {

                delete_post_meta($post_id, 'magazinemax_post_layout', $magazinemax_post_layout_old);

            }

        }


        foreach ($magazinemax_header_overlay_options as $magazinemax_header_overlay_option) {

            $magazinemax_header_overlay_old = esc_html(get_post_meta($post_id, 'magazinemax_header_overlay', true));
            $magazinemax_header_overlay_new = isset($_POST['magazinemax_header_overlay']) ? magazinemax_sanitize_header_overlay_option_meta(wp_unslash($_POST['magazinemax_header_overlay'])) : '';

            if ($magazinemax_header_overlay_new && $magazinemax_header_overlay_new != $magazinemax_header_overlay_old) {

                update_post_meta($post_id, 'magazinemax_header_overlay', $magazinemax_header_overlay_new);

            } elseif ('' == $magazinemax_header_overlay_new && $magazinemax_header_overlay_old) {

                delete_post_meta($post_id, 'magazinemax_header_overlay', $magazinemax_header_overlay_old);

            }

        }


        $magazinemax_ed_post_views_old = esc_html(get_post_meta($post_id, 'magazinemax_ed_post_views', true));
        $magazinemax_ed_post_views_new = isset($_POST['magazinemax_ed_post_views']) ? absint(wp_unslash($_POST['magazinemax_ed_post_views'])) : '';

        if ($magazinemax_ed_post_views_new && $magazinemax_ed_post_views_new != $magazinemax_ed_post_views_old) {

            update_post_meta($post_id, 'magazinemax_ed_post_views', $magazinemax_ed_post_views_new);

        } elseif ('' == $magazinemax_ed_post_views_new && $magazinemax_ed_post_views_old) {

            delete_post_meta($post_id, 'magazinemax_ed_post_views', $magazinemax_ed_post_views_old);

        }


        $magazinemax_ed_post_like_dislike_old = esc_html(get_post_meta($post_id, 'magazinemax_ed_post_like_dislike', true));
        $magazinemax_ed_post_like_dislike_new = isset($_POST['magazinemax_ed_post_like_dislike']) ? absint(wp_unslash($_POST['magazinemax_ed_post_like_dislike'])) : '';

        if ($magazinemax_ed_post_like_dislike_new && $magazinemax_ed_post_like_dislike_new != $magazinemax_ed_post_like_dislike_old) {

            update_post_meta($post_id, 'magazinemax_ed_post_like_dislike', $magazinemax_ed_post_like_dislike_new);

        } elseif ('' == $magazinemax_ed_post_like_dislike_new && $magazinemax_ed_post_like_dislike_old) {

            delete_post_meta($post_id, 'magazinemax_ed_post_like_dislike', $magazinemax_ed_post_like_dislike_old);

        }


        $magazinemax_ed_post_author_box_old = esc_html(get_post_meta($post_id, 'magazinemax_ed_post_author_box', true));
        $magazinemax_ed_post_author_box_new = isset($_POST['magazinemax_ed_post_author_box']) ? absint(wp_unslash($_POST['magazinemax_ed_post_author_box'])) : '';

        if ($magazinemax_ed_post_author_box_new && $magazinemax_ed_post_author_box_new != $magazinemax_ed_post_author_box_old) {

            update_post_meta($post_id, 'magazinemax_ed_post_author_box', $magazinemax_ed_post_author_box_new);

        } elseif ('' == $magazinemax_ed_post_author_box_new && $magazinemax_ed_post_author_box_old) {

            delete_post_meta($post_id, 'magazinemax_ed_post_author_box', $magazinemax_ed_post_author_box_old);

        }


        $magazinemax_ed_post_social_share_old = esc_html(get_post_meta($post_id, 'magazinemax_ed_post_social_share', true));
        $magazinemax_ed_post_social_share_new = isset($_POST['magazinemax_ed_post_social_share']) ? absint(wp_unslash($_POST['magazinemax_ed_post_social_share'])) : '';

        if ($magazinemax_ed_post_social_share_new && $magazinemax_ed_post_social_share_new != $magazinemax_ed_post_social_share_old) {

            update_post_meta($post_id, 'magazinemax_ed_post_social_share', $magazinemax_ed_post_social_share_new);

        } elseif ('' == $magazinemax_ed_post_social_share_new && $magazinemax_ed_post_social_share_old) {

            delete_post_meta($post_id, 'magazinemax_ed_post_social_share', $magazinemax_ed_post_social_share_old);

        }


        $magazinemax_ed_post_reaction_old = esc_html(get_post_meta($post_id, 'magazinemax_ed_post_reaction', true));
        $magazinemax_ed_post_reaction_new = isset($_POST['magazinemax_ed_post_reaction']) ? absint(wp_unslash($_POST['magazinemax_ed_post_reaction'])) : '';

        if ($magazinemax_ed_post_reaction_new && $magazinemax_ed_post_reaction_new != $magazinemax_ed_post_reaction_old) {

            update_post_meta($post_id, 'magazinemax_ed_post_reaction', $magazinemax_ed_post_reaction_new);

        } elseif ('' == $magazinemax_ed_post_reaction_new && $magazinemax_ed_post_reaction_old) {

            delete_post_meta($post_id, 'magazinemax_ed_post_reaction', $magazinemax_ed_post_reaction_old);

        }


        $magazinemax_ed_post_rating_old = esc_html(get_post_meta($post_id, 'magazinemax_ed_post_rating', true));
        $magazinemax_ed_post_rating_new = isset($_POST['magazinemax_ed_post_rating']) ? absint(wp_unslash($_POST['magazinemax_ed_post_rating'])) : '';

        if ($magazinemax_ed_post_rating_new && $magazinemax_ed_post_rating_new != $magazinemax_ed_post_rating_old) {

            update_post_meta($post_id, 'magazinemax_ed_post_rating', $magazinemax_ed_post_rating_new);

        } elseif ('' == $magazinemax_ed_post_rating_new && $magazinemax_ed_post_rating_old) {

            delete_post_meta($post_id, 'magazinemax_ed_post_rating', $magazinemax_ed_post_rating_old);

        }

        foreach ($magazinemax_page_layout_options as $magazinemax_post_layout_option) {

            $magazinemax_page_layout_old = sanitize_text_field(get_post_meta($post_id, 'magazinemax_page_layout', true));
            $magazinemax_page_layout_new = isset($_POST['magazinemax_page_layout']) ? magazinemax_sanitize_post_layout_option_meta(wp_unslash($_POST['magazinemax_page_layout'])) : '';

            if ($magazinemax_page_layout_new && $magazinemax_page_layout_new != $magazinemax_page_layout_old) {

                update_post_meta($post_id, 'magazinemax_page_layout', $magazinemax_page_layout_new);

            } elseif ('' == $magazinemax_page_layout_new && $magazinemax_page_layout_old) {

                delete_post_meta($post_id, 'magazinemax_page_layout', $magazinemax_page_layout_old);

            }

        }

        $magazinemax_ed_header_overlay_old = absint(get_post_meta($post_id, 'magazinemax_ed_header_overlay', true));
        $magazinemax_ed_header_overlay_new = isset($_POST['magazinemax_ed_header_overlay']) ? absint(wp_unslash($_POST['magazinemax_ed_header_overlay'])) : '';

        if ($magazinemax_ed_header_overlay_new && $magazinemax_ed_header_overlay_new != $magazinemax_ed_header_overlay_old) {

            update_post_meta($post_id, 'magazinemax_ed_header_overlay', $magazinemax_ed_header_overlay_new);

        } elseif ('' == $magazinemax_ed_header_overlay_new && $magazinemax_ed_header_overlay_old) {

            delete_post_meta($post_id, 'magazinemax_ed_header_overlay', $magazinemax_ed_header_overlay_old);

        }

    }

endif;   