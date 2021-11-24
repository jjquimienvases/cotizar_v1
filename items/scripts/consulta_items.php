
<?php

// include "../../conectar.php";

header('Content-Type: application/json');

$response = new stdClass;

$conexion = mysqli_connect('173.230.154.140', 'cotizar', 'LeinerM4ster', 'cotizar');
session_start();
$id_rol = $_SESSION['id_rol'];
$id_user = $_SESSION['userid'];


$fun = $_POST['key'];

switch ($fun) {

    case 'Q1':

        $id = $_POST['cliente'];
        if ($id_rol == 4) {
            $sql = "SELECT * FROM producto_av WHERE  id = '$id'";
        } else if ($id_rol == 2) {
            $sql = "SELECT * FROM producto WHERE  id = '$id'  ";
        } else if ($id_rol == 3) {
            $sql = "SELECT * FROM producto_d1 WHERE  id = '$id'  ";
        } else if ($id_rol == 7) {
            $sql = "SELECT * FROM productos_ibague WHERE  id = '$id'  ";
        } else if ($id_user == 27) {
            $sql = "SELECT * FROM productos_ibague2 WHERE  id = '$id'  ";
        } else {
            // $sql = "SELECT * FROM producto_av WHERE  id LIKE '%$id%'  OR contratipo LIKE '%$id%'";
            //$sql = "SELECT * FROM producto_av pa INNER JOIN productos_ibague pi ON pa.id=pi.id WHERE  pi.id = $id  OR pi.contratipo = '$id'";
            $sql = "SELECT * FROM producto_av WHERE  id = $id  OR contratipo = '$id'";
        }

        $r = $conexion->query($sql);

        if ($o = $r->fetch_object()) {

            $resultado = $o;
        }

        $response->resultado = $resultado;

        break;
}

echo json_encode($response);

?>

