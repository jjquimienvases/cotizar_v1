<?php


include '../conexion.php';

$json = array();
$sql = $conexion->query("SELECT pav.id, pav.contratipo, p.codigo, p.empresa, p.telefono, p.telefono_asesor, p.asesor, pp.precio, p.nit, p.direccion FROM proveedor_producto pp INNER JOIN proveedor p ON p.codigo = pp.proveedor_id INNER JOIN producto_av pav ON pav.id = pp.producto_id");
$row = $sql->fetch_all(MYSQLI_ASSOC);
$json["data"] = $row;




echo json_encode($json);
