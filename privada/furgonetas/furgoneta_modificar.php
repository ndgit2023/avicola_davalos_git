<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

//$db->debug=true;
$id_furgoneta=$_POST["id_furgoneta"];
$id_repartidor=$_POST["id_repartidor"];

echo"<html>
    <head>
       <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       
       <p> &nbsp;</p>";

$sql = $db->Prepare("SELECT *
                    FROM furgonetas
                    WHERE id_furgoneta = ?
                    AND estado = 'A'
                       ");
$rs = $db->GetAll($sql, array($id_furgoneta));
/* if ($rs) {*/

$sql1 = $db->Prepare("SELECT CONCAT_WS(' ',nombre, apellidos,ci,telefono) as repartidor,id_repartidor
                    FROM repartidores
                    WHERE id_repartidor= ?
                    AND estado = 'A'
                    ");
$rs1 = $db->GetAll($sql1, array ($id_repartidor));

$sql2 = $db->Prepare("SELECT CONCAT_WS(' ',nombre, apellidos,ci,telefono) as repartidor, id_repartidor
                    FROM repartidores
                    WHERE id_repartidor <> ?
                    AND estado = 'A'
                    ");
$rs2 = $db->GetAll($sql2, array($id_repartidor)); 

echo"<form action='furgoneta_modificar1.php' method='post' name='formu'>";
echo"<center>
         <h1>MODIFICAR FURGONETA</h1>
         <table class='listado'>
         <tr>
         <th>(*)Repartidores</th>
         <td>
         <select name='id_repartidor'>";
         foreach($rs1 as $k => $fila){
            echo"<option value='".$fila['id_repartidor']."'>".$fila['repartidor']."</option>";
         }
         foreach ($rs2 as $k => $fila){
            echo"<option value='".$fila['id_repartidor']."'>".$fila['repartidor']."</option>";
         }
         
         echo"</select>
           </td>
           </tr>";
           foreach ($rs as $k => $fila){
            echo " <tr>
            <th><b>(*) PLACA</b></th>
            <td><input type='text' name='placa' size='10' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["placa"]."'></td>
            </tr>
            <tr>
            <th><b>(*) MODELO</b></th>
            <td><input type='text' name='modelo' size='10' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["modelo"]."'></td>
            </tr>
            <tr>
            <th><b>(*) MARCA</b></th>
            <td><input type='text' name='marca' size='10' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["marca"]."'></td>
            </tr>
            <th><b>FECHA ASIGNACION</b></th>
            <td><input type='date' name='fecha_asignacion' size='10' value='".$fila["fecha_asignacion"]."'></td>
            </tr>

            <tr>
              <td align='center' colspan='2'>
              <input type='submit' value='MODIFICAR FURGONETA'><br>
              (*)Datos obligatorios
              <input type='hidden' name='id_furgoneta' value='".$fila["id_furgoneta"]."'>
              </td>
              </tr>";
           }
           echo"</table>
           </center>";
        echo"</form>";

      /*}*/
        
        echo "</body>
              </html> ";
?>