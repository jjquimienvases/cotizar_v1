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
 ?>
