<?php
$con = new mysqli ('ftp.jjquimienvases.com', 'jjquimienvases_jjadmin', 'LeinerM4ster', 'jjquimienvases_cotizar');  

header('Access-Control-Allow-Origin: *');

//consultando

$item_id = $_GET['item_id'];
// $item_demo = 2670;


$json = array();
$sql = $con->query("SELECT pav.id, pav.contratipo, p.codigo, p.empresa, p.telefono, p.telefono_asesor, p.asesor, pp.precio, p.nit, p.direccion FROM proveedor_producto pp INNER JOIN proveedor p ON p.codigo = pp.proveedor_id INNER JOIN producto_av pav ON pav.id = pp.producto_id WHERE pav.id = $item_id");
$row = $sql->fetch_all(MYSQLI_ASSOC);
$json["datos"] = $row;



echo json_encode($json);
