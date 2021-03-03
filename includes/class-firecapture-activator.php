<?php

/**
 * Fired during plugin activation
 *
 * @link       tenish.pb.design
 * @since      1.0.0
 *
 * @package    Firecapture
 * @subpackage Firecapture/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Firecapture
 * @subpackage Firecapture/includes
 * @author     FireAnt <shresthatenish121@gmail.com>
 */
class Firecapture_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;
		$table_name = $wpdb->prefix .'fire_capture_table';

		$charset_collate = $wpdb->get_charset_collate();
		
		$sql = "CREATE TABLE IF NOT EXISTS $table_name (
		  id mediumint(9) NOT NULL AUTO_INCREMENT,
		  name varchar(255) NOT NULL,
		  params longtext NOT NULL,
		  ref varchar(255),
		  page varchar(255) NOT NULL,
		  PRIMARY KEY  (id)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}

}