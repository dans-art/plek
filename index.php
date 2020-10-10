<?php
/**
 * Plugin Name: Plekvetica
 * Plugin URI: https://www.plekvetica.ch/
 * Description: Modification of different Wordpress functionalities
 * Version: 1.2
 * Author: Daniel Spycher
 */
require_once(WP_PLUGIN_DIR.'/plekvetica/include/classes/plekvetica.class.php');

$plek = new plekvetica;
$plek -> init();

include_once($plek -> get_plekplugin_dir()."/include/classes/plek_event_class.php");
include_once($plek -> get_plekplugin_dir()."/include/classes/plek_band_class.php");
include_once($plek -> get_plekplugin_dir()."/include/classes/plek_gallery_class.php");

//To use a better debugger...
include_once($plek -> get_plekplugin_dir().'/include/scripts/kint.phar');
if (!function_exists("s")) {
	function s($i)
	{
		return false;
	}
}
