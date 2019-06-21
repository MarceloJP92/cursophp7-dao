<?php

require_once("config.php");
//$sql=new Sql();
//$usuario= $sql-> select("SELECT * FROM tb_usuario");
//echo json_encode($usuario);
$root=new usuario();
$root->loadById(1);
echo  $root;
?>