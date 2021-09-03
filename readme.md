# Extended LearnDash Notifications

Sending BuddyPress messages would help real time notifications and initiation of the conversation on the LearnDash-BuddyPress websites. 

# Features!

  - Adds option to send BuddyPress message.
  - Setting to send BuddyPress message as well as email.
  - Message sender is admin of the site.
  
### Screenshots
Notifications Setting
![Notification Type](https://i.imgur.com/32dDWpw.png)

### Configuration

Make sure that BuddyPress Private Messaging component is enabled.

**IMPORTANT CHANGE**: If you are using LearnDash Notification plugin 1.5 or greater, following line must be modified in the LearnDash Notifications plugin to work this extended plugin.

File: `learndash-notifications/src/trigger.php`

Line number: 61 (as per the LearnDash Notification v1.5.3)

Original Code at line 61: `$is_send = true;`

Replace it by `$is_send = apply_filters( 'learndash_notifications_send_email', true, $email, $model->post->ID );`


### Installation

Follow these [steps](https://wordpress.org/support/article/managing-plugins/#installing-plugins) to install a plugin.

### Todos

 - Set a sender according to type of trigger.

License
----

GPL 3.0 
