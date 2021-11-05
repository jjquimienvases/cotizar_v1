<?php 
function formatear($num){
	setlocale(LC_MONETARY, 'en_US');
	return "$" . number_format($num, 2);
}


  include 'consultas_sql.php';

  $consultando_call = $consulta_call;
  $consultando_mostrador = $consulta_mostradorjj; 
  $consultando_mostrador_d1 = $consulta_mostradord1;
  $consultando_ibague_1 = $consulta_ibague1;
  $consultando_ibague_2 = $consulta_ibague2; 
   
   function datos_generales($consultando_call){
    $total_call = 0;
    while ($data = mysqli_fetch_array($consultando_call)) {
          
          $monto_x = "";
          $total_tax = $data["order_total_after_tax"];
          $total_desc = $data["order_total_amount_due"];          
          if($total_desc == "0" || $total_desc == ""){
              $monto_x = $total_tax;
          }else{
              $monto_x = $total_desc;
          }
        
        $monto_call = 0;
        $valor_call = $monto_x;
        $monto_call = $valor_call;
        $total_call += $monto_call;
   
    }
    return formatear($total_call);
  
} 

function datos_generales_mostradorjj($consultando_mostrador){
   $total_mostrador = 0;
   while($data_jj = mysqli_fetch_array($consultando_mostrador)){
    
     $monto_x = "";
     $total_tax = $data_jj["order_total_after_tax"];
     $total_desc = $data_jj["order_total_amount_due"];          
     if($total_desc == "0" || $total_desc == ""){
         $monto_x = $total_tax;
     }else{
         $monto_x= $total_desc;
     }

     $monto_mostrador = 0;
     $valor_call = $monto_x;
     $monto_mostrador = $valor_call;
     $total_mostrador += $monto_mostrador;
      
   }

   return formatear($total_mostrador);
}

function datos_generales_mostradord1($consultando_mostrador_d1){
  $total_d1 = 0;
  while($data_d1 = mysqli_fetch_array($consultando_mostrador_d1)){
    $monto_x = "";
    $total_tax = $data_d1["order_total_after_tax"];
    $total_desc = $data_d1["order_total_amount_due"];          
    if($total_desc == "0" || $total_desc == ""){
        $monto_x = $total_tax;
    }else{
        $monto_x= $total_desc;
    }

    $monto_mostrador = 0;
    $valor_call = $monto_x;
    $monto_mostrador = $valor_call;
    $total_d1 += $monto_mostrador;
     
  }
  return $total_d1;
}

function datos_generales_ibague_1($consultando_ibague_1){
  $total_ibague1 = 0;
  while ($data_ib1 = mysqli_fetch_array($consultando_ibague_1)) {
    $monto_x = "";
    $total_tax = $data_ib1["order_total_after_tax"];
    $total_desc = $data_ib1["order_total_amount_due"];          
    if($total_desc == "0" || $total_desc == ""){
        $monto_x = $total_tax;
    }else{
        $monto_x= $total_desc;
    }

    $monto_mostrador = 0;
    $valor_call = $monto_x;
    $monto_mostrador = $valor_call;
    $total_ibague1 += $monto_mostrador;
  }
  
  return $total_ibague1;

}

function datos_generales_ibague_2($consultando_ibague_2){
  $total_ibague2 = 0;

  while ($data_ib2 = mysqli_fetch_array($consultando_ibague_2)) {
    $monto_x = "";
    $total_tax = $data_ib2["order_total_after_tax"];
    $total_desc = $data_ib2["order_total_amount_due"];          
    if($total_desc == "0" || $total_desc == ""){
        $monto_x = $total_tax;
    }else{
        $monto_x= $total_desc;
    }

    $monto_mostrador = 0;
    $valor_call = $monto_x;
    $monto_mostrador = $valor_call;
    $total_ibague2 += $monto_mostrador;
  }
  return $total_ibague2;
}


?>