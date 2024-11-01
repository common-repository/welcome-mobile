<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://matijaculjak.com
 * @since      1.1
 *
 * @package    Welcome_Mobile
 * @subpackage Welcome_Mobile/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.1
 * @package    Welcome_Mobile
 * @subpackage Welcome_Mobile/includes
 * @author     Matija Culjak <matija.culjak@gmail.com>
 */
class Welcome_Mobile_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.1
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'welcome-mobile',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
