<?php
function formatear($num){
	setlocale(LC_MONETARY, 'en_US');
	return "$" . number_format($num, 2);
}
	include_once 'conexion0.php';

	$sentencia_select=$con->prepare('SELECT * FROM `producto_av`');
	$sentencia_select->execute();
	$resultado=$sentencia_select->fetchAll();

	// metodo buscar
	if(isset($_POST['btn_buscar'])){
		$buscar_text=$_POST['buscar'];
		$select_buscar=$con->prepare('
			SELECT * FROM producto_av WHERE id LIKE :campo OR contratipo LIKE :campo;'
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
	
	<title>STOCK BODEGA PRINCIPAL (AV)</title>
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

	<div class="contenedor">
		<a href="banner.php"> <button type="button" class="btn btn-outline-warning">Volver al listado de catalogos</button></a>

		<h2>Stock Bodega Principal AV</h2>
		<div class="barra__buscador">
			<form action="" class="formulario" method="post">
				<input type="text" name="buscar" placeholder="buscar ID  o Contratipo	"
				value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
				<input type="submit" class="btn" name="btn_buscar" value="Buscar">
				<!-- <a href="insert.php" class="btn btn__nuevo">Agregar Producto</a> -->
			</form>
		</div>
		<?php $count++; ?>
		<table>
			<tr class="head">

				<td>SKU</td>
				<td>Producto</td>
				<td>Genero</td>
				<td>stock</td>

				<td>Peso </td>
				<td>Categoria</td>
				<td>Imagen</td>
				<td>Unitario</td>
				<td>Docena</td>
				<td>Centena</td>
				<td>Millar</td>
				<!-- <td colspan="2">Acciones</td> -->
			</tr>
			<?php foreach($resultado as $fila):?>
				<tr >

					<td><?php echo $fila['id']; ?></td>
					<td><?php echo $fila['contratipo']; ?></td>
					<td><?php echo $fila['genero']; ?></td>

					<td><?php
                     $stock = $fila['stock'];
                     if($stock < 500){
                       echo '<span style="color:#E00000;text-align:center;">';
                       echo $stock;
                       echo '</span>';
                     }else {
                       echo '<span style="color:#008108;text-align:center;">';
                       echo $stock;
                       echo '</span>';
                     }
           ?>
          </td>
					<td><?php echo $fila['peso']; ?></td>
					<td><?php echo $fila['id_categoria']; ?></td>
					<?php
             $categoria = $fila['id_categoria'];

						 					 ?>
					<td><img src="./images/<?php echo $fila['imagen'];?>" alt="<?php echo $fila['contratipo'];?>" class="img-fluid" width="100" height="100" style="margin-left: 70px" ></td>
           <?php
					 if ($categoria == 4 ) {
						 $precio= $fila['gramo'];
 						$gramo= $precio/1000;
 						$iva = $gramo * 0.19;
 						$coniva = $iva + $gramo;
 						$porcentaje = $coniva * 0.50;
						$porcentaje2 = $coniva * 0.30;
						$porcentaje3 = $coniva * 0.20;
						$porcentaje4 = $coniva * 0.15;
 						$total = $porcentaje + $coniva;
						$total2 = $porcentaje2 + $coniva;
						$total3 = $porcentaje3 + $coniva;
						$total4 = $porcentaje4 + $coniva;

 						$totalls = formatear($total);
 						$totalls2 = formatear($total2);
 						$totalls3 = formatear($total3);
 						$totalls4 = formatear($total4);
					 echo "<td> $totalls</td>";
					 echo "<td> $totalls2</td>";
					 echo "<td> $totalls3</td>";
					 echo "<td> $totalls4</td>";

				 }else if($categoria == 2){
					 $siniva = $fila['gramo'];
					 $puiva = $fila['gramo']*0.19;
					 $coniva = $siniva + $puiva;
					 $porcentaje= $coniva * 0.50;
					 $porcentaje2 = $coniva * 0.30;
					 $porcentaje3 = $coniva * 0.20;
					 $porcentaje4 = $coniva * 0.15;
					 $total = $porcentaje + $coniva;
					 $total2 = $porcentaje2 + $coniva;
					 $total3 = $porcentaje3 + $coniva;
					 $total4 = $porcentaje4 + $coniva;
					 $totalls = formatear($total);
					 $totalls2 = formatear($total2);
					 $totalls3 = formatear($total3);
					 $totalls4 = formatear($total4);
					 echo "<td> $totalls</td>";
					 echo "<td> $totalls2</td>";
					 echo "<td> $totalls3</td>";
					 echo "<td> $totalls4</td>";
				 }else if($categoria == 3){
					 $siniva = $fila['gramo'];
					 $puiva = $fila['gramo']*0.19;
					 $coniva = $siniva + $puiva;
					 $porcentaje= $coniva * 0.50;
					 $porcentaje2 = $coniva * 0.30;
					 $porcentaje3 = $coniva * 0.20;
					 $porcentaje4 = $coniva * 0.15;
					 $total = $porcentaje + $coniva;
					 $total2 = $porcentaje2 + $coniva;
					 $total3 = $porcentaje3 + $coniva;
					 $total4 = $porcentaje4 + $coniva;
					 $totalls = formatear($total);
					 $totalls2 = formatear($total2);
					 $totalls3 = formatear($total3);
					 $totalls4 = formatear($total4);
					 echo "<td> $totalls</td>";
					 echo "<td> $totalls2</td>";
					 echo "<td> $totalls3</td>";
					 echo "<td> $totalls4</td>";
				 }else if($categoria == 1){
					 $siniva = $fila['gramo'];
					 $puiva = $fila['gramo']*0.19;
					 $coniva = $siniva + $puiva;
					 $porcentaje= $coniva * 0.50;
					 $porcentaje2 = $coniva * 0.30;
					 $porcentaje3 = $coniva * 0.20;
					 $porcentaje4 = $coniva * 0.15;
					 $total = $porcentaje + $coniva;
					 $total2 = $porcentaje2 + $coniva;
					 $total3 = $porcentaje3 + $coniva;
					 $total4 = $porcentaje4 + $coniva;
					 $totalls = formatear($total);
					 $totalls2 = formatear($total2);
					 $totalls3 = formatear($total3);
					 $totalls4 = formatear($total4);
					 echo "<td> $totalls</td>";
					 echo "<td> $totalls2</td>";
					 echo "<td> $totalls3</td>";
					 echo "<td> $totalls4</td>";
				 }else if($categoria == 5){
					 $siniva = $fila['gramo'];
					 $puiva = $fila['gramo']*0.19;
					 $coniva = $siniva + $puiva;
					 $porcentaje= $coniva * 0.50;
					 $porcentaje2 = $coniva * 0.30;
					 $porcentaje3 = $coniva * 0.20;
					 $porcentaje4 = $coniva * 0.15;
					 $total = $porcentaje + $coniva;
					 $total2 = $porcentaje2 + $coniva;
					 $total3 = $porcentaje3 + $coniva;
					 $total4 = $porcentaje4 + $coniva;
					 $totalls = formatear($total);
					 $totalls2 = formatear($total2);
					 $totalls3 = formatear($total3);
					 $totalls4 = formatear($total4);
					 echo "<td> $totalls</td>";
					 echo "<td> $totalls2</td>";
					 echo "<td> $totalls3</td>";
					 echo "<td> $totalls4</td>";
				 }else if($categoria == 6){
					 $siniva = $fila['gramo'];
					 $puiva = $fila['gramo']*0.19;
					 $coniva = $siniva + $puiva;
					 $porcentaje= $coniva * 0.50;
					 $porcentaje2 = $coniva * 0.30;
					 $porcentaje3 = $coniva * 0.20;
					 $porcentaje4 = $coniva * 0.15;
					 $total = $porcentaje + $coniva;
					 $total2 = $porcentaje2 + $coniva;
					 $total3 = $porcentaje3 + $coniva;
					 $total4 = $porcentaje4 + $coniva;
					 $totalls = formatear($total);
					 $totalls2 = formatear($total2);
					 $totalls3 = formatear($total3);
					 $totalls4 = formatear($total4);
					 echo "<td> $totalls</td>";
					 echo "<td> $totalls2</td>";
					 echo "<td> $totalls3</td>";
					 echo "<td> $totalls4</td>";
				 }else if($categoria == 9){
					 $siniva = $fila['gramo'];
					 $puiva = $fila['gramo']*0.19;
					 $coniva = $siniva + $puiva;
					 $porcentaje= $coniva * 0.50;
					 $porcentaje2 = $coniva * 0.30;
					 $porcentaje3 = $coniva * 0.20;
					 $porcentaje4 = $coniva * 0.15;
					 $total = $porcentaje + $coniva;
					 $total2 = $porcentaje2 + $coniva;
					 $total3 = $porcentaje3 + $coniva;
					 $total4 = $porcentaje4 + $coniva;
					 $totalls = formatear($total);
					 $totalls2 = formatear($total2);
					 $totalls3 = formatear($total3);
					 $totalls4 = formatear($total4);
					 echo "<td> $totalls</td>";
					 echo "<td> $totalls2</td>";
					 echo "<td> $totalls3</td>";
					 echo "<td> $totalls4</td>";
				 }else if($categoria == 100){
					 $siniva = $fila['gramo'];

					 echo "<td> $siniva</td>";
					 echo "<td> $siniva</td>";
					 echo "<td> $siniva</td>";
					 echo "<td> $siniva</td>";
				 }else if($categoria == 72){
					 $siniva = $fila['gramo'];
					 $puiva = $fila['gramo']*0.19;
					 $coniva = $siniva + $puiva;
					 $porcentaje= $coniva * 0.15;
					 $total = $porcentaje + $coniva;
					 $totalls = formatear($total);

					echo "<td> $totalls</td>";
					echo "<td> $totalls</td>";
					echo "<td> $totalls</td>";
					echo "<td> $totalls</td>";
				}else if($categoria == 71){
					$siniva = $fila['gramo'];
					$puiva = $fila['gramo']*0.19;
					$coniva = $siniva + $puiva;
					$porcentaje= $coniva * 0.20;
					$total = $porcentaje + $coniva;
					$totalls = formatear($total);

				 echo "<td> $totalls</td>";
				 echo "<td> $totalls</td>";
				 echo "<td> $totalls</td>";
				 echo "<td> $totalls</td>";
			 }else if($categoria == 40){
				 $onza = 13000;
				 $media_libra = 35000;
				 $libra = 70000;
				 $kilo = "Valor Kilo";

				 echo "<td> $onza</td>";
				 echo "<td> $media_libra</td>";
				 echo "<td> $libra</td>";
				 echo "<td> $kilo</td>";
			 }else if($categoria == 20){
				 $siniva = $fila['gramo'];
				 $puiva = $fila['gramo']*0.19;
				 $coniva = $siniva + $puiva;

				 $porcentaje2 = $coniva * 0.30;
				 $porcentaje3 = $coniva * 0.20;
				 $porcentaje4 = $coniva * 0.15;

				 $total2 = $porcentaje2 + $coniva;
				 $total3 = $porcentaje3 + $coniva;
				 $total4 = $porcentaje4 + $coniva;

				 $totalls2 = formatear($total2);
				 $totalls3 = formatear($total3);
				 $totalls4 = formatear($total4);
				 echo "<td> $totalls2</td>";
				 echo "<td> $totalls3</td>";
				 echo "<td> $totalls4</td>";
				 echo "<td> $totalls4</td>";
			 }else if($categoria == 25){

				 $total2 = 5000;
				 $total3 = 19000;
				 $total4 = 35000;

				 $totalls2 = formatear($total2);
				 $totalls3 = formatear($total3);
				 $totalls4 = formatear($total4);
				 echo "<td> $totalls2</td>";
				 echo "<td> $totalls3</td>";
				 echo "<td> $totalls4</td>";
				 echo "<td> $totalls4</td>";
			 }else{
				 echo "<td> 'definir categoria'</td>";
				 echo "<td> 'definir categoria'</td>";
				 echo "<td> 'definir categoria'</td>";
				 echo "<td> 'definir categoria'</td>";
			 }
        ?>
				</tr>
			<?php endforeach ?>
		</table>
	</div>
</body>
</html>
