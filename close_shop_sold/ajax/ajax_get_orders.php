<?php 

 include '../conexion.php';
 session_start();
 $rol = $_SESSION['id_rol'];
 $user_id = $_SESSION['user_id'];
 $punto_de_venta ="";
 $asesor = "catalogo electronico";
 if($rol == 2){
     $punto_de_venta = "mostrador_principal";
 }else if($rol == 3){
     $punto_de_venta = "mostrador_d1";
 }else if($user_id == 27){
     $punto_de_venta = "ibague2";
 }else if($rol == 7){
     $punto_de_venta = "ibague1";
 }else{
    $punto_de_venta = "catalogo";
 }
 
 
 header('Content-Type: application/json');

 $response = new stdClass;
 $fun = $_POST['key'];
 $status_p = "pendiente";
 
 switch ($fun) {
     case 'Q1':
         $item_id = $_POST['id'];
       
         $sql = "SELECT * FROM factura_orden WHERE order_receiver_address = '$asesor' AND estado = 'pendiente' AND metodopago = '$punto_de_venta'";
         $r = $con->query($sql);
         $retornolosdatos = [];
         while ($o = $r->fetch_object()) {
             $retornolosdatos[] = $o;
         }
         $response->retornolosdatos = $retornolosdatos;
         break;

         case 'Q2':
            $item_id = $_POST['id'];
            $datos = $_POST['datos'];
            $sql = "SELECT * FROM factura_orden WHERE order_id = $datos OR cedula = $datos AND order_receiver_address = '$asesor' AND metodopago = '$punto_de_venta' ";
            $r = $con->query($sql);
            $retornolosdatos = [];
            while ($o = $r->fetch_object()) {
                $retornolosdatos[] = $o;
            }
            $response->retornolosdatos = $retornolosdatos;
            break;

            case 'Q3':
                $item_id = $_POST['id'];
                $datos = $_POST['datos'];
                $sql = "SELECT * FROM factura_orden WHERE order_id = $datos";
                $r = $con->query($sql);
                $retornolosdatos = [];
                while ($o = $r->fetch_object()) {
                    $retornolosdatos[] = $o;
                }
                $response->retornolosdatos = $retornolosdatos;
                break;
 }
 echo json_encode($response);