<?php
session_start();
require_once("../../conexion.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
       </head>
       <body>
       <a  href='../../listado_tablas.php'>Listado de tablas</a>
       <a  href='furgonetas.php'>Listado de furgonetas</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";
       echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
	    echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";
       echo"
         <h1>INSERTAR UNA FURGONETA</h1>";

$sql = $db->Prepare("SELECT CONCAT_WS(' ' , nombre, apellidos,ci) as repartidores, id_repartidor
                     FROM repartidores
                     WHERE estado <> 'X'                        
                        ");
$rs = $db->GetAll($sql);
 /*  if ($rs) {*/
        echo"<form action='furgoneta_nuevo1.php' method='post' name='formu'>";
        echo"<center>
                <table class='listado'>
                  <tr>
                    <th>(*)Repartidores</th>
                    <td>
                      <select name='id_repartidor'>
                        <option value=''>--Seleccione--</option>";
                        foreach ($rs as $k => $fila) {
                        echo"<option value='".$fila['id_repartidor']."'>".$fila['repartidores']."</option>";    
                        }  

                echo"</select>
                    </td>
                  </tr>";
             echo"
             <tr>
                    <th><b>(*)placa</b></th>
                    <td><input type='text' name='placa' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
                  </tr>
             <tr>
                    <th><b>(*)Marca</b></th>
                    <td><input type='text' name='marca' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
                  </tr>
                  <tr>
                    <th><b>(*)Modelo</b></th>
                    <td><input type='text' name='modelo' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
                  </tr>
                  
                  <tr>
                    <th><b>(*)Fecha asignacion</b></th>
                    <td><input type='date' name='fecha_asignacion' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
                  </tr>
                  <tr>
                    <td align='center' colspan='2'>  
                      <input type='submit' value='ADICIONAR FURGONETA'><br>
                      (*)Datos Obligatorios
                    </td>
                  </tr>
                </table>
                </center>";
          echo"</form>" ;     
    /*}*/

echo "</body>
      </html> ";

 ?>