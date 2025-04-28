<?php

function wp_theme_load_assets() {
  // wp_enqueue_script('ourmainjs', get_theme_file_uri('/build/index.js'), array('wp-element', 'react-jsx-runtime'), '1.0', true);
  wp_enqueue_style('ourmaincss', get_theme_file_uri('/assets/main.css?Sdf1'));
}

add_action('wp_enqueue_scripts', 'wp_theme_load_assets');

function wp_theme_after_setup() {
  add_editor_style('/assets/main.css');
}
add_action('after_setup_theme', 'wp_theme_after_setup');

function wp_theme_add_support() {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'wp_theme_add_support');