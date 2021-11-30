<?php
function formatear($num){
  setlocale(LC_MONETARY, 'en_US');
  return "$" . number_format($num, 2);
}


error_reporting(E_ALL ^ E_NOTICE);
require_once '../dao/adminDAO.php';

$impr = new adminDAO();

if(strlen($_POST['desde'])>0 and strlen($_POST['hasta'])>0){
	$desde = $_POST['desde']."&nbsp;"."08:01:00" ;
	$hasta = $_POST['hasta']."&nbsp;"."19:59:59";

	$verDesde = date('d/m/Y', strtotime($desde));
	$verHasta = date('d/m/Y', strtotime($hasta));
}else{
	$desde = '1111-01-01';
	$hasta = '9999-12-30';

	$verDesde = '__/__/____';
	$verHasta = '__/__/____';
}
require_once('../tcpdf/tcpdf.php');


	$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Leiner Mena');
	$pdf->SetTitle($_POST['reporte_name']);

	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(TRUE);
	$pdf->SetMargins(20, 10, 20, 20);
	$pdf->SetAutoPageBreak(true, 20);
	$pdf->SetFont('Helvetica', '', 10);
	$pdf->addPage();



$datos = $impr->buscarAllBitacoraFecha($desde,$hasta);

$content = '';

	$content .= '
		<div class="row">

        	<div class="col-md-12">

				<h3 style="text-align:center;">Reporte de ventas Mostrador</h3>
            	<h3 style="text-align:center;">Desde '.$desde.' hasta: '.$hasta.'</h3>

      <table border="1" cellpadding="5">
        <thead>
          <tr bgcolor="#E5E5E5">
            <th width="5%">Nº</th>
            <th width="15%">Fecha</th>
            <th width="15%">Cotizacion</th>
            <th width="20%">Cliente</th>
            <th width="20%">Comercial</th>
            <th width="25%">Monto</th>
          </tr>
        </thead>
	';

 $totall = 0;
	for($x=0; $x<count($datos); $x++){
	$x; $l = $x+1;
	$fecha = fechaNormal($datos[$x]['order_date']);
	$cotizacion = $datos[$x]['order_id'];
	$cliente = $datos[$x]['order_receiver_name'];
  $monto = $datos[$x]['order_total_after_tax'];
	$vendor = $datos[$x]['order_receiver_address'];

 $valor_total = 0;
 $valor_total = $monto;
$totall += $valor_total;




	$content .= '
		<tr nobr="true" bgcolor="#f5f5f5">
            <td width="5%">'.$l.'</td>
            <td width="15%">'.$fecha.'</td>
            <td width="15%">'.$cotizacion.'</td>
            <td width="20%">'.$cliente.'</td>
            <td width="20%">'.$vendor.'</td>
            <td width="25%">'.formatear($monto).'</td>
        </tr>
	';
	}

	$content .= '</table>';

	$content .= '<table border="1" cellpadding="5">
	<tfoot>
	<tr>
	<td colspan="4">Monto Total: </td>
	<td>'.formatear($totall).'</td>
	</tr>
	</tfoot>
	            </table>';



//CONSULTA

$pdf->writeHTML($content, true, 0, true, 0);

$pdf->lastPage();

$pdf->output('../temp/reporte.pdf', 'F');
?>
