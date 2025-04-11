<?php
/**
 * Plugin Name:         Kntnt Matomo Tag Manager
 * Plugin URI:          https://github.com/Kntnt/kntnt-matomo-tag-manager
 * Description:         Adds Matomo Tag Manager for non-logged in visitors if the container ID is specified with either the PHP constant `KNTNT_MATOMO_TAG_MANAGER_CONATINER_ID` or the filter `kntnt-matomo-tag-manager-container-id`.
 * Version:             1.0.0
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
		$matomo_container_id = defined( 'KNTNT_MATOMO_TAG_MANAGER_CONTAINER_ID' ) ? KNTNT_MATOMO_TAG_MANAGER_CONATINER_ID : '';

		/**
		 * Filters the Matomo Tag Manager container ID.
		 *
		 * Allows overriding the container ID specified by the KNTNT_MATOMO_TAG_MANAGER_CONTAINER_ID constant
		 * or providing one if the constant is not set.
		 *
		 * @param string $matomo_container_id The Matomo container ID derived from the constant. Expected return is a string container ID.
		 */
		$matomo_container_id = apply_filters( 'kntnt-matomo-tag-manager-container-id', $matomo_container_id );

		$matomo_container_url = $matomo_container_id ? sprintf( 'https://cdn.matomo.cloud/safeteam.matomo.cloud/container_%s.js', $matomo_container_id ) : '';

		/**
		 * Filters the Matomo Tag Manager container URL.
		 *
		 * Allows modification of the full URL pointing to the Matomo container JavaScript file.
		 * Useful for self-hosted Matomo instances or different CDN endpoints.
		 *
		 * @param string|null $matomo_container_url The automatically generated Matomo container URL based on the container ID. Expected return is a valid URL string.
		 */
		$matomo_container_url = apply_filters( 'kntnt-matomo-tag-manager-container-url', $matomo_container_url );

		$escaped_matomo_url = esc_url( $matomo_container_url, [ 'https', 'http' ] );

		if ( $escaped_matomo_url ) {
			include __DIR__ . '/templates/matomo-tag-manager-script.php';
		}

	}

}