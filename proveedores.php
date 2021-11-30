<?php
function formatear($num){
	setlocale(LC_MONETARY, 'en_US');
	return "$" . number_format($num, 2);
}


include 'conectar.php';
$conexion = conectar();
$sentencia_select=$con->prepare('SELECT * FROM proveedor AS t1 JOIN proveedor_producto AS t2 ON t1.codigo=t2.proveedor_id JOIN producto AS t3 ON t1.codigo = t3.id');
$sentencia_select->execute();
$resultado=$sentencia_select->fetchAll();
 ?>





<!-- SELECT * FROM proveedor AS t1 JOIN proveedor_producto AS t2 ON t1.id=t2.id   -->
                         <!-- JOIN producto AS t3 ON t1.id = t3.id -->

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head><meta charset="euc-jp">
    
    <title>Proveedores</title>
		<!-- CSS -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

		<!-- jQuery and JS bundle w/ Popper.js -->
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </head>
  <body>

    <div class="contenedor">
			<?php include 'barra_asistente.php'; ?>
			<hr>
		<center> <h3>Lista de productos y proveedores</h3> </center>
			 <hr>
       <div class="form-group col-md3">
        <a href="anadir.php"><button type="button" class="btn btn-primary" name="crear">Crear Proveedor</button></a>
       </div>
       <div class="form-group col-md3">
         <a href="asignar.php"><button type="button" class="btn btn-success" name="button">asignar productos</button> </a>
       </div>
<hr>
<!-- buscador -->



<div class="">


  <table class="table">
    <tr class="head">
      <td>id</td>
      <td>contratipo</td>
      <td>compañia</td>
      <td>Asesot</td>
      <td>Telefono</td>
      <td>Precio</td>
    </tr>
    <?php foreach($resultado as $fila):?>
      <tr >
        <!-- <td><?php echo $count++ ?> </td> -->
        <td><?php echo $fila['producto_id']; ?></td>
        <td><?php echo $fila['contratipo']; ?></td>
        <td><?php echo $fila['compania']; ?></td>
        <td><?php echo $fila['asesor']; ?></td>
        <td><?php echo $fila['telefono']; ?></td>
        <td><?php echo $fila['precio']; ?></td>
      </tr>





    <?php endforeach ?>

  </table>
</div>


    </div>
  </body>
</html>
