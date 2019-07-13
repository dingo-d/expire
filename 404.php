<?php
/**
 * 404 page
 *
 * @package Expire
 * @version 1.0.9
 * @author Denis Žoljom <denis.zoljom@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.txt
 * @link https://github.com/infinum/wp-boilerplate
 * @since  1.0.0
 */

/*
Template Name: 404 page
*/

$alternative_404_page = get_theme_mod( 'alternative_404_page', false );
if ( $alternative_404_page && is_404() ) {
	wp_safe_redirect( get_permalink( $alternative_404_page ) );
	exit;
}
get_header();
?>
	<section class="container page_main_section" id="page404">
		<p class="big_404"><?php esc_html_e( '404', 'expire' ) ?></p>
		<h3><?php esc_html_e( 'Oops, the page you are looking for can not be found', 'expire' ) ?></h3>
		<p><?php printf( wp_kses_post( __( 'You can go back to <a href="%s">home page</a>, or search for something you were looking.', 'expire' ) ), esc_url( home_url() ) ); ?></p>
		<div class="search_404"><?php get_search_form(); ?></div>
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				the_content();
			endwhile;
		endif; ?>
	</section>
<?php get_footer();
