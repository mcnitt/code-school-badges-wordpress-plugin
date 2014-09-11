<p>
  <label>Title</label> 
  <input class="widefat" name="<?php
echo $this->get_field_name('title'); ?>" type="text" value="<?php
echo ($title ? : $wpcodeschool_profile['user']['username'] . '\'s Code School Badges'); ?>" />
</p>

<p>
	Courses Completed: 
	<strong><?php
echo count($wpcodeschool_profile['courses']['completed']); ?></strong>
</p>

<p>
	<label>How many of your most recent completed course badges would you you like to display?</label> 
	<input size="4" name="<?php
echo $this->get_field_name('num_badges'); ?>" type="text" value="<?php
echo ($num_badges ? : count($wpcodeschool_profile['courses']['completed'])); ?>"/>
</p>

<p>
	<label>How big should each badge be? <br>(Examples: 120px, 5ems, 12pts)</label> 
	<input size="7" name="<?php
echo $this->get_field_name('widget_badge_size'); ?>" type="text" value="<?php
echo ($widget_badge_size ? : '60px'); ?>"/>
</p>