<?php
/**
 * Search form
 *
 * @package Expire
 * @version 1.0.9
 * @author Denis Žoljom <denis.zoljom@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.txt
 * @link https://madebydenis.com/expire
 * @since  1.0.0
 */

?>
<div class="widget_search">
	<form name="search" class="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input name="s" type="text" placeholder="<?php esc_html_e( 'Search', 'expire' ); ?>" value="<?php echo get_search_query(); ?>">
		<a class="submit"><i class="ti-search"></i></a>
	</form>
</div>
