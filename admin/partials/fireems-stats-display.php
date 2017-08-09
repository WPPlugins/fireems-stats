<?php

/**
 * View and Edit Current Year Stats
 *
 * @link       http://www.maltesesolutions.com
 * @since      1.0
 *
 * @package    Fireems_Stats
 * @subpackage Fireems_Stats/admin/partials
 */

// Load the Options
$Option = get_option('FireEMS');

// Define the year because we may be viewing prior years
isset($_REQUEST['year']) ? $Year = $_REQUEST['year'] : $Year = $Option['currentyear'] ;

// Get objects
$results = Fireems_Stats_Admin::get_stats($Year);
$total = Fireems_Stats_Admin::get_total($Year);

?>

<div class="container wrap fire-admin-wrap">

	<div class="row">
	
		<h2><?php _e( 'Fire/EMS Stats', 'fireems-stats' ); ?> - <?php echo $Year; ?></h2>

	</div>

	<div class="row fems-page-title"></div>

	<div class="row fire-content-wrap">
	
		<table class="table table-bordered table-condensed table-hover ">

			<thead class="fire-admin-tableheader">

				<tr>

					<th class="fems-month"><?php _e( 'Month', 'fireems-stats' ); ?></th>

					<th class="fems-action text-center"><?php _e( 'Action', 'fireems-stats' ); ?></th>

					<th class="fems-col1 text-center"><?php echo $Option['col1_title']; ?></th>

					<th class="fems-col2 text-center"><?php echo $Option['col2_title']; ?></th>

					<th class="fems-col3 text-center"><?php echo $Option['col3_title']; ?></th>

				</tr>

			</thead>

			<?php 

			foreach ($results as $data) :

				?>

				<tr class="fems-month-row">

					<td class="fems-month" id="<?php echo $data->month; ?>"><strong><?php echo $data->month; ?></strong></td>

					<td class="text-center">

						<?php $encode = base64_encode($data->month_id.'|'.$Year.'|edit'); ?>

						<button class="btn btn-primary btn-xs stats-edit" data="<?php echo $encode; ?>" id="<?php echo $data->month; ?>" type="submit">update</button>

					</td>

					<td class="text-center"><?php echo $data->column1; ?></td>

					<td class="text-center"><?php echo $data->column2; ?></td>

					<td class="text-center"><strong><?php echo $data->column3; ?></strong></td>

				</tr>

			<?php endforeach; ?>

			<tfoot class="fire-admin-tablefooter">

				<tr>

					<td colspan="4" class="text-right"><strong><?php _e( 'Total', 'fireems-stats' ); ?>: </strong></td>

					<td class="fems-total text-center"><strong><?php echo $total; ?></strong></td>

				</tr>

			</tfoot>

		</table>

	</div>

	<div class="row fire-admin-footer">

		<div class="col-sm-6 fems-version">Fire/EMS Stats <i>v.<?php echo $this->version; ?></i></div>

		<div class="col-sm-6 text-right"><a href="http://www.maltesesolutions.com"><img src="<?php echo plugins_url();?>/fireems-stats/admin/images/small_ms.png" alt="&copy; <?php echo $this->author; ?>"></a></div>

	</div>

</div>


<div class="fems-loader">
	<img class="fems-loader" src="<?php echo plugin_dir_url( __FILE__ ); ?>/spinner_orange.gif" alt="loading..." align="middle">
</div>
