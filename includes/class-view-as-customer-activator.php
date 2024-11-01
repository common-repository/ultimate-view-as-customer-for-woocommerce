<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.programmelab.com
 * @since      1.0.0
 *
 * @package    View_As_Customer
 * @subpackage View_As_Customer/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    View_As_Customer
 * @subpackage View_As_Customer/includes
 * @author     Programmelab <rizvi@programmelab.com>
 */
class View_As_Customer_Activator
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
		$view_as_customer_api_settings = [
			"settings_enable" => 1,
			"fontend_enable" => 1,
		];
		update_option('view_as_customer_api_settings', $view_as_customer_api_settings);
		add_option('view_as_customer_do_activation_redirect', true);
	}
}
