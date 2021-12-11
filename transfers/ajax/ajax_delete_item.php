<?php

 include '../conexion.php';
 session_start();
 $id_rol = $_SESSION['id_rol'];
 $user_id = $_SESSION['userid'];
 $data = $_POST['codigo'];
 if ($id_rol == 2) {
    $bodega_entrada = "producto";
} else if ($id_rol == 3) {
    $bodega_entrada = "producto_d1";
} else if ($id_rol == 6) {
    $bodega_entrada = "producto_av";
} else if ($id_rol == 4) {
    $bodega_entrada = "producto_av";
} else if ($user_id == 27) {
    $bodega_entrada = "productos_ibague2";
} else if ($id_rol == 7) {
    $bodega_entrada = "productos_ibague";
} else {
    $bodega_entrada = "producto_av";
}


//  print_r($data);

//  return;

 $sql_delete = "DELETE FROM traspaso_producto_id WHERE bodega_entrada = '$bodega_entrada' AND item_code = $data";
 $execute = $con->query($sql_delete);
 

 if($execute){
     echo $execute;
 }else{
     echo 0;
 }
