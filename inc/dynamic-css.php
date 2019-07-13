<?php
/**
 * Dynamic css based on options in the Theme Customize API and Theme Options
 *
 * @package Expire
 * @version 1.0.9
 * @author expirewp <https://madebydenis.com/expire>
 * @license http://www.gnu.org/licenses/gpl-2.0.txt
 * @link https://madebydenis.com/expire
 * @since 1.0.0
 */

/********* Grid Width ***********/
$grid_width = get_theme_mod( 'grid_width', '1170' );
if ( isset( $grid_width ) && '' !== $grid_width ) {
	$custom_css .= '
	.container{width:' . intval( esc_attr( $grid_width ) ) . 'px;}
	';
}

/********* Custom Header ***********/
if ( has_header_image() ) {
	$custom_css .= '#expire_title_bar{background:url(' . get_header_image() . '); min-height:' . esc_attr( get_custom_header()->height ) . '; background-size:cover; background-position:center center;}';
}

/********* Custom Header Color ***********/
$custom_css .= '#expire_title_bar h2{ color: #' . get_header_textcolor() . '}';

/********* Background Color ***********/
$background_color = get_theme_mod( 'background_color' );

$custom_css .= '.blog .post_content_inner_wrapper .post_info{ background: ' . esc_attr( $background_color ) . '}
	#expire_breadcrumbs_section{ border-color: ' . esc_attr( $background_color ) . ';} #expire_breadcrumbs_section:before{ background:' . esc_attr( $background_color ) . ';}
	#expire_breadcrumbs_section:after{ border-bottom-color: ' . esc_attr( $background_color ) . ';}';

/********* Main Color ***********/
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

/********* Secondary Color ***********/
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

/********* Body Background & Text Color ***********/
$body_text_color = get_theme_mod( 'body_text_color' );
if ( '' !== $body_text_color ) {
	$custom_css .= 'body{color:' . esc_attr( $body_text_color ) . ';}
	h1, h2, h3, h4, h5, h6{color:' . esc_attr( $body_text_color ) . ';}
	.post_date{color:' . esc_attr( $body_text_color ) . ';}
	.post_meta i,
	.post_tags i{ color:' . esc_attr( $body_text_color ) . ';}
	.single_post_content .post_meta i{ color:' . esc_attr( $main_color ) . ';}';
}

/********* Links Hover Color ***********/
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

/********* Header Logo ***********/
$header_retina_logo        = get_theme_mod( 'header_retina_logo' );

if ( '' !== $header_retina_logo ) {
	$header_logo               = get_theme_mod( 'custom_logo' );
	$retina_logo_size          = wp_get_attachment_image_src( $header_logo );
	$header_retina_logo_width  = intval( $retina_logo_size[1] );
	$header_retina_logo_height = intval( $retina_logo_size[2] );

	$custom_css .= '
		#main_logo {display: block ;}
		#retina_logo {display: none; width: ' . $header_retina_logo_width . 'px; max-height: ' . $header_retina_logo_height . 'px; height: auto;}
		@media only screen and (-webkit-min-device-pixel-ratio: 1.3),
		only screen and (-o-min-device-pixel-ratio: 13/10 ),
		only screen and (min-resolution: 120dpi) {
			#main_logo {display: none ;}
			#retina_logo {display: block ;}
		}';
}

/********* Footer Logo ***********/
$footer_retina_logo        = get_theme_mod( 'footer_retina_logo', '' );

if ( '' !== $footer_retina_logo ) {
	$footer_logo               = get_theme_mod( 'footer_logo', '' );
	$footer_retina_logo_size   = wp_get_attachment_image_src( $footer_logo );
	$footer_retina_logo_width  = intval( $footer_retina_logo_size[1] );
	$footer_retina_logo_height = intval( $footer_retina_logo_size[2] );

	$custom_css .= '
		#footer_main_logo {display: block ;}
		#footer_retina_logo {display: none; width: ' . $footer_retina_logo_width . 'px; max-height: ' . $footer_retina_logo_height . 'px; height: auto;}
		@media only screen and (-webkit-min-device-pixel-ratio: 1.3),
		only screen and (-o-min-device-pixel-ratio: 13/10 ),
		only screen and (min-resolution: 120dpi) {
			#footer_main_logo {display: none ;}
			#footer_retina_logo {display: block ;}
		}';
}
