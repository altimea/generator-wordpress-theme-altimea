<?php
// ==== FUNCTIONS ==== //

// Load the configuration file for this installation; all options are set here
if (is_readable(trailingslashit(get_stylesheet_directory()) . 'functions-config.php')) {
    require_once trailingslashit(get_stylesheet_directory()) . 'functions-config.php';
}

// Load configuration defaults for this theme; anything not set in the custom configuration (above) will be set here
require_once trailingslashit(get_stylesheet_directory()) . 'functions-config-defaults.php';

// An example of how to manage loading front-end assets (scripts, styles, and fonts)
require_once trailingslashit(get_stylesheet_directory()) . 'inc/assets.php';

// Required class Custom Posts
require_once trailingslashit(get_stylesheet_directory()) . 'inc/custom_posts/MyCustomPost.php';

//Required Geo IP
//require_once trailingslashit(get_stylesheet_directory()) . 'inc/geoip/GeoIP.php';

// Required class Actions
//require_once trailingslashit(get_stylesheet_directory()) . 'inc/actions/NavHeadAction.php';
require_once trailingslashit(get_stylesheet_directory()) . 'inc/actions/AddNavMenu.php';

// Required class Widgets
//require_once trailingslashit(get_stylesheet_directory()) . 'inc/widgets/MyWidget.php';

// Required class Template
require_once trailingslashit(get_stylesheet_directory()) . 'inc/<%= name_class %>.php';
require_once trailingslashit(get_stylesheet_directory()) . 'inc/ThemeOption.php';

// extra need order
require_once trailingslashit(get_stylesheet_directory()) . 'inc/custom_fields/CustomFields.php';

// Only the bare minimum to get the theme up and running
function theme_setup()
{
    // Language loading
    load_theme_textdomain('<%= name %>-theme', trailingslashit(get_template_directory()) . 'languages');

    // HTML5 support; mainly here to get rid of some nasty default styling that WordPress used to inject
    add_theme_support('html5', array('search-form', 'gallery'));

    // $content_width limits the size of the largest image size available via the media uploader
    // It should be set once and left alone apart from that; don't do anything fancy with it; it is part of WordPress core
    global $content_width;
    if (!isset($content_width) || !is_int($content_width)) {
        $content_width = (int)960;
    }
}

add_action('after_setup_theme', 'theme_setup', 11);

$<%= name_class %> = new <%= name_class %>();
CustomFields::getInstance();
new ThemeOption();


// REORDER (ADD PAGE TO ENABLE THEME)
if (isset($_GET['activated']) && is_admin()){

	$new_pages = array();
	$new_pages[0] = array('slug' => 'pagina-demo', 'title' => 'Pagina Demo');

	// 01 page
	$new_page_template = 'templates/template-demo.php'; //ex. template-custom.php. Leave blank if you don't want a custom page template.
	$page_check1 = get_page_by_title($new_pages[0]['title']);
	$new_page = array(
		'post_type' => 'page',
		'post_title' => $new_pages[0]['title'],
		'post_content' => '',
		'post_status' => 'publish',
		'post_author' => 1,
	);
	if(!isset($page_check1->ID)){
		$new_page_id = wp_insert_post($new_page);
		if(!empty($new_page_template)){
			update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
		}
	}
}
