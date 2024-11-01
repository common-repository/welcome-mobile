<?php

/**
 * @link       http://matijaculjak.com
 * @since      1.1
 *
 * @package    Welcome_Mobile
 * @subpackage Welcome_Mobile/public/partials
 */
?>

<?php
	$detect 			= new Mobile_Detect;
	$message_position 	= get_option( $this->option_name . '_position' );
	$use_default  		= get_option( $this->option_name . '_use_default');
	$close_button 		= get_option( $this->option_name . '_close_button');
	$message_duration	= get_option( $this->option_name . '_visibility' );
	$cookie_expiration	= get_option( $this->option_name . '_cookie' );
	$default_message	= get_option( $this->option_name . '_default_message' );
	$android_message	= get_option( $this->option_name . '_android_message' );
	$ios_message		= get_option( $this->option_name . '_ios_message' );

	if (!is_admin() && $_COOKIE['wm_cookie'] != 'true') {
		echo '<div class="welcome-message '; if($message_position == 'top') { echo 'top" '; } elseif ($message_position == 'bottom') { echo 'bottom" '; }
		if ($close_button == 'no') {
			echo 'data-duration="' . $message_duration . '"';
		}

		echo 'data-cookie="' . $cookie_expiration . '">';

		if ($close_button == 'yes') {
			echo '<i class="icon-cancel"></i>';
		}

		if ($use_default == 'yes' && $detect->isMobile()) {
			echo $default_message ."\n";
		} elseif ($use_default == 'no') {
			if ($detect->isAndroidOS()) {
				echo $android_message ."\n";
			} elseif ($detect->isiOS()) {
				echo $ios_message ."\n";
			}
		}

		echo '</div>';
	}
?>