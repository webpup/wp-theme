<?php
/**
 * Template for rendering the Pim episode details meta box
 * 
 * @param WP_Post $post The current post object
 * @param array $args {
 *     @type string $episode_number The episode number
 *     @type string $banner_img The banner image URL
 *     @type string $media_link The media link URL
 * }
 */

// Extract variables from args
extract($args);
?>

<div class="pim-meta-fields">
    <div class="pim-field">
        <label for="episode_number"><?php _e('Episode Number', 'text_domain'); ?></label>
        <input type="number" id="episode_number" name="episode_number" value="<?php echo esc_attr($episode_number); ?>" readonly class="widefat" />
        <p class="description">Automatically generated episode number</p>
    </div>

    

    <div class="pim-field">
        <label for="media_link"><?php _e('Audio/Video Link', 'text_domain'); ?></label>
        <input type="url" id="media_link" name="media_link" value="<?php echo esc_url($media_link); ?>" class="widefat" />
    </div>
</div>