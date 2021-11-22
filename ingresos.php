<script type="text/javascript">

function stopDefAction(evt) {
  evt.preventDefault();
}
</script>


<?php
function formatear($num){
	setlocale(LC_MONETARY, 'en_US');
	return "$" . number_format($num, 2);
}
	include_once 'conexion_proveedor.php';
  

  $sentencia_select =$con->prepare('SELECT * FROM ingresos');
	$sentencia_select->execute();
	$resultado=$sentencia_select->fetchAll();


	// metodo buscar
	if(isset($_POST['btn_buscar'])){
		$buscar_text=$_POST['buscar'];
		$select_buscar=$con->prepare('
			SELECT * FROM ingresos WHERE code LIKE :campo OR contratipo LIKE :campo OR factura LIKE :campo OR order_date LIKE :campo;'
		);

		$select_buscar->execute(array(
			':campo' =>"%".$buscar_text."%"
		));
    $resultado = 0;
		$resultado=$select_buscar->fetchAll();

	}


?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Facturas Pendientes</title>
 <link rel="stylesheet" href="css/styledom.css">
 <link href="https://fonts.googleapis.com/css2?family=Gentium+Basic&family=Julius+Sans+One&family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="fonts/icomoon/style.css">
 <link rel="stylesheet" href="css/bootstrap.min.css">
 <link rel="stylesheet" href="css/aos.css">
 <link href="https://fonts.googleapis.com/css?family=roboto" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@200&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 </head>
<body>
	    <?php include 'barra_asistente.php'; ?>

	<div class="contenedor">
		<h3>Ingresos de mercancia</h3>
		<div class="barra__buscador">
			<form action="" class="formulario" method="post">
				<input type="text" name="buscar" placeholder="buscar ID  o Contratipo	"
				value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
				<input type="submit" class="btn" name="btn_buscar" value="Buscar">
			</form>
		</div>
		<table>
			<tr class="head">
		<td>Fecha</td>
     	<td>Codigo</td>
		<td>producto</td>
		<td>Cantidad</td>
        <td>Factura</td>
        <td>Proveedor</td>

			</tr>
			<?php foreach($resultado as $fila):?>

         <form class="" action="" method="post">
           <tr>
             <td><?php echo $fila['order_date']; ?></td>
             <td> <?php echo $fila['code']; ?> </td>
             <td><?php echo $fila['contratipo']; ?></td>
             <td><?php echo $fila['cantidad']; ?></td>
             <td><?php echo $fila['factura']; ?></td>
             <td><?php echo $fila['Proveedor']; ?></td>
           </tr>
         </form>
			<?php endforeach ?>

		</table>
	</div>
</body>
</html>
