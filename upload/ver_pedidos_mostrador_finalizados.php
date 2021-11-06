<script type="text/javascript">
	function stopDefAction(evt) {
		evt.preventDefault();
	}
</script>


<?php

include "../globals.php";

function formatear($num)
{
	setlocale(LC_MONETARY, 'en_US');
	return "$" . number_format($num, 2);
}






$sql_ = ("SELECT * FROM call_punto_de_venta ORDER BY order_date DESC");
$resultado = $cnx->query($sql_);
$bodega = $_POST['bodega'];
if ($_POST['bodega'] != "") {
	$sql_sb = "SELECT * FROM call_punto_de_venta WHERE bodega = '$bodega' ORDER BY order_date DESC";
	$resultado = $cnx->query($sql_sb);
}
if ($_POST['fecha'] != "") {

	$date = $_POST['fecha'];
	$sql_dt = "SELECT * FROM call_punto_de_venta WHERE DATE(order_date) LIKE '%$date%' ORDER BY order_date DESC";
	$resultado = $cnx->query($sql_dt);
}
$estado = $_POST['status'];
if ($_POST['status'] != "") {
	$sql_et = "SELECT * FROM call_punto_de_venta WHERE estado LIKE '%$estado%' ORDER BY order_date DESC";
	$resultado = $cnx->query($sql_et);
}
$buscar_text = $_POST['buscar'];
if ($buscar_text != "") {
	$sql_sr = "SELECT * FROM call_punto_de_venta WHERE order_id LIKE '%$buscar_text%' OR cliente LIKE LIKE '%$buscar_text%' ORDER BY order_date DESC";
	$resultado = $cnx->query($sql_sr);
}



?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>Call Center Mostrador</title>
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="../jquery-3.5.1.min.js"></script>
	<!--<script src="../jquery-3.5.1.min.js"></script>-->
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
	<!-- SUM()  Datatables-->
	<script src="https://cdn.datatables.net/plug-ins/1.10.20/api/sum().js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

	<link href="https://fonts.googleapis.com/css2?family=Gentium+Basic&family=Julius+Sans+One&family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@200&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


	<style>
		/*contenedor{*/
		/*    width:90%;*/
		/*    height:90%;*/
		/*}*/
		* {
			font-size: 12px;
		}

		a {
			color: white;
			text-decoration: none;
		}
	</style>
</head>

<body>

	<div class="container">
		<hr>
		<div class="text-left">
			<button class="btn btn-success"> <a href="../Panel_Comerciales.php"></a> Regresar al menu</button>
		</div>
		<br>
		<h3>Cotizaciones Finalizadas ventas Call Center/Mostrador</h3>
		<hr>
		<div class="row">



		</div>
		<form action="" method="post">
			<div class="row g-3 align-items-center">
				<div class="col-auto">
					<label for="bodega" class="col-form-label">Seleccionar una bodega</label>
				</div>

				<div class="col-auto">
					<select class="form-control" name="bodega" id="bodega">
						<option value="" selected>Seleccionar</option>
						<option value="mostrador principal">Mostrador Principal</option>
						<option value="ibague">Mostrador Ibague</option>
						<option value="ibague2">Mostrador Ibague 2</option>
						<option value="mostrador D1">Mostrador D1</option>
					</select>
				</div>

				<div class="col-auto">
					<div>
						<input class="form-control" type="date" name="fecha" value="" id="fecha">

					</div>

				</div>
				<div class="col-auto">
					<select class="form-control" name="status" id="estado">
						<option value="" selected>Seleccionar</option>
						<option value="pendiente">Pendiente</option>
						<option value="finalizado">Finalizado</option>

					</select>

				</div>

				<div class="col-auto barra__buscador">

					<input type="text" name="buscar" placeholder="Buscar remision o cliente" value="<?php if (isset($buscar_text)) echo $buscar_text; ?>" class="form-control">
				</div>
				<div class="col-auto">
					<input type="submit" class="btn btn-info mt-3" name="btn_buscar" value="Buscar">
				</div>
		</form>

		<br>
		<table class="table table-bordered" id="informacion">
			<tr class="head-info">
				<td>Fecha</td>
				<td>Cotizacion</td>
				<td>Cliente</td>
				<td>Comercial</td>
				<td>Monto</td>
				<td>Estado</td>
				<td>Notas</td>
				<td>PDF</td>
			</tr>
			<?php foreach ($resultado as $fila) : ?>

				<tr>
					<td><?php echo $fila['order_date']; ?></td>
					<td> <input type="text" name="id" value="<?php echo $fila['order_id']; ?>" class="form-control"> </td>
					<td><input type="text" name="cliente" value="<?php echo $fila['cliente']; ?>" class="form-control"> </td>
					<td><input type="text" name="comercial" value="<?php echo $fila['comercial']; ?>" class="form-control"> </td>
					<td><input type="text" name="monto" value="<?php echo formatear($fila['monto']); ?>" class="form-control"> </td>
					<td><input type="text" name="estado" value="<?php echo $fila['estado']; ?>" class="form-control"> </td>
					<td><input type="text" name="nota" value="<?php echo $fila['notas']; ?>" class="form-control"> </td>

					<?php if (isset($fila['order_id'])) {
						echo '<td> <a href="../imprimir.php?invoice_id=' . $fila["order_id"] . '" title="Imprimir Factura"><div class="btn btn-danger"><span class="glyphicon glyphicon-print">PDF</span></div></a></td>';
					} ?>

				</tr>

			<?php endforeach ?>

		</table>
	</div>
</body>
<script>
	$(document).ready(function() {
		$('.table').DataTable();
	});
</script>

</html>