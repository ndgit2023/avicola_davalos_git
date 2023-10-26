<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$id_repartidor = $_POST["id_repartidor"];

//$db->debug=true;
$sql3 = $db->Prepare("SELECT *
                    FROM repartidores
                    WHERE id_repartidor = ?
                    AND estado <> 'X'
                    ");

$rs3 = $db->GetAll($sql3, array($id_repartidor));

echo"<center>
        <table width='60%' border='1'>
            <tr>
                <th colspan='4'>Datos Repartidor</th>
            </th>
        ";
    foreach($rs3 as $k => $fila) {
        echo"<tr>
            <td align='center'>".$fila["ci"]."</td>
            <td>".$fila["apellidos"]."</td>
            <td>".$fila["nombre"]."</td>
            <td>".$fila["telefono"]."</td>
            </tr>";
    }
    echo"</table>
        </center>";
?>
