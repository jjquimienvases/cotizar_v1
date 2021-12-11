<?php
session_start([
    'cookie_lifetime' => 86400,
    'gc_maxlifetime' => 86400,
]);
function formatear($num){
	setlocale(LC_MONETARY, 'en_US');
	return "$" . number_format($num, 2);
}
include 'orden_invoice.php';
include 'conectar.php';
$con = conectar();
$invoice = new Invoice();
$invoice->checkLoggedIn();
if(!empty($_GET['invoice_id']) && $_GET['invoice_id']) {
	echo $_GET['invoice_id'];
	$invoiceValues = $invoice->getInvoice($_GET['invoice_id']);
	$invoiceItems = $invoice->getInvoiceItems($_GET['invoice_id']);
}
$invoiceDate = date("d/M/Y h:i:s A", strtotime($invoiceValues['order_date']));
$output = '';




$output .= '<link href="css/styledom2.css" rel="stylesheet" type="text/css"   media="screen" />
<div  class="saltopagina">
<table width="100%" border="1" cellpadding="5" cellspacing="0" height="90px;" >

	<tr>


	<td colspan="2">
	<table width="100%" cellpadding="5">
	<tr>
<td colspan="2" align="center">	<img src="imagenes/logos.jpg" alt="Logo" style="width:150px;height:105px;></td>
<td   aling="center"  style="font-size:12px" >  <p align="center"> <strong> NIT: 901.291.848 </strong> </p></td>
</tr>



	<tr>
	<td width="40%">
	<strong>	Cliente: </strong>&nbsp; '.$invoiceValues['order_receiver_name'].'<br />
<strong>  Direccion:</strong>&nbsp;'.$invoiceValues['direccion'].' &nbsp; Ciudad:</strong>&nbsp;'.$invoiceValues['ciudad'].' <br />
	</td>
	<td width="55%">
	Orden No. : '.$invoiceValues['order_id'].'<br />
	Fecha : '.$invoiceDate.'<br />
	</br>
	</table>
	<br />
	<table width="100%" height="50%" border="1" cellpadding="5" cellspacing="0">
	<tr>
	 <th align="left">No.	</th>
		<th align="left">Referencia</th>
		<th align="left">Cajas</th>
		<th align="left">Unidades</th>
	</tr>';
$count = 0;
foreach($invoiceItems as $invoiceItem){
    $id = $invoiceItem["item_code"];
    $item_name = $invoiceItem["item_name"];
    $cantidad = $invoiceItem["order_item_quantity"];
    $cantidad_numero = $invoiceItem["cantidad_numero"];
    $sql_2 = $con->query("SELECT * FROM producto_av WHERE id = $id");
    foreach($sql_2 as $data){
    $name_prov = $data['name_prov'];    
    $the_name = "";
    if($name_prov == ""){
        $the_name = $item_name;
    }else{
        $the_name = $name_prov;
    }
	$count++;
	$output .= '
	
	<tr height="90%" >
	<td> '.$count.' </td>
	<td> '.$the_name.' </td>
	<td>'.$cantidad.' </td>
	<td>'.$cantidad_numero.' </td>
	</tr>
	
	';
    }
}
$output .= '

	</table>
	</tr>

    <tr>
<td align="left" colspan ="2"><h5>Observaciones:</h5>'.$invoiceValues['note'].'</td>
    </tr>

	</table>
</div>

	<center>  <p>Direccion: Cra 25 #66-82  Tel: 350 493 13 55  Email:Asistente@envasesyperfumeria.com  www.envasesyperfumeria.com </p></center> ';
// create pdf of invoice
$invoiceFileName = 'Invoice-'.$invoiceValues['order_id'].'.pdf';
require_once 'dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->loadHtml(html_entity_decode($output));
$dompdf->setPaper('letter', 'portrait');
$dompdf->render();
$dompdf->stream($invoiceFileName, array("Attachment" => false));
?>