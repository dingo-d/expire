<?php
/**
 * Default page template
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

$values = get_post_custom( $post->ID );

get_header(); ?>
	<section id="main-content" class="page_main_section">
		<div class="container">
			<div class="row">
				<div class="page_container clearfix">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					if ( has_post_thumbnail() ) : ?>
					<div class="page_featured_image">
					<?php echo get_the_post_thumbnail( null, 'full' ); ?>
					</div>
					<?php endif;
					the_content();
					$link_args = array(
						'before'           => '<div id="inner_post_pagination">',
						'after'            => ' </div>',
						'link_before'      => '<span>',
						'link_after'       => '</span>',
					);
					wp_link_pages( $link_args );
				endwhile;
			endif;
				if ( ! get_theme_mod( 'hide_comments', false ) ) : ?>
					<div id="comments_section">
						<?php comments_template( '/inc/comments.php' ); ?>
					</div>
				<?php endif; ?>
				</div>
			</div><!-- end row -->
		</div>
	</section>
<?php get_footer();
