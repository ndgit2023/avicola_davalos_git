<?php 
session_start();
require_once("../../conexion.php");

 $__id_furgoneta = $_REQUEST["id_furgoneta"];

 echo"<html>
       <head>
       <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
$db->debug=true;

    $reg = array();
    $reg["estado"] = 'X';
    $reg["usuario"] = $_SESSION["sesion_id_usuario"];
    $rs1 = $db->AutoExecute("furgonetas", $reg, "UPDATE","id_furgoneta='".$__id_furgoneta."'");
    header ("Location:furgonetas.php");
    exit();

echo"</body>
</html>";
?>
