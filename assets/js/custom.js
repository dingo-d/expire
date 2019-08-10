/**
 * Main theme JavaScript file
 *
 * Contains all functions necessary for a theme to work.
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

jQuery( document ).ready(function( $) {
	'use strict';

	/**
	 * Variables
	 */
	var $menu_responsive = $( '#expire_main_header nav' ),
		offset;

	/**
	 * Helper debounce function
	 */
	function expire_debounce( func, wait, immediate ) {
		var timeout;
		return function() {
			var context = this,
			args = arguments;
			var later = function() {
				timeout = null;
				if ( !immediate ) func.apply( context, args );
			};
			var callNow = immediate && !timeout;
			clearTimeout( timeout );
			timeout = setTimeout( later, wait );
			if ( callNow ) func.apply( context, args );
		};
	};

	function expire_get_scroll_bar_width() {
		var $outer = $( '<div>' ).css( {visibility: 'hidden', width: 100, overflow: 'scroll'} ).appendTo( 'body' ),
			widthWithScroll = $( '<div>' ).css( {width: '100%'} ).appendTo( $outer ).outerWidth();
		$outer.remove();
		return 100 - widthWithScroll;
	}

	/**
	 * Functions and callbacks
	 */
	expire_scroll_to_section_on_another_page();

	$( document ).on( 'click', '.js-scroll-up', expire_back_to_top )
				 .on( 'click', '.js-menu-toggle', expire_menu_responsive )
				 .on( 'click', '.js-scroll', expire_scroll_to_section );

	var expire_toggle_mobile_menu_on_resize = expire_debounce( function() {
		if ( $( this ).width() > ( 768 - expire_get_scroll_bar_width() ) && $menu_responsive.css( 'display', 'none' ) ) {
			$menu_responsive[0].removeAttribute( 'style' );
			$( '.js-menu-toggle' ).removeClass( 'active' );
		}
	}, 250 );

	var expire_toggle_scroll_to_top = expire_debounce(function() {
		var distance = document.documentElement.scrollTop || document.body.scrollTop;

		if ( distance > 200 ) {
			$('.js-scroll-up').removeClass('hide');
		} else {
			$('.js-scroll-up').addClass('hide');
		}
	}, 250);

	expire_toggle_scroll_to_top();

	$( window ).on( 'resize', expire_toggle_mobile_menu_on_resize )
			   .on( 'scroll', expire_toggle_scroll_to_top );

	function expire_back_to_top(e) {
		e.preventDefault();
		$( 'html, body' ).animate( { scrollTop: 0 }, 500 );
		return false;
	}

	function expire_menu_responsive() {
		$menu_responsive.animate( {
			width:'toggle'
		}, 350 );

		$( this ).toggleClass( 'active' );
		var expanded = $( this ).attr( 'aria-expanded') === 'true' || false;
		$( this ).attr( 'aria-expanded', !expanded );

		$( '.js-menu' ).toggleClass( 'active' );
	}

	function expire_scroll_to_section(e) {
		e.preventDefault();
		var href = $( this ).attr( 'href' );
		var hash = href.split( '#' );
		var url_hash = '#' + hash[1];
		if ( '' != url_hash && '#' != url_hash ) {
			if ( $( url_hash ).length > 0) {
				offset = ( $( window ).width() < 768) ? 20 : 90;
				$( 'html, body' ).animate({
					scrollTop: $( url_hash ).offset().top -offset
				}, 1000);
			} else {
				location.href = href;
			}
		}

		if ( $( window ).width() < 768 ) {
			$menu_responsive.animate( {width:'toggle'} );
		}
	}

	function expire_scroll_to_section_on_another_page() {
		if (window.location.hash) {
			var hash = window.location.hash;
			var $scrollto = $( hash );
			if ( $scrollto.length > 0) {
				$( 'html, body' ).animate({
					scrollTop: $scrollto.offset().top - 90
				}, 1000);
			}
		}
	}

});
