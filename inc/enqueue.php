<?php 
/*
@package porto theme

		=================
		ADMIN ENQUEUES
		=================
*/

function porto_admin_scripts($hook){
//echo $hook;
	 if('toplevel_page_munir_porto' == $hook){

	wp_register_style('porto_admin', get_template_directory_uri() . '/assets/admin/porto.admin.css' , array(), '1.0.0', 'all' );
	wp_enqueue_style( 'porto_admin' );

	wp_enqueue_media();

	wp_register_script( 'porto-admin-script', get_template_directory_uri() . '/assets/js/porto.admin.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'porto-admin-script' );
} else if('my-portfolio_page_munir_porto_css' == $hook) {
	wp_enqueue_style( 'ace', get_template_directory_uri() . '/assets/admin/porto.ace.css' , array(), '1.0.0', 'all' );
	wp_enqueue_script( 'ace', get_template_directory_uri(). '/assets/js/ace/ace.js', array('jquery'), '1.4.5', true );
	wp_enqueue_script( 'porto-custom-css-script', get_template_directory_uri() . '/assets/js/porto.custom-css.js', array('jquery'), '1.0.0', true );
} 

else { return; }
}
add_action( 'admin_enqueue_scripts', 'porto_admin_scripts' );