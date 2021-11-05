<?php

include('conexion.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $con->real_escape_string(htmlentities($_POST['title']));
    $description = $con->real_escape_string(htmlentities($_POST['description']));
    $cot = $con->real_escape_string(htmlentities($_POST['cotizacion']));
    $tipo = "pdf";

    $file_name = $_FILES['file']['name'];

    $new_name_file = null;

    if ($file_name != '' || $file_name != null) {
        $file_type = $_FILES['file']['type'];
        list($type, $extension) = explode('/', $file_type);
        if ($extension == 'pdf') {
            $dir = 'files/';
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }
            $file_tmp_name = $_FILES['file']['tmp_name'];
            //$new_name_file = 'files/' . date('Ymdhis') . '.' . $extension;
            $new_name_file = $dir . file_name($file_name) . '.' . $extension;
            if (copy($file_tmp_name, $new_name_file)) {

            }
        }
    }

 // INSERT para las fotografias
 $estado = "alistamiento";
 $nombreImg=$_FILES['imagen']['name'];
 $ruta=$_FILES['imagen']['tmp_name'];
 $destino="./imagenes/".$nombreImg;
 if(copy($ruta, $destino)){

   $ins = $con->query("INSERT INTO files(title,description,url,type,order_id,file_name,file_ruta,estado) VALUES ('$title','$description','$new_name_file','$tipo','$cot','$nombreImg','$destino','$estado')");
 }

 //INSERTANDO A LAS DIFERENTES TABLAS

 $code = $_POST['cotizacion'];
 $nuevostock = 0;
 $totalstock = 0;

 $consulta =  $con->query("SELECT order_item_quantity,item_code FROM factura_orden_producto WHERE order_id = '$code'");
 while ($o = $consulta->fetch_object()){
 if (floatval($nuevostock)==0) {
   $nuevostock = floatval($o->order_item_quantity);
 }

 $consulta3 = $con->query("SELECT stock FROM producto WHERE id = '{$o->item_code}'");
 $stock = floatval($consulta3->fetch_row()[0]);
 $nuevostock = $stock-$o->order_item_quantity;

 if($consulta3){
  $sql1="UPDATE producto SET stock ='$nuevostock' WHERE id = '{$o->item_code}'";
  $ins = $con->query($sql1);
 }else{

 }
 }

 //ENVIANDO A CRISTIAN Y SUBIANDO A MODIFICADAS
 $comercial = $_POST['vendedor'];
 $cotizacion = $_POST['cotizacion'];
 $cliente = $_POST['title'];
 $pago = $_POST['codigo'];
 $factura = $_POST['factura'];
 $estado = $_POST['estadoactual'];
 $metodo = $_POST['metodo'];
 $total = $_POST['monto'];


 $sqlInsertarPeticion="INSERT INTO bodegaav (order_id, factura, comercial, estado, pago)
 VALUES ('$cotizacion', '$factura', '$comercial', '$estado', '$pago')";
 $ins = $con->query($sqlInsertarPeticion);

 $sqlAprobar = "INSERT INTO factura_modificada (order_id, first_name, order_receiver_name, total, estado, metodopago, code, factura)
 VALUES ('$cotizacion','$comercial','$cliente','$total','$estado','$metodo','$pago','$factura')";
 $ins = $con->query($sqlAprobar);


    if ($ins) {
        echo 'success';
    } else {
        echo 'fail, no se ejecutaron las consultas revisar';
    }
} else {
    echo 'fail no funciona nada ni la conexion, revisar';
}
