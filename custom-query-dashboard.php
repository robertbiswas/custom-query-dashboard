<?php
/**
 * Plugin Name: Custom Query in Dashboard
 * Plugin URI: https://robertbiswas.com
 * Description: Paractice custom query and showing result in Dashboard Menu.
 * Author: Robert Biswas
 * Version: 1.0.0
 * 
 */

class Custom_Query_Dashboard{

	private static $instance;

	public static function get_instance(){
		if ( ! self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	private function __construct(){
		$this->require_classes();
	}

	private function require_classes(){
		require_once __DIR__ . '/includes/cud-admin-menu.php';
		new CUD_Admin_menu();
	}
}

Custom_Query_Dashboard::get_instance();