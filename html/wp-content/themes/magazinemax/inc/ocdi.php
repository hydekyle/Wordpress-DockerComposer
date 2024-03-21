<?php 
/**
 * Import Demo Data using OCDI
 *
 * @since 1.0.0
 */
function magazinemax_manage_import() {
    if ( is_admin() ) {
        $config_file = 'https://raw.githubusercontent.com/twpimport/Demo-Importer-Companion/master/magazinemax/init.json';
        $data = wp_remote_get( $config_file );
        // Only execute if our config is loaded properly.
        if ( is_array( $data ) && ! is_wp_error( $data ) ) {
            $data              = wp_remote_retrieve_body( $data );
            $config_data = json_decode( $data, true );
        }
    }
    $output = array();

    if ( $config_data && isset( $config_data['import_files'] ) ) {
        $free_demos = $config_data['import_files']['free'];
        foreach ( $free_demos as $demo_data ) {
            $file_url = 'https://raw.githubusercontent.com/twpimport/Demo-Importer-Companion/master/magazinemax/' . $demo_data['import_path'] . '/';
            $output[] = array(
                'import_file_name'           => $demo_data['import_name'],
                'import_file_url'            => $file_url . 'content.xml',
                'import_widget_file_url'     => $file_url . 'widgets.wie',
                'import_customizer_file_url' => $file_url . 'customizer.dat',
                'import_preview_image_url'   => $file_url . 'screenshot.webp',
                'preview_url'                => $demo_data['preview_url'],
            );
        }
    }

    return $output;
}
add_filter( 'pt-ocdi/import_files', 'magazinemax_manage_import' );

function magazinemax_after_import() {
    $front_page = get_posts(
      [
        'post_type'              => 'page',
        'title'                  => 'Homepage',
        'post_status'            => 'all',
        'numberposts'            => 1,
        'update_post_term_cache' => false,
        'update_post_meta_cache' => false,
      ]
    );
    
    if ( ! empty( $front_page ) ) {
      update_option( 'page_on_front', $front_page[0]->ID );
    }

    // Get the blog page.
    $blog_page = get_posts(
      [
        'post_type'              => 'page',
        'title'                  => 'Insights',
        'post_status'            => 'all',
        'numberposts'            => 1,
        'update_post_term_cache' => false,
        'update_post_meta_cache' => false,
      ]
    );
    
    if ( ! empty( $blog_page ) ) {
      update_option( 'page_for_posts', $blog_page[0]->ID );
    }
    
    if ( ! empty( $blog_page ) || ! empty( $front_page ) ) {
      update_option( 'show_on_front', 'page' );

    }
    // Assign navigation menu locations.
    $menu_location_details = array(
        'primary-menu',
        'footer-menu',
        'top-menu',
        'social-menu',
    );

    if ( ! empty( $menu_location_details ) ) {
        $navigation_settings      = array();
        $current_navigation_menus = wp_get_nav_menus();
        if ( ! empty( $current_navigation_menus ) && ! is_wp_error( $current_navigation_menus ) ) {
            foreach ( $current_navigation_menus as $menu ) {
                if ( in_array( $menu->slug, $menu_location_details, true ) ) {
                    $navigation_settings[ $menu->slug ] = $menu->term_id;
                }
            }
        }
        set_theme_mod( 'nav_menu_locations', $navigation_settings );
    }
}
add_action( 'ocdi/after_import', 'magazinemax_after_import' );