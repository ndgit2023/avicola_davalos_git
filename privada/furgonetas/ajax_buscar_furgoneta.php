<?php
session_start();
require_once("../../conexion.php");
require_once("../../resaltarBusqueda.inc.php");

$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$placa = $_POST["placa"];
$modelo = $_POST["modelo"];
$marca = $_POST["marca"];

$db->debug=true;
if($nombre or $apellidos or $placa or $modelo or $marca){
    $sql3 = $db->Prepare("SELECT fur.*, re.*
                        FROM furgonetas fur
                        INNER JOIN repartidores re ON fur.id_repartidor=re.id_repartidor
                        WHERE re.estado <> 'X' AND fur.estado <> 'X' 
                        AND re.nombre LIKE ?
                        AND re.apellidos LIKE ?
                        AND fur.placa LIKE ?
                        AND fur.modelo LIKE ?
                        AND fur.marca LIKE ?
                        ");
    $rs3 = $db->GetAll($sql3, array($nombre."%", $apellidos."%", $placa."%" , $modelo."%" , $marca."%"));
if($rs3){
    echo"<center>
        <table class='listado'>
            <tr>
                <th>NOMBRE</th><th>APELLIDO</th><th>PLACA</th><th>MODELO</th><th>MARCA</th><th><img src='../../imagenes/modificar.gif'></th><th><img src='../../imagenes/borrar.jpeg'></th>

                </tr>";
    foreach ($rs3 as $k => $fila){
        $str = $fila["nombre"];
        $str1 = $fila["apellidos"];
        $str2 = $fila["placa"];
        $str3 = $fila["modelo"];
        $str4 = $fila["marca"];

        echo"<tr>
            <td align='center'>".resaltar($nombre, $str)."</td>
            <td>".resaltar($apellidos, $str1)."</td>
            <td>".resaltar($placa, $str2)."</td>
            <td>".resaltar($modelo, $str3)."</td>
            <td>".resaltar($marca, $str4)."</td>
            <td align='center'>
                <form name=''formModif".$fila["id_furgoneta"]."' method='post' action='furgoneta_modificar.php'>
                    <input type='hidden' name='id_furgoneta' value='".$fila['id_furgoneta']."'>
                    <a href='javascript:document.formModif".$fila['id_furgoneta'].".submit();' title='Modificar furgoneta Sistema'>
                    Modificar>>
                    </a>
                    </form>
                    </td>
                    <td align='center'>
                        <form name='formElimi".$fila["id_furgoneta"]."' method='post' action='ofurgoneta_eliminar.php'>
                            <input type='hidden' name='id_furgoneta' value='".$fila["id_furgoneta"]."'>
                            <a href='javascript:document.formElimi".$fila['id_furgoneta'].".submit();' title='Eliminar furgoneta Sistema'
                            location.href='furgoneta_eliminar.php''>
                            Eliminar>>
                            </a>
                        </form>
                    </td>
                </tr>";
    }
    echo"</table>
    </center>";
}else{
    echo"<center><b>LA opcion NO EXISTE!!</b></center><br>";
}
}
?>