<?php
/**
 * The widget functionality of the plugin.
 *
 * @link       http://www.maltesesolutions.com
 * @since      2.0.0
 *
 * @package    Fireems_Stats
 * @subpackage Fireems_Stats/public
 */

/**
 * The widget functionality of the plugin.
 *
 * This file is used to markup the widget aspects of the plugin.
 *
 * @package    Fireems_Stats
 * @subpackage Fireems_Stats/public
 * @author     MalteseSolutions <support@maltesesolutions.com>
 */


// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');
	
/**
 * Adds My_Widget widget.
 */
class FireEMS_Widget extends WP_Widget {

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    2.0.0
	 */
	function __construct() {

		parent::__construct(

			'FireEMS_Widget', // Base ID

			__('Fire/EMS Widget'), // Name

			array( 'description' => __( 'Display Fire/EMS Stats'), ) // Args

		);

	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		if ($instance['col2'] != 1) : $colspan = 2; else : $colspan = 3; endif;

     	echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {

			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];

		}

		global $wpdb;

		$Option = get_option('fireEMS');

		$results = $this->get_stats($Option['currentyear']);

		echo '<div class="fems-table fems-bold fems-center">'.$Option['currentyear'].'</div>';

		echo '<div class="fems-grid">';

		echo '<table>';

		echo '<thead>';

		echo '<tr>';

		echo '<th>'._x( 'Month', 'fireems-stats' ).'</th>';

		echo '<th>'. $Option['col1_title'].'</th>';

		if ($instance['col2'] == 1) :

			echo '<th>'. $Option['col2_title'].'</th>';

		endif;

		echo '<th>'. $Option['col3_title'].'</th>';

		echo '</tr>';

		echo '</thead>';


		foreach ($results as $data) :

			echo '<tr>';

			echo '<td>'.$data->month.'</div>';

			echo '<td>'.$data->column1.'</div>';

			if ($instance['col2'] == 1) :

				echo '<td>'.$data->column2.'</div>';

			endif;

			if ($instance['tip'] == 1) :

				echo $this->total_with_tip($data->month_id, $data->column3);

			else :

				echo '<td>'.$data->column3.'</div>';

			endif;

			echo '</tr>';

		endforeach;

		echo '<tfoot>';

		echo '<tr>';

		echo '<td colspan="'.$colspan.'"><strong>'. _x( 'Total', 'fireems-stats' ).': </strong></td>';

		echo '<td><strong>'.$this->get_total($Option['currentyear']).'</strong></td>';

		echo '</tr>';

		echo '</tfoot>';

		echo '</table>';

		echo '</div>';

		if (! empty($instance['show_prior']) && ( $instance['show_prior'] == 1 ) ) :

			$priors = $this->get_prior();

			if (sizeof($priors) > 1) :

				echo '<div class="fems-bold">'._x('Previous Years', 'fireems-stats').'</div>';

				echo '<div class="fems-grid">';

				echo '<table>';

				foreach ($priors as $data) :

					if ($data->year != $Option['currentyear']) :

						echo '<tr>';

						echo '<td>'.$data->year.'</td>';

						echo '<td>'.$this->get_total($data->year).'</td>';

						echo '</tr>';

					endif;

				endforeach;

				echo '</table>';

				echo '</div>';

			else :

				// Lets show the user there is no prior data
				echo '<table class="fems-blank">';

				echo '<tr><td class="tooltip">'. _x('There is no prior years data!', 'fireems-stats').'<span class="fems-center">'._x('Unselect Show Prior Years</br>in the widget.', 'fireems-stats').'</span></td></tr>';

				echo '</table>';


			endif;

		endif;

		if(isset($Option['author'])) { // Show some love

			echo '<div class="fems-powered">'._x('Powered by:', 'fireems-stats').' <a href="http://www.maltesesolutions.com" target="_blank">FireEMS Stats (Lite)</a></div>';

		} else {

			echo '<!- FireEMS Stats (Lite) // maltesesolutions.com ->';

		}

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		$Option = get_option('fireEMS');

		isset($instance[ 'title' ]) ? $title = $instance[ 'title' ] : $title = __( 'Fire/EMS Stats', 'fireems-stats' );

		isset($instance[ 'col2' ]) ? $col2 = $instance[ 'col2' ] : $col2 = 1 ;

		isset($instance[ 'show_prior' ]) ? $show_prior = $instance[ 'show_prior' ] : $show_prior = 1 ;

		isset($instance[ 'tip' ]) ? $tip = $instance[ 'tip' ] : $tip = 1;

		echo '<p><label for="'.$this->get_field_id('title').'">'. _e('Title:').'</label>';

		echo '<input class="widefat" id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.$title.'" /></p>';

		echo '<p><input id="'.$this->get_field_id('col2').'" name="'. $this->get_field_name('col2').'" type="checkbox" value="1" '.checked( '1', $col2, false ).'/>';

		echo '<label for="'.$this->get_field_id('col2').'">'._x('Show', 'fireems-stats').' '.$Option['col2_title'].' '._x('Column?', 'fireems-stats').'</label></p>';

		echo '<p><input id="'.$this->get_field_id('show_prior').'" name="'. $this->get_field_name('show_prior').'" type="checkbox" value="1" '.checked( '1', $show_prior, false ).'/>';

		echo '<label for="'.$this->get_field_id('show_prior').'">'._x('Show Prior Years?  (maximum is 3 years)', 'fireems-stats').'</label></p>';

		echo '<p><input id="'.$this->get_field_id('tip').'" name="'. $this->get_field_name('tip').'" type="checkbox" value="1" '.checked( '1', $tip, false ).'/>';

		echo '<label for="'.$this->get_field_id('tip').'">'._x('Show Tool Tip?', 'fireems-stats').'</label></p>';


	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = array();

		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		$instance['col2'] = ( ! empty( $new_instance['col2'] ) ) ? $new_instance['col2'] : '0';

		$instance['show_prior'] = ( ! empty( $new_instance['show_prior'] ) ) ? $new_instance['show_prior'] : '0';

		$instance['tip'] = ( ! empty( $new_instance['tip'] ) ) ? $new_instance['tip'] : '0';

		return $instance;

	}

	/**
	 * Get monthly stats from the year provided
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


	public function total_with_tip($id, $currenttotal){

		global $wpdb;

		$Option = get_option('fireEMS');

		$prioryear = ($Option['currentyear'] - 1);

		$table_name = $wpdb->prefix . 'fireEMS_'.$prioryear;

		if($currenttotal != 0) { // Why check if the current total is 0 
			
			if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) { // Make sure there is a prior year

				$prior = $wpdb->get_row("select * from $table_name where month_id = $id");

				// Lets get the differences
				if($prior->column3 > $currenttotal) { $change = 'less'; $plus = '_x(Less calls this year, fireems-stats).'; $amtchange = ($prior->column3 - $currenttotal);}

				if($prior->column3 < $currenttotal) { $change = 'more'; $plus = '_x(Increased by, fireems-stats).'; $amtchange = ($currenttotal - $prior->column3);}

				$tooltip = _x('Prior Year', 'fireems-stats').' ('.$prioryear.') '._x('Stats', 'fireems-stats').'<br/>';
				$tooltip .= $prior->month.' : ';
				$tooltip .= $prior->column1.' | ';
				$tooltip .= $prior->column2.' | ';
				$tooltip .= $prior->column3;
				$tooltip .= '<br/>'.$amtchange.' '.$change.' '._x('call(s) this year.', 'fireems-stats');


				$result = '<td class="'.$change.' tooltip">'.$currenttotal.'<span>'.$tooltip.'</span></td>';

			} else { // There are no prior years found

				$result = '<td>'.$currenttotal.'</td>';

			}


		} else { // return the current month

			$result = '<td>'.$currenttotal.'</td>';

		}

		return $result;
	}


	/**
	 * Get Total for the year provided
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
	 * Get prior years
	 *
	 * @since    2.0.0
	 */
	public function get_prior() {

		global $wpdb;

		$table_name = $wpdb->prefix . 'fireEMS';

		$sql = "select year from $table_name order by year DESC limit 3";

		$result = $wpdb->get_results($sql);

		return $result;

	}


}

/**
 * Register the widget
 *
 * @since    2.0.0
 */

add_action( 'widgets_init', function(){

	register_widget( 'FireEMS_Widget' );

});	