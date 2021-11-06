<?php 
include "globals.php";
//este documento es un post que recibe el numero de cotizacion 

//  include 'arch.php';
 //consulta informacion cliente

/*  $sql_ = "SELECT * FROM factura_orden fo INNER JOIN factura_orden_producto fp ON fo.order_id = fp.order_id  WHERE fo.order_id = $cotizacion AND fp.item_categoria = 4"; */
 $sql = "SELECT * FROM producto_av WHERE id BETWEEN 201 AND 378 AND id_categoria = 4";
 $execute = $cnx->query($sql);


//  <link href="css/estilos_etiquetas.css" rel="stylesheet" type="text/css"   media="screen" />
// <center><img src="JJ CIRCULO LOGO (fondo blanco).png" id="logo" width="300" height="200"> </center>
 $output = '';

 $output .= '<link href="css/style_etiquetas_2.css" rel="stylesheet" type="text/css"   media="screen" />';
 
 foreach($execute as $data_c){
    
     $item_name = $data_c['contratipo'];
     $item_code = $data_c['id']; 
     $item_genero = $data_c['genero']; 
     
    
     $output .= '<div class="contenedor">';
   
   
     $output .= '<div class="imagen_c">
     <img src="logotipo.jpg" id="logo" width="120" height="100">
     </div>';
     
     $output .= '
       <div class="info_izquierda">
       <table>
        <tr>
         <td><b>CODIGO:</b></td>
        
      </tr>
     <tr>
      <td>'.$item_code.'</td>
     </tr>
        <tr>
         <td><b>CONTRATIPO:</b></td>
        
      </tr>
      <tr>
       <td>'.strtoupper($item_name).'</td>
      </tr>
        <tr>
         <td><b>GENERO:</b></td>
        
      </tr>
      <tr>
       <td>'.strtoupper($item_genero).'</td>
      </tr>
       </table>
       
       </div>
     ';
    
  
     $output .= '<div class="el_foot">
     <footer><center><p></p>WWW.JJQUIMIENVASES.COM</p></center></footer>
       </div>'; 

    
    $output .= '</div>';
    $output .= '<div id="espace"></div>';
   


 }




$invoiceFileName = 'Etiquetasperfumeria.pdf';
require_once 'dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml(html_entity_decode($output));
$dompdf->setPaper('letter', 'portrait');
// $dompdf->setPaper('letter', 'landscape');
$dompdf->render();
$dompdf->stream($invoiceFileName, array("Attachment" => false));
