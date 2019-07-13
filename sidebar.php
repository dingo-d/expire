<?php
/**
 * Sidebar
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

if ( ! function_exists( 'dynamic_sidebar' ) ) : ?>
	<div class="widget">
		<?php get_search_form(); ?>
	</div>
<?php endif;
