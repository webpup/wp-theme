<?php
// Render episode details meta box using external template
function render_pim_episode_details_meta_box($post) {
    wp_nonce_field('pim_episode_details_nonce', 'pim_episode_details_nonce');
    
    // Prepare variables for the template
    $args = array(
        'episode_number' => get_post_meta($post->ID, 'episode_number', true),
        // 'banner_img' => get_post_meta($post->ID, 'banner_img', true),
        'media_link' => get_post_meta($post->ID, 'media_link', true)
    );
    
    
    // Load the template if it exists
    load_plugin_template('pim-meta-box', $args);
}

// Render transcript meta box
function render_pim_transcript_meta_box($post) {
    wp_nonce_field('pim_transcript_nonce', 'pim_transcript_nonce');
    
    $transcript = get_post_meta($post->ID, 'transcript', true);
    ?>
    <textarea id="transcript" name="transcript" rows="10" style="width:100%;"><?php echo esc_textarea($transcript); ?></textarea>
    <?php
}


