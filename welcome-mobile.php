<?php

/**
 * @link              http://matijaculjak.com
 * @since             1.0.0
 * @package           Welcome_Mobile
 *
 * @wordpress-plugin
 * Plugin Name:       Welcome! Mobile
 * Plugin URI:        https://wordpress.org/plugins/welcome-mobile/
 * Description:       Display a welcome message to users browsing your site on smartphones.
 * Version:           1.1.1
 * Author:            Matija Culjak
 * Author URI:        http://matijaculjak.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       welcome-mobile
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-welcome-mobile-activator.php
 */
function activate_welcome_mobile() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-welcome-mobile-activator.php';
	Welcome_Mobile_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-welcome-mobile-deactivator.php
 */
function deactivate_welcome_mobile() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-welcome-mobile-deactivator.php';
	Welcome_Mobile_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_welcome_mobile' );
register_deactivation_hook( __FILE__, 'deactivate_welcome_mobile' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-welcome-mobile.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.1
 */
function run_welcome_mobile() {

	$plugin = new Welcome_Mobile();
	$plugin->run();

}
run_welcome_mobile();
