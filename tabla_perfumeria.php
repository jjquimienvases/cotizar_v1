<?php
include 'datos.php';

 ?>

<table class="table"  width="940">  <!-- esta es la segunda tabla donde imprimo la informacion que recojo de la base de datos -->
 <thead>
   <th width="100px">Codigo</th>
   <th>Stock</th>
   <th>Presentacion</th>
   <th>Envase</th>
   <th>Gramos</th>
   <th>Cantidad</th>
   <th>P. Unitario</th>
   <th>Total</th>
 </thead>
 <tbody id="tbodi">
 <!-- aqui se imprime la informacion -->
 <?php
     $totall = 0;
   ?>
  <?php foreach ($arr as $value):?>
    <tr>
      <?php
        $codigo = $value['codigo'];
        $presentacion = $value['presentacion'];
        $stock = $value['stock'];
        $envase = $value['envase'];
        $gramos = $value['gramos'];
        $cantidad = $value['cantidad'];
        $precio = $value['precio'];
        $totales = $value['total'];
       ?>
        <td> <input type="text" name="pcode[]" width="100px"  value="<?php echo $codigo; ?>"> </td>
        <td> <input type="text" name="stocks[]" value="<?php echo $value['stock']; ?>"> </td>
        <td> <input type="text" name="presentacion[]" value="<?php echo $value['presentacion']; ?>"> </td>
        <td> <input type="text" name="envase[]" value="<?php echo $value['envase']; ?>"> </td>
        <td> <input type="text" name="gramos[]" value="<?php echo $value['gramos']; ?>"> </td>
        <td> <input type="text" name="cantidad[]" value="<?php echo $value['cantidad']; ?>"> </td>
        <td> <input type="text" name="preciou[]" value="<?php echo $value['precio']; ?>"> </td>
        <td> <input type="text" name="totals[]" id="ttpe" value="<?php echo $value['total']; ?>"> </td>
        <input type="hidden" name="id[]" id="id"  value="<?php echo $value['id']; ?>">
        <td> <button name="button" id="eliminando" class="btn btn-danger">Eliminar</button> </td>
        <?php
         $monto = 0;
         $valor = $value['total'];
         $monto = $valor;
        ?>

        <?php  $totall += $monto; ?>
   </tr>


  <?php endforeach; ?>

 </tbody>

 <tfoot>
 <tr>
   <td colspan="7">MONTO TOTAL:</td>
   <td> <input type="text" name="" id="ttpes" width="50%" value="<?= $totall; ?>"> </td>
 </tr>
</tfoot>
   <?php //include 'tfoot.php'; ?>

</table>
