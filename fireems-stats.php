<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.maltesesolutions.com
 * @since             2.0.0
 * @package           Fireems_Stats
 *
 * @wordpress-plugin
 * Plugin Name:       FireEMS Stats
 * Plugin URI:        http://www.maltesesolutions.com
 * Description:       Plugin that allows your Fire or EMS Organizaiton to list its monthly activity.
 * Version:           2.0.0
 * Author:            MalteseSolutions
 * Author URI:        http://www.maltesesolutions.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       fireems-stats
 * Domain Path:       /languages
 */


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

ob_start();

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-fireems-stats-activator.php
 */
function activate_fireems_stats() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-fireems-stats-activator.php';
	Fireems_Stats_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-fireems-stats-deactivator.php
 */
function deactivate_fireems_stats() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-fireems-stats-deactivator.php';
	Fireems_Stats_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_fireems_stats' );
register_deactivation_hook( __FILE__, 'deactivate_fireems_stats' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-fireems-stats.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    2.0.0
 */
function run_fireems_stats() {

	$plugin = new Fireems_Stats();
	$plugin->run();

}
run_fireems_stats();