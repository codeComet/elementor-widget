<?php

/**
 * Plugin Name: Strativ Widget
 * Description: Custom Card component for elementor.
 * Version:     1.0.0
 * Author:      Strativ Developer
 * Author URI:  https://www.strativ.se/en
 * Text Domain: strativ-widget
 */

if (!defined('ABSPATH')) {
	exit; //exit if accessed directly
}

function register_strativ_custom_widget($widgets_manager)
{

	require_once(__DIR__ . '/widgets/strativ-card.php');
	require_once(__DIR__ . '/widgets/strativ-video.php');
	require_once(__DIR__ . '/widgets/strativ-categories.php');
	require_once(__DIR__ . '/widgets/strativ-search.php');
	require_once(__DIR__ . '/widgets/strativ-custom-post.php');
	require_once(__DIR__ . '/widgets/strativ-button.php');


	$widgets_manager->register(new \Elementor_Strativ_Custom_Card_Widget());
	$widgets_manager->register(new \Elementor_Strativ_Custom_Video_Widget());
	$widgets_manager->register(new \Elementor_Strativ_Category_Widget());
	$widgets_manager->register(new \Elementor_Strativ_Search_Widget());
	$widgets_manager->register(new \Elementor_Strativ_Custom_Post_Widget());
	$widgets_manager->register(new \Elementor_Strativ_Modal_Button_Widget());
}
add_action('elementor/widgets/register', 'register_strativ_custom_widget');
