$("document").ready(function() {
		$("ul.jun_thumbnails li").click(function () {
			$("#jun_images").load('/ci/images_display.php', {'id': $(this).attr('id')});
			$("ul.jun_thumbnails li").removeClass('jun_highlight');
			$(this).addClass('jun_highlight');
		});
	});