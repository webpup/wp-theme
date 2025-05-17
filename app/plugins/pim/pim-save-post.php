<?php 

// Save meta box data
function save_pim_meta_boxes($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    
    // Verify nonces
    if (!isset($_POST['pim_episode_details_nonce']) || !wp_verify_nonce($_POST['pim_episode_details_nonce'], 'pim_episode_details_nonce')) return;
    if (!isset($_POST['pim_transcript_nonce']) || !wp_verify_nonce($_POST['pim_transcript_nonce'], 'pim_transcript_nonce')) return;
    
    
    if (!current_user_can('edit_post', $post_id)) return;
    
    // Save episode details
    // if (isset($_POST['banner_img'])) {
    //     update_post_meta($post_id, 'banner_img', esc_url_raw($_POST['banner_img']));
    // }
    
    if (isset($_POST['media_link'])) {
        update_post_meta($post_id, 'media_link', esc_url_raw($_POST['media_link']));
    }
    
    // Save transcript
    if (isset($_POST['transcript'])) {
        update_post_meta($post_id, 'transcript', $_POST['transcript']);
    }
    
    // Save published date
    // if (isset($_POST['published_date'])) {
    //     update_post_meta($post_id, 'published_date', sanitize_text_field($_POST['published_date']));
    // }
}
add_action('save_post', 'save_pim_meta_boxes');


