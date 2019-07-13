<?php
/**
 * Register sidebars
 *
 * @package Expire
 * @version 1.1.0
 * @author Denis Žoljom <denis.zoljom@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT
 * @link https://madebydenis.com/expire
 *
 * @since  1.1.0 Updated license version.
 * @since  1.0.0
 */

add_action( 'widgets_init', 'expire_registered_sidebars' );

if ( ! function_exists( 'expire_registered_sidebars' ) ) {
	/**
	 * Register sidebar function callback
	 *
	 * @since 1.0.0
	 */
	function expire_registered_sidebars() {
		if ( function_exists( 'register_sidebar' ) ) {

			register_sidebar( array(
				'name'          => esc_html__( 'Primary Sidebar', 'expire' ),
				'id'            => 'primary-widget-area',
				'description'   => esc_html__( 'Single post sidebar.', 'expire' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="sidebar-widget-heading"><h3>',
				'after_title'   => '</h3></div>',
			) );

			register_sidebar( array(
				'name'          => esc_html__( 'Search Results Sidebar', 'expire' ),
				'id'            => 'search-results-widget-area',
				'description'   => esc_html__( 'Search Results Sidebar', 'expire' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class=sidebar-widget-heading>',
				'after_title'   => '</h3>',
			) );

		}
	}
}
