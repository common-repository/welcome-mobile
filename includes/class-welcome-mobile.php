<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://matijaculjak.com
 * @since      1.1
 *
 * @package    Welcome_Mobile
 * @subpackage Welcome_Mobile/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.1
 * @package    Welcome_Mobile
 * @subpackage Welcome_Mobile/includes
 * @author     Matija Culjak <matija.culjak@gmail.com>
 */
class Welcome_Mobile {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.1
	 * @access   protected
	 * @var      Welcome_Mobile_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.1
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The options name to be used in this plugin
	 *
	 * @since  	1.0.0
	 * @access 	protected
	 * @var  	string 		$option_name 	Option name of this plugin
	 */
	protected $option_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.1
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.1
	 */
	public function __construct() {

		$this->plugin_name = 'welcome-mobile';
		$this->option_name = 'welcome_mobile';
		$this->version = '1.1';
		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Welcome_Mobile_Loader. Orchestrates the hooks of the plugin.
	 * - Welcome_Mobile_i18n. Defines internationalization functionality.
	 * - Welcome_Mobile_Admin. Defines all hooks for the admin area.
	 * - Welcome_Mobile_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.1
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-welcome-mobile-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-welcome-mobile-i18n.php';

		/**
		 * The class responsible for detecting mobile user agents on the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-welcome-mobile-mobile-detect.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-welcome-mobile-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-welcome-mobile-public.php';

		$this->loader = new Welcome_Mobile_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Welcome_Mobile_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.1
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Welcome_Mobile_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.1
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Welcome_Mobile_Admin( $this->get_plugin_name(), $this->get_option_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_options_page' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'register_setting' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.1
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Welcome_Mobile_Public( $this->get_plugin_name(), $this->get_option_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'wp_footer', $plugin_public, 'wm_snippet' );
		$this->loader->add_action( 'wp_head', $plugin_public, 'welcome_mobile_print_custom_css' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.1
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.1
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The name of the plugin option(s) used to uniquely identify them within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.1
	 * @return    string    The name of the plugin option(s).
	 */
	public function get_option_name() {
		return $this->option_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.1
	 * @return    Welcome_Mobile_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.1
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
}