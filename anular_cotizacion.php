<?php
session_start();
function formatear($num){
	setlocale(LC_MONETARY, 'en_US');
	return "$" . number_format($num, 2);
}
include ('conectar.php');
include 'Invoice.php';

$invoice = new Invoice();
$invoice->checkLoggedIn();// verifica que este logeado

 ?>
 <!--AQUI ES LA CONSULTA PARA BUSCAR LA COTIZACION -->

 <?php
 $resultado = "";
 if (isset($_POST['buscar_cotizacion'])) {
 	$conexion = conectar();
 	$id = $_POST['producto'];
 	$sql = "SELECT * FROM factura_orden WHERE order_id='$id'  OR order_receiver_name LIKE '%$id%' ";
 	$r = $conexion->query($sql);
 	if ($o = $r->fetch_object()) {
 		$resultado = $o;
 	}

 }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Lato:400,900" rel="stylesheet">
	<link rel="stylesheet" href="css/estilo_aprobar_cotizacion.css">
	<title>Anular Cotizacion</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.18.0/js/md5.js" integrity="sha512-NpfrQEgzOExS1Ax8fjITKrgBFK87lZbBmvWdZk4suiCC4tsHPrTCsulgIA7Z/+CeWhDpEP/f36mNWgZXDKtTAA==" crossorigin="anonymous"></script>
  <script src="jquery-3.1.1.min.js"></script>
</head>
<body>

  <?php include 'barra.php' ?>
<center>
 <h3>Anular Cotizacion</h3>
</center>
	<div class="container">
		<div class="form__top">
			<h2>Buscar <span>Cotizacion</span></h2>
		</div>
    <div class="contenedor">
      <form class="" action="" method="post">
        <center><div class="input-contenedor">
          <input type="text"  placeholder="Cliente o factura" name="producto" size="50" id="producto" required autocomplete="off" autofocus>
          <input type="hidden" name="buscar_cotizacion" size="200">
        </div></center>
      </form>
    </div>

		<form class="form__reg" action="" method="post" id="formulario" name="formulario" enctype="multipart/form-data">
      <input class="input" type="text" placeholder="&#9993;  Fecha" name="fecha" value="<?=isset($resultado->order_date)?$resultado->order_date:''?>" required readonly>
    	<input class="input" type="number" placeholder="&#128100;  cotizacion" required name="cotizacion" id="cotizacion"  value="<?=isset($resultado->order_id)?$resultado->order_id:''?>" readonly>
      <input class="input" type="text" placeholder="&#9993;  cliente" required name="cliente" value="<?=isset($resultado->order_receiver_name)?$resultado->order_receiver_name:''?>" readonly>
      <input class="input" type="number" placeholder="&#9993;  Total" name="monto" value="<?=isset($resultado->order_total_after_tax)?$resultado->order_total_after_tax:''?>" required>
      <input class="input" type="text" placeholder="&#128222;  comercial" name="vendedor" value="<?=isset($resultado->order_receiver_address)?$resultado->order_receiver_address:''?>" readonly>
            <div class="inputfield">
              <label>Punto de venta </label>
              <div class="custom_select">
                <select name="bodega">
                  <option value="producto">Mostrador Principal</option>
                  <option value="producto_d1">D1</option>
                  <option value="producto_av">Call Center</option>
                  <option value="productos_ibague">Ibague</option>
                </select>
              </div>
            </div>
            <hr>
            <div class="btn__form">
            	<input class="btn__submit" type="submit" id="guardando" doiclicksito value="Anular">
            	<input class="btn__reset" type="reset" value="LIMPIAR">
            </div>

		</form>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#guardando').click(function(){
				var data=$('#formulario').serialize();
				$.ajax({
					type:"POST",
					url:"anular.php",
					data:data,
					success:function(r){
						console.log(r);
						if(r!=0 && !isNaN(r)){//SI ES DISTINTO A 0 Y ES UN NUMERO
							alert("Cotizacion anulada correctamente");

						}else{//ES 0(NO SE EJECUTO LA CONSULTA) O EXISTE UN ERROR EXPLICATIVO(STRING)
							alert("No funciono, contactar al desarrollador");
						}
					}
				});
				return false;
			});
		});
  </script>




</body>
</html>
