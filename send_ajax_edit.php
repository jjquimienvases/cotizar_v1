<?php

include 'conectar.php';
$conexion = conectar();
session_start();
$user_id = $_SESSION["userid"];

//informacion de los productos 
$item_name = $_POST["productName"];
$item_code = $_POST["productCode"];
$item_quantity = $_POST["quantity"];
$item_unitario = $_POST["unitario"];
$item_price = $_POST["result"];
$item_categoria = $_POST["idCategoria"];

//informacion del cliente  
$cliente = $_POST["companyName"];
$cedula = $_POST["cedula"];
$email = $_POST["email"];
$direccion = $_POST["direccion"];
$telefono = $_POST["tele"];
$ciudad = $_POST["ciudad"];
//informacion cotizar
$comercial = $_POST["address"];
$notas = $_POST["notes"];
$metodo_de_pago = $_POST["metodopago"];
$cotizacion = $_POST["invoiceId"];
$total = $_POST["totalAftertax"];
$Subtotal = $_POST["subTotal"];
$descuento_p = $_POST["taxRate"];
$descuento_m = $_POST["taxAmount"];
$abono = $_POST["amountPaid"];
$deuda = $_POST["amountDue"];
$fecha = date("Y-m-d H:m:s");
$price = 0;
$gramos = 0;
$envases = 0;
$tapas = 0;



$consulta_informacion_cliente = "SELECT * FROM factura_orden WHERE order_id = $cotizacion";
$result = $conexion->query($consulta_informacion_cliente);
$result = $result->fetch_assoc();

if ($_POST != "") {
    $update_cliente ="UPDATE factura_orden SET 
  order_receiver_name = '$cliente',
  cedula = '$cedula',
  tel_client = '$telefono',
  ciudad = '$ciudad',
  order_receiver_address  = '$comercial',
  order_total_before_tax = $Subtotal,
  metodo_de_pago = '$metodo_de_pago',
  note = '$notas',
  order_total_amount_due  = $deuda,
  order_amount_paid = $abono,
  order_total_after_tax = $total,
  email = '$email',
  direccion = '$direccion'
  WHERE order_id = $cotizacion";
  
  
  $execute = $conexion->query($update_cliente);


    $delete_item = "DELETE FROM factura_orden_producto WHERE order_id = $cotizacion";
    $ejecutar_detele = $conexion->query($delete_item);
    for ($i = 0; $i < count($_POST["productName"]); $i++) {
        $insert_items = "INSERT INTO factura_orden_producto (order_id,item_code,item_name,order_item_quantity,order_item_unitario,order_item_price,item_categoria,order_item_final_amount,order_date,gramos,envases,tapa)
     VALUES ($cotizacion,$item_code[$i],'$item_name[$i]',$item_quantity[$i],'$item_unitario[$i]','$price',$item_categoria[$i],$item_price[$i],'$fecha','$gramos','$envases','$tapas')";
        $ejecutar_insert = $conexion->query($insert_items);
        echo $ejecutar_insert;
    }
}
