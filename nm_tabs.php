<?php

/**
 * @link              https://www.taifuun.ee
 * @since             1.0.0
 * @package           Nm_tabs
 *
 * @wordpress-plugin
 * Plugin Name:       Nordic Milk Tabs
 * Plugin URI:        https://www.taifuun.ee
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.1
 * Author:            Taifuun OÜ
 * Author URI:        https://www.taifuun.ee
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       nm_tabs
 * Domain Path:       /languages
 * GitHub Plugin URI: stentibbing/nm_tabs
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'NM_TABS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 */
function activate_nm_tabs() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-nm_tabs-activator.php';
	Nm_tabs_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_nm_tabs() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-nm_tabs-deactivator.php';
	Nm_tabs_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_nm_tabs' );
register_deactivation_hook( __FILE__, 'deactivate_nm_tabs' );

/**
 * The core plugin class that is used to define internationalization,
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-nm_tabs.php';

/**
 * Begins execution of the plugin.
 */
function run_nm_tabs() {

	$plugin = new Nm_tabs();
	$plugin->run();

}
run_nm_tabs();
