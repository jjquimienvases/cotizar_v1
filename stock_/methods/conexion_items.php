
<?php
include "../conexion.php";
header('Content-Type: application/json');
$response = new stdClass;
// $conexion = conectar();
$fun = $_POST['key'];
$id = $_POST['codigo_item'];
// $response->post = $_POST;
switch ($fun) {
    case 'Q1':
        $id = $_POST['codigo_item'];
        
        $sql = "SELECT * FROM producto_av
                WHERE id = $id";
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

