<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       


$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$ci = $_POST["ci"];
$direccion = $_POST["direccion"];
$telefono = $_POST["telefono"];


if(($nombre!="") and  ($ci!="") ){
   $reg = array();
   $reg["nombre"] = $nombre;
   $reg["apellidos"] = $apellidos;
   $reg["ci"] = $ci;
   $reg["direccion"] = $direccion;
   $reg["telefono"] = $telefono;
   $reg["fecha_insercion"] = date("Y-m-d H:i:s");
   $reg["estado"] = 'A';
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 = $db->AutoExecute("propietarios", $reg, "INSERT"); 
   header("Location: propietarios.php");
   exit();
} else {
           echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DEL PROPIETARIO";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='propietario_nuevo.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }


echo "</body>
      </html> ";
?> 