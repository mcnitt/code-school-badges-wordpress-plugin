<?php 		
	echo $before_widget;
	echo $before_title . $title . $after_title;	
?>

<?php 
    $wpcodeschool_courses_completed = array_reverse($wpcodeschool_profile['courses']['completed']); 
	// Alphabetize courses, Array sort function
	// function compare_title($a, $b)
	// {
	// 	$a = strtolower($a['title']);
	// 	$b = strtolower($b['title']);
	// 	return strnatcmp($a, $b);
	// }
 //    usort($wpcodeschool_courses_completed, compare_title);

	// Create list of badges
	$wpcodeschool_badges = $wpcodeschool_profile['badges'];

	// Count courses
	$wpcodeschool_courses_completed_count = count($wpcodeschool_courses_completed); 
?>

<ul class="wpcodeschool-badge-widget clearfix">
	<?php for($i = $wpcodeschool_courses_completed_count -1; $i >= $wpcodeschool_courses_completed_count - $num_badges; $i-- ): ?>
	<li>
		<a href="<?php echo $wpcodeschool_courses_completed[$i]['url']; ?>" target="_blank">
			<img src="<?php echo $wpcodeschool_courses_completed[$i]['badge']; ?>" alt="<?php echo $wpcodeschool_courses_completed[$i]['title']; ?> badge">
		</a>
		<!-- Tooltip -->
		<div class="wpcodeschool-badge-info" style="display: none;">								
			<p class="course-title"><a href="<?php echo $wpcodeschool_courses_completed[$i]['url']; ?>" target="_blank"><?php echo $wpcodeschool_courses_completed[$i]['title']; ?></a></p>
			<span class="wpcodeschool-tooltip bottom"></span>							
		</div>
	</li>					
	<?php endfor; ?>
</ul>

<?php 	
	echo $after_widget;