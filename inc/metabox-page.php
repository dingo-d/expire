<?php
/**
 * Page metabox file
 *
 * Contains the option to toggle title bar on a single page.
 *
 * @package Expire
 * @version 1.1.2
 * @author Denis Žoljom <denis.zoljom@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT
 * @link https://madebydenis.com/expire
 *
 * @since  1.1.0
 */

add_action( 'add_meta_boxes', 'expire_register_meta_boxes' );

if ( ! function_exists( 'expire_register_meta_boxes' ) ) {
	/**
	 * Register meta box(es).
	 */
	function expire_register_meta_boxes() {
		add_meta_box(
			'expire-toggle-title-bar',
			esc_html__( 'Toggle title bar', 'expire' ),
			'expire_page_title_bar_checkbox_cb',
			'page',
			'side',
			'low'
		);
	}
}


if ( ! function_exists( 'expire_page_title_bar_checkbox_cb' ) ) {
	/**
	 * Meta box display callback.
	 *
	 * @param WP_Post $post Current post object.
	 */
	function expire_page_title_bar_checkbox_cb( $post ) {
		$meta = get_post_meta( $post->ID );
		$expire_toggle_titlebar = ( isset( $meta['expire_toggle_titlebar'][0] ) &&  '1' === $meta['expire_toggle_titlebar'][0] ) ? 1 : 0;
		wp_nonce_field( 'expire_control_meta_box', 'expire_control_meta_box_nonce' ); // Always add nonce to your meta boxes!
		?>
		<style type="text/css">
			.post_meta_extras p{ margin: 20px; }
			.post_meta_extras label{ display:block; margin-bottom: 10px; }
		</style>
		<div class="post_meta_extras">
			<p>
				<label><input type="checkbox" name="expire_toggle_titlebar" value="1" <?php checked( $expire_toggle_titlebar, 1 ); ?> /><?php esc_attr_e( 'Hide title bar', 'expire' ); ?></label>
			</p>
		<?php
	}
}

add_action( 'save_post', 'expire_save_meta_box' );

if ( ! function_exists( 'expire_save_meta_box' ) ) {
	/**
	 * Save meta box content.
	 *
	 * @param int $post_id Post ID.
	 */
	function expire_save_meta_box( $post_id ) {
		/*
		 * We need to verify this came from the our screen and with proper authorization,
		 * because save_post can be triggered at other times. Add as many nonces, as you
		 * have metaboxes.
		 */
		if ( ! isset( $_POST['expire_control_meta_box_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['expire_control_meta_box_nonce'] ), 'expire_control_meta_box' ) ) {
			return $post_id;
		}

		// Check the user's permissions.
		if ( isset( $_POST['post_type'] ) && 'page' === $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return $post_id;
			}
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return $post_id;
			}
		}

		/*
		 * If this is an autosave, our form has not been submitted,
		 * so we don't want to do anything.
		 */
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		/* Ok to save */
		$expire_toggle_titlebar = ( isset( $_POST['expire_toggle_titlebar'] ) && '1' === $_POST['expire_toggle_titlebar'] ) ? '1' : '0';
		update_post_meta( $post_id, 'expire_toggle_titlebar', esc_attr( $expire_toggle_titlebar ) );

	}
}
