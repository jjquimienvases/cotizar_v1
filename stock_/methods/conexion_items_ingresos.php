
<?php
include "../conexion.php";
header('Content-Type: application/json');
$response = new stdClass;
// $conexion = conectar();
$fun = $_POST['key'];
$id = $_POST['codigo_item'];
$date = date('Y-m-d');
// $response->post = $_POST;
switch ($fun) {
    case 'Q1':
        $id = $_POST['codigo_item'];
        $sql = "SELECT SUM(cantidad) as Total FROM ingresos WHERE DATE(order_date) BETWEEN '2021-06-15' AND '2021-06-24' AND code = $id"; 
        $r = $conexion->query($sql); 
        if($r){
            if ($o = $r->fetch_object()) {
                $resultado = $o;
            }
            $response->resultado = $resultado;
        }        
        break;
    }
    // echo $id;
    echo json_encode($response);        

?>

