<?php 
session_start();
require_once("../../conexion.php");

 $__id_propietario = $_REQUEST["id_propietario"];

 echo"<html>
       <head>
       <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>";
//$db->debug=true;
$sql = $db->Prepare("SELECT *
                    FROM lugares_reparte
                    WHERE id_propietario = ?
                    AND estado <> 'X'
                    "); 
$rs = $db->GetAll($sql, array($__id_propietario));
if (!$rs){
    $reg = array();
    $reg["estado"] = 'X';
    $reg["usuario"] = $_SESSION["sesion_id_usuario"];
    $rs1 = $db->AutoExecute("propietarios", $reg, "UPDATE","id_propietario='".$__id_propietario."'");
    header ("Location:propietarios.php");
    exit();
}else{
    require_once("../../libreria_menu.php");
    echo"<div class='mensaje'>";
    $mensaje = "NO SE ELIMINARON LOS DATOS DE LA PERSONA PORQUE TIENE HERENCIA";
    echo"<h1>".$mensaje."</h1>";
    
    echo "<a href='propietarios.php'>
    <input type='button'style='cursor:pointer;border-radius:10px;font_weight:bold;height:25px;'
    value='VOLVER>>>>'></input>
    
    </a>
    ";
    echo"</div>";
    }
echo"</body>
</html>";
?>
