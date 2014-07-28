<!-- Markup Based on: https://github.com/bueltge/WordPress-Admin-Style -->
<div class="wrap">
	
	<div id="icon-options-general" class="icon32"></div>
	<h2>Code School Badges Plugin</h2>
	
	<div id="poststuff">
	
		<div id="post-body" class="metabox-holder columns-2">
		
			<!-- main content -->
			<div id="post-body-content">
				
				<div class="meta-box-sortables ui-sortable">

					<?php if(!isset($wpcodeschool_username) || $wpcodeschool_username == ''): ?>

						<div class="postbox">
							<h3><span>Let's Get Started!</span></h3>
							<div class="inside">

								<form name="wpcodeschool_username_form "method="post" action="">
								<input type="hidden" name="wpcodeschool_form_submitted" value="Y">
									<table class="form-table">
										<tr>
											<td><label for="wpcodeschool_username">Code School username</label></td>
											<td>
												<input name="wpcodeschool_username" id="wpcodeschool_username" type="text" value="" class="regular-text" />
											</td>
										</tr>
									</table>
									<p><input class="button-primary" type="submit" name="wpcodeschool_username_submit" value="<?php _e( 'Save' ); ?>" /></p>
								</form>
							</div> <!-- .inside -->
						</div> <!-- .postbox -->

					<?php else: ?>
						
						<?php if($show_json == true): ?>
							<div class="postbox">							
								<h3><span>JSON Feed</span></h3>
								<div class="inside">
									<pre><code>
										<?php var_dump($wpcodeschool_profile); ?>
									</code></pre>
								</div> <!-- .inside -->
							</div> <!-- .postbox -->
						<?php endif; ?>

					<?php endif; ?>
					
				</div> <!-- .meta-box-sortables .ui-sortable -->
				
			</div> <!-- post-body-content -->
			
			<!-- sidebar -->
			<div id="postbox-container-1" class="postbox-container">
				
				<div class="meta-box-sortables">
					
					<div class="postbox">
					
						<h3><span>Sidebar Content Header</span></h3>
						<div class="inside">
							Content space
						</div> <!-- .inside -->
						
					</div> <!-- .postbox -->
					
				</div> <!-- .meta-box-sortables -->
				
			</div> <!-- #postbox-container-1 .postbox-container -->
			
		</div> <!-- #post-body .metabox-holder .columns-2 -->
		
		<br class="clear">
	</div> <!-- #poststuff -->
	
</div> <!-- .wrap -->