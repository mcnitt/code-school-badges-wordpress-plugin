<?php
	echo $before_widget;
	echo $before_title . $title . $after_title;

	$wpcodeschool_courses_completed = array_reverse($wpcodeschool_profile['courses']['completed']);
	$wpcodeschool_courses_completed_count = count($wpcodeschool_courses_completed);
?>
<ul class="wpcodeschool-badge-widget clearfix">
	<?php for($i = $wpcodeschool_courses_completed_count -1; $i >= $wpcodeschool_courses_completed_count - $num_badges; $i-- ){ ?>
	<li class="wpcodeschool-badge" style="width: <?php echo $badge_size; ?>; height: <?php echo $badge_size; ?>">
		<a href="<?php echo $wpcodeschool_courses_completed[$i]['url']; ?>" title="<?php echo $wpcodeschool_courses_completed[$i]['title']; ?>" target="_blank">
			<img src="<?php echo $wpcodeschool_courses_completed[$i]['badge']; ?>" alt="<?php echo $wpcodeschool_courses_completed[$i]['title']; ?> badge">
		</a>
	</li>
	<?php } ?>
</ul>
<?php
echo $after_widget;