<?php


//voy a hacer una prueba, miremos si funciona
include_once 'factuenvases/catalogos/conexion0.php';
function formatear($num){
  setlocale(LC_MONETARY, 'en_US');
  return "$" . number_format($num, 2);
}
$resultado_informacion = 0;


  $sentencia_select=$con->prepare('SELECT * FROM factura_orden_producto LIMIT 15');
	$sentencia_select->execute();
	$resultado=$sentencia_select->fetchAll();

	// metodo buscar
	if(isset($_POST['btn_buscar'])){
		$buscar_text=$_POST['buscar'];
		$select_buscar=$con->prepare('
			SELECT * FROM factura_orden_producto WHERE order_id LIKE :campo;'
		);

		$select_buscar->execute(array(
			':campo' =>"%".$buscar_text."%"
		));


		$resultado=$select_buscar->fetchAll();
      foreach ($resultado as $info_productos) {
        // code...
      }
       $cotizacion = $info_productos['order_id'];

         // echo "<pre>";
         //     print_r($cotizacion);
         // echo "</pre>";
         //
         // return;

           if (isset($cotizacion)) {
             $resultado == $buscar_text;
           }


	}else{
    echo "esperando busqueda";
  }

  if(isset($_POST['btn_buscar'])){
		$buscar_text=$_POST['buscar'];
		$select_buscars=$con->prepare('
			SELECT * FROM factura_orden WHERE order_id LIKE :campo;'
		);

		$select_buscars->execute(array(
			':campo' =>"%".$buscar_text."%"
		));

		$resultados = $select_buscars->fetchAll();

	}else{
    echo "Esperando busqueda";
  }


 $count = 0;

 $totales = 0;

 ?>




<!-- CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

<!-- jQuery and JS bundle w/ Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<title>Cot Sin Iva</title>

<body>

<?php include 'barra_asistente.php'; ?>
<hr>
<center>
  <h3 class="btn btn-warning" style="width: 60%">Buscar Cotizaciones</h3>
  <hr>
<div class="barra__buscador">
  <form action="" class="formulario" method="post">
    <input type="text" name="buscar" class="form-control" placeholder="buscar cotizacion o cliente"
    value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" style="width: 90%">
      <br>
    <input type="submit" class="btn btn-success" name="btn_buscar" value="Buscar">
  </form>
</div>
</center>

<?php $count++; ?>
<table class="table table-sm table-dark">

<tr>
  <th>#</th>
  <th>Codigo</th>
  <th>Producto</th>
  <th>Cantidad</th>
  <th>Unitario Sin Iva</th>
  <th>Precio total</th>
</tr>


   <?php foreach ($resultado as $fila):?>
   <tr>
     <td> <?php echo $count++ ?> </td>
     <td>  <?php echo $fila['item_code'] ?>  </td>
     <td>  <?php echo $fila['item_name'] ?>  </td>
     <td>  <?php echo $fila['order_item_quantity'] ?>  </td>
     <td>
         <?php

            $valorU = $fila['order_item_unitario'];
            $sinIva = $valorU / 1.19;

          echo formatear($sinIva);

          ?>
    </td>
     <td>  <?php echo formatear($fila['order_item_final_amount']); ?>  </td>
   </tr>

     <?php
       $monto = 0;
       $valor = $fila['order_item_final_amount'];
       $monto = $valor;
       $totales += $monto;
      ?>
<?php endforeach ?>
<tr>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td colspan="5">
     <?= "Total: ". formatear($totales);?>
 </td>
</tr>

   <tr>
     <th colspan="6">INFORMACION ADICIONAL</th>
   </tr>
   <tr>
     <th colspan="3">Descuento %</th>
     <th colspan="3">Descuento $</th>
   </tr>
   <tr>


      <?php foreach ($resultados as $extra):?>

     <td colspan="3"> <?php echo $extra['order_tax_per']; ?> </td>
     <td colspan="3"> <?php echo $extra['order_total_tax']; ?> </td>
   </tr>
    <?php
           $descuento = $extra['order_tax_per'];
           $total_descuento = $extra['order_total_amount_due'];
      if ($descuento < 1) {
        echo "
          <tr>
          <td colspan = 5>  esta cotizacion no tiene descuento <td>
          </tr>

        ";
      }else{
        echo "
             <tr><td> Total con descuento: $total_descuento <td></tr>
             ";
      }
     ?>

<?php endforeach ?>
<tfoot>


 <tr>
   <th colspan="7">INFORMACION DEL CLIENTE</th>
 </tr>
  <?php foreach ($resultados as $info) {
    // code...
  }  ?>
 <tr>
   <td colspan="7">

       <div class="form-row">
         <div class="form-group col-md-6">
           <label for="inputEmail4">Nombre</label>
           <input type="text" class="form-control" id="inputEmail4" placeholder="Nombre" readonly value=" <?php echo $info['order_receiver_name']; ?> ">
         </div>
         <div class="form-group col-md-6">
           <label for="inputPassword4">CC o NIT</label>
           <input type="text  " class="form-control" id="inputPassword4" placeholder="Cedula o NIT" value=" <?php echo $info['cedula']; ?> ">
         </div>
       </div>
       <div class="form-row">

         <div class="form-group col-md-6">
           <label for="inputAddress">Telefono</label>
           <input type="text" class="form-control" id="inputAddress" placeholder="Telefono" value=" <?php echo $info['tel_client']; ?> ">
         </div>
         <div class="form-group col-md-6">
           <label for="inputAddress2">Ciudad</label>
           <input type="text" class="form-control" id="inputAddress2" placeholder="Ciudad" value=" <?php echo $info['ciudad']; ?> ">
         </div>
       </div>
       <div class="form-row">
         <div class="form-group col-md-6">
           <label for="inputCity">Direccion</label>
           <input type="text" class="form-control" id="inputCity" value=" <?php echo $info['direccion']; ?> ">
         </div>
         <div class="form-group col-md-6">
           <label for="inputState">Email</label>
           <input type="text" class="form-control" id="inputState" value=" <?php echo $info['email']; ?> ">

         </div>
            <div class="form-group col-md-6">
           <label for="inputState">Fecha</label>
           <input type="text" class="form-control" id="inputState" value=" <?php echo $info['order_date']; ?> ">
         </div>
          
          <div class="form-group col-md-6">
           <label for="inputState">Comercial</label>
           <input type="text" class="form-control" id="inputState" value=" <?php echo $info['order_receiver_address']; ?> ">

         </div>
         
       </div>

   </td>

 </tr>
 </tfoot>
</table>
</body>
