<h1>Porto Contact Form</h1>
<?php settings_errors(); ?>
<form  method="post" action="options.php">
	<?php settings_fields( 'porto-contact-options' ); ?>
	<?php	do_settings_sections( 'munir_porto_theme_contact' ); ?>
	<?php submit_button(); ?>
</form>