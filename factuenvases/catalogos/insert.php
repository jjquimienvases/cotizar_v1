<?php
	include_once 'conectar.php';
	$conn= conectar();

	if(isset($_POST['guardar']) && isset($_FILES['imagen'])){
		$id =$_POST['id'];
		$contratipo=$_POST['contratipo'];
		$genero=$_POST['genero'];
		$precio=$_POST['gramo'];
		$stock=$_POST['stock'];
		$stock2 = "";
		$categoria=$_POST['id_categoria'];
		$peso = $_POST['peso'];
		$unidad = $_POST['unidad'];
		$ubicacion = $_POST['ubicacion'];
		$minimo = $_POST['minimo'];
		$maximo = $_POST['maximo'];
		$nombreImg=$_FILES['imagen']['name'];
		$ruta=$_FILES['imagen']['tmp_name'];
		$destino="./images/".$nombreImg;
	     if(copy($ruta,$destino)){
         $sql="INSERT INTO producto (id,contratipo,genero,stock,gramo,id_categoria,imagen,ruta,peso,ubicacion,unidad,minimo,maximo) VALUES ('$id','$contratipo','$genero','$stock2','$precio','$categoria','$nombreImg','$destino','$peso','$ubicacion','$unidad','$minimo','$maximo')";

		$res=mysqli_query($conn,$sql);
				 
	     $sql2 = "INSERT INTO productos_ibague (id,contratipo,genero,stock,gramo,id_categoria,imagen,ruta,peso,ubicacion,unidad,minimo,maximo) VALUES ('$id','$contratipo','$genero','$stock2','$precio','$categoria','$nombreImg','$destino','$peso','$ubicacion','$unidad','$minimo','$maximo')"; 	
	     
	       $respues = mysqli_query($conn,$sql2);     
	       
	       $sql3 = "INSERT INTO producto_av (id,contratipo,genero,stock,gramo,id_categoria,imagen,ruta,peso,ubicacion,unidad,minimo,maximo) VALUES ('$id','$contratipo','$genero','$stock','$precio','$categoria','$nombreImg','$destino','$peso','$ubicacion','$unidad','$minimo','$maximo')"; 	
	     
	       $respues = mysqli_query($conn,$sql3);
	       
	       $sql4 = "INSERT INTO producto_d1 (id,contratipo,genero,stock,gramo,id_categoria,imagen,ruta,peso,ubicacion,unidad,minimo,maximo) VALUES ('$id','$contratipo','$genero','$stock2','$precio','$categoria','$nombreImg','$destino','$peso','$ubicacion','$unidad','$minimo','$maximo')"; 	
	     
	       $respues = mysqli_query($conn,$sql4);
	       
		if($res){
				echo '<script type="text/javascript"> alert("Producto agregado correctamente"); window.location="admin_productos.php";</script>';

		}else{
				die("Error".mysqli_error($conn));
		}

}
}




				//
				// 	 "<script> alert('Poducto agregado correctamente');  </script>";
				// 	 header('Location: catalogos.php');
				// 	 }else{
				// 	 echo "<script> alert('No se cargo el producto');</script>";
				//  }
			  // }

?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="euc-jp">
	
	<title>Nuevo Producto</title>
<link rel="stylesheet" href="css/estilo0.css">
</head>
<body>
	<div class="contenedor">
		<h2>Anadir un nuevo producto</h2>
	
		
		
				<form action="" method="post" id="insertar" enctype="multipart/form-data">
			<div class="form-group">
			<label for="">ID</label>	<input type="text" name="id" placeholder="ID" class="input__text">
			 <label for="">Contratipo</label>	<input type="text" name="contratipo" placeholder="Contratipo" class="input__text">
			<label for="">Genero</label>	<input type="text" name="genero" placeholder="Genero" class="input__text">
			<label for="">ubicacion</label> <input type="text" name="ubicacion" placeholder="Ubicacion" class="input__text">
			</div>
			<div class="form-group">
			<label for="">Stock</label>	<input type="text" name="stock" placeholder="stock" class="input__text">
			<label for="">Precio</label>	<input type="text" name="gramo" placeholder="precio" class="input__text">
			<label for="">Categoria</label> <input type="text" name="id_categoria" placeholder="Categoria" class="input__text">
			</div>
			<div class = "form-group">
			<label for="">Peso en gramos</label> <input type="text" name="peso" placeholder="Peso en gramos" class="input__text">
			<label for="">unidad de empaque</label> <input type="text" name="unidad" placeholder="Unidad Empaque" class="input__text">
			</div>

			<div class="img">
			 <label for="">Stock Minimo:</label> <input type="text" name="minimo" placeholder="Stock Minimo" class="input__text">
		   	 <label for="">Stock Maximo:</label> <input type="text" name="maximo" placeholder="Stock Maximo" class="input__text">    
			    
			    <label for="">Adjuntar una imagen</label>
				<input type="file" name="imagen" id="imagen" >
			</div>
			<div class="btn__group">
				 <a href="admin_productos.php" class="btn btn__danger">Cancelar</a> 
				<input type="submit" id="guardando" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
		</form>
		
		
	</div>
</body>
</html>
