<?php
/**
 * Theme support file
 *
 * Contains all the add them support functionality
 *
 * @package Expire
 * @version 1.1.2
 * @author Denis Žoljom <denis.zoljom@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT
 * @link https://madebydenis.com/expire
 *
 * @since  1.1.0 Updated license version.
 * @since  1.0.0
 */

add_action( 'after_setup_theme', 'expire_theme_setup' );

if ( ! function_exists( 'expire_theme_setup' ) ) {
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which
   * runs before the init hook. The init hook is too late for some features, such
   * as indicating support for post thumbnails.
   *
   * @since  1.1.0 Updated license version.
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
        'url'           => get_theme_file_uri() . '/assets/images/default-header-image.jpg',
        'thumbnail_url' => get_theme_file_uri() . '/assets/images/default-header-image.jpg',
        'description'   => esc_html__( 'Coffee', 'expire' ),
      ),
    ) );

    $custom_header_args = array(
      'flex-width'    => true,
      'flex-height'   => true,
      'header-text'   => true,
      'default-image' => get_theme_file_uri() . '/assets/images/default-header-image.jpg',
    );

    add_theme_support( 'custom-header', $custom_header_args );

    add_post_type_support( 'page', 'excerpt' );

    add_filter( 'the_content_more_link', 'expire_remove_more_link_scroll_wrap' );

    /**
     * Menus
     */
    add_action( 'init', 'expire_register_my_menus' );

    /**
     * Enqueue Scripts
     */
    add_action( 'wp_enqueue_scripts', 'expire_frontend_scripts' );

    /**
     * Gutenberg admin style
     */
	add_action( 'enqueue_block_editor_assets', 'expire_gutenberg_admin_styles' );

    /**
     * Register sidebars
     */
    require EXPIRE_TEMPDIR . '/inc/sidebars.php'; // phpcs:ignore

    /**
     * Breadcrumbs
     */
    require EXPIRE_TEMPDIR . '/inc/breadcrumbs.php'; // phpcs:ignore

  }
}
