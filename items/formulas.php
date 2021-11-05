<?php

//fomula para perfumeria 
if ($categoria == 4) {
    $iva =  $costo  * 0.19;
    $con_iva = $costo + $iva;
    $unitario = ($con_iva * 0.50) + $con_iva;
   
    $docena = ($con_iva * 0.30) + $con_iva;
  
    $centena = ($con_iva * 0.20) + $con_iva;
} else if ($categoria != 4) {
    $con_iva = ($costo * 0.19) + $costo;
    $unitario = ($con_iva * 0.50) + $con_iva;
    $docena = ($con_iva * 0.30) + $con_iva;
    $centena = ($con_iva * 0.20) + $con_iva;
    $millar = ($con_iva * 0.15) + $con_iva;
} else if ($categoria == 100) {
    $unitario = $costo;
    $docena = $costo;
    $centena = $costo;
    $millar = $costo;
} else if ($categoria == 72) {
    $millar = ($con_iva * 0.15) + $con_iva;
} else if ($categoria == 71) {
    $millar = ($con_iva * 0.20) + $con_iva;
} else if ($categoria == 40) {
    $unitario = 13000;
    $docena = 35000;
    $centena = 70000;
    $millar = "Costo Kilo";
} else if ($categoria == 20) {
    $con_iva = ($costo * 0.19) + $costo;
    $unitario = ($con_iva * 0.50) + $con_iva;
    $docena = ($con_iva * 0.30) + $con_iva;
    $centena = ($con_iva * 0.20) + $con_iva;
    $millar = ($con_iva * 0.20) + $con_iva;
} else if ($categoria == 25) {
    $unitario = 5000;
    $docena = 19000;
    $centena = 35000;
    $millar = 35000;
} else if ($categoria == 46) {
    $unitario = 1050;
    $docena = 1050;
    $centena = 1050;
    $millar = 1050;
} else if ($categoria == 8) {
    $unitario = 150;
    $docena = 100;
    $centena = 100;
    $millar = 100;
} else if ($categoria == 21) {
    $unitario = 2000;
    $docena = 12000;
    $centena = 22000;
    $millar = 36000;
} else if ($categoria == 13){
    $iva =  $costo  * 0.19;
    $con_iva = $costo + $iva;
    $unitario = 5000;
    $docena = ($con_iva * 0.50) + $con_iva;
    $centena = ($con_iva * 0.30) + $con_iva;
    $millar = ($con_iva * 0.30) + $con_iva;
}else if ($categoria == 60 ){
    $con_iva = ($costo * 0.19) + $costo;
    $unitario = ($con_iva * 0.50) + $con_iva;
    $docena = ($con_iva * 0.25) + $con_iva;
    $centena = ($con_iva * 0.18) + $con_iva;
    $millar = ($con_iva * 0.12) + $con_iva;
}else if($categoria == 40){
    $unitario = 13000;
    $docena = 13000;
    $centena = 35000;
    $millar = 70000;
}else{
    $con_iva = ($costo * 0.19) + $costo;
    $unitario = ($con_iva * 0.50) + $con_iva;
    $docena = ($con_iva * 0.30) + $con_iva;
    $centena = ($con_iva * 0.20) + $con_iva;
    $millar = ($con_iva * 0.15) + $con_iva;
}
