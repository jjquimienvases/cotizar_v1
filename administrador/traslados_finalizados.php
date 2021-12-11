<?php
include('../conexion.php');

$tmp = array();
$res = array();

$status = "finalizado";

$sel = $con->query("SELECT * FROM traspasos WHERE estado = '$status'");
while ($row = $sel->fetch_assoc()) {
    $tmp = $row;
    array_push($res, $tmp);
}

include_once '../conexion_proveedor.php';

if(isset($_POST['btn_buscar'])){
  $buscar_text=$_POST['buscar'];
  $select_buscar=$con->prepare('
    SELECT * FROM traspasos WHERE order_date LIKE :campo OR bodega_salida LIKE :campo OR bodega_entrada LIKE :campo OR codigo LIKE :campo OR producto LIKE :campo AND estado = "finalizado";'
  );

  $select_buscar->execute(array(
    ':campo' =>"%".$buscar_text."%"
  ));

  $res=$select_buscar->fetchAll();

}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.18.0/js/md5.js" integrity="sha512-NpfrQEgzOExS1Ax8fjITKrgBFK87lZbBmvWdZk4suiCC4tsHPrTCsulgIA7Z/+CeWhDpEP/f36mNWgZXDKtTAA==" crossorigin="anonymous"></script>
        <script src="../traspasos/jquery-3.1.1.min.js"></script>

        <title>Traspasos Efectivos</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    </head>
    <body>
      <h2>AQUI VAMOS A VER  LOS TRASPASOS EFECTIVOS</h2> <hr>
      <center><h2>Buscar Traspasos</h2>
      <div class="barra__buscador">
        <form action="" class="formulario" method="post">
          <input type="text" name="buscar" placeholder="buscar ID  o Fecha"
          value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
          <input type="submit" class="btn" name="btn_buscar" value="Buscar">
        </form>
      </div> </center>
      <hr>

      <table class="table mt-10" width="100%">
          <thead>
              <tr>
                  <th scope="col">Fecha</th>
                  <th scope="col">Producto</th>
                  <th scope="col">ID</th>
                  <th scope="col">Cantidad</th>
                  <th scope="col">Envia</th>
                  <th scope="col">Recibe</th>
                  <th scope="col">Bodega Despacho</th>
                  <th scope="col">Bodega Destino</th>
                  <th scope="col">Estado</th>
              </tr>
          </thead>
          <tbody>
              <?php foreach ($res as $val) { ?>
                      <form class="" action="" method="post">
                  <tr>
                      <td><?php echo $val['order_date'] ?> </td>

                      <td> <input type="text" name="contratipo" value="<?php echo $val['producto']; ?>">  </td>
                      <td> <input type="text" name="id" value="<?php echo $val['codigo']; ?>">  </td>
                      <td> <input type="text" name="cantidad" value="<?php echo $val['cantidad']; ?>"> </td>
                      <td><?php echo $val['solicita']; ?></td>
                      <td><?php echo $val['aprueba']; ?></td>
                      <td> <input type="text" name="bodega_salida" value="<?php echo $val['bodega_salida']; ?>">  </td>
                      <td> <input type="text" name="bodega_entrada" value="<?php echo $val['bodega_entrada']; ?>">  </td>
                      <td><?php echo $val['estado']; ?></td>
                  </tr>
                    </form>
              <?php } ?>
          </tbody>
      </table>
    </body>
    </html>
