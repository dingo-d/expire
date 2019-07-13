<?php
/**
 * Expire functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @package Expire
 * @version 1.0.9
 * @author Denis Žoljom <denis.zoljom@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.txt
 * @link https://madebydenis.com/expire
 * @since  1.0.0
 */

define( 'EXPIRE_THEME_VERSION', '1.0.0' );
define( 'EXPIRE_TEMPPATH', get_template_directory_uri() );
define( 'EXPIRE_TEMPDIR', get_template_directory() );

add_action( 'after_setup_theme', 'expire_theme_setup' );
if ( ! function_exists( 'expire_theme_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since  1.0.0
	 */
	function expire_theme_setup() {
		load_theme_textdomain( 'expire', EXPIRE_TEMPDIR . '/languages' );

		$GLOBALS['content_width'] = get_theme_mod( 'grid_width', '1170' );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );
		add_theme_support( 'html5', array( 'gallery', 'caption' ) );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'custom-background', array( 'default-color' => '#fff' ) );
		add_theme_support( 'custom-logo', array(
			'header-text' => array( 'site-title', 'site-description' ),
		) );

		register_default_headers( array(
			'coffee' => array(
				'url'           => get_template_directory_uri() . '/assets/images/default-header-image.jpg',
				'thumbnail_url' => get_template_directory_uri() . '/assets/images/default-header-image.jpg',
				'description'   => esc_html__( 'Coffee', 'expire' ),
			),
		) );

		$custom_header_args = array(
			'flex-width'    => true,
			'flex-height'   => true,
			'default-text-color' => '#ffffff',
			'default-image' => get_template_directory_uri() . '/assets/images/default-header-image.jpg',
		);
		add_theme_support( 'custom-header', $custom_header_args );
		add_post_type_support( 'page', 'excerpt' );
		add_filter( 'the_content_more_link', 'expire_remove_more_link_scroll_wrap' );

		/********* Menus ***********/
		add_action( 'init', 'expire_register_my_menus' );

		/********* Enqueue Scripts ***********/
		add_action( 'wp_enqueue_scripts', 'expire_frontend_scripts' );

		/********* Register sidebars ***********/
		require_once( EXPIRE_TEMPDIR . '/inc/sidebars.php' );

		/********* Breadcrumbs! ***********/
		require_once( EXPIRE_TEMPDIR . '/inc/breadcrumbs.php' );

	}
}

/********* Theme Customizer ***********/
require_once( EXPIRE_TEMPDIR . '/inc/customizer/customizer.php' );

if ( ! function_exists( 'expire_register_my_menus' ) ) {
	/**
	 * Register menu function
	 *
	 * Registers new menu locations based on theme option settings.
	 *
	 * @since  1.0.0
	 */
	function expire_register_my_menus() {
		register_nav_menus( array(
			'header_menu' => esc_html__( 'Header Menu', 'expire' ),
		) );
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

		wp_enqueue_style( 'expire-google-fonts', expire_fonts_url(), array(), null );
		wp_enqueue_style( 'expire-icon-font', EXPIRE_TEMPPATH . '/assets/css/icons/icons.css', array(), EXPIRE_THEME_VERSION );
		wp_enqueue_style( 'expire-main-css', get_stylesheet_uri(), array( 'expire-google-fonts', 'expire-icon-font', 'wp-mediaelement' ), EXPIRE_THEME_VERSION );

		// Styles from options - appends styles to $custom_css variable.
		$custom_css = '';
		include_once( get_stylesheet_directory() . '/inc/dynamic-css.php' );
		wp_add_inline_style( 'expire-main-css', $custom_css );

		wp_enqueue_script( 'expire-custom', EXPIRE_TEMPPATH . '/assets/js/custom.js', array( 'jquery', 'imagesloaded', 'wp-mediaelement' ), EXPIRE_THEME_VERSION, true );

	}
}

/********* Google Fonts URL function  ***********/
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

/********* Sanitization Functions ***********/
if ( ! function_exists( 'expire_allowed_tags' ) ) {
	/**
	 * Allowed tags function for wp_kses()
	 *
	 * @return array Array of allowed HTML tags
	 * @since 1.0.0
	 */
	function expire_allowed_tags() {
		return array(
			'a' => array(
				'class' => array(),
				'href'  => array(),
				'rel'   => array(),
				'title' => array(),
			),
			'b' => array(),
			'br' => array(),
			'span' => array(
				'class' => array(),
				'title' => array(),
				'style' => array(),
			),
			'del' => array(
				'datetime' => array(),
				'title' => array(),
			),
			'dd' => array(),
			'div' => array(
				'class' => array(),
				'title' => array(),
				'style' => array(),
			),
			'em' => array(),
			'ul' => array(
				'class' => array(),
			),
			'ol' => array(
				'class' => array(),
			),
			'li' => array(
				'class' => array(),
			),
			'dl' => array(),
			'dt' => array(),
			'em' => array(),
			'h1' => array(),
			'h2' => array(),
			'h3' => array(),
			'h4' => array(),
			'h5' => array(),
			'h6' => array(),
			'img' => array(
				'alt'    => array(),
				'class'  => array(),
				'height' => array(),
				'src'    => array(),
				'width'  => array(),
			),
			'input' => array(
				'accept' => array(),
				'class' => array(),
				'id' => array(),
				'align' => array(),
				'alt' => array(),
				'autocomplete' => array(),
				'autofocus' => array(),
				'clicked' => array(),
				'dirname' => array(),
				'disabled' => array(),
				'form' => array(),
				'formenctype' => array(),
				'formmethod' => array(),
				'formnovalidate' => array(),
				'formtarget' => array(),
				'height' => array(),
				'list' => array(),
				'max' => array(),
				'maxlength' => array(),
				'min' => array(),
				'multiple' => array(),
				'name' => array(),
				'pattern' => array(),
				'placeholder' => array(),
				'readonly' => array(),
				'required' => array(),
				'size' => array(),
				'step' => array(),
				'type' => array(),
				'value' => array(),
				'width' => array(),
			),
			'strong' => array(),
			'pre' => array(),
			'code' => array(),
			'blockquote' => array(
				'cite' => true,
			),
			'i' => array(
				'class' => array(),
			),
			'cite' => array(
				'title' => array(),
			),
			'abbr' => array(
				'title' => true,
			),
			'select' => array(
				'id'   => array(),
				'class' => array(),
				'name' => array(),
			),
			'option' => array(
				'value' => array(),
				'selected' => array(),
			),
			'strike' => array(),
		);
	}
}

if ( ! function_exists( 'expire_text_sanitization' ) ) {
	/**
	 * Text sanitization function for Customize API
	 *
	 * @param  string $input Input to be sanitized.
	 * @return string        Sanitized input.
	 * @since 1.0.0
	 */
	function expire_text_sanitization( $input ) {
		return wp_kses_post( force_balance_tags( $input ) );
	}
}

if ( ! function_exists( 'expire_checkbox_sanitization' ) ) {
	/**
	 * Checkbox sanitization function for Customize API
	 *
	 * @param  string $input Checkbox value.
	 * @return integer       Sanitized value.
	 * @since 1.0.0
	 */
	function expire_checkbox_sanitization( $input ) {
		if ( true === $input ) {
			return 1;
		} else {
			return '';
		}
	}
}

if ( ! function_exists( 'expire_sanitize_integer' ) ) {
	/**
	 * Integer sanitization function for Customize API
	 *
	 * @param  string $input Input value to check.
	 * @return integer        Returned integer value.
	 * @since 1.0.0
	 */
	function expire_sanitize_integer( $input ) {
		if ( is_numeric( $input ) ) {
			return intval( $input );
		} else {
			return '';
		}
	}
}
