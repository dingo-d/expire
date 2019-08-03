<?php
/**
 * Header
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

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( 'open' === get_option( 'default_ping_status' ) && is_singular() && pings_open() ) :
	printf( '<link rel="pingback" href="%s" />' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
endif;
wp_head();
?>

</head>
<body <?php body_class(); ?>>
<?php wp_body_open();

echo ( get_theme_mod( 'boxed_body', false ) ) ? '<div class="boxed_body_wrapper">' : '';
$name = get_bloginfo( 'name' );

if ( is_page() ) {
	// Doesn't work when blog page is set in the reading options for some odd reason.
	$hide_toolbar = get_post_meta( get_the_ID(), 'expire_toggle_titlebar', true );

	if ( $hide_toolbar === '1' ) {
		$header_class = 'class="expire_main_header"';
	}
} else {
	$header_class = has_header_image() ? 'class="expire_main_header has_header_image"' : 'class="expire_main_header"';
}

$custom_logo_id = get_theme_mod( 'custom_logo' );
$logo           = wp_get_attachment_image_src( $custom_logo_id , 'full' );
?>
	<header id="expire_main_header" <?php echo wp_kses_post( $header_class ); ?>>
		<a class="skip-link" href="#main-content" tabindex="0"><?php esc_html_e( 'Skip to the main content', 'expire' ); ?></a>
		<div class="container">
			<div id="logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php
					if ( isset( $custom_logo_id ) && ! empty( $custom_logo_id ) ) : ?>
						<img id="main_logo" src="<?php echo esc_url( $logo[0] ); ?>" alt="<?php echo esc_attr( $name ); ?>">
					<?php
					else :
						if ( display_header_text() ) : ?>
							<h1 id="main_logo_textual"><?php echo esc_html( $name ); ?></h1>
						<?php endif;
					endif; ?>
				</a>
			</div>
			<nav>
				<?php wp_nav_menu( array( 'theme_location' => 'header_menu', 'container' => 'ul', 'menu_id' => 'main_menu', 'menu_class' => '' ) ); ?>
			</nav>
			<div id="expire_menu_toggle"><div class="expire_hamburger_menu"><span></span></div></div>
		</div>
	</header>
	<?php get_template_part( 'template-parts/header/title', 'bar' ); ?>

