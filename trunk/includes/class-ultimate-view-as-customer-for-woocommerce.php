<?php
// If this file is called directly, abort.
if (!defined('ABSPATH')) exit;
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.programmelab.com
 * @since      1.0.0
 *
 * @package    Ultimate_View_As_Customer_For_Woocommerce
 * @subpackage Ultimate_View_As_Customer_For_Woocommerce/includes
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
 * @package    Ultimate_View_As_Customer_For_Woocommerce
 * @subpackage Ultimate_View_As_Customer_For_Woocommerce/includes
 * @author     Programmelab <rizvi@programmelab.com>
 */
class Ultimate_View_As_Customer_For_Woocommerce
{

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Ultimate_View_As_Customer_For_Woocommerce_Loader    $loader    Maintains and registers all hooks for the plugin.
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
		if (defined('ULTIMATE_VIEW_AS_CUSTOMER_FOR_WOOCOMMERCE_VERSION')) {
			$this->version = ULTIMATE_VIEW_AS_CUSTOMER_FOR_WOOCOMMERCE_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'ultimate-view-as-customer-for-woocommerce';

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
	 * - Ultimate_View_As_Customer_For_Woocommerce_Loader. Orchestrates the hooks of the plugin.
	 * - Ultimate_View_As_Customer_For_Woocommerce_i18n. Defines internationalization functionality.
	 * - Ultimate_View_As_Customer_For_Woocommerce_Admin. Defines all hooks for the admin area.
	 * - Ultimate_View_As_Customer_For_Woocommerce_Public. Defines all hooks for the public side of the site.
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
		$ultimate_view_as_customer_for_woocommerce_api_settings = get_option('ultimate_view_as_customer_for_woocommerce_api_settings') ? get_option('ultimate_view_as_customer_for_woocommerce_api_settings') : [];

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-ultimate-view-as-customer-for-woocommerce-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-ultimate-view-as-customer-for-woocommerce-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-ultimate-view-as-customer-for-woocommerce-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-ultimate-view-as-customer-for-woocommerce-public.php';
		/**
		 * User Switching
		 */
		if (is_plugin_active('woocommerce/woocommerce.php') && (isset($ultimate_view_as_customer_for_woocommerce_api_settings["settings_enable"]) && $ultimate_view_as_customer_for_woocommerce_api_settings["settings_enable"])) {
			require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-ultimate-view-as-customer-for-woocommerce-user-switching.php';
		}

		$this->loader = new Ultimate_View_As_Customer_For_Woocommerce_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Ultimate_View_As_Customer_For_Woocommerce_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale()
	{

		$plugin_i18n = new Ultimate_View_As_Customer_For_Woocommerce_i18n();

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

		$plugin_admin = new Ultimate_View_As_Customer_For_Woocommerce_Admin($this->get_plugin_name(), $this->get_version());
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');

		if (is_plugin_active('woocommerce/woocommerce.php')) {

			$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');

			// Add menu item
			$this->loader->add_action('admin_menu', $plugin_admin, 'ultimate_view_as_customer_for_woocommerce_admin_menu');
			// Add body class
			$this->loader->add_filter('admin_body_class', $plugin_admin, 'ultimate_view_as_customer_for_woocommerce_admin_body_class');
			// Save settings
			$this->loader->add_filter('admin_head', $plugin_admin, 'ultimate_view_as_customer_for_woocommerce_save_settings');
			// Save settings by ajax
			$this->loader->add_action('wp_ajax_ultimate_view_as_customer_for_woocommerce_save_settings_ajax', $plugin_admin, 'ultimate_view_as_customer_for_woocommerce_save_settings_ajax');
			$this->loader->add_action('wp_ajax_nopriv_ultimate_view_as_customer_for_woocommerce_save_settings_ajax', $plugin_admin, 'ultimate_view_as_customer_for_woocommerce_save_settings_ajax');
			// Redirect to setting page after instalation
			$this->loader->add_action('admin_init', $plugin_admin, 'ultimate_view_as_customer_for_woocommerce_do_activation_redirect');

			// Add Settings link to the plugin
			$plugin_basename = plugin_basename(plugin_dir_path(__DIR__) . $this->plugin_name . '.php');
			$this->loader->add_filter('plugin_action_links_' . $plugin_basename, $plugin_admin, 'ultimate_view_as_customer_for_woocommerce_add_action_links');
		} else {
			$this->loader->add_action('admin_notices', $plugin_admin, 'ultimate_view_as_customer_for_woocommerce_woo_check');
			add_action("wp_ajax_ultimate_view_as_customer_for_woocommerce_ajax_install_plugin", "wp_ajax_install_plugin");
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

		$plugin_public = new Ultimate_View_As_Customer_For_Woocommerce_Public($this->get_plugin_name(), $this->get_version());
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
	 * @return    Ultimate_View_As_Customer_For_Woocommerce_Loader    Orchestrates the hooks of the plugin.
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
