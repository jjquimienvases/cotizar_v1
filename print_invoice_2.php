<?php
session_start();
function formatear($num){
	setlocale(LC_MONETARY, 'en_US');
	return "$" . number_format($num, 2);
}
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();
if(!empty($_GET['invoice_id']) && $_GET['invoice_id']) {
	echo $_GET['invoice_id'];
	$invoiceValues = $invoice->getInvoice($_GET['invoice_id']);
	$invoiceItems = $invoice->getInvoiceItems($_GET['invoice_id']);
}
$invoiceDate = date("d/M/Y h:i:s A", strtotime($invoiceValues['order_date']));
$output = '';

$totales = "";


$output .= '<link href="css/styledom2.css" rel="stylesheet" type="text/css"   media="screen" />
<table width="100%" border="1" cellpadding="5" cellspacing="0" height="90px;" >

	<tr>


	<td colspan="2">
	<table width="100%" cellpadding="5">
	<tr>
<td colspan="2" align="center">	<img src="imagenes/header.jpg" alt="Logo" style="width:780px;height:129px;></td>

</tr>


	<tr >
	<td style="font-size:12px; aling="left" colspan="4"><P><strong> Solicita tu factura, enviando tu numero de remision y RUT al correo asistente@envasesyperfumeria.com </strong></P></td>
	</tr>
	<hr>
	<tr>
	<td style="font-size:12px; aling="left" colspan="4"><P><strong> Esta remision tiene el iva incluido. </strong></P></td>
	</tr>

	<tr>
	<td width="40%">

	Cliente: '.$invoiceValues['order_receiver_name'].'<br />
	Asesor Comercial: '.$invoiceValues['order_receiver_address'].'<br />
    Metodo de pago: '.$invoiceValues['metodo_de_pago'].'<br />
    
	</td>
	<td width="55%">
	remision No. : '.$invoiceValues['order_id'].'<br />
	remision Fecha : '.$invoiceDate.'<br />
	</br>

	</table>
	<br />
	<table width="100%" height="50%" border="1" cellpadding="5" cellspacing="0">
	<tr>
	<th align="left">No.	</th>
	<th align="left">Codigo</th>
	<th align="left">Nombre Producto</th>
	<th align="left">Cantidad</th>
	<th align="left">Unidad</th>
	<th align="left">Precio</th>
	</tr>';
$count = 0;
foreach($invoiceItems as $invoiceItem){
	$count++;
	$totales = $invoiceValues['order_tax_per'];
    $sin_iva  = $totales/ 1.19;
	$output .= '
	<tr height="90%" >
	<td align="left" height="5px" >'.$count.'</td>
	<td align="left">'.$invoiceItem["item_code"].'</td>
	<td align="left">'.$invoiceItem["item_name"].'</td>
	<td align="left">'.$invoiceItem["order_item_quantity"].'</td>
	<td align="left">'.formatear($invoiceItem["order_item_unitario"]).'</td>
	<td align="left">'.formatear($invoiceItem["order_item_final_amount"]).'</td>
	</tr>';
}$output .= '
   
		<tr>
		<td align="right" colspan="5"><b>Sub Total (Sin IVA)</b></td>
		<td align="left">'.formatear($invoiceValues['order_total_after_tax']/1.19).'</td>
		</tr>
	    <tr>
		<td align="right" colspan="5"><b> Porcentaje:</b></td>
		<td align="left">'.$invoiceValues['order_tax_per'].'%</td>
		</tr>
	     <tr>
		<td align="right" colspan="5"><b>Total (Con IVA): </b></td>
		<td align="left">'.formatear($invoiceValues['order_total_after_tax']).'</td>
		</tr>
		<tr>
		<td align="right" colspan="5"><b>Total con descuento</b></td>
		<td align="left">'.formatear($invoiceValues['order_total_amount_due']).'</td>
		</tr>

			';

$output .= '

	</table>

	</tr>
    <tr>
    
<td align="left" colspan ="2"><b>Notas:</b><b>'.$invoiceValues['note'].'</b></td>
    </tr>
	<tr>
	<td colspan="2"><img src="imagenes/metodos.jpg" alt="Logo" style="width:785px;height:140px"; ><br>
	</tr>
		<tr>

<td colspan="2" align="center" style="font-size:15px">

<center><h4>7 de agosto Cra 25 No. 66-82 Bogota D.C.</h4></center>
<center><h4> Tel: (1) 606 50 89 Cel: 350 493 13 55 </h4></center>
 <center><h2> DESTINATARIO </h2></center>
<p align="left"> <strong>NOMBRES Y APELLIDOS:</strong>&nbsp;'.$invoiceValues['order_receiver_name'].'</p>
 <p align="left"> <strong>DIRECCION:</strong>&nbsp;'.$invoiceValues['direccion'].' &nbsp; <strong>Cedula </strong>&nbsp; '.$invoiceValues['cedula'].' </p>
 <p align="left"> <strong>TELEFONO:</strong>&nbsp;'.$invoiceValues['tel_client'].' &nbsp;	<strong> CIUDAD:</strong>&nbsp;'.$invoiceValues['ciudad'].'</p>
 <p aling="left"> <strong>EMAIL:</strong>&nbsp;'.$invoiceValues['email'].'</p>
</td>
</tr>

	</table>';
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