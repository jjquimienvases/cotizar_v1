<?php
session_start();
function formatear($num){
	setlocale(LC_MONETARY, 'en_US');
	return "$" . number_format($num, 2);
}
include '../conections.php';
include '../Invoice.php';

$invoice = new Invoice();
$invoice->checkLoggedIn();// verifica que este logeado

 ?>
 <!--AQUI ES LA CONSULTA PARA BUSCAR LA COTIZACION -->


 <?php $mysqli2 = new mysqli ('ftp.profruver.com', 'profru_jjquimi', 'LeinerM4ster', 'profru_cotpruebas'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Lato:400,900" rel="stylesheet">
	<link rel="stylesheet" href="../css/estilo_aprobar_cotizacion.css">
	<title>Traspasos</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.18.0/js/md5.js" integrity="sha512-NpfrQEgzOExS1Ax8fjITKrgBFK87lZbBmvWdZk4suiCC4tsHPrTCsulgIA7Z/+CeWhDpEP/f36mNWgZXDKtTAA==" crossorigin="anonymous"></script>
  <script src="jquery-3.1.1.min.js"></script>
	<script src="../js/select2.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/select2.css">

</head>
<body>
<center>
 <h3>Traspasar mercancia entre bodegas</h3>
</center>
	<div class="container">
		<div class="form__top">
			<h2>Buscar <span>Producto</span></h2>
		</div>

		<div style="text-align: center;">
			<select id="mibuscador" style="width: 90%">
				<option value="0">Buscar Producto:</option>
				<?php
				$query = $mysqli2 -> query ("SELECT * FROM producto ORDER BY contratipo ASC");
				while ($valores = mysqli_fetch_array($query)) {
					echo '<option value="'.$valores["id"].'">'.$valores["id"].','.$valores["contratipo"].'</option>';
				}
				?>
			</select>
		</div>


		<form class="form__reg" action="" method="post" id="formulario" name="formulario">
    	<input class="input" type="number" placeholder="Codigo" name="codigo" value="">
    	<input class="input" type="text" placeholder="Producto" name="producto" value="">
      <input class="input" type="number" placeholder="Cantidad" required name="cantidad" value="">
     <hr>
     <label for="">Bodega Origen:</label>
    <select class="" name="envia">
       <option value="producto">JJ Principal</option>
       <option value="producto_d1">Bodega D1</option>
       <option value="producto_av">Bodega Av</option>
       <option value="productos_ibague">Ibague</option>
    </select>
            <hr>
          <label for="">Bodega destino:</label>
    <select class="" name="recibe">
        <option value="producto">JJ Principal</option>
        <option value="producto_d1">Bodega D1</option>
        <option value="producto_av">Bodega Av</option>
        <option value="productos_ibague">Ibague</option>
    </select>
		<hr>
<label for="">Quien solicita el pedido?</label>		<div class="form-group">
	 			<div style="text-align: center;">
	 				 <select id="buscarcomercial" style="width: 90%" name="solicita">
	 						 <option value="0">Busca tu nombre:</option>
	 					 	<?php
	 								$query = $mysqli2 -> query ("SELECT * FROM factura_usuarios order by first_name");
	 								while ($valores = mysqli_fetch_array($query)) {
	 									echo '<option value="'.$valores[first_name].'&nbsp;'.$valores[last_name].'">'.$valores[first_name].'&nbsp;'.$valores[last_name].'</option>';
	 								}
	 							?>
	 				 </select>
	 		 </div>
	 		 </div>


            <div class="btn__form">
            	<input class="btn__submit" type="submit" id="guardando" doiclicksito value="Aprobar Traspaso">
            	<input class="btn__reset" type="reset" value="LIMPIAR">
            </div>
		</form>
	</div>
	
<a href="traslados_inmediatos.php"><button>Traslados inmediatos de mercancia</button></a>	
<hr>
  <script type="text/javascript">
  	$(document).ready(function(){
  		$('#guardando').click(function(){
  			var datos=$('#formulario').serialize();
  			$.ajax({
  				type:"POST",
  				url:"enviar_traspaso.php",
  				data:datos,
  				success:function(r){
  					console.log(r);
  					if(r!=0 && !isNaN(r)){//SI ES DISTINTO A 0 Y ES UN NUMERO
  						alert("agregado con exito");

  					}else{//ES 0(NO SE EJECUTO LA CONSULTA) O EXISTE UN ERROR EXPLICATIVO(STRING)
  						alert("el string no funciona correctamente");
            }
  				}
  			});
  			return false;
  		});
  	});
  </script>

	<script type="text/javascript">
		function ver_datos(id, e){
			var dato = document.getElementById('cliente'+id);
			e.preventDefault();
		}

		$("#mibuscador").on('change',function(){
			$.ajax({
				url:'conexion.php',
				type:'POST',
				dataType:'json',
				data:{key:'Q1',producto:$(this).val()}
			}).done(function(d){

				let padre = $("#mibuscador").parent().parent().parent();
				padre.find("[name^=codigo	]").val(d.resultado.id)
				padre.find("[name^=producto	]").val(d.resultado.contratipo)
			}).fail(function(e){console.log("ERROR:",e);});
		})

		$(document).ready(function(){
			$('#mibuscador').select2();
		});

		$(document).ready(function(){
			$('#buscarcomercial').select2();
		});
	</script>

	<script type="text/javascript">
		function ver_datos(id, e){
			var dato = document.getElementById('cliente'+id);
			e.preventDefault();
		}

		$("#mibuscador").on('change',function(){
			$.ajax({
				url:'../conexiones.php',
				type:'POST',
				dataType:'json',
				data:{key:'Q1',producto:$(this).val()}
			}).done(function(d){

				let padre = $("#mibuscador").parent().parent().parent();
				padre.find("[name^=codigo	]").val(d.resultado.id)
				padre.find("[name^=producto	]").val(d.resultado.contratipo)
			}).fail(function(e){console.log("ERROR:",e);});
		})

		$(document).ready(function(){
			$('#mibuscador').select2();
		});
	</script>





</body>
</html>
