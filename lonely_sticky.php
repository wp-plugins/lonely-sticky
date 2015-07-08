<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );

/**
 * Plugin Name: Lonely Sticky
 * Description: Allow only one sticky post at a time.
 * Version: 1.0.0
 * Author: Andrea Gandino
 * Author URI: http://andreagandino.com
 * License: GPL2
 * Text Domain: lonely_sticky
 *
 * Lonely Sticky is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Lonely Sticky is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA.
 *
 * @package   Lonely Sticky
 * @version   1.0.0
 * @author 	  Andrea Gandino <andreagandino@gmail.com>
 * @copyright Copyright (c) 2015, Andrea Gandino
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

if ( ! function_exists( 'lonely_sticky' ) ) :

	/**
	 * When saving a post that has been flagged as sticky, automatically unstick
	 * other posts.
	 *
	 * @since 1.0
	 * @param integer $post_id The ID of the post being saved.
	 */
	function lonely_sticky( $post_id ) {
		if ( 'post' !== get_post_type( $post_id ) ) {
			return;
		}

		$post_data = $_POST;

		if ( isset( $post_data['visibility'] ) && $post_data['visibility'] === 'public' ) {
			if ( isset( $post_data['sticky'] ) && $post_data['sticky'] === 'sticky' ) {
				update_option( 'sticky_posts', array( $post_id ) );
			}
		}
	}

	add_action( 'save_post', 'lonely_sticky' );

endif;
