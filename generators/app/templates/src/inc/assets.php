<?php
// ==== ASSETS ==== //

// Now that you have efficiently generated scripts and stylesheets for your theme, how should they be integrated?
// This file walks you through the approach I use but you are free to do this any way you like

// Enqueue front-end scripts and styles
function theme_enqueue_scripts()
{

    // Empty by default, may be populated by conditionals below; this is used to generate the script filename
    $script_name = '';

    // An empty array that can be filled with variables to send to front-end scripts
    $script_vars = array();
    // A generic script handle used internally by WordPress
    $script_handle = '<%= name %>';
    // Namespace for scripts; this should match what is specified in your `gulpconfig.js` (and it's safe to leave alone)
    $ns = '<%= name %>';

    // Figure out which script bundle to load based on various options set in `src/functions-config-defaults.php`
    // Note: bundles require fewer HTTP requests at the expense of addition caching hits when different scripts are requested on different pages of your site
    // You could also load one main bundle on every page with supplementary scripts as needed (e.g. for commenting or a contact page); it's up to you!

    // Plugins bundle
    $plugins_file_md5 = substr(md5_file(get_stylesheet_directory() . '/js/' . $ns . '-plugins.js'), 0, 10);
    $plugins_file_name = WP_ENV == 'dev' ? $ns . '-plugins.js' : $ns . '-plugins_' . $plugins_file_md5 . '.js';
    $plugins_file_handler = get_stylesheet_directory_uri() . '/js/' . $plugins_file_name;
    wp_enqueue_script($script_handle . '-plugins', $plugins_file_handler, array('jquery'), false, true);

    // Load theme-specific JavaScript bundles with versioning based on last modified time; http://www.ericmmartin.com/5-tips-for-using-jquery-with-wordpress/
    // The handle is the same for each bundle since we're only loading one script; if you load others be sure to provide a new handle
    $script_name = '-core';
    $theme_file_md5 = substr(md5_file(get_stylesheet_directory() . '/js/' . $ns . $script_name . '.js'), 0, 10);
    $theme_file_name = WP_ENV == 'dev' ? $ns . $script_name . '.js' : $ns . $script_name . '_' . $theme_file_md5 . '.js';
    $theme_file_handler = get_stylesheet_directory_uri() . '/js/' . $theme_file_name;
    wp_enqueue_script($script_handle . $script_name, $theme_file_handler, array($script_handle . '-plugins'), false, true);

    // Pass variables to JavaScript at runtime; see: http://codex.wordpress.org/Function_Reference/wp_localize_script
    $script_vars = apply_filters('theme_script_vars', $script_vars);
    if (!empty($script_vars)) {
        wp_localize_script($script_handle . '-plugins', 'jsVars', $script_vars);
    }

    // Register and enqueue our main stylesheet with versioning based on last modified time
    $theme_style_file_md5 = substr(md5_file(get_stylesheet_directory() . '/style.css'), 0, 10);
    if (WP_ENV == 'dev') {
      $stylesheet = 'style.css';
    } else {
      $stylesheet = 'style_' . $theme_style_file_md5 . '.css';
    }
    $theme_style_file_handler = get_stylesheet_directory_uri() . '/' . $stylesheet;
    wp_register_style('theme-style', $theme_style_file_handler, $dependencies = array(), false);
    wp_enqueue_style('theme-style');

}

add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');


// Provision the front-end with the appropriate script variables
function theme_update_script_vars($script_vars = array())
{

    // Non-destructively merge script variables if a particular condition is met (e.g. `is_archive()` or whatever); useful for managing many different kinds of script variables
    return array_merge($script_vars, array(
        'baseUrl' => get_bloginfo('url'),
        'ajaxUrl' => admin_url('admin-ajax.php')
    ));
}

add_filter('theme_script_vars', 'theme_update_script_vars');
