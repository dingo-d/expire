<?php
/**
 * Expire functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @package Expire
 * @version 1.1.2
 * @author Denis Žoljom <denis.zoljom@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT
 * @link https://madebydenis.com/expire
 *
 * @since  1.1.2 Removed functionality to separate files for easier management.
 * @since  1.1.0 Updated license version.
 * @since  1.0.0
 */

define( 'EXPIRE_THEME_VERSION', '1.1.4' );
define( 'EXPIRE_TEMPPATH', get_theme_file_uri() );
define( 'EXPIRE_TEMPDIR', get_theme_file_path() );

require EXPIRE_TEMPDIR . '/inc/theme-support.php';

require EXPIRE_TEMPDIR . '/inc/metabox-page.php';

require EXPIRE_TEMPDIR . '/inc/sanitization.php';

if ( ! function_exists( 'expire_theme_version' ) ) {
	/**
	 * Cache busting for development purposes
	 *
	 * @since 1.1.0
	 *
	 * @return string
	 */
	function expire_theme_version() {
		return ( defined( 'DEV' ) && DEV ) ? filemtime( get_stylesheet_directory() ) : EXPIRE_THEME_VERSION;
	}
}

/**
 * Theme Customizer
 */
require EXPIRE_TEMPDIR . '/inc/customizer/customizer.php';

if ( ! function_exists( 'expire_register_my_menus' ) ) {
	/**
	 * Register menu function
	 *
	 * Registers new menu locations based on theme option settings.
	 *
	 * @since 1.0.0
	 */
	function expire_register_my_menus() {
		register_nav_menus( array(
			'header_menu' => esc_html__( 'Header Menu', 'expire' ),
		) );
	}
}


if ( ! function_exists( 'expire_fonts_dependency' ) ) {
	/**
	 * Add enqueue for font dependencies
	 *
	 * @return void
	 */
	function expire_fonts_dependency() {
		wp_enqueue_style( 'expire-google-fonts', expire_fonts_url(), array(), null );
		wp_enqueue_style( 'expire-icon-font', EXPIRE_TEMPPATH . '/assets/css/icons/icons.css', array(), expire_theme_version() );
	}
}

if ( ! function_exists( 'expire_frontend_scripts' ) ) {
	/**
	 * Enqueue scripts and styles.
	 *
	 * @since 1.0.0
	 */
	function expire_frontend_scripts() {
		if ( is_singular() ) {
			wp_enqueue_script( 'comment-reply' );
		}

		expire_fonts_dependency();

		wp_enqueue_style( 'expire-main-css', get_stylesheet_uri(), array( 'expire-google-fonts', 'expire-icon-font', 'wp-mediaelement' ), expire_theme_version() );

		// Styles from options - appends styles to $custom_css variable.
		$custom_css = '';
		include_once( get_stylesheet_directory() . '/inc/dynamic-css.php' );
		wp_add_inline_style( 'expire-main-css', $custom_css );

		wp_enqueue_script( 'expire-custom', EXPIRE_TEMPPATH . '/assets/js/custom.js', array( 'jquery', 'imagesloaded', 'wp-mediaelement' ), expire_theme_version(), true );

	}
}

if ( ! function_exists( 'expire_gutenberg_admin_styles' ) ) {
	/**
	 * Enqueue styles for the admin editor.
	 *
	 * @since 1.1.0
	 */
	function expire_gutenberg_admin_styles() {
		expire_fonts_dependency();


		wp_enqueue_style( 'expire-gutenberg-styles', EXPIRE_TEMPPATH . '/assets/css/gutenberg.css', array( 'expire-google-fonts', 'expire-icon-font' ), expire_theme_version() );

		$editor_custom_css = '';
		include_once( get_stylesheet_directory() . '/inc/dynamic-css-admin.php' );
		wp_add_inline_style( 'expire-gutenberg-styles', $editor_custom_css );
	}
}

if ( ! function_exists( 'expire_fonts_url' ) ) {
	/**
	 * Add google fonts
	 *
	 * @return string Google Fonts url.
	 */
	function expire_fonts_url() {
		$fonts_url = '';
		// Translators: If there are characters in your language that are not supported by Google font, translate it to 'off'. Do not translate into your own language.
		$raleway = esc_html_x( 'on', 'Open sans font: on or off', 'expire' );
		$open_sans = esc_html_x( 'on', 'Raleway font: on or off', 'expire' );
		if ( 'off' !== $raleway || 'off' !== $open_sans ) {
			$font_families = array();
			if ( 'off' !== $raleway ) {
				$font_families[] = 'Raleway:300,400,500,600';
			}
			if ( 'off' !== $open_sans ) {
				$font_families[] = 'Open+Sans:400,600';
			}
			$query_args = array(
				'family' => rawurlencode( implode( '|', $font_families ) ),
				'subset' => rawurlencode( 'latin,latin-ext' ),
			);
			$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
		}
		return esc_url_raw( $fonts_url );
	}
}

if ( ! function_exists( 'expire_remove_more_link_scroll_wrap' ) ) {
	/**
	 * Wrap Read more button and remove anchor
	 *
	 * @param  string $link Link to filter.
	 * @return string       New HTML for readme button.
	 * @since 1.0.0
	 */
	function expire_remove_more_link_scroll_wrap( $link ) {
		$link = preg_replace( '|#more-[0-9]+|', '', $link );
		return '<div class="post-readmore">' . $link . '</div>';
	}
}

if ( ! function_exists( 'wp_body_open' ) ) {
	/**
	 * Backwards compatibility for wp_body_open() function
	 *
	 * @return void
	 */
	function wp_body_open() {
			do_action( 'wp_body_open' );
	}
}
