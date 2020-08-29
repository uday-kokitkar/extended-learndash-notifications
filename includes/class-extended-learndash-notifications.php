<?php
/**
 * A main plugin class.
 *
 * @package Extended_Learndash_Notifications/includes
 */

if ( ! class_exists( 'Extended_Learndash_Notifications' ) ) {
	/**
	 * A plugin class.
	 */
	final class Extended_Learndash_Notifications {

		/**
		 * Let's initiate the class.
		 *
		 * @param string $plugin_file Plugin's main file.
		 */
		public function __construct( $plugin_file ) {
			// Nothing to setup here.
		}

		/**
		 * Initiate plugin functions.
		 *
		 * @return void.
		 */
		public function init() {

			require_once 'utility-functions.php';

			require_once 'admin' . DIRECTORY_SEPARATOR . 'class-extended-notifications-settings.php';
			Extended_Notifications_Settings::get_instance();

			require_once 'class-extended-notifications-sender.php';
			Extended_Notifications_Sender::get_instance();
		}
	}
}
