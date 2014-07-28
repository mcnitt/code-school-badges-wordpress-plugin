<?php 
/*
 *	Plugin Name: Code School Badges Plugin
 *	Plugin URI: http://mcnitt.com/wpcodeschool-badges-plugin/
 *	Description: Provides both widgets and shortcodes to help you display your Code School profile badges on your website.
 *	Version: 0.1
 *	Author: Brian McNitt
 *	Author URI: http://mcnitt.com
 *	License: GPL2
 *
*/


/*
* 	Assign Global Variables
*
*/
$plugin_url = WP_PLUGIN_URL . '/wpcodeschool-badges';
$options = array();
$show_json = true; //for debugging

/*
* 	Add Link to Admin Menu
*	(under 'Settings > Code School Badges')
*
*/
function wpcodeschool_badges_menu(){
// Use the add_options_page function
// add_options_page($page_title, $menu_title, $capability, $menu_slug, $function)
	add_options_page(
		'Code School Badges Plugin',
		'Code School Badges',
		'manage_options',
		'wpcodeschool-badges',
		'wpcodeschool_badges_options_page'
	);
}
add_action('admin_menu', 'wpcodeschool_badges_menu');

/*
* 	Add a Options Page
*
*/
function wpcodeschool_badges_options_page(){
	if(!current_user_can('manage_options')){
		wp_die('You do not have sufficient permission to access this page.');
	}

	global $display_json;
	global $plugin_url;
	global $options;
	global $show_json;

	// process submitted form
	if(isset($_POST['wpcodeschool_form_submitted'])){
		$hidden_field = esc_html($_POST['wpcodeschool_form_submitted']);
		if ($hidden_field == 'Y'){
			$wpcodeschool_username = trim(esc_html($_POST['wpcodeschool_username']));
			//$wpcodeschool_number_of_badges_to_display = trim(esc_html($_POST['wpcodeschool_number_of_badges_to_display']));
			$wpcodeschool_profile = wpcodeschool_badges_get_profile($wpcodeschool_username);
			$last_updated = time();
			//write to options table
			$options['wpcodeschool_username']  						= $wpcodeschool_username;
			//$options['wpcodeschool_number_of_badges_to_display']	= $wpcodeschool_number_of_badges_to_display;
			$options['wpcodeschool_profile']						= $wpcodeschool_profile;
			$options['last_updated'] 								= $last_updated;
			update_option('wpcodeschool_badges', $options);
		}
	}

	// get options from options table
	$options = get_option('wpcodeschool_badges');
	if($options != ''){
		$wpcodeschool_username 						= $options['wpcodeschool_username'];
		$wpcodeschool_profile 						= $options['wpcodeschool_profile'];
		//$wpcodeschool_number_of_badges_to_display 	= $options['wpcodeschool_number_of_badges_to_display'];
		$last_updated 								= $options['last_updated'];
	}
	require('inc/options-page-wrapper.php');
}

/*
* 	Get Code School user profile JSON
*
*/
function wpcodeschool_badges_get_profile($wpcodeschool_username){
	$json_feed_url = 'http://codeschool.com/users/' . $wpcodeschool_username . '.json';

	//use wp remote get. codex: http://codex.wordpress.org/Function_Reference/wp_remote_get
	$args = array('timeout' => 120);
	$json_feed = wp_remote_get($json_feed_url, $args);

	//convert feed from a string to a PHP object. See: http://php.net/manual/en/function.json-decode.php
	$wpcodeschool_profile = json_decode($json_feed['body']);
	return $wpcodeschool_profile;
}


?>