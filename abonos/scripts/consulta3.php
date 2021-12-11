<?php

// include "../../conectar.php";

header('Content-Type: application/json');

$response = new stdClass;
// $response = [];

// $conexion = new mysqli('localhost', 'root', '', 'cotpruebas');
include '../conexion.php';


$fun = $_POST['key'];

switch ($fun) {

    case 'Q1':

        $id = $_POST['cliente'];

        // $sql = "SELECT oo.order_id,fo.order_date,fo.archivo,fo.metodo_de_pago,fo.nuevo_abono,oo.abono,oo.order_receiver_name,oo.restante, oo.deuda FROM file_abono fo INNER JOIN order_abono  oo ON fo.order_id = oo.order_id WHERE  fo.order_id = $id";
        $sql = "SELECT oo.order_id,fo.order_date,fo.archivo,fo.metodo_de_pago,fo.nuevo_abono,oo.abono,oo.order_receiver_name,oo.restante, oo.deuda FROM file_abono fo INNER JOIN order_abono  oo ON fo.order_id = oo.order_id WHERE  fo.order_id = $id";

        $r = $con->query($sql);

        $retornolosdatos = [];

        // if ($o = $r->fetch_object()) {

        //     $resultado = $o;

        // }
        while ($o = $r->fetch_object()) {
            $retornolosdatos[] = $o;

        }

        $response->retornolosdatos = $retornolosdatos;

        break;

}

echo json_encode($response);

?>

