<?php
/**
 * @link              
 * @since             
 * @package           
 *
 * @wordpress-plugin
 * Plugin Name:       Vue Test Plugin
 * Plugin URI:        
 * Description:       Vuejs WordPress Plugin Boilerplate
 * Version:           
 * Author:            
 * Author URI:        
 * License:           
 * License URI:       
 * Text Domain:       
 * Domain Path:       
 * Network:           
 */
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * Returns info about the plugin.
 *
 * @return array
 */
function vue_meta() {
	return array(
		'slug'    => 'wp-vue',
		'name'    => 'WP Vue Plugin',
		'file'    => __FILE__,
		'version' => '1.0',
	);
}
// Where the magic happens...
require plugin_dir_path( __FILE__ ) . 'includes/class-vue.php';
/**
 * Initialize the plugin's functionality once the correct hook fires.
 */
function vue_admin_init() {
	$vue = new Vue_class( vue_meta() );
}
add_action( 'admin_init', 'vue_admin_init' );