
<?php
include "../conexion.php";
header('Content-Type: application/json');
session_start();
$user_id = $_SESSION['id'];
$id_rol = $_SESSION['id_rol'];

$response = new stdClass;
$fun = $_POST['key'];
$status_p = "pendiente";
switch ($fun) {
    case 'Q1':
        $id = $_POST['item'];
        // $sql = "SELECT * FROM carrito_ WHERE user_id = $id AND item_status LIKE '%$status_p%'";
        $sql ="SELECT * FROM stocks_uploads WHERE id_rol = $id_rol AND estado ='pendiente'";
        $r = $conexion->query($sql);
        $retornolosdatos = [];
        while ($o = $r->fetch_object()) {
            $retornolosdatos[] = $o;
        }
        $response->retornolosdatos = $retornolosdatos;
        break;
}
echo json_encode($response);

?>

