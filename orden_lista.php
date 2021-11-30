<?php
session_start([
    'cookie_lifetime' => 86400,
    'gc_maxlifetime' => 86400,
]);
function formatear($num){
	setlocale(LC_MONETARY, 'en_US');
	return "$" . number_format($num, 2);
}
include('header.php');
include('orden_invoice.php');
$invoice = new Invoice();
$invoice->checkLoggedIn();
?>
<title>Lista Orden de compra</title>
<!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
<script src="js/invoice.js"></script>
<link href="css/style.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> -->

<?php include('container.php');?>
<div class="container">
<h2 class="title">ORDENES DE COMPRA</h2>
<?php include('menu5.php');?>
<table id="data-table" class="table table-condensed table-striped">
<thead>
  <tr>
    <th width="7%">Orden. No.</th>
    <th width="15%">Fecha Creación</th>
    <th width="35%">Cliente</th>
    <th width="3%"></th>
    <th width="3%"></th>
    <th width="3%"></th>
  </tr>
</thead>
<tbody><?php
$invoiceList = $invoice->getInvoiceList();
foreach($invoiceList as $invoiceDetails){
    $invoiceDate = date("d/M/Y, H:i:s", strtotime($invoiceDetails["order_date"]));
    echo '
      <tr>
        <td>'.$invoiceDetails["order_id"].'</td>
        <td>'.$invoiceDate.'</td>
        <td>'.$invoiceDetails["order_receiver_name"].'</td>

        <td><a href="print_orden.php?invoice_id='.$invoiceDetails["order_id"].'" title="Imprimir Orden"><div class="btn btn-primary"><span class="glyphicon glyphicon-print"></span></div></a></td>
        <td><a href="editar_orden.php?update_id='.$invoiceDetails["order_id"].'"  title="Editar Orden"><div class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span></div></a></td>

        <td><a href="#" id="'.$invoiceDetails["order_id"].'" class="deleteInvoice"  title="Borrar Orden"><div class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></div></a></td>
      </tr>
    ';
}
?></tbody>
</table>
</div>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script>$(document).ready( function () {
    $('#data-table').DataTable();
});
</script>

<?php include('footer.php');?>
