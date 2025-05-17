<?php

// Adds theme support for post formats.
function wp_theme_post_format_setup()
{
	add_theme_support('post-formats', array('aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'));
}

add_action('after_setup_theme', 'wp_theme_post_format_setup');


function wp_theme_add_support()
{
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('editor-styles');
	show_admin_bar(false);

	register_nav_menus([
		'primary_navigation' => __('Primary Navigation', 'rankings'),
		'rankings_footer_menu' => __('Rankings Footer Menu', 'rankings'),
		'who_we_serve_footer_menu' => __('Who We Serve Footer Menu', 'rankings'),
		'services_footer_menu' => __('Services Footer Menu', 'rankings'),
		'resources_footer_menu' => __('Resources Footer Menu', 'rankings'),
		'our_brands_footer_menu' => __('Our Brands Footer Menu', 'rankings'),
	]);
}

function register_custom_patterns()
{
	register_block_pattern_category('custom', array(
		'label' => __('Custom Patterns', 'rankings')
	));
}
function register_custom_block_styles()
{
	register_block_style(
		'core/button',
		array(
			'name' => 'hero-btn',
			'label' => __('Hero Button', 'rankings'),
		)
	);
	register_block_style(
		'core/button',
		array(
			'name' => 'btn-blue',
			'label' => __('Blue Button', 'rankings'),
		)
	);
	register_block_style(
		'core/button',
		array(
			'name' => 'btn-border',
			'label' => __('Border Button', 'rankings'),
		)
	);
	register_block_style(
		'core/button',
		array(
			'name' => 'btn-white',
			'label' => __('White Button', 'rankings'),
		)
	);
	register_block_style(
		'core/button',
		array(
			'name' => 'btn-normal',
			'label' => __('Normal Button', 'rankings'),
		)
	);
	register_block_style(
		'core/button',
		array(
			'name' => 'btn-pink',
			'label' => __('Pink Button', 'rankings'),
		)
	);
	register_block_style(
		'core/button',
		array(
			'name' => 'btn-pink-light',
			'label' => __('Light Pink Button', 'rankings'),
		)
	);
	register_block_style(
		'core/button',
		array(
			'name' => 'btn-pink-border',
			'label' => __('Pink Border Button', 'rankings'),
		)
	);
	register_block_style(
		'core/button',
		array(
			'name' => 'btn-blue-2',
			'label' => __('Blue Button 2', 'rankings'),
		)
	);
	register_block_style(
		'core/button',
		array(
			'name' => 'btn-sky-blue',
			'label' => __('Sky Blue Button', 'rankings'),
		)
	);
	register_block_style(
		'core/button',
		array(
			'name' => 'btn-menu',
			'label' => __('Menu Button', 'rankings'),
		)
	);
	register_block_style(
		'core/button',
		array(
			'name' => 'btn-menu-white',
			'label' => __('Menu Button White', 'rankings'),
		)
	);
}
;
add_action('init', 'register_custom_patterns');
add_action('init', 'register_custom_block_styles');

add_action('after_setup_theme', 'wp_theme_add_support');

/**
 * Register custom block patterns
 */
function register_custom_block_patterns()
{
	register_block_pattern_category(
		'custom-patterns',
		array('label' => __('Custom Patterns', 'rankings'))
	);
}
add_action('init', 'register_custom_block_patterns');