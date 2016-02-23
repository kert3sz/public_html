<?
$dirnames = split('/', $_GET['nameold']);

	for($di=0; $di<sizeof($dirnames)-1; $di++) {
		$pathfile .= $dirnames[$di] . '/'; 
	}
$newFileName = $pathfile.$_GET['namenew'];

rename($_GET['nameold'], $newFileName);