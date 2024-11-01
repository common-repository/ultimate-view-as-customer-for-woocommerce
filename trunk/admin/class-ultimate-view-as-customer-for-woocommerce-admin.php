<?php
// If this file is called directly, abort.
if (!defined('ABSPATH')) exit;
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.programmelab.com
 * @since      1.0.0
 *
 * @package    Ultimate_View_As_Customer_For_Woocommerce
 * @subpackage Ultimate_View_As_Customer_For_Woocommerce/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ultimate_View_As_Customer_For_Woocommerce
 * @subpackage Ultimate_View_As_Customer_For_Woocommerce/admin
 * @author     Programmelab <rizvi@programmelab.com>
 */
class Ultimate_View_As_Customer_For_Woocommerce_Admin
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
		 * defined in Ultimate_View_As_Customer_For_Woocommerce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ultimate_View_As_Customer_For_Woocommerce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style('hint-css', plugin_dir_url(__FILE__) . 'plugins/cool-hint-css/src/hint.css', array(), $this->version, 'all');

		wp_enqueue_style($this->plugin_name . '-grid', plugin_dir_url(__FILE__) . 'css/grid.css', array(), $this->version, 'all');
		wp_enqueue_style($this->plugin_name . '-utilities', plugin_dir_url(__FILE__) . 'css/utilities.css', array(), $this->version, 'all');

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__DIR__) . 'assets/css/ultimate-view-as-customer-for-woocommerce.css', array(), $this->version, 'all');

		wp_enqueue_style($this->plugin_name . '-admin', plugin_dir_url(__FILE__) . 'css/ultimate-view-as-customer-for-woocommerce-admin.css', array(), $this->version, 'all');
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
		
		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/ultimate-view-as-customer-for-woocommerce-admin.js', array('jquery'), $this->version, false);
	}


	public function ultimate_view_as_customer_for_woocommerce_woo_check()
	{

		if (current_user_can('activate_plugins')) {
			if (!is_plugin_active('woocommerce/woocommerce.php') && !file_exists(WP_PLUGIN_DIR . '/woocommerce/woocommerce.php')) {
?>
				<div id="message" class="error">
					<?php /* translators: %1$s: WooCommerce plugin url start, %2$s: WooCommerce plugin url end */ ?>
					<p><?php printf(esc_html__('%1$s requires %2$s WooCommerce %3$s to be activated.', 'ultimate-view-as-customer-for-woocommerce'), esc_html(ULTIMATE_VIEW_AS_CUSTOMER_FOR_WOOCOMMERCE_NAME), '<strong><a href="https://wordpress.org/plugins/woocommerce/" target="_blank">', '</a></strong>'); ?></p>
					<p><a id="ultimate_view_as_customer_for_woocommerce_wooinstall" class="install-now button" data-plugin-slug="woocommerce"><?php esc_html_e('Install Now', 'ultimate-view-as-customer-for-woocommerce'); ?></a></p>
				</div>



			<?php
			} elseif (!is_plugin_active('woocommerce/woocommerce.php') && file_exists(WP_PLUGIN_DIR . '/woocommerce/woocommerce.php')) {
			?>

				<div id="message" class="error">
					<?php /* translators: %1$s: WooCommerce plugin url start, %2$s: WooCommerce plugin url end */ ?>
					<p><?php printf(esc_html__('%1$s requires %2$s WooCommerce %3$s to be activated.', 'ultimate-view-as-customer-for-woocommerce'), esc_html(ULTIMATE_VIEW_AS_CUSTOMER_FOR_WOOCOMMERCE_NAME), '<strong><a href="https://wordpress.org/plugins/woocommerce/" target="_blank">', '</a></strong>'); ?></p>
					<p><a href="<?php echo esc_url(get_admin_url()); ?>plugins.php?_wpnonce=<?php echo esc_attr(wp_create_nonce('activate-plugin_woocommerce/woocommerce.php')); ?>&action=activate&plugin=woocommerce/woocommerce.php" class="button activate-now button-primary"><?php esc_html_e('Activate', 'ultimate-view-as-customer-for-woocommerce'); ?></a></p>
				</div>
			<?php
			} elseif (version_compare(get_option('woocommerce_db_version'), '2.5', '<')) {
			?>

				<div id="message" class="error">
					<?php /* translators: %1$s: strong tag start, %2$s: strong tag end, %3$s: plugin url start, %4$s: plugin url end */ ?>
					<p><?php printf(esc_html__('%1$s %2$s is inactive.%3$s This plugin requires WooCommerce 2.5 or newer. Please %4$supdate WooCommerce to version 2.5 or newer%4$s', 'ultimate-view-as-customer-for-woocommerce'), esc_html(ULTIMATE_VIEW_AS_CUSTOMER_FOR_WOOCOMMERCE_NAME), '<strong>', '</strong>', '<a href="' . esc_url(admin_url('plugins.php')) . '">', '&nbsp;&raquo;</a>'); ?></p>
				</div>

<?php
			}
		}
	}

	public function ultimate_view_as_customer_for_woocommerce_admin_body_class($classes)
	{
		$current_screen = get_current_screen();
		// var_dump($current_screen->id);
		if ($current_screen->id == 'toplevel_page_ultimate-view-as-customer-for-woocommerce') {
			$classes .= 'ultimate-view-as-customer-for-woocommerce-settings-admin-page';
		}
		return $classes;
	}
	public function ultimate_view_as_customer_for_woocommerce_admin_menu()
	{
		add_menu_page(
			esc_html__('Ultimate View as Customer for Woocommerce', 'ultimate-view-as-customer-for-woocommerce'),
			sprintf(esc_html__('Ultimate View %1$s As Customer', 'ultimate-view-as-customer-for-woocommerce'), '<br/>'),
			'manage_options',
			$this->plugin_name,
			array($this, 'ultimate_view_as_customer_for_woocommerce_dashboard_page_html'),
			plugin_dir_url(__DIR__) . 'admin/images/icon.svg',
			56
		);
	}
	public function ultimate_view_as_customer_for_woocommerce_dashboard_page_html()
	{
		// echo 'Ultimate View as Customer for Woocommerce';
		include_once('partials/' . $this->plugin_name . '-admin-display.php');
	}
	public function ultimate_view_as_customer_for_woocommerce_save_settings()
	{
		if (!isset($_POST['ultimate_view_as_customer_for_woocommerce_form_field']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['ultimate_view_as_customer_for_woocommerce_form_field'])), 'ultimate_view_as_customer_for_woocommerce_form_action')) {
			return;
		}
		$ultimate_view_as_customer_for_woocommerce_api_settings = get_option('ultimate_view_as_customer_for_woocommerce_api_settings') ? get_option('ultimate_view_as_customer_for_woocommerce_api_settings') : [];

		if (isset($_POST['ultimate_view_as_customer_for_woocommerce_api_settings']['settings_enable'])) {
			$ultimate_view_as_customer_for_woocommerce_api_settings['settings_enable'] = 1;
		} else {
			$ultimate_view_as_customer_for_woocommerce_api_settings['settings_enable'] = '';
		}

		if (isset($_POST['ultimate_view_as_customer_for_woocommerce_api_settings']['fontend_enable'])) {
			$ultimate_view_as_customer_for_woocommerce_api_settings['fontend_enable'] = 1;
		} else {
			$ultimate_view_as_customer_for_woocommerce_api_settings['fontend_enable'] = '';
		}
		update_option('ultimate_view_as_customer_for_woocommerce_api_settings', $this->ultimate_view_as_customer_for_woocommerce_recursive_sanitize_array_field($ultimate_view_as_customer_for_woocommerce_api_settings));
	}
	public function ultimate_view_as_customer_for_woocommerce_save_settings_ajax()
	{
		// parse_str($_POST['form_data'], $form_data);
		if (!wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['ultimate_view_as_customer_for_woocommerce_security'])), 'ultimate_view_as_customer_for_woocommerce_security_nonce')) {
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

		$ultimate_view_as_customer_for_woocommerce_api_settings = get_option('ultimate_view_as_customer_for_woocommerce_api_settings') ? get_option('ultimate_view_as_customer_for_woocommerce_api_settings') : [];
		/*
		if (isset($form_data['ultimate_view_as_customer_for_woocommerce_api_settings']['settings_enable'])) {
			$ultimate_view_as_customer_for_woocommerce_api_settings['settings_enable'] = 1;
		} else {
			$ultimate_view_as_customer_for_woocommerce_api_settings['settings_enable'] = '';
		}

		if (isset($form_data['ultimate_view_as_customer_for_woocommerce_api_settings']['fontend_enable'])) {
			$ultimate_view_as_customer_for_woocommerce_api_settings['fontend_enable'] = 1;
		} else {
			$ultimate_view_as_customer_for_woocommerce_api_settings['fontend_enable'] = '';
		}
		*/
		$ultimate_view_as_customer_for_woocommerce_api_settings = [
			'settings_enable' => $settings_enable,
			'fontend_enable' => $fontend_enable
		];
		update_option('ultimate_view_as_customer_for_woocommerce_api_settings', $this->ultimate_view_as_customer_for_woocommerce_recursive_sanitize_array_field($ultimate_view_as_customer_for_woocommerce_api_settings));

		// $option_name = esc_html($_POST['option_name']);
		// $option_value = $this->ultimate_view_as_customer_for_woocommerce_recursive_sanitize_array_field($form_data[$_POST['option_name']]);
		// update_option($option_name, $option_value);
		$ret = array('success' => true);
		die(wp_json_encode($ret));
		// die(wp_json_encode($form_data));
	}
	//Redirect to setting page
	public function ultimate_view_as_customer_for_woocommerce_do_activation_redirect()
	{
		if (get_option('ultimate_view_as_customer_for_woocommerce_do_activation_redirect')) {
			delete_option('ultimate_view_as_customer_for_woocommerce_do_activation_redirect');
			wp_safe_redirect(admin_url('admin.php?page=' . $this->plugin_name));
		}
	}

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	public function ultimate_view_as_customer_for_woocommerce_add_action_links($links)
	{

		/**
		 * Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
		 * The "plugins.php" must match with the previously added add_submenu_page first option.
		 * For custom post type you have to change 'plugins.php?page=' to 'edit.php?post_type=your_custom_post_type&page='
		 */
		$settings_link = array('<a href="' . admin_url('admin.php?page=' . $this->plugin_name) . '">' . esc_html__('Settings', 'ultimate-view-as-customer-for-woocommerce') . '</a>',);

		return array_merge($settings_link, $links);
	}
	/**
	 * Recursive sanitation for an array
	 * 
	 * @param $array
	 *
	 * @return mixed
	 */
	public function ultimate_view_as_customer_for_woocommerce_recursive_sanitize_array_field($array)
	{
		foreach ($array as $key => &$value) {
			if (is_array($value)) {
				$value = $this->ultimate_view_as_customer_for_woocommerce_recursive_sanitize_array_field($value);
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
