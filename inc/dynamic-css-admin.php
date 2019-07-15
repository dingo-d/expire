<?php
/**
 * Dynamic css based on options in the Theme Customize API and Theme Options
 *
 * Used for admin styling only.
 *
 * @package Expire
 * @version 1.1.0
 * @author Denis Žoljom <https://madebydenis.com/expire>
 * @license https://opensource.org/licenses/MIT MIT
 * @link https://madebydenis.com/expire
 *
 * @since 1.1.0
 */

/**
 * Grid width customizer setting
 *
 * @var string
 */
$grid_width = get_theme_mod( 'grid_width', '1170' );

if ( isset( $grid_width ) && '' !== $grid_width ) {
	$editor_custom_css .= '.wp-block{max-width:' . intval( esc_attr( $grid_width ) ) . 'px;}';
}
