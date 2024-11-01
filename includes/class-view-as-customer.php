<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.programmelab.com
 * @since      1.0.0
 *
 * @package    View_As_Customer
 * @subpackage View_As_Customer/includes
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
 * @since      1.0.0
 * @package    View_As_Customer
 * @subpackage View_As_Customer/includes
 * @author     Programmelab <rizvi@programmelab.com>
 */
class View_As_Customer
{

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      View_As_Customer_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
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
	 * @since    1.0.0
	 */
	public function __construct()
	{
		if (defined('VIEW_AS_CUSTOMER_VERSION')) {
			$this->version = VIEW_AS_CUSTOMER_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'view-as-customer';

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
	 * - View_As_Customer_Loader. Orchestrates the hooks of the plugin.
	 * - View_As_Customer_i18n. Defines internationalization functionality.
	 * - View_As_Customer_Admin. Defines all hooks for the admin area.
	 * - View_As_Customer_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies()
	{

		require_once(ABSPATH . 'wp-admin/includes/plugin.php');
		$view_as_customer_api_settings = get_option('view_as_customer_api_settings') ? get_option('view_as_customer_api_settings') : [];

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-view-as-customer-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-view-as-customer-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-view-as-customer-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-view-as-customer-public.php';
		/**
		 * User Switching
		 */
		if (is_plugin_active('woocommerce/woocommerce.php') && (isset($view_as_customer_api_settings["settings_enable"]) && $view_as_customer_api_settings["settings_enable"])) {
			require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-view-as-customer-user-switching.php';
		}

		$this->loader = new View_As_Customer_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the View_As_Customer_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale()
	{

		$plugin_i18n = new View_As_Customer_i18n();

		$this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks()
	{

		$plugin_admin = new View_As_Customer_Admin($this->get_plugin_name(), $this->get_version());
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');

		if (is_plugin_active('woocommerce/woocommerce.php')) {

			$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');

			// Add menu item
			$this->loader->add_action('admin_menu', $plugin_admin, 'view_as_customer_admin_menu');
			// Add body class
			$this->loader->add_filter('admin_body_class', $plugin_admin, 'view_as_customer_admin_body_class');
			// Save settings
			$this->loader->add_filter('admin_head', $plugin_admin, 'view_as_customer_save_settings');
			// Save settings by ajax
			$this->loader->add_action('wp_ajax_view_as_customer_save_settings_ajax', $plugin_admin, 'view_as_customer_save_settings_ajax');
			$this->loader->add_action('wp_ajax_nopriv_view_as_customer_save_settings_ajax', $plugin_admin, 'view_as_customer_save_settings_ajax');
			// Redirect to setting page after instalation
			$this->loader->add_action('admin_init', $plugin_admin, 'view_as_customer_do_activation_redirect');

			// Add Settings link to the plugin
			$plugin_basename = plugin_basename(plugin_dir_path(__DIR__) . $this->plugin_name . '.php');
			$this->loader->add_filter('plugin_action_links_' . $plugin_basename, $plugin_admin, 'view_as_customer_add_action_links');
		} else {
			$this->loader->add_action('admin_notices', $plugin_admin, 'view_as_customer_woo_check');
			add_action("wp_ajax_view_as_customer_ajax_install_plugin", "wp_ajax_install_plugin");
		}
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks()
	{

		$plugin_public = new View_As_Customer_Public($this->get_plugin_name(), $this->get_version());
		if (is_plugin_active('woocommerce/woocommerce.php')) {
			$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
			$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
		}
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run()
	{
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name()
	{
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    View_As_Customer_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader()
	{
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version()
	{
		return $this->version;
	}
}
