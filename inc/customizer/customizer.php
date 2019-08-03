<?php
/**
 * Customizer
 *
 * @package Expire
 * @version 1.1.2
 * @author Denis Žoljom <denis.zoljom@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT
 * @link https://madebydenis.com/expire
 *
 * @since  1.1.0 Updated license version. Remove some options, add hide breadcrumbs options.
 * @since  1.0.0
 */

/**
 * Including custom controls
 */
require EXPIRE_TEMPDIR . '/inc/customizer/custom-controls.php'; // phpcs:ignore

add_action( 'customize_register', 'expire_customize_register', 11 );
/**
 * Register customizer settings
 *
 * @see add_action('customize_register',$func)
 * @param  \WP_Customize_Manager $wp_customize WP Customize object.
 * @since 1.0.0
 */
function expire_customize_register( WP_Customize_Manager $wp_customize ) {

	// Abort if selective refresh is not available.
	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	/**
	 * Render the site title.
	 *
	 * This function can be used in the template directly instead of calling bloginfo(),
	 * and in this why the duplication of logic can be avoided.
	 * For more complex partials with markup, use get_template_part().
	 *
	 * This function is called after the associated Customizer setting has already
	 * been previewed, so we can call it just as if we were in the template normally.
	 *
	 * Props to Weston Ruter: https://gist.github.com/westonruter/a15b99bdd07e6f4aae7a
	 *
	 * @see \get_template_part().
	 * @return string|void If any text string is returned, it will be used instead of any text echoed and captured via output buffering.
	 */
	function expire_render_blogname() {
		return get_bloginfo( 'name', 'display' );
	}

	/**
	 * Render blog description
	 *
	 * @see \get_template_part().
	 * @return string|void If any text string is returned, it will be used instead of any text echoed and captured via output buffering.
	 */
	function expire_render_blog_description() {
		return get_bloginfo( 'description', 'display' );
	}

	// Add postMessage support for site title and description.
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Selective refreshes.
	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector'        => '#main_logo_textual',
		'render_callback' => 'expire_render_blogname',
	) );

	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector'        => '#main_tagline',
		'render_callback' => 'expire_render_blog_description',
	) );

	/**
	 * Separator Control
	 *
	 * @param  object $wp_customize WP Customize object.
	 * @param  string $section      Name of the section.
	 * @param  int    $priority      Priority number.
	 * @since 1.0.0
	 */
	function expire_customizer_separator_control( $wp_customize, $section, $priority = null ) {
		$id = uniqid();
		$sep_var = 'general_sep_' . $id;
		$wp_customize->add_setting( $sep_var, array(
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		) );
		$wp_customize->add_control( new Expire_Separator_Custom_Control( $wp_customize, $sep_var, array(
			'settings' => $sep_var,
			'section'  => $section,
			'priority' => $priority,
		) ) );
	}

	/**
	------------------------------------------------------------
	SECTION: General
	------------------------------------------------------------
	*/
	$wp_customize->add_section( 'section_general', array(
		'title'	   => esc_html__( 'General', 'expire' ),
		'priority' => 0,
	) );

	/**
	Hide Comments
	*/
	$wp_customize->add_setting( 'hide_comments', array(
		'default'           => false,
		'sanitize_callback' => 'expire_checkbox_sanitization',
	) );
	$wp_customize->add_control( new Expire_Toggle_Checkbox_Custom_Control( $wp_customize, 'hide_comments', array(
		'label'    	  => esc_html__( 'Hide Comments', 'expire' ),
		'description' => esc_html__( 'Check this to hide WordPress comments on all pages', 'expire' ),
		'type'     	  => 'checkbox',
		'section'  	  => 'section_general',
	) ) );

	/**
	Show title bar
	*/
	$wp_customize->add_setting( 'show_title_bar', array(
		'default'           => false,
		'sanitize_callback' => 'expire_checkbox_sanitization',
	) );
	$wp_customize->add_control( new Expire_Toggle_Checkbox_Custom_Control( $wp_customize, 'show_title_bar', array(
		'label'    	  => esc_html__( 'Show Title Bar', 'expire' ),
		'description' => esc_html__( 'Check this to hide the title bar on all pages', 'expire' ),
		'type'     	  => 'checkbox',
		'section'  	  => 'section_general',
	) ) );

	/**
	Separator
	*/
	expire_customizer_separator_control( $wp_customize, 'section_general' );

	/**
	Grid Width
	*/
	$wp_customize->add_setting( 'grid_width', array(
		'default'           => '1170',
		'transport'	        => 'postMessage',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'grid_width', array(
		'label'   => esc_html__( 'Grid Width (px)', 'expire' ),
		'section' => 'section_general',
		'type'    => 'select',
		'choices' => array(
			'1200' => esc_html__( '1200', 'expire' ),
			'1170' => esc_html__( '1170', 'expire' ),
			'1140' => esc_html__( '1140', 'expire' ),
			'1080' => esc_html__( '1080', 'expire' ),
			'1040' => esc_html__( '1040', 'expire' ),
			'980'  => esc_html__( '980', 'expire' ),
			'960'  => esc_html__( '960', 'expire' ),
		),
	) );

	/**
	Separator
	*/
	expire_customizer_separator_control( $wp_customize, 'section_general' );

	/**
	404 Page
	*/
	$wp_customize->add_setting( 'alternative_404_page', array(
		'default'           => 0,
		'sanitize_callback' => 'expire_sanitize_integer',
	) );
	$wp_customize->add_control( 'alternative_404_page', array(
		'label'   => esc_html__( 'Select 404 Page', 'expire' ),
		'type'    => 'dropdown-pages',
		'section' => 'section_general',
	) );

	/**
	------------------------------------------------------------
	SECTION: Posts and Page
	------------------------------------------------------------
	*/

	$wp_customize->add_section( 'posts', array(
		'priority'    => 10,
		'title'       => esc_html__( 'Posts', 'expire' ),
		'description' => esc_html__( 'This panel contains options for single posts.', 'expire' ),
	) );

	/**
	Page After Single Post
	*/
	$wp_customize->add_setting( 'content_after_single_post', array(
		'default'           => 0,
		'sanitize_callback' => 'expire_sanitize_integer',
	) );
	$wp_customize->add_control( 'content_after_single_post', array(
		'label'       => esc_html__( 'Page After Single Post', 'expire' ),
		'description' => esc_html__( 'Content of the selected page will be shown on every Single Post Page after post.', 'expire' ),
		'type'        => 'dropdown-pages',
		'section'     => 'section_post',
	) );

	/**
	------------------------------------------------------------
	SECTION: Colors
	------------------------------------------------------------
	*/
	$wp_customize->add_section( 'colors', array(
		'title'	   => esc_html__( 'Colors', 'expire' ),
		'priority' => 0,
	) );

	/**
	Main Color
	*/
	$wp_customize->add_setting( 'main_color', array(
		'default'           => '#ff3c1f',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_color', array(
		'label'    => esc_html__( 'Main Color', 'expire' ),
		'settings' => 'main_color',
		'section'  => 'colors',
	) ) );


	/**
	Secondary Color
	*/
	$wp_customize->add_setting( 'secondary_color', array(
		'default'           => '#e6e9ed',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_color', array(
		'label'    => esc_html__( 'Secondary Color', 'expire' ),
		'settings' => 'secondary_color',
		'section'  => 'colors',
	) ) );

	/**
	Body Text Color
	*/
	$wp_customize->add_setting( 'body_text_color', array(
		'default'           => '#3e3d3d',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'body_text_color', array(
		'label'    => esc_html__( 'Body Text Color', 'expire' ),
		'settings' => 'body_text_color',
		'section'  => 'colors',
	) ));

	/**
	Header Background Color
	*/
	$wp_customize->add_setting( 'header_background_color', array(
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background_color', array(
		'label'    => esc_html__( 'Header Background Color', 'expire' ),
		'settings' => 'header_background_color',
		'section'  => 'colors',
	) ));

	/**
	Menu Text Color
	*/
	$wp_customize->add_setting( 'menu_text_color', array(
		'default'           => '#ffffff',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_text_color', array(
		'label'    => esc_html__( 'Menu Text Color', 'expire' ),
		'settings' => 'menu_text_color',
		'section'  => 'colors',
	) ));

	/**
	Links Hover
	*/
	$wp_customize->add_setting( 'links_hover', array(
		'default'           => '#3e3d3d',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'links_hover', array(
		'label'    => esc_html__( 'Links Hover', 'expire' ),
		'settings' => 'links_hover',
		'section'  => 'colors',
	) ) );

	/**
	------------------------------------------------------------
	SECTION: Footer
	------------------------------------------------------------
	*/
	$wp_customize->add_section( 'footer', array(
		'title'	   => esc_html__( 'Footer', 'expire' ),
		'priority' => 10,
	) );

	/**
	Show Social Buttons
	*/
	$wp_customize->add_setting( 'show_social', array(
		'default'           => false,
		'sanitize_callback' => 'expire_checkbox_sanitization',
	) );
	$wp_customize->add_control( new Expire_Toggle_Checkbox_Custom_Control( $wp_customize, 'show_social', array(
		'label'    	  => esc_html__( 'Show Social Icons', 'expire' ),
		'description' => esc_html__( 'Check this to show social icons in footer', 'expire' ),
		'type'        => 'checkbox',
		'section'  	  => 'footer',
		'priority' 	  => 0,
	) ) );

	/**
	Social links target
	*/
	$wp_customize->add_setting( 'footer_target', array(
		'default'           => '_self',
		'sanitize_callback' => 'expire_text_sanitization',
	) );
	$wp_customize->add_control( 'footer_target', array(
		'label'   => esc_html__( 'Social links target', 'expire' ),
		'section' => 'footer',
		'type'    => 'select',
		'choices' => array(
			'_blank'   => esc_html__( '_blank', 'expire' ),
			'_self'    => esc_html__( '_self', 'expire' ),
			'_parent'  => esc_html__( '_parent', 'expire' ),
			'_top'     => esc_html__( '_top', 'expire' ),
			),
		'priority' => 0,
	) );

	/**
	Facebook
	*/
	$wp_customize->add_setting( 'footer_facebook', array(
		'default'           => '',
		'transport'	        => 'postMessage',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'footer_facebook', array(
		'label'       => esc_html__( 'Facebook link', 'expire' ),
		'section'     => 'footer',
		'type' 		  => 'text',
	) );

	/**
	Twitter
	*/
	$wp_customize->add_setting( 'footer_twitter', array(
		'default'           => '',
		'transport'	        => 'postMessage',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'footer_twitter', array(
		'label'       => esc_html__( 'Twitter link', 'expire' ),
		'section'     => 'footer',
		'type' 		  => 'text',
	) );

	/**
	LinkedIn
	*/
	$wp_customize->add_setting( 'footer_linkedin', array(
		'default'           => '',
		'transport'	        => 'postMessage',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'footer_linkedin', array(
		'label'       => esc_html__( 'LinkedIn link', 'expire' ),
		'section'     => 'footer',
		'type' 		  => 'text',
	) );

	/**
	Google Plus
	*/
	$wp_customize->add_setting( 'footer_gplus', array(
		'default'           => '',
		'transport'	        => 'postMessage',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'footer_gplus', array(
		'label'       => esc_html__( 'Google Plus link', 'expire' ),
		'section'     => 'footer',
		'type' 		  => 'text',
	) );

	/**
	Instagram
	*/
	$wp_customize->add_setting( 'footer_instagram', array(
		'default'           => '',
		'transport'	        => 'postMessage',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'footer_instagram', array(
		'label'       => esc_html__( 'Instagram link', 'expire' ),
		'section'     => 'footer',
		'type' 		  => 'text',
	) );

	/**
	Separator
	*/
	expire_customizer_separator_control( $wp_customize, 'footer', 10 );

	/**
	Footer Logo
	*/
	$wp_customize->add_setting( 'footer_logo', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_logo', array(
		'label'     => esc_html__( 'Footer Logo', 'expire' ),
		'section'   => 'footer',
		'mime_type' => 'image',
	) ) );

	expire_customizer_separator_control( $wp_customize, 'footer' );

	/**
	Copyright
	*/
	$wp_customize->add_setting( 'footer_copyright', array(
		'default'           => '',
		'transport'	        => 'postMessage',
		'sanitize_callback' => 'expire_text_sanitization',
	) );
	$wp_customize->add_control( 'footer_copyright', array(
		'label'       => esc_html__( 'Footer Copyright Text', 'expire' ),
		'section'     => 'footer',
		'type' 		  => 'text',
	) );

}

add_action( 'customize_controls_enqueue_scripts', 'expire_customizer_control_toggle' );
add_action( 'customize_preview_init', 'expire_customizer_live_preview' );
/**
 * Live preview script enqueue
 *
 * @since 1.0.0
 */
function expire_customizer_live_preview() {
	wp_enqueue_script( 'expire-themecustomizer', EXPIRE_TEMPPATH . '/inc/customizer/js/customizer.js', array( 'jquery', 'customize-preview' ), expire_theme_version() );
}

/**
 * Custom contextual controls
 *
 * @since 1.0.0
 */
function expire_customizer_control_toggle() {
	wp_enqueue_script( 'expire-contextual-controls', EXPIRE_TEMPPATH . '/inc/customizer/js/customizer-contextual.js', array( 'customize-controls' ), expire_theme_version() );
	wp_add_inline_style( 'customize-controls', '.wp-full-overlay-sidebar { background: #fff } .customize-control .attachment-media-view .thumbnail{background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAMCAIAAADZF8uwAAAAGUlEQVQYV2M4gwH+YwCGIasIUwhT25BVBADtzYNYrHvv4gAAAABJRU5ErkJggg==);}' );
}

