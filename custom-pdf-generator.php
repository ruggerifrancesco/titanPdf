<?php
/*
 * Plugin Name:       TitanPDF Generator + Elementor Widget
 * Description:       Generates a PDF of the article page, from an elementor widget.
 * Version:           1.0
 * Requires at least: 6.4
 * Requires PHP:      7.2
 * Author:            Francesco Ruggeri
 * Author URI:        https://www.linkedin.com/in/francesco-ruggeri-265bb8290/
 * License:           GPL v2 or later, TCPDF
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
*/

define('PLUGIN_JS_DIR', plugin_dir_url(__FILE__) . 'js/');
define('PLUGIN_CSS_DIR', plugin_dir_url(__FILE__) . 'css/');
define('PLUGIN_IMAGES_DIR', plugin_dir_url(__FILE__));
define('PLUGIN_WIDGETS_DIR', plugin_dir_url(__FILE__));

// Initialize the plugin
function titanPdf_generator_init() {
    add_action('admin_menu', 'titanPdf_generator_menu');
    add_action('admin_menu', 'titanPdf_generator_pluginSettings');
}

// Call the initialization function
add_action('init', 'titanPdf_generator_init');

function titanPdf_generator_menu() {
    add_menu_page(
        'Titan PDF',
        'Titan PDF',
        'manage_options',
        'titanPdf_generator',
        'titanPdf_generator_dashboard',
        'dashicons-pdf',
        60 // Position in the menu
    );
}

// Submenu page
function titanPdf_generator_pluginSettings() {
    // Parameters: parent slug, page title, menu title, capability, menu slug, callback function
    add_submenu_page(
        'titanPdf_generator', // The slug of the parent menu
        'Settings',
        'Settings',
        'manage_options',
        'titanPdf_generator_pluginSettings', 
        'titanPdf_generator_pluginSettings_page_callback'
    );
}

// Plugin Settings
function titanPdf_generator_settings() {
    // No settings for now
}

// Languages Settings
function load_plugin_text_domain() {
    load_plugin_textdomain('your-text-domain', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}
add_action('plugins_loaded', 'load_plugin_text_domain');

// Using JQUERY to load JS scripts
function enqueue_jquery() {
    wp_enqueue_script('jquery');
}

add_action('admin_enqueue_scripts', 'enqueue_jquery');

// Custom JS
function enqueue_plugin_script() {
    wp_enqueue_script('modal-script', PLUGIN_JS_DIR . 'modal-script.js', ['jquery'], null, true);
    wp_enqueue_script('tabs-script', PLUGIN_JS_DIR . 'tabs-script.js', ['jquery'], null, true);
}

add_action('admin_enqueue_scripts', 'enqueue_plugin_script');

// Custom CSS 
function enqueue_plugin_styles() {
    wp_enqueue_style('titanpdf-styles', PLUGIN_CSS_DIR . 'titanpdf-styles.css');
}

add_action('admin_enqueue_scripts', 'enqueue_plugin_styles');

function titanPdf_generator_dashboard() {
    require_once( __DIR__ . '/wp_classes/titanPdf_posts_table.php' );

    echo '<section class="wrap">';

    // Display alerts
    echo '<div id="plugin-alerts"></div>';

    echo '<h2 class="nav-tab-wrapper" id="plugin-tabs">';
    echo '<a class="nav-tab nav-tab-active" data-tab="posts-tab" href="#posts-tab">' . __('Posts', 'your-text-domain') . '</a>';
    echo '<a class="nav-tab" data-tab="pages-tab" href="#pages-tab">' . __('Pages', 'your-text-domain') . '</a>';
    echo '</h2>';

    // Posts table
    echo '<div id="posts-tab" class="tab-content">';
    $posts_table = new TitanPDF_Posts_List_Table();
    $posts_table->prepare_items();
    $posts_table->display();
    echo '</div>';

    // Pages table (coming soon)
    echo '<div id="pages-tab" class="tab-content" style="display: none;">';
    echo 'Pages table coming soon...';
    echo '</div>';

    echo '</section>';
}

// Callback function for the submenu page
function titanPdf_generator_pluginSettings_page_callback() {
    echo '<div class="wrap">';
    echo '<h1>Submenu Page Content</h1>';
    echo '<p>This is the content of the submenu page.</p>';
    echo '</div>';
}

add_action('admin_init', 'titanPdf_generator_settings');

function register_new_widgets( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/titanpdf-gen-button.php' );

	$widgets_manager->register( new \TitanPDF_Button_Widget() );
}
add_action( 'elementor/widgets/register', 'register_new_widgets' );


function enqueue_elementor_widget_scripts() {
    // Enqueue styles
    wp_enqueue_style('custom-pdf-widget-styles', plugin_dir_url(__FILE__) . 'widgets/custom-pdf-widget.css');

    // Enqueue scripts
    wp_enqueue_script('custom-pdf-widget-script', plugin_dir_url(__FILE__) . 'widgets/custom-pdf-widget.js', ['jquery'], null, true);
}

add_action('elementor/frontend/after_enqueue_styles', 'enqueue_elementor_widget_scripts');















