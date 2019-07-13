<?php
/**
 * Breadcrumbs
 *
 * @package Expire
 * @version 1.0.9
 * @author Denis Žoljom <denis.zoljom@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.txt
 * @link https://madebydenis.com/expire
 * @since  1.0.0
 */

if ( ! function_exists( 'expire_simple_breadcrumb' ) ) {
	/**
	 * Simple breadcrumbs
	 *
	 * @since 1.0.0
	 */
	function expire_simple_breadcrumb() {
		global $post;
		$link = '<a href="%s">%s</a>';

		if ( ( is_home() || is_front_page() ) && ! is_page() ) {
			echo '<div class="breadcrumbs">' . sprintf( // WPCS: XSS OK.
			$link, esc_url( home_url( '/' ) ), esc_html__( 'Home', 'expire' ) );
		} else {
			echo '<div class="breadcrumbs">' . sprintf( // WPCS: XSS OK.
			$link, esc_url( home_url( '/' ) ), esc_html__( 'Home', 'expire' ) ) . '<span class="breadcrumb_delimiter"></span> ';
		}

		if ( is_category() ) {
			$this_cat = get_category( get_query_var( 'cat' ), false );
			if ( 0 !== $this_cat->parent ) {
				echo wp_kses_post( get_category_parents( $this_cat->parent, true, '<span class="breadcrumb_delimiter"></span> ' ) );
			}
			echo '<span class="current">' . single_cat_title( '', false ) . '</span>';

		} elseif ( is_tax() ) {
			if ( is_tax( 'portfolio-category' ) ) {
				$this_cat = get_query_var( 'portfolio-category' );
			} elseif ( is_tax( 'testimonials-type' ) ) {
				$this_cat = get_query_var( 'testimonials-type' );
			} elseif ( is_tax( 'download_category' ) ) {
				$this_cat = get_query_var( 'download_category' );
			} elseif ( is_tax( 'download_tag' ) ) {
				$this_cat = get_query_var( 'download_tag' );
			} elseif ( is_tax( 'tribe_events_cat' ) ) {
				$this_cat = get_query_var( 'tribe_events_cat' );
			} elseif ( is_tax( 'product_cat' ) ) {
				$this_cat = get_query_var( 'product_cat' );
			} else {
				$this_cat = get_category( get_query_var( 'cat' ), false );
				if ( 0 !== $this_cat->parent ) {
					echo wp_kses_post( get_category_parents( $this_cat->parent, true, '<span class="breadcrumb_delimiter"></span> ' ) );
				}
			}
			// translators: Breadcrumbs title for archives.
			echo '<span class="current">' . sprintf( esc_html__( 'Archive for "%s"', 'expire' ), single_cat_title( '', false ) ) . '</span>';

		} elseif ( is_search() ) {
			// translators: Breadcrumbs title for search results.
			echo '<span class="current">' . sprintf( esc_html__( 'Search Results for "%s"', 'expire' ), get_search_query() ) . '</span>';

		} elseif ( is_day() ) {
			echo sprintf( // WPCS: XSS OK.
			$link, get_year_link( get_the_time( 'Y' ) ), get_the_time( 'Y' ) ) . '<span class="breadcrumb_delimiter"></span> ';
			echo sprintf( // WPCS: XSS OK.
			$link, get_month_link( get_the_time( 'Y' ),get_the_time( 'm' ) ), get_the_time( 'F' ) ) . '<span class="breadcrumb_delimiter"></span> ';
			echo '<span class="current">' . esc_html( get_the_time( 'd' ) ) . '</span>';

		} elseif ( is_month() ) {
			echo sprintf( // WPCS: XSS OK.
			$link, get_year_link( get_the_time( 'Y' ) ), get_the_time( 'Y' ) ) . '<span class="breadcrumb_delimiter"></span> ';
			echo '<span class="current">' . esc_html( get_the_time( 'F' ) ) . '</span>';

		} elseif ( is_year() ) {
			echo '<span class="current">' . esc_html( get_the_time( 'Y' ) ) . '</span>';

		} elseif ( is_single() && ! is_attachment() ) {
			if ( get_post_type() !== 'post' ) {
				$post_type = get_post_type_object( get_post_type() );
				$slug = $post_type->rewrite;
				$archive_link = get_post_type_archive_link( $post_type );
				if ( false !== $archive_link ) {
					printf( // WPCS: XSS OK.
					$link, $archive_link, $post_type->labels->singular_name );
				} else {
					printf( // WPCS: XSS OK.
					'<span class="post_type">%s</span>', $post_type->labels->singular_name );
				}
				echo '<span class="breadcrumb_delimiter"></span><span class="current">' . esc_html( wp_trim_words( get_the_title(), 4 ) ) . '</span>';
			} else {
				$cat = get_the_category();
				$cat = $cat[0];
				echo wp_kses_post( get_category_parents( $cat, true, '<span class="breadcrumb_delimiter"></span> ' ) );
				echo '<span class="current">' . esc_html( wp_trim_words( get_the_title(), 4 ) ) . '</span>';
			}
		} elseif ( ! is_single() && ! is_page() && get_post_type() !== 'post' && ! is_404() ) {
			$post_type = get_post_type_object( get_post_type() );
			if ( isset( $post_type ) && '' !== $post_type ) {
				echo '<span class="current">' . wp_kses_post( $post_type->labels->singular_name ) . '</span>';
			}
		} elseif ( is_attachment() ) {
			$parent = get_post( $post->post_parent );
			$cat = get_the_category( $parent->ID );
			$cat = $cat[0];
			echo wp_kses_post( get_category_parents( $cat, true, '<span class="breadcrumb_delimiter"></span> ' ) );
			printf( // WPCS: XSS OK.
			$link, get_permalink( $parent ), $parent->post_title );
			echo '<span class="breadcrumb_delimiter"></span><span class="current">' . esc_html( get_the_title() ) . '</span>';

		} elseif ( is_page() && ! $post->post_parent ) {
			echo '<span class="current">' . esc_html( get_the_title() ) . '</span>';

		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ( $parent_id ) {
				$page = get_page( $parent_id );
				$breadcrumbs[] = sprintf( // WPCS: XSS OK.
				$link, get_permalink( $page->ID ), get_the_title( $page->ID ) );
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse( $breadcrumbs );
			$bc_number = count( $breadcrumbs );
			for ( $i = 0; $i < $bc_number; $i++ ) {
				echo '' . $breadcrumbs[ $i ]; // WPCS: XSS OK.
				if ( $i !== $bc_number -1 ) {
					echo '<span class="breadcrumb_delimiter"></span> ';
				}
			}
			echo '<span class="breadcrumb_delimiter"></span><span class="current">' . esc_html( get_the_title() ) . '</span>';

		} elseif ( is_tag() ) {
			// translators: Breadcrumbs title for post tags.
			echo '<span class="current">' . sprintf( esc_html__( 'Posts Tagged "%s"', 'expire' ), single_tag_title( '', false ) ) . '</span>';

		} elseif ( is_author() ) {
	 		global $author;
			$userdata = get_userdata( $author );
			echo '<span class="current">' . sprintf( // WPCS: XSS OK.
				// translators: Breadcrumbs title for author posts.
			esc_html__( 'Articles by "%s"', 'expire' ), wp_kses_post( $userdata->display_name ) ) . '</span>';

		} elseif ( is_404() ) {
			echo '<span class="current">' . esc_html__( 'Error 404', 'expire' ) . '</span>';
		}

		if ( get_query_var( 'paged' ) ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
				echo ' ( ';
			}
			echo '<span class="breadcrumb_delimiter"></span><span class="current">' . esc_html__( 'Page', 'expire' ) . ' ' . get_query_var( 'paged' ) . '</span>'; // WPCS: XSS OK.
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
				echo ' )';
			}
		}

		echo '</div>';

	}
}
