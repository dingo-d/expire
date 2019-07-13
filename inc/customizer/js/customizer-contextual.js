/**
 * Customizer contextual controls file
 *
 * @package Expire
 * @version 1.0.1
 * @author Denis Žoljom <denis.zoljom@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.txt
 * @link https://madebydenis.com/expire
 * @since  1.0.0
 */

( function( api ) {
	'use strict';

	api.bind( 'ready', function() {

		api( 'show_social', function(setting) {
			var linkSettingValueToControlActiveState;

			/**
			 * Update a control's active state according to the boxed_body setting's value.
			 *
			 * @param {api.Control} control Boxed body control.
			 */
			linkSettingValueToControlActiveState = function( control ) {
				var visibility = function() {
					if ( true === setting.get() || 1 === setting.get() ) {
						control.container.slideDown( 180 );
					} else {
						control.container.slideUp( 180 );
					}
				};

				// Set initial active state.
				visibility();
				// Update activate state whenever the setting is changed.
				setting.bind( visibility );
			};

			// Call linkSettingValueToControlActiveState on the border controls when they exist.
			api.control( 'footer_facebook', linkSettingValueToControlActiveState );
			api.control( 'footer_twitter', linkSettingValueToControlActiveState );
			api.control( 'footer_linkedin', linkSettingValueToControlActiveState );
			api.control( 'footer_gplus', linkSettingValueToControlActiveState );
			api.control( 'footer_instagram', linkSettingValueToControlActiveState );
			api.control( 'footer_target', linkSettingValueToControlActiveState );
		});

	});

}( wp.customize ) );
