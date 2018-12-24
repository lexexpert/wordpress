<?php
if(!defined('WP_UNINSTALL_PLUGIN'))
	exit;

wp_mail(get_bloginfo('admin_email'), 'Plugin removed', 'There was a removal of the plugin');
