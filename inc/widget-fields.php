<p>
  <label for="<?php echo $this->get_field_name('title'); ?>">Title</label> 
  <input class="widefat" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo ($title ?: $wpcodeschool_profile['user']['username'] . '\'s Code School Badges'); ?>" />
</p>
<ul class="wpcodeschool-badges-and-points">
	<li>Joined: <strong><?php echo substr($wpcodeschool_profile['user']['member_since'], 0, 10); ?></strong></li>							
	<li>Courses Completed: <strong><?php echo count($wpcodeschool_profile['courses']['completed']); ?></strong></li>
	<li>Courses In Progress: <strong><?php echo count($wpcodeschool_profile['courses']['in_progress']); ?></strong></li>
	<li>Earned Badges: <strong><?php echo number_format(count($wpcodeschool_profile['badges'])); ?></strong></li>
	<li>Total Points: <strong><?php echo number_format($wpcodeschool_profile['user']['total_score']); ?></strong></li>
</ul>
<p>
	<fieldset>
		<legend>How to display</legend>
		<?php if($display == ''){$display = 'badges';} ?>
		<label><input type="radio" name="<?php echo $this->get_field_name('display'); ?>" value="badges" <?php if ($display == 'badges'){echo 'checked';} ?>>Course badges</label><br>
		<label><input type="radio" name="<?php echo $this->get_field_name('display'); ?>" value="subbadges" <?php if ($display == 'subbadges'){echo 'checked';} ?>>Course badges and sub badges</label><br>
		<label><input type="radio" name="<?php echo $this->get_field_name('display'); ?>" value="textonly" <?php if ($display == 'textonly'){echo 'checked';} ?>>Text only</label>
	</fieldset>
</p>