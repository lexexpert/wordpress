<?php
/*
Plugin Name: RIV Count Views
Plugin URI:
Description: Plugin counts and shows post views
Version: 1.0.0
Author: Ivan Reshetar
*/

include dirname(__FILE__).'/riv-check.php';

register_activation_hook(__FILE__, 'riv_create_field');
add_filter('the_content', 'riv_post_views');
add_action('wp_head', 'riv_add_view');

function riv_create_field(){

	global $wpdb;
	if(!riv_check_field('riv_views')){
		$query = "ALTER TABLE $wpdb->posts ADD riv_views INT NOT NULL DEFAULT '0'";
		$wpdb->query($query);
	}
}


function riv_post_views($content){
	if(is_page()) return $content;

	global $post;
	$views = $post->riv_views;
	if(is_single()) $views++;
	return $content."<b>Number of views: </b>".$views;
}

function riv_add_view(){
	if(!is_single()) return;
	global $post, $wpdb;

	$riv_id = $post->ID;
	$views = $post->riv_views + 1;
	$wpdb->update(
		$wpdb->posts,
		array('riv_views' => $views),
		array('ID' => $riv_id)
	);
}