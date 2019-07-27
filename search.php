<?php
/**
 * Search
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

get_header(); ?>

<section id="main-content" class="page_main_section">
	<div class="container">
		<h2><?php esc_html_e( 'Showing Results for: ', 'expire' ); ?> <?php the_search_query(); ?> (<?php echo esc_html( $wp_query->found_posts ); ?>)</h2>
		<div class="row">
			<div class="span9 content_with_right_sidebar">
				<?php if ( have_posts() ) :
					$i = ( ( ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1 ) - 1 ) * get_option( 'posts_per_page' );
					while ( have_posts() ) : the_post();
						$i++;
				?>
				<div class="search_results_item">
					<span class="search_result_number"><?php echo esc_html( $i ); ?>.</span>
					<a class="post_date" href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a>
					<div class="excerpt">
						<h3><a href="<?php the_permalink(); ?>"><?php echo esc_html( get_the_title() ); ?></a></h3>
						<?php the_excerpt(); ?>
					</div>
				</div>
				<?php endwhile; ?>
				<?php else : ?>
				<?php esc_html_e( 'Sorry, your search query yielded no results.', 'expire' ); ?>
				<?php endif; ?>
			</div>
			<aside class="span3 sidebar">
				<?php dynamic_sidebar( esc_html__( 'Search Results Sidebar', 'expire' ) ); ?>
			</aside>
		</div>
		<div id="search_pagination" class="pagination_simple">
		<?php the_posts_pagination( array(
			'mid_size'  => 2,
			'prev_text' => esc_html__( 'Previous page', 'expire' ),
			'next_text' => esc_html__( 'Next page', 'expire' ),
		) ); ?>
		</div>
	</div>
</section>
<?php
get_template_part( 'partials/paginations/pagination-search' );
get_footer();
