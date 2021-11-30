<?php
  include '../conexion.php';

  session_start();

  $user_name = $_SESSION['user'];
  $user_rol =$_SESSION['id_rol'];
  $user_id  = $_SESSION['userid'];
  $estado_solicitud = "solicitud";
  
  var_dump($user_id);
//   $bodega_entrada = "productos_ibague";
  
  
  if ($user_rol == 1) {
    $bodega_entrada = "producto_av";
  }else if($user_rol == 2){
    $bodega_entrada = "producto";
  }else if($user_rol == 3){
    $bodega_entrada = "producto_d1";
  }else if($user_rol == 4 OR $user_rol == 6){
    $bodega_entrada = "producto_av";
  }else if($user_id == 27){
      $bodega_entrada = "productos_ibague2";
  }else if($user_rol == 7){
    $bodega_entrada = "productos_ibague";
  }


  $consulta = $conexion->query("SELECT * FROM traspasos WHERE estado = '$estado_solicitud' AND bodega_entrada = '$bodega_entrada'");

 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head><meta charset="euc-jp">
     
     <link rel="stylesheet" href="../css/estilos.css">
     <title></title>
   </head>
   <body>
<?php
echo "
$bodega_entrada;

$user_rol;
    <table class='table'>
    <tr class='head_table'>
       <th scope='col'>Fecha</th>
       <th scope='col'>Codigo</th>
       <th scope='col'>Producto </th>
       <th scope='col'>Cantidad </th>
       <th scope='col' style='width:90%;'>Cancelar</th>
   </tr>
";

while ($registro = mysqli_fetch_array($consulta)){

    echo "<tr>
          <td><input class='tamaño_input' name='fecha' value=".$registro["order_date"]."> </td>
          <td><input class='tamaño_input' name='codigo' value=".$registro["codigo"]." > </td>
          <td>".$registro["producto"]."</td>
          <td><input class='tamaño_input' name='cantidad' value=".$registro["cantidad"]."> </td>
          <td> <button id='eliminar' data-id='".$registro["id"]."' class='btn btn-danger'>X</button> </td>
         </tr>";
}
echo "</table>";
 ?>
   </body>
 </html>
