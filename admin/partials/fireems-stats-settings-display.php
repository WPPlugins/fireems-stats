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

isset($Option['author']) ? $author = $Option['author'] : $author = '';

?>

<div class="container wrap fire-admin-wrap">

	<div class="row">
			
		<h2><?php _e( 'Fire/EMS Stats', 'fireems-stats' ); ?></h2>

	</div>

	<div class="row fems-page-title">
				
		<h4><?php _e( 'Settings', 'fireems-stats' ); ?></h4>

	</div>

	<div class="row fire-content-wrap">

		<div class="fems-settings">

			<p><?php _e( 'Here you can change the name of column displays adjust the settings for the rest of the plugin', 'fireems-stats' ); ?></p>

			<form class="form-horizontal" autocomplete="off" novalidate>
			
				<div class="form-group">
			
					<label for="column1" class="col-sm-3 control-label">Column 1 Title</label>
			
					<div class="col-sm-offset-6">
			
						<input type="text" id="column1" name="column1" placeholder="Fires" size="20" value="<?php echo $Option['col1_title']; ?>">
			
					</div>
			
				</div>

				<div class="form-group">
			
					<label for="column2" class="col-sm-3 control-label">Column 2 Title</label>
			
					<div class="col-sm-offset-6">
			
						<input type="text" id="column2" name="column2" placeholder="EMS" size="20" value="<?php echo $Option['col2_title']; ?>">
			
					</div>
			
				</div>
			
				<div class="form-group">
			
					<label for="column3" class="col-sm-3 control-label">Column 3 Title</label>
			
					<div class="col-sm-offset-6">
			
						<input type="text" id="column3" name="column3" placeholder="Total" size="20" value="<?php echo $Option['col3_title']; ?>">
			
					</div>
			
				</div>

				<div class="form-group">
			
					<label for="displayauthor" class="col-sm-3 control-label">Display Author  <a href="#" data-toggle="tooltip" data-placement="top" title="Display the author in the widget?"><i class="fa fa-question-circle" aria-hidden="true"></i></a></label>
			
					<div class="col-sm-offset-6">

						<label class="checkbox">

							<input name="author" type="checkbox" <?php checked( $author, 'on'); ?>>

						</label>

					</div>

					<div class="form-group">
				
						<div class="col-sm-offset-7 col-sm-5">
				
							<button type="submit" class="btn btn-default">Update</button>
				
						</div>
				
					</div>
			
				</div>

			</form>

		</div>
				
	</div>

	<div class="row fire-admin-footer">

		<div class="col-sm-6 fems-version">Fire/EMS Stats <i>v.<?php echo $this->version; ?></i></div>

		<div class="col-sm-6 text-right"><a href="http://www.maltesesolutions.com"><img src="<?php echo plugins_url();?>/fireems-stats/admin/images/small_ms.png" alt="&copy; <?php echo $this->author; ?>"></a></div>

	</div>

</div>

<div class="fems-loader">
	<img class="loader" src="<?php echo plugin_dir_url( __FILE__ ); ?>/spinner_orange.gif" alt="loading..." align="middle">
</div>