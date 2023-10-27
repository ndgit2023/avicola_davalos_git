<?php
session_start();
require_once("../../conexion.php");
require_once("../../paginacion.inc.php");
require_once("../../libreria_menu.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <meta http-equiv='Content-type' content='text/html; charset=utf-8' />
         <script type='text/javascript' src='../../ajax.js'></script>
       </head>
       <body>
       <p> &nbsp;</p>";

          contarRegistros($db, "propietarios");
          paginacion("propietarios.php?");

$sql = $db->Prepare("SELECT *
                     FROM propietarios
                     WHERE estado <> 'X' 
                     ORDER BY id_propietario DESC  
                     LIMIT ? OFFSET ?                    
                        ");
$rs = $db->GetAll($sql, array($nElem, $regIni));
   if ($rs) {
        echo"<center>
          <h1>LISTADO DE PROPIETARIOS</h1>
          <b><a href='propietario_nuevo.php'>Nuevo Propietario>>>></a></b>
              <table class='listado'>
                <tr>                                   
                  <th>Nro</th><th>C.I.</th><th>APELLIDOS</th><th>NOMBRE</th><th>DIRECCION</th><th>TELEFONO</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=0;
                $total= $pag-1;
                $a = $nElem*$total;
                $b= $b+1+$a;

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
    echo"<!--PAGINACION------------------------------------------->";
echo"<table border='0' align='center'>
     <tr>
     <td>";
     if(!empty($urlback)){
       echo"<a href=".$urlback." style='font-family:Verdana;font-size:9px;cursor:pointer'; >&laquo;Anterior</a>";  
     }
     if(!empty($paginas)) {
      foreach ($paginas as $k => $pagg){
        if ($pagg["npag"]== $pag){
          if($pag != '1'){
            echo"|";
          }
          echo"<b style='color:#FB992F;font-size: 12px;'>";

        }else
     echo"</b> | <a href=".$pagg["pagV"]." style='cursor:pointer;'>";echo $pagg["npag"]; echo"</a>";
    }
  }
    if(($nPags > $nBotones) and (!empty($urlnext)) and ($pag < $nPags)){

    
    echo" |<a href=".$urlnext." style='font-family: Verdana;font-size: 9px;cursor:pointer'>siguiente&raquo;</a>";
     }
echo"</td>
  </tr>
  </table>";
  echo"<!--PAGINACION------------------------------->";

echo "</body>
      </html> ";

 ?>