<?php

function wp_theme_load_scripts()
{
    // Enqueue style CSS file
    wp_enqueue_style(
        'wp_theme-style',
        get_parent_theme_file_uri('/style.css'),
        array(),
        wp_get_theme()->get('Version')
    );

    if (defined('WP_ENV') && WP_ENV === 'development') {
        $dev_url = get_site_url() . ":5173/js/main.js";
        echo "Development url : $dev_url";
        echo "<script type='module' src='$dev_url'></script>";

    } else {
        // Enqueue tailwind CSS file
        wp_enqueue_style('main-css', get_theme_file_uri('/dist/css/main.css'));

        // Enqueue main javascript file
        wp_enqueue_script(
            'wp_theme-script',
            get_theme_file_uri('/dist/js/main.js'),
            array(),
            wp_get_theme()->get('Version'),
            true
        );
    }


    // wp_enqueue_script('header', get_theme_file_uri('/assets/js/header.js'), array('jquery'), '1.0', true);

}

add_action('wp_enqueue_scripts', 'wp_theme_load_scripts');


function wp_theme_load_external_scripts()
{
    // wp_register_style(
    //     'splide-css',
    //     'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/css/splide.min.css',
    //     array(),
    //     '4.1.3'
    // );
    // wp_register_script(
    //     'splide-js',
    //     'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/js/splide.min.js',
    //     array(),
    //     '4.1.3',
    //     true  // load in footer
    // );
    // wp_register_script(
    //     'splide-auto-scroll',
    //     'https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll@0.4.0/dist/js/splide-extension-auto-scroll.min.js',
    //     array('splide-js'),
    //     '0.4.0',
    //     true
    // );

    // Enqueue the Splide CSS and JS now that the block is used
    // wp_enqueue_style('splide-css');
    // wp_enqueue_script('splide-js');
    // wp_enqueue_script('splide-auto-scroll');
}
;

add_action('wp_enqueue_scripts', 'wp_theme_load_external_scripts');

function wp_theme_editor_style()
{
    add_editor_style(get_parent_theme_file_uri('assets/css/editor-style.css'));
    // add_editor_style('/assets/css/main.css');
}

add_action('after_setup_theme', 'wp_theme_editor_style');

