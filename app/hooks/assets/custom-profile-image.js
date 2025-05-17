jQuery(document).ready(function($) {
    // Uploading files
    var file_frame;
    var wp_media_post_id = wp.media.model.settings.post.id;
    var set_to_post_id = $('#custom_profile_image_id').val();

    $('#custom_profile_image_upload').on('click', function(event) {
        event.preventDefault();
        
        if (file_frame) {
            file_frame.uploader.uploader.param('post_id', set_to_post_id);
            file_frame.open();
            return;
        } else {
            wp.media.model.settings.post.id = set_to_post_id;
        }
        
        file_frame = wp.media.frames.file_frame = wp.media({
            title: 'Select a profile image',
            button: { text: 'Use this image' },
            multiple: false
        });
        
        file_frame.on('select', function() {
            var attachment = file_frame.state().get('selection').first().toJSON();
            $('#custom_profile_image_id').val(attachment.id);
            $('.custom-profile-image-preview').attr('src', attachment.url);
            $('#custom_profile_image_remove').show();
            wp.media.model.settings.post.id = wp_media_post_id;
        });
        
        file_frame.open();
    });
    
    $('a.add_media').on('click', function() {
        wp.media.model.settings.post.id = wp_media_post_id;
    });
    
    $('#custom_profile_image_remove').on('click', function(event) {
        event.preventDefault();
        $('#custom_profile_image_id').val('');
        $('.custom-profile-image-preview').attr('src', $('.custom-profile-image-preview').attr('data-default'));
        $(this).hide();
    });
});