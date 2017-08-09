<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * @link       http://www.maltesesolutions.com
 * @since      2.0.0
 *
 * @package    Fireems_Stats
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

global $wpdb;

$prefix = $wpdb->prefix;

$stats = $prefix.'fireEMS';

$stats_db = $prefix.'fireEMS_';

// Delete All Stat Years

$wpdb->query($sql);

$sql = "select year from $stats order by year";

$result = $wpdb->get_results($sql);

foreach ($result as $data) {

	$sql = "DROP TABLE $stats_db".$data->year;

	$wpdb->query($sql);

}

$sql = "DROP TABLE $stats";

$wpdb->query($sql);

delete_option( 'fireEMS' );