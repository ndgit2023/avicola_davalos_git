<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html>
    <head>
    <link rel='stylesheet' href='../../css/estilos.css'type='text/css'>
    <head>
    <body>";
    $id_repartidor = $_POST["id_repartidor"];
    $id_furgoneta = $_POST["id_furgoneta"];
    $placa = $_POST["placa"];
    $modelo =$_POST["modelo"];
    $marca =$_POST["marca"];
    $fecha_asignacion =$_POST["fecha_asignacion"];

    
    //$hash=password_hash($clave, PASSWORD_DEFAULT);
    if(($id_repartidor!="") and ($placa!="") and ($modelo!="") and ($marca!="")){
        $reg= array();
        $reg["id_avicola"]= 1;
        $reg["id_repartidor"]= $id_repartidor;
        $reg["placa"]= $placa;
        $reg["modelo"]= $modelo;
        $reg["marca"]= $marca;
        $reg["fecha_asignacion"]= $fecha_asignacion;
        $reg["usuario"]= $_SESSION["sesion_id_usuario"];
        $rs1 = $db->AutoExecute("furgonetas", $reg, "UPDATE", "id_furgoneta='".$id_furgoneta."'");
       header("Location: furgonetas.php");
        exit();
    }else{
        echo"<div class='mensaje'>";
        $mensage = "NO SE MODIFICARON LOS DATOS DE LA FURGONETA";
        echo"<h1>".$mensage."</h1>";

        echo"<a href='furgonetas.php'>
        <input type='button' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;'
             value='VOLVER>>>>'></input>
            </a>
        ";
        echo"</div>";
    }
    echo"</body>
    </html>";
?>