<h1>Porto Post Formats</h1>
<?php settings_errors(); ?>
<form method="post" action="options.php">
	<?php settings_fields( 'porto-support-settings' ); ?>
	<?php	do_settings_sections( 'munir_porto_theme' ); ?>
	<?php submit_button(); ?>
</form>