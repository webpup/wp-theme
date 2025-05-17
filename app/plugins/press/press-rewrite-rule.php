<?php
function custom_press_rewrite_rules()
{
    // 1. For the press index: sample.com/press
    add_rewrite_rule(
        '^press/?$',
        'index.php?page_id=' . get_option('page_for_posts'),
        'top'
    );

    // 2. For single posts: sample.com/press/post-name
    add_rewrite_rule(
        '^press/([^/]+)/?$',
        'index.php?post_type=press&name=$matches[1]',
        'top'
    );

    // 3. Optional: For pagination (sample.com/press/page/2)
    add_rewrite_rule(
        '^press/page/([0-9]+)/?$',
        'index.php?paged=$matches[1]&post_type=press',
        'top'
    );
}
add_action('init', 'custom_press_rewrite_rules');

function press_rewrite_flush()
{
    register_press_post_type();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'press_rewrite_flush');

