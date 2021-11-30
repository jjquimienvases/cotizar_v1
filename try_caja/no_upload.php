<?php 
include('conexion.php');
session_start();
$usuario = $_SESSION['user'];
$data = "";
$fecha_solicitud = date("d-m-Y");

    // $estado = "solicitud_anular";
    $estado = "solicitud";
    $estado_2 = "solicitud anular";
    $cotizacion = $_POST['cotizaciones'];
    $razon = $_POST['razon'];
    $cliente = $_POST['nombre'];
    
    if(!empty($razon)){
         $insertar_solicitud_anulacion = $con -> query("INSERT INTO `solicitud_anular` (`order_id`, `cliente`, `comercial`, `razon`, `fecha_solicitud`, `fecha_anulacion`,`estado`) VALUES ('$cotizacion', '$cliente', '$usuario', '$razon', '$fecha_solicitud', '$data','$estado')");
    // $insertar_solicitud_anulacion = $con -> query("INSERT INTO solicitud_anular (order_id,cliente,comercial,razon,fecha_solicitud,fecha_anulacion)VALUES($cotizacion,'$cliente','$usuario','$razon','$fecha_solicitud',$data)");
     if($insertar_solicitud_anulacion){ 
    // echo "INSERT INTO solicitud_anular (order_id,cliente,comercial,razon,fecha_solicitud,fecha_anulacion)VALUES($cotizacion,'$cliente','$usuario','$razon','$fecha_solicitud',$data)";
         $consulta_update_estado = $con -> query("UPDATE factura_orden SET estado = '$estado_2' WHERE order_id = $cotizacion");
    
if ($consulta_update_estado) {
        echo 1;
    } else {
        echo $consulta_update_estado;
         echo $cotizacion;
        echo 'Fallaron algunas consultas, revisar el estado de la cotizacion y contactar al desarrollador';
    }
         
         
         
     }else{
             echo "okokokok toca revisar la solicitud de anulacion";

     }

    }else{
        echo "no funciona";
    }
    

    

    
    
    
?>