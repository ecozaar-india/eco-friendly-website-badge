<?php
/**
 * Plugin Name: Eco-Friendly Website Badge
 * Description: Adds a customizable eco-friendly badge linking to Ecozaar.in to your WordPress site.
 * Version: 1.0.0
 * Author: ecozaar
 * Author URI: https://ecozaar.in
 * License: GPL2
 * Text Domain: eco-friendly-website-badge
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define constants.
define( 'ECOZAAR_BADGE_VERSION', '1.0.0' );
define( 'ECOZAAR_BADGE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'ECOZAAR_BADGE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * Activation hook: Set default options.
 */
function ecozaar_badge_activate() {
	$default_options = array(
		'enabled'   => 0, // Disabled by default (opt-in)
		'placement' => 'footer',   // Options: footer, sidebar, shortcode.
		'size'      => 'medium',   // Options: small, medium, large.
		'url'       => 'https://ecozaar.in', // Default badge URL
	);
	add_option( 'ecozaar_badge_options', $default_options );
}
register_activation_hook( __FILE__, 'ecozaar_badge_activate' );

/**
 * Deactivation hook: Clean up options.
 */
function ecozaar_badge_deactivate() {
	delete_option( 'ecozaar_badge_options' );
}
register_deactivation_hook( __FILE__, 'ecozaar_badge_deactivate' );

// Include admin settings if in admin area.
if ( is_admin() ) {
	require_once ECOZAAR_BADGE_PLUGIN_DIR . 'includes/admin-settings.php';
}

// Include frontend display logic.
require_once ECOZAAR_BADGE_PLUGIN_DIR . 'includes/frontend-display.php';
