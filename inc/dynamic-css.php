<?php
/**
 * Dynamic css based on options in the Theme Customize API and Theme Options
 *
 * @package Expire
 * @version 1.1.0
 * @author Denis Žoljom <https://madebydenis.com/expire>
 * @license https://opensource.org/licenses/MIT MIT
 * @link https://madebydenis.com/expire
 *
 * @since 1.1.0 Update comment styles, updated styles
 * @since 1.0.0
 */

/**
 * Grid width customizer setting
 *
 * @var string
 */
$grid_width = get_theme_mod( 'grid_width', '1170' );

if ( isset( $grid_width ) && '' !== $grid_width ) {
	$custom_css .= '
	.container{width:' . intval( esc_attr( $grid_width ) ) . 'px;}
	.wp-block-cover,.wp-block-image.alignfull{margin-left:calc((100vw - ' . intval( esc_attr( $grid_width ) ) . 'px)/-2);}
	';
}

/**
 * Custom Header
 *
 * @var string
 */
if ( has_header_image() ) {
	$custom_css .= '#expire_title_bar{background:url(' . get_header_image() . '); min-height:' . esc_attr( get_custom_header()->height ) . '; background-size:cover; background-position:center center;}';
}

/**
 * Custom header color customizer setting
 *
 * @var string
 */
$custom_css .= '#expire_title_bar h2{ color: #' . get_header_textcolor() . '}';

/**
 * Background color customizer setting
 *
 * @var string
 */
$background_color = get_theme_mod( 'background_color' );

$custom_css .= '.blog .post_content_inner_wrapper .post_info{ background: ' . esc_attr( $background_color ) . '}
	#expire_breadcrumbs_section{ border-color: #' . esc_attr( $background_color ) . ';} #expire_breadcrumbs_section:before{ background: #' . esc_attr( $background_color ) . ';}
	#expire_breadcrumbs_section:after{ border-bottom-color: #' . esc_attr( $background_color ) . ';}';

/**
 * Main color customizer setting
 *
 * @var string
 */
$main_color = get_theme_mod( 'main_color' );

$custom_css .= '::selection{ background:' . esc_attr( $main_color ) . ';}
	::-moz-selection{ background:' . esc_attr( $main_color ) . ';}
	a{color:' . esc_attr( $main_color ) . ';}
	.single_post_content .inner_post_content .post_info .post_type,
	.blog .post_content_inner_wrapper .post_info .post_type{ background:' . esc_attr( $main_color ) . ';}
	.placeholder{ color:' . esc_attr( $main_color ) . ';}
	#page404 .big_404{ color:' . esc_attr( $main_color ) . ';}
	.blog .post_content_inner_wrapper .more-link{ color:' . esc_attr( $main_color ) . '; border-color:' . esc_attr( $main_color ) . ';}
	#expire_single_post_pagination .prev:hover,
	#expire_single_post_pagination .next:hover{ border-color:' . esc_attr( $main_color ) . ';}
	nav > ul > li > a:hover:after,
	nav > ul > li > a:hover:after, nav > ul > li.current_page_item > a:after, nav > ul > li.current_page_parent > a:after{ background:' . esc_attr( $main_color ) . ';}
	nav > ul ul li:hover > a{ color:' . esc_attr( $main_color ) . ';}';

/**
 * Secondary color customizer setting
 *
 * @var string
 */
$secondary_color = get_theme_mod( 'secondary_color' );

$custom_css .= 'select{background-image: linear-gradient(45deg, transparent 50%, ' . esc_attr( $secondary_color ) . ' 50%), linear-gradient(135deg, ' . esc_attr( $secondary_color ) . ' 50%, transparent 50%), linear-gradient(to right, ' . esc_attr( $secondary_color ) . ', ' . esc_attr( $secondary_color ) . ');}
	button,input,select,textarea,
	nav > ul ul,
	nav > ul ul ul,
	.blog .post_wrapper .post_content h3,
	.blog .post_content_inner_wrapper,
	.blog .post_content_inner_wrapper .post_info,
	.pagination_simple .page-numbers,
	.single_post_content .main_title,
	.single_post_content .inner_post_content .post_info,
	.single_post_content .post_content,
	.post_tags,
	#expire_single_post_pagination .prev,
	#expire_single_post_pagination .next,
	#comments-title,
	.widget_tag_cloud .tagcloud a{ border-color:' . esc_attr( $secondary_color ) . ';}
	.blog .sticky .post_content_inner_wrapper,
	.post_featured_image:before{ background:' . esc_attr( $secondary_color ) . ';}';

/**
 * Body background & text color customizer setting
 *
 * @var string
 */
$body_text_color = get_theme_mod( 'body_text_color' );

if ( '' !== $body_text_color ) {
	$custom_css .= 'body{color:' . esc_attr( $body_text_color ) . ';}
	h1, h2, h3, h4, h5, h6{color:' . esc_attr( $body_text_color ) . ';}
	.post_date{color:' . esc_attr( $body_text_color ) . ';}
	.post_meta i,
	.post_tags i{ color:' . esc_attr( $body_text_color ) . ';}
	.single_post_content .post_meta i{ color:' . esc_attr( $main_color ) . ';}';
}

/**
 * Header background color customizer setting
 *
 * @var string
 */
$header_background_color = get_theme_mod( 'header_background_color' );
if ( '' !== $header_background_color ) {
	$custom_css .= '.expire_main_header{background-color:' . esc_attr( $header_background_color ) . ';}';
}

/**
 * Header menu text color customizer setting
 *
 * @var string
 */
$menu_text_color = get_theme_mod( 'menu_text_color' );
if ( '' !== $menu_text_color ) {
	$custom_css .= '.has_header_image nav > ul > li > a{color:' . esc_attr( $menu_text_color ) . ';}';
}

/**
 * Links hover color customizer setting
 *
 * @var string
 */
$links_hover = get_theme_mod( 'links_hover' );

if ( '' !== $links_hover ) {
	$custom_css .= 'a:not(.has_header_image nav > ul > li > a):hover,
		input[type="submit"]:hover,
		.search .submit:hover i,
		nav > ul > li a:hover,
		nav > ul > li > a:hover:after,
		nav > ul li:hover > ul,
		nav > ul ul li a:hover,
		.blog .post_wrapper .post_content h3 a:hover,
		.blog .post_content_inner_wrapper .post_meta a:hover,
		.blog .post_content_inner_wrapper .more-link:hover,
		.pagination_simple .page-numbers:hover:not(.current),
		.single_post_content .post_meta a:hover,
		.post_tags a:hover,
		#inner_post_pagination a:hover,
		#expire_single_post_pagination .prev:hover,
		#expire_single_post_pagination .next:hover,
		#expire_single_post_pagination .prev:hover a,
		#expire_single_post_pagination .next:hover a,
		.comment .reply a:hover,
		.comment .edit-link a:hover,
		.widget_calendar tbody a:hover,
		footer a:hover i{color:' . esc_attr( $links_hover ) . ';}
    	.blog .post_content_inner_wrapper .more-link:hover{border-color:' . esc_attr( $links_hover ) . ';}';
}
