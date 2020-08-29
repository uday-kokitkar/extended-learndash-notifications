<?php
/**
 * Plugin Name: LearnDash Notifications - Extended
 * Description: Send notification by BuddyPress messages to the users.
 * Version: 1.0.0
 * Author: Uday Kokitkar
 * Text Domain: extended-learndash-notifications
 * Domain Path: languages
 *
 * @package Extended_Learndash_Notifications
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

if ( ! defined( 'ELDN_PLUGIN_FILE' ) ) {
	define( 'ELDN_PLUGIN_FILE', __FILE__ );
}

add_action( 'plugins_loaded', 'init_extended_ld_notifications', 11 );

if ( ! function_exists( 'init_extended_ld_notifications' ) ) {

	/**
	 * Let's solve the problems.
	 *
	 * @since  1.0.0
	 *
	 * @return void.
	 */
	function init_extended_ld_notifications() {
		if ( defined( 'LEARNDASH_NOTIFICATIONS_VERSION' ) ) { // If LD notifications plugin is active.
			require_once 'includes/class-extended-learndash-notifications.php';
			$GLOBALS['eldn_instance'] = new Extended_Learndash_Notifications( ELDN_PLUGIN_FILE );
			$GLOBALS['eldn_instance']->init();
		}
	}
}
