<?php
function register_press_post_type()
{
    $labels = array(
        'name' => _x('Press', 'Post Type General Name', 'text_domain'),
        'singular_name' => _x('Press', 'Post Type Singular Name', 'text_domain'),
        'menu_name' => __('Press', 'text_domain'),
        'name_admin_bar' => __('Press', 'text_domain'),
        'archives' => __('Press Archives', 'text_domain'),
        'attributes' => __('Press Attributes', 'text_domain'),
        'parent_item_colon' => __('Parent Press:', 'text_domain'),
        'all_items' => __('All Press', 'text_domain'),
        'add_new_item' => __('Add New Press Release', 'text_domain'),
        'add_new' => __('Add New', 'text_domain'),
        'new_item' => __('New Press Release', 'text_domain'),
        'edit_item' => __('Edit Press Release', 'text_domain'),
        'update_item' => __('Update Press Release', 'text_domain'),
        'view_item' => __('View Press Release', 'text_domain'),
        'view_items' => __('View Press Release', 'text_domain'),
        'search_items' => __('Search Press Release', 'text_domain'),
        'not_found' => __('Not found', 'text_domain'),
        'not_found_in_trash' => __('Not found in Trash', 'text_domain'),
        // 'featured_image'        => __('Banner Image', 'text_domain'),
        // 'set_featured_image'    => __('Set banner image', 'text_domain'),
        // 'remove_featured_image' => __('Remove banner image', 'text_domain'),
        // 'use_featured_image'    => __('Use as banner image', 'text_domain'),
        'insert_into_item' => __('Insert into press', 'text_domain'),
        'uploaded_to_this_item' => __('Uploaded to this press', 'text_domain'),
        'items_list' => __('Press list', 'text_domain'),
        'items_list_navigation' => __('Press list navigation', 'text_domain'),
        'filter_items_list' => __('Filter press list', 'text_domain'),
    );

    $rewrite = array(
        'slug' => 'press',
        'with_front' => true,
        'pages' => true,
        'feeds' => true,
    );

    $args = array(
        'label' => __('Press', 'text_domain'),
        'description' => __('Press', 'text_domain'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'author', 'excerpt'),
        'taxonomies' => array(),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-megaphone',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'rewrite' => $rewrite,
        'capability_type' => 'post',
        'show_in_rest' => true,
    );

    register_post_type('press', $args);
}
add_action('init', 'register_press_post_type', 0);

