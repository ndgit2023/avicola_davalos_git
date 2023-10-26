<?php
session_start();

require_once("../../conexion.php");


$nombre = $_POST["nombre1"];
$apellidos = $_POST["apellidos1"];
$ci = $_POST["ci1"];
$telefono = $_POST["telefono1"];

$reg = array();
   $reg["id_avicola"] = 1;
   $reg["apellidos"] = $apellidos;
   $reg["nombre"] = $nombre;
   $reg["ci"] = $ci;
   $reg["telefono"] = $telefono;
   $reg["fec_insercion"] = date("Y-m-d H:i:s");
   $reg["estado"] = 'A';
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("repartidores", $reg, "INSERT"); 

?>