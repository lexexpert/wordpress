<?php
/*
Plugin Name: RIV-Hooks
Plugin URI:
Description: Plugin with hooks
Version: 1.0.0
Author: Ivan Reshetar
Author URI: http://ivanreshetar.com
*/

add_filter('the_title', 'riv_title');
add_filter('the_content', 'riv_content');
add_action( 'comment_post', 'riv_comment_post' );

function riv_title($title){
	if(is_admin()) return $title;
	return mb_convert_case($title, MB_CASE_TITLE, "UTF-8");
}

function riv_content($content){
	if( is_user_logged_in() ) return $content;
	if( is_page() ) return $content;
	return '<div class="wfm-access"><a href="' . home_url() . '/wp-login.php">Login to view content</a></div>';
}

function riv_comment_post(){
	wp_mail( get_bloginfo( 'admin_email' ), 'New comment on the site', 'A new comment has appeared on the site.' );
}