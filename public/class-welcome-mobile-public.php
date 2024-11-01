<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://matijaculjak.com
 * @since      1.1
 *
 * @package    Welcome_Mobile
 * @subpackage Welcome_Mobile/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Welcome_Mobile
 * @subpackage Welcome_Mobile/public
 * @author     Matija Culjak <matija.culjak@gmail.com>
 */
class Welcome_Mobile_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $option_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->option_name = $option_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.1
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name . '-public-css', plugin_dir_url( __FILE__ ) . 'css/welcome-mobile-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.1
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name . '-js-cookie', plugin_dir_url( __FILE__ ) . 'js/welcome-mobile-public-js-cookie.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name . '-custom-js', plugin_dir_url( __FILE__ ) . 'js/welcome-mobile-public.js', array( 'jquery' ), $this->version, true );
	}

	/**
	 * Output the Welcome! Mobile public-facing snippet.
	 *
	 * @since    1.1
	 */
	public function wm_snippet() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/welcome-mobile-public-display.php';
	}

	/**
	 * Output the Welcome! Mobile public-facing custom CSS.
	 *
	 * @since    1.1
	 */
	public function welcome_mobile_print_custom_css() {
		echo '<style>' . get_option( $this->option_name . '_custom_css') . '</style>';
	}	

}
