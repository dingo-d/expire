<?php
/**
 * Post formats aside template part
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

?>
<div <?php post_class( 'post_wrapper' ); ?>>
	<div class="post_content">
		<div class="post_date">
			<span class="post_main_year"><?php echo get_the_date( 'Y' ); ?></span>
			<span class="post_main_month"><?php echo get_the_date( 'M' ); ?></span>
			<span class="post_main_date"><?php echo get_the_date( 'd' ); ?></span>
		</div>
		<div class="post_content_inner_wrapper">
			<div class="inner_post">
				<div class="post_content_text"><?php the_content( '' ); ?></div>
			</div>
		</div>
	</div>
</div>
