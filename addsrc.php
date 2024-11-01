<?php
/*
Plugin Name: Sourcecode Tag Adder
Plugin URI: http://jdabhi.com/sta
Description: Add WP sourcecode tags with the click of a button.
Version: 1.1
Author: Jay Dabhi
Author URI: http://jdabhi.com
License: GPL2
*/

//Include options file.
include("addsrc-options.php");

//Hook into WP.
add_action('init', 'addsrc_button');

//Init function.
function addsrc_button() {
	if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) {
		return;
	}

	if (get_user_option('rich_editing')=='true') {
		add_filter('mce_external_plugins', 'add_addsrc_plugin');
		if (get_option("addsrc_row")=="1") {
			$mceButtonsRow = 'mce_buttons';
		} else {
			$mceButtonsRow = 'mce_buttons_' . get_option("addsrc_row");
		}
		add_filter($mceButtonsRow, 'register_addsrc_button');
	}
}

//Register button.
function register_addsrc_button($buttons) {
	array_push($buttons, "addsrc");
	return $buttons;
}

//Register TinyMCE plugin.
function add_addsrc_plugin($plugin_array) {
	$plugin_array['addsrc'] = WP_PLUGIN_URL . '/addsrc/src-tmce.js';
	return $plugin_array;
}

?>