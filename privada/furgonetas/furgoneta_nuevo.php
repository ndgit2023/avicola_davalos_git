<?php
session_start();
require_once("../../conexion.php");
require_once("../../libreria_menu.php");

//$db->debug=true;

echo"<html> 
       <head>
         <link rel='stylesheet' href='../../css/estilos.css' type='text/css'>
         <script type='text/javascript' src='../../ajax.js'></script>
         <script type='text/javascript'>
          function buscar() {
            var d1, contenedor,url;
            contenedor = document.getElementById('repartidores');
            contenedor2 = document.getElementById('repartidor_seleccionado');
            contenedor3 = document.getElementById('repartidor_insertada');
            d1 = document.formu.nombre.value;
            d2 = document.formu.apellidos.value;
            d3 = document.formu.ci.value;
            d4 = document.formu.telefono.value;
            ajax = nuevoAjax();
            url = 'ajax_buscar_repartidor.php'
            param = 'nombre='+d1+'&apellidos='+d2+'&ci='+d3+'&telefono='+d4;
            ajax.open('POST', url, true);
            ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
            ajax.onreadystatechange = function(){
              if(ajax.readyState == 4){
                contenedor.innerHTML = ajax.responseText;
                contenedor2.innerHTML = '';
                contenedor3.innerHTML = '';
              }
            }
            ajax.send(param);
          }
          function buscar_repartidor(id_repartidor){
            var d1, contenedor, url;
            contenedor = document.getElementById('repartidor_seleccionado');
            contenedor2 = document.getElementById('repartidores');
            document.formu.id_repartidor.value = id_repartidor;

          d1 = id_repartidor;

          ajax = nuevoAjax();
          url = 'ajax_buscar_repartidor1.php';
          param = 'id_repartidor='+d1;
          ajax.open('POST', url, true);
          ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
          ajax.onreadystatechange = function(){
            if(ajax.readyState == 4){
              contenedor.innerHTML = ajax.responseText;
              contenedor2.innerHTML = '';
            }
          }
          ajax.send(param);
          }
          function insertar_repartidor(){
            var d1, contenedor, url;
              contenedor = document.getElementById('repartidor_seleccionado');
              contenedor2 = document.getElementById('repartidores');
              contenedor3 = document.getElementById('repartidor_insertada');
              d1 = document.formu.nombre1.value;
              d2 = document.formu.apellidos1.value;
              d3 = document.formu.ci1.value;
              d4 = document.formu.telefono1.value;

              if((d1 == '') && (d2 == '')){
                alert('por favor introduzca un Nombre');
                document.formu.nombre1.focus();
                return;
              } 
              if((d2 == '') && (d2 == '')){
                alert('por favor introduzca un Apellido');
                document.formu.apellidos1.focus();
                return;
              }
              if(d3 == ''){
                alert('El ci es incorrecto o el campo esta vacio');
                document.formu.ci1.focus();
                return;
              }
              if(d4 == ''){
                alert('El telefono es incorrecto o el campo esta vacio');
                document.formu.telefono1.focus();
                return;
              }
             
              ajax = nuevoAjax();
              url = 'ajax_inserta_repartidor.php';
              param = 'nombre1='+d1+'&apellidos1='+d2+'&ci1='+d3+'&telefono1='+d4;
              ajax.open('POST', url, true);
              ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
              alert('llega');
              ajax.onreadystatechange = function(){
                if (ajax.readyState == 4){
                  contenedor.innerHTML = '';
                  contenedor2.innerHTML = '';
                  contenedor3.innerHTML = ajax.responseText;
                }
              }
              ajax.send(param);
          }
       </script>
       </head>";
       echo"<body>
       <a></a>

      <h1>INSERTAR USUARIO</h1>";

$sql = $db->Prepare("SELECT CONCAT_WS(' ' ,nombre, apellidos, ci) as repartidor, id_repartidor
                     FROM repartidores
                     WHERE estado <> 'X'                        
                        ");
$rs = $db->GetAll($sql);
 /*  if ($rs) {*/
        echo"<form action='furgoneta_nuevo1.php' method='post' name='formu'>";
        echo"<center>
                <table class='listado'>
                  <tr>
                    <th>(*)Selecciona a la repartidor</th>
                     <td>
                      <table>
                        <tr>
                          <td>
                            <b>Nombre</b><br />
                            <input type='text' name='nombre' value='' size='10' onkeyUp='buscar()'>
                          </td>
                          <td>
                            <b>Apellidos</b><br />
                            <input type='text' name='apellidos' value='' size='10' onkeyUp='buscar()'>
                          </td>
                          <td>
                            <b>CI</b><br />
                            <input type='text' name='ci' value='' size='10' onkeyUp='buscar()'>
                          </td>
                          <td>
                            <b>telefono</b><br />
                            <input type='text' name='telefono' value='' size='10' onkeyUp='buscar()'>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>";
            echo"<tr>
                  <td colspan='6' align='center'>
                    <table width='100%'>
                      <tr>
                        <td colspan='3' align='center'>
                        <div id='repartidores'></div>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td colspan='6' align='center'>
                    <table width='100%'>
                      <tr>
                        <td colspan='3'>
                          <div id='repartidor_seleccionado'></div>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td colspan='6' align='center'>
                    <table width='100%'>
                      <tr>
                        <td colspan='3'>
                          <input type='hidden' name='id_repartidor'>
                          <div id='repartidor_insertada'></div>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>";
            echo"<tr>
                    <th><b>(*)Placa de la  furgoneta</b></th>
                    <td><input type='text' name='placa' size='10'></td>
                  </tr>
                  <tr>
                    <th><b>(*)Modelo</b></th>
                    <td><input type='text' name='modelo' size='10'></td>
                  </tr>
                  <tr>
                    <th><b>(*)Marca</b></th>
                    <td><input type='text' name='marca' size='10'></td>
                  </tr>
                  <tr>
                    <th><b>(*)Fecha de asignacion</b></th>
                    <td><input type='date' name='fecha_asignacion' size='10'></td>
                  </tr>

                  <tr>
                    <td align='center' colspan='2'>
                      <input type='submit' value='ADICIONAR FURGONETA'><br>
                      (*)Datos Obligatorios
                    </td>
                  </tr>
                </table>
                </center>";
          echo"</form>";

    echo"</body>
        </html>";
?>

