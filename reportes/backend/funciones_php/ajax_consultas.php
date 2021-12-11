<?php 

    include "../../conexion.php";

//  if(isset($_POST['send_form'])){
    $fecha_ini = $_POST['fecha_ini'];
    $hora_ini = $_POST['hora_ini'];
 
    //DEFINIENDO FECHA FIN 
    $fecha_fin = $_POST['fecha_fin'];
    $hora_fin = $_POST['hora_fin'];

    //-----------------------------------------
    // $fecha_inicial = $fecha_ini." ".$hora_ini; 
    $fecha_inicial = $fecha_ini; 
    // $fecha_final = $fecha_fin." ".$hora_fin;
    $fecha_final = $fecha_fin;
    $punto_de_venta = $_POST['punto_venta'];
    $metodos_de_pago = $_POST['check'];
    $cliente = $_POST['cedulasres'];
    $comercial = $_POST['comerciales_res'];
    $estado = $_POST['estado']; 
    $fecha_actual = date("Y-m-D H:i:s");
    // $envio = $_POST['send_form'];
    $sql = "";  
//  }else{
//     echo "esperando consulta";
//  }
 
//  if(isset($send_form)){
    
    $sql ="SELECT * FROM factura_orden WHERE";
  
    $filtros = "";
    $where = "";
   
   
   
    if(!isset($punto_de_venta)){
     $punto_de_venta = "mostradorjj";
   }
   $where .=" metodopago = '$punto_de_venta'";
    
    //WHERE FECHAS
   if (isset($fecha_inicial) && isset($fecha_final)){
     $where .= " AND order_date BETWEEN '$fecha_inicial' AND '$fecha_final'";
   } else if(isset($fecha_inicial)){
      $where .= " AND order_date = '$fecha_inicial'";
   }else if(isset($fecha_final)){
     $where .= " AND order_date = '$fecha_final'";
   }else{
     $where .= " AND order_date = '$fecha_actual'";
   }
   
   if($cliente != ""){
     $where .= "cedula = '$cliente'";
   }
   
   if($comercial != ""){
     $where .= " AND order_receiver_address LIKE '%$comercial%'";
   }
   
   if($estado != ""){
     $where .= " AND estado LIKE '%$estado%'";
   }
   
   $metodos = "(";
   if(isset($metodos_de_pago)){
     $where .= " AND ";
     foreach ($metodos_de_pago as $data) {
        $metodos .= "metodo_de_pago LIKE '%$data%' OR "; 
     }
   $metodos = substr($metodos,0,strlen($metodos)-4).")";
   }
   $consulta_seleccion_usuario = $sql.$where.$metodos;
//   }

   $con = conectar();
   $res = [];
   $result = $con->query($consulta_seleccion_usuario);
     foreach ($result as $r) {
        /* $var = $r; */
        array_push($res,$r);         
     }
     

/*     print_r($result); */
   echo json_encode($res);
   