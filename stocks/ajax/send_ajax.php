<?PHP 

 include '../conexion.php';
 session_start();
 $id_rol = $_SESSION['id_rol'];
 $solicita = $_SESSION['user'];
 $estado = "Solicitud Finalizada";
 $info_adicional = "";
 $bodegaSend = $_POST['bodega_salida'];
 $cantidad = $_POST['quantity'];
 $categoria = $_POST['categoria'];
 $codigo = $_POST['id'];
 $producto = $_POST['item'];

 if ($id_rol == 1) {
    $bodegaReceiver = "producto_av";
  }else if($id_rol == 2){
    $bodegaReceiver = "producto";
  }else if($id_rol == 3){
    $bodegaReceiver = "producto_d1";
  }else if($id_rol == 4 OR $id_rol == 6){
    $bodegaReceiver = "producto_av";
  }else if($id_rol == 7){
    $bodegaReceiver = "productos_ibague";
  }
  else if($id_rol == 9){
    $bodegaReceiver = "producto_av";
  }

 // Bodega Salida id

 if ($bodegaSend != "") {
    if ($bodegaSend == "producto") {
         $bodega_send_id = 2;
    }else if($bodegaSend == "producto_av"){
         $bodega_send_id = 4;
    }else if($bodegaSend == "producto_d1"){
         $bodega_send_id = 3;
    }else if($bodegaSend == "productos_ibague"){
         $bodega_send_id = 7;
    }else{
        $bodega_send_id = 1;
    }
}
// bodega de entrada id
if (isset($bodegaReceiver)) {
    if ($bodegaReceiver == "producto") {
         $bodega_receiver_id = 2;
    }else if($bodegaReceiver == "producto_av"){
         $bodega_receiver_id = 4;
    }else if($bodegaReceiver == "producto_d1"){
         $bodega_receiver_id = 3;
    }else{
         $bodega_receiver_id = 7;
    }
}
// fin ID bodegas


  
$sqlInsertSolicitud = "INSERT INTO traspasos (codigo, producto, cantidad, bodega_salida, bodega_entrada, solicita, estado,aprueba, empaca,id_rol_bodega_salida,id_rol_bodega_entrada,id_categoria)
VALUES ('$codigo','$producto','$cantidad','$bodegaSend','$bodegaReceiver','$solicita','$estado','$info_adicional','$info_adicional','$bodega_send_id','$bodega_receiver_id',$categoria)";


$did = mysqli_query($conexion, $sqlInsertSolicitud);
echo $did;

//  print_r($_POST);
