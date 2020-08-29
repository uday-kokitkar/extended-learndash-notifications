<?php
/**
 * Additional notification settings.
 *
 * @package Extended_Learndash_Notifications/includes
 */

if ( ! class_exists( 'Extended_Notifications_Settings' ) ) {
	/**
	 * A plugin class.
	 */
	class Extended_Notifications_Settings {

		/**
		 * A class instance.
		 *
		 * @var Extended_Notifications_Settings
		 */
		protected static $instance = null;

		/**
		 * Let's initiate the class.
		 */
		private function __construct() {
			add_filter( 'learndash_notification_settings', array( $this, 'extended_learndash_notification_settings' ), 10, 1 );

			add_filter( 'eldn_type', array( $this, 'notification_type' ), 10, 1 );
		}

		/**
		 * Instantiate the class and returns the instance.
		 *
		 * @static
		 *
		 * @return Extended_Notifications_Settings.
		 */
		public static function get_instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Adds buddyPress notification settings.
		 *
		 * @param  array $settings Notification settings.
		 * @return array Notification settings.
		 */
		public function extended_learndash_notification_settings( $settings ) {

			$settings['eldn_type'] = array(
				'type' => 'dropdown',
				'title' => __( 'Notification Type', 'extended-learndash-notifications' ),
				'help_text' => __( 'How to send this notification. Default email. For BuddyPress option, make sure that Private Messaging component is enabled in BuddyPress settings', 'learndash-notifications' ),
				'hide' => 0,
				'disabled' => 0,
				'value' => array(
					'email' => __( 'Email', 'extended-learndash-notifications' ),
				) + apply_filters( 'eldn_type', array() ),
			);

			/*
			|
			| This code can be used to decide sender of the buddyPress message. We need to find out sender by type of trigger.
			|

			if ( eldn_is_bp_priv_message_active() ) {
				$settings['bp_sender'] = array(
					'type' => 'dropdown',
					'title' => __( 'BuddyPress Sender', 'extended-learndash-notifications' ),
					'help_text' => __( 'BuddyPress notification sender.', 'extended-learndash-notifications' ),
					'hide' => 0,
					'disabled' => 0,
					'value' => array(
						'admin' => __( 'Admin', 'extended-learndash-notifications' ),
						'author' => LearnDash_Custom_Label::get_label( 'course' ) . __( ' Author', 'extended-learndash-notifications' ),
						'leader' => __( 'Group Leader', 'extended-learndash-notifications' ),
					),
				);
			}
			*/

			return $settings;
		}

		/**
		 * LearnDash notifications types.
		 *
		 * @param  array $types Types of notifications.
		 * @return array        Adds BuddyPress support.
		 */
		public function notification_type( $types ) {
			$types['bp'] = __( 'BuddyPress', 'extended-learndash-notifications' );
			$types['bp_email'] = __( 'Email + BuddyPress', 'extended-learndash-notifications' );
			return $types;
		}

	}
}
