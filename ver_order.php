<?php


include 'conectar.php';
$conx = conectar();

function formatear($num){
  setlocale(LC_MONETARY, 'en_US');
  return "$" . number_format($num, 2);
}
$resultado_informacion = 0;





  $sentencia_select=$con->prepare('SELECT * FROM `orden_compra_productos` LIMIT 15');
	$sentencia_select->execute();
	$resultado=$sentencia_select->fetchAll();

	// metodo buscar
	if(isset($_POST['btn_buscar'])){
		$buscar_text=$_POST['buscar'];
		$select_buscar=$con->prepare('
			SELECT * FROM orden_compra_productos WHERE order_id LIKE :campo;'
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
			SELECT * FROM orden_compra WHERE order_id LIKE :campo;'
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
<title>ordenes de compra</title>

<body>

<?php include 'barra_asistente.php'; ?>
<hr>
<center>
  <h3 class="btn btn-warning" style="width: 60%">Buscar ordenes</h3>
  <hr>
<div class="barra__buscador">
  <form action="" class="formulario" method="post">
    <input type="text" name="buscar" class="form-control" placeholder="por orden o proveedor"
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
  
</tr>


   <?php foreach ($resultado as $fila):
    $item_code = $fila['item_code'];
   ?>
   
   <tr>
     <td> <?php echo $count++ ?> </td>
     <td>  <?php echo $item_code ?>  </td>
     <?php
     $total = 0;
        $sql_ = $conx->query("SELECT * FROM producto_av WHERE id = $item_code");
      $name_item = "";
        foreach($sql_ as $datas){
            $name_prov = $datas['name_prov'];
            $id_categoria = $datas['id_categoria'];   
        if($id_categoria == 4 && $name_prov != ""){
            $name_item = $name_prov; 
        }else{
            $name_item = $fila['item_name'];
        }
          
      ?>
     <td>  <?php echo $name_item; ?>  </td>
     <td>  <?php echo $fila['cantidad_numero']; ?>  </td>
       
   </tr>
  
     <?php
   
            
        }
 endforeach; ?>
<tfoot>
<tr>
    <?php foreach ($resultados as $info) {
    // code...
  }  ?>

</tr>
 <tr>
   <th colspan="7">INFORMACION DEL PROVEEDOR</th>
 </tr>
  
 <tr>
   <td colspan="7">

       <div class="form-row">
         <div class="form-group col-md-6">
           <label for="inputEmail4">proveedor</label>
           <input type="text" class="form-control" id="inputEmail4" placeholder="Nombre" readonly value=" <?php echo $info['order_receiver_name']; ?> ">
         </div>
         
         <div class="form-group col-md-6">
           <label for="inputEmail4">Fecha</label>
           <input type="text" class="form-control" id="inputEmail4" placeholder="Nombre" readonly value=" <?php echo $info['order_date']; ?> ">
         </div>
       
       </div>
   
       

   </td>

 </tr>
 </tfoot>
</table>
</body>
