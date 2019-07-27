<?php
/**
 * Customizer custom controls
 *
 * @package Expire
 * @version 1.1.0
 * @author Denis Žoljom <denis.zoljom@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT
 * @link https://madebydenis.com/expire
 *
 * @since  1.1.0 Updated license version.
 * @since  1.0.0
 */

if ( class_exists( 'WP_Customize_Control' ) ) {
	/**
	 * Info custom control
	 *
	 * @package WordPress
	 * @package Expire
	 * @version 1.1.0
	 * @author Denis Žoljom <denis.zoljom@gmail.com>
	 * @license https://opensource.org/licenses/MIT MIT
	 * @link https://madebydenis.com/expire
	 *
	 * @since  1.1.0 Updated license version.
	 * @since  1.0.0
	 */
	class Expire_Info_Custom_Control extends WP_Customize_Control {
		/**
		 * Control type
		 *
		 * @var string
		 */
		public $type = 'info';
		/**
		 * Control method
		 *
		 * @since 1.0.0
		 */
		public function render_content() {
			?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<p><?php echo esc_html( $this->description ); ?></p>
			<?php
		}
	}

	/**
	 * Separator custom control
	 *
	 * @package WordPress
	 * @package Expire
	 * @version 1.1.0
	 * @author Denis Žoljom <denis.zoljom@gmail.com>
	 * @license https://opensource.org/licenses/MIT MIT
	 * @link https://madebydenis.com/expire
	 *
	 * @since  1.1.0 Updated license version.
	 * @since  1.0.0
	 */
	class Expire_Separator_Custom_Control extends WP_Customize_Control {
		/**
		 * Control type
		 *
		 * @var string
		 */
		public $type = 'separator';
		/**
		 * Control method
		 *
		 * @since 1.0.0
		 */
		public function render_content() {
			?>
			<p><hr></p>
			<?php
		}
	}

	/**
	 * Checkbox toggle custom control
	 *
	 * @package WordPress
	 * @package Expire
	 * @version 1.1.0
	 * @author Denis Žoljom <denis.zoljom@gmail.com>
	 * @license https://opensource.org/licenses/MIT MIT
	 * @link https://madebydenis.com/expire
	 *
	 * @since  1.1.0 Updated license version.
	 * @since  1.0.0
	 */
	class Expire_Toggle_Checkbox_Custom_Control extends WP_Customize_Control {
		/**
		 * Control type
		 *
		 * @var string
		 */
		public $type = 'toogle_checkbox';
		/**
		 * Control scripts and styles enqueue
		 *
		 * @since 1.0.0
		 */
		public function enqueue() {
			wp_enqueue_script( 'expire-custom-controls', EXPIRE_TEMPPATH . '/inc/customizer/js/custom-controls.js', array( 'jquery' ), EXPIRE_THEME_VERSION, true );
			wp_enqueue_style( 'expire-custom-controls-css', EXPIRE_TEMPPATH . '/inc/customizer/css/custom-controls.css' );
		}
		/**
		 * Control method
		 *
		 * @since 1.0.0
		 */
		public function render_content() {
			?>
			<div class="checkbox_switch">
				<div class="onoffswitch">
						<input type="checkbox" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" class="onoffswitch-checkbox" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> <?php $this->link() . checked( $this->value() ); ?>>
						<label class="onoffswitch-label" for="<?php echo esc_attr( $this->id ); ?>"></label>
				</div>
				<span class="customize-control-title onoffswitch_label"><?php echo esc_html( $this->label ); ?></span>
				<p><?php echo esc_html( $this->description ); ?></p>
			</div>
			<?php
		}
	}

	/**
	 * Slider custom control
	 *
	 * @package WordPress
	 * @package Expire
	 * @version 1.1.0
	 * @author Denis Žoljom <denis.zoljom@gmail.com>
	 * @license https://opensource.org/licenses/MIT MIT
	 * @link https://madebydenis.com/expire
	 *
	 * @since  1.1.0 Updated license version.
	 * @since  1.0.0
	 */
	class Expire_Slider_Control extends WP_Customize_Control {
		/**
		 * Control type
		 *
		 * @var string
		 */
		public $type = 'slider_control';
		/**
		 * Control scripts and styles enqueue
		 *
		 * @since 1.0.0
		 */
		public function enqueue() {
			wp_enqueue_script( 'expire-custom-controls', EXPIRE_TEMPPATH . '/inc/customizer/js/custom-controls.js', array( 'jquery', 'jquery-ui-slider' ), EXPIRE_THEME_VERSION, true );
			wp_enqueue_style( 'expire-custom-controls-css', EXPIRE_TEMPPATH . '/inc/customizer/css/custom-controls.css' );
		}
		/**
		 * Control method
		 *
		 * @since 1.0.0
		 */
		public function render_content() {
		?>
			<div class="slider_control">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?><span class="slider_value"><?php echo esc_attr( $this->value() ); ?></span></span>
				<p><?php echo esc_html( $this->description ); ?></p>
				<input class="slider_input" type="hidden" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?>  />
				<div class="slider-range"></div>
			</div>
		<?php
		}
	}

}
