<!-- CSS -->
<title>Asignar Producto</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">



<!-- jQuery and JS bundle w/ Popper.js -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

<link rel="stylesheet" href="css/anadir.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.18.0/js/md5.js" integrity="sha512-NpfrQEgzOExS1Ax8fjITKrgBFK87lZbBmvWdZk4suiCC4tsHPrTCsulgIA7Z/+CeWhDpEP/f36mNWgZXDKtTAA==" crossorigin="anonymous"></script>
<script src="jquery-3.1.1.min.js"></script>
<script src="js/select2.js"></script>
<?php
include 'conectar.php';
$conexion = conectar();




 ?>
 <?php include 'barra_asistente.php'; ?>

<center> <h3>Asignar Producto -> Proveedor</h3> </center>
<hr>

<div class="contenedor">
  <div class="container-form">
    <form class="" action="" method="post" id="formulario">
   <label for="">Proveedor:</label>
   <div class="form-group">
      <div style="text-align: center;">
        <select id="buscarproveedor" style="width: 100%" name="proveedor">
          <option value="0">Buscar Proveedor:</option>
          <?php
          $query = $conexion -> query ("SELECT * FROM proveedor");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores["codigo"].'">'.$valores["compañia"].','.$valores["asesor"].'</option>';
          }

          ?>
        </select>
      </div>
    </div>
   <label for="">Producto:</label>
   <div class="form-group">
      <div style="text-align: center;">
        <select id="buscarproducto" style="width: 100%" name="producto">
          <option value="0">Buscar Producto:</option>
          <?php
          $query = $conexion -> query ("SELECT * FROM producto");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores["id"].'">'.$valores["id"].','.$valores["contratipo"].'</option>';
          }

          ?>
        </select>
      </div>
    </div>
   <label for="">Precio:</label>
      <input type="text" name="precio" value="">

  <br><br>
      <button type="submit" name="button" id="try">Asignar Producto</button>
    </form>
  </div>
</div>

<!-- send informacion de asignacion -->
<script type="text/javascript">
$(document).ready(function(){
 $('#try').click(function(){
	 var datos=$('#formulario').serialize();
	 $.ajax({
		 type:"POST",
		 url:"send_info.php",
		 data:datos,
		 success:function(r){
			 console.log(r);
			 if(r!=0 && !isNaN(r)){//SI ES DISTINTO A 0 Y ES UN NUMERO
				 alert("agregado con exito");
         var respuesta = confirm("¿Qieres asignar otro producto?");
         if (respuesta == true){
         window.location="asignar.php";
         }else {
           return false;
           window.location="proveedores.php";
         }
			 }else{//ES 0(NO SE EJECUTO LA CONSULTA) O EXISTE UN ERROR EXPLICATIVO(STRING)
				 alert("no funciona");
			 }
		 }
	 });
	 return false;
 });
});
</script>
