<?php
/**
 * Post formats template part
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Expire
 * @version 1.1.2
 * @author Denis Žoljom <denis.zoljom@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT
 * @link https://madebydenis.com/expire
 *
 * @since 1.1.2
 */

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
}
?>
<div <?php post_class( 'post_wrapper' ); ?>>
	<div class="post_content">
		<div class="post_date">
			<span class="post_main_year"><?php echo get_the_date( 'Y' ); ?></span>
			<span class="post_main_month"><?php echo get_the_date( 'M' ); ?></span>
			<span class="post_main_date"><?php echo get_the_date( 'd' ); ?></span>
		</div>
		<div class="post_content_inner_wrapper">
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
			<div class="inner_post">
				<h3>
					<a href="<?php the_permalink(); ?>"><?php echo esc_html( get_the_title() ); ?></a>
				</h3>
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
					<i class="ti-tag"></i><span class="post_category"><?php the_category( ', ' )?></span>
				</div>
				<div class="post_content_text"><?php the_content( '' ); ?></div>
				<div class="post-readmore">
					<a href="<?php echo esc_url( get_permalink() )?>" class="more-link"><?php esc_html_e( 'Read More', 'expire' )?></a>
				</div>
			</div>
		</div>
	</div>
</div>
