    
<?php
session_start([
    'cookie_lifetime' => 86400,
    'gc_maxlifetime' => 86400,
]);
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
$output .= '
<table width="53%" border="1" cellpadding="5" cellspacing="0" height="90px;" >
 <link href="css/estilo_imprimir_termica.css" rel="stylesheet" type="text/css"   media="screen" />
	<tr>


	<td colspan="2">
	<table width="100%" cellpadding="6">
	<tr>
<td colspan="6" align="center">	<img src="imagenes/logos.jpg" alt="JJQUIMIENVASES"></td>
</tr>
<tr><td colspan="6"   aling="center"  style="font-size:15px" >  <p align="center"> <strong> NIT: 901.291.848 </strong> </p></td>
 </tr>


	<tr >
	<td style="font-size:17px; aling="left" colspan="6"><P><strong> Solicita tu factura, enviando tu numero de remision y RUT al correo asistente@envasesyperfumeria.com </strong></P></td>
	</tr>

	<tr>
	<td width="100%" colspan="6" align="center" >

	Cliente: '.$invoiceValues['order_receiver_name'].'<br />
	Asesor Comercial: '.$invoiceValues['order_receiver_address'].'<br />
    Metodo de pago: '.$invoiceValues['metodopago'].'<br />
	</td>
 </tr>
 <tr>
 <td width="100%" colspan="6" align="center">
 '.$invoiceDate.'<br />
remision No:  '.$invoiceValues['order_id'].'<br /></td>
 </tr>

	<tr>
	<td width="100%" colspan="6" align="center"><strong>Esta remision tiene el iva incluido</strong></p> </td>
	</tr>
	</table>

	<table width="100%" height="50%" border="1" cellpadding="5" cellspacing="0">
	<tr>
	<th align="center">No.	</th>
	<th align="center">Codigo</th>
	<th align="center">Producto</th>
	<th align="center" style="width:50px;">Cantidad</th>
	<th align="center">Precio</th>
	</tr>';
$count = 0;
foreach($invoiceItems as $invoiceItem){
	$count++;
	$output .= '
	<tr height="90%" >
	<td align="center" height="5px" >'.$count.'</td>
	<td align="center">'.$invoiceItem["item_code"].'</td>
	<td align="center">'.$invoiceItem["item_name"].'</td>
	<td align="center">'.$invoiceItem["order_item_quantity"].'</td>

	<td align="center">'.formatear($invoiceItem["order_item_final_amount"]).'</td>
	</tr>';
}$output .= '
	     <tr>
		<td align="right" colspan="4"><b>Total: </b></td>
		<td align="center">'.formatear($invoiceValues['order_total_after_tax']).'</td>
		</tr>
		<tr>
		<td align="right" colspan="4"><b>Total con descuento</b></td>
		<td align="center">'.formatear($invoiceValues['order_total_amount_due']).'</td>
		</tr>
			';

$output .= '

	</table>

	</tr>
    <tr>
<td align="left" colspan ="2"><P>Notas:</P>'.$invoiceValues['note'].'</td>
    </tr>

	</table>';
// create pdf of invoice
$invoiceFileName = 'Invoice-'.$invoiceValues['order_id'].'.pdf';
require_once 'dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->loadHtml(html_entity_decode($output));
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream($invoiceFileName, array("Attachment" => false));
?>
