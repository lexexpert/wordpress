<?php

function riv_check_field($column){
	global $wpdb;

	$fields = $wpdb->get_results("SHOW fields FROM $wpdb->posts", ARRAY_A);

	foreach ($fields as $field){
		if($field['Fiels'] == $column){
			return true;
		}
	}
	return false;
}