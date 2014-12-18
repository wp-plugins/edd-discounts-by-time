<?php
/*
Plugin Name: Edd Discounts By Time
Plugin URI: http://dualcube.com
Description: This is Easy Digital Downloads add-on. This plugin enables you to provide time specific discounts.
Author: Dualcube, debjyati_dc
Version: 1.0.0
Author URI: http://dualcube.com
*/

if ( ! class_exists( 'EDD_Dependencies' ) )
	require_once 'includes/class-dc-dependencies.php';
if( ! EDD_Dependencies::edd_active_check() ) {
 add_action( 'admin_notices', 'edd_inactive_notice' );
}
require_once 'includes/dc-edd-discounts-by-time-core-functions.php';
require_once 'config.php';
if(!defined('ABSPATH')) exit; // Exit if accessed directly
if(!defined('DC_EDD_DISCOUNTS_BY_TIME_PLUGIN_TOKEN')) exit;
if(!defined('DC_EDD_DISCOUNTS_BY_TIME_TEXT_DOMAIN')) exit;

if(!class_exists('DC_Edd_Discounts_By_Time')) {
	require_once( 'classes/class-dc-edd-discounts-by-time.php' );
	global $DC_Edd_Discounts_By_Time;
	$DC_Edd_Discounts_By_Time = new DC_Edd_Discounts_By_Time( __FILE__ );
	$GLOBALS['DC_Edd_Discounts_By_Time'] = $DC_Edd_Discounts_By_Time;
}
?>
