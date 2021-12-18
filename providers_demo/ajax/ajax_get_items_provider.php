<?php
include '../conexion.php';

header('Content-Type: application/json');

$response = new stdClass;
$fun = $_POST['key'];
switch ($fun) {
    case 'Q1':
        $proveedor_id = $_POST['id_provider'];
        $sql = "SELECT pav.unidad, pav.stock, pav.id, pav.contratipo, p.codigo, p.empresa, p.telefono, p.telefono_asesor, p.asesor, pp.precio, p.nit, p.direccion FROM proveedor_producto pp INNER JOIN proveedor p ON p.codigo = pp.proveedor_id INNER JOIN producto_av pav ON pav.id = pp.producto_id WHERE p.codigo = $proveedor_id";
        $r = $con->query($sql);
        $retornolosdatos = [];
        while ($o = $r->fetch_object()) {
            $retornolosdatos[] = $o;
        }
        $response->retornolosdatos = $retornolosdatos;
        break;

    case 'Q2':
        $proveedor_id = $_POST['id_provider'];
        $item_id = $_POST['item_id'];
        $sql = "SELECT pav.unidad, pav.stock, pav.id, pav.contratipo, p.codigo, p.empresa, p.telefono, p.telefono_asesor, p.asesor, pp.precio, p.nit, p.direccion FROM proveedor_producto pp INNER JOIN proveedor p ON p.codigo = pp.proveedor_id INNER JOIN producto_av pav ON pav.id = pp.producto_id WHERE p.codigo = '$proveedor_id' AND pav.id LIKE '%$item_id%' OR pav.contratipo LIKE '%$item_id%'";
        $r = $con->query($sql);
        $retornolosdatos = [];
        while ($o = $r->fetch_object()) {
            $retornolosdatos[] = $o;
        }
        $response->retornolosdatos = $retornolosdatos;
        break;
}
echo json_encode($response);
