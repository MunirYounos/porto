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
	$posted_on = human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ));
	$categories = get_the_category();
	$separator = '  <span class="separator">|</span>  ';
	$output = ' ';
	$i = 1;
	if(!empty($categories)):
			foreach( $categories as $category):
				if($i > 1): $output .= $separator; endif;
				$output .= '<a href="' . esc_url( get_category_link($category -> term_id) ) . '" alt="' . esc_attr( 'View all posts in%s', $category->name ) . '">' . esc_html( $category->name ) . '</a>';
				$i++;
			endforeach;
	endif;
	return '<span class="posted-on"><a href=" '. esc_url(get_permalink()) .  '"> ' . $posted_on  . '</a> ago </span><span class="separator">|</span><span class="posted-in"> '.  $output  .'</span>';

}
function porto_posted_footer(){
	$comments_num = get_comments_number();
	if( comments_open() ){
		if($comments_num == 0){
			$comments = __('No Comments');
		} elseif($comments_num > 1){
			$comments = $comments_num . __(' Comments');
		} else {
			$comments = __('1 Comment');
		}
	} else {
		$comments = __('Comments are closed');
	}
return '<div class="footer-meta-wrapper">' . get_the_tag_list( '<div class="tags-list"><span class="porto-icon"><span class="porto-porto-tag"></span></span>', ' <span class="separator">|</span>  ', '</div>' ) . '</div><div class="footer-comments"><span class="porto-icon"><span class="porto-porto-comment"></span></span><a href="'. get_comments_link() . '">'. $comments .'</a></div>'; 
}; 


function animated_text_frontend_feature($textone, $texttwo, $textthree){
?>
	<h1> <?php echo $textone; ?>
	<strong class="dots">:</strong>
	<a href="" class="typewrite" data-period="2000" 
	data-type='[ 
		"<?php echo $texttwo; ?>" ,
		"<?php echo $textthree; ?>"
	]'>
	<span class="wrap"></span>
	</a>
	</h1>
<?php }