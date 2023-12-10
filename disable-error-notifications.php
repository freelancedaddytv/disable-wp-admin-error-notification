<?php
/*
Plugin Name: Disable Error Notifications
Description: Disable admin notifications for errors in WordPress.
Version: 1.0
Author: Jefrey L.
*/


function disable_error_notifications($phpmailer) {
    if (defined('DOING_AJAX') && DOING_AJAX) {
        return;
    }

    // Check if the email is an error notification
    if (strpos($phpmailer->Subject, 'PHP Warning') !== false ||
        strpos($phpmailer->Subject, 'PHP Notice') !== false ||
        strpos($phpmailer->Subject, 'PHP Fatal error') !== false) {
        $phpmailer->ClearAllRecipients();
        $phpmailer->ClearReplyTos();
    }
}
add_action('phpmailer_init', 'disable_error_notifications');
