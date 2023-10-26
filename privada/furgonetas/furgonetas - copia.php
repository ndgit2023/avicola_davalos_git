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
         <script type='text/javascript'>
         function buscar_furgoneta() {
          var d1, d2, d3, d4, d5, ajax, url, param, contenedor;
              contenedor = document.getElementById('furgoneta1');
              d1 = document.formu.nombre.value;
              d2 = document.formu.apellidos.value;
              d3 = document.formu.placa.value;
              d4 = document.formu.modelo.value;
              d5 = document.formu.marca.value;
              //alert(d1);
              ajax = nuevoAjax();
              url = 'ajax_buscar_furgoneta.php'
              param = 'nombre='+d1+'&apellidos='+d2+'&placa='+d3+'&modelo='+d4+'&marca='+d5;
              //alert(param)
              ajax.open('POST', url, true);
              ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
              ajax.onreadystatechange = function() {
                  if(ajax.readyState == 4){
                      contenedor.innerHTML = ajax.responseText;
                  }
              }
              ajax.send(param);
      }

       </script>
       </head>
       <body>
       <p> &nbsp;</p>";
  
echo"
<!------INICIO BUSCADOR------->
    <center>
    <h1>LISTADO DE PERSONAS</h1>
    <b><a href='furgoneta_nuevo.php'>Nueva furgoneta>>>></a></b>
    <form action='#'' method='post' name='formu'>
    <table border='1' class='listado'>
      <tr>
        <th>
          <b>NOMBRE</b><br />
              <select name='nombre' onchange='buscar_furgoneta()'>
              <option value=''>Seleccione</option>
              <option value='JHONATAN'>JHONATAN</option>
              <option value='NEYSON'>NEYSON</option>
              <option value='MAYCOL'>MAYCOL</option>
              <option value='ALFONSO'>ALFONSO</option>
              <option value='RAMON'>RAMON</option>
              <option value='PABLO'>PABLO</option>
              <option value='MAXIMO'>MAXIMO</option>
              <option value='DAVID'>DAVID</option>
              <option value='DANIEL'>DANIEL</option>
              <option value='RAFAEL'>RAFAEL</option>
              </select>
        </th>
        <th>
          <b>APELLIDO</b><br />
              <select name='apellidos' onchange='buscar_furgoneta()'>
              <option value=''>Seleccione</option>
              <option value=''>Seleccione</option>
              <option value='QUISPE'>QUISPE</option>
              <option value='SANCHEZ'>SANCHEZ</option>
              <option value='SANCHEZ'>SANCHEZ</option>
              <option value='MIRANDA'>MIRANDA</option>
              <option value='ALCOBA'>ALCOBA</option>
              <option value='COPA'>COPA</option>
              <option value='LOPEZ'>LOPEZ</option>
              <option value='AYAVIRI'>AYAVIRI</option>
              <option value='CHOQUE'>CHOQUE</option>
              <option value='AUCACHI'>AUCACHI</option>
              </select>
        </th>
        <th>
          <b>PLACA</b><br />
          <input type='text' name='placa' value='' size='10' onkeyUp='buscar_furgoneta()'>
        </th>
        <th>
          <b>MODELO</b><br />
          <input type='text' name='modelo' value='' size='10' onkeyUp='buscar_furgoneta()'>
        </th>
        <th>
          <b>MARCA</b><br />
          <input type='text' name='marca' value='' size='10' onkeyUp='buscar_furgoneta()'>
        </th>
        
      </tr>
    </table>
    </form>
    </center>
    <!------FIN BUSCADOR------>";
    echo"<div id='furgoneta1'>";

$sql = $db->Prepare("SELECT fur.*, re.nombre, re.apellidos
                     FROM furgonetas fur
                     INNER JOIN repartidores re ON fur.id_repartidor=re.id_repartidor
                     WHERE re.estado <> 'X' AND fur.estado <> 'X' 
                     ORDER BY re.id_repartidor DESC                 
                        ");
$rs = $db->GetAll($sql);
   if ($rs) {
        echo"<center>
              <table class='listado'>
                <tr>                                     
                  <th>Nro</th><th>NOMBRE</th><th>APELLIDO</th><th>PLACA</th><th>MODELO</th><th>MARCA</th>
                  <th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>
                </tr>";
                $b=1;
            foreach ($rs as $k => $fila) {                                       
                echo"<tr>
                        <td align='center'>".$b."</td>
                        <td align='center'>".$fila['nombre']."</td>
                        <td>".$fila['apellidos']."</td>
                        <td>".$fila['placa']."</td>
                        <td>".$fila['modelo']."</td>
                        <td>".$fila['marca']."</td>
                        <td align='center'>
                            <input type='hidden' name='id_furgoneta' value='".$fila['id_furgoneta']."'>
                            <a href='javascript:document.formModif".$fila['id_furgoneta'].".submit();' title='Modificar furgoneta Sistema'>
                              Modificar>>
                            </a>
                          </form>
                        </td>
                        <td align='center'>  
                          <form name='formElimi".$fila["id_furgoneta"]."' method='post' action='furgoneta_eliminar.php'>
                            <input type='hidden' name='id_furgoneta' value='".$fila["id_furgoneta"]."'>
                            <a href='javascript:document.formElimi".$fila['id_furgoneta'].".submit();
                            ' title='Eliminar furgoneta Sistema' onclick='javascript:return(confirm(\"Desea realmente Eliminar a la furgoneta "
                            .$fila["placa"]." ".$fila["modelo"]." ?\"))'; location.href='furgoneta_eliminar.php''> 
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
echo"</div>";
echo "</body>
      </html> ";

 ?>