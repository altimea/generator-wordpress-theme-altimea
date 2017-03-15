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
    wp_enqueue_script($script_handle . '-plugins', get_stylesheet_directory_uri() . '/js/' . $ns . '-plugins' . '.js', array(), filemtime(get_template_directory() . '/js/' . $ns . '-plugins' . '.js'), true);

    // Load theme-specific JavaScript bundles with versioning based on last modified time; http://www.ericmmartin.com/5-tips-for-using-jquery-with-wordpress/
    // The handle is the same for each bundle since we're only loading one script; if you load others be sure to provide a new handle
    $script_name = '-core';
    wp_enqueue_script($script_handle . $script_name, get_stylesheet_directory_uri() . '/js/' . $ns . $script_name . '.js', array($script_handle . '-plugins'), filemtime(get_template_directory() . '/js/' . $ns . $script_name . '.js'), true);


    // Pass variables to JavaScript at runtime; see: http://codex.wordpress.org/Function_Reference/wp_localize_script
    $script_vars = apply_filters('theme_script_vars', $script_vars);
    if (!empty($script_vars)) {
        wp_localize_script($script_handle . '-plugins', 'jsVars', $script_vars);
    }

    // Register and enqueue our main stylesheet with versioning based on last modified time
    wp_register_style('theme-style', get_stylesheet_uri(), $dependencies = array(), filemtime(get_template_directory() . '/style.css'));
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
