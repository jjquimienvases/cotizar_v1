<?php 

include '../conexion.php';
header('Content-Type: application/json');
$response = new stdClass;
$fun = $_POST['key'];
$status_p = "pendiente";

switch ($fun) {
    case 'Q2':
        $item_id = $_POST['id'];
        $sql = "SELECT * FROM producto_av WHERE sub_categoria = 18";      
         $r = $con->query($sql);
        $retornolosdatos = [];
        while ($o = $r->fetch_object()) {
            $retornolosdatos[] = $o;
        }
        $response->retornolosdatos = $retornolosdatos;
        break;
}
echo json_encode($response);