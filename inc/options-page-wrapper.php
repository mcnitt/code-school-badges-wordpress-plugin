<!-- Markup Based on: https://github.com/bueltge/WordPress-Admin-Style -->
<div class="wrap">
	
	<div id="icon-options-general" class="icon32"></div>
	<h2>Code School Badges</h2>
	
	<div id="poststuff">
	
		<div id="post-body" class="metabox-holder columns-2">
		
			<!-- main content -->
			<div id="post-body-content">
				
				<div class="meta-box-sortables ui-sortable">
					
					<?php if(!isset($wpcodeschool_username) || $wpcodeschool_username == ''): //get username ?>

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

					<?php else: //display the badges ?>

						<div class="postbox">
						
							<h3><span>Completed Course Badges</span></h3>
							<div class="inside">
								<ul class="wpcodeschool-badges">
									<?php 
									    $wpcodeschool_courses_completed = $wpcodeschool_profile['courses']['completed']; 
										// Alphabetize courses, Array sort function
										function compare_title($a, $b)
										{
											return strnatcmp($a['title'], $b['title']);
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
										<li class="badge-group">
											<ul>
												<li class="main-course-image"><a href="<?php echo $wpcodeschool_courses_completed[$i]['url']; ?>" target="_blank"><img src="<?php echo $wpcodeschool_courses_completed[$i]['badge']; ?>" alt="<?php echo $wpcodeschool_courses_completed[$i]['title']; ?> badge"></a></li>	
												<li class="wpcodeschool-badge-name"><a href="<?php echo $wpcodeschool_courses_completed[$i]['url']; ?>" target="_blank"><?php echo $wpcodeschool_courses_completed[$i]['title']; ?></a>
													<ul class="course-sub-badges">
														<?php foreach($wpcodeschool_badges as $badge): // Find and show the sub badges ?>
															<?php if (strpos(strrev( strtolower($badge['name']) ),strrev( strtolower($wpcodeschool_courses_completed[$i]['title']) )) === 0): ?>
													           <li class="course-sub-badge-image"><img src="<?php echo $badge['badge']; ?>" alt="<?php echo $badge['name']; ?> badge"></li>
													           <li class="course-sub-badge-image-name"><?php echo $badge['name']; ?></li>
											            <?php endif; endforeach; ?>
													</ul>
												</li>
											</ul>									
										</li>								
									<?php endfor; ?>
								</ul>
							</div> <!-- .inside -->
						</div> <!-- .postbox -->

						<?php if($show_json == true): // Debug: Show JSON feed ?>
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
					
					<?php if(isset($wpcodeschool_username) && $wpcodeschool_username != ''): // display user profile ?>
					
						<div class="postbox">
							<h3><span><a href="https://www.codeschool.com/users/<?php echo $wpcodeschool_profile['user']['username']; ?>" target="_blank"><?php echo $wpcodeschool_profile['user']['username']; ?>'s Report Card</a></span></h3>
							<div class="inside">
								
								<p><img class="wpcodeschool-gravatar" src="<?php echo $wpcodeschool_profile['user']['avatar']; ?>" alt=""></p>
								<ul class="wpcodeschool-badges-and-points">
									<li>Joined: <strong><?php echo substr($wpcodeschool_profile['user']['member_since'], 0, 10); ?></strong></li>							
									<li>Courses Completed: <strong><?php echo count($wpcodeschool_profile['courses']['completed']); ?></strong></li>
									<li>Courses In Progress: <strong><?php echo count($wpcodeschool_profile['courses']['in_progress']); ?></strong></li>
									<li>Earned Badges: <strong><?php echo count($wpcodeschool_profile['badges']); ?></strong></li>
									<li>Total Points: <strong><?php echo $wpcodeschool_profile['user']['total_score']; ?></strong></li>
								</ul>
								<form name="wpcodeschool_username_form "method="post" action="">
									<input type="hidden" name="wpcodeschool_form_submitted" value="Y">
									<p><label for="wpcodeschool_username">Username</label></p>
									<p><input name="wpcodeschool_username" id="wpcodeschool_username" type="text" value="<?php echo $wpcodeschool_username; ?>" /></p>

									<p><label for="wpcodeschool_number_of_badges_to_display">Number of badges to display</label></p>
									<p><input name="wpcodeschool_number_of_badges_to_display" id="wpcodeschool_number_of_badges_to_display" type="text" value="<?php echo $wpcodeschool_number_of_badges_to_display; ?>" /></p>
											
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