<!-- Markup Based on: https://github.com/bueltge/WordPress-Admin-Style -->
<div class="wrap">
	
	<div id="icon-options-general" class="icon32"></div>
	<h2>Code School Badges</h2>
	
	<div id="poststuff">
	
		<div id="post-body" class="metabox-holder columns-2">
		
			<!-- main content -->
			<div id="post-body-content">
				
				<div class="meta-box-sortables ui-sortable">
					
					<?php if(!isset($wpcodeschool_username) || $wpcodeschool_username == '' || $wpcodeschool_profile === NULL): //get username ?>
						<?php if (isset($wpcodeschool_username) && $wpcodeschool_profile === NULL) {
							echo '<div class="error"><p>Could not locate user: ' . $wpcodeschool_username . '</p></div>';
							} 
						?>
						<div class="postbox">
							<h3><span>Let's Get Started!</span></h3>

							<div class="inside">

								<form name="wpcodeschool_username_form "method="post" action="">
									<input type="hidden" name="wpcodeschool_form_submitted" value="Y">
									<input type="hidden" name="wpcodeschool_display_sub_badges" value="1">

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

					<?php else: //display the badges ?>

						<div class="postbox">
						
							<h3><span>Completed Course Badges</span></h3>

							<div class="inside">
								<div class="wpcodeschool-badges completed">
									<?php 

									    $wpcodeschool_courses_completed = $wpcodeschool_profile['courses']['completed']; 
										// Alphabetize courses, Array sort function
										function compare_title($a, $b)
										{
											$a = strtolower($a['title']);
											$b = strtolower($b['title']);
											return strnatcmp($a, $b);
										}
									    usort($wpcodeschool_courses_completed, compare_title);

									    // Get course sub badges
									    // Extract course titles from $wpcodeschool_courses_completed, 
									    // store in array
								    	$wpcodeschool_course_titles = array();
								    	foreach($wpcodeschool_courses_completed as $course){
								    		$wpcodeschool_course_titles[] = $course['title'];
										}

							    		// Create list of badges
							    		$wpcodeschool_badges = $wpcodeschool_profile['badges'];

										// Count courses
										$wpcodeschool_courses_completed_count = count($wpcodeschool_courses_completed); 
									?>
									<?php for($i = 0; $i < $wpcodeschool_courses_completed_count; $i++ ): ?>
										<div class="badge-group <?php if ($wpcodeschool_display_sub_badges != true){ echo 'no-sub-badges'; } ?>">

											<a href="<?php echo $wpcodeschool_courses_completed[$i]['url']; ?>" target="_blank"><img class="course-badge"src="<?php echo $wpcodeschool_courses_completed[$i]['badge']; ?>" alt="<?php echo $wpcodeschool_courses_completed[$i]['title']; ?> badge"></a>
					
											<?php if ($wpcodeschool_display_sub_badges == true): ?>	
												<?php foreach($wpcodeschool_badges as $badge): ?>
													<?php if (strpos($badge['name'], 'Completed') !== 0 && strpos(strrev( strtolower($badge['name']) ),strrev( strtolower($wpcodeschool_courses_completed[$i]['title']) )) === 0): ?>
											          <img class="sub-badge" src="<?php echo $badge['badge']; ?>" alt="<?php echo $badge['name']; ?> badge">
									            <?php endif; endforeach; ?>
									        <?php endif; ?>	
											<p class="course-title"><a href="<?php echo $wpcodeschool_courses_completed[$i]['url']; ?>" target="_blank"><?php echo $wpcodeschool_courses_completed[$i]['title']; ?></a></p>
										</div>								
									<?php endfor; ?>
								</div>

							</div> <!-- .inside -->


							<?php 
								$wpcodeschool_courses_in_progress = $wpcodeschool_profile['courses']['in_progress'];  
								if (count($wpcodeschool_courses_in_progress) > 0):
							?>
								<h3><span>Courses In Progress</span></h3>

								<div class="inside">
									<div class="wpcodeschool-badges in-progress">
										<?php 
										    
											// Alphabetize courses, Array sort function
										    usort($wpcodeschool_courses_in_progress, 'compare_title');

										    // Get course sub badges
										    // Extract course titles from $wpcodeschool_courses_in_progress, 
										    // store in array
									    	$wpcodeschool_course_titles = array();
									    	foreach($wpcodeschool_courses_in_progress as $course){
									    		$wpcodeschool_course_titles[] = $course['title'];
											}

								    		// Create list of badges
								    		$wpcodeschool_badges = $wpcodeschool_profile['badges'];

											// Count courses
											$wpcodeschool_courses_in_progress_count = count($wpcodeschool_courses_in_progress); 
										?>
										<?php for($i = 0; $i < $wpcodeschool_courses_in_progress_count; $i++ ): ?>
											<div class="badge-group <?php if ($wpcodeschool_display_sub_badges != true){ echo 'no-sub-badges'; } ?>">
								
												<a href="<?php echo $wpcodeschool_courses_in_progress[$i]['url']; ?>" target="_blank"><img class="course-badge"src="<?php echo $wpcodeschool_courses_in_progress[$i]['badge']; ?>" alt="<?php echo $wpcodeschool_courses_in_progress[$i]['title']; ?> badge"></a>

												<?php if ($wpcodeschool_display_sub_badges == true): ?>	
													<?php foreach($wpcodeschool_badges as $badge): ?>
														<?php if (strpos($badge['name'], 'in_progress') !== 0 && strpos(strrev( strtolower($badge['name']) ),strrev( strtolower($wpcodeschool_courses_in_progress[$i]['title']) )) === 0): ?>
												          <img class="sub-badge" src="<?php echo $badge['badge']; ?>" alt="<?php echo $badge['name']; ?> badge">
										            <?php endif; endforeach; ?>
										        <?php endif; ?>
										        <p class="course-title"><a href="<?php echo $wpcodeschool_courses_in_progress[$i]['url']; ?>" target="_blank"><?php echo $wpcodeschool_courses_in_progress[$i]['title']; ?></a></p>
																
											</div>								
										<?php endfor; ?>
									</div>

								</div> <!-- .inside -->
							<?php endif; ?>
						</div> <!-- .postbox -->

						<?php if(WPCODESCHOOL_BADGES__DEBUG == true): // Debug: Show JSON feed ?>
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
					
					<?php if(isset($wpcodeschool_username) && $wpcodeschool_username != '' && $wpcodeschool_profile !== NULL): // display user profile ?>
					
						<div class="postbox">
							<h3><span><a href="https://www.codeschool.com/users/<?php echo $wpcodeschool_profile['user']['username']; ?>" target="_blank"><?php echo $wpcodeschool_profile['user']['username']; ?>'s Report Card</a></span></h3>
							<div class="inside">
								
								<p><img class="wpcodeschool-gravatar" src="<?php echo $wpcodeschool_profile['user']['avatar']; ?>" alt=""></p>
								<ul class="wpcodeschool-badges-and-points">
									<li>Joined: <strong><?php echo substr($wpcodeschool_profile['user']['member_since'], 0, 10); ?></strong></li>							
									<li>Courses Completed: <strong><?php echo count($wpcodeschool_profile['courses']['completed']); ?></strong></li>
									<li>Courses In Progress: <strong><?php echo count($wpcodeschool_profile['courses']['in_progress']); ?></strong></li>
									<li>Earned Badges: <strong><?php echo number_format(count($wpcodeschool_profile['badges'])); ?></strong></li>
									<li>Total Points: <strong><?php echo number_format($wpcodeschool_profile['user']['total_score']); ?></strong></li>
								</ul>
								<form name="wpcodeschool_username_form" method="post" action="">
									<input type="hidden" name="wpcodeschool_form_submitted" value="Y">
									<p><label for="wpcodeschool_username">Username</label></p>
									<p><input name="wpcodeschool_username" id="wpcodeschool_username" type="text" value="<?php echo $wpcodeschool_username; ?>" /></p>
									<fieldset>
										<legend class="screen-reader-text"><span>Badge Display Options</span></legend>
										<label for="wpcodeschool_display_sub_badges">Show sub badges </label>
											<input name="wpcodeschool_display_sub_badges" type="checkbox" id="wpcodeschool_display_sub_badges" <?php checked($wpcodeschool_display_sub_badges); ?> value="1"  />
									</fieldset>
									<!-- <p><label for="wpcodeschool_number_of_badges_to_display">Number of badges to display</label></p>
									<p><input name="wpcodeschool_number_of_badges_to_display" id="wpcodeschool_number_of_badges_to_display" type="text" value="<?php echo $wpcodeschool_number_of_badges_to_display; ?>" /></p> -->
											
									<p><input class="button-primary" type="submit" name="wpcodeschool_username_submit" value="<?php _e( 'Update' ); ?>" /></p>
									</form>
								<p>Last updated: <?php date_default_timezone_set('America/Los_Angeles'); echo date('Y-m-d H:i:s', $last_updated); ?></p>
							</div> <!-- .inside -->
						</div> <!-- .postbox -->

					<?php endif; ?>
					
				</div> <!-- .meta-box-sortables -->
				
			</div> <!-- #postbox-container-1 .postbox-container -->
			
		</div> <!-- #post-body .metabox-holder .columns-2 -->
		
		<br class="clear">
	</div> <!-- #poststuff -->
	
</div> <!-- .wrap -->