<?
$filetypes = array (
				'png' => 'jpg.gif',
				'jpeg' => 'jpg.gif',
				'bmp' => 'jpg.gif',
				'jpg' => 'jpg.gif', 
				'gif' => 'gif.gif',
				'zip' => 'archive.png',
				'rar' => 'archive.png',
				'exe' => 'exe.gif',
				'setup' => 'setup.gif',
				'txt' => 'text.png',
				'htm' => 'html.gif',
				'html' => 'html.gif',
				'php' => 'php.gif',				
				'fla' => 'fla.gif',
				'swf' => 'swf.gif',
				'xls' => 'xls.gif',
				'doc' => 'doc.gif',
				'sig' => 'sig.gif',
				'fh10' => 'fh10.gif',
				'pdf' => 'pdf.gif',
				'psd' => 'psd.gif',
				'rm' => 'real.gif',
				'mpg' => 'video.gif',
				'mpeg' => 'video.gif',
				'mov' => 'video2.gif',
				'avi' => 'video.gif',
				'eps' => 'eps.gif',
				'gz' => 'archive.png',
				'asc' => 'sig.gif',
			);
if($_GET['dir']) {

	if(substr($_GET['dir'], -1, 1)!='/') {
		$_GET['dir'] = $_GET['dir'] . '/';
	}
	$dirok = true;  // флаг - обрабатываем каталог
	$dirnames = split('/', $_GET['dir']);
	for($di=0; $di<sizeof($dirnames); $di++) {
		if($di<(sizeof($dirnames)-2)) {
			$parentDir = $parentDir . $dirnames[$di] . '/';  // url родительская директория
		}
		if($dirnames[$di] == '..') {
			$dirok = false; //родительский каталог обрабатываем отдельно
		}
	}	
	$loadon.= $_GET['dir'];	
}/*else {	echo '$_GET[dir] = '. $_GET['dir'];	 if ($loadon == '') $loadon = 'directory/';}*/
clearstatcache();
if ($handle = opendir($loadon)) {
	while (false !== ($file = readdir($handle))) { 
		if ($file == "." || $file == "..")  continue;
		if (filetype($loadon.$file) == "dir") {
			$n++;
			$key = $n;
			$dirs[$key] = $file . "/";
		}else {
			$n++;			$key = $n;			$files[$key] = $file;
		}
	}
	closedir($handle); 
}if(!empty($dirs)){
	natcasesort($dirs); 
	$dirs = array_values($dirs);}if(!empty($files)){	natcasesort($files);	$files = array_values($files);}
?><h1><?='Вы находитесь: /'.$loadon;?></h1>
    <div id="listingheader"> 
	<div id="headerfile">Файл</div>
	<div id="headersize">Размер</div>
	<div id="headermodified">Дата изменения</div>
	</div>
    <div id="listing">
	<?
	$class = 'b';
	if($dirok && $parentDir) { 		$reqParent = "getDirectory('";		$reqParent.= $parentDir;		$reqParent.= "'); return false;";	?>
	<div><a data-href="<?=$parentDir;?>" class="<?=$class;?> directory"><img src="http://www.000webhost.com/images/index/dirup.png" alt="Folder" /><strong>..</strong> <em>-</em> <?=date ("M d Y h:i:s A", filemtime($parentDir));?></a></div>
	<?
		if($class=='b') $class='w';
		else $class = 'b';
	}
	$arsize = sizeof($dirs);
	for($i=0;$i<$arsize;$i++) {
	?>	
	<div><a data-href="<?=$loadon.$dirs[$i];?>" class="<?=$class;?> directory"><img src="http://www.000webhost.com/images/index/folder.png" alt="<?=$dirs[$i];?>" /><strong><?=$dirs[$i];?></strong> <em>-</em> <?=date ("M d Y h:i:s A", filemtime($loadon.$dirs[$i]));?></a></div>
	<?
		if($class=='b') $class='w';
		else $class = 'b';	
	}
	
	$arsize = sizeof($files);
	for($i=0;$i<$arsize;$i++) {
		$icon = 'unknown.png';
		$ext = strtolower(substr($files[$i], strrpos($files[$i], '.')+1));
		$supportedimages = array('gif', 'png', 'jpeg', 'jpg');
		$thumb = '';
		if($filetypes[$ext]) {
			$icon = $filetypes[$ext];
		}
		$filename = $files[$i];
		if(strlen($filename)>43) { 	$filename = substr($files[$i], 0, 40) . '...';	}
		$fileurl = $loadon . $files[$i];
	?>
	<div><a data-href="<?=$fileurl;?>" class="<?=$class;?> file"<?=$thumb2;?>><img src="http://www.000webhost.com/images/index/<?=$icon;?>" alt="<?=$files[$i];?>" /><strong><?=$filename;?></strong> <em><?=round(filesize($loadon.$files[$i])/1024);?>KB</em> <?=date ("M d Y h:i:s A", filemtime($loadon.$files[$i]));?><?=$thumb;?></a></div>
	<?	if($class=='b') $class='w';	else $class = 'b';	
	}	
	?></div>

