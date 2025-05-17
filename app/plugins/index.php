<?php

define("PLUGIN_TEMPLATE_URL", get_template_directory_uri() . '/app/plugins/');

define("PLUGIN_DIR_PATH", __DIR__ . '/app/plugins/');

function load_plugin_styles($template_name)
{
}

/**
 * Locate and load a template file with variables
 * 
 * @param string $template_name The template name (without .php)
 * @param array $args Variables to pass to the template
 * @param bool $echo Whether to echo or return the output
 * @return string|void
 */
function load_plugin_template($template_name, $args = array(), $echo = true)
{

    $template_file = __DIR__ . "/templates/{$template_name}.php";
    if (file_exists($template_file)) {
        load_template($template_file, false, $args);
    } else {
        $message = "File does not exist: $template_file";
        var_dump($message);
        error_log($message);
        echo <<<EOD
        <div class="error">
            <p>Template file is missing.</p>
            <p style="color:red">$template_file</p>
        </div>
        EOD;
    }

}


// Load Plugins
require_once 'pim/pim-post-plugin.php';
require_once 'blog/blog-post-plugin.php';
require_once 'press/press-post-plugin.php';