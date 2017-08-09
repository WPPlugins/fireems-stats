<?php

/**
 * Fired during plugin activation
 *
 * @link       http://www.maltesesolutions.com
 * @since      2.0.0
 *
 * @package    Fireems_Stats
 * @subpackage Fireems_Stats/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      2.0.0
 * @package    Fireems_Stats
 * @subpackage Fireems_Stats/includes
 * @author     MalteseSolutions <support@maltesesolutions.com>
 */
class Fireems_Stats_Activator {

	/**
	 * Install FireEMS Stats.
	 *
	 * This creates the required databases and plugin options.
	 *
	 * @since    2.0.0
	 */
	public static function activate() {

		global $wpdb;

		global $wp_roles; // Why is this here?

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		$prefix = $wpdb->prefix;

		$current_year = date('Y');

		$stats = $prefix.'fireEMS';

		$stats_db = $prefix.'fireEMS_'.$current_year;

		// Does the table exist? If not lets create the table and default values
		if($wpdb->get_var("SHOW TABLES LIKE '$stats'") != $stats) {

			$sql = "CREATE TABLE $stats (

				year_id int(2) NOT NULL AUTO_INCREMENT, 

				year int(11) NOT NULL DEFAULT '0',

				PRIMARY KEY (year_id)

				) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

			$wpdb->show_errors(true);

			dbDelta($sql, true);

			$sql = "CREATE TABLE $stats_db (

				month_id int(2) NOT NULL AUTO_INCREMENT, 

				month varchar(20) COLLATE utf8_unicode_ci NOT NULL, 

				column1 int(11) NOT NULL DEFAULT '0',

				column2 int(11) NOT NULL DEFAULT '0', 

				column3 int(11) NOT NULL DEFAULT '0',

				PRIMARY KEY (month_id)

				) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

			$wpdb->show_errors(true);

			dbDelta($sql, true);

			$wpdb->insert("$stats", array('year' => $current_year));

			$month = array( 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

			foreach( $month as $m ){

				$wpdb->insert($stats_db, array( 'month' => $m, 'column1'=>0, 'column2'=>0, 'column3'=>0) );

			}

			$wpdb->flush();

		}


		// Create the options
		// Delete the prior options as we are using a different format
		delete_option( 'fireEMS' );

		$FireEMS_options = array(

			'author'		=> '1',

			'col1_title' 	=> 'Fire',

			'col2_title' 	=> 'EMS',

			'col3_title' 	=> 'Total',

			'currentyear' 	=> date('Y')

		);

		add_option( 'fireEMS', $FireEMS_options );

	}

}
?>