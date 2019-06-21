<?php
spl_autoload_register(function($clas_nome){
	$filename=$clas_nome.".php";
	if (file_exists(($filename))) {
		require_once($filename);
		# code...
	}

});

?>
