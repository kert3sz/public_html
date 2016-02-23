<?
$uploaddir = $_POST['uploaddir'];

	if(substr($uploaddir, -1, 1)!='/') {
		$uploaddir = $uploaddir . '/';
	}
$uploadfile = $uploaddir . $_FILES['userfiles']['name'];

move_uploaded_file($_FILES['userfiles']['tmp_name'], $uploadfile);
