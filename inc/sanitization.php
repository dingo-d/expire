<?php
/**
 * Sanitization functionality
 *
 * @package Expire
 * @version 1.1.2
 * @author Denis Žoljom <denis.zoljom@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT
 * @link https://madebydenis.com/expire
 *
 * @since 1.1.2
 */

if ( ! function_exists( 'expire_allowed_tags' ) ) {
	/**
	 * Allowed tags function for wp_kses()
	 *
	 * Used for sanitization.
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
