<?php
/**
 * Footer
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

$footer_facebook    = get_theme_mod( 'footer_facebook', '' );
$footer_twitter     = get_theme_mod( 'footer_twitter', '' );
$footer_linkedin    = get_theme_mod( 'footer_linkedin', '' );
$footer_gplus       = get_theme_mod( 'footer_gplus', '' );
$footer_instagram   = get_theme_mod( 'footer_instagram', '' );
$footer_target      = get_theme_mod( 'footer_target', '' );
$show_social        = get_theme_mod( 'show_social', '' );
$footer_logo        = get_theme_mod( 'footer_logo', '' );
$footer_retina_logo = get_theme_mod( 'footer_retina_logo', '' );
$footer_copyright   = get_theme_mod( 'footer_copyright', '' );

$span1 = '';
$span2 = '';
$span3 = '';

if ( $show_social ) {
	if ( ! empty( $footer_logo ) && ! empty( $footer_copyright ) ) {
		$span1 = 'span5';
		$span2 = 'span2';
		$span3 = 'span5';
	} elseif ( empty( $footer_logo ) && ! empty( $footer_copyright ) ) {
		$span1 = 'span6';
		$span2 = '';
		$span3 = 'span6';
	} elseif ( ! empty( $footer_logo ) && empty( $footer_copyright ) ) {
		$span1 = 'span6';
		$span2 = 'span6';
		$span3 = '';
	} else {
		$span1 = 'span12';
		$span2 = '';
		$span3 = '';
	}
} else {
	if ( ! empty( $footer_logo ) ) {
		if ( ! empty( $footer_copyright ) ) {
			$span1 = '';
			$span2 = 'span6';
			$span3 = 'span6';
		} else {
			$span1 = '';
			$span2 = 'span12';
			$span3 = '';
		}
	} else {
		$span1 = '';
		$span2 = '';
		$span3 = 'span12';
	}
}

?>
<footer id="expire_main_footer" class="main-footer">
	<div class="container">
		<div class="row">
		<?php if ( $show_social ) : ?>
			<div class="<?php echo esc_attr( $span1 ); ?> footer_social">
			<?php
			if ( '' !== $footer_facebook ) {
				echo '<a class="footer_facebook" href="' . esc_url( $footer_facebook ) . '" target="' . esc_attr( $footer_target ) . '"><i class="ti-facebook"></i></a>';
			}
			if ( '' !== $footer_twitter ) {
				echo '<a class="footer_twitter" href="' . esc_url( $footer_twitter ) . '" target="' . esc_attr( $footer_target ) . '"><i class="ti-twitter"></i></a>';
			}
			if ( '' !== $footer_linkedin ) {
				echo '<a class="footer_linkedin" href="' . esc_url( $footer_linkedin ) . '" target="' . esc_attr( $footer_target ) . '"><i class="ti-linkedin"></i></a>';
			}
			if ( '' !== $footer_gplus ) {
				echo '<a class="footer_gplus" href="' . esc_url( $footer_gplus ) . '" target="' . esc_attr( $footer_target ) . '"><i class="ti-google"></i></a>';
			}
			if ( '' !== $footer_instagram ) {
				echo '<a class="footer_instagram" href="' . esc_url( $footer_instagram ) . '" target="' . esc_attr( $footer_target ) . '"><i class="ti-instagram"></i></a>';
			}
			?>
			</div>
		<?php endif; ?>
		<?php if ( isset( $footer_logo ) && ! empty( $footer_logo ) ) : ?>
			<div class="<?php echo esc_attr( $span2 ); ?> footer_logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php
					if ( '' !== $footer_logo ) : ?>
						<img id="footer_main_logo" src="<?php echo esc_url( wp_get_attachment_url( $footer_logo ) ); ?>" alt="<?php echo esc_attr( $name ); ?>">
						<?php if ( isset( $footer_retina_logo ) && 0 !== $footer_retina_logo ) : ?>
						<img id="footer_retina_logo" src="<?php echo esc_url( wp_get_attachment_url( $footer_retina_logo ) ); ?>" alt="<?php echo esc_attr( $name ); ?>">
						<?php endif;
					else : ?>
						<h1 id="footer_logo_textual"><?php echo esc_html( $name ); ?></h1>
						<?php if ( '' !== $description ) : ?>
							<h2 id="footer_logo_tagline"><?php echo esc_html( $description ); ?></h2>
						<?php endif;
					endif; ?>
				</a>
			</div>
		<?php endif; ?>
		<?php if ( isset( $footer_copyright ) && '' !== $footer_copyright ) : ?>
			<div class="<?php echo esc_attr( $span3 ); ?> footer_copyright">
				<?php echo esc_html( $footer_copyright ); ?>
			</div>
		<?php endif; ?>
		</div>
	</div>
</footer>
<?php
echo ( get_theme_mod( 'boxed_body', false ) ) ? '</div>' : '' ;
wp_footer(); ?>
</body>
</html>
