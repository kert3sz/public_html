<html>
	<head>
		<title>Файловый менеджер</title>
	</head>
	<body>
		<?php 
		
		$changeDirectory = (isset($_REQUEST['dirname'])) ? '/'.$_REQUEST['dirname'] : '';		//получаем новое значение текущей директории ?dirname=first_second
		$currentDirectory = 'first'.$changeDirectory;		//
			echo "<p>Каталог: $currentDirectory</p>
			<ul>";			
			if(is_dir($currentDirectory)){ 					// это директория
				if($dir = scandir( $currentDirectory )){	// сканируем в алфавитном порядке
					foreach( $dir as $file ){					// выводим
							if( $file != '.' ){
								if(is_dir($currentDirectory.'/'.$file)) echo "<li class='directory'>$file</li>";
								else echo "<li class='file'>$file</li>";
							}
					}
				}	
			}
			echo '</ul>';
		
		$file1 = $_SERVER['DOCUMENT_ROOT'].'/public_html/directory/first/first_second/third_second';
		$file1 = 'first/first_second';
		echo $file1;
		$file1= is_dir($file1);
		var_dump($file1);
		
		?>
		
	</body>
</html>