<?php

function formatear($num){
	setlocale(LC_MONETARY, 'en_US');
	return "$" . number_format($num, 2);
}
	include_once 'conexion0.php';

	$sentencia_select=$con->prepare('SELECT *FROM producto WHERE id_categoria != 4 ORDER BY id_categoria ASC ');
	$sentencia_select->execute();
	$resultado=$sentencia_select->fetchAll();

	// metodo buscar
	if(isset($_POST['btn_buscar'])){
		$buscar_text=$_POST['buscar'];
		$select_buscar=$con->prepare('
			SELECT *FROM producto WHERE id LIKE :campo OR contratipo LIKE :campo;'
		);

		$select_buscar->execute(array(
			':campo' =>"%".$buscar_text."%"
		));

		$resultado=$select_buscar->fetchAll();

	}

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Inicio</title>
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
			width: 80%;
			max-width: 1000px;
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
</head>
<body>
	<div class="contenedor">
		 <!-- <a href="../../factuenvases/home.php"> <button  name="button" type="s
			"> VOLVER AL PANEL</button></a> -->
		<h2>Productos PRECIOS PUNTO QUIMICO</h2>
		<div class="barra__buscador">
			<form action="" class="formulario" method="post">
				<input type="text" name="buscar" placeholder="buscar ID  o Contratipo	"
				value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
				<input type="submit" class="btn" name="btn_buscar" value="Buscar">
				<!-- <a href="insert.php" class="btn btn__nuevo">Agragar Producto</a> -->
			</form>
		</div>
		<table>
			<tr class="head">
				<td>Id</td>
				<td>Producto</td>
				<td>Genero</td>
				<td>Gramo</td>
				<td>Categoria</td>
			</tr>
			<?php foreach($resultado as $fila):?>
				<tr >
					<td><?php echo $fila['id']; ?></td>
					<td><?php echo $fila['contratipo']; ?></td>

					<td><?php echo $fila['genero']; ?></td>
					<td><?php
           $precio =   $fila['gramo'];
           $iva = $precio * 0.19;
           $coniva = $precio + $iva;
           $porcentaje = $coniva * 0.07;
           $total = $porcentaje + $coniva;
          echo  formatear($total);?></td>
					<td><?php echo $fila['id_categoria']; ?></td>

				</tr>
			<?php endforeach ?>

		</table>
	</div>
</body>
</html>
