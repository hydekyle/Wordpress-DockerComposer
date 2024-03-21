<?php
/**
 * Displays the footer widget area.
 *
 * @package Magazinemax
 */

/*Get the footer column from the customizer*/
$footer_column_layout = magazinemax_get_option('footer_column_layout');
$footer_class = 'column-3';

/*Footer Background Image*/
$footer_wrapper_start = $footer_wrapper_end = '';
/**/

//  Match Column value with Column class
if ($footer_column_layout) {
    switch ($footer_column_layout) {
        case "footer_layout_1":
            $footer_column = 3;
            $footer_class = 'column-4 column-sm-12';
            break;
        case "footer_layout_2":
            $footer_column = 2;
            $footer_class = 'column-6 column-sm-12';
            break;
        default:
            $footer_column = 3;
            $footer_class = 'column-4 column-sm-12';
    }
} else {
    $footer_column = 3;
    $footer_class = 'column-4';
}

$cols = intval(apply_filters('magazinemax_footer_widget_columns', $footer_column));

// Defines the number of active columns in this footer row.
for ($j = $cols; 0 < $j; $j--) {
    if (is_active_sidebar('footer-' . strval($j))) {
        $columns = $j;
        break;
    }
}

if (isset($columns)) : ?>
    <?php echo $footer_wrapper_start; ?>
    <div class="theme-footer-top">
        <div class="wrapper">
            <div class="column-row">
                <?php
                for ($column = 1; $column <= $columns; $column++) :
                    if (is_active_sidebar('footer-' . strval($column))) :
                        // Get the proper column class
                        if (is_array($footer_class)) {
                            $footer_display_class = $footer_class[$column - 1];
                        } else {
                            $footer_display_class = $footer_class;
                        }
                        ?>
                        <div class="column footer-widget-<?php echo strval($column); ?> <?php echo $footer_display_class; ?>">
                            <?php dynamic_sidebar('footer-' . strval($column)); ?>
                        </div><!-- .footer-widget-<?php echo strval($column); ?> -->
                    <?php
                    endif;
                endfor;
                ?>
            </div>
        </div>
    </div><!-- .theme-footer-top-->
    <?php echo $footer_wrapper_end; ?>
    <?php
    unset($columns);
endif;