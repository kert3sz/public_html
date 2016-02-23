$( document ).ready(function() {
	
	href = 'directory';
	getDirectory(href);
	
	$(document).on('click', 'a', function (event) {	
		$('#winActive').val('');
		if($(this).hasClass('directory')){
		href = $(this).attr('data-href');
		getDirectory( href );
		} else {
			$('.active').removeClass('active');
			$(this).addClass('active');
			$('#winActive').val( $(this).attr('data-href') );
		}	
		return false;
	});
	
	$('.delete').click(function() {
		$.post('delfile.php',
		{ file: $(this).prev().val() })
		$('#winActive').val('');
		getDirectory( href );
	});
	
		$('.rename').click(function() {
		$.get("renamefile.php", { nameold: $('#winActive').val(), namenew: $(this).prev().val() });
		$('#winActive').val('');
		$('#renameFile').val('');
		getDirectory( href );
	});

	$('.fileinput').change(function(){
		var send_url = 'addfile.php';
		var fd = new FormData();
		fd.append('userfiles', this.files[0]);
		fd.append('uploaddir', href);
		
		$.ajax({
			url: send_url,
			type: "POST",
			data: fd,
			processData: false,
			contentType: false,
			success: function() {
			$('.fileinput').val('');
			getDirectory(href);
		}
		});
	});
	
});


function getDirectory(dir) {
	$.ajax({
		url: 'default.php?dir=' + dir,
		success: function(data) {
			$('#listingcontainer').html(data);
		}
	});
	
	$('input[name="userfile"]').attr('data-url', dir);
}

