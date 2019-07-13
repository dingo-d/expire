<?php
/**
 * Single post
 *
 * @package Expire
 * @version 1.0.9
 * @author Denis Žoljom <denis.zoljom@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.txt
 * @link https://madebydenis.com/expire
 * @since  1.0.0
 */

get_header();

$expire_settings = get_option( 'expire_settings', '' );
$clock_icon = ( isset( $expire_settings['settings']['clock_icon'] ) && '' !== $expire_settings['settings']['clock_icon']) ? '<i class="' . $expire_settings['settings']['clock_icon'] . '"></i>' : '';
$tags_icon = ( isset( $expire_settings['settings']['tags_icon'] ) && '' !== $expire_settings['settings']['tags_icon']) ? '<i class="' . $expire_settings['settings']['tags_icon'] . '"></i>' : '';
$author_icon = ( isset( $expire_settings['settings']['author_icon'] ) && '' !== $expire_settings['settings']['author_icon']) ? '<i class="' . $expire_settings['settings']['author_icon'] . '"></i>' : '';
?>
<section id="expire_single_post">
	<div class="container">
		<div class="row">
			<?php if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					$thumbnail_class = ( has_post_thumbnail() ) ? 'has_post_thumbnail' : '';
					$post_format = get_post_format();
					$icon_out = '';
					if ( false === $post_format ) {
						$post_format = 'standard';
						$icon_out .= '<i class="ti-pencil"></i>';
					} elseif ( 'image' === $post_format ) {
						$icon_out .= '<i class="ti-image"></i>';
					} elseif ( 'video' === $post_format ) {
						$icon_out .= '<i class="ti-video-clapper"></i>';
					} elseif ( 'audio' === $post_format ) {
						$icon_out .= '<i class="ti-music-alt"></i>';
					} elseif ( 'quote' === $post_format ) {
						$icon_out .= '<i class="ti-quote"></i>';
					} elseif ( 'gallery' === $post_format ) {
						$icon_out .= '<i class="ti-gallery"></i>';
					} elseif ( 'chat' === $post_format ) {
						$icon_out .= '<i class="ti-comment-alt"></i>';
					} elseif ( 'link' === $post_format ) {
						$icon_out .= '<i class="ti-link"></i>';
					} else {
						$icon_out .= '<i class="ti-pencil-alt"></i>';
					} ?>
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
					<div class="post_tags">
						<i class="ti-tag"></i><span class="post_tag"><?php the_tags( '', ', ', '' ); ?></span>
					</div>
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
	echo apply_filters( 'the_content', wp_kses( $page_id->post_content, expire_allowed_tags() ) ); // WPCS: xss ok.
}

get_footer();
