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



/* 

===========================
FRONTEND ENQUEUE FUNCTIONS
===========================


*/

function porto_load_frontend_scripts(){
	wp_enqueue_style( 'porto-main-styles', get_template_directory_uri() . '/assets/css/main.css' , array(), '1.0.0', 'all' );
	wp_enqueue_style( 'swiper', get_template_directory_uri() . '/assets/css/partials/swiper.min.css' , array(), '0.0.01', 'all' );
	wp_enqueue_style('porto_fontawesome', 'https://use.fontawesome.com/releases/v5.13.0/css/all.css');
	wp_enqueue_style('porto_main_styles', get_stylesheet_uri());
	wp_deregister_script( 'jquery' );
	wp_enqueue_script('porto_main_js', get_theme_file_uri('/assets/js/swiper.min.js'), NULL, '0.4', true);
	wp_enqueue_script('swiper_js', get_theme_file_uri('/assets/js/main.js'), NULL, '0.3', true);

}

add_action( 'wp_enqueue_scripts', 'porto_load_frontend_scripts');