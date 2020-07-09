<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<title><?php bloginfo( 'title' );  wp_title();?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="description" content="<?php bloginfo( 'description' ) ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php if(is_singular() && pings_open( get_queried_object()) ) : ?>
	<linl rel="pingback" href="<?php bloginfo( 'pingback_url' )?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'porto' )?>>
<header class="head-top">
<div class="container ">
		<div class="logo porto-icon">
		<a href="/" class="porto-porto-logo "></a>
		</div>
    <nav class="navigation ">
            <?php wp_nav_menu( array(
                    'theme_location'        => 'primary',
                    'container'             => false,
                    'menu_class'            =>'unstyle',
                    'walker'                => new Porto_Walker_Nav_Primary()
            ));?>
    </nav>
    <div class="search-toggle-wrap">
        <span class="search-icon"><i class="fas fa-search"></i></span>
        <div class="toggle-wrap"><span class="nav-toggle"></span></div>
        <form action="" class="search-form">
            <input type="text" name="search" id="search" placeholder="Search here ...">
            <button type="submit"><i class="fas fa-search"></i></button>
            <span class="search-closer"></span>
        </form>
    </div>
</div>
</header>
