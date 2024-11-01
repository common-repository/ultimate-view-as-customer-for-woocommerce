<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.programmelab.com
 * @since      1.0.0
 *
 * @package    View_As_Customer
 * @subpackage View_As_Customer/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    View_As_Customer
 * @subpackage View_As_Customer/admin
 * @author     Programmelab <rizvi@programmelab.com>
 */
class View_As_Customer_Admin
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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in View_As_Customer_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The View_As_Customer_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style('hint-css', plugin_dir_url(__FILE__) . 'plugins/cool-hint-css/src/hint.css', array(), $this->version, 'all');

		wp_enqueue_style($this->plugin_name . '-grid', plugin_dir_url(__FILE__) . 'css/grid.css', array(), $this->version, 'all');
		wp_enqueue_style($this->plugin_name . '-utilities', plugin_dir_url(__FILE__) . 'css/utilities.css', array(), $this->version, 'all');

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__DIR__) . 'assets/css/view-as-customer.css', array(), $this->version, 'all');

		wp_enqueue_style($this->plugin_name . '-admin', plugin_dir_url(__FILE__) . 'css/view-as-customer-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in View_As_Customer_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The View_As_Customer_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script($this->plugin_name . '-ajax', plugin_dir_url(__DIR__) . 'assets/js/view-as-customer-ajax.js', array('jquery'), $this->version, false);

		$view_as_customer_ajax_params = array(
			'ajax_url' => admin_url('admin-ajax.php'),
			'view_as_customer_security' => esc_attr(wp_create_nonce('view_as_customer_security_nonce')),
			'view_as_customer_install_plugin_wpnonce' => esc_attr(wp_create_nonce('updates')),
		);
		wp_localize_script($this->plugin_name . '-ajax', 'view_as_customer_ajax_obj', $view_as_customer_ajax_params);
		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/view-as-customer-admin.js', array('jquery'), $this->version, false);
	}


	public function view_as_customer_woo_check()
	{

		if (current_user_can('activate_plugins')) {
			if (!is_plugin_active('woocommerce/woocommerce.php') && !file_exists(WP_PLUGIN_DIR . '/woocommerce/woocommerce.php')) {
?>
				<div id="message" class="error">
					<?php /* translators: %1$s: WooCommerce plugin url start, %2$s: WooCommerce plugin url end */ ?>
					<p><?php printf(esc_html__('%1$s requires %2$s WooCommerce %3$s to be activated.', 'view-as-customer'), esc_html(VIEW_AS_CUSTOMER_NAME), '<strong><a href="https://wordpress.org/plugins/woocommerce/" target="_blank">', '</a></strong>'); ?></p>
					<p><a id="view_as_customer_wooinstall" class="install-now button" data-plugin-slug="woocommerce"><?php esc_html_e('Install Now', 'view-as-customer'); ?></a></p>
				</div>



			<?php
			} elseif (!is_plugin_active('woocommerce/woocommerce.php') && file_exists(WP_PLUGIN_DIR . '/woocommerce/woocommerce.php')) {
			?>

				<div id="message" class="error">
					<?php /* translators: %1$s: WooCommerce plugin url start, %2$s: WooCommerce plugin url end */ ?>
					<p><?php printf(esc_html__('%1$s requires %2$s WooCommerce %3$s to be activated.', 'view-as-customer'), esc_html(VIEW_AS_CUSTOMER_NAME), '<strong><a href="https://wordpress.org/plugins/woocommerce/" target="_blank">', '</a></strong>'); ?></p>
					<p><a href="<?php echo esc_url(get_admin_url()); ?>plugins.php?_wpnonce=<?php echo esc_attr(wp_create_nonce('activate-plugin_woocommerce/woocommerce.php')); ?>&action=activate&plugin=woocommerce/woocommerce.php" class="button activate-now button-primary"><?php esc_html_e('Activate', 'view-as-customer'); ?></a></p>
				</div>
			<?php
			} elseif (version_compare(get_option('woocommerce_db_version'), '2.5', '<')) {
			?>

				<div id="message" class="error">
					<?php /* translators: %1$s: strong tag start, %2$s: strong tag end, %3$s: plugin url start, %4$s: plugin url end */ ?>
					<p><?php printf(esc_html__('%1$s %2$s is inactive.%3$s This plugin requires WooCommerce 2.5 or newer. Please %4$supdate WooCommerce to version 2.5 or newer%4$s', 'view-as-customer'), esc_html(VIEW_AS_CUSTOMER_NAME), '<strong>', '</strong>', '<a href="' . esc_url(admin_url('plugins.php')) . '">', '&nbsp;&raquo;</a>'); ?></p>
				</div>

<?php
			}
		}
	}

	public function view_as_customer_admin_body_class($classes)
	{
		$current_screen = get_current_screen();
		// var_dump($current_screen->id);
		if ($current_screen->id == 'toplevel_page_view-as-customer') {
			$classes .= 'view-as-customer-settings-admin-page';
		}
		return $classes;
	}
	public function view_as_customer_admin_menu()
	{
		add_menu_page(
			esc_html__('Ultimate View as Customer for WooCommerce', 'view-as-customer'),
			sprintf(esc_html__('Ultimate View %1$s As Customer', 'view-as-customer'), '<br/>'),
			'manage_options',
			$this->plugin_name,
			array($this, 'view_as_customer_dashboard_page_html'),
			plugin_dir_url(__DIR__) . 'admin/images/icon.svg',
			56
		);
	}
	public function view_as_customer_dashboard_page_html()
	{
		// echo 'Ultimate View as Customer for WooCommerce';
		include_once('partials/' . $this->plugin_name . '-admin-display.php');
	}
	public function view_as_customer_save_settings()
	{
		if (!isset($_POST['view_as_customer_form_field']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['view_as_customer_form_field'])), 'view_as_customer_form_action')) {
			return;
		}
		$view_as_customer_api_settings = get_option('view_as_customer_api_settings') ? get_option('view_as_customer_api_settings') : [];

		if (isset($_POST['view_as_customer_api_settings']['settings_enable'])) {
			$view_as_customer_api_settings['settings_enable'] = 1;
		} else {
			$view_as_customer_api_settings['settings_enable'] = '';
		}

		if (isset($_POST['view_as_customer_api_settings']['fontend_enable'])) {
			$view_as_customer_api_settings['fontend_enable'] = 1;
		} else {
			$view_as_customer_api_settings['fontend_enable'] = '';
		}
		update_option('view_as_customer_api_settings', $this->view_as_customer_recursive_sanitize_array_field($view_as_customer_api_settings));
	}
	public function view_as_customer_save_settings_ajax()
	{
		// parse_str($_POST['form_data'], $form_data);
		if (!wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['view_as_customer_security'])), 'view_as_customer_security_nonce')) {
			wp_send_json_error('Nonce validation failed.');
			die();
		}
		// $raw_data = wp_kses_post($_POST['form_data']);
		// var_dump($_POST['form_data']);
		// echo '<hr/>';
		// var_dump(trim($raw_data));
		// die();
		// parse_str(wp_unslash($_POST['form_data']), $form_data);

		// var_dump($_POST);
		$settings_enable = sanitize_text_field(wp_unslash($_POST['settings_enable']));
		$fontend_enable = sanitize_text_field(wp_unslash($_POST['fontend_enable']));

		$view_as_customer_api_settings = get_option('view_as_customer_api_settings') ? get_option('view_as_customer_api_settings') : [];
		/*
		if (isset($form_data['view_as_customer_api_settings']['settings_enable'])) {
			$view_as_customer_api_settings['settings_enable'] = 1;
		} else {
			$view_as_customer_api_settings['settings_enable'] = '';
		}

		if (isset($form_data['view_as_customer_api_settings']['fontend_enable'])) {
			$view_as_customer_api_settings['fontend_enable'] = 1;
		} else {
			$view_as_customer_api_settings['fontend_enable'] = '';
		}
		*/
		$view_as_customer_api_settings = [
			'settings_enable' => $settings_enable,
			'fontend_enable' => $fontend_enable
		];
		update_option('view_as_customer_api_settings', $this->view_as_customer_recursive_sanitize_array_field($view_as_customer_api_settings));

		// $option_name = esc_html($_POST['option_name']);
		// $option_value = $this->view_as_customer_recursive_sanitize_array_field($form_data[$_POST['option_name']]);
		// update_option($option_name, $option_value);
		$ret = array('success' => true);
		die(wp_json_encode($ret));
		// die(wp_json_encode($form_data));
	}
	//Redirect to setting page
	public function view_as_customer_do_activation_redirect()
	{
		if (get_option('view_as_customer_do_activation_redirect')) {
			delete_option('view_as_customer_do_activation_redirect');
			wp_safe_redirect(admin_url('admin.php?page=' . $this->plugin_name));
		}
	}

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	public function view_as_customer_add_action_links($links)
	{

		/**
		 * Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
		 * The "plugins.php" must match with the previously added add_submenu_page first option.
		 * For custom post type you have to change 'plugins.php?page=' to 'edit.php?post_type=your_custom_post_type&page='
		 */
		$settings_link = array('<a href="' . admin_url('admin.php?page=' . $this->plugin_name) . '">' . esc_html__('Settings', 'view-as-customer') . '</a>',);

		return array_merge($settings_link, $links);
	}
	/**
	 * Recursive sanitation for an array
	 * 
	 * @param $array
	 *
	 * @return mixed
	 */
	public function view_as_customer_recursive_sanitize_array_field($array)
	{
		foreach ($array as $key => &$value) {
			if (is_array($value)) {
				$value = $this->view_as_customer_recursive_sanitize_array_field($value);
			} else {
				if ($key == 'editor')
					$value = wp_kses_post($value);
				elseif ($key == 'url')
					$value = sanitize_url($value);
				elseif ($key == 'id')
					$value = sanitize_text_field(filter_var($value, FILTER_SANITIZE_NUMBER_INT));
				else
					$value = sanitize_text_field($value);
			}
		}

		return $array;
	}
}
