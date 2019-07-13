<?php
/**
 * Sidebar
 *
 * @package Expire
 * @version 1.0.9
 * @author Denis Žoljom <denis.zoljom@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.txt
 * @link https://madebydenis.com/expire
 * @since  1.0.0
 */

if ( ! function_exists( 'dynamic_sidebar' ) ) : ?>
	<div class="widget">
		<?php get_search_form(); ?>
	</div>
<?php endif;
