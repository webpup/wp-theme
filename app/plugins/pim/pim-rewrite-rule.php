<?php
// Custom rewrite rule for episode number
function pim_custom_rewrite_rule() {
    add_rewrite_rule(
        '^pim/([0-9]+)-([^/]+)/?$',
        'index.php?post_type=pim&name=$matches[2]',
        'top'
    );
}
add_action('init', 'pim_custom_rewrite_rule');


// Flush rewrite rules on activation
function pim_rewrite_flush() {
    register_pim_post_type();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'pim_rewrite_flush');