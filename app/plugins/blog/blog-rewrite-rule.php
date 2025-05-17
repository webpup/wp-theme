<?php
function custom_blog_rewrite_rules()
{
    // 1. For the blog index: sample.com/blog
    add_rewrite_rule(
        '^blog/?$',
        'index.php?page_id=' . get_option('page_for_posts'),
        'top'
    );

    // 2. For single posts: sample.com/blog/post-name
    add_rewrite_rule(
        '^blog/([^/]+)/?$',
        'index.php?post_type=blog&name=$matches[1]',
        'top'
    );

    // 3. Optional: For pagination (sample.com/blog/page/2)
    add_rewrite_rule(
        '^blog/page/([0-9]+)/?$',
        'index.php?paged=$matches[1]&post_type=blog',
        'top'
    );
}
add_action('init', 'custom_blog_rewrite_rules');

function blog_rewrite_flush()
{
    register_blog_post_type();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'blog_rewrite_flush');