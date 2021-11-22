<?php
function formatear($num){
	setlocale(LC_MONETARY, 'en_US');
	return "$" . number_format($num, 2);
}
	include_once 'conexion_proveedor.php';

	$sentencia_select=$con->prepare('SELECT * FROM `pendientes` WHERE estado = "pendiente"');
	$sentencia_select->execute();
	$resultado=$sentencia_select->fetchAll();

	// metodo buscar
	if(isset($_POST['btn_buscar'])){
		$buscar_text=$_POST['buscar'];
		$select_buscar=$con->prepare('
			SELECT * FROM pendientes WHERE estado = "pendiente" AND cliente LIKE :campo OR cotizacion LIKE :campo;'
		);

		$select_buscar->execute(array(
			':campo' =>"%".$buscar_text."%"
		));

		$resultado=$select_buscar->fetchAll();

	}

	$count = 0;
	$totall = 0;    
?>

<!DOCTYPE html>
<html lang="es">
<head><meta charset="euc-jp">
	
	<title>Cotizaciones Pendientes</title>
	<!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
  <style>
	*{
			padding: 0;
			margin: 0px;
			box-sizing: border-box;
	}

	body{
			font-family: 'Arial',sans-serif;
			font-size: 16px;
			background: #f2f2f2;
	}

	a{
			text-decoration: none;
	}
	.contenedor{
			width: 100%;
			max-width: 1400px;
			margin: 30px auto;
			overflow: hidden;

	}

	h2{
			display: block;
			margin-top: 20px;
			margin-bottom: 20px;
			text-align: center;
			font-size: 20px;
			font-family: 'Arial', sans-serif;
			font-weight: bold;
			color: #555;
	}

	.barra__buscador{
			width: 100%;
			margin-top: 50px;
			margin-bottom: 10px;
	}

	.formulario{
			display: flex;
			width: 100%;
			overflow: hidden;
	}

	form .input__text{
			width: 100%;
			border: 1px solid #ccc;
			border-radius: 5px;
			box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
			color: #848688;
			display: block;
			font-size: 14px;
			margin-bottom: 15px;
			padding: 10px 15px;
			max-width: 30%;
			margin-right: 10px;
			outline: medium none;
	}


	form .input__text:focus{
			border: 1px solid #1b743c;
	}
	form .form-group{
			display: flex;
			width: 100%;
			flex-wrap: nowrap;
			justify-content: space-between;
	}

	form .form-group .input__text{
			max-width: 45% !important;
	}


	form .btn{
			border: 1px solid #ccc;
			border-radius: 5px;
			box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
			color: #fff;
			display: block;
			font-size: 14px;
			background: rgb(3, 113, 163);
			margin-bottom: 15px;
			padding: 10px 20px;
			margin-right: 10px;
			outline: medium none;
			cursor: pointer;
	}
	.btn__nuevo{
			float: right;
			background: #1b743c !important;
	}

	.btn__group{
			width: 100%;
			display: flex;
			flex-direction: row;
			justify-content: flex-end;
	}
	.btn__primary{
			background: rgb(3, 113, 163);
	}
	.btn__danger{
			background: #8a0505 !important;
	}


	/* table */
	table{
			width: 100%;
			border-collapse: collapse;
	}

	table .head{
			background: rgb(3, 113, 163);
	}
	table .head td{
			color: #fff;
			font-family: 'Arial',sans-serif;
			font-weight: bold;
			font-size: 15px;
			text-align: center;
	}

	table tr td{
			border:1px solid #ccc;
			padding: 7px;
			font-size: 14px;
			color: #555;
	}

	.btn__update{
			display: inline-block;
			font-size: 14px;
			background: #1b743c;
			color: #fff;
			border-radius: 5px;
			padding: 5px 10px;
	}

	.btn__delete{
			display: inline-block;
			font-size: 14px;
			background: #8a0505;
			color: #fff;
			border-radius: 5px;
			padding: 5px 10px;
	}

	</style>

   <link rel="stylesheet" href="css/diseño.css">
   <link href="https://fonts.googleapis.com/css2?family=Gentium+Basic&family=Julius+Sans+One&family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="fonts/icomoon/style.css">
 <link rel="stylesheet" href="css/bootstrap.min.css">
 <link rel="stylesheet" href="css/magnific-popup.css">
 <link rel="stylesheet" href="css/jquery-ui.css">
 <link rel="stylesheet" href="css/owl.carousel.min.css">
 <link rel="stylesheet" href="css/owl.theme.default.min.css">
<link rel="stylesheet" href="css/aos.css">
<link href="https://fonts.googleapis.com/css?family=roboto" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@200&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 </head>
<body>
  <?php
   include 'barraComerciales.php';
    ?>

	<div class="contenedor">
		<a href="catalogos.php"> <button type="button" class="btn btn-outline-warning">Volver al listado de catalogos</button></a>
		<a href="nuevamercancia.php"> <button type="button" class="btn btn-outline-success" >Nueva mercancia</button> </a>
		<a href="devoluciones.php">  <span class="glyphicon glyphicon-edit"> <button type="button" class="btn btn-danger">Devoluciones</button> </span></a>

		<h2>Cotizaciones Pendientes Pago</h2>
		<div class="barra__buscador">
			<form action="" class="formulario" method="post">
				<input type="text" name="buscar" placeholder="buscar ID  o Contratipo	"
				value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
				<input type="submit" class="btn" name="btn_buscar" value="Buscar">
			</form>
		</div>
		<?php $count++; ?>
		<table>
			<tr class="head">
				<td>#</td>
				<td>Cliente</td>
				<td>Cotizacion</td>
				<td>Estado</td>
				<td>Monto</td>
				<td>Fecha</td>
				<td>Finalizar</td>
			</tr>
			<?php foreach($resultado as $fila):?>
				<tr>
				    <form class="" action="change_status_cot_pq.php" method="post">
					<td><?php echo $count++ ?> </td>
					<td><?php echo $fila['cliente']; ?></td>
					<td><?php echo $fila['cotizacion']; ?></td>
					<td><?php echo $fila['estado']; ?></td>
					<td><?php echo $fila['monto']; ?></td>
					<td><?php echo $fila['order_date']; ?></td>
		               
		             <?php $costo = $fila['monto'];
		                                  $monto = 0;
                                          $monto = $costo;
                                          $totall += $monto;    
		               ?>       
					<td> <button type="submit" name="send" value="<?php echo $fila['cotizacion']; ?>" class="btn btn-success">Pago</button></td>
				 </form>
				</tr>


			<?php endforeach ?>
        <tfoot>
      <tr>
    
        <td colspan="6">Deuda total</td>
        <td><?= formatear($totall)?></td>
      </tr>
    </tfoot>
		</table>
	</div>
</body>
</html>
