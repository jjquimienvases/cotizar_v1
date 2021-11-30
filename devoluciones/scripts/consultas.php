<?php
 
include_once '../../clases/Consulta.php';
$c = new Consulta();

function GetConsultaItems($cot){
global  $c;
$sql = "SELECT fo.order_id, fo.order_date, fo.order_receiver_address, fo.order_receiver_name, fp.item_code, fp.item_name, fp.order_item_quantity, fp.order_item_unitario, fp.order_item_final_amount, fp.order_item_id, fo.cedula, fo.metodopago FROM factura_orden fo INNER JOIN factura_orden_producto fp ON fo.order_id = fp.order_id WHERE fo.order_id = $cot";
$result = $c->find($sql);
return $result;
}


function GetCreditoCliente($item){
    global $c;
    $sql = "SELECT * FROM clientes WHERE cedula = '$item'"; 
    $result = $c->find($sql);
    return $result;
}