<?php
include 'transfers/conexion.php';
session_start([

    'cookie_lifetime' => 86400,

    'gc_maxlifetime' => 86400,

]);

function formatear($num)
{

    setlocale(LC_MONETARY, 'en_US');

    return "$" . number_format($num, 2);
}

$order = $_GET['order'];

$sql = $con->query("SELECT * FROM `traspaso_orden` WHERE transfer_id = $order");
$sql_item = $con->query("SELECT * FROM `traspaso_producto_id` WHERE transfer_id = $order");

foreach ($sql as $data) {
    $solicita = $data['solicitante'];
    $empaca = $data['empaca'];
    $recibe = $data['recibe'];
    $fecha = $data['order_date'];
    $estado = $data['estado'];
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

	<td style="font-size:12px; aling="left" colspan="4"><P><strong> </strong></P></td>

	</tr>

	<hr>

	<tr>

	<td style="font-size:12px; aling="left" colspan="4"><P><strong> </strong> <br> </P></td>

	</tr>



	<tr>

	<td width="40%">



	Solicita: ' . $solicita . '<br />

	Empaca: ' . $empaca . '<br />

    Recibe: ' . $recibe . '<br />

	</td>

	<td width="55%">

	Traspaso No. : ' . $order . '<br />

    
	Estado: ' . $estado . '<br />
	Fecha: ' . $fecha . '<br />
	</br>


  </tr>
	</table>

	<br />

	<table width="100%" height="50%" border="1" cellpadding="5" cellspacing="0">

	<tr>

	<th align="left">No.	</th>

	<th align="left">Codigo</th>

	<th align="left">Nombre Producto</th>

	<th align="left">Cantidad</th>
	<th align="left">Punteo</th>

	</tr>';

$count = 0;

foreach ($sql_item as $data_) {

    $count++;

    $output .= '

	<tr height="90%" >

	<td align="left" height="5px" >' . $count . '</td>

	<td align="left">' . $data_["item_code"] . '</td>

	<td align="left">' . $data_["item_name"] . '</td>

	<td align="left">' . $data_["item_quantity"] . '</td>
	<td align="left"></td>

	</tr>';
}



$output .= '



	</table>
	</table>
    ';
    $output .= '
    <br>
    <hr>
    <br>
    <br>
    <P>FIRMAR DEL COLABORADOR QUE RECIBE LA MERCANCIA:_____________________________________</P>';


// create pdf of invoice

$invoiceFileName = 'Traspaso-' . $order . '.pdf';

require_once 'dompdf/src/Autoloader.php';

Dompdf\Autoloader::register();

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$dompdf->loadHtml(html_entity_decode($output));

$dompdf->setPaper('letter', 'portrait');

$dompdf->render();

$dompdf->stream($invoiceFileName, array("Attachment" => false));
