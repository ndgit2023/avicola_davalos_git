<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

//$db->debug=true;

$id_propietario=$_POST["id_propietario"];

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <p> &nbsp;</p>";

$sql = $db->Prepare("SELECT *
                     FROM propietarios
                     WHERE id_propietario= ?
                     AND estado <> 'X'                        
                        ");
$rs = $db->GetAll($sql,array($id_propietario));
   if ($rs) {

    foreach($rs as $k => $fila){
        echo"<form action='propietario_modificar1.php' method='post' name='formu'>";
        echo"<center>
        <h1>MODIFICAR PROPIETARIO</h1>
            <table class='listado'>
                <tr>
                    <th><b>(*)nombre</b></th>
                    <td><input type='text' name='nombre' size='10' value='".$fila["nombre"]."'></td>
                </tr>
                <tr>
                    <th><b>Apellido</b></th>
                    <td><input type='text' name='apellidos' size='10' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["apellidos"]."'></td>
                </tr>

                <tr>
                    <th><b>CI</b></th>
                    <td><input type='text' name='ci' size='10' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["ci"]."'>
                    </td>                    
                </tr>               

              <tr>
                <th><b>(*)Direccion</b></th><td><input type='text' name='direccion' size='20' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["direccion"]."'>
                </td>
              </tr>
              <tr>
              <th><b>(*)Telefono</b></th><td><input type='text' name='telefono' size='20' onkeyup='this.value=this.value.toUpperCase()' value='".$fila["telefono"]."'>
              </td>
            </tr>
              <tr>
                <td align='center' colspan='2'>  
                  <input type='submit' value='MODIFICAR PROPIETARIO'  >
                  <input type='hidden' name='id_propietario' value='".$fila["id_propietario"]."'>
                </td>
              </tr>

            </table>
            </center>";
      echo"</form>" ;     
                        
  }

    }
                                       
echo "</body>
      </html> ";

 ?>                                 
