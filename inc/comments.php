<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to expire_comment().
 *
 * @package Expire
 * @version 1.0.9
 * @author Denis Žoljom <denis.zoljom@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.txt
 * @link https://madebydenis.com/expire
 * @since  1.0.0
 */

/**
 * Comment navigation
 *
 * @since 1.0.0
 */
function expire_comment_nav() {
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<nav id="comment-nav">
		<?php if ( get_previous_comments_link() ) : ?>
		<div class="comment-nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'expire' ) ); ?></div>
		<?php endif;
		if ( get_next_comments_link() ) : ?>
		<div class="comment-nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'expire' ) ); ?></div>
		<?php endif; ?>
	</nav>
	<?php endif;
}

/**
 * Comment function
 *
 * @param string $comment Comment string.
 * @param array  $args    Comment arguments.
 * @param int    $depth   Comment depth - whether it's a reply or comment.
 * @since  1.0.0
 */
function expire_comment( $comment, $args, $depth ) {
	switch ( $comment->comment_type ) :
		case 'pingback' :
			?>
			<li <?php comment_class( 'clearfix pingback' ); ?>>
				<p><?php esc_html_e( 'Pingback: ', 'expire' ) . comment_author_link() . edit_comment_link( esc_html__( 'Edit', 'expire' ), '<span class="edit-link">', '</span>' ); ?></p>
			<?php
			break;
		case 'trackback' :
			?>
			<li <?php comment_class( 'clearfix trackback' ); ?>>
				<p><?php esc_html_e( 'Trackback: ', 'expire' ) . comment_author_link() . edit_comment_link( esc_html__( 'Edit', 'expire' ), '<span class="edit-link">', '</span>' ); ?></p>
			<?php
			break;
		default :
			?>
			<li <?php comment_class( 'clearfix' ); ?> id="comment-<?php comment_ID(); ?>">
				<?php
				$avatar_size = 70;
				if ( '0' !== $comment->comment_parent ) {
					$avatar_size = 70;
				}
				echo get_avatar( $comment, $avatar_size );
				?>
				<div class="comment-text">
				<?php
				// translators: Adding author and datetime for comments.
				printf( esc_html__( '%1$s %2$s', 'expire' ),
					sprintf( '<p class="comment-author">%s</p>', get_comment_author_link() ),
					sprintf( 'on <a class="comment_time" href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						// translators: Adds date and time.
						sprintf( esc_html__( '%1$s at %2$s', 'expire' ), get_comment_date(), get_comment_time() )
					)
				);
				?>
				<p class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'expire' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</p><!-- .reply -->
				<?php edit_comment_link( esc_html__( 'Edit', 'expire' ), '<span class="edit-link">', '</span>' );
				if ( '0' === $comment->comment_approved ) : ?>
					<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'expire' ); ?></em>
					<br />
				<?php else :
				comment_text();
				endif; ?>
				</div>
			<?php
		endswitch;
}

?>
	<div id="comments">
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php esc_html_e( 'This post is password protected. Enter the password to view any comments.', 'expire' ); ?></p>
	</div><!-- #comments -->
	<?php

			/*
			 * Stop the rest of comments.php from being processed,
             * but don't kill the script entirely -- we still have
             * to fully load the template.
			 */
			return;
		endif;

if ( have_comments() ) : ?>
	<h3 id="comments-title"><?php
	$comm_no = get_comments_number();
	// translators: Number of comments.
	printf( esc_attr( _n( '%s comment', '%s comments', $comm_no, 'expire' ) ), esc_attr( number_format_i18n( $comm_no ) ) ); ?></h3>
	<?php expire_comment_nav(); ?>
	<ol class="commentlist">
		<?php

			/*
			 Loop through and list the comments. Tell wp_list_comments()
             * to use expire_comment() to format the comments.
             * If you want to overload this in a child theme then you can
             * define expire_comment() and that will be used instead.
             * See expire_comment() in twentyeleven/functions.php for more.
			 */

			wp_list_comments( array( 'callback' => 'expire_comment' ) );
		?>
	</ol>
	<?php expire_comment_nav();

	/*
	 If there are no comments and comments are closed, let's leave a little note, shall we?
     * But we don't want the note on pages or post types that do not support comments.
	 */
	elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<h3 id="comments-title"><?php esc_html_e( 'No comments', 'expire' ); ?></h3>
	<?php
	endif;

		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );

		$fields = array(
			'author' => '<div class="comment_fields"><p class="comment-form-author"><input id="author" name="author" type="text" placeholder="' . esc_html__( 'Name*', 'expire' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
			'email' => '<p class="comment-form-email"><input id="email" name="email" type="text" placeholder="' . esc_html__( 'E-mail*', 'expire' ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
			'url' => '<p class="comment-form-url"><input id="url" name="url" type="text" placeholder="' . esc_html__( 'Website', 'expire' ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30"' . $aria_req . ' /></p></div>',
		);

		$comment_field = '<p class="comment-form-comment"><textarea id="comment" name="comment" placeholder="' . esc_html__( 'Your Comment', 'expire' ) . '" cols="45" rows="8" aria-required="true"></textarea></p>';

		comment_form( array(
			'fields'              => $fields,
			'comment_field'       => $comment_field,
			'comment_notes_after' => '',
			'id_submit'           => 'comment-submit',
			'title_reply'         => esc_html__( 'Leave a comment', 'expire' ),
		) ); ?>
	<div class="clear"></div>
</div><!-- #comments -->
