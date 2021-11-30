<?php
function formatear($num){
  setlocale(LC_MONETARY, 'en_US');
  return "$" . number_format($num, 2);
}
	include_once 'conexion0.php';

	$sentencia_select=$con->prepare('SELECT * FROM `producto_av` WHERE sub_categoria = 18');
	$sentencia_select->execute();
	$resultado=$sentencia_select->fetchAll();

	// metodo buscar
	if(isset($_POST['btn_buscar'])){
		$buscar_text=$_POST['buscar'];
		$select_buscar=$con->prepare('
			SELECT * FROM producto WHERE id LIKE :campo OR contratipo LIKE :campo;'
		);

		$select_buscar->execute(array(
			':campo' =>"%".$buscar_text."%"
		));

		$resultado=$select_buscar->fetchAll();

	}

?>

<!DOCTYPE html>
<html lang="es">
<head><meta charset="euc-jp">
	
	<title>Catalogo Perfumeria</title>
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
			color:#000;
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

			font-weight: bold;
			color: #555;
      font-family: 'Sansita Swashed', cursive;
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
			color: #000;
      font-family: 'Montserrat', sans-serif;
	}
  td {
  text-align: center;
  vertical-align: middle;
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
img{
  width: 100px;
  height: 100px;
  margin-bottom: 10px;
}
	</style>
   <!--<link rel="stylesheet" href="css/diseño.css">-->
   <link href="https://fonts.googleapis.com/css2?family=Gentium+Basic&family=Julius+Sans+One&family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
<!-- <link rel="stylesheet" href="fonts/icomoon/style.css">-->
<!-- <link rel="stylesheet" href="css/bootstrap.min.css">-->
<!-- <link rel="stylesheet" href="css/magnific-popup.css">-->
<!-- <link rel="stylesheet" href="css/jquery-ui.css">-->
<!-- <link rel="stylesheet" href="css/owl.carousel.min.css">-->
<!-- <link rel="stylesheet" href="css/owl.theme.default.min.css">-->
<!--<link rel="stylesheet" href="css/aos.css">-->
<!--<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&family=Sansita+Swashed&display=swap" rel="stylesheet"><link href="https://fonts.googleapis.com/css?family=roboto" rel="stylesheet">-->
<!-- <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@200&display=swap" rel="stylesheet">-->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 </head>
<body>
	<div class="contenedor">
  <center>
		<h2>Catalogo Perfumeria</h2>
  <img src="./images/jj.png" alt="Logo"> </hr>
</center>
		<table style="aling-content: center;">
			<tr class="head">
				<td>Codigo</td>
				<td>Producto</td>
				<td>Genero</td>
                <td>Gramo</td>
                <td>Libra</td>
                <td>Kilo</td>
                <td>10 Kilo</td>
                <td>25 Kilo</td>
			</tr>
			<?php foreach($resultado as $fila):?>
				<tr >
					<td><?php echo $fila['id']; ?></td>
					<td><?php echo $fila['contratipo']; ?></td>
					<td><?php echo $fila['genero']; ?></td>
         <td>
               <?php
                  $precio= $fila['gramo'];
               if($precio < 125000){
        $precio = 123500;
      }else{
          $precio= $fila['gramo'];
      }
                  $gramo= $precio/1000;
                  $iva = $gramo * 0.19;
                  $coniva = $iva + $gramo;
                  $porcentaje = $coniva * 0.50;
                  $total = $porcentaje + $coniva;
                  echo formatear($total);
                ?>
          </td> 
          <td>
          <?php
          $precio= $fila['gramo'];
          $gramo= $precio/1000;
          $iva = $gramo * 0.19;
          $coniva = $iva + $gramo;
          $porcentaje = $coniva * 0.50;
          $total = $porcentaje + $coniva;
          echo formatear($total * 500);
           ?>
          </td>
          <td>
          <?php
          $precio= $fila['gramo'];
          $gramo= $precio/1000;
          $iva = $gramo * 0.19;
          $coniva = $iva + $gramo;
          $porcentaje = $coniva * 0.30;
          $total = $porcentaje + $coniva;
          echo formatear($total*1000);
           ?>
          </td>
          <td>
          <?php
          $precio= $fila['gramo'];
          $gramo= $precio/1000;
          $iva = $gramo * 0.19;
          $coniva = $iva + $gramo;
          $porcentaje = $coniva * 0.30;
          $total = $porcentaje + $coniva;
          echo formatear($total*10000);
           ?>
          </td>
          <td>
          <?php
          $precio= $fila['gramo'];
          $gramo= $precio/1000;
          $iva = $gramo * 0.19;
          $coniva = $iva + $gramo;
          $porcentaje = $coniva * 0.20;
          $total = $porcentaje + $coniva;
          echo formatear($total*25000);
           ?>
          </td> 
				</tr>



			<?php endforeach ?>

		</table>
	</div>
</body>
</html>
