<?php
/*
@package porto theme

		===================================
		ADMIN THEME SUPPORT FOR POST FORMAT
		===================================
*/

$options = get_option('post_formats');
$formats = array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'); 
$output = array();
foreach($formats as $format){
	$output[] = ( @$options[$format] == 1 ? $format : ' ');
}
if(!empty($options)){
	add_theme_support( 'post-formats', $output);
}

$header = get_option('custom_header');
if(@$header = 1 ){
	add_theme_support('custom-header');
}
$background = get_option('custom_background');
if(@$background = 1 ){
	add_theme_support('custom-background');
}
add_theme_support( 'post-thumbnails' );
/* Navigation */
function porto_register_nav_menu(){
	register_nav_menu( 'primary', 'Header navigation menu.' );
}

add_action( 'after_setup_theme', 'porto_register_nav_menu');

/*
@package porto theme

		===================================
		Blog loop custom date function
		===================================
*/
function porto_posted_meta(){
	echo 'all meta tags are here';
}
function porto_posted_footer(){
	echo 'all footer tags are here ';
}