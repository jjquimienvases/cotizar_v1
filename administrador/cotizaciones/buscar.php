<?php
$conn = new mysqli('127.0.0.1', 'cotizar', 'LeinerM4ster', 'cotizar');


function formatear($num)
{
	setlocale(LC_MONETARY, 'en_US');
	return "$" . number_format($num, 2);
}

$salida = "";
$querys = "SELECT * FROM factura_orden ORDER By order_date DESC LIMIT 25";

$boton_receiver_info = $_POST['info_buscador'];

if ($boton_receiver_info != "" or $boton_receiver_info != 0) {

	echo "<pre>";
	print_r($boton_receiver_info);
	echo "</pre>";
} else {
	echo "<pre>";
	print_r("Busca una nueva cotizacion");
	echo "</pre>";
}

if (isset($boton_receiver_info)) {
	$q = $conn->real_escape_string($_POST['caja_busqueda']);
	$query = "SELECT * FROM factura_orden WHERE order_id LIKE '%$q%' OR order_date LIKE '%$q%' OR order_receiver_name LIKE '%$q%'";
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8">
	<title>Resultado</title>
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">

	<style>
		th,
		td {
			padding: 0.4rem !important;
		}

		body>div {
			box-shadow: 10px 10px 8px #888888;
			border: 2px solid black;
			border-radius: 10px;
			margin-top: 20px;
			height: auto;
		}

		a {
			decoration: none;
			color: white;
		}

		.container {
			height: auto;
		}

		tbody {
			height: 100%;

		}

		.contenedor_post {
			margin-left: 200px;
		}
	</style>
</head>

<body>
	<hr>
	<hr>
	<center>
		<span class="btn btn-primary"><a href="../index.php">Panel Administrador</a></span>
		<span class="btn btn-danger"><a href="../action.php?action=logout">Cerrar Session</a></span>
	</center>
	<hr>
	<form class="" action="" method="post">

		<?php

		$label = "<label for='caja_busqueda' id='caja_busqueda' name='caja_busqueda'>";
		$input = "<input type='text' name='caja_busqueda' id='caja_busqueda'>";
		$botoncini = "<button class='btn btn-success' id='info_buscador' value='1' type='submit' name='info_buscador'>Buscar</button>";
		if ($_POST['info_buscador']) {
			echo $label;
			echo $input;
			echo $botoncini;
		} else {
		}

		?>


		<!--   <label for="caja_busqueda">Buscar Cotizacion Por Nombre o Numero de cotizacion:</label>-->
		<!--<input type="text" name="caja_busqueda" id="caja_busqueda"></input>-->
		<!--<button class="btn btn-success" id="info_buscador" name="info_buscador" value="1" type="submit">Buscar</button>-->
	</form>

	<?php
	//     if($_POST['info_buscador']){
	// 			    $url = "<center><button class='btn btn-success'><a href='index.php'>Buscar otra cotizacion</a></button> </center>";
	//                 echo $url;
	// 		}
	?>
	<hr>
	<div id="contenedor_post" class="contenedor_post">

		<?php

		$resultado = $conn->query($query);
		$resultado_2 = $conn->query($querys);

		if ($resultado->num_rows > 0) {
			$salida .= "<table border=1 class='tabla_datos'>
    			<thead>
    				<tr id='titulo'>
    			     	<td>Fecha</td>
    					<td>Remision</td>
    					<td>Comercial</td>
    					<td>Cliente</td>
    					<td>Cedula</td>
    					<td>Monto</td>
    					<td>imprimir</td>
    				
    				</tr>

    			</thead>
    			

    	<tbody>";

			while ($fila = $resultado->fetch_assoc()) {
				$cotizacion = $fila['order_id'];
				$monto = $fila['order_total_after_tax'];

				$link = "<button class='btn btn-warning'> <a href='../../print_invoice.php?invoice_id=" . $cotizacion . "' target='_blank'>PDF</a></button>";
				$url = "<button class='btn btn-primary'> <a href='../../edit_invoice.php?update_id=" . $cotizacion . "' target='_blank'>Editar</a></button>";

				$salida .= "<tr>
    					<td>" . $fila['order_date'] . "</td>
    					<td>" . $fila['order_id'] . "</td>
    					<td>" . $fila['order_receiver_address'] . "</td>
    					<td>" . $fila['order_receiver_name'] . "</td>
    					<td>" . $fila['cedula'] . "</td>
    					<td>" . formatear($monto) . "</td>
    					<td>" . $link . "<td>
    					
    			
    				</tr>";
			}
			$salida .= "</tbody></table>";
		} else {
			$salida .= "<table border=1 class='tabla_datos'>
    			<thead>
    				<tr id='titulo'>
    					<td>Fecha</td>
    					<td>Remision</td>
    					<td>Comercial</td>
    					<td>Cliente</td>
    					<td>Cedula</td>
    					<td>Monto</td>

    					<td>imprimir</td>
    				
    				</tr>

    			</thead>
    			

    	<tbody>";

			while ($filas = $resultado_2->fetch_assoc()) {
				$cotizacion = $filas['order_id'];
				$monto = $filas['order_total_after_tax'];

				$link = "<button class='btn btn-warning'> <a href='../../print_invoice.php?invoice_id=" . $cotizacion . "' target='_blank'>PDF</a></button>";
				$url = "<button class='btn btn-primary'> <a href='../../edit_invoice.php?update_id=" . $cotizacion . "' target='_blank'>Editar</a></button>";

				$salida .= "<tr>
    					<td>" . $filas['order_date'] . "</td>
    					<td>" . $filas['order_id'] . "</td>
    					<td>" . $filas['order_receiver_address'] . "</td>
    					<td>" . $filas['order_receiver_name'] . "</td>
    					<td>" . $filas['cedula'] . "</td>
    					<td>" . formatear($monto) . "</td>
    					<td>" . $link . "<td>
    				</tr>";
			}
			$salida .= "</tbody></table>";
		}


		echo $salida;

		$conn->close();



		?>

	</div>


</body>

</html>