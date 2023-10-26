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
       <a  href='furgoneta_nuevo.php'>Nueva Furgoneta</a>
       <a onclick='location.href=\"../../validar.php\"'><input type='button'name='accion' value='Cerrar Sesion' style='cursor:pointer;border-radius:10px;font-weight:bold;height: 25px;' class='boton_cerrar'></a>";
       echo "<h3>USUARIO: ".$_SESSION["sesion_usuario"]."  &nbsp;&nbsp; ";
	    echo "ROL: ".$_SESSION["sesion_rol"]."</h3>";
       echo"
         <h1>LISTADO DE FURGONETAS</h1>";

$sql = $db->Prepare("SELECT CONCAT_WS(' ', r.nombre,r.apellidos) AS repartidores, f.*,r.id_repartidor    
                     FROM furgonetas f, repartidores r
                     WHERE f.id_repartidor = r.id_repartidor
                     AND f.estado <> 'X' 
                     AND r.estado <> 'X' 
                     ORDER BY r.id_repartidor DESC                  
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>REPARTIDORES</th><th>FURGONETAS</th><th>MODELO</th><th>MARCA</th><th>FECHA ASIGNACION</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td>".$fila['repartidores']."</td>
                        <td>".$fila['placa']."</td>
                        <td>".$fila['marca']."</td>
                        <td>".$fila['modelo']."</td>
                        <td>".$fila['fecha_asignacion']."</td>
                        <td align='center'>
                          <form name='formModif".$fila["id_furgoneta"]."' method='post' action='furgoneta_modificar.php'>
                            <input type='hidden' name='id_furgoneta' value='".$fila['id_furgoneta']."'>
                            <input type='hidden' name='id_repartidor' value='".$fila['id_repartidor']."'>

                            <a href='javascript:document.formModif".$fila['id_furgoneta'].".submit();' title='Modificar Furgoneta en el Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_furgoneta"]."' method='post' action='furgoneta_eliminar.php'>
                            <input type='hidden' name='id_furgoneta' value='".$fila["id_furgoneta"]."'>
                            <input type='hidden' name='id_repartidor' value='".$fila['id_repartidor']."'>

                            <a href='javascript:document.formElimi".$fila['id_furgoneta'].".submit();' title='Eliminar Furgoneta Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar a la furgoneta ".$fila["placa"]." ?\"))'; location.href='furgoneta_eliminar.php''> 
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