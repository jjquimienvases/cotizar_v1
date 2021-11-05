<?php
function formatear($num){
  setlocale(LC_MONETARY, 'en_US');
  return "$" . number_format($num, 2);
}
	include_once 'conexion0.php';

  $sentencia_select=$con->prepare('SELECT * FROM `factura_orden` WHERE metodopago = "mostrador_ibague_2" AND estado != "anulado"');
	$sentencia_select->execute();
	$resultado=$sentencia_select->fetchAll();

	// metodo buscar
	if(isset($_POST['btn_buscar'])){
		$buscar_text=$_POST['buscar'];
		$select_buscar=$con->prepare('
			SELECT * FROM factura_orden WHERE order_id LIKE :campo OR order_receiver_name LIKE :campo OR order_receiver_address LIKE :campo OR order_date LIKE :campo AND metodopago = "mostrador_ibague_2" AND estado != "anulado";'
		);

		$select_buscar->execute(array(
			':campo' =>"%".$buscar_text."%"
		));

		$resultado=$select_buscar->fetchAll();

	}
	$count = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head><meta charset="euc-jp">

	<title>Reporte de ventas ibague 2</title>
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
			width: 90%;
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
	<div class="contenedor">

		<h2>Cotizaciones mostrador ibague 2</h2>
    <div class="barra__buscador">
      <form action="" class="formulario" method="post">
        <input type="text" name="buscar" placeholder="buscar cotizacion o cliente	"
        value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
        <input type="submit" class="btn" name="btn_buscar" value="Buscar">
      </form>
    </div>

    	<?php $count++; ?>
		<table>
			<tr class="head">
        <td>#</td>
				<td>Cotizacion</td>
				<td>Cliente</td>
				<td>Comercial</td>
        <td>Fecha</td>
        <td>Monto</td>

			</tr>
			<?php
          $totall = 0;
        ?>
			<?php foreach($resultado as $fila):?>
				<tr >
          <td><?php echo $count++ ?> </td>
					<td><?php echo $fila['order_id']; ?></td>
					<td><?php echo $fila['order_receiver_name']; ?></td>
					<td><?php echo $fila['order_receiver_address']; ?></td>

					<td><?php echo $fila['order_date']; ?></td>
          <?php
            $monto = 0;
            $valor = $fila['order_total_after_tax'];
            $monto = $valor;
           ?>
          <td id="valores">

           <?php
            // $valorSinIva = $valor * 1;
            // $totalSinIva = $valorSinIva;
            // $subTotal = $totalSinIva/1000;
            // $total = $subTotal * $stock;

            echo formatear($monto);?></td>
            <?php $totall += $monto; ?>


				</tr>





			<?php endforeach ?>
			  <tfoot>
        <tr>
          <td colspan="5">MONTO TOTAL:</td>
          <td><?= formatear($totall)?></td>
        </tr>
      </tfoot>

		</table>
    <table id="total" border="0">

    </table>
    <span></span>
	</div>


</body>
</html>