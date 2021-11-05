<?php
include_once 'conexion0.php';

if(isset($_GET['id'])){
	$id=(int) $_GET['id'];

	$buscar_id=$con->prepare('SELECT * FROM producto WHERE id=:id LIMIT 1');
	$buscar_id->execute(array(
		':id'=>$id
	));
	$resultado=$buscar_id->fetch();
}else{
	header('Location: catalogos.php');
}
 ?>


<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Editar Un producto</title>
	<link rel="stylesheet" href="css/estilo0.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.18.0/js/md5.js" integrity="sha512-NpfrQEgzOExS1Ax8fjITKrgBFK87lZbBmvWdZk4suiCC4tsHPrTCsulgIA7Z/+CeWhDpEP/f36mNWgZXDKtTAA==" crossorigin="anonymous"></script>
	<script src="jquery-3.1.1.min.js"></script>
</head>
<body>
	<div class="contenedor">
		<h2>Modificar un producto</h2>
		<form action="" method="post" id="formulario">
			<div class="form-group">
			<label for="">Codigo</label>	<input type="text" name="id" value="<?php if($resultado) echo $resultado['id']; ?>" class="input__text">
			<label for="">Producto</label>	<input type="text" name="contratipo" value="<?php if($resultado) echo $resultado['contratipo']; ?>" class="input__text">
			<label for="">Genero</label>	<input type="text" name="genero" value="<?php if($resultado) echo $resultado['genero']; ?>" class="input__text">

			</div>
			<div class="form-group">
			<label for="">Precio</label>	<input type="text" name="gramo" value="<?php if($resultado) echo $resultado['gramo']; ?>" class="input__text">
			<label for="">Stock</label>	<input type="text" name="stock" value="<?php if($resultado) echo $resultado['stock']; ?>" class="input__text">
			<label for="">Categoria</label>	<input type="text" name="id_categoria" value="<?php if($resultado) echo $resultado['id_categoria']; ?>" class="input__text">
			</div>
			<div class="form-group">
				<label for="">Peso</label>	<input type="text" name="peso" value="<?php if($resultado) echo $resultado['peso']; ?>" class="input__text">

				<label for="">Unidad empaque</label>	<input type="text" name="unidad" value="<?php if($resultado) echo $resultado['unidad']; ?>" class="input__text">

				<label for="">ubicacion</label>	<input type="text" name="ubicacion" value="<?php if($resultado) echo $resultado['ubicacion']; ?>" class="input__text">

			</div>
				<div class="form-group">
				<label for="">Stock Minimo</label>	<input type="text" name="minimo" value="<?php if($resultado) echo $resultado['minimo']; ?>" class="input__text">
				<label for="">Stock Maximo</label>	<input type="text" name="maximo" value="<?php if($resultado) echo $resultado['maximo']; ?>" class="input__text">

				</div>    
			
			<div class="btn__group">
				<a href="index.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Actualizar" id="guardando" doiclicksito class="btn btn__primary">
			</div>
		</form>
	</div>

  <script type="text/javascript">
   $(document).ready(function(){
     $('#guardando').click(function(){
       var datos=$('#formulario').serialize();
       $.ajax({
         type:"POST",
         url:"send_actualizar.php",
         data:datos,
         success:function(r){
           console.log(r);
           if(r!=0 && !isNaN(r)){//SI ES DISTINTO A 0 Y ES UN NUMERO
             alert("La informacion de este producto se actualizo correctamente en todas las bodegas");
						 window.location="catalogoA.php";

           }else{//ES 0(NO SE EJECUTO LA CONSULTA) O EXISTE UN ERROR EXPLICATIVO(STRING)
             alert("no funciona la consulta, contactar con el desarrollador");
           }
         }
       });
       return false;
     });
   });
 </script>


</body>
</html>
