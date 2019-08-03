<?php
/**
 * Title bar
 *
 * @package Expire
 * @version 1.1.2
 * @author Denis Žoljom <denis.zoljom@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT
 * @link https://madebydenis.com/expire
 *
 * @since  1.1.0
 */

if ( ! get_theme_mod( 'show_title_bar', true ) ) {
	return;
}

if ( is_page() ) {
	// Doesn't work when blog page is set in the reading options for some odd reason.
	$hide_toolbar = get_post_meta( get_the_ID(), 'expire_toggle_titlebar', true );

	if ( $hide_toolbar === '1' ) {
		return;
	}
}

$description = get_bloginfo( 'description' );
?>

<section id="expire_title_bar">
	<div class="container">
		<div class="row">
			<div class="span12 left_aligned">
				<?php if ( is_404() ) : ?>
					<h2><?php esc_html_e( 'Page not found', 'expire' ); ?></h2>
				<?php elseif ( is_singular() ) : ?>
					<h2><?php echo esc_html( get_the_title() ); ?></h2>
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
