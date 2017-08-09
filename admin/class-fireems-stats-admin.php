<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.maltesesolutions.com
 * @since      2.0.0
 *
 * @package    Fireems_Stats
 * @subpackage Fireems_Stats/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Fireems_Stats
 * @subpackage Fireems_Stats/admin
 * @author     MalteseSolutions <support@maltesesolutions.com>
 */
class Fireems_Stats_Admin {

	private $plugin_name;

	private $version;

	private $author;

	public function __construct( $plugin_name, $version, $author ) {

		$this->plugin_name = $plugin_name;

		$this->version = $version;

		$this->author = $author;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    2.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name.'-bootstrap', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), '3.3.7', 'all' );

		wp_enqueue_style( $this->plugin_name.'-font-awesome', plugin_dir_url( __FILE__ ) . 'css/font-awesome.min.css', array(), $this->version, 'all' );

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/fireems-stats-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    2.0.0
	 */
	public function enqueue_scripts() {

		$Option = get_option('fireEMS');

		wp_enqueue_script('jquery');

        wp_enqueue_script('jquery-effects-shake');

		wp_enqueue_script( $this->plugin_name.'-bootstrap', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery' ), $this->version, true );

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/fireems-stats-admin.min.js', array( 'jquery' ), $this->version, true );

		wp_localize_script( $this->plugin_name, 'ajax_params', array(

			'fireems_nonce'	=> wp_create_nonce('fireEMS'),

			'delete_notice'	=> _x('You Cannot Delete the Active Year', 'fireems-stats'),

			'delete_success'	=> _x('Successfully Deleted!', 'fireems-stats'),

			'update_success'	=> _x('Monthly Stats Updated!', 'fireems-stats'),

			'settings_success'	=> _x('Settings Updated!', 'fireems-stats'),

			'current_year'	=> $Option['currentyear']

		));

	}

	/**
	 * Create the Admin Menu
	 *
	 * @since    2.0.0
	 */
	public function add_admin_menu() {

		add_menu_page( __('Fire/EMS Stats', 'fireems'), __('Fire/EMS Stats', 'fireems'), 'edit_posts', 'fireems', array($this, 'fireems_stats'), plugins_url( './images/truck65.png',__FILE__), 3);

		add_submenu_page( 'fireems', __('View Prior Stats', 'fireems'),	__('View Prior Stats', 'fireems'), 'edit_pages', 'fireems-prior', array($this, 'fireems_prior'));

		add_submenu_page( 'fireems', __('Help & FAQs', 'fireems'),	__('Help & FAQs', 'fireems'), 'edit_posts', 'fireems-faq', array($this, 'fireems_faq'));

		add_submenu_page( 'fireems', __('Settings', 'fireems'), __('Settings', 'fireems'), 'manage_options', 'fireems-settings', array($this, 'fireems_settings'));

	}


	/**
	 * Update FireEMS Stats
	 *
	 * @since    2.0.0
	 */
	public function fireems_stats() {

		add_action('check_year', $this->year_exists());

		include_once('partials/fireems-stats-display.php');

	}

	/**
	 * View/Edit Prior FireEMS Stats
	 *
	 * @since    2.0.0
	 */
	public function fireems_prior() {

		include_once('partials/fireems-stats-prior-display.php');

	}

	/**
	 * View Frequently Asked Questions
	 *
	 * @since    2.0.0
	 */
	public function fireems_faq() {

		include_once('partials/fireems-stats-faq-display.php');

	}

	/**
	 * View/Edit FireEMS Settings
	 *
	 * @since    2.0.0
	 */
	public function fireems_settings() {

		include_once('partials/fireems-stats-settings-display.php');

	}

	/**
	 * List monthly stats from current year
	 *
	 * @since    2.0.0
	 */
	public function get_stats($year) {

		global $wpdb;

		$table_name = $wpdb->prefix . 'fireEMS_'.$year;

		$sql = "select month_id, month, column1, column2, column3 from $table_name";
				
		$result = $wpdb->get_results($sql);

		return $result;

	}

	/**
	 * List monthly stats from current year
	 *
	 * @since    2.0.0
	 */
	public function get_total($year) {

		global $wpdb;

		$table_name = $wpdb->prefix . 'fireEMS_'.$year;

		$total = intval($wpdb->get_var("SELECT SUM(column3) FROM $table_name"));

		return $total;

	}

	/**
	 * List prior years and stat totals
	 *
	 * @since    2.0.0
	 */
	public function get_prior() {

		global $wpdb;

		$table_name = $wpdb->prefix . 'fireEMS';

		$sql = "select year from $table_name order by year";

		$result = $wpdb->get_results($sql);

		return $result;

	}


	/**
	 * Get the month name of the month id
	 *
	 * @since    2.0.0
	 */
	public function get_month_name($id, $year) {

		global $wpdb;

		$table_name = $wpdb->prefix . 'fireEMS_'.$year;

		$sql = "select month from $table_name where month_id = {$id}";

		$result = $wpdb->get_var($sql);

		return $result;

	}

	/**
	 * Lets check to see if the current year is in the database
	 *
	 * @since    2.1.0
	 */
	public function year_exists() {

		global $wpdb;

		$ServerYear = (int)substr(current_time( 'mysql' ), 0, 4);

		$table_name = $wpdb->prefix . 'fireEMS_'.$ServerYear;

		if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {

			$this->create_new_table($ServerYear);

			// Lets update the options current year.
			$Option = get_option('fireEMS');

			$newoptions = array(

				'author'		=> $Option['author'],

				'col1_title'	=> $Option['col1_title'],

				'col2_title'	=> $Option['col2_title'],

				'col3_title'	=> $Option['col3_title'],

				'currentyear' 	=> $ServerYear

			);

			update_option('fireEMS', $newoptions);

			return true;

		} else {

			return true;

		}

	}

	/**
	 * Update the database with the new stats
	 *
	 * @since    2.0.0
	 */
	public function update($column1, $column2, $year, $month) {

		global $wpdb;

		$update = true;

		$table_name = $wpdb->prefix . 'fireEMS_'.$year;

		$Column1 = intval($column1);

		$Column2 = intval($column2);

		$NewTotal = ($Column1 + $Column2);

		$wpdb->update($table_name, array('Column1' => $Column1, 'Column2' => $Column2, 'Column3' => $NewTotal), array('month_id' => $month));

	}

	/**
	 * Delete a prior years stats
	 *
	 * @since    2.0.0
	 */
	public function delete($year) {

		check_ajax_referer( 'fireEMS', 'form_token' );

		$Option = get_option('fireEMS');

		$this->decode_data();

		global $wpdb;

		$table_stats = $wpdb->prefix . 'fireEMS';

		$table_name = $wpdb->prefix . 'fireEMS_'.$this->year;

		$sql = "DROP TABLE $table_name";

		$wpdb->query($sql);

		$success = $wpdb->delete($table_stats, array( 'year' => $this->year ));

		$results = $this->get_prior();

		$html = '<table class="table table-bordered table-condensed table-hover ">';

		$html .= '<thead class="fire-admin-tableheader">';

		$html .= '<tr>';

		$html .= '<th class="fems-year">'._x( 'Year', 'fireems-stats' ).'</th>';

		$html .= '<th class="fems-col3 text-center">'.$Option['col3_title'].'</th>';

		$html .= '<th class="fems-action text-center">'. _x( 'Action', 'fireems-stats' ).'</th>';

		$html .= '</tr>';

		$html .= '</thead>';

		foreach ($results as $data) :

			$html .= '<tr>';

			$html .= '<td><strong>'.$data->year.'</strong></td>';

			$html .= '<td class="text-center"><strong>'.$this->get_total($data->year).'</strong></td>';

			$html .= '<td class="text-center">';

			$html .= '<a href="'.get_admin_url().'admin.php?page=fireems&amp;year='.$data->year.'" class="btn btn-primary btn-xs" role="button"><i class="fa fa-history" aria-hidden="true"></i></a> ';

			$encode = base64_encode('0|'.$data->year.'|delete');

			$html .= '<button class="fems-delete btn btn-danger btn-xs" data="'.$encode.'" type="submit" name="'.$data->year.'"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';

			$html .= '</td>';

			$html .= '</tr>';

		endforeach;

		$html .= '</table>';

		echo json_encode(array(
			'success'=>$success,
			'html'=>$html
		));

		wp_die(); // just to be safe

	}

	/**
	 * Edit the Month
	 *
	 * @since    2.0.0
	 */
	public function edit_month() {

		check_ajax_referer( 'fireEMS', 'form_token' );

		// Do I need this here?
		$nonce = wp_create_nonce( 'fireEMS' );

		$Option = get_option('fireEMS');

		$column1 = $_POST['column1'];

		$column2 = $_POST['column2'];

		$this->decode_data();

		$this->row = $this->get_month_name($this->month, $this->year);

		if($this->function == 'update') {

			$update = true;

			$success = $this->update($column1, $column2, $this->year, $this->month);

			$this->month = ''; // Reset the value of month

		}

		$this->total = $this->get_total($this->year);

		$results = $this->get_stats($this->year);

		$html = '<table class="table table-bordered table-condensed table-hover ">';

		$html .= '<thead class="fire-admin-tableheader">';

		$html .= '<tr>';

		$html .= '<th class="fems-month">'._x( 'Month', 'fireems-stats' ).'</th>';

		$html .= '<th class="fems-action text-center">'. _x( 'Action', 'fireems-stats' ).'</th>';

		$html .= '<th class="fems-col1 text-center">'. $Option['col1_title'].'</th>';

		$html .= '<th class="fems-col2 text-center">'. $Option['col2_title'].'</th>';

		$html .= '<th class="fems-col3 text-center">'. $Option['col3_title'].'</th>';

		$html .= '</tr>';

		$html .= '</thead>';

		foreach ($results as $data) :

			$html .= '<tr class="fems-month-row">';

			$html .= '<td class="fems-month" id="'.$data->month.'"><strong>'.$data->month.'</strong></td>';

			$html .= '<td class="text-center">';

			if ($this->function != 'edit') :

				$encode = base64_encode($data->month_id.'|'.$this->year.'|edit');

				$html .= '<button class="btn btn-primary btn-xs stats-edit" data="'.$encode.'" id="'.$data->month.'" type="submit">update</button>';

			endif;

			$html .= '</td>';

			if ($data->month_id == $this->month) :

				$html .= '<td class="text-center"><input type="text" name="newCol1" id="newCol1" size="5" value="'.$data->column1.'"></td>';

				$html .= '<td class="text-center"><input type="text" name="newCol2" id="newCol2" size="5" value="'.$data->column2.'"></td>';

				$html .= '<td class="text-center">';

				$encode = base64_encode($this->month.'|'.$this->year.'|update');

				$html .= '<button class="btn btn-primary btn-xs stats-edit" data="'.$encode.'" type="submit">submit</button> ';

				$html .= '<a class="btn btn-danger btn-xs" href="" role="button">X</a>';

				$html .= '</td>';

			else :

				$html .= '<td class="text-center">'. $data->column1.'</td>';

				$html .= '<td class="text-center">'. $data->column2.'</td>';

				$html .= '<td class="text-center"><strong>'. $data->column3.'</strong></td>';

			endif;

			$html .= '</tr>';

		endforeach;

		$html .= '<tfoot class="fire-admin-tablefooter">';

		$html .= '<tr>';

		$html .= '<td colspan="4" class="text-right"><strong>'. _x( 'Total', 'fireems-stats' ).': </strong></td>';

		$html .= '<td class="fems-total text-center"><strong>'.$this->total.'</strong></td>';

		$html .= '</tr>';

		$html .= '</tfoot>';

		$html .= '</table>';

		echo json_encode(array(
			'row'		=>$this->row,
			'update'	=>$update, 
			'success'	=>$success,
			'html'		=>$html
		));

		wp_die(); // just to be safe

	}


	/**
	 * Update the Settings
	 *
	 * @since    2.0.0
	 */
	public function settings(){

		check_ajax_referer( 'fireEMS', 'form_token' );

		$Option = get_option('fireEMS');

		foreach ($_POST as $key => $value) {

			if ($key != 'action' && $key != 'form_token') :

				$newoptions[$key] = strip_tags($value);

			endif;

		}

		$newoptions['currentyear'] = $Option['currentyear'];

		update_option('fireEMS', $newoptions);

		echo json_encode(array(
			'success'=>true
		));

		wp_die(); // just to be safe

	}

	public function decode_data(){

		return list($this->month, $this->year, $this->function) = explode("|", base64_decode($_POST['data']));

	}

}