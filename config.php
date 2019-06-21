<?php
spl_autoload_register(function($clas_nome){
	$filename="class".DIRECTORY_SEPARATOR.$clas_nome.".php";
	if (file_exists(($filename))) {
		require_once($filename);
		# code...
	}

});

?>