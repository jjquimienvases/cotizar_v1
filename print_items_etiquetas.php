<?php 

include "globals.php";

function formatear($num){
	setlocale(LC_MONETARY, 'en_US');
	return "$" . number_format($num, 2);
}

//este documento es un post que recibe el numero de cotizacion 
 $item = $_GET['etiqueta'];

$sql = "SELECT pa.id, pa.contratipo, pa.unidad, ig.factura, ig.order_date FROM producto_av pa INNER JOIN ingresos ig ON pa.id = ig.code WHERE pa.id = $item ORDER BY ig.order_date DESC LIMIT 1";
// $sql_ = "SELECT pa.id, pa.contratipo, pa.unidad, ig.factura, pv.id FROM Comunas cINNER JOIN Provincias pON c.idprovincia= p.idprovincia INNER JOIN Regiones r ON r.IdRegion = p.IdRegion"
 $execute = $cnx->query($sql);

 
 $output = '';

 $output .= '<link href="css/style_item_etiquetas.css" rel="stylesheet" type="text/css"   media="screen" />';

 
 foreach($execute as $data) {
     $contratipo = $data['contratipo'];
     $unidad = $data['unidad'];
     $factura = $data['factura'];
     $fecha = $data['order_date'];

     $output .= '<div class="contenedor">';
     $output .= '<div class="imagen_c"><img src="logotipo.jpg" id="logo" width="150" height="130"></div>';

       $output .= '
     <div class="info_izquierda">
     <ul>
     <li><b>Codigo:</b> '.$item.'</li>
     <li><b>Referencia:</b> '.$contratipo.'</li>
     <li><b>Unidad De Empaque:</b> '.$unidad.'</li>
     <li><b>Fecha:</b> '.$fecha.'</li>
     <li><b>//:</b> '.$factura.'</li>
    </ul>
     </div>
     ';
     $output .= '<div class="qr_contenedor">
     <img src="qr-code.png" width="40" height="40">
     </div>';
     $output .= '<div class="el_foot">
     <footer><center>WWW.JJQUIMIENVASES.COM</center></footer>
       </div>'; 
     
     $output .= '</div>';

 }


 
$invoiceFileName = 'Etiquetasperfumeria.pdf';
require_once 'dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml(html_entity_decode($output));
$dompdf->setPaper('letter', 'portrait');
$dompdf->render();
$dompdf->stream($invoiceFileName, array("Attachment" => false));