<?php
/**
 * Single post
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

get_header();

$expire_settings = get_option( 'expire_settings', '' );

$clock_icon = ( isset( $expire_settings['settings']['clock_icon'] )
				&& '' !== $expire_settings['settings']['clock_icon'])
				? '<i class="' . $expire_settings['settings']['clock_icon'] . '"></i>' : '';
$tags_icon  = ( isset( $expire_settings['settings']['tags_icon'] )
				&& '' !== $expire_settings['settings']['tags_icon'])
				? '<i class="' . $expire_settings['settings']['tags_icon'] . '"></i>' : '';
$author_icon= ( isset( $expire_settings['settings']['author_icon'] )
				&& '' !== $expire_settings['settings']['author_icon'])
				? '<i class="' . $expire_settings['settings']['author_icon'] . '"></i>' : '';
?>
<section id="main-content">
	<div class="container">
		<div class="row">
			<?php if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					$thumbnail_class = ( has_post_thumbnail() ) ? 'has_post_thumbnail' : '';
					$post_format     = get_post_format();

					switch ( $post_format ) {
						case 'image':
							$icon_out = '<i class="ti-image"></i>';
							break;
						case 'video':
							$icon_out = '<i class="ti-video-clapper"></i>';
							break;
						case 'audio':
							$icon_out = '<i class="ti-music-alt"></i>';
							break;
						case 'quote':
							$icon_out = '<i class="ti-quote"></i>';
							break;
						case 'gallery':
							$icon_out = '<i class="ti-gallery"></i>';
							break;
						case 'chat':
							$icon_out = '<i class="ti-comment-alt"></i>';
							break;
						case 'link':
							$icon_out = '<i class="ti-link"></i>';
							break;
						case 'standard':
							$icon_out = '<i class="ti-pencil"></i>';
							break;

						default:
							$icon_out = '<i class="ti-pencil-alt"></i>';
							break;
					}
					?>
			<!-- Main Content -->
			<div class="span9">
				<div <?php post_class( 'single_post_content' ); ?>>
					<div class="post_date">
						<span class="post_main_year"><?php echo get_the_date( 'Y' ); ?></span>
						<span class="post_main_month"><?php echo get_the_date( 'M' ); ?></span>
						<span class="post_main_date"><?php echo get_the_date( 'd' ); ?></span>
					</div>
					<h2 class="main_title"><span><?php the_title(); ?></span></h2>
					<div class="post_meta">
						<i class="ti-user"></i><?php esc_html_e( 'By ', 'expire' ); ?><span><?php the_author_posts_link(); ?></span>
						<?php if ( ! get_theme_mod( 'hide_comments', false ) ) : ?>
						<i class="ti-comment"></i>
						<a href="<?php comments_link(); ?>" class="scroll comments_link">
							<?php $comment_number = get_comments_number();
							printf(
								esc_attr(
									// translators: Number of comments.
									_n(
										'%s Comment',
										'%s Comments',
										$comment_number,
										'expire'
									)
								),
								esc_html( number_format_i18n( $comment_number ) )
							);
							?>
						</a>
						<?php endif; ?>
					</div>
					<div class="inner_post_content <?php echo esc_attr( $thumbnail_class ); ?>">
						<div class="post_info">
							<div class="post_type">
								<?php echo wp_kses_post( $icon_out ); ?>
							</div>
						</div>
						<?php if ( has_post_thumbnail() ) : ?>
						<div class="post_featured_image">
						<?php echo get_the_post_thumbnail( null, 'full' ); ?>
						</div>
						<?php endif; ?>
						<div class="post_content clearfix">
							<?php the_content();
							$link_args = array(
								'before'           => '<div id="inner_post_pagination">',
								'after'            => ' </div>',
								'link_before'      => '<span>',
								'link_after'       => '</span>',
							);
							wp_link_pages( $link_args );
							?>
						</div>
					</div>
					<?php if ( has_tag() ) : ?>
					<div class="post_tags">
						<i class="ti-tag"></i><span class="post_tag"><?php the_tags( '', ', ', '' ); ?></span>
					</div>
					<?php endif; ?>
					<!-- Post Pagination  -->
					<div id="expire_single_post_pagination">
						<span class="prev"><?php previous_post_link( '%link', esc_html__( 'Next post', 'expire' ) ); ?></span>
						<span class="next"><?php next_post_link( '%link', esc_html__( 'Previous post', 'expire' ) ); ?></span>
					</div>
					<!-- Comments -->
					<?php if ( ! get_theme_mod( 'hide_comments', false ) ) : ?>
					<div id="comments_section">
						<?php comments_template( '/inc/comments.php' ); ?>
					</div>
					<?php endif; ?>
				</div>
				<?php endwhile;
				else : ?>
					<p><?php esc_html_e( 'No posts were found. Sorry!', 'expire' ); ?></p>
				<?php endif; ?>
			</div>
			<!-- Post Sidebar -->
			<aside class="span3 sidebar">
				<?php
					$selected_sidebar = esc_html__( 'Primary Sidebar', 'expire' );
					dynamic_sidebar( $selected_sidebar );
				?>
			</aside>
		</div>
	</div>
</section>
<?php
$content_after_single_post = get_theme_mod( 'content_after_single_post', false );

if ( $content_after_single_post && is_single() ) {
	$page_id = get_page( $content_after_single_post );
	echo apply_filters( 'the_content', wp_kses( $page_id->post_content, expire_allowed_tags() ) ); // phpcs:ignore
}

get_footer();
