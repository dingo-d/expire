/**
 * Custom controls JavaScript file
 *
 * @package Expire
 * @version 1.0.1
 * @author Denis Žoljom <denis.zoljom@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT
 * @link https://madebydenis.com/expire
 *
 * @since  1.1.0 Updated license version.
 * @since  1.0.0
 */

jQuery( document ).ready(function( $) {
	"use strict";

	$( document ).on( 'change keyup', '.slider_input', expire_slider_input_change );

	expire_control_description();

	function expire_control_description() {
		$( 'li.customize-control' ).each(function() {
			var $this = $( this );
			if ( $this.find( 'p' ).html() !== '' ) {
				$this.find( 'p' ).replaceWith( '<span class="description customize-control-description">' + $this.find( 'p' ).text() + '</span>' );
			}
		});
	}

	/********* Slider Custom control ***********/

	$( '.slider-range' ).each(function(){
		var $slider = $( this );
		var saved_value = $slider.parent().find( '.slider_input' ).val();
		$slider.slider({
			range: 'min',
			value: ( saved_value > 0 ) ? saved_value : 0,
			step: 1,
			min: 0,
			max: 100,
			slide: function(event, ui) {
				var $this = $( this );
				$this.parent().find( '.slider_input' ).attr( 'value', ui.value )
					 .trigger( 'change' );
				$this.parent().find( '.slider_value' ).html( ui.value );
			}
		});
	});

	function expire_slider_input_change(){
		var $this = $( this );
		var value = $this.val();
		$this.parent().find( '.slider-range' ).slider( 'value', parseInt( value ) );
		$this.parent().find( '.slider_value' ).html( value );
	}

});
