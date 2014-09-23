=== Code School Badges ===  
Contributors: mcnitt
Donate link: http://trendmedia.com/
Tags: shortcode, badges, CodeSchool, code school, profile, API, learning, education
Requires at least: 3.0.1
Tested up to: 4.0
Stable tag: 1.0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Provides both widgets and shortcodes to help display Code School profile badges on your website.

== Description ==  
Learn By Doing. Code School teaches web technologies in the comfort of your browser with video lessons, coding challenges, and screencasts. Use this plugin to proudly display completed Code School course badges on your WordPress blog, website or CV. 

You can use a widget to display your badges in a header, sidebar or footer or use a shortcode to display badges in the main content area of a post or page. The plugin offers two customization options:

1. How many of your most recent completed course badges to display
2. How large should each badge be (in pixels, ems, or other valid units)

Project code is hosted at GitHub. Contributors welcome.

== Installation ==  
There are a few options for installing and setting up this plugin.

#### Upload Manually

1. Download and unzip the plugin
2. Upload the 'wpcodeschool-badges' folder into the '/wp-content/plugins/' directory
3. Go to the Plugins admin page and activate the plugin

#### Install Via Admin Area

1. In the admin area go to Plugins > Add New and search for "Code School Badges"
2. Click install and then click activate


#### To Setup The Plugin

1. Find your Code School username (see instructions under FAQ)
2. In the WordPress admin area go to Settings > Code School Badges and then enter in your username

#### How to Use the Badges Widget

1. Setup the Plugin (refer to above)
2. Go to Appearance > Widgets and drag the 'Code School Badges' widget to your sidebar.
3. Enter in a Title to appear above the badges. For example "My Code School Badges"
4. Choose how many badges you would like to display
5. Enter how large each badge should be. Examples: 60px, 5ems, 12pts, etc.

#### How to Use the Shortcode

1. Navigate to the post or page you would like to add the badges to appear.
2. Enter in the shortcode [wpcodeschool_badges]
3. Customize the number of badges displayed by adding the parameter 'num_badges' with the number of badges you want to display. [wpcodeschool_badges num_badges='4']. If a number is not specified, all of your badges will be displayed.
4. Customize how large each badge should be. Examples: 60px, 5ems, 12pts, etc. [wpcodeschool_badges badge_size='100px']. If no size is specified, the default badge size is 60px.
5. You can use any of the parameters in combination [wpcodeschool_badges num_badges='4' badge_size='100px']

== Frequently Asked Questions ==

= How do I find my Code School username? =

1. Login to your Code School account
2. Go to [https://www.codeschool.com/account](https://www.codeschool.com/account)
3. Your username appears on the page

= A recent badge is not appearing =

The plugin caches queries for 12 hours. This keeps your site running fast and prevents too many calls to the Code School API. You can clear the cache by going to the admin area, Settings > Code School Badges, and hitting the 'Update' button.

= How Often Does the Profile Information Get Updated? = 

Whenever someone visits a page, the plugin checks to see if the profile information was updated in the last 12 hours. If it has been longer than 12 hours, then the plugin will update the profile information. The next time someone visits the site or clicks on a page, the latest badges show.

= Can I Choose What Specific Badges I Want to Display? =

Unfortunately, not yet. For future releases, we are considering more customized ways to choose what badges you want to display, instead of just showing the most recent badges.

= Can I contribute code and bug fixes? =

Contributors are welcome. Please visit the [Code School Badges GitHub project.](https://github.com/mcnitt/code-school-badges-wordpress-plugin)


== Screenshots ==

1. Once you have installed the plugin, navigate to Settings > Code School Badges in the admin area
2. Type in your Code School username (see FAQ for how to find your username)
3. View your latest badges and profile information
4. Add a widget to your site go to Appearance > Widgets. Look for the 'Code School Badges' widget and drag to the appropraite widget area. Enter in a title to appear above the badges, enter in the number of badges you would like to appear, and enter how large each badge should be (examples: 60px, 5ems, 12pts, etc.).
5. To add badges using a shortcode use [wpcodeschool_badges]. You can also use the following optional parameters [wpcodeschool_badges num_badges='4' badge_size='100px']. If num_badges is not specified, all of your badges will be displayed.
6. A previews of badges displaying as a shortcode and as a widget

== Changelog ==

= 1.0.2 =  
* Fix broken CSS and JS links on most servers 

= 1.0.1 =  
* Fix broken CSS and JS links on some servers 

= 1.0 =  
* Initial version of the plugin  
* Includes basic widget and shortcode display options  

== Upgrade Notice ==

= 1.0.2 =  
* Fix broken CSS and JS links on most servers 

= 1.0.1 =  
* Fix broken CSS and JS links on some servers 

= 1.0 =  
Initial version of the plugin