/**
 * Customizer preview JavaScript file
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

(function($, api) {
	'use strict';

	function expire_dynamic_css_targets( value ) {
		var css_styles_targets = '<style id="customizer_dynamic_css_' + value + '" type="text/css"></style>';

		if ( ! $( '#customizer_dynamic_css_' + value ).length) {
			$( '#expire-main-css-inline-css' ).after( css_styles_targets );
		}
	}

	/********* Dynamcic Colors ***********/

	// Header text color.
	api( 'header_textcolor', function(value) {
		value.bind(function(newval) {
			expire_dynamic_css_targets( 'header_textcolor' );
			var new_colors = '#expire_title_bar h2{ color:' + newval + ';}';
			$( '#customizer_dynamic_css_header_textcolor' ).text( new_colors );
		});
	});

	// Background color.
	api( 'background_color', function(value) {
		value.bind(function(newval) {
			expire_dynamic_css_targets( 'background_color' );
			var new_colors = '.blog .post_content_inner_wrapper .post_info{ background:' + newval + ';} #expire_breadcrumbs_section{ border-color: ' + newval + ';} #expire_breadcrumbs_section:before{ background:' + newval + ';} #expire_breadcrumbs_section:after{ border-bottom-color: ' + newval + ';}';
			$( '#customizer_dynamic_css_background_color' ).text( new_colors );
		});
	});

	// Main element color.
	api( 'main_color', function(value) {
		value.bind(function(newval) {
			expire_dynamic_css_targets( 'main_color' );
			var new_colors = '::selection{ background:' + newval + ';} ::-moz-selection{ background:' + newval + ';} a{color:' + newval + ';} .single_post_content .inner_post_content .post_info .post_type, .blog .post_content_inner_wrapper .post_info .post_type{ background:' + newval + ';} .placeholder{ color:' + newval + ';} #page404 .big_404{ color:' + newval + ';} .blog .post_content_inner_wrapper .more-link{ color:' + newval + '; border-color:' + newval + ';} .single_post_content #expire_single_post_pagination .prev:hover, #expire_single_post_pagination .next:hover{ border-color:' + newval + ';} nav > ul > li > a:hover:after{ background:' + newval + ';} nav > ul > li > a:hover:after, nav > ul > li.current_page_item > a:after, nav > ul > li.current_page_parent > a:after{ background:' + newval + ';} nav > ul ul li:hover > a{ color:' + newval + ';}';
			$( '#customizer_dynamic_css_main_color' ).text( new_colors );
		});
	});

	// Heading color.
	api( 'secondary_color', function(value) {
		value.bind(function(newval) {
			expire_dynamic_css_targets( 'secondary_color' );
			var new_colors = 'select{background-image: linear-gradient(45deg, transparent 50%, ' + newval + ' 50%), linear-gradient(135deg, ' + newval + ' 50%, transparent 50%), linear-gradient(to right, ' + newval + ', ' + newval + ');} button,input,select,textarea, nav > ul ul, nav > ul ul ul, .blog .post_wrapper .post_content h3, .blog .post_content_inner_wrapper, .blog .post_content_inner_wrapper .post_info, .pagination_simple .page-numbers, .single_post_content .main_title, .single_post_content .inner_post_content .post_info, .single_post_content .post_content, .post_tags, #expire_single_post_pagination .prev, #expire_single_post_pagination .next, #comments-title, .widget_tag_cloud .tagcloud a{ border-color:' + newval + ';} .blog .sticky .post_content_inner_wrapper, .post_featured_image:before{ background:' + newval + ';}';
			$( '#customizer_dynamic_css_secondary_color' ).text( new_colors );
		});
	});

	// Body text color.
	api( 'body_text_color', function(value) {
		value.bind(function(newval) {
			expire_dynamic_css_targets( 'body_text_color' );
			var new_colors = 'body{color:' + newval + ';} h1, h2, h3, h4, h5, h6{color:' + newval + ';} .post_date{color:' + newval + ';} .post_meta i, .post_tags i{ color:' + newval + ';} .post_meta i{ color: ' + newval + ';}';
			$( '#customizer_dynamic_css_body_text_color' ).text( new_colors );
		});
	});

	// Header background color.
	api( 'header_background_color', function(value) {
		value.bind(function(newval) {
			expire_dynamic_css_targets( 'header_background_color' );
			var new_colors = '.expire_main_header{background-color:' + newval + ';}';
			$( '#customizer_dynamic_css_header_background_color' ).text( new_colors );
		});
	});

	// Menu text color.
	api( 'menu_text_color', function(value) {
		value.bind(function(newval) {
			expire_dynamic_css_targets( 'menu_text_color' );
			var new_colors = '.has_header_image nav > ul > li > a{color:' + newval + ';}';
			$( '#customizer_dynamic_css_menu_text_color' ).text( new_colors );
		});
	});

	// Links Color.
	api( 'links_hover', function(value) {
		value.bind(function(newval) {
			expire_dynamic_css_targets( 'links_hover' );
			var new_colors = 'a:hover, input[type="submit"]:hover, .search .submit:hover i, nav > ul > li a:hover, nav > ul > li > a:hover:after, nav > ul li:hover > ul, nav > ul ul li a:hover, .blog .post_wrapper .post_content h3 a:hover, .blog .post_content_inner_wrapper .post_meta a:hover, .blog .post_content_inner_wrapper .more-link:hover, .pagination_simple .page-numbers:hover:not(.current), .single_post_content .post_meta a:hover, .post_tags a:hover, #inner_post_pagination a:hover, #expire_single_post_pagination .prev:hover, #expire_single_post_pagination .next:hover, #expire_single_post_pagination .prev:hover a, #expire_single_post_pagination .next:hover a, .comment .reply a:hover, .comment .edit-link a:hover, .widget_calendar tbody a:hover, footer a:hover i{color:' + newval + ';} .blog .post_content_inner_wrapper .more-link:hover{border-color:' + newval + ';}';
			$( '#customizer_dynamic_css_links_hover' ).text( new_colors );
		});
	});

	// Grid Width.
	api( 'grid_width', function(value) {
		value.bind(function(newval) {
			expire_dynamic_css_targets( 'grid_width' );
			var width;
			switch ( newval ) {
				case '1200':
					width = '.container{width: ' + newval + 'px;}';
					$( '#customizer_dynamic_css_grid_width' ).text( width );
					break;
				case '1170':
					width = '.container{width: ' + newval + 'px;}';
					$( '#customizer_dynamic_css_grid_width' ).text( width );
					break;
				case '1140':
					width = '.container{width: ' + newval + 'px;}';
					$( '#customizer_dynamic_css_grid_width' ).text( width );
					break;
				case '1080':
					width = '.container{width: ' + newval + 'px;}';
					$( '#customizer_dynamic_css_grid_width' ).text( width );
					break;
				case '1040':
					width = '.container{width: ' + newval + 'px;}';
					$( '#customizer_dynamic_css_grid_width' ).text( width );
					break;
				case '980':
					width = '.container{width: ' + newval + 'px;}';
					$( '#customizer_dynamic_css_grid_width' ).text( width );
					break;
				case '960':
					width = '.container{width: ' + newval + 'px;}';
					$( '#customizer_dynamic_css_grid_width' ).text( width );
					break;
				default:
					$( '#customizer_dynamic_css_grid_width' ).text( '.container{width: 1170px;}' );
			}
		});
	});

	api('blogname', function(value){
		value.bind(function(newval){
			$( '#main_logo_textual' ).html( newval );
		});
	});

	api('blogdescription', function(value){
		value.bind(function(newval){
			$( '#main_tagline' ).html( newval );
		});
	});

	api('header_logo', function(value){
		value.bind(function(newval){
			console.log( newval );
		});
	});

	api('footer_facebook', function(value){
		value.bind(function(newval){
			if ( $( '.footer_facebook' ).length ) {
				if (newval !== '') {
					if ( $( '.footer_facebook' ).hasClass( 'hide' ) ) {
						$( '.footer_facebook' ).removeClass( 'hide' ).attr( 'href', newval );
					}
				} else {
					$( '.footer_facebook' ).addClass( 'hide' );
				}
			} else {
				$( '.footer_social' ).prepend( '<a class="footer_facebook" href="' + newval + '" target="' + api._value.footer_target() + '"><i class="ti-facebook"></i></a>' );

			}
		});
	});

	api('footer_twitter', function(value){
		value.bind(function(newval){
			if ( $( '.footer_twitter' ).length ) {
				if (newval !== '') {
					if ( $( '.footer_twitter' ).hasClass( 'hide' ) ) {
						$( '.footer_twitter' ).removeClass( 'hide' ).attr( 'href', newval );
					}
				} else {
					$( '.footer_twitter' ).addClass( 'hide' );
				}
			} else {
				if ( $( '.footer_facebook' ).length ) {
					$( '.footer_facebook' ).after( '<a class="footer_twitter" href="' + newval + '" target="' + api._value.footer_target() + '"><i class="ti-twitter"></i></a>' );
				} else {
					$( '.footer_social' ).prepend( '<a class="footer_twitter" href="' + newval + '" target="' + api._value.footer_target() + '"><i class="ti-twitter"></i></a>' );
				}
			}
		});
	});

	api('footer_linkedin', function(value){
		value.bind(function(newval){
			if ( $( '.footer_linkedin' ).length ) {
				if (newval !== '') {
					if ( $( '.footer_linkedin' ).hasClass( 'hide' ) ) {
						$( '.footer_linkedin' ).removeClass( 'hide' ).attr( 'href', newval );
					}
				} else {
					$( '.footer_linkedin' ).addClass( 'hide' );
				}
			} else {
				if ( $( '.footer_twitter' ).length ) {
					$( '.footer_twitter' ).after( '<a class="footer_linkedin" href="' + newval + '" target="' + api._value.footer_target() + '"><i class="ti-linkedin"></i></a>' );
				} else if ( $( '.footer_facebook' ).length ) {
					$( '.footer_facebook' ).after( '<a class="footer_linkedin" href="' + newval + '" target="' + api._value.footer_target() + '"><i class="ti-linkedin"></i></a>' );
				} else {
					$( '.footer_social' ).prepend( '<a class="footer_linkedin" href="' + newval + '" target="' + api._value.footer_target() + '"><i class="ti-linkedin"></i></a>' );
				}
			}
		});
	});

	api('footer_gplus', function(value){
		value.bind(function(newval){
			if ( $( '.footer_gplus' ).length ) {
				if (newval !== '') {
					if ( $( '.footer_gplus' ).hasClass( 'hide' ) ) {
						$( '.footer_gplus' ).removeClass( 'hide' ).attr( 'href', newval );
					}
				} else {
					$( '.footer_gplus' ).addClass( 'hide' );
				}
			} else {
				if ( $( '.footer_linkedin' ).length ) {
					$( '.footer_linkedin' ).after( '<a class="footer_gplus" href="' + newval + '" target="' + api._value.footer_target() + '"><i class="ti-google"></i></a>' );
				} else if ( $( '.footer_twitter' ).length ) {
					$( '.footer_twitter' ).after( '<a class="footer_gplus" href="' + newval + '" target="' + api._value.footer_target() + '"><i class="ti-google"></i></a>' );
				} else if ( $( '.footer_facebook' ).length ) {
					$( '.footer_facebook' ).after( '<a class="footer_gplus" href="' + newval + '" target="' + api._value.footer_target() + '"><i class="ti-google"></i></a>' );
				} else {
					$( '.footer_social' ).prepend( '<a class="footer_gplus" href="' + newval + '" target="' + api._value.footer_target() + '"><i class="ti-google"></i></a>' );
				}
			}
		});
	});

	api('footer_instagram', function(value){
		value.bind(function(newval){
			if ( $( '.footer_instagram' ).length ) {
				if (newval !== '') {
					if ( $( '.footer_instagram' ).hasClass( 'hide' ) ) {
						$( '.footer_instagram' ).removeClass( 'hide' ).attr( 'href', newval );
					}
				} else {
					$( '.footer_instagram' ).addClass( 'hide' );
				}
			} else {
				if ( $( '.footer_gplus' ).length ) {
					$( '.footer_gplus' ).after( '<a class="footer_instagram" href="' + newval + '" target="' + api._value.footer_target() + '"><i class="ti-instagram"></i></a>' );
				} else if ( $( '.footer_linkedin' ).length ) {
					$( '.footer_linkedin' ).after( '<a class="footer_instagram" href="' + newval + '" target="' + api._value.footer_target() + '"><i class="ti-instagram"></i></a>' );
				} else if ( $( '.footer_twitter' ).length ) {
					$( '.footer_twitter' ).after( '<a class="footer_instagram" href="' + newval + '" target="' + api._value.footer_target() + '"><i class="ti-instagram"></i></a>' );
				} else if ( $( '.footer_facebook' ).length ) {
					$( '.footer_facebook' ).after( '<a class="footer_instagram" href="' + newval + '" target="' + api._value.footer_target() + '"><i class="ti-instagram"></i></a>' );
				} else {
					$( '.footer_social' ).prepend( '<a class="footer_instagram" href="' + newval + '" target="' + api._value.footer_target() + '"><i class="ti-instagram"></i></a>' );
				}
			}
		});
	});

	api('footer_copyright', function(value){
		value.bind(function(newval){
			if ( $( '.footer_copyright' ).length ) {
				if (newval !== '') {
					if ( $( '.footer_copyright' ).hasClass( 'hide' ) ) {
						$( '.footer_copyright' ).removeClass( 'hide' ).html( newval );
					} else {
						$( '.footer_copyright' ).html( newval );
					}
				} else {
					$( '.footer_copyright' ).addClass( 'hide' );
				}
			} else {
				$( '#expire_main_footer .row' ).append( '<div class="span5 footer_copyright">' + newval + '</div>' );

			}
		});
	});

})(jQuery, wp.customize);
