<?php
function register_blog_post_type()
{
    $labels = array(
        'name' => _x('Blog', 'Post Type General Name', 'text_domain'),
        'singular_name' => _x('Blog', 'Post Type Singular Name', 'text_domain'),
        'menu_name' => __('Blog', 'text_domain'),
        'name_admin_bar' => __('Blog', 'text_domain'),
        'archives' => __('Blog Archives', 'text_domain'),
        'attributes' => __('Blog Attributes', 'text_domain'),
        'parent_item_colon' => __('Parent Blog:', 'text_domain'),
        'all_items' => __('All Blog', 'text_domain'),
        'add_new_item' => __('Add New Blog', 'text_domain'),
        'add_new' => __('Add New', 'text_domain'),
        'new_item' => __('New Blog', 'text_domain'),
        'edit_item' => __('Edit Blog', 'text_domain'),
        'update_item' => __('Update Blog', 'text_domain'),
        'view_item' => __('View Blog', 'text_domain'),
        'view_items' => __('View Blog', 'text_domain'),
        'search_items' => __('Search Blog', 'text_domain'),
        'not_found' => __('Not found', 'text_domain'),
        'not_found_in_trash' => __('Not found in Trash', 'text_domain'),
        // 'featured_image'        => __('Banner Image', 'text_domain'),
        // 'set_featured_image'    => __('Set banner image', 'text_domain'),
        // 'remove_featured_image' => __('Remove banner image', 'text_domain'),
        // 'use_featured_image'    => __('Use as banner image', 'text_domain'),
        'insert_into_item' => __('Insert into blog', 'text_domain'),
        'uploaded_to_this_item' => __('Uploaded to this blog', 'text_domain'),
        'items_list' => __('Blog list', 'text_domain'),
        'items_list_navigation' => __('Blog list navigation', 'text_domain'),
        'filter_items_list' => __('Filter blog list', 'text_domain'),
    );

    $rewrite = array(
        'slug' => 'blog',
        'with_front' => true,
        'pages' => true,
        'feeds' => true,
    );

    $args = array(
        'label' => __('Blog', 'text_domain'),
        'description' => __('Blog', 'text_domain'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'author', 'excerpt'),
        'taxonomies' => array(),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-welcome-write-blog',
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

    register_post_type('blog', $args);
}
add_action('init', 'register_blog_post_type', 0);

