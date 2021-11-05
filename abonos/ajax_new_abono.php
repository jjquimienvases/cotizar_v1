<?php
include 'conexion.php';
// $con = new mysqli('localhost', 'root', '', 'cotpruebas');

//declarando variables de texto
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // $deuda_total = $con->real_escape_string(htmlentities($_POST['monto']));
  $monto_cancelado = $con->real_escape_string(htmlentities($_POST['nuevo_a']));
  $metodo_pago = $con->real_escape_string(htmlentities($_POST['n_metodo']));
  $cotizacion = $con->real_escape_string(htmlentities($_POST['cotizacion']));
  $last_abono = $con->real_escape_string(htmlentities($_POST['abono']));
  $restante = $con->real_escape_string(htmlentities($_POST['restante_n']));

}


// print_r($_POST);
// return;
$abono_actualizado = $last_abono + $monto_cancelado;
$fecha = DATE('Y-m-d H:m:s');

$nombreImg = $_FILES['new_comprobante']['name'];
$ruta = $_FILES['new_comprobante']['tmp_name'];
$destino = "./imagenes/" . $nombreImg;
$estado = "";
if($restante <= 0){
 $estado = "completo";
}else{
  $estado = "pendiente";
}

$sql_insert_data = $con->query("INSERT INTO file_abono (order_id,ruta,archivo,metodo_de_pago,nuevo_abono)VALUES($cotizacion,'$destino','$nombreImg','$metodo_pago',$monto_cancelado)");
$sq_actualizar_data = $con->query("UPDATE order_abono SET abono = $abono_actualizado, restante = $restante, estado_abono = '$estado' WHERE order_id = $cotizacion");

if($sql_insert_data){
echo $sql_insert_data;
}else{
  echo 0;
}