<?php
  include '../conexion.php';
  session_start();

  $user_name = $_SESSION['user'];
  $user_rol =$_SESSION['id_rol'];
  $user_id = $_SESSION['userid'];
  $estado_transito = "transito";
  $bodega_entrada = "";
  if ($rol_usuario == 1) {
    $bodega_entrada = "producto_av";
  }else if($rol_usuario == 2){
    $bodega_entrada = "producto";
  }else if($rol_usuario == 3){
    $bodega_entrada = "producto_d1";
  }else if($rol_usuario == 4 OR $rol_usuario = 6){
    $bodega_entrada = "producto_av";
  }else if($user_id == 27){
    $bodega_entrada = "productos_ibague2";
  }else if($rol_usuario == 7){
    $bodega_entrada = "productos_ibague";
  }


  $consulta = $conexion->query("SELECT * FROM traspasos WHERE estado = '$estado_transito' AND bodega_entrada = '$bodega_entrada'");






 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="../css/estilos.css">
     <title></title>
   </head>
   <body>
<?php
echo "
    <table class='table'>
    <tr class='head_table'>
       <th scope='col'>Fecha</th>
       <th scope='col'>Codigo </th>
       <th scope='col'>Producto </th>
       <th scope='col'>Cantidad Enviada </th>
       <th scope='col'>Cantidad Recibida </th>
       <th scope='col' colspan='2' style='width:100%;'>Acciones</th>

   </tr>
";

while ($registro = mysqli_fetch_array($consulta)){
    
    $myJSON=json_encode($registro); 
 
    $mi_onclick = "<button id='change_quantity'>nueva cantidad </button>";
    echo "<tr>
    <td><input class='tamaño_input' name='fecha' value=".$registro["order_date"]."> </td>
    <td><input class='tamaño_input' name='codigo' value=".$registro["codigo"]." > </td>
    <td><input class='tamaño_input' name='producto' value=".$registro["producto"]."> </td>
    <td><input type='number' class='tamaño_input' name='cantidad' value=".$registro["cantidad"].">
    <a href='' onclick='cambiar_cantidad(".$registro['id'].")'>Cantidad</a>
    </td>
    <td><input name='cantidad_recibida' value='' placeholder='Cantidad Recibida'> </td>
    <td><button id='llego' onclick='aprobar(".$registro['id'].")' data-id='".$myJSON."' value=".$registro["id"]." class='btn btn-warning'>aprobar</button> </td>

    <td> <button id='no_llego' data-id='".$registro["id"]."' value=".$registro["id"]." class='btn btn-danger'>No-aprobar</button> </td>
   
    </tr>";

}
echo "</table>";
 ?>
   </body>
 </html>
