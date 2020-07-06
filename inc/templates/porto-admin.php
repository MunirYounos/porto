<h1>Porto Banner Options</h1>
<?php settings_errors(); ?>
<?php
	$banner = esc_attr( get_option('banner_picture') );
	$first_name = esc_attr( get_option('first_name') );
	$last_name = esc_attr( get_option('last_name') );
	$description = esc_attr( get_option('banner_description') );
	$fullname = $first_name . ' ' . $last_name; 
?>
<div class="porto-banner-preview">
	<div class="porto-image" style="background-image: url(<?php echo $banner; ?>);"></div>
	<h1 class="porto-fullname"> <?php echo $fullname; ?></h1>
	<h2 class="porto-description"><?php echo $description; ?></h2>
	<div class="porto-icons">

	</div>
</div>

<form  method="post" action="options.php" class="porto-general-form">
	<?php settings_fields( 'porto-settings-group' ); ?>
	<?php	do_settings_sections( 'munir_porto' ); ?>
	<?php submit_button('Save Changes', 'primary', 'btnSubmit'); ?>
</form>