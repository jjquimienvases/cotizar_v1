<?php
function formatear($num){
	setlocale(LC_MONETARY, 'en_US');
	return "$" . number_format($num, 2);
}
 include '../conectar.php';
 $con = conectar();
 session_start();
 $user_id = $_SESSION['userid'];
 $user_rol = $_SESSION['id_rol'];
 
 $other_bodega = "";
 $bodega = "";
 if($user_rol == 2){
     $bodega = "mostrador principal";
     $other_bodega = "call center";
 }else if($user_rol == 3){
      $bodega = "mostrador D1";
 }else if($user_id == 27){
      $bodega = "ibague2";
 }else if($user_id == 26){
      $bodega = "ibague";
 }
 

//   $sentencia_select =$con->prepare('SELECT * FROM call_punto_de_venta INNER JOIN factura_orden ON call_punto_de_venta.order_id = factura_orden.order_id WHERE call_punto_de_venta.estado = "pendiente" AND call_punto_de_venta.bodega = "$bodega" ');
// 	$sentencia_select->execute();
// 	$resultado=$sentencia_select->fetchAll();
if($user_rol == 2){
 $sql_ = "SELECT * FROM call_punto_de_venta cp INNER JOIN factura_orden fo ON cp.order_id = fo.order_id WHERE fo.estado = 'pendiente' AND cp.bodega = '$bodega' OR cp.bodega = '$other_bodega'";
}else{
     $sql_ = "SELECT * FROM call_punto_de_venta cp INNER JOIN factura_orden fo ON cp.order_id = fo.order_id WHERE cp.estado = 'pendiente' AND cp.bodega = '$bodega'";
}
 $resultado = $con->query($sql_);
	// metodo buscar
	if(isset($_POST['btn_buscar'])){
		$buscar_text=$_POST['buscar'];
		
		$sql_1 = "SELECT * FROM call_punto_de_venta WHERE order_id LIKE '%$buscar_text%' OR cliente LIKE '%$buscar_text%'";
 $resultado = $con->query($sql_1);       

	}

			foreach($resultado as $fila):
    $id =  $fila['order_id'];

  endforeach;
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Facturas Pendientes</title>
   <link rel="stylesheet" href="css/styledom.css">
   <link href="https://fonts.googleapis.com/css2?family=Gentium+Basic&family=Julius+Sans+One&family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@200&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style>
    contenedor{
        width:90%;
        height:90%;
    }
    
</style>
 </head>
<body>

	<div class="container-fluid">
	 <hr>
	 <br>
	<center>	<h3>Cotizaciones pendientes ventas Call Center</h3>
	<hr>
		<div class="barra__buscador">
			<form action="" class="formulario" method="post">
				<input type="text" name="buscar" placeholder="Buscar ID  o Cliente" value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="form-control">
				<br>
				<input type="submit" class="btn btn-primary" name="btn_buscar" value="Buscar">
			</form>
		</div></center>
		<br>
		<table class="table" id="tablas">
			<tr class="head-bordered">
				<td>Fecha</td>
				<td>Cotizacion</td>
				<td>Cliente</td>
				<!--<td>Comercial</td>-->
        <td>Monto</td>
        <td>Estado</td>
        <td>Notas</td>
        <td>Comprobante</td> 
        <td>PDF</td>
        <td>Pago</td>
        <td>Factura</td>
				<td colspan="2">ACCION</td>
			</tr>
			<?php foreach($resultado as $fila):?>

         <form class="" action="finalizar_venta_mostrador.php" method="post">
           <tr>
             <td><?php echo $fila['order_date']; ?></td>
             <td><input type="text"name="id" value="<?php echo $fila['order_id']; ?>" class="form-control" readonly></td>
             <td><input type="text" name="cliente" value="<?php echo $fila['cliente']; ?>" class="form-control" readonly></td>
             <input type="hidden" name="comercial" value="<?php echo $fila['comercial']; ?>" class="form-control" readonly>
             <td><input type="text" name="monto" value="<?php echo formatear($fila['order_total_after_tax']); ?>" class="form-control" readonly> </td>
             <td><input type="text" name="estado" value="<?php echo $fila['estado']; ?>" class="form-control" readonly>  </td>
             <td><input type="text" name="nota" value="<?php echo $fila['notas']; ?>" class="form-control" readonly>  </td>
            <td><img src="<?php echo $fila['ruta'];?>" alt="<?php echo $fila['order_id'];?>" target="_blank" class="img-fluid" width="100" height="100" style="margin-left: 20px" ></td>
             <input type="hidden" name="canal_v" value="<?php echo $fila['canal']; ?>" class="form-control" readonly>
             <input type="hidden" name="bodega_salida" value="<?php echo $fila['bodega']; ?>" class="form-control" readonly>

              <?php if(isset($fila['order_id'])){
                echo '<td> <a href="../imprimir.php?invoice_id='.$fila["order_id"].'" title="Imprimir Factura"><div class="btn btn-danger"><span class="glyphicon glyphicon-print">PDF</span></div></a></td>';
              } ?>
              <td><select class="form-control" name="metodo_de_pago">
                <option value="Efectivo" selected>Efectivo</option>
                <option value="Datafono">Datafono</option>
                <option value="bancolombia">Bancolombia</option>
                <option value="davivienda">Davivienda</option>
                <option value="mercado libre">Mercado Libre</option>
              </select></td>          
              <td>
              <select class="form-control" name="factura">
                <option value="1">Solicitar Factura</option>
                <option value="0" selected>NO Solicitar Factura</option>
              </select>
              </td>
            <td>   <button type="submit" name="send" value="Completado" class="btn btn-info" style="width:100px; height:30px;">Good</button> </td>
            <!--<td>   <button type="submit" name="send_s" value="No recoge" class="btn btn-danger" style="width:100px; height:30px;">No R</button> </td>-->


           </tr>
         </form>
			<?php endforeach ?>

		</table>
	</div>
</body>

</html>
<script type="text/javascript">

function stopDefAction(evt) {
  evt.preventDefault();
}
</script>
