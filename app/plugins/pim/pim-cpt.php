<?php
function register_pim_post_type()
{
    $labels = array(
        'name' => _x('Pim', 'Post Type General Name', 'text_domain'),
        'singular_name' => _x('Pim', 'Post Type Singular Name', 'text_domain'),
        'menu_name' => __('Pim', 'text_domain'),
        'name_admin_bar' => __('Pim', 'text_domain'),
        'archives' => __('Pim Archives', 'text_domain'),
        'attributes' => __('Pim Attributes', 'text_domain'),
        'parent_item_colon' => __('Parent Pim:', 'text_domain'),
        'all_items' => __('All Pim', 'text_domain'),
        'add_new_item' => __('Add New Pim', 'text_domain'),
        'add_new' => __('Add New', 'text_domain'),
        'new_item' => __('New Pim', 'text_domain'),
        'edit_item' => __('Edit Pim', 'text_domain'),
        'update_item' => __('Update Pim', 'text_domain'),
        'view_item' => __('View Pim', 'text_domain'),
        'view_items' => __('View Pim', 'text_domain'),
        'search_items' => __('Search Pim', 'text_domain'),
        'not_found' => __('Not found', 'text_domain'),
        'not_found_in_trash' => __('Not found in Trash', 'text_domain'),
        // 'featured_image'        => __('Banner Image', 'text_domain'),
        // 'set_featured_image'    => __('Set banner image', 'text_domain'),
        // 'remove_featured_image' => __('Remove banner image', 'text_domain'),
        // 'use_featured_image'    => __('Use as banner image', 'text_domain'),
        'insert_into_item' => __('Insert into pim', 'text_domain'),
        'uploaded_to_this_item' => __('Uploaded to this pim', 'text_domain'),
        'items_list' => __('Pim list', 'text_domain'),
        'items_list_navigation' => __('Pim list navigation', 'text_domain'),
        'filter_items_list' => __('Filter pim list', 'text_domain'),
    );

    $rewrite = array(
        'slug' => 'pim',
        'with_front' => true,
        'pages' => true,
        'feeds' => true,
    );

    $args = array(
        'label' => __('Pim', 'text_domain'),
        'description' => __('Pim episodes', 'text_domain'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'author', 'excerpt', 'custom-fields'),
        'taxonomies' => array(),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-microphone',
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

    register_post_type('pim', $args);
}
add_action('init', 'register_pim_post_type', 0);

// Auto-increment episode number
function set_pim_episode_number($post_id)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;
    if (!current_user_can('edit_post', $post_id))
        return;
    if ('pim' !== get_post_type($post_id))
        return;

    $episode_number = get_post_meta($post_id, 'episode_number', true);
    if (empty($episode_number)) {
        $latest_episode = get_posts(array(
            'post_type' => 'pim',
            'numberposts' => 1,
            'orderby' => 'meta_value_num',
            'meta_key' => 'episode_number',
            'order' => 'DESC'
        ));

        $new_episode_number = 1;
        if (!empty($latest_episode)) {
            $last_number = get_post_meta($latest_episode[0]->ID, 'episode_number', true);
            $new_episode_number = intval($last_number) + 1;
        }

        update_post_meta($post_id, 'episode_number', $new_episode_number);
    }
}
add_action('save_post', 'set_pim_episode_number');

// Register custom meta fields for REST API/Gutenberg
function register_pim_meta_fields()
{
    register_post_meta('pim', 'episode_number', array(
        'show_in_rest' => true,
        'single' => true,
        'type' => 'number',
    ));

    register_post_meta('pim', 'transcript', array(
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',
    ));

    register_post_meta('pim', 'media_link', array(
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',
    ));
}
add_action('init', 'register_pim_meta_fields');

// Add meta boxes for Pim post type
function add_pim_meta_boxes()
{

    add_meta_box(
        'pim_episode_details',
        __('Episode', 'text_domain'),
        'render_pim_episode_details_meta_box',
        'pim',
        'side',
        'high'
    );

    add_meta_box(
        'pim_transcript',
        __('Transcript', 'text_domain'),
        'render_pim_transcript_meta_box',
        'pim',
        'normal',
        'default'
    );


}
add_action('add_meta_boxes', 'add_pim_meta_boxes');

