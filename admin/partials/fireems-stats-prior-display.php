<?php

/**
 * View Prior Year Stats
 *
 * @link       http://www.maltesesolutions.com
 * @since      1.0
 *
 * @package    Fireems_Stats
 * @subpackage Fireems_Stats/admin/partials
 */

$Option = get_option('fireEMS');
$results = Fireems_Stats_Admin::get_prior();

?>

<div class="container wrap fire-admin-wrap">

	<div class="row">
			
		<h2><?php _e( 'Fire/EMS Stats', 'fireems-stats' ); ?></h2>

	</div>

	<div class="row fems-page-title">

		<h4><?php _e( 'Prior Years Stats', 'fireems-stats' ); ?></h4>

	</div>

	<div class="row fire-content-wrap">

		<table class="fire-admin-table table table-bordered table-condensed table-hover">

			<thead class="fire-admin-tableheader">

				<tr>

					<th class="fems-year"><?php _e( 'Year', 'fireems-stats' ); ?></th>

					<th class="col3 text-center"><?php echo $Option['col3_title']; ?></th>

					<th class="fems-action text-center"><?php _e( 'Action', 'fireems-stats' ); ?></th>

				</tr>

			</thead>

			<?php foreach ($results as $data) : ?>

				<tr>

					<td><strong><?php echo $data->year; ?></strong></td>

					<td class="text-center"><strong><?php echo Fireems_Stats_Admin::get_total($data->year) ?></strong></td>

					<td class="text-center">

						<a href="<?php echo get_admin_url(); ?>admin.php?page=fireems&amp;year=<?php echo $data->year; ?>" class="btn btn-primary btn-xs" role="button"><i class="fa fa-history" aria-hidden="true"></i></a>

						<?php $encode = base64_encode('0|'.$data->year.'|delete'); ?>

						<button class="fems-delete btn btn-danger btn-xs" data="<?php echo $encode; ?>" type="submit" name="<?php echo $data->year; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></button>

					</td>

				</tr>

			<?php endforeach; ?>

		</table>
				
	</div>

	<div class="row fire-admin-footer">

		<div class="col-sm-6 fems-version">Fire/EMS Stats <i>v.<?php echo $this->version; ?></i></div>

		<div class="col-sm-6 text-right"><a href="http://www.maltesesolutions.com"><img src="<?php echo plugins_url();?>/fireems-stats/admin/images/small_ms.png" alt="&copy; <?php echo $this->author; ?>"></a></div>

	</div>

</div>

<div class="fems-loader">
	<img class="loader" src="<?php echo plugin_dir_url( __FILE__ ); ?>/spinner_orange.gif" alt="loading..." align="middle">
</div>