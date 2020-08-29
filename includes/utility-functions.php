<?php
/**
 * These pluggable functions are used commonly.
 *
 * @package Extended_Learndash_Notifications/includes
 */

if ( ! function_exists( 'eldn_is_bp_priv_message_active' ) ) {

	/**
	 * Returns true if BuddyPress Private Messaging component is active.
	 *
	 * @return bool Messaging status.
	 */
	function eldn_is_bp_priv_message_active() {

		$messaging_status = false;

		if ( function_exists( 'bp_is_active' ) && true === bp_is_active( 'messages' ) ) {
			$messaging_status = true;
		}
		return $messaging_status;
	}
}
