<?php
// $mysqli = new mysqli("localhost","root","","cotpruebas");
// $conexion=mysqli_connect('ftp.profruver.com','profru_jjquimi','LeinerM4ster','profru_cotpruebas');

include_once 'conectar.php';
	$conexion= conectar();
  session_start();
  
  $user = $_SESSION['user'];
  $date_time = DATE('Y-m-d H:m:s');
// Check connection
if ($conexion -> connect_errno) {
echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
exit();
}else {
  echo "conectado correctamente";
}

//datos formulario

$id =$_POST['id'];
$contratipo=$_POST['contratipo'];
$genero=$_POST['genero'];
$precio=$_POST['gramo'];
$stock=$_POST['stock'];
$categoria=$_POST['id_categoria'];
$peso = $_POST['peso'];
$unidad = $_POST['unidad'];
$ubicacion = $_POST['ubicacion'];
$stock_minimo = $_POST['minimo'];
$stock_maximo = $_POST['maximo'];
$act_img = $_POST['act_img'];
$nombreImg=$_FILES['imagenes']['name'];
$ruta=$_FILES['imagenes']['tmp_name'];
$destino= __DIR__.DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR.$nombreImg;


$sql_stock_info = $conexion->query("SELECT * FROM producto_av WHERE id = $id");

foreach($sql_stock_info as $data_information){
    $stock_anterior = $data_information['stock']; 
}





//update mostrador principal
$sql_Update = "UPDATE producto SET contratipo = '$contratipo',
genero = '$genero',
gramo = '$precio',
id_categoria = '$categoria',
peso = '$peso',
unidad = '$unidad',
ubicacion = '$ubicacion',
minimo = '$stock_minimo',
maximo = '$stock_maximo'
WHERE id = '$id'";
$did = mysqli_query($conexion,$sql_Update);

//update av_villas
$sql_Update = "UPDATE producto_av SET contratipo = '$contratipo',
genero = '$genero',
gramo = '$precio',
stock = '$stock',
id_categoria = '$categoria',
peso = '$peso',
unidad = '$unidad',
ubicacion = '$ubicacion',
minimo = '$stock_minimo',
maximo = '$stock_maximo'
WHERE id = '$id'";
$did = mysqli_query($conexion,$sql_Update);

//update D1
$sql_Update = "UPDATE producto_d1 SET contratipo = '$contratipo',
genero = '$genero',
gramo = '$precio',
id_categoria = '$categoria',
peso = '$peso',
unidad = '$unidad',
ubicacion = '$ubicacion',
minimo = '$stock_minimo',
maximo = '$stock_maximo'
WHERE id = '$id'";
$did = mysqli_query($conexion,$sql_Update);


//update ibague
$sql_Update = "UPDATE productos_ibague SET contratipo = '$contratipo',
genero = '$genero',
gramo = '$precio',
id_categoria = '$categoria',
peso = '$peso',
unidad = '$unidad',
ubicacion = '$ubicacion',
minimo = '$stock_minimo',
maximo = '$stock_maximo'
WHERE id = '$id'";
$did = mysqli_query($conexion,$sql_Update);


$sql_update_img = "UPDATE producto SET imagen = '$nombreImg',
ruta = '$destino' WHERE id = '$id'";
if(copy($ruta,$destino) && $act_img == 1){
  $did = mysqli_query($conexion,$sql_update_img);
}
$sql_update_img = "UPDATE producto_av SET imagen = '$nombreImg',
ruta = '$destino' WHERE id = '$id'";
if(copy($ruta,$destino) && $act_img == 1){
  $did = mysqli_query($conexion,$sql_update_img);
}
$sql_update_img = "UPDATE producto_d1 SET imagen = '$nombreImg',
ruta = '$destino' WHERE id = '$id'";
if(copy($ruta,$destino) && $act_img == 1){
  $did = mysqli_query($conexion,$sql_update_img);
}
$sql_update_img = "UPDATE productos_ibague SET imagen = '$nombreImg',
ruta = '$destino' WHERE id = '$id'";
if(copy($ruta,$destino) && $act_img == 1){
  $did = mysqli_query($conexion,$sql_update_img);
}


 if($did){
       $sql_insert_update = $conexion->query("INSERT INTO changes_stock (item_id,contratipo,cantidad_editada,cantidad_anterior,usuario,order_date) VALUES ($id,'$contratipo',$stock,$stock_anterior,'$user','$date_time')");    
echo '<script type="text/javascript"> alert("Producto actualizado correctamente en todas las bodegas"); window.location="admin_productos.php";</script>';
    }else{}


// consultas

 ?>
