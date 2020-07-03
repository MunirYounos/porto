<?php
/*
@package porto theme

		=================
		ADMIN PAGE
		=================
*/

function porto_add_admin_page() {
	add_menu_page( 'Porto Theme Options', 'My Portfolio', 'manage_options', 'munir_porto', 'porto_theme_create_page', get_template_directory_uri() . '/assets/images/porto-fav.png', 110 );

	// Porto admin pages 
	add_submenu_page( 'munir_porto', 'Porto Theme Options', 'General', 'manage_options', 'munir_porto', 'porto_theme_create_page' );
	add_submenu_page( 'munir_porto', 'Porto Theme Options', 'Post formats', 'manage_options', 'munir_porto_theme', 'porto_portfolio_settings');
	add_submenu_page( 'munir_porto', 'Porto CSS Options', 'Custom CSS', 'manage_options', 'munir_porto_css', 'porto_theme_settings_page');


	// Activate custom settings for porto theme
	add_action( 'admin_init', 'porto_custom_settings');
}
add_action('admin_menu', 'porto_add_admin_page');
	// Activate custom settings function call here 
	function porto_custom_settings(){
		register_setting( 'porto-settings-group', 'banner_picture');
		register_setting( 'porto-settings-group', 'first_name');
		register_setting( 'porto-settings-group', 'last_name');
		register_setting( 'porto-settings-group', 'banner_description');
		// social media registers 
		register_setting( 'porto-settings-group', 'linkedin_handler', 'porto_sanitize_linkedin_handler');
		register_setting( 'porto-settings-group', 'facebook_handler');
		register_setting( 'porto-settings-group', 'github_handler');

		add_settings_section( 'porto-portfolio-options', 'Portfolio Custom Options', 'porto_portfolio_options', 'munir_porto' );
		add_settings_field( 'porto-banner-picture', 'Banner Picture', 'porto_portfolio_banner', 'munir_porto', 'porto-portfolio-options');
		add_settings_field( 'porto-name', 'Full Name', 'porto_portfolio_name', 'munir_porto', 'porto-portfolio-options');
		add_settings_field( 'porto-description', 'Banner Description', 'porto_portfolio_description', 'munir_porto', 'porto-portfolio-options');
		
		// social media links
		add_settings_field( 'porto_linkedin', 'Linkedin Profile', 'porto_portfolio_linkedin', 'munir_porto', 'porto-portfolio-options');
		add_settings_field( 'porto_facebook', 'Facebook Profile', 'porto_portfolio_facebook', 'munir_porto', 'porto-portfolio-options');
		add_settings_field( 'porto_github', 'Github Profile', 'porto_portfolio_github', 'munir_porto', 'porto-portfolio-options');
		
		// Portfolio Theme Support Options 
		register_setting( 'porto-support-settings', 'post_formats', 'porto_post_formats_callback' );
		add_settings_section( 'porto-posttypes-support', 'Theme Options', 'porto_posttypes_support', 'munir_porto_theme');
		add_settings_field( 'post-formats', 'Post formats', 'porto_post_formats', 'munir_porto_theme', 'porto-posttypes-support');
	}

function porto_portfolio_options(){
	echo 'Add your portfolio information here';
}
// social media functions 
function porto_portfolio_linkedin(){
	$linkedin = esc_attr( get_option('linkedin_handler') );
	echo '<input type="text" name="linkedin_handler" value="' . $linkedin . '" placeholder= "Linkedin Profile" /><p class="description">Write down your Linkedin Information without @ symbol.</p>';
}
function porto_portfolio_facebook(){
	$facebook = esc_attr( get_option('facebook_handler') );
	echo '<input type="text" name="facebook_handler" value="' . $facebook . '" placeholder= "Facebook Profile" />';
}
function porto_portfolio_github(){
	$github = esc_attr( get_option('github_handler') );
	echo '<input type="text" name="github_handler" value="' . $github . '" placeholder= "Github Profile" />';
}
function porto_portfolio_banner(){
	$banner = esc_attr( get_option('banner_picture') );
	echo '<input id="upload-banner" class="button button-secondary" type="button" value="Upload Banner Picture" /><input type="hidden" name="banner_picture" value="' . $banner .'" id="banner-input-area" />';
}


function porto_portfolio_name(){
	$first_name = esc_attr( get_option('first_name') );
	$last_name = esc_attr( get_option('last_name') );
	echo '<input type="text" name="first_name" value="' . $first_name .'" placeholder="First Name" /><input type="text" name="last_name" value=" ' . $last_name . ' " placeholder="Last Name" />';
}
function porto_portfolio_description(){
	$description = esc_attr( get_option('banner_description') );
	echo '<input type="text" name="banner_description" value="' . $description .'" placeholder="Banner description" /><p class="description"> Add max 50 words of text here.</p>';
}
// sanitization settings 
function porto_sanitize_linkedin_handler($input){
	$output = sanitize_text_field( $input );
	$output = str_replace('@', '', $output);
	return $output;
}
function porto_theme_create_page(){
	require_once(get_template_directory() . '/inc/templates/porto-admin.php');
}
function porto_portfolio_settings(){
	require_once(get_template_directory() . '/inc/templates/porto-settings.php');
}
function porto_theme_settings_page(){

}

// post format callback functions
function porto_post_formats_callback($input){
	return $input;
}
function porto_posttypes_support(){
	echo 'Activate and deactivate post types here';
}
function porto_post_formats(){
	$options = get_option('post_formats');
	$formats = array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'); 
	$output = '';
	foreach($formats as $format){
		$checked = ( @$options[$format] == 1 ? 'checked' : ' ');
		$output .='<label><input type="checkbox" id="'. $format . '" name="post_formats['. $format .']" value="1" ' .$checked. ' /> '. $format . '</label><br>';
	}
	echo $output;
}