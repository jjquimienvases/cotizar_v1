<?php


function formatear($num){
  setlocale(LC_MONETARY, 'en_US');
  return "$" . number_format($num, 2);
}

 $count = 0;

 $totales = 0;
 
 include 'conexion.php';
 
 $sentencia_select = "SELECT * FROM traspaso_producto_id LIMIT 15";
 $result = $con->query($sentencia_select);
 $result -> fetch_all(MYSQLI_ASSOC);
 
 
  if(isset($_POST['btn_buscar'])){
		$buscar_text=$_POST['buscar'];
		$select_buscars = "SELECT * FROM traspaso_producto_id WHERE transfer_id = $buscar_text";
        $result = $con->query($select_buscars);
        $result -> fetch_all(MYSQLI_ASSOC);
	}else{
    echo "Esperando busqueda";
  }
  
   if(isset($_POST['btn_buscar'])){
		$buscar_text=$_POST['buscar'];
		$select_buscares = "SELECT * FROM traspaso_orden WHERE transfer_id = $buscar_text";
        $resulta = $con->query($select_buscares);
        $resulta -> fetch_all(MYSQLI_ASSOC);
	}else{
    echo "Esperando busqueda";
  }


 ?>




<!-- CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

<!-- jQuery and JS bundle w/ Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="../catalogo_e/fontawesome/svg-with-js/js/fontawesome-all.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Encode+Sans+SC:wght@200&family=Marcellus+SC&display=swap" rel="stylesheet">
<title>Traspasos</title>

<body>

<?php include 'navbar.php'; ?>
<hr>
<center>
  <h3 class="btn btn-warning" style="width: 60%">Buscar Traspaso</h3>
  <hr>
<div class="barra__buscador">
  <form action="" class="formulario" method="post">
    <input type="text" name="buscar" class="form-control" placeholder="buscar traspaso"
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
  <th>Punteo</th>
</tr>


   <?php foreach ($result as $fila):?>
   <tr>
     <td> <?php echo $count++ ?> </td>
     <td>  <?php echo $fila['item_code'] ?>  </td>
     <td>  <?php echo $fila['item_name'] ?>  </td>
     <td>  <?php echo $fila['item_quantity'] ?>  </td>
     <td>
         
    </td>
   </tr>


<?php endforeach ?>


<tfoot>


 <tr>
   <th colspan="7">INFORMACION DEL TRASPASO</th>
 </tr>
  <?php foreach ($resulta as $info) {
    // code...
  }  ?>
 <tr>
   <td colspan="7">

       <div class="form-row">
         <div class="form-group col-md-6">
           <label for="inputPassword4"> NUMERO DE TRASPASO </label>
           <input type="text  " class="form-control" id="inputPassword4" placeholder="Cedula o NIT" value=" <?php echo $info['transfer_id']; ?> ">
         </div>
         <div class="form-group col-md-6">
           <label for="inputEmail4">Solicitante</label>
           <input type="text" class="form-control" id="inputEmail4" placeholder="Nombre" readonly value=" <?php echo $info['solicitante']; ?> ">
         </div>
       </div>
       <div class="form-row">

         <div class="form-group col-md-6">
           <label for="inputAddress">Empaca</label>
           <input type="text" class="form-control" id="inputAddress" placeholder="Telefono" value=" <?php echo $info['empaca']; ?> ">
         </div>
         <div class="form-group col-md-6">
           <label for="inputAddress2">Recibe</label>
           <input type="text" class="form-control" id="inputAddress2" placeholder="Ciudad" value=" <?php echo $info['recibe']; ?> ">
         </div>
       </div>
       <div class="form-row">
         <div class="form-group col-md-6">
           <label for="inputCity">Fecha:</label>
           <input type="text" class="form-control" id="inputCity" value=" <?php echo $info['order_date']; ?> ">
         </div>
         <div class="form-group col-md-6">
           <label for="inputState">Estado</label>
           <input type="text" class="form-control" id="inputState" value=" <?php echo $info['estado']; ?> ">

         </div>
       </div>

   </td>

 </tr>
 </tfoot>
</table>
</body>