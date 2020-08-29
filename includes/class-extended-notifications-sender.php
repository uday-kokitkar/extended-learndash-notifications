<?php
/**
 * Sends BuddyPress private messages.
 *
 * @package Extended_Learndash_Notifications/includes
 */

if ( ! class_exists( 'Extended_Notifications_Sender' ) ) {
	/**
	 * A plugin class.
	 */
	class Extended_Notifications_Sender {

		/**
		 * A class instance.
		 *
		 * @var Extended_Notifications_Sender
		 */
		protected static $instance = null;

		/**
		 * All notifications with meta data.
		 * array(
		 *       '{id}' => array(
		 *          'subject' => '',
		 *          'content' => '',
		 *       )
		 * )
		 *
		 * @var array
		 */
		public $notifications = array();

		/**
		 * Let's initiate the class.
		 */
		private function __construct() {
			add_filter( 'learndash_notifications_email_subject', array( $this, 'notification_subject' ), 10, 2 );
			add_filter( 'learndash_notifications_email_content', array( $this, 'notification_content' ), 10, 2 );
			add_filter( 'learndash_notifications_send_email', array( $this, 'bp_notification_sender' ), 10000, 3 );
		}

		/**
		 * Instantiate the class and returns the instance.
		 *
		 * @static
		 *
		 * @return Extended_Notifications_Sender.
		 */
		public static function get_instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Stores notification subject in the class variable to be used while sending the diff type of notification.
		 *
		 * @param  string $subject         Email subject.
		 * @param  int    $notification_id Notification ID.
		 * @return string                  Email subject
		 */
		public function notification_subject( $subject, $notification_id ) {

			if ( ! isset( $this->notifications[ $notification_id ] ) ) {
				$this->notifications[ $notification_id ] = array();
			}
			$this->notifications[ $notification_id ]['subject'] = $subject;
			return $subject;
		}

		/**
		 * Stores notification content in the class variable to be used while sending the diff type of notification.
		 *
		 * @param  string $content         Email content.
		 * @param  int    $notification_id Notification ID.
		 * @return string                  Email content
		 */
		public function notification_content( $content, $notification_id ) {

			if ( ! isset( $this->notifications[ $notification_id ] ) ) {
				$this->notifications[ $notification_id ];
			}
			$this->notifications[ $notification_id ]['content'] = $content;
			return $content;
		}

		/**
		 * Prevent sending email if BP setting is active and sends BP private message.
		 *
		 * @param  bool   $status          To send or not an email.
		 * @param  string $email           Email content.
		 * @param  int    $notification_id Notification ID.
		 * @return bool                    false if BP type is enabled.
		 */
		public function bp_notification_sender( $status, $email, $notification_id ) {

			if ( isset( $this->notifications[ $notification_id ] ) && eldn_is_bp_priv_message_active() ) {
				$notification_type = get_post_meta( $notification_id, '_ld_notifications_eldn_type', true );
				$admin_user = get_user_by( 'email', get_option( 'admin_email' ) );
				$recipient_user = get_user_by( 'email', $email );

				$args = apply_filters(
					'eldn_bp_args',
					array(
						'sender_id' => $admin_user->ID,
						'recipients' =>
							array(
								'0' => $recipient_user->ID,
							),
						'subject' => $this->notifications[ $notification_id ]['subject'],
						'content' => $this->notifications[ $notification_id ]['content'],
					)
				);

				if ( 'bp' == $notification_type ) {
					$status = false; // don't send email notification.
					messages_new_message( $args );
				} else if ( 'bp_email' == $notification_type ) {
					messages_new_message( $args );
				}
			}
			return $status;
		}

		/**
		 * This function can be used if we change message sender. Currently, it is not supported.
		 *
		 * @param  int $notification_id Notification ID.
		 * @return int                  User ID fo the sender.
		 */
		public function get_bp_message_sender( $notification_id ) {
			// $sender_type = get_post_meta( $notification_id, '_ld_notifications_bp_sender' );
			return $user_id;
		}
	}
}
