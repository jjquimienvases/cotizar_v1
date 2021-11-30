<?php
include '../conexion.php';

header('Content-Type: application/json');

$response = new stdClass;
$fun = $_POST['key'];
$status_p = "pendiente";

switch ($fun) {
    case 'Q1':
        $item_id = $_POST['id'];
        $id_proveedor = $_POST['id_proveedor'];
        /*         $sql = "SELECT * FROM traspaso_producto_id WHERE bodega_entrada = '$bodega_entrada' AND item_status = 'pendiente'";
 */
        $sql = "SELECT pav.unidad, pav.stock, pav.id, pav.contratipo, p.codigo, p.empresa, p.telefono, p.telefono_asesor, p.asesor, pp.precio, p.nit, p.direccion FROM proveedor_producto pp INNER JOIN proveedor p ON p.codigo = pp.proveedor_id INNER JOIN producto_av pav ON pav.id = pp.producto_id WHERE pav.id = $item_id AND p.codigo = $id_proveedor";
        $r = $con->query($sql);
        $retornolosdatos = [];
        while ($o = $r->fetch_object()) {
            $retornolosdatos[] = $o;
        }
        $response->retornolosdatos = $retornolosdatos;
        break;
}
echo json_encode($response);
