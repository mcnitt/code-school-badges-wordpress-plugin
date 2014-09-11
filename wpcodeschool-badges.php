<?php 
/*
 *	Plugin Name: Code School Badges
 *	Plugin URI: http://mcnitt.com/wpcodeschool-badges-plugin/
 *	Description: Provides both widgets and shortcodes to help you display Code School profile badges on your website.
 *	Version: 0.1
 *	Author: Brian McNitt
 *	Author URI: http://trendmedia.com
 *	License: GPL2
 *
*/


/*
* 	Define Constants and Global Variables 
*
*/

if(!defined('WPCODESCHOOL_BADGES__DEBUG')) {
	define('WPCODESCHOOL_BADGES__DEBUG', false);	
}
if(!defined('WPCODESCHOOL_BADGES__PLUGIN_URL')) {
	define('WPCODESCHOOL_BADGES__PLUGIN_URL', plugins_url('/', __FILE__));	
}
if(!defined('WPCODESCHOOL_BADGES__SETTINGS_NAME')) {
	define('WPCODESCHOOL_BADGES__SETTINGS_NAME', 'wpcodeschool_badges');	
}

$options = array();


/*
* 	Add Link to Admin Menu
*	(under 'Settings > Code School Badges')
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

	global $options;

	// process submitted form
	if(isset($_POST['wpcodeschool_form_submitted'])){
		$hidden_field = esc_html($_POST['wpcodeschool_form_submitted']);
		if ($hidden_field == 'Y'){
			$wpcodeschool_username = trim(esc_html($_POST['wpcodeschool_username']));
			$wpcodeschool_display_sub_badges = $_POST['wpcodeschool_display_sub_badges'];
			$wpcodeschool_profile = wpcodeschool_badges_get_profile($wpcodeschool_username);
			$last_updated = time();

			//write to options table
			$options['wpcodeschool_username']  						= $wpcodeschool_username;
			$options['wpcodeschool_display_sub_badges']  			= $wpcodeschool_display_sub_badges;
			$options['wpcodeschool_profile']						= $wpcodeschool_profile;
			$options['last_updated'] 								= $last_updated;
			update_option(WPCODESCHOOL_BADGES__SETTINGS_NAME, $options);
		}
	}

	// get options from options table
	$options = get_option(WPCODESCHOOL_BADGES__SETTINGS_NAME);
	if($options != ''){
		$wpcodeschool_username 						= $options['wpcodeschool_username'];
		$wpcodeschool_display_sub_badges 			= $options['wpcodeschool_display_sub_badges'];
		$wpcodeschool_profile 						= $options['wpcodeschool_profile'];
		$last_updated 								= $options['last_updated'];
	}
	require('inc/options-page-wrapper.php');
}

/*
* 	Create widget
*
*/

class Wpcodeschool_Badges_Widget extends WP_Widget {

	function wpcodeschool_badges_widget() {
		// Instantiate the parent object
		parent::__construct( false, 'Code School Badges' );
	}

	function widget( $args, $instance ) {
		// Widget output
		extract($args); //not used but required
		$title = apply_filters('widget_title', $instance['title']);
		$num_badges = $instance['num_badges'];
		$widget_badge_size = $instance['widget_badge_size'];

		$options = get_option(WPCODESCHOOL_BADGES__SETTINGS_NAME);
		$wpcodeschool_profile = $options['wpcodeschool_profile'];

		require('inc/front-end.php');
	}

	function update( $new_instance, $old_instance ) {
		// Save widget options
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['num_badges'] = is_numeric($new_instance['num_badges']) && $new_instance['num_badges'] >= 1 ? intval($new_instance['num_badges']) : count($wpcodeschool_profile['courses']['completed']);
		$instance['widget_badge_size'] = strip_tags($new_instance['widget_badge_size']);

		return $instance;
	}

	function form( $instance ) {
		// Output admin widget options form
		$title = esc_attr($instance['title']);
		$num_badges = esc_attr($instance['num_badges']);
		$widget_badge_size = esc_attr($instance['widget_badge_size']);

		$options = get_option(WPCODESCHOOL_BADGES__SETTINGS_NAME);
		$wpcodeschool_profile = $options['wpcodeschool_profile'];

		require('inc/widget-fields.php');
	}
}

function wpcodeschool_badges_register_widgets() {
	register_widget( 'Wpcodeschool_Badges_Widget' );
}

add_action( 'widgets_init', 'wpcodeschool_badges_register_widgets' );


/*
* 	Create shortcodes
*
*/

function wpcodeschool_badges_shortcode($atts, $content = null){

	global $post;

	$options = get_option(WPCODESCHOOL_BADGES__SETTINGS_NAME);
	$wpcodeschool_profile = $options['wpcodeschool_profile'];

	$all_completed_badges = count($wpcodeschool_profile['courses']['completed']);

	extract ( shortcode_atts(array(
		'num_badges' => $all_completed_badges,
		'badge_size' => '60px'
	), $atts) );

	if ( $num_badges == 'all' ) $num_badges = $all_completed_badges;

	//buffer include so it's not added at the top of the page
	ob_start();
	require ( 'inc/front-end-shortcode.php' );
	$content = ob_get_clean();

	return $content;
}
add_shortcode( WPCODESCHOOL_BADGES__SETTINGS_NAME, 'wpcodeschool_badges_shortcode' );


/*
* 	Fetch Code School user profile JSON
*
*/

function wpcodeschool_badges_get_profile($wpcodeschool_username){
	$json_feed_url = 'http://codeschool.com/users/' . $wpcodeschool_username . '.json';

	//use wp remote get. codex: http://codex.wordpress.org/Function_Reference/wp_remote_get
	$args = array('timeout' => 120);
	$json_feed = wp_remote_get($json_feed_url, $args);
	$wpcodeschool_profile = wp_remote_retrieve_body($json_feed);
	//convert feed from a string to a PHP object. See: http://php.net/manual/en/function.json-decode.php
	$wpcodeschool_profile = json_decode($wpcodeschool_profile, true);
	return $wpcodeschool_profile;
}

function wpcodeschool_badges_refresh_profile(){
	$options = get_option(WPCODESCHOOL_BADGES__SETTINGS_NAME);
	$wpcodeschool_profile = $options['wpcodeschool_profile'];

	$current_time = time();

	$update_difference = $current_time - $last_updated;

	if($update_difference > 43200) { //cache for 12 hours
		$wpcodeschool_username = $options['wpcodeschool_username'];
		$options['wpcodeschool_profile'] = wpcodeschool_badges_get_profile( $wpcodeschool_username );
		$options['last_updated'] = time();

		update_option( WPCODESCHOOL_BADGES__SETTINGS_NAME,  $options );
	}
	//tells ajax request when function is complete
	die();
}
//create custom ajax hook
add_action( 'wp_ajax_wpcodeschool_badges_recfresh_profile', 'wpcodeschool_badges_refresh_profile' );

function wpcodeschool_badges_enable_frontend_ajax() {
	//Insert JS into frontend using wp_head hook
	//Close PHP so we can write JS code...
	?>
	<script>
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>'
	</script>
	<?php //...and reopen PHP.
}
add_action( 'wp_head', 'wpcodeschool_badges_enable_frontend_ajax' );


/*
* 	Enqueue scipts and styles
*
*/
function wpcodeschool_badges_backend_styles(){
	wp_enqueue_style('wpcodeschool_badges_backend_styles', plugins_url('wpcodeschool-badges/inc/wpcodeschool-badges.css', dirname(__FILE__)));
}
add_action('admin_head', 'wpcodeschool_badges_backend_styles');

function wpcodeschool_badges_frontend_scripts_and_styles(){
	wp_enqueue_style('wpcodeschool_badges_frontend_css', plugins_url('wpcodeschool-badges/inc/wpcodeschool-badges.css', dirname(__FILE__)));
	wp_enqueue_script('wpcodeschool_badges_frontend_js', plugins_url('wpcodeschool-badges/wpcodeschool-badges.js'), array('jquery'), '', true);
}
add_action('wp_enqueue_scripts', 'wpcodeschool_badges_frontend_scripts_and_styles');