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
       <a  href='propietario_nuevo.php'>Nuevo Propietario</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";
       echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
	    echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";
       echo"
         <h1>LISTADO DE PROPIETARIOS</h1>";

$sql = $db->Prepare("SELECT *
                     FROM propietarios
                     WHERE estado <> 'X' 
                     ORDER BY id_propietario DESC                      
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>C.I.</th><th>APELLIDOS</th><th>NOMBRE</th><th>DIRECCION</th><th>TELEFONO</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td align='center'>".$fila['ci']."</td>
                        <td>".$fila['apellidos']."</td>
                        <td>".$fila['nombre']."</td>
                        <td>".$fila['direccion']."</td>
                        <td>".$fila['telefono']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["id_propietario"]."' method='post' action='propietario_modificar.php'>
                            <input type='hidden' name='id_propietario' value='".$fila['id_propietario']."'>
                            <a href='javascript:document.formModif".$fila['id_propietario'].".submit();' title='Modificar Propietario Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_propietario"]."' method='post' action='propietario_eliminar.php'>
                            <input type='hidden' name='id_propietario' value='".$fila["id_propietario"]."'>
                            <a href='javascript:document.formElimi".$fila['id_propietario'].".submit();' title='Eliminar Propietario del Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar al propietario ".$fila["nombre"]." ".$fila["apellidos"]." ?\"))'; location.href='propietario_eliminar.php''> 
                              Eliminar>>
                            </a>
                          </form>                        
                        </td>
                     </tr>";
                     $b=$b+1;
            }
             echo"</table>
          </center>";
    }

echo "</body>
      </html> ";

 ?>