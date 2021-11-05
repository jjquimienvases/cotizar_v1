<?php 
function formatear($num){
	setlocale(LC_MONETARY, 'en_US');
	return "$" . number_format($num, 2);
}

$con = new mysqli ('ftp.jjquimienvases.com', 'jjquimienvases_jjadmin', 'LeinerM4ster', 'jjquimienvases_cotizar'); 
//este documento es un post que recibe el numero de cotizacion 
 $cotizacion = $_GET['invoice_id'];
 $sql_ = "SELECT fo.order_date,fo.order_receiver_name,fp.order_item_unitario,fp.order_item_final_amount, fp.item_code, fp.item_name, fp.gramos,fp.order_item_quantity FROM factura_orden fo INNER JOIN factura_orden_producto fp ON fo.order_id = fp.order_id  WHERE fo.order_id = $cotizacion AND fp.item_categoria = 4";
 $execute = $con->query($sql_);


//  <link href="css/estilos_etiquetas.css" rel="stylesheet" type="text/css"   media="screen" />
// <center><img src="JJ CIRCULO LOGO (fondo blanco).png" id="logo" width="300" height="200"> </center>
 $output = '';

 $output .= '<link href="css/style_etiquetas_e.css" rel="stylesheet" type="text/css"   media="screen" />';
 
 foreach($execute as $data_c){
     $nombres = $data_c['order_receiver_name'];
     $fecha = $data_c['order_date'];
     $item_name = $data_c['item_name'];
     $item_code = $data_c['item_code']; 
     $item_quantity = $data_c['order_item_quantity']; 
     $price = $data_c['order_item_unitario']; 
     $gramos = $data_c['gramos'];
     $total = $data_c['order_item_final_amount'];
    
     $output .= '<div class="contenedor">';
     $output .= '<div class="qr_contenedor">
     <img src="../qr-code.png" id="our_qr" width="60" height="60">
     </div>';
     $output .= '<div class="imagen_c">
     <img src="../logotipo.jpg" id="logo" width="120" height="100">
     </div>';
      
if($gramos == 0 || $gramos == NULL){
    $output .= '
    <div class="info_izquierda">
    <ul>
    <li><b>CODIGO:</b> '.$item_code.' / <b>GRAMOS:</b> '.$item_quantity.'</li>
    <li><b>CONTRATIPO:</b> '.$item_name.'</li>
    <li><b>PRECIO GR:</b> '.formatear($price).'</li>
    <li><b>TOTAL:</b> '.formatear($price*$item_quantity).'</li>
    <li><b>REMISION:</b> '.$cotizacion.'</li>
    <li><b>FECHA:</b> '.$fecha.'</li>
    <li><b>CLIENTE:</b> '.$nombres.'</li>
   </ul>
    </div>
    ';
}else{
    $output .= '
    <div class="info_izquierda">
    <ul>
    <li><b>CODIGO:</b> '.$item_code.'</li>
    <li><b>PRODUCTO:</b> '.$item_name.'</li>
    <li><b>TOTAL:</b> '.formatear($total).'</li>
    <li><b>REMISION:</b> '.$cotizacion.'</li>
    <li><b>FECHA:</b> '.$fecha.'</li>
    <li><b>CLIENTE:</b> '.$nombres.'</li>
   </ul>
    </div>
    ';
}
  


    
    $output .= '</div>';
    $output .= '<div id="espace"></div>';
   


 }




$invoiceFileName = 'Etiquetasperfumeria.pdf';
require_once '../dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml(html_entity_decode($output));
$dompdf->setPaper('letter', 'portrait');
// $dompdf->setPaper('letter', 'landscape');
$dompdf->render();
$dompdf->stream($invoiceFileName, array("Attachment" => false));
