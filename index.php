<?php
/**
 * Main template file
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

get_header(); ?>
<section id="main-content" class="blog blog_full_width">
	<div class="container">
		<div class="row">
			<div class="span12 blog_category_index">
			<?php if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					/**
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/post/content', get_post_format() );
				endwhile;
				else : ?>
					<p><?php esc_html_e( 'No posts were found. Sorry!', 'expire' ); ?></p>
				<?php endif; ?>
				<!-- Load More Posts START -->
				<section class="pagination_simple">
					<div class="pagination_wrapper">
					<?php the_posts_pagination( array(
						'mid_size'  => 2,
						'prev_text' => esc_html__( 'Previous page', 'expire' ),
						'next_text' => esc_html__( 'Next page', 'expire' ),
					) ); ?>
					</div>
				</section>
			</div>
		</div>
	</div>
</section>
<?php
get_footer();
