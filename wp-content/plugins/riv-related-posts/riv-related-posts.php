<?php

/*
Plugin Name: RIV-Related-Posts
Plugin URI:
Description: The plugin displays related posts in the same category.
Version: 1.0.0
Author: Ivan Reshetar
Author URI: http://ivanreshetar.com
*/
add_filter('the_content','riv_related_posts');
add_action('wp_enqueue_scripts', 'wp_register_styles_script');

function wp_register_styles_script(){
	wp_register_script('riv-jquery-tools-js', plugins_url('js/jquery.tools.min.js', __FILE__), array('jquery'));
	wp_register_script('riv-scripts-js', plugins_url('js/riv-scripts.js', __FILE__), array('jquery'));
	wp_register_style('riv-style', plugins_url('css/riv_style.css', __FILE__));

	wp_enqueue_script('riv-jquery-tools-js');
	wp_enqueue_script('riv-scripts-js');
	wp_enqueue_style('riv-style');
}

function riv_related_posts($content){

	if(!is_single()) return $content;

	$id = get_the_ID();
	$categories = get_the_category($id);

	foreach($categories as $category){
		$cats_id[] = $category->cat_ID;
	}

	$related_posts = new WP_Query(
		array(
			'posts_per_page' => 5,
			'category__in' => $cats_id,
			'post__not_in' => array($id),
			'orderby' => 'rand'
		)
	);

	if($related_posts->have_posts()){
		$content .= '<div class="related-posts"><h3>Related articles:</h3>';

		while($related_posts->have_posts()){
			$related_posts->the_post();
			if(has_post_thumbnail()){
				$img = get_the_post_thumbnail(get_the_ID(), array(100,100), array('alt' => get_the_title(),
                    'title'=>get_the_title()));
			}else{
				$img = '<img src="'.plugins_url('images/no_img.jpg', __FILE__).'" alt="'.get_the_title().'" 
					title="'.get_the_title().'" width="100" height="100"/>';
			}

			$content .= '<a href="'.get_permalink().'">'.$img.'</a>';
		}

		$content .= '</div>';
		wp_reset_query();
	}

	return $content;
}
