<?php
session_start();
require_once("../../conexion.php");

$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
       
$id_avicola= $_POST["id_avicola"];
$nombre = $_POST["nombre"];
$direccion = $_POST["direccion"];
$telefono = $_POST["telefono"];

$logo1 = $_POST["logo1"];
$nom_logo = $_FILES['logo']['name'];

if ((!empty($_FILES['logo'])) and is_uploaded_file($_FILES['logo']['tmp_name'])){
   copy($_FILES['logo']['tmp_name'],'logos/'.$nom_logo);
   $logo=$_FILES['logo']['name'];
}elseif ($logo1 == ""){
   $nom_logo = '';

}else
$nom_logo = $logo1;




if(($nombre!="") and  ($direccion!="")){
   $reg = array();
   $reg["id_avicola"] = 1;
   $reg["nombre"] = $nombre;
   $reg["direccion"] = $direccion;
   $reg["telefono"] = $telefono;
   $reg["logo"] = $nom_logo;
 
  
   $reg["usuario"] = $_SESSION["sesion_id_usuario"];   
   $rs1 =$db->AutoExecute("avicola", $reg, "UPDATE","id_avicola='".$id_avicola."'"); 
   header("Location: ../../listado_tablas.php");
   exit();
} else {
   if(!$rs1){
      echo"<div class='mensaje'>";
        $mensage = "NO SE INSERTARON LOS DATOS DE LA AVICOLA";
        echo"<h1>".$mensage."</h1>";
        
        echo"<a href='avicola.php'>
                  <input type='button'style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' value='VOLVER>>>>'></input>
             </a>     
            ";
       echo"</div>" ;
   }
           
   }


echo "</body>
      </html> ";
?>
