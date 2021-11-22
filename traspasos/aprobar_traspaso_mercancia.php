<?php
include('../conexionss.php');

session_start();
$rol_user= $_SESSION['id_rol'];


$tmp = array();
$res = array();

$status = "transito";

$sel = $con->query("SELECT * FROM traspasos WHERE estado = '$status' AND id_rol_bodega_entrada = $rol_user");
while ($row = $sel->fetch_assoc()) {
    $tmp = $row;
    array_push($res, $tmp);
}


include_once '../conexion_proveedor.php';

if(isset($_POST['btn_buscar'])){
  $buscar_text=$_POST['buscar'];
  $select_buscar=$con->prepare('
    SELECT * FROM traspasos WHERE order_date LIKE :campo OR bodega_salida LIKE :campo OR bodega_entrada LIKE :campo OR codigo LIKE :campo OR producto LIKE :campo AND estado = "transito";'
  );

  $select_buscar->execute(array(
    ':campo' =>"%".$buscar_text."%"
  ));

  $res=$select_buscar->fetchAll();

}

?>


<html>
    <head><meta charset="gb18030">
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.18.0/js/md5.js" integrity="sha512-NpfrQEgzOExS1Ax8fjITKrgBFK87lZbBmvWdZk4suiCC4tsHPrTCsulgIA7Z/+CeWhDpEP/f36mNWgZXDKtTAA==" crossorigin="anonymous"></script>
        <script src="jquery-3.1.1.min.js"></script>

        <title>Aprobar Traspaso</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <style media="screen">
       input{
         decoration:none;
         border: 3px;
       }
    </style>

      </head>
    <body>
      <h2>AQUI VAMOS A VER  Y APROBAR LOS TRASPASOS DE MERCANCIA ENTRE BODEGAS (esto lo hace el que recibe la mercancia)</h2>
      <center><h2>Buscar Traspasos</h2>
      <div class="barra__buscador">
        <form action="" class="formulario" method="post">
          <input type="text" name="buscar" placeholder="buscar ID  o Fecha"
          value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
          <input type="submit" class="btn" name="btn_buscar" value="Buscar">
        </form>
      </div> </center>
      <hr>
      <table class="table table-bordered table-hover" width="90%">
          <thead>
              <tr class="bg-success" style="color:white">
                  <th scope="col">Fecha</th>
                  <th scope="col">Productos</th>
                  <th scope="col">SKU</th>
                  <th scope="col">Cantidad</th>
                  <th scope="col">Q Recibida</th>
                  <th scope="col">Empaca</th>
                  <th scope="col">Bodega Despacho</th>
                  <th scope="col">Bodega Destino</th>
                  <th scope="col">Estado</th>
                  <th scope="col" colspan="2">Accion</th>
              </tr>
          </thead>
          <tbody>
              <?php foreach ($res as $val) { ?>
                      <form class="" action="finalizar_traspaso.php" method="post">
                  <tr>
                      <td><?php echo $val['order_date'] ?> </td>
                      <input  type="hidden" value="<?php echo $val['id']; ?>" name="id"> 
                      <td> <input type="text" name="contratipo" value="<?php echo $val['producto']; ?>">  </td>
                      <td> <input type="text" name="id_codigo" value="<?php echo $val['codigo']; ?>">  </td>
                      <td> <input type="text" name="cantidad" value="<?php echo $val['cantidad']; ?>"> </td>
                      <td> <input type="text" name="new_cantidad" value="" placeholder="Q Recibida"> </td>
                      <td><?php echo $val['empaca']; ?></td>
                      <td> <input type="text" name="bodega_salida" value="<?php echo $val['bodega_salida']; ?>">  </td>
                      <td> <input type="text" name="bodega_entrada" value="<?php echo $val['bodega_entrada']; ?>">  </td>
                      <td><?php echo $val['estado']; ?></td>
                      <td>
                          <?php 
                            $boton = "<button type='submit' name='send' value='Completado' class='btn btn-success'>Aprobar</button>";
                            $boton_cancel = "<button type='submit' name='no_send' value='no se envio' class='btn btn-danger'>No llegó</button>";
                               echo $boton;
                          ?>
                      </td>
                      <td>
                       <?php 
                               echo $boton_cancel;
                          ?>
                      </td>
                  </tr>
                    </form>
              <?php } ?>
          </tbody>
      </table>
    </body>
    </html>
