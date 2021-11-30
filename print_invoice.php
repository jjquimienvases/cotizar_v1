<?php



date_default_timezone_set('america/bogota');

$hoy = getdate();
$date = DATE("Y-m-d h:i:s");

print_r($date);

return;

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

// $invoice->checkLoggedIn();

if (!empty($_GET['invoice_id']) && $_GET['invoice_id']) {

	$cotizacion = $_GET['invoice_id'];
}

$date = date("Y-m-d");

$puntos_de_venta = ["mostradorjj", "mostradord1", "mostrador_ibague_1", "mostrador_ibague_2", "bancolombia"];

// $sql = "SELECT fa.nuevo_abono,fa.metodo_de_pago FROM factura_orden fo INNER JOIN file_abono fa ON fo.order_id = fa.order_id WHERE DATE(fo.order_date) = '$date' AND order_id = $cotizacion AND fo.estado != 'solicitud anular' AND fo.estado != 'anulado' AND fo.estado != 'pendiente'";
$sql = "SELECT fa.nuevo_abono,fa.metodo_de_pago FROM file_abono fa INNER JOIN factura_orden fo ON fo.order_id = fa.order_id WHERE DATE(fa.order_date) = '$date' AND fa.order_id = $cotizacion";

//  $sql = "SELECT * FROM factura_orden fo INNER JOIN factura_modificada fm ON fo.order_id = fm.order_id INNER JOIN file_abono fa ON fo.order_id = fa.order_id WHERE DATE(fo.order_date) LIKE '%$date%' AND (fm.estado LIKE '%s_factura%' OR fm.estado LIKE '%finalizado%' OR fm.estado LIKE '%alistamiento%')";

$result = $conex->query($sql);
$latabla_abono = "";

if ($result != 0 || $result != "") {
	foreach ($result as $data) {
		$nuevo_abono = $data['nuevo_abono'];
		$metodo_de_pago = $data['metodo_de_pago'];
	}

	$latabla_abono = $nuevo_abono;
} else {
	$sql_ = $conex->query("SELECT fa.nuevo_abono,fa.metodo_de_pago FROM file_abono fa INNER JOIN factura_orden fo ON fo.order_id = fa.order_id WHERE fa.order_id = $cotizacion ORDER BY fa.order_date DESC LIMIT 1");
	if ($sql_) {
		foreach ($sql_ as $datas) {
			$nuevo_abono = $datas['nuevo_abono'];
			$metodo_de_pago = $datas['metodo_de_pago'];
		}
		$latabla_abono = $nuevo_abono;
	} else {
		$latabla_abono = 0;
	}
}


$sql_data = ("SELECT * FROM factura_orden INNER JOIN factura_orden_producto ON factura_orden.order_id = factura_orden_producto.order_id WHERE factura_orden.order_id = $cotizacion");
$execute = $conex->query($sql_data);

if ($execute) {
	foreach ($execute as $datas) {
		$cliente = $datas['order_receiver_name'];
		$fecha = $datas['order_date'];
		$comercial = $datas['order_receiver_address'];
		$metodo_de_pago = $datas['metodo_de_pago'];
		$afterTax = $datas['order_total_after_tax'];
		$taxPer = $datas['order_tax_per'];
		$totalTax = $datas['order_total_tax'];
		$amountD = $datas['order_total_amount_due'];
	}
} else {
	print_r($sql_data);
}

$output = '';









$output .= '<link href="css/styledom2.css" rel="stylesheet" type="text/css"   media="screen" />

<table width="100%" border="1" cellpadding="5" cellspacing="0" height="90px;" >



	<tr>





	<td colspan="2">

	<table width="100%" cellpadding="5">

	<tr>

<td colspan="2" align="center">	<img src="imagenes/header.jpg" alt="Logo" style="width:780px;height:129px;></td>



</tr>





	<tr >

	<td style="font-size:12px; aling="left" colspan="4"><P><strong> Solicita tu factura, enviando tu numero de remisión y RUT al correo asistente@envasesyperfumeria.com  </strong></P></td>

	</tr>

	<hr>

	<tr>

	<td style="font-size:12px; aling="left" colspan="4"><P><strong> Los productos cotizados en esta remisión llevan el IVA incluido.</strong> <br> La entrega de los productos cotizados se hará 72 horas hábiles.</P></td>

	</tr>



	<tr>

	<td width="40%">



	Cliente: ' . $invoiceValues['order_receiver_name'] . '<br />

	Asesor Comercial: ' . $invoiceValues['order_receiver_address'] . '<br />

    Metodo de pago: ' . $invoiceValues['metodo_de_pago'] . '<br />

	</td>

	<td width="55%">

	remision No. : ' . $invoiceValues['order_id'] . '<br />

	Fecha : ' . $invoiceDate . '<br />

	</br>



	</table>

	<br />

	<table width="100%" height="50%" border="1" cellpadding="5" cellspacing="0">

	<tr>

<th align="left">No.	</th>
	<th align="left">CODIGO</th>
	<th align="left">PRODUCTO</th>
	<th align="left">CANTIDAD</th>
	<th align="left">UNIDAD</th>
	<th align="left">PRECIO</th>

	</tr>';

$count = 0;

foreach ($invoiceItems as $invoiceItem) {

	$count++;

	$output .= '

	<tr height="90%" >

	<td align="left" height="5px" >' . $count . '</td>

	<td align="left">' . $invoiceItem["item_code"] . '</td>

	<td align="left">' . $invoiceItem["item_name"] . '</td>

	<td align="left">' . $invoiceItem["order_item_quantity"] . '</td>

	<td align="left">' . formatear($invoiceItem["order_item_unitario"]) . '</td>

	<td align="left">' . formatear($invoiceItem["order_item_final_amount"]) . '</td>

	</tr>';
}
$output .= '

		<tr>

		<td align="right" colspan="5"><b>Sub Total</b></td>

		<td align="left"><b>' . formatear($invoiceValues['order_total_before_tax']) . '</b></td>

		</tr>

	    <tr>

		<td align="right" colspan="5"><b> Porcentaje:</b></td>

		<td align="left">' . $invoiceValues['order_tax_per'] . '%</td>

		</tr>
		<tr>

		<td align="right" colspan="5"><b>Total con descuento</b></td>

		<td align="left">' . formatear($invoiceValues['order_total_amount_due']) . '</td>

		</tr>
		 <tr>

		<td align="right" colspan="5"><b>Ahorro: </b></td>

		<td align="left">' . formatear($invoiceValues['order_total_tax']) . '</td>

		</tr>
		<tr>

		<td align="right" colspan="5"><b>Abonos</b></td>

		<td align="left">' . formatear($latabla_abono) . '</td>

		</tr>



			';


$output .= '



	</table>



	</tr>

    <tr>

<td align="left" colspan ="2"><strong><P>Notas:</P>' . $invoiceValues['note'] . '</strong></td>

    </tr>

	<tr>

	<td colspan="2"><img src="imagenes/metodos.jpg" alt="Logo" style="width:785px;height:140px"; ><br>

	</tr>

		<tr>



<td colspan="2" align="center" style="font-size:15px">



<center><h4>7 de agosto Cra 25 No. 66-82 Bogota D.C.</h4></center>

<center><h4> Tel: (1) 606 50 89 Cel: 350 493 13 55 </h4></center>

 <center><h2> DESTINATARIO </h2></center>

<p align="left"> <strong>NOMBRES Y APELLIDOS:</strong>&nbsp;' . $invoiceValues['order_receiver_name'] . '</p>

 <p align="left"> <strong>DIRECCION:</strong>&nbsp;' . $invoiceValues['direccion'] . ' &nbsp; <strong>CEDULA: </strong>&nbsp; ' . $invoiceValues['cedula'] . ' </p>

 <p align="left"> <strong>TELEFONO:</strong>&nbsp;' . $invoiceValues['tel_client'] . ' &nbsp;	<strong> CIUDAD:</strong>&nbsp;' . $invoiceValues['ciudad'] . '</p>

 <p aling="left"> <strong>EMAIL:</strong>&nbsp;' . $invoiceValues['email'] . '</p>

</td>

</tr>



	</table>';

// create pdf of invoice

$invoiceFileName = 'Invoice-' . $invoiceValues['order_id'] . '.pdf';

require_once 'dompdf/src/Autoloader.php';

Dompdf\Autoloader::register();

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$dompdf->loadHtml(html_entity_decode($output));

$dompdf->setPaper('letter', 'portrait');

$dompdf->render();

$dompdf->stream($invoiceFileName, array("Attachment" => false));
