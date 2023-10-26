<?php

require_once("adodb/adodb.inc.php");  // require es una palabra reservada de php que permite trabajar con librerias  de php 

// estoy definiendo  variables , y php es sencible a amyusculas y minusculas
$conServidor = "localhost"; 
$conUsuario = "root";
$conClave = "";
$conBasededatos = "avicola"; // aqui pongo la base de datos  como esta en mi phpmadadmy

$db = ADONewConnection("mysqli"); // 

//$db-> debug = true;

$conex = $db->Connect($conServidor, $conUsuario, $conClave, $conBasededatos); // conecto al servidor local host 
$db->Execute("SET NAMES 'utf8'"); // reconoce las enes ,los asentos desde la base de datos 
?>