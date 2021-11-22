
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
  include_once 'conectar.php';
  $conexion = conectar();
  
//   $servidor="ftp.profruver.com";
//   $nombreBd="profru_cotpruebas";
//   $usuario="profru_jjquimi";
//   $pass="LeinerM4ster";
//   $conexion = new mysqli($servidor,$usuario,$pass,$nombreBd);

//   if ($conexion->connect_error) {
//   	die("Connection failed: " . $conexion->connect_error);
//   }

    $sentencia_select =$con->prepare('SELECT * FROM documentos');
	$sentencia_select->execute();
	$resultado=$sentencia_select->fetchAll();


	// metodo buscar
	if(isset($_POST['btn_buscar'])){
		$buscar_text=$_POST['buscar'];
		$select_buscar=$con->prepare('
			SELECT * FROM documentos WHERE cotizacion LIKE :campo;'
		);
    $select_buscar->execute(array(
			':campo' =>"%".$buscar_text."%"
		));
    $resultado = 0;
		$resultado=$select_buscar->fetchAll();

	}




  // $sentencia =$con->prepare('SELECT *
  //   FROM bodegaav
  //   JOIN documentos ON documentos.codigo = bodegaav.order_id ');
	// $sentencia->execute();
	// $resultado=$sentencia->fetchAll();



  // SELECT *
  //   FROM bodegaav
  //   JOIN documentos ON documentos.codigo = bodegaav.order_id
  //   // WHERE bodegaav.order_id =


// $nuevoestado = "Finalizado";
// $consulta ="UPDATE `bodegaav` SET `estado`= '$nuevoestado' WHERE id = '$id'";
// $conexion->query($consulta);


?>

<!DOCTYPE html>
<html lang="es">
<head><meta charset="big5">
	
	<title>Documentos</title>
   <link rel="stylesheet" href="css/styledom.css">
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
  <?php  include 'barra_bodega.php'; ?>
	<div class="contenedor">

		<h3>Documentos de empaque</h3>
		<div class="barra__buscador">
			<form action="" class="formulario" method="post">
				<input type="text" name="buscar" placeholder="buscar ID  o Contratipo	"
				value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
				<input type="submit" class="btn" name="btn_buscar" value="Buscar">
			</form>
		</div>

    <?php
    // Esto devolver¨¢ todos los archivos de esa carpeta
    $archivos = scandir("documentos/img");
    $num=0;
    for ($i=2; $i<count($archivos); $i++)
    {$num++;
    ?>
		<table>
			<tr class="head">
				<td>Fecha</td>
				<td>Cotizacion</td>
        <td>Nombre documento</td>
				<td>Accion</td>


			</tr>
			<?php foreach($resultado as $fila):?>

         <form class="" action="completar_empaque.php" method="post">
           <tr>
             <td><?php echo $fila['order_date']; ?></td>
             <td><?php echo $fila['cotizacion']; ?></td>
             <td><?php echo $archivos[$i]; ?></td>
             <td><a title="Descargar Archivo" href="multiples/img/<?php echo $archivos[$i]; ?>" download="<?php echo $archivos[$i]; ?>" style="color: blue; font-size:18px;">Descargar Fichero</a></td>
        </tr>


         </form>
			<?php endforeach ?>
   <?php }?>
      <!-- Visualizaci¨®n del nombre del archivo !-->



		</table>
	</div>
</body>
</html>
