<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://indiedev.tools
 * @since             1.0.0
 * @package           Indiedev_Game_Marketer
 *
 * @wordpress-plugin
 * Plugin Name:       IndieDev Game Marketer
 * Plugin URI:        https://www.indiedev.tools/product/indiedev-game-marketer-wp-plugin-for-wordpress/
 * Description:       Promote indie games for all platforms using the power & familiarity of Wordpress.
 * Version:           2.0.7
 * Author:            IndieDev.tools
 * Author URI:        https://www.indiedev.tools
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       indiedev-game-marketer
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

global $idgm_flush_rules;

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-indiedev-game-marketer-activator.php
 */
function activate_indiedev_game_marketer($networkwide) {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-indiedev-game-marketer-activator.php';
	Indiedev_Game_Marketer_Activator::activate($networkwide);
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-indiedev-game-marketer-deactivator.php
 */
function deactivate_indiedev_game_marketer($networkwide) {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-indiedev-game-marketer-deactivator.php';
	Indiedev_Game_Marketer_Deactivator::deactivate($networkwide);
}

register_activation_hook( __FILE__, 'activate_indiedev_game_marketer' );
register_deactivation_hook( __FILE__, 'deactivate_indiedev_game_marketer' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-indiedev-game-marketer.php';

/**
 * Gutenberg blocks
 */
require plugin_dir_path( __FILE__ ) . 'blocks/indiedev-blck.php';
require plugin_dir_path( __FILE__ ) . 'blocks/indiedev-gameblck.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_indiedev_game_marketer() {

    define( 'IDGM_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    require_once WP_PLUGIN_DIR . '/indiedev-game-marketer/includes/class-indiedev-game-marketer-activator.php';
    Indiedev_Game_Marketer_Activator::upgrade(is_network_only_plugin('indiedev-game-marketer/indiedev-game-marketer.php'));
	$plugin = new Indiedev_Game_Marketer();
	$plugin->run();

}

run_indiedev_game_marketer();
