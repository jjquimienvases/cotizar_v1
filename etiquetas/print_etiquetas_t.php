<?php 
function formatear($num){
	setlocale(LC_MONETARY, 'en_US');
	return "$" . number_format($num, 2);
}
include 'conexion.php';
//este documento es un post que recibe el numero de cotizacion 
 $order = $_GET['invoice_id'];

     $sql_ = "SELECT td.order_date,td.bodega_salida,td.bodega_entrada,tp.transfer_id,tp.item_code,tp.item_name,tp.item_quantity FROM 
     traspaso_orden td INNER JOIN traspaso_producto_id tp ON td.transfer_id = tp.transfer_id WHERE tp.transfer_id = $order";
 $execute = $con->query($sql_);



 $output = '';

 $output .= '<link href="css/style_etiquetas_e.css" rel="stylesheet" type="text/css"   media="screen" />';
 
 foreach($execute as $data_c){
     $bodega_s = $data_c['bodega_salida'];
     $fecha = $data_c['order_date'];
     $item_name = $data_c['item_name'];
     $item_code = $data_c['item_code']; 
     $item_quantity = $data_c['item_quantity']; 
     $bodega_e = $data_c['bodega_entrada']; 
     $punto_s = "";
     $punto_e = "";
     if($bodega_e == "producto"){
         $punto_e = "Mostrador Principal";
     }else if($bodega_e == "producto_av"){
         $punto_e = "Bodega Principal";
     }else if($bodega_e == "producto_d1"){
         $punto_e = "Mostrador D1";
     }else if($bodega_e == "productos_ibague"){
         $punto_e = "Ibague 1";
     }else if($bodega_e == "productos_ibague_2"){
         $punto_e = "Ibague 2";
     }
     
     if($bodega_s == "producto"){
         $punto_s = "Mostrador Principal";
     }else if($bodega_s == "producto_av"){
         $punto_s = "Bodega Principal";
     }else if($bodega_s == "producto_d1"){
         $punto_s = "Mostrador D1";
     }else if($bodega_s == "productos_ibague"){
         $punto_s = "Ibague 1";
     }else if($bodega_s == "productos_ibague_2"){
         $punto_s = "Ibague 2";
     }
    
     $output .= '<div class="contenedor">';
     $output .= '<div class="qr_contenedor">
     <img src="../qr-code.png" id="our_qr" width="60" height="60">
     </div>';
     $output .= '<div class="imagen_c">
     <img src="../logotipo.jpg" id="logo" width="120" height="100">
     </div>';

    $output .= '
    <div class="info_izquierda">
    <ul>
    <li><b>CODIGO:</b> '.$item_code.' / <b>GRAMOS:</b> '.$item_quantity.'</li>
    <li><b>CONTRATIPO:</b> '.$item_name.'</li>
    <li><b>BODEGA ENTRADA:</b> '.$punto_e.'</li>
    <li><b>BODEGA SALIDA:</b> '.$punto_s.'</li>
    <li><b>TRASPASO:</b> '.$order.'</li>
    <li><b>FECHA:</b> '.$fecha.'</li>
   </ul>
    </div>
    ';

  


    
    $output .= '</div>';
    $output .= '<div id="espace"></div>';
   


 }




$invoiceFileName = 'EtiquetasTraspaso.pdf';
require_once '../dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml(html_entity_decode($output));
$dompdf->setPaper('letter', 'portrait');
// $dompdf->setPaper('letter', 'landscape');
$dompdf->render();
$dompdf->stream($invoiceFileName, array("Attachment" => false));
