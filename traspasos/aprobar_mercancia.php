<?php
include('../conexionss.php');
$rol_user = '';
session_start();
$rol_user= $_SESSION['id_rol'];

$id_user= $_SESSION['userid'];


 if($rol_user == 6){
     $rol_user = 4;
 }else{
     $rol_user= $_SESSION['id_rol'];
 }

$tmp = array();
$res = array();

$status = "solicitud";

$sel = $con->query("SELECT * FROM traspasos WHERE estado = '$status' AND id_rol_bodega_salida = $rol_user");
while ($row = $sel->fetch_assoc()) {
    $tmp = $row;
    array_push($res, $tmp);
}


include_once '../conexion_proveedor.php';

if(isset($_POST['btn_buscar'])){
  $buscar_text=$_POST['buscar'];
  $select_buscar=$con->prepare('
    SELECT * FROM traspasos WHERE order_date LIKE :campo OR bodega_salida LIKE :campo OR bodega_entrada LIKE :campo OR codigo LIKE :campo OR producto LIKE :campo AND estado = "solicitud";'
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
        <script src="jquery-3.1.1.min.js"></script>
        <title>Aprobar Traspaso</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    </head>
    <body>
      <h2>EN ESTE APARTADO BODEGA PUEDE VER LAS SOLICITUDES DE TRASPASOS</h2>
      <center><h2>Buscar Traspasos</h2>
      <div class="barra__buscador">
        <form action="" class="formulario" method="post">
          <input type="text" name="buscar" placeholder="buscar ID  o Fecha"
          value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
          <input type="submit" class="btn" name="btn_buscar" value="Buscar">
        </form>
      </div> </center>
      <hr>
      <table class="table table-bordered table-hover" width="95%">
          <thead>
              <tr class="bg-primary" style="color:white">
                  <th scope="col">Fecha</th>
                  <th scope="col">Productos</th>
                  <th scope="col">Codigo</th>
                  <th scope="col">Cantidad</th>
                  <th scope="col">Solicita</th>
                  <th scope="col">Bodega Despacho</th>
                  <th scope="col">Bodega Destino</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Accion</th>
              </tr>
          </thead>
          <tbody>
              <?php foreach ($res as $val) { ?>
                      <form class="" action="update_estado_traspaso.php" method="post">
                  <tr>
                      <td><?php echo $val['order_date'] ?> </td>
                      <td> <input type="text" name="contratipo" value="<?php echo $val['producto']; ?>">  </td>
                      <td> <input type="text" name="id" value="<?php echo $val['codigo']; ?>">  </td>
                      <td> <input type="text" name="cantidad" value="<?php echo $val['cantidad']; ?>"> </td>
                      <td><?php echo $val['solicita']; ?></td>
                      <td> <input type="text" name="bodega_salida" value="<?php echo $val['bodega_salida']; ?>">  </td>
                      <td> <input type="text" name="bodega_entrada" value="<?php echo $val['bodega_entrada']; ?>">  </td>
                      <td><?php echo $val['estado']; ?></td>
                      <td>
                          <?php 
                              $boton = "<button type='submit' name='send' value='Completado' class='btn btn-danger'>Aprobar</button>";
                              
                             if($id_user == 29 or $id_user == 31){
                                 echo "No puedes aprobar";
                             }else{
                                 echo $boton;
                             }
                            
                          ?>
                        
                      </td>
                  </tr>
                    </form>
              <?php } ?>
          </tbody>
      </table>
    </body>
    </html>