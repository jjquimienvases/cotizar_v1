<script type="text/javascript">

function stopDefAction(evt) {
  evt.preventDefault();
}
</script>


<?php
if(isset($_POST['btn_buscar'])){
  $buscar_text=$_POST['buscar'];
  $select_buscar=$con->prepare('
    SELECT * FROM factura_orden WHERE order_id LIKE :campo OR order_date LIKE :campo OR order_receiver_name LIKE :campo;'
  );

  $select_buscar->execute(array(
    ':campo' =>"%".$buscar_text."%"
  ));

  $res=$select_buscar->fetchAll();

}

function formatear($num){
	setlocale(LC_MONETARY, 'en_US');
	return "$" . number_format($num, 2);
}
 ?>


<form method="post">
    <?php  foreach ($res as $val) {
    $montox =0;
    $order_total_after_tax = $val['order_total_after_tax'];
    $order_total_amount_due = $val['order_total_amount_due'];
    if($order_total_amount_due == "" || $order_total_amount_due == 0){
        $montox = $order_total_after_tax;
    }else{
        $montox = $order_total_amount_due;
    }
    ?>
    <tr>
        <td><?php echo $val['order_date'] ?> </td>

        <td> <input type="text" name="id" value="<?php echo $val['order_id']; ?>" id="cot_id" readonly>  </td>
        <td><?php echo $val['order_receiver_name'] ?></td>
        <td><?php echo $val['order_receiver_address'] ?></td>
        <td><?php echo formatear($montox) ?></td>
        <?php if(isset($val['order_id'])){
             $estado = $val['estado'];
            

              if ($estado == "pendiente") {
                echo '<td> <a href="../print_invoice.php?invoice_id='.$val["order_id"].'" title="Imprimir Factura"><div class="btn btn-primary"><span class="glyphicon glyphicon-print">Ver Cotizacion</span></div></a></td>';
              }else{
                echo "<td id='okok'>
                No se puede imprimir
                     </td>";
              }
          } ?>

       <?php
       $estado = $val['estado'];
       //$boton_estado = "<button data-toggle='modal' data-target='#exampleModal' onclick='stopDefAction(event);' id='status_button' >$estado</button>";


             $cotizacion = $val['order_id'];
             $boton_estado_2 = "<button type='button' data-toggle='modal' data-target='#exampleModal' name='buscarcliente' onclick='generate_e($cotizacion)' id='buscarcliente' value='$cotizacion' class='buscaCliente' >$estado</button>"; 

       if($estado == "pendiente"){
         echo "<td id='pendiente'>
          $boton_estado_2
               </td>";
       }else if($estado == "Finalizado") {
          echo "<td id='finished'>
              $estado
                </td>";
       }else{
         echo "<td id='other_status'>
             $estado
               </td>";
       }

        ?>


    </tr>
       <?php } ?>
      </form>
