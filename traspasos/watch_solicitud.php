

<?php
  include 'conexion.php';

  session_start();

  $user_name = $_SESSION['user'];
  $user_rol =$_SESSION['id_rol'];
  $estado_solicitud = "Solicitud Finalizada";
//   $bodega_entrada = "productos_ibague";
  
   $fecha_inicio = $_POST['fecha_inicial']." "."07:50:00";
   $fecha_final = $_POST['fecha_final']." "."07:50:00";
   $bodega_entrada = $_POST['detino'];
   $bodega_salida = $_POST['origen'];
    $consultando = $conexion ->query("SELECT * FROM traspasos WHERE order_date = '$fecha_inicio' AND '$fecha_final' AND estado = '$estado_solicitud' AND bodega_entrada = '$bodega_entrada' AND bodega_salida = '$bodega_salida'");


//   $consulta = $conexion->query("SELECT * FROM traspasos WHERE order_date = '$fecha_inicio' AND '$fecha_final' AND estado = '$estado_solicitud' AND bodega_entrada = '$bodega_entrada' AND bodega_salida = '$bodega_salida'");
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
      <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
     <link rel="stylesheet" href="../css/estilos.css">
     <title>Solicitudes de mercancia</title>
   </head>
   <body>
       
       <h3>Solicitudes de mercancia</h3>
       <form action="" method="post">
           <label>Seleccionar Una fecha inicial</label>
            <input type="date" name="fecha_inicial">
    <hr>
           
            <label>Seleccionar Una fecha Final</label>
            <input type="date" name="fecha_inicial">
            
    <br><hr>
    <label>Seleccionar una bodega de origen</label>
    <br>
    <select name="origen">
         <option value="producto_av">Bodega principal</option>
         <option value="producto">Mostrador Principal</option>
         <option value="producto_d1">Mostrador D1</option>
         <option value="productos_ibague">Ibague</option>
    </select>
    <hr>
        <label>Seleccionar una bodega destino</label>
    <br>
    <select name="destino">
         <option value="producto_av">Bodega principal</option>
         <option value="producto">Mostrador Principal</option>
         <option value="producto_d1">Mostrador D1</option>
         <option value="productos_ibague">Ibague</option>
    </select>
    <br>
    <button type="submit" value="buscador" name="buscador">Buscar</button>
       </form>
       
<?php

if(isset($_POST['fecha_inicial'])){
    
while ($registros = mysqli_fetch_array($consultando)){
    $codigo = $registros['codigo']; 
    $fecha = $registros['order_date']; 
    $producto = $registros['producto']; 
    $cantidad = $registros['cantidad']; 
    $destino = $registros['bodega_entrada']; 
    $check = "<input type='checkbox'>";
    echo "
     <table class='table'> 
     <thead class='thead-dark'>
    <tr>
      <th scope='col'>Fecha</th>
      <th scope='col'>Codigo</th>
      <th scope='col'>Producto </th>
      <th scope='col'>Cantidad </th>
  </tr>
  </thead>
  <tbody>
   <tr>

  <td>$fecha</td>
   <td>$codigo</td>
    <td>$producto</td>
   <td>$cantidad</td>
      <td>$destino</td>
     <td>$check</td>
   </tr>
   </tbody>
   </table> ";
}


}else{
echo "Hacer una consulta";    
}
 ?>
 
 
 
   </body>
 </html>
