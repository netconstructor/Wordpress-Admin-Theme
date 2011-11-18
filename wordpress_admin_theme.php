<?php

/*
Plugin Name: Wordpress Admin Theme
Plugin URI: http://visiblepixel.com
Description: A custom admin 
Author: Eddie Monge
Version: 1.0
Author URI: http://eddiemonge.com
*/


/* Disallow direct access to the plugin file */
if (basename($_SERVER['PHP_SELF']) == basename (__FILE__)) {
	die('Sorry, but you cannot access this page directly.');
}


/* Add Typekit to the admin area */
add_action('admin_head', function () { ?>
	<link rel="stylesheet" type="text/css" href="<?php echo plugins_url('wp-admin.css', __FILE__); ?>"/>
	<script src="http://use.typekit.com/awi7ulr.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>
	<?php
});


/* Change the text in the footer area */
add_filter('admin_footer_text', function () {
	echo '<p>This theme was custom made by <a href="http://visiblepixel.com/">Visible Pixel</a>. Copyright &copy; '.date('Y').'</p>';
});


/* Change the styling of the login screen */
add_action('login_head', function () { ?>
	<link rel="stylesheet" type="text/css" href="<?php echo plugins_url('wp-login.css', __FILE__); ?>"/>
	<script src="http://use.typekit.com/awi7ulr.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>
	<?php
});


/* Change where the link on the login page goes */
add_filter( 'login_headerurl', function ($url) {
	return get_bloginfo('url');
});


/* Change the back link wording on the login page */
add_filter( 'login_headertitle', function () {
	return 'Back to Main Site';
});


/* Remove the color scheme option from the profile */
remove_action('admin_color_scheme_picker', 'admin_color_scheme_picker');






// Create the function to use in the action hook
function wordpress_remove_dashboard_widgets() {
    // Globalize the metaboxes array, this holds all the widgets for wp-admin
    global $wp_meta_boxes;
 
	//Recent Comments
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	//Incoming Links
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	//Plugins - Popular, New and Recently updated WordPress Plugins
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	//Wordpress Development Blog Feed
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	//Other WordPress News Feed
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
}
 
// Hoook into the 'wp_dashboard_setup' action to register our function
add_action('wp_dashboard_setup', 'wordpress_remove_dashboard_widgets' );
