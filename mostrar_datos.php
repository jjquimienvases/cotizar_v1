<?php

  include 'conectar.php';
  $conexion = conectar();
  session_start();
  
  $usuario = $_SESSION['userid'];
 
 


  $consulta = $conexion->query("SELECT * FROM modal_info WHERE user = '$usuario'");

   echo "
       <table border='1px' width='65%' aling='center'>
       <tr>
          <th>Eliminar</th>

          <th>Codigo </th>
          <th>Producto </th>
          <th>Envase </th>
          <th>Gramos </th>
          <th>Cantidad </th>
          <th>Precio </th>
          <th width='25%'>Total </th>

      </tr>
   ";

   while ($registro = mysqli_fetch_array($consulta)){
       echo "<tr>
       <td> <button id='eliminar' data-id='".$registro["id"]."'>Eliminar </button> </td>
             <input type='hidden' name='stocks' value=".$registro["stock"].">
             <td><input name='pcode' value=".$registro["codigo"]."> </td>
             <td><input name='presentacion' value=".$registro["presentacion"]."> </td>
             <td><input name='envase' value=".$registro["envase"]."> </td>
             <td><input name='gramos' value=".$registro["gramos"]."> </td>
             <td><input name='cantidad' value=".$registro["cantidad"]."> </td>
             <td><input name='preciou' value=".$registro["precio"]."> </td>
             <td><input id='monto' name='totals' value=".$registro["total"]."> </td>
           

            </tr>";
   }

   echo "</table>";
 ?>
