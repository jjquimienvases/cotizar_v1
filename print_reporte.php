<?php
function formatear($num)
{

    setlocale(LC_MONETARY, 'en_US');

    return "$" . number_format($num, 2);
}
$con = new mysqli('ftp.jjquimienvases.com', 'jjquimienvases_jjadmin', 'LeinerM4ster', 'jjquimienvases_cotizar');
//las variables de filtro 
$cc_cliente = $_POST['cedulasres'];
$fecha_inicial = $_POST['inicial'];
$fecha_final = $_POST['final'];

//consulta de datos
$sql_ = "SELECT fo.order_id, fo.order_date, fo.order_receiver_name, fo.order_total_after_tax, oo.estado_abono, oo.restante,oo.abono, oo.deuda FROM factura_orden fo INNER JOIN order_abono oo ON fo.order_id = oo.order_id WHERE DATE(fo.order_date) BETWEEN '$fecha_inicial' AND '$fecha_final' AND fo.cedula = $cc_cliente AND oo.estado_abono = 'pendiente' ORDER BY fo.order_date ASC";
$execute = $con->query($sql_);

$sql_sum = $con->query("SELECT SUM(oo.restante) as tt FROM factura_orden fo INNER JOIN order_abono oo ON fo.order_id = oo.order_id WHERE DATE(fo.order_date) BETWEEN '$fecha_inicial' AND '$fecha_final' AND fo.cedula = $cc_cliente AND oo.estado_abono = 'pendiente'");
$deuda_total=mysqli_fetch_assoc($sql_sum);
$dt = $deuda_total['tt'];

$sql_sum_abono = $con->query("SELECT SUM(oo.abono) as ab FROM factura_orden fo INNER JOIN order_abono oo ON fo.order_id = oo.order_id WHERE DATE(fo.order_date) BETWEEN '$fecha_inicial' AND '$fecha_final' AND fo.cedula = $cc_cliente");
$abono_total = mysqli_fetch_assoc($sql_sum_abono);
$abt = $abono_total['ab'];

$sql_sum_deuda = $con->query("SELECT SUM(oo.deuda) as deu FROM factura_orden fo INNER JOIN order_abono oo ON fo.order_id = oo.order_id WHERE DATE(fo.order_date) BETWEEN '$fecha_inicial' AND '$fecha_final' AND fo.cedula = $cc_cliente");
$deuda_total = mysqli_fetch_assoc($sql_sum_deuda);
$deu = $deuda_total['deu'];



//sql para las completas 
$sql_completas = "SELECT fo.order_id, fo.order_date, fo.order_receiver_name, fo.order_total_after_tax, oo.estado_abono, oo.restante, oo.abono, oo.deuda FROM factura_orden fo INNER JOIN order_abono oo ON fo.order_id = oo.order_id WHERE DATE(fo.order_date) BETWEEN '$fecha_inicial' AND '$fecha_final' AND fo.cedula = $cc_cliente AND oo.estado_abono = 'completo' ORDER BY fo.order_date ASC";
$execute_completas = $con->query($sql_completas);

$countt = mysqli_num_rows($execute_completas) + mysqli_num_rows($execute);
// print_r($execute_completas);
// var_dump($sql_completas);

// return;
// $total = 0;
// $totales = 0;
$output = '';
$output .= ' <link href="css/estilos_reportes.css" rel="stylesheet" type="text/css"   media="screen" />
<center><img src="lg.jpeg" id="logo" width="300" height="200"> </center>
<hr>';

$output .= '<center><table border="1" cellpadding="5" cellspacing="0"> 
<tr>
<th> CANTIDAD DE COTIZACIONES </th>
</tr>
<tr>
<td>'.$countt.'</td>
</tr>
<tr>
<th>Deuda</th>
<th>Abono</th>
<th>Restante</th>
</tr>
<tr>
 <td>'.formatear($deu).'</td>
 <td>'.formatear($abt).'</td>
 <td>'.formatear($dt).'</td>
</tr>
<tr>
 <th>Utilidad Total</th>
 <th>Utilidad Promedio</th>
 <th>Datos</th>
</tr>
<tr>
<td>'.formatear(floatval($deu)*0.07).' </td>
<td>('.formatear(floatval($abt)*0.25).') </td>
<td>Datos </td>
</tr>
</table>
</center>
<hr>';
 $output .= '<center><h3>Cotizaciones Abonadas</h3></center> <hr>';

    foreach ($execute_completas as $data_abonadas) :

        $order_ids = $data_abonadas['order_id'];
        $order_dates = $data_abonadas['order_date'];
        $montos = $data_abonadas['restante'];
        $clientes = $data_abonadas['order_receiver_name'];
        $abonos = $data_abonadas['abono'];
           $deudas = $data_abonadas['deuda'];
        $sql_items_ = $con->query("SELECT * FROM factura_orden_producto WHERE order_id = $order_ids");
        $output .= '
        <table class="table table-bordered">
 <tr>
  <th>Fecha</th>
  <th>Cotizacion</th>
  <th>Cliente</th>
  <th>Deuda/abono</th>
 </tr>
 <tr>
  <td>' . $order_dates . '</td>
  <td>' . $order_ids . '</td>
  <td>' . $clientes . '</td>
  <td><ul>
  <li>Deuda:' . formatear($deudas) . '</li>
      <li>Abono:' . formatear($abonos) . '</li>
      <li>Restante:' . formatear($montos) . '</li>
      </ul>
  </td>
 </tr>';

        $output .= '
        
        <tr>
            <th>Codigo</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Total</th>
        </tr>
        ';
        foreach ($sql_items_ as $data_items_) {
            $item_name_ = $data_items_['item_name'];
            $item_code_ = $data_items_['item_code'];
            $order_item_quantity_ = $data_items_['order_item_quantity'];
            $order_item_final_amount_ = $data_items_['order_item_final_amount'];

            $output .= ' 
            <tr>
            <td>' . $item_code_ . '</td>
            <td>' . $item_name_ . '</td>
            <td>' . $order_item_quantity_ . '</td>
            <td>' . formatear($order_item_final_amount_) . '</td>
            </tr>';
        }
        $output .=  '</table>';
        $output .= '<hr>';
        $output .= '<br>';
        $output .= '<hr>';

    endforeach;

  $output .= '<center><h3>Cotizaciones Pendientes</h3></center> <hr>';
if ($execute) {
    foreach ($execute as $data) :

        $order_id = $data['order_id'];
        $order_date = $data['order_date'];
        $monto = $data['restante'];
        $cliente = $data['order_receiver_name'];
        $deuda = $data['deuda'];
 $abono = $data['abono'];
        $sql_items = $con->query("SELECT * FROM factura_orden_producto WHERE order_id = $order_id");
        $output .= '
        <table class="table table-bordered">
 <tr>
  <th>Fecha</th>
  <th>Cotizacion</th>
  <th>Cliente</th>
  <th>Totales</th>
 </tr>
 <tr>
  <td>' . $order_date . '</td>
  <td>' . $order_id . '</td>
  <td>' . $cliente . '</td>
  <td><ul>
      <li>Deuda:' . formatear($deuda) . '</li>
      <li>Abono:' . formatear($abono) . '</li>
      <li>Restante:' . formatear($monto) . '</li>
      </ul>
  </td>
 </tr>';

        $output .= '
        
        <tr>
            <th>Codigo</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Total</th>
        </tr>
        ';
        foreach ($sql_items as $data_items) {
            $item_name = $data_items['item_name'];
            $item_code = $data_items['item_code'];
            $order_item_quantity = $data_items['order_item_quantity'];
            $order_item_final_amount = $data_items['order_item_final_amount'];

            $output .= ' 
            <tr>
            <td>' . $item_code . '</td>
            <td>' . $item_name . '</td>
            <td>' . $order_item_quantity . '</td>
            <td>' . formatear($order_item_final_amount) . '</td>
            </tr>';
        }
        $output .=  '</table>';
        $output .= '<hr>';
        $output .= '<br>';
        $output .= '<hr>';

    endforeach; 
    
    $output .= '<center><table border="1" cellpadding="5" cellspacing="0"> 
<tr>
<th>Deuda</th>
<th>Abono</th>
<th>Restante</th>
</tr>
<tr>
 <td>'.formatear($deu).'</td>
 <td>'.formatear($abt).'</td>
 <td>'.formatear($dt).'</td>

</tr>
<tr>
 <th>Utilidad Total</th>
 <th>Utilidad Promedio</th>
 <th>Datos</th>
</tr>
<tr>
<td>'.formatear(floatval($deu)*0.07).' </td>
<td>('.formatear(floatval($abt)*0.25).') </td>
<td>Datos </td>
</tr>
</table>
</center>
<hr>';
    // $total = $totales;
 

    // $output .= '<p>DEUDA TOTAL = ' . formatear($dt) . '</p>';
    // $output .= '<p>ABONOS TOTALES = ' . formatear($abt) . '</p>';
} else {
    $output .= 'NO ENCONTRAMOS REGISTROS DE ESTA CONSULTA';
}

$invoiceFileName = 'Reporte_compras.pdf';
require_once 'dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml(html_entity_decode($output));
$dompdf->setPaper('letter', 'portrait');
$dompdf->render();
$dompdf->stream($invoiceFileName, array("Attachment" => false));
