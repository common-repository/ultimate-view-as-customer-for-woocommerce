<?php
// If this file is called directly, abort.
if (!defined('ABSPATH')) exit;
/**
 * Fired during plugin activation
 *
 * @link       https://www.programmelab.com
 * @since      1.0.0
 *
 * @package    Ultimate_View_As_Customer_For_Woocommerce
 * @subpackage Ultimate_View_As_Customer_For_Woocommerce/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Ultimate_View_As_Customer_For_Woocommerce
 * @subpackage Ultimate_View_As_Customer_For_Woocommerce/includes
 * @author     Programmelab <rizvi@programmelab.com>
 */
class Ultimate_View_As_Customer_For_Woocommerce_Activator
{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate()
	{
		$ultimate_view_as_customer_for_woocommerce_api_settings = [
			"settings_enable" => 1,
			"fontend_enable" => 1,
		];
		update_option('ultimate_view_as_customer_for_woocommerce_api_settings', $ultimate_view_as_customer_for_woocommerce_api_settings);
		add_option('ultimate_view_as_customer_for_woocommerce_do_activation_redirect', true);
	}
}
