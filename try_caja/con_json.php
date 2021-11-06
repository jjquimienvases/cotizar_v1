<?php

include "../globals.php";

$id = $_POST['id'];

$sql = "SELECT * FROM factura_orden WHERE order_id='$id'";
$r = $cnx->query($sql);

if ($o = $r->fetch_object()) {
 $resultado = $o;
}
echo json_encode($resultado);
 ?>
