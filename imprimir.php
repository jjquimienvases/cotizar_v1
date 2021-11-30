<?php
function formatear($num)
{
	setlocale(LC_MONETARY, 'en_US');
	return "$" . number_format($num, 2);
}

if (!empty($_GET['invoice_id']) && $_GET['invoice_id']) {
	$cotizacion = $_GET['invoice_id'];
}

$conex = new mysqli('173.230.154.140', 'cotizar', 'LeinerM4ster', 'cotizar');
$date = date("Y-m-d");
$order = $_GET['invoice_id'];

$sql = "SELECT fa.nuevo_abono,fa.metodo_de_pago FROM file_abono fa INNER JOIN factura_orden fo ON fo.order_id = fa.order_id WHERE DATE(fa.order_date) = '$date' AND fa.order_id = $order";
$result = $conex->query($sql);
if ($result) {
	foreach ($result as $data) {
		$nuevo_abono = $data['nuevo_abono'];
		$metodo_de_pago = $data['metodo_de_pago'];
	}

	$latabla_abono = $nuevo_abono;
} else {
	$latabla_abono = 0;
}

$sql_data = ("SELECT fo.order_receiver_name FROM factura_orden fo INNER JOIN factura_orden_producto fp ON fo.order_id = fp.order_id WHERE fo.order_id = $cotizacion");
$execute = $conex->query($sql_data);

if($execute){
	foreach ($execute as $datas) {
		$cliente = $datas['order_receiver_name'];
}
	echo $cliente;
}else{
	print_r($sql_data);
}


return

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
	<td style="font-size:17px; aling="left" colspan="6"><P><strong> Solicita tu factura, enviando tu numero de remisión y RUT al correo asistente@envasesyperfumeria.com </strong></P></td>
	</tr>

	<tr>
	<td width="100%" colspan="6" align="center" >

	Cliente: ' . $cliente . '<br />
	Asesor Comercial: ' . $comercial . '<br />
    Metodo de pago: ' . $metodo_de_pago . '<br />
	</td>
 </tr>
 <tr>
 <td width="100%" colspan="6" align="center">
 ' . $fecha . '<br />
remision No:  ' . $cotizacion . '<br /></td>
 </tr>

	<tr>
	<td width="100%" colspan="6" align="center"><strong>Los productos cotizados en esta remisión llevan el IVA incluido</strong></p> </td>
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
foreach ($execute as $invoiceItem) {
	$count++;
	$output .= '
	<tr height="90%" >
	<td align="center" height="5px" >' . $count . '</td>
	<td align="center">' . $invoiceItem["item_code"] . '</td>
	<td align="center">' . $invoiceItem["item_name"] . '</td>
	<td align="center">' . $invoiceItem["order_item_quantity"] . '</td>

	<td align="center">' . formatear($invoiceItem["order_item_final_amount"]) . '</td>
	</tr>';
}
$output .= '
	     <tr>
		<td align="right" colspan="4"><b>Total: </b></td>
		<td align="center">' . formatear($invoiceValues['order_total_after_tax']) . '</td>
		</tr>
		<tr>
		<td align="right" colspan="4"><b>Porcentaje:</b></td>
		<td align="center">' . ($invoiceValues['order_tax_per']) . '</td>
		</tr>
		<tr>
		<td align="right" colspan="4"><b>Ahorro:</b></td>
		<td align="center">' . formatear($invoiceValues['order_total_tax']) . '</td>
		</tr>
		<tr>
		<td align="right" colspan="4"><b>Total con descuento:</b></td>
		<td align="center">' . formatear($invoiceValues['order_total_amount_due']) . '</td>
		</tr>
		<tr>
		<td align="right" colspan="4"><b>Abono:</b></td>
		<td align="center">' . formatear($latabla_abono) . '</td>
		</tr>
			';

$output .= '




    <tr>
<td align="left" colspan ="5"><P>Notas:</P>' . $invoiceValues['note'] . '</td>
    </tr>

	</table>';
// create pdf of invoice
$invoiceFileName = 'Invoice-' . $invoiceValues['order_id'] . '.pdf';
require_once 'dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml(html_entity_decode($output));
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream($invoiceFileName, array("Attachment" => false));
