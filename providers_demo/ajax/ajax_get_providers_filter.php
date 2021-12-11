<?php 
include '../conexion.php';


$response = new stdClass;

    $dato = $_POST['dato'];    
   $sql = "SELECT * FROM proveedor WHERE empresa LIKE '%$dato%' OR asesor LIKE '%$dato%'";  
    $r = $con->query($sql);
        $retornolosdatos = [];
        while ($o = $r->fetch_object()) {
            $retornolosdatos[] = $o;
        }
        $response->retornolosdatos = $retornolosdatos;

echo json_encode($response);