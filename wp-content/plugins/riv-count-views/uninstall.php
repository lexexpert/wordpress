<?php
if(!defined('WP_UNINSTALL_PLUGIN')) exit;

include dirname(__FILE__).'/riv-check.php';

if(riv_check_field('riv_views')) {
	global $wpdb;
	$query = "ALTER TABLE $wpdb->posts DROP riv_views ";
	$wpdb->query( $query );
}