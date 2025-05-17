<?php

// echo ;
// echo "<br>";
// echo PLUGIN_DIR_PATH;

// Enqueue media uploader scripts
function pim_admin_media_scripts() {
    global $post_type;
    if ('pim' == $post_type) {
           wp_enqueue_media();
            wp_enqueue_style(
                'pim-meta-fields',
                plugin_dir_url(__FILE__) . 'assets/pim-media-upload.css',
                array(),
                filemtime(plugin_dir_path(__FILE__) . 'assets/pim-media-upload.css')
            );
            wp_enqueue_script(
                'pim-media-upload',
                plugin_dir_url(__FILE__) . 'assets/pim-media-upload.js',
                array('jquery'),
                filemtime(plugin_dir_path(__FILE__) . 'assets/pim-media-upload.js'),
                true
            );
    }
}
add_action('admin_enqueue_scripts', 'pim_admin_media_scripts');