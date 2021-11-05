<?php

// include "../../conectar.php";

header('Content-Type: application/json');

$response = new stdClass;

 $con = new mysqli ('ftp.jjquimienvases.com','jjquimienvases_jjadmin','LeinerM4ster','jjquimienvases_cotizar');



$fun = $_POST['key'];

$status2 = "s_factura";
$status = "pendiente";
switch ($fun) {

    case 'Q1':

        $codigo = $_POST["codigo"];

    
                $sql = "SELECT * FROM files WHERE estado = '$status' OR estado = '$status2' AND order_id LIKE '%$codigo%'";

        $r = $con->query($sql);

        if ($o = $r->fetch_object()) {

            $resultado = $o;

        }

        $response->resultado = $resultado;

        break;

}

echo json_encode($response);

?>

