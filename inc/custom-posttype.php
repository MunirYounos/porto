<?php
/*
@package porto theme

		===================================
		THEME CUSTOM POST TYPES
		===================================
*/

$contact = get_option('activate_contact');
if(@$contact = 1 ){
	add_action( 'init', 'porto_contact_custom_post_type' );
	add_filter('manage_porto-contact_posts_columns', 'porto_set_contact_columns');
	add_action( 'manage_porto-contact_posts_custom_column', 'porto_contact_custom_column', 10, 2);
	add_action( 'add_meta_boxes', 'porto_contact_add_meta_box' );
	add_action( 'save_post', 'porto_save_contact_email_data' );
}

// Custom contact  post type 

function porto_contact_custom_post_type(){
	$labels = array(
		'name'															=> 'Messages',
		'singular_name'											=> 'Message',
		'menu_name'													=> 'Messages',
		'name_admin_bar'										=> 'Message'
	);
	$args = array(
		'labels'														=> $labels,
		'show_ui'														=> true,
		'show_in_menu'											=> true,
		'capability_type'										=> 'post',
		'hierarchical'											=> false,
		'menu_position'											=> 26,
		'menu_icon'													=> 'dashicons-format-chat',
		'supports'													=> array( 'title', 'editor', 'author')
	);
	register_post_type( 'porto-contact', $args);
}

function porto_set_contact_columns( $columns ){
	$newColumns = array();
	$newColumns['title'] = 'Full Name';
	$newColumns['message'] = 'Message';
	$newColumns['email'] = 'Email Address';
	$newColumns['date'] = 'Date Recieved';

	return $newColumns;
}

function porto_contact_custom_column($column, $post_id){

	switch( $column ) {
		case 'message':
			// message column
			echo get_the_excerpt();
		break;

		case 'email' :
			//email column
			$email = get_post_meta( $post_id, '_contact_email_value_key', true );
			echo '<a href="mailto:' .$email. '">' .$email. '</a>' ;
		break;

	}
}
	/* contact meta boxes */

	function porto_contact_add_meta_box() {
		add_meta_box( 'contact_email', 'User Email', 'porto_contact_email_callback', 'porto-contact', 'normal', 'high');
	}
	function porto_contact_email_callback($post){
		wp_nonce_field( 'porto_save_contact_email_data', 'porto_contact_email_meta_box_nonce' );
		$value = get_post_meta( $post->ID, '_contact_email_value_key', true );

		echo '<label for="porto_contact_email_field">User Email Address  </label>';
		echo '<input type="email" id="porto_contact_email_field" name="porto_contact_email_field" value="' . esc_attr( $value). '" size="25" />';

	}
	function porto_save_contact_email_data($post_id) {
		if(! isset($_POST['porto_contact_email_meta_box_nonce'])) {
			return;
		}
		if(! wp_verify_nonce($_POST[ 'porto_contact_email_meta_box_nonce' ], 'porto_save_contact_email_data')) {
			return;
		}
		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
			return;
		}
		if(! current_user_can( 'edit_post', $post_id )){
			return;
		}
		if( ! isset( $_POST['porto_contact_email_field'])) {
			return;
		}

		$email_data = sanitize_text_field($_POST[ 'porto_contact_email_field']);
		update_post_meta( $post_id, '_contact_email_value_key', $email_data );
	}