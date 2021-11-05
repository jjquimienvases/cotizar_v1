<?php
// $conexion=mysqli_connect('ftp.profruver.com','profru_jjquimi','LeinerM4ster','profru_cotpruebas');

include_once 'conectar.php';
	$conexion= conectar();

$id =$_POST['id'];
$contratipo=$_POST['contratipo'];
$genero=$_POST['genero'];
$precio=$_POST['gramo'];
$stock=$_POST['stock'];
$categoria=$_POST['id_categoria'];
$peso = $_POST['peso'];
$unidad = $_POST['unidad'];
$ubicacion = $_POST['ubicacion'];
$nombreImg=$_FILES['imagen']['name'];
$ruta=$_FILES['imagen']['tmp_name'];
$destino="./imagenes/".$nombreImg;

         $sql="INSERT INTO producto (id,contratipo,genero,stock,gramo,id_categoria,imagen,ruta,peso,ubicacion,unidad) VALUES ('$id','$contratipo','$genero','$stock','$precio','$categoria','$nombreImg','$destino','$peso','$ubicacion','$unidad')";
         $did = mysqli_query($conexion,$sql);

         $sql2="INSERT INTO productos_ibague (id,contratipo,genero,stock,gramo,id_categoria,imagen,ruta,peso,ubicacion,unidad) VALUES ('$id','$contratipo','$genero','$stock','$precio','$categoria','$nombreImg','$destino','$peso','$ubicacion','$unidad')";
         $did = mysqli_query($conexion,$sql2);
         
                  $sql2="INSERT INTO producto_d1 (id,contratipo,genero,stock,gramo,id_categoria,imagen,ruta,peso,ubicacion,unidad) VALUES ('$id','$contratipo','$genero','$stock','$precio','$categoria','$nombreImg','$destino','$peso','$ubicacion','$unidad')";
         $did = mysqli_query($conexion,$sql2);
         
                  $sql2="INSERT INTO producto_av (id,contratipo,genero,stock,gramo,id_categoria,imagen,ruta,peso,ubicacion,unidad) VALUES ('$id','$contratipo','$genero','$stock','$precio','$categoria','$nombreImg','$destino','$peso','$ubicacion','$unidad')";
         $did = mysqli_query($conexion,$sql2);

        echo $did;


  ?>
