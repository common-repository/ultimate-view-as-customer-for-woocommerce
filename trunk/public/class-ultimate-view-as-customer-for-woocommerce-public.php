<?php
// If this file is called directly, abort.
if (!defined('ABSPATH')) exit;
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.programmelab.com
 * @since      1.0.0
 *
 * @package    Ultimate_View_As_Customer_For_Woocommerce
 * @subpackage Ultimate_View_As_Customer_For_Woocommerce/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Ultimate_View_As_Customer_For_Woocommerce
 * @subpackage Ultimate_View_As_Customer_For_Woocommerce/public
 * @author     Programmelab <rizvi@programmelab.com>
 */
class Ultimate_View_As_Customer_For_Woocommerce_Public
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ultimate_View_As_Customer_For_Woocommerce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ultimate_View_As_Customer_For_Woocommerce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__DIR__) . 'assets/css/ultimate-view-as-customer-for-woocommerce.css', array(), $this->version, 'all');

		wp_enqueue_style($this->plugin_name . '-public', plugin_dir_url(__FILE__) . 'css/ultimate-view-as-customer-for-woocommerce-public.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ultimate_View_As_Customer_For_Woocommerce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ultimate_View_As_Customer_For_Woocommerce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script($this->plugin_name . '-ajax', plugin_dir_url(__DIR__) . 'assets/js/ultimate-view-as-customer-for-woocommerce-ajax.js', array('jquery'), $this->version, false);

		$ultimate_view_as_customer_for_woocommerce_ajax_params = array(
			'ajax_url' => admin_url('admin-ajax.php'),
			'ultimate_view_as_customer_for_woocommerce_security' => esc_attr(wp_create_nonce('ultimate_view_as_customer_for_woocommerce_security_nonce')),
			'ultimate_view_as_customer_for_woocommerce_install_plugin_wpnonce' => esc_attr(wp_create_nonce('updates')),
		);
		wp_localize_script($this->plugin_name . '-ajax', 'ultimate_view_as_customer_for_woocommerce_ajax_obj', $ultimate_view_as_customer_for_woocommerce_ajax_params);


		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/ultimate-view-as-customer-for-woocommerce-public.js', array('jquery'), $this->version, false);
	}
}
