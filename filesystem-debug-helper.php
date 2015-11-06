<?php
/*
  Plugin Name:		Filesystem Debug Helper
  Plugin URI:  		
  Description: 		Helpers for debugging plugins and themes that use the WP Filesystem API. Use this plugin to simulate requiring credentials before writing
  to files on the filesystem. Equivalent to using FTP or SSH to access the filesystem, just convenient if you don't 
  want to bother setting up FTP or SSH on your server. To use: use the username "username" and the password "password"

  Version: 		0.1.0
  Author: 		Event Espresso (Mike Nelson)
  Author URI: 		http://eventespresso.com/?ee_ver=ee4&utm_source=ee4_plugin_admin&utm_medium=link&utm_campaign=wordpress_plugins_page&utm_content=support_link
  License: 		    GPLv2
 * 
 */
define( 'FDH_MAIN_FILE', __FILE__ );
define( 'FDH_PLUGIN_DIR_PATH', plugin_dir_path( FDH_MAIN_FILE ));

function fdh_use_debug_filesystem() {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-filesystem-base.php' );
	require_once( ABSPATH . 'wp-admin/includes/class-wp-filesystem-direct.php' );
	require_once( FDH_PLUGIN_DIR_PATH . 'class-wp-filesystem-debug.php' );
	return 'debug';
}
add_filter( 'filesystem_method', 'fdh_use_debug_filesystem' );

function fdh_connection_types( $types ) {
	$types[ 'debug' ] = __( 'Debug', 'event_espresso' );
	return $types;
}
add_filter( 'fs_ftp_connection_types', 'fdh_connection_types' );

