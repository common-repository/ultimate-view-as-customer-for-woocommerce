<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.programmelab.com
 * @since             1.0.0
 * @package           Ultimate_View_As_Customer_For_Woocommerce
 *
 * @wordpress-plugin
 * Plugin Name:       Ultimate View as Customer for Woocommerce
 * Plugin URI:        https://www.programmelab.com/ultimate-view-as-customer-for-woocommerce
 * Description:       Ultimate View as Customer for Woocommerce, WooCommerce extension allows the administrators of a WooCommerce site, to quickie switch their current role to view as their specified customer and check if everything is working properly for them.
 * Version:           1.0.3
 * Author:            Programmelab
 * Author URI:        https://www.programmelab.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ultimate-view-as-customer-for-woocommerce
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('ABSPATH')) exit;

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('ULTIMATE_VIEW_AS_CUSTOMER_FOR_WOOCOMMERCE_VERSION', '1.0.3');
define('ULTIMATE_VIEW_AS_CUSTOMER_FOR_WOOCOMMERCE_NAME', 'Ultimate View as Customer for Woocommerce');
define('ULTIMATE_VIEW_AS_CUSTOMER_FOR_WOOCOMMERCE_PATH', plugin_dir_path(__FILE__));
define('ULTIMATE_VIEW_AS_CUSTOMER_FOR_WOOCOMMERCE_URL', plugin_dir_url(__FILE__));

define(
	'ULTIMATE_VIEW_AS_CUSTOMER_FOR_WOOCOMMERCE_DEFAULT_OPTIONS',
	[
		'settings' => [
			'settings_enable' => 1,
			'fontend_enable' => 1,
		],
		'color-customizer' => [
			'bar_background_color' => '#002E73',
			'bar_text_color' => '#FFFFFF',
			'button_background_color' => '#0167FF',
			'button_text_color' => '#FFFFFF',
		],
	]
);

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ultimate-view-as-customer-for-woocommerce-activator.php
 */
function ultimate_view_as_customer_for_woocommerce_activate()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-ultimate-view-as-customer-for-woocommerce-activator.php';
	Ultimate_View_As_Customer_For_Woocommerce_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ultimate-view-as-customer-for-woocommerce-deactivator.php
 */
function ultimate_view_as_customer_for_woocommerce_deactivate()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-ultimate-view-as-customer-for-woocommerce-deactivator.php';
	Ultimate_View_As_Customer_For_Woocommerce_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'ultimate_view_as_customer_for_woocommerce_activate');
register_deactivation_hook(__FILE__, 'ultimate_view_as_customer_for_woocommerce_deactivate');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-ultimate-view-as-customer-for-woocommerce.php';

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
	require __DIR__ . '/vendor/autoload.php';
}

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function ultimate_view_as_customer_for_woocommerce_run()
{
	$plugin = new Ultimate_View_As_Customer_For_Woocommerce();
	$plugin->run();
}
ultimate_view_as_customer_for_woocommerce_run();
