<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$ci = $_POST["ci"];
$telefono = $_POST["telefono"];

//$db->debug=true;
if($apellidos or $nombre or $ci or $telefono){
    $sql3 = $db->Prepare("SELECT *
                        FROM repartidores
                        WHERE nombre LIKE ?
                        AND apellidos LiKE ?    
                        AND ci LIKE ?   
                        AND telefono LIKE ?
                        AND estado <> 'X'
                        ");
    $rs3 = $db->GetAll($sql3, array($nombre."%", $apellidos."%", $ci."%", $telefono."%"));

if($rs3){
    echo"<center>
        <table width='60%' border='1'>
            <tr>
                <th>NOMBRE</th><th>APELLIDOS</th><th>C.I.</th><th>TELEFONO</th><th>?</th>
            </tr>";
    foreach ($rs3 as $k => $fila){
        $str = $fila["nombre"];
        $str1 = $fila["apellidos"];
        $str2 = $fila["ci"];
        $str3 = $fila["telefono"];

        echo"<tr>
            <td align='center'>".resaltar($nombre, $str)."</td>
            <td>".resaltar($apellidos, $str1)."</td>
            <td>".resaltar($ci, $str2)."</td>
            <td>".resaltar($telefono, $str3)."</td>
            <td align='center'>
                <input type='radio' name='opcion' value='' onClick='buscar_repartidor(".$fila["id_repartidor"].")'>
            </td>
        </tr>";
    }
        echo"</table>
        </center>";
    }else{
        echo"<center><b> EL REPARTIDOR  NO EXISTE!!</b></center><br>";
        echo"<center>
            <table class='listado'>
                <tr>
                    <td><b>(*)NOMBRE</b></td>
                    <td><input type='text' name='nombre1' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
                </tr>
                <tr>
                    <td><b>(*)APELLIDOS</b></td>
                    <td><input type='text' name='apellidos1' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
                </tr>
                
                <tr>
                    <td><b>(*)CI</b></td>
                    <td><input type='text' name='ci1' size='10' onkeyup='this.value=this.value.toUpperCase()'></td>
                </tr>
                <tr>
                    <td><b>(*)TELEFONO</b></td>
                    <td><input type='text' name='telefono1' size='10'></td>
                </tr>
                <tr>
                    <td align='center' colspan='2'>
                    <input type='button' value='ADICIONAR REPARTIDOR' onClick='insertar_repartidor()'>
                    </td>
                </tr>
            </table>
            </center>
            ";
    }
}
?>





                            