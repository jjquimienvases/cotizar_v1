<?php
// $conexion=mysqli_connect('ftp.profruver.com','profru_jjquimi','LeinerM4ster','profru_cotpruebas');
include 'conectan.php';


$codigo = $_POST['id'];
$producto = $_POST['contratipo'];
$genero = $_POST['genero'];
$peso = $_POST['peso'];
$uniedad_e = $_POST['unidad'];
$precio = $_POST['gramo'];
$stock = $_POST['stock'];
$categoria = $_POST['id_categoria'];
$ubicacion = $_POST['ubicacion'];
$stock_minimo = $_POST['minimo'];
$stock_maximo = $_POST['maximo'];


//actualizar jj principal todo menos stock general 
$sqlActualizar = "UPDATE producto SET id = '$codigo', contratipo = '$producto', genero = '$genero', gramo = '$precio', id_categoria = '$categoria', ubicacion = '$ubicacion', peso = '$peso', unidad = '$uniedad_e', minimo = '$stock_minimo', maximo = '$stock_maximo' WHERE id = '$codigo'";
$did = mysqli_query($conexion,$sqlActualizar);
//actualizar ibague todo menos stock
$sqlActualizarIB = "UPDATE productos_ibague SET id = '$codigo', contratipo = '$producto', genero = '$genero', gramo = '$precio', id_categoria = '$categoria', ubicacion = '$ubicacion', peso = '$peso', unidad = '$uniedad_e', minimo = '$stock_minimo', maximo = '$stock_maximo' WHERE id = '$codigo'";
$did = mysqli_query($conexion,$sqlActualizarIB);
//actualizar d1 todo menos el stock
$sqlActualizarD1 = "UPDATE producto_d1 SET id = '$codigo', contratipo = '$producto', genero = '$genero', gramo = '$precio', id_categoria = '$categoria', ubicacion = '$ubicacion', peso = '$peso', unidad = '$uniedad_e', minimo = '$stock_minimo', maximo = '$stock_maximo' WHERE id = '$codigo'";
$did = mysqli_query($conexion,$sqlActualizarD1);

//actualizar  av con stock
$sqlActualizarAV = "UPDATE producto_av SET id = '$codigo', contratipo = '$producto', genero = '$genero', gramo = '$precio', id_categoria = '$categoria', ubicacion = '$ubicacion', peso = '$peso', unidad = '$uniedad_e', minimo = '$stock_minimo', maximo = '$stock_maximo', stock = '$stock' WHERE id = '$codigo'";
$did = mysqli_query($conexion,$sqlActualizarAV);


echo $did;
 ?>
