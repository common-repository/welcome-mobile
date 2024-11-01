<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://matijaculjak.com
 * @since      1.1
 *
 * @package    Welcome_Mobile
 * @subpackage Welcome_Mobile/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and admin hooks.
 *
 * @package    Welcome_Mobile
 * @subpackage Welcome_Mobile/admin
 * @author     Matija Culjak <matija.culjak@gmail.com>
 */
class Welcome_Mobile_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.1
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The options name to be used in this plugin
	 *
	 * @since  	1.1
	 * @access 	private
	 * @var  	string 		$option_name 	Option name of this plugin
	 */
	private $option_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.1
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.1
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $option_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->option_name = $option_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.1
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/welcome-mobile-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'wp-color-picker' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.1
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/welcome-mobile-admin.js', array( 'jquery', 'wp-color-picker' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'public/js/welcome-mobile-public-js-cookie.js', '', $this->version, true );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'public/js/welcome-mobile-public.js', array( 'jquery' ), $this->version, true );

	}

	/**
	 * Add an options page under the Settings submenu
	 *
	 * @since  1.1
	 */
	public function add_options_page() {
	
		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'Welcome! Mobile Settings', 'welcome-mobile' ),
			__( 'Welcome! Mobile', 'welcome-mobile' ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'display_options_page' )
		);
	
	}

	/**
	 * Render the options page for plugin
	 *
	 * @since  1.1
	 */
	public function display_options_page() {
		include_once 'partials/welcome-mobile-admin-display.php';
	}

	/**
	 * Register all related settings of this plugin
	 *
	 * @since  1.1
	 */
	public function register_setting() {
		add_settings_section(
			$this->option_name . '_general',
			__( 'General', 'welcome-mobile' ),
			array( $this, $this->option_name . '_general_cb' ),
			$this->plugin_name
		);
		add_settings_field(
			$this->option_name . '_position',
			__( 'Message position', 'welcome-mobile' ),
			array( $this, $this->option_name . '_position_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_position' )
		);
		add_settings_field(
			$this->option_name . '_close_button',
			__( 'Enable the close button', 'welcome-mobile' ),
			array( $this, $this->option_name . '_close_button_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_close_button' )
		);
		add_settings_field(
			$this->option_name . '_visibility',
			__( 'Message will be visible for', 'welcome-mobile' ),
			array( $this, $this->option_name . '_visibility_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_visibility' )
		);
		add_settings_field(
			$this->option_name . '_cookie',
			__( 'Cookie will be valid for ', 'welcome-mobile' ),
			array( $this, $this->option_name . '_cookie_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_cookie' )
		);
		add_settings_field(
			$this->option_name . '_use_default',
			__( 'Use default welcome message', 'welcome-mobile' ),
			array( $this, $this->option_name . '_use_default_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_close_button' )
		);
		add_settings_field(
			$this->option_name . '_default_message',
			__( 'Default welcome message', 'welcome-mobile' ),
			array( $this, $this->option_name . '_default_message_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_default_message' )
		);
		add_settings_field(
			$this->option_name . '_android_message',
			__( 'Android welcome message', 'welcome-mobile' ),
			array( $this, $this->option_name . '_android_message_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_android_message_cb' )
		);
		add_settings_field(
			$this->option_name . '_ios_message',
			__( 'iOS welcome message', 'welcome-mobile' ),
			array( $this, $this->option_name . '_ios_message_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_ios_message' )
		);
		add_settings_field(
			$this->option_name . '_custom_css',
			__( 'Custom CSS', 'welcome-mobile' ),
			array( $this, $this->option_name . '_custom_css_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_custom_css' )
		);
		register_setting( $this->plugin_name, $this->option_name . '_position', array( $this, $this->option_name . '_sanitize_position' ) );
		register_setting( $this->plugin_name, $this->option_name . '_visibility', 'intval' );
		register_setting( $this->plugin_name, $this->option_name . '_cookie', 'intval' );
		register_setting( $this->plugin_name, $this->option_name . '_close_button', array( $this, $this->option_name . '_sanitize_close_button' ) );
		register_setting( $this->plugin_name, $this->option_name . '_use_default', array( $this, $this->option_name . '_sanitize_use_default' ) );
		register_setting( $this->plugin_name, $this->option_name . '_default_message', array( $this, $this->option_name . '_sanitize_default_message' ) );
		register_setting( $this->plugin_name, $this->option_name . '_android_message', array( $this, $this->option_name . '_sanitize_android_message' ) );
		register_setting( $this->plugin_name, $this->option_name . '_ios_message', array( $this, $this->option_name . '_sanitize_ios_message' ) );
		register_setting( $this->plugin_name, $this->option_name . '_custom_css', array( $this, $this->option_name . '_sanitize_custom_css' ) );
	}

	/**
	 * Render the text for the general section
	 *
	 * @since  1.1
	 */
	public function welcome_mobile_general_cb() {
	}

	/**
	 * Render the radio input field for position option
	 *
	 * @since  1.1
	 */
	public function welcome_mobile_position_cb() {
		$position = get_option( $this->option_name . '_position' );
		?>
			<fieldset>
				<label>
					<input type="radio" name="<?php echo $this->option_name . '_position' ?>" id="<?php echo $this->option_name . '_position' ?>" value="top" <?php checked( $position, 'top' ); ?>>
					<?php _e( 'Top of the page', 'welcome-mobile' ); ?>
				</label>
				<br>
				<label>
					<input type="radio" name="<?php echo $this->option_name . '_position' ?>" value="bottom" <?php checked( $position, 'bottom' ); ?>>
					<?php _e( 'Bottom of the page', 'welcome-mobile' ); ?>
				</label>
			</fieldset>
		<?php
	}

	/**
	 * Render the message visibility input for this plugin
	 *
	 * @since  1.1
	 */
	public function welcome_mobile_visibility_cb() {
		$seconds = get_option( $this->option_name . '_visibility' );
		echo '<input type="number" name="' . $this->option_name . '_visibility' . '" id="' . $this->option_name . '_visibility' . '" value="' . $seconds . '"> ' . __( '(enter the number of seconds)', 'welcome-mobile' );
	}

	/**
	 * Render the cookie expiration input for this plugin
	 *
	 * @since  1.1
	 */
	public function welcome_mobile_cookie_cb() {
		$cookie = get_option( $this->option_name . '_cookie' );
		echo '<input type="number" name="' . $this->option_name . '_cookie' . '" id="' . $this->option_name . '_cookie' . '" value="' . $cookie . '"> ' . __( '(enter the number of days)', 'welcome-mobile' );
	}

	/**
	 * Render the radio input field for close button option
	 *
	 * @since  1.1
	 */
	public function welcome_mobile_close_button_cb() {
		$close_button = get_option( $this->option_name . '_close_button' );
		?>
			<fieldset>
				<label>
					<input type="radio" name="<?php echo $this->option_name . '_close_button' ?>" id="<?php echo $this->option_name . '_close_button' ?>" value="yes" <?php checked( $close_button, 'yes' ); ?>>
					<?php _e( 'Yes', 'welcome-mobile' ); ?>
				</label>
				<br>
				<label>
					<input type="radio" name="<?php echo $this->option_name . '_close_button' ?>" value="no" <?php checked( $close_button, 'no' ); ?>>
					<?php _e( 'No', 'welcome-mobile' ); ?>
				</label>
			</fieldset>
		<?php
	}

	/**
	 * Render the radio input field for use default message option
	 *
	 * @since  1.1
	 */
	public function welcome_mobile_use_default_cb() {
		$use_default = get_option( $this->option_name . '_use_default' );
		?>
			<fieldset>
				<label>
					<input type="radio" name="<?php echo $this->option_name . '_use_default' ?>" id="<?php echo $this->option_name . '_use_default' ?>" value="yes" <?php checked( $use_default, 'yes' ); ?>>
					<?php _e( 'Yes', 'welcome-mobile' ); ?>
				</label>
				<br>
				<label>
					<input type="radio" name="<?php echo $this->option_name . '_use_default' ?>" value="no" <?php checked( $use_default, 'no' ); ?>>
					<?php _e( 'No', 'welcome-mobile' ); ?>
				</label>
			</fieldset>
		<?php
	}

	/**
	 * Render the default welcome message wp_editor
	 *
	 * @since  1.1
	 */
	public function welcome_mobile_default_message_cb() {
		$default_message = get_option( $this->option_name . '_default_message' );
		echo wp_editor( $default_message, 'default_message', array('textarea_rows'=>6, 'textarea_name' => 'default_message')  );
	}

	/**
	 * Render the default welcome message wp_editor
	 *
	 * @since  1.1
	 */
	public function welcome_mobile_android_message_cb() {
		$android_message = get_option( $this->option_name . '_android_message' );
		echo wp_editor( $android_message, 'android_message', array('textarea_rows'=>6, 'textarea_name' => 'android_message')  );
	}

	/**
	 * Render the default welcome message wp_editor
	 *
	 * @since  1.1
	 */
	public function welcome_mobile_ios_message_cb() {
		$ios_message = get_option( $this->option_name . '_ios_message' );
		echo wp_editor( $ios_message, 'ios_message', array('textarea_rows'=>6, 'textarea_name' => 'ios_message')  );
	}

	/**
	 * Render the custom CSS textarea
	 *
	 * @since  1.1
	 */
	public function welcome_mobile_custom_css_cb() {
		$custom_css = get_option( $this->option_name . '_custom_css' );
		echo wp_editor( $custom_css, 'custom_css', array('textarea_rows'=>6, 'textarea_name' => 'custom_css', 'teeny' => false, 'tinymce' => false, 'quicktags' => false, 'media_buttons' => false)  );
	}

	/**
	 * Sanitize the text position value before being saved to database
	 *
	 * @param  string $position $_POST value
	 * @since  1.1
	 * @return string           Sanitized value
	 */
	public function welcome_mobile_sanitize_position( $position ) {
		if ( in_array( $position, array( 'top', 'bottom' ), true ) ) {
	        return $position;
	    }
	}
	/**
	 * Sanitize the close button value before being saved to database
	 *
	 * @param  string $close_button $_POST value
	 * @since  1.1
	 * @return string           Sanitized value
	 */
	public function welcome_mobile_sanitize_close_button( $close_button ) {
		if ( in_array( $close_button, array( 'yes', 'no' ), true ) ) {
	        return $close_button;
	    }
	}

	/**
	 * Sanitize the use default message value before being saved to database
	 *
	 * @param  string $default_message $_POST value
	 * @since  1.1
	 * @return string           Sanitized value
	 */
	public function welcome_mobile_sanitize_use_default( $use_default ) {
		if ( in_array( $use_default, array( 'yes', 'no' ), true ) ) {
	        return $use_default;
	    }
	}

	/**
	 * Sanitize the default message textarea before being saved to database
	 *
	 * @param  string $default_message $_POST value
	 * @since  1.1
	 * @return string           Sanitized value
	 */
	public function welcome_mobile_sanitize_default_message() {
		$input = wp_kses_post($_POST['default_message']);
		return $input;
	}

	/**
	 * Sanitize the android message textarea before being saved to database
	 *
	 * @param  string $android_message $_POST value
	 * @since  1.1
	 * @return string           Sanitized value
	 */
	public function welcome_mobile_sanitize_android_message() {
		$input = wp_kses_post($_POST['android_message']);
		return $input;
	}

	/**
	 * Sanitize the ios message textarea before being saved to database
	 *
	 * @param  string $ios_message $_POST value
	 * @since  1.1
	 * @return string           Sanitized value
	 */
	public function welcome_mobile_sanitize_ios_message() {
		$input = wp_kses_post($_POST['ios_message']);
		return $input;
	}

	/**
	 * Sanitize custom css before being saved to database
	 *
	 * @param  string $custom_css $_POST value
	 * @since  1.1
	 * @return string           Sanitized value
	 */
	public function welcome_mobile_sanitize_custom_css() {
		$input = wp_kses_post($_POST['custom_css']);
		return $input;
	}
 }