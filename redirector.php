<?php

/* RedirectLoader
 * This script will read the Headers from the HTTP Request.
 * Then based on the device ID in the header, it will return a specific GUI file contents.
 *
 * @Author: CommandFusion, support@commandfusion.com
 */


/* The following HTTP Headers are sent by iViewer:
cf-client: "iViewer"
cf-client-version: "v4.0.194"
cf-client-screensize: width,height
cf-hardware: iPhone4S
cf-hardware-os: iOS
cf-hardware-os-version: 5.0.1
cf-hardware-uuid: device ID
*/

// PHP sees HTTP Headers in the _SERVER global variable, and transforms the header names to all caps
// with HTTP_ at the start, and underscores replacing hyphens.

$udid = $_SERVER['HTTP_CF_HARDWARE_UUID'];

// The default GUI file to serve if the Device ID is not matched
$theGUI = "Default/Default GUI.gui";

switch ($udid) {
	case 'ebe1c2e438cce5e363fc42e54393ae3a068e12ee':
		// CommandFusion iPad 2
		$theGUI = "JonesResidence/jones.gui";
		break;
	case 'fdabca935c8bfa4ecb1cba278209656caba419f7':
		// CommandFusion iPad
		$theGUI = "Smith Residence/smith.gui";
		break;
}

// Redirect to the correct GUI file if it exists
if (!file_exists($theGUI)) {
	echo "Error: The file '".$theGUI."' could not be found.";
} else {
	// We must ensure spaces and other on-standard URL characters are encoded correctly before performing the redirect
	header('Location: '. htmlspecialchars($theGUI));
}

/* Function to check if the URL exists for the GUI file.
// Instead can use the built in file_exists() function if you are only redirecting to a local file.
function url_exists($url) {
    $hdrs = @get_headers($url);
    return is_array($hdrs) ? preg_match('/^HTTP\\/\\d+\\.\\d+\\s+2\\d\\d\\s+.*$/',$hdrs[0]) : false;
}
*/

/*
$guifile = file_get_contents($_GET['g']);
$find = "<commandPort>8020</commandPort>";
$replace = "<commandPort>" . $_GET['p'] . "</commandPort>";

$guifile = str_replace($find, $replace, $guifile);
echo $guifile;
*/

?>