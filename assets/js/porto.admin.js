jQuery(document).ready(function($){

	var mediaUploader;
	$('#upload-banner').on('click', function(e){
		e.preventDefault();
		if(mediaUploader){
			mediaUploader.open();
			return;
		}
		mediaUploader = wp.media.frames.file_frame = wp.media({
				title: 'Choose a Banner Picture',
				button: {
					text: 'Choose Picture'
				},
				multiple: false
		});

		mediaUploader.on('select', function(){
			attachment = mediaUploader.state().get('selection').first().toJSON();
			$('#banner-input-area').val(attachment.url);
			$('.porto-image').css('background-image', 'url('+ attachment.url + ')');
		});
		mediaUploader.open();
	});

	$('#remove-banner').on('click', function(e){
		e.preventDefault();
		var answer = confirm("Are you sure you want to remove banner?");
		if(answer == true){
			$('#banner-input-area').val('');
			$('.porto-general-form').submit();
		} 
		return;
	});
});