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
	add_submenu_page( 'munir_porto', 'Contact Form Options', 'Contact Form', 'manage_options', 'munir_porto_theme_contact', 'porto_contact_form_page');
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
		register_setting( 'porto-support-settings', 'post_formats' );
		add_settings_section( 'porto-posttypes-support', 'Theme Options', 'porto_posttypes_support', 'munir_porto_theme');
		add_settings_field( 'post-formats', 'Post formats', 'porto_post_formats', 'munir_porto_theme', 'porto-posttypes-support');

		// Porto theme support for header and background image activation
		register_setting( 'porto-support-settings', 'custom_header' );
		add_settings_field( 'custom_header', 'Custom Header', 'porto_custom_header', 'munir_porto_theme', 'porto-posttypes-support');
		register_setting( 'porto-support-settings', 'custom_background' );
		add_settings_field( 'custom_background', 'Custom Background', 'porto_custom_background', 'munir_porto_theme', 'porto-posttypes-support');
		// contact form options
		register_setting( 'porto-contact-options', 'activate_contact' );
		add_settings_section( 'porto-contact-section', 'Contact Form', 'porto_contact_section', 'munir_porto_theme_contact' );
		add_settings_field( 'activate-form', 'Activate contact form', 'porto_activate_contact', 'munir_porto_theme_contact', 'porto-contact-section' );

		// Custom CSS inject
		register_setting( 'porto-custom-css-options', 'porto_css', 'porto_sanitize_custom_css');
		add_settings_section( 'porto-custom-css-section', 'Custom CSS', 'porto_custom_css_section_callback', 'munir_porto_css' );
		add_settings_field( 'custom-css', 'Styles', 'porto_custom_css_callback', 'munir_porto_css', 'porto-custom-css-section');

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
	if(empty($banner)){
		echo '<input id="upload-banner" class="button button-secondary" type="button" value="Upload Banner Picture" /><input type="hidden" name="banner_picture" value=" " id="banner-input-area" />';
	}else{
		echo '<input id="upload-banner" class="button button-secondary" type="button" value="Replace Banner Picture" /><input type="hidden" name="banner_picture" value="' . $banner .'" id="banner-input-area" />  <input type="button" id="remove-banner" class="button button-secondary" type="button" value="Remove"/>';
	}

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
function porto_contact_form_page(){
	require_once(get_template_directory() . '/inc/templates/porto-contact.php');
}
function porto_theme_settings_page(){
	require_once(get_template_directory() . '/inc/templates/porto-custom-css.php');
}

// post format callback functions
function porto_custom_header(){
	$options = get_option('custom_header');
	$checked = ( @$options == 1 ? 'checked' : ' ');
	echo '<label><input type="checkbox" name="custom_header" value="1" ' .$checked. ' /> Activate Header </label><br>';
}
function porto_custom_background(){
	$options = get_option('custom_background');
	$checked = ( @$options == 1 ? 'checked' : ' ');
	echo '<label><input type="checkbox" name="custom_background" value="1" ' .$checked. ' /> Activate background </label><br>';
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

// proto contact section
function porto_contact_section(){
	echo 'activate or deactivate contact';
}
function porto_activate_contact(){
	$options = get_option('activate_contact');
	$checked = ( @$options == 1 ? 'checked' : ' ');
	echo '<label><input type="checkbox" name="activate_contact" value="1" ' .$checked. ' /> </label><br>';
}

// css inject 
function porto_custom_css_section_callback(){
 echo 'Customize Porto Theme with your own styles';
}

function porto_custom_css_callback(){
	$css = get_option('porto_css');
	$css = ( empty($css) ? '/* Add Your Styles here*/' : $css);
	echo '<div id="customCss">'. $css .'</div> <textarea id="porto_css" name="porto_css" style="display:none; visible:hidden">'.$css.'</textarea>' ;
}

function porto_sanitize_custom_css($input){
	$output = esc_textarea(  $input );
	return $output;
}