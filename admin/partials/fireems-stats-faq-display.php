<?php

/**
 * Frequently Asked Questions
 *
 * @link       http://www.maltesesolutions.com
 * @since      1.2
 *
 * @package    Fireems_Stats
 * @subpackage Fireems_Stats/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->


<div class="container fire-admin-wrap">

	<div class="row">
		
		<h2><?php _e( 'Fire/EMS Stats', 'fireems-stats' ); ?></h2>

	</div>

	<div class="row">
		
		<h4><?php _e( 'Help and Frequently Asked Questions', 'fireems-stats' ); ?></h4>

	</div>

	<div class="row">

		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

			<div class="panel panel-default">

				<div class="panel-heading" role="tab" id="headingOne">

					<h4 class="panel-title">

						<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">How to I display my stats?</a>

					</h4>

				</div>

				<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">

					<div class="panel-body">

						<p>Fire/EMS Stats is a widget and can be added to any sidebar.</p>

						<p>The widget are found under:

							<ul>

								<li>Appearance -> Widgets.</li>

							</ul>

						</p>

					</div>

				</div>

			</div>

			<div class="panel panel-default">

				<div class="panel-heading" role="tab" id="headingTwo">

					<h4 class="panel-title">

						<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">How Do I Update Stats?</a>

					</h4>

				</div>

				<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">

				  <div class="panel-body">

					<p>Updating stats is really quite simple, click on the <button class="btn btn-primary btn-xs">update</button> button for the month and fill in the data. Then hit <button class="btn btn-primary btn-xs">submit</button></p>

				  </div>

				</div>

			</div>

			<div class="panel panel-default">

				<div class="panel-heading" role="tab" id="headingThree">

					<h4 class="panel-title">

						<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">How Do I view prior years stats?</a>

					</h4>

				</div>

				<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">

				  <div class="panel-body">

					<p>If you would like to view the prior years Fire/EMS Stats click on the menu link "Prior Stats".  This will display any prior years available.  <br/>

					Click on the <button class="delete btn btn-primary btn-xs"><i class="fa fa-history" aria-hidden="true"></i></button> to see and the stats will be visible. To update those stats follow the instructions for updating stats.</p>

					If there are prior years you can delete them if needed by clicking on the <button class="delete btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i></button> button.</p>

				  </div>

				</div>

			</div>

			<div class="panel panel-default">

				<div class="panel-heading" role="tab" id="headingFour">

					<h4 class="panel-title">

						<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">Can I create prior years?</a>

					</h4>

				</div>

				<div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">

				  <div class="panel-body">

					<p>This feature is only avaialable in the <a href="http://maltesesolutions.com/product/fireems-stats-pro/" target="_blank">"Pro Version"</a></p>

				  </div>

				</div>

			</div>

			<div class="panel panel-default">

				<div class="panel-heading" role="tab" id="headingFive">

					<h4 class="panel-title">

						<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">Can I change the titles of the columns?</a>

					</h4>

				</div>

				<div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">

				  <div class="panel-body">

					<p>Under <a href="<?php echo get_admin_url(); ?>admin.php?page=fireems-options">"Options"</a> you can change the titles of the columns.</p>

				  </div>

				</div>

			</div>

			<div class="panel panel-default">

				<div class="panel-heading" role="tab" id="headingSix">

					<h4 class="panel-title">

						<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">How do I create next years stats?</a>

					</h4>

				</div>

				<div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">

				  <div class="panel-body">

					<p>FireEMS Stats will automatically create the new year the first time you open the program. <br/>

						If the new year does not exist, the program will create the year.</p>

				  </div>

				</div>

			</div>

			<div class="panel panel-default">

				<div class="panel-heading" role="tab" id="headingSeven">

					<h4 class="panel-title">

						<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">How do I get support?</a>

					</h4>

				</div>

				<div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">

				  <div class="panel-body">

					<p>Support is offered through the Wordpress Plugin Support Page<br/>

						The link is: <a href="https://wordpress.org/support/plugin/fireems-stats">https://wordpress.org/support/plugin/fireems-stats</a></p>

				  </div>

				</div>

			</div>

			<div class="panel panel-default">

				<div class="panel-heading" role="tab" id="headingEight">

					<h4 class="panel-title">

						<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight">Rate this plugin!</a>

					</h4>

				</div>

				<div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEight">

				  <div class="panel-body">

					</p><a href="https://wordpress.org/support/view/plugin-reviews/fireems-stats?rate=5#postform">Please Rate Fire/EMS Stats.</a></p>

				  </div>

				</div>

			</div>

			<div class="panel panel-default">

				<div class="panel-heading" role="tab" id="headingNine">

					<h4 class="panel-title">

						<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseNine" aria-expanded="false" aria-controls="collapseNine">Buy me a cup of coffee.</a>

					</h4>

				</div>

				<div id="collapseNine" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNine">

				  <div class="panel-body">

					<p>I am very pleased that you are enjoying this program and want to buy me a cup of coffee.

					<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
						<input type="hidden" name="cmd" value="_s-xclick">
						<input type="hidden" name="hosted_button_id" value="QAX3Z7FTEFEMG">
						<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
						<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
					</form>

				  </div>

				</div>

			</div>

		</div>

	</div>

	<div class="row fire-admin-footer">

		<div class="col-sm-6 fems-version">Fire/EMS Stats <i>v.<?php echo $this->version; ?></i></div>

		<div class="col-sm-6 text-right"><a href="http://www.maltesesolutions.com"><img src="<?php echo plugins_url();?>/fireems-stats/admin/images/small_ms.png" alt="&copy; <?php echo $this->author; ?>"></a></div>

	</div>

</div>