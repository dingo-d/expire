<?php
/**
 * Header
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

<?php
echo ( get_theme_mod( 'boxed_body', false ) ) ? '<div class="boxed_body_wrapper">' : '';
$name               = get_bloginfo( 'name' );
$description        = get_bloginfo( 'description' );
$header_retina_logo = get_theme_mod( 'header_retina_logo' );
$header_class       = has_header_image() ? 'class="has_header_image"' : '';
$custom_logo_id     = get_theme_mod( 'custom_logo' );
$logo               = wp_get_attachment_image_src( $custom_logo_id , 'full' );
?>
	<header id="expire_main_header" <?php echo wp_kses_post( $header_class ); ?>>
		<a class="skip-link" href="#main-content" tabindex="0"><?php esc_html_e( 'Skip to the main content', 'expire' ); ?></a>
		<div class="container">
			<div id="logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php
					if ( isset( $custom_logo_id ) && ! empty( $custom_logo_id ) ) : ?>
						<img id="main_logo" src="<?php echo esc_url( $logo[0] ); ?>" alt="<?php echo esc_attr( $name ); ?>">
						<?php if ( isset( $header_retina_logo ) && 0 !== $header_retina_logo ) : ?>
							<img id="retina_logo" src="<?php echo esc_url( wp_get_attachment_url( $header_retina_logo ) ); ?>" alt="<?php echo esc_attr( $name ); ?>">
						<?php endif;
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
	<?php if ( get_theme_mod( 'show_title_bar', true ) ) : ?>
	<section id="expire_title_bar">
		<div class="container">
			<div class="row">
				<div class="span12 left_aligned">
					<?php if ( is_404() ) : ?>
						<h2><?php esc_html_e( 'Page not found', 'expire' ); ?></h2>
					<?php elseif ( is_search() ) : ?>
						<h2><?php esc_html_e( 'Search results', 'expire' ); ?></h2>
					<?php elseif ( is_day() ) : ?>
						<h2><?php echo esc_html( get_the_time( 'd' ) . ', ' . get_the_time( 'F' ) . ', ' . get_the_time( 'Y' ) ); ?></h2>
					<?php elseif ( is_month() ) : ?>
						<h2><?php echo esc_html( get_the_time( 'F' ) . ', ' . get_the_time( 'Y' ) ); ?></h2>
					<?php elseif ( is_year() ) : ?>
						<h2><?php echo esc_html( get_the_time( 'Y' ) ); ?></h2>
					<?php elseif ( is_category() ) : ?>
						<?php
							$category    = get_category( get_query_var( 'cat' ) );
							$category_id = $category->cat_ID;
						?>
						<h2><?php echo esc_html( get_cat_name( $category_id ) ); ?></h2>
					<?php elseif ( ( is_home() || is_front_page() ) && display_header_text() ) : ?>
						<h2 id="main_tagline"><?php echo esc_html( $description ); ?></h2>
					<?php else : ?>
						<h2><?php the_archive_title(); ?></h2>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div id="expire_breadcrumbs_section">
			<div class="container">
				<div class="row">
					<?php expire_simple_breadcrumb(); ?>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>
