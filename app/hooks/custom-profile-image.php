<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class Custom_Profile_Image {

    public function __construct() {
        $this->init();
    }

    public function init() {
        // Add hooks
        add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
        
        // Add profile section at the top
        add_action('show_user_profile', array($this, 'add_profile_image_section'), 0);
        add_action('edit_user_profile', array($this, 'add_profile_image_section'), 0);
        
        // Save handlers
        add_action('personal_options_update', array($this, 'save_profile_image_field'));
        add_action('edit_user_profile_update', array($this, 'save_profile_image_field'));
        
        // Avatar replacement
        add_filter('get_avatar_data', array($this, 'replace_gravatar_with_custom'), 10, 2);
    }

    public function enqueue_scripts($hook) {
        if ($hook === 'profile.php' || $hook === 'user-edit.php') {
            wp_enqueue_media();
            wp_enqueue_style(
                'custom-profile-image-css',
                plugin_dir_url(__FILE__) . 'assets/custom-profile-image.css',
                array(),
                filemtime(plugin_dir_path(__FILE__) . 'assets/custom-profile-image.css')
            );
            wp_enqueue_script(
                'custom-profile-image-js',
                plugin_dir_url(__FILE__) . 'assets/custom-profile-image.js',
                array('jquery'),
                filemtime(plugin_dir_path(__FILE__) . 'assets/custom-profile-image.js'),
                true
            );
        }
    }

    // Add profile image section at the top
    public function add_profile_image_section($user) {
        ?>
        <div class="custom-profile-image-top-section">
            <h2><?php esc_html_e('Profile Image', 'custom-profile-image'); ?></h2>
            <table class="form-table">
                <tr>
                    <th><label for="custom_profile_image"><?php esc_html_e('Profile Image', 'custom-profile-image'); ?></label></th>
                    <td>
                        <?php $this->render_profile_image_field($user); ?>
                    </td>
                </tr>
            </table>
        </div>
        <?php
    }

    private function render_profile_image_field($user) {
        $image_id = get_user_meta($user->ID, 'custom_profile_image_id', true);
        $image_url = wp_get_attachment_image_url($image_id, 'thumbnail');
        ?>
        <div class="custom-profile-image-container">
            <?php if ($image_url) : ?>
                <img src="<?php echo esc_url($image_url); ?>" class="custom-profile-image-preview" />
            <?php else : ?>
                <img src="<?php echo esc_url(get_avatar_url($user->ID)); ?>" class="custom-profile-image-preview" />
            <?php endif; ?>
        </div>
        <input type="hidden" name="custom_profile_image_id" id="custom_profile_image_id" value="<?php echo esc_attr($image_id); ?>" />
        <p>
            <input type="button" class="button button-secondary" id="custom_profile_image_upload" value="<?php esc_attr_e('Upload Image', 'custom-profile-image'); ?>" />
            <input type="button" class="button button-secondary" id="custom_profile_image_remove" value="<?php esc_attr_e('Remove Image', 'custom-profile-image'); ?>" <?php echo empty($image_id) ? 'style="display:none;"' : ''; ?> />
        </p>
        <p class="description">
            <?php esc_html_e('Upload a custom profile image. This will replace your Gravatar.', 'custom-profile-image'); ?>
        </p>
        <?php
    }

    public function save_profile_image_field($user_id) {
        if (!current_user_can('edit_user', $user_id)) {
            return false;
        }

        if (isset($_POST['custom_profile_image_id'])) {
            update_user_meta($user_id, 'custom_profile_image_id', absint($_POST['custom_profile_image_id']));
        }
    }

    public function replace_gravatar_with_custom($args, $id_or_email) {
        $user = false;

        if (is_numeric($id_or_email)) {
            $user = get_user_by('id', absint($id_or_email));
        } elseif (is_object($id_or_email)) {
            if (!empty($id_or_email->user_id)) {
                $user = get_user_by('id', absint($id_or_email->user_id));
            }
        } else {
            $user = get_user_by('email', $id_or_email);
        }

        if ($user && is_object($user)) {
            $image_id = get_user_meta($user->ID, 'custom_profile_image_id', true);
            if ($image_id) {
                $image_url = wp_get_attachment_image_url($image_id, array($args['width'], $args['height']));
                if ($image_url) {
                    $args['url'] = $image_url;
                    $args['found_avatar'] = true;
                }
            }
        }

        return $args;
    }
}

new Custom_Profile_Image();