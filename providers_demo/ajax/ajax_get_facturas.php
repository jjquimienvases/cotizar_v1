<?php 
include '../conexion.php';


$response = new stdClass;
$fun = $_POST['key'];
if($con){
    $sql = "SELECT * FROM file_order_shop ORDER BY order_date";  
    $r = $con->query($sql);
        $retornolosdatos = [];
        while ($o = $r->fetch_object()) {
            $retornolosdatos[] = $o;
        }
        $response->retornolosdatos = $retornolosdatos;
        echo json_encode($response);
}else{
    echo "No hay conexion";
}
