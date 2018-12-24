<?php
/*
Plugin Name: RIV-Plugin
Plugin URI:
Description: My test plugin
Version: 1.0.0
Author: Ivan Reshetar
Author URI: http://ivanreshetar.com
*/

include dirname(__FILE__)."/riv_deactivate.php";

register_activation_hook(__FILE__, 'riv_activate');
register_deactivation_hook(__FILE__, 'riv_deactivate');
//register_uninstall_hook(__FILE__, 'riv_uninstall');

function riv_activate(){
    if (version_compare(PHP_VERSION, '5.3.0', '<')){
        exit('Plugin needs PHP Version >= 5.3.0');
    }
    //wp_mail(get_bloginfo('admin_email'), 'Plugin activated', 'There was a successful activation of the plugin.');
	$date = "[".date('d-m-Y H:i:s')."]";
    error_log($date. " Plugin activated\r\n", 3, dirname(__FILE__).'/riv_errors.log');
}


function riv_uninstall(){
	$date = "[".date('d-m-Y H:i:s')."]";
	error_log($date. " Plugin deactivated\r\n", 3, dirname(__FILE__).'/riv_errors.log');
}


//class RIVActivate{
//    function __construct()
//    {
//        register_activation_hook(__FILE__, array($this, 'riv_activate'));
//    }
//
//    function riv_activate(){
//        $date = "[".date('d-m-Y H:i:s')."]";
//        error_log($date. " Plugin activated\r\n", 3, dirname(__FILE__).'/riv_errors.log');
//    }
//}
//
//$riv_activate = new RIVActivate;


//class RIVActivate{
//    static function riv_activate(){
//        $date = "[".date('d-m-Y H:i:s')."]";
//        error_log($date. " Plugin activated \r\n", 3, dirname(__FILE__).'/riv_errors.log');
//    }
//}
//register_activation_hook(__FILE__, array('RIVActivate', 'riv_activate'));
