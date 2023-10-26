<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       


$id_repartidor = $_POST["id_repartidor"];
$placa = $_POST["placa"];
$marca = $_POST["marca"];
$modelo = $_POST["modelo"];
$fecha_asignacion = $_POST["fecha_asignacion"];

if(($id_repartidor!="") and  ($placa!="") and ($marca!="") and ($modelo!="") and ($fecha_asignacion!="")){
   $reg = array();
   $reg["id_avicola"] = 1;
   $reg["id_repartidor"] = $id_repartidor;
   $reg["placa"] = $placa;
   $reg["marca"] = $marca;
   $reg["modelo"] = $modelo;
   $reg["fecha_asignacion"] = $fecha_asignacion;
   $reg["fecha_insercion"] = date("Y-m-d H:i:s");
   $reg["estado"] = 'A';
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("furgonetas", $reg, "INSERT"); 
   header("Location: furgonetas.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DE LA FURGONETA";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='furgoneta_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 