<?php

class CUD_Admin_menu{

	public function __construct(){
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
	}

	public function admin_menu() {
		add_menu_page(
			'WP Custom Qurey', // Page title
			'WP Custom Qurey', // Menu Title
			'manage_options', // Capability
			'cud_custom_query', // menu slug
			array( $this, 'cud_custom_qurey_callback' ),
		);
	}

	public function cud_custom_qurey_callback(){
		
		
		$blogusers = get_users( array( 'capability__in' => array( 'publish_posts' ) ) );
		
		$terms = get_terms( array(
			'taxonomy' => 'category',
		) );

		$post_args = array(
			'post_type' => 'post',
		);

		if ( isset( $_GET['custom_cat']) && ( 0 < (int) $_GET['custom_cat'] ) ){
			$post_args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field' => 'term_id',
					'terms' => $_GET['custom_cat'],
				),
			);
		}

		if ( isset( $_GET['user_author']) && ( 0 < (int) $_GET['user_author'] ) ){
			$post_args['author'] = $_GET['user_author'];
		}

		$posts = get_posts( $post_args );
		include_once __DIR__ . '/templates/cud-custom-query-view.php';
	}
}