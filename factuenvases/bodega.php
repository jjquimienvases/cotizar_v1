<?php
session_start([
    'cookie_lifetime' => 86400,
    'gc_maxlifetime' => 86400,
]);
function formatear($num){
	setlocale(LC_MONETARY, 'en_US');
	return "$" . number_format($num, 2);
}
include ('conections.php');
include 'Invoice.php';

$invoice = new Invoice();
$invoice->checkLoggedIn();// verifica que este logeado
if(!empty($_POST['companyName']) && $_POST['companyName']) {
	$invoice->saveInvoice($_POST);
	header("Location:invoice_list.php");

}

?>

<pre><?php print_r($_POST); ?></pre>

<?php
$resultado = "";
if (isset($_POST['buscar_cotizacion'])) {
	$conexion = conectar();
	$id = $_POST['producto'];
	$sql = "SELECT * FROM factura_orden WHERE order_id='$id'  OR order_receiver_name LIKE '%$id%'  LIMIT 10";
	$r = $conexion->query($sql);
	if ($o = $r->fetch_object()) {
		$resultado = $o;
	}

}
?>

<!doctype html>
<html lang="en">
<head><meta charset="gb18030">
	
	<link rel="stylesheet" href="css/styles.css" >
	<link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@200&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<title>Modificar estado</title>
	<style>
	.tablamedidas{
		width: 80%;

	}
	ul {
		list-style-type: none;
		margin: 0;
		padding: 0;
		overflow: hidden;
		background-color: #F29701;
	}

	li {
		float: left;
	}

	li a {
		display: block;
		color: white;
		text-align: center;
		padding: 16px;
		text-decoration: none;
	}

	li a:hover {
		background-color: #FCC76F; }

		.opencr:hover{
			cursor:pointer;
		}
		.btn-success{
			background: red;
			border: solid 1px white;
			color: white;
			width: 120px;
			height: 40px;
		}
		.btn-success:hover{
			cursor :pointer;
			background: blue;
			width:130px;
			height: 50px;
			border-radius: 20px;
		}
		body{
			margin:0;
			padding:0;
			font-family: sans-serif;
		}

		*{
			box-sizing: border-box;
		}

		.table{
			width: 80%;
			border-collapse: collapse;
		}

		.table td,.table th{
			padding:12px 15px;
			border:1px solid #ddd;
			text-align: center;
			font-size:16px;
		}

		.table th{
			background-color: #F29701;
			color:#ffffff;
		}

		.table tbody tr:nth-child(even){
			background-color: #f5f5f5;
		}
		.form-group{
			float: left;
		}
		/*responsive*/

		@media(max-width: 768px){
			.table thead{
				display: none;
				margin-right: 100px;
			}

			.table, .table tbody, .table tr, .table td{
				display: block;
				width: 100%;
			}
			.table tr{
				margin-bottom:15px;
			}
			.table td{
				text-align: right;
				padding-left: 50%;
				text-align: right;
				position: relative;
			}
			.table td::before{
				content: attr(data-label);
				position: absolute;
				left:0;
				width: 50%;
				margin-right: 50px;
				padding-left:15px;
				font-size:15px;
				font-weight: bold;
				text-align: left;
			}
		}

		</style>
	</head>
	<body>
		<header>
			<div class="containerhead">
				<ul>
					<li><a href="../create_invoice.php">Ir a cotizar</a></li>
					<li><a href="../invoice_list.php">Revisar cotizaciones</a></li>
					<li><a href="../factuenvases/search/index.php">Buscar Productos</a></li>
					<li><a href="../factuenvases/home.php">Home</a></li>
				</ul>
			</div>
		</header>
		<br>
		<div class="wrapper">
			<div class="title">
				Buscar por cotizacion o nombre de cliente
			</div>
			<hr>
			<div class="contenedor">
				<form class="" action="" method="post">
					<center><div class="input-contenedor">
						<input type="text"  placeholder="Cliente o factura" name="producto" size="50" id="producto" required>
						<input type="hidden" name="buscar_cotizacion" size="200">
					</div></center>
				</form>
			</div>

			<br>
			<form action="enviarestado.php" method="POST" enctype="multipart/form-data">
				<div class="form">
					<div class="inputfield">
						<label>Fecha</label>
						<input name="fecha" value="<?=isset($resultado->order_date)?$resultado->order_date:''?>">
					</div>
					<div class="inputfield">
						<label>Cotizacion</label>
						<input name="cotizacion" value="<?=isset($resultado->order_id)?$resultado->order_id:''?>">
					</div>
					<div class="inputfield">
						<label>Cliente</label>
						<input name="cliente" value="<?=isset($resultado->order_receiver_name)?$resultado->order_receiver_name:''?>">
					</div>
					<div class="inputfield">
						<label>Comercial</label>
						<input name="vendedor" value="<?=isset($resultado->order_receiver_address)?$resultado-> order_receiver_address:''?>">
					</div>
					<div class="inputfield">
						<label>Estado</label>
						<div class="custom_select">
							<select name="estadoactual">
								<option value="Cotizacion">Cotizacion</option>
								<option value="Alistamiento">Alistamiento</option>
								<option value="Finalizado">Finalizado</option>
							</select>
						</div>
					</div>

					<div class="inputfield">
						<label>Metodo de pago</label>

						<div class="custom_select">
							<select name="metodop">
								<option value="Bancolombia">Bancolombia</option>
								<option value="Davivienda">Davivienda</option>
								<option value="Nequi">Nequi</option>
								<option value="Daviplata">Davivienda</option>
								<option value="Mostrador">Mostrador</option>
							</select>
						</div>
					</div>


					<div class="inputfield" >
						<label>Total</label>
						<input name="total" value="   <?=isset($resultado->order_total_after_tax)?$resultado->order_total_after_tax:''?>" >
					</div>
					<div class="inputfield">
						<label>Comercial</label>
						<input name="vendedor" value="<?=isset($resultado->order_receiver_address)?$resultado->order_receiver_address:''?>">
					</div>

					<div class="inputfield">
						<label>Codigo de pago</label>
						<input type="text" class="input"  name="code">
					</div>
					<div class="inputfield">
						<label># De Factura</label>
						<input type="text" class="input"  name="factura" value="<?=isset($resultado->codigo)?$resultado->codigo:''?>">
					</div>
					<div class="inputfield">
						<label for="">Adjuntar Comprobante:</label>
						<input type="file" name="img">
					</div>

					<div class="inputfield">
						<input type="submit" value="Actualizar Estado" class="btn">
					</div>

				</div>
			</form>
		</div>
		<br>
		<div class="container">
			<center><h4 class="title">Lista de cotizaciones</h4></center>
			<table id="data-tables" class="table table-condensed table-striped">
				<thead>
					<tr>
						<th width="7%">Fac. No.</th>
						<th width="15%">Fecha Creación</th>
						<th width="35%">Cliente</th>
						<th width="15%">Fatura Total</th>
						<th width="6%">Ver PDF</th>

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
					<td>'.formatear($invoiceDetails['order_total_before_tax']).'</td>
					<td><a href="../print_invoice.php?invoice_id='.$invoiceDetails["order_id"].'" title="Ver PDF"><div class="btn btn-primary"><span class="glyphicon glyphicon-print"></span></div></a></td>
					</tr>
					';
				}
				?></tbody>
			</table>


		</div>
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
		<script>$(document).ready( function () {
			$('#data-tables').DataTable();
		});

		//eeste es el formulario edens


	</script>



</body>
</html>
