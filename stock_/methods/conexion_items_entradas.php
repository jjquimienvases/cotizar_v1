
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
        
        // $sql = "SELECT SUM(fp.cantidad) as Total FROM factura_orden fo INNER JOIN factura_orden_producto fp ON fo.order_id = fp.order_id WHERE DATE(fo.order_date) BETWEEN '2021-06-15' AND '2021-06-25' AND fp.envases = $id AND fo.estado != 'pendiente' AND fo.metodopago = 'mostrador_ibague_1' ";
        $sql = "SELECT SUM(cantidad) as Total FROM traspasos WHERE DATE(order_date) BETWEEN '2021-06-15' AND '$date' AND codigo = $id AND bodega_entrada = 'producto_av' AND estado LIKE '%finalizado%'";
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

