<?php
function formatear($num){

	setlocale(LC_MONETARY, 'en_US');

	return "$" . number_format($num, 2);

}
 require 'conexion.php';

 $order = $_GET['order'];

 $sql = $con->query("SELECT * FROM order_shop_id osi INNER JOIN order_shop_products osp ON osi.order_id = osp.order_id WHERE osp.order_id = $order");
  foreach($sql as $datas){
      $name = $datas['user_create'];
      $provider = $datas['proveedor'];
      $totales = $datas['result'];
      $order_date = $datas['order_date'];
      $id_provider = $datas['id_proveedor'];

      $sql_info = $con->query("SELECT * FROM proveedor WHERE codigo = $id_provider");
      if($sql_info){
          foreach($sql_info as $data_p){
              $direccion = $data_p['direccion'];
          }
      }else{
          $direccion = $id_provider;
      }

  }
 $output = '';
 


 $output .= '<link href="css/style_dom.css" rel="stylesheet" type="text/css"   media="screen" />

<table width="100%" border="1" cellpadding="5" cellspacing="0" height="90px;" >
	<tr>
	<td colspan="2">

	<table width="100%" cellpadding="5">

	<tr>

<td   aling="center"  style="font-size:12px" >  <p align="center"> <strong> NIT: 901.291.848 </strong> </p></td>
</tr>
	<tr>

	<td width="40%">

	<strong>Proveedor: </strong> '.$provider.'<br />

<strong>  Direccion:</strong> '.$direccion.' <br />

	</td>

	<td width="55%">

	<b>Orden No. :</b> '.$order.'<br />

	<b>Fecha :</b> '.$order_date.'<br />

	</br>

	</table>

	<br />

	<table width="100%" height="50%" border="1" cellpadding="5" cellspacing="0">

	<tr>

	 <th align="left">No.</th>

		<th align="left">REFERENCIA</th>

		<th align="left">CANTIDAD</th>



	</tr>';

$count = 0;

foreach($sql as $data){

	$count++;
	$real_name = "";
	$item_id = $_POST['item_id'];

	$sql_csn = "SELECT * FROM producto_av WHERE id = $id";
	$execute_csn = $con->query($sql_csn);

	foreach($sql as $data_nm){
		$name_provider = $data_nm['name_prov'];
		
	}

	$output .= '

	<tr height="90%" >

	<td> '.$count.' </td>

	<td> '.$data["item_name"].' </td>

	<td>'.$data["cantidad"].' </td>



	</tr>';

}

$output .= '


	</table>
	    <tr>
<td align="right" colspan ="5"><b>Total:</b>'.formatear($totales).'</td>
    </tr>
	</table>





	<center>  <p>Direccion: Cra 25 #66-82  Tel: +57 302 267 1732 <br> Email:Asistente@envasesyperfumeria.com <br> www.jjquimienvases.com </p></center> ';


 // create pdf of invoice

$invoiceFileName = 'Orden-'.$order.'.pdf';

require_once '../dompdf/src/Autoloader.php';

Dompdf\Autoloader::register();

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml(html_entity_decode($output));
$dompdf->setPaper('letter', 'portrait');
$dompdf->render();
$dompdf->stream($invoiceFileName, array("Attachment" => false));
/* $dompdf->page_text(1,1, "{PAGE_NUM} of {PAGE_COUNT}", $font, 10, array(0,0,0));*/
