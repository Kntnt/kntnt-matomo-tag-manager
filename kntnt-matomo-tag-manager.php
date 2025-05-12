<?php
/**
 * Plugin Name:         Kntnt Matomo Tag Manager
 * Plugin URI:          https://github.com/Kntnt/kntnt-matomo-tag-manager
 * Description:         Adds Matomo Tag Manager for non-logged in visitors if the container ID is specified with either the PHP constant `KNTNT_MATOMO_TAG_MANAGER_CONATINER_ID` or the filter `kntnt-matomo-tag-manager-container-id`.
 * Version:             1.1.0
 * Requires at least:   6.7
 * Requires PHP:        7.1
 * Author:              TBarregren
 * Author URI:          https://www.kntnt.com/
 * License:             GPL-2.0-or-later
 * License URI:         https://www.gnu.org/licenses/gpl-2.0.txt
 * Tested up to:        6.7
 */

namespace Kntnt\Matomo_Tag_Manager;

defined( 'ABSPATH' ) && new Plugin;

final class Plugin {

	public function __construct() {
		add_action( 'wp_head', [ $this, 'maybe_output_matomo_tag_manager' ], PHP_INT_MIN );
	}

	/**
	 * Checks conditions and potentially outputs the Matomo Tag Manager script.
	 *
	 * Retrieves the Matomo Container ID via a filter, allowing overrides.
	 * Only outputs the script if the user is not logged in and a valid Container ID is provided.
	 */
	public function maybe_output_matomo_tag_manager(): void {

		if ( is_user_logged_in() ) {
			return;
		}

		/** @noinspection PhpUndefinedConstantInspection */
		$matomo_container_url = defined( 'KNTNT_MATOMO_TAG_MANAGER_CONTAINER_URL' ) ? KNTNT_MATOMO_TAG_MANAGER_CONATINER_URL : '';

		/**
		 * Filters the Matomo Tag Manager container URL.
		 *
		 * Allows overriding the container URL specified by the KNTNT_MATOMO_TAG_MANAGER_CONTAINER_URL constant
		 * or providing one if the constant is not set.
		 *
		 * @param string $matomo_container_url The Matomo container URL derived from the constant. Expected return is a string container URL.
		 */
		$matomo_container_url = apply_filters( 'kntnt-matomo-tag-manager-container-url', $matomo_container_url );

		$escaped_matomo_url = esc_url( $matomo_container_url, [ 'https', 'http' ] );

		if ( $escaped_matomo_url ) {
			include __DIR__ . '/templates/matomo-tag-manager-script.php';
		}

	}

}