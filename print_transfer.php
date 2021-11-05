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


	<tr>

	<td width="100%" colspan="6" align="center" >



	Solicita: '. $solicita .'<br />

	Empaca: '. $empaca .'<br />

    Recibe: '. $recibe .'<br />

	</td>

 </tr>

 <tr>

 <td width="100%" colspan="6" align="center">

 '. $fecha .'<br />

Traspaso No:  '.$order.'<br />
Estado: '.$estado.'<br/>
</td>

 </tr>


	</table>



	<table width="100%" height="50%" border="1" cellpadding="5" cellspacing="0">

	<tr>

	<th align="center">No.	</th>

	<th align="center">Codigo</th>

	<th align="center">Producto</th>

	<th align="center" style="width:50px;">Cantidad</th>

	<th align="center">Punteo</th>

	</tr>';

$count = 0;

foreach($sql_item as $data_){

	$count++;

	$output .= '

	<tr height="90%" >

	<td align="center" height="5px" >'.$count.'</td>
	<td align="center">'.$data_["item_code"].'</td>
	<td align="center">'.$data_["item_name"].'</td>
	<td align="center">'.$data_["item_quantity"].'</td>
	<td align="center"></td>

	</tr>';

}


$output .= '



	</table>
	</tr>
	</table>';

    $output .= '
    <br>
    <br>
    <P>FIRMA:_____________________________________</P>';


// create pdf of invoice

$invoiceFileName = 'Traspaso-'.$order.'.pdf';

require_once 'dompdf/src/Autoloader.php';

Dompdf\Autoloader::register();

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$dompdf->loadHtml(html_entity_decode($output));

$dompdf->setPaper('A4', 'portrait');

$dompdf->render();

$dompdf->stream($invoiceFileName, array("Attachment" => false));

?>

