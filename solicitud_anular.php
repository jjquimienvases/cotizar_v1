<?php
include('conectar.php');
$con = conectar();
$rol_user = '';
session_start();
$rol_user= $_SESSION['id_rol'];

$id_user= $_SESSION['userid'];


//  if($rol_user == 6){
//      $rol_user = 4;
//  }else{
//      $rol_user= $_SESSION['id_rol'];
//  }

$tmp = array();
$res = array();

// $status = "solicitud";

$sel = $con->query("SELECT * FROM solicitud_anular ORDER BY fecha_solicitud DESC");
while ($row = $sel->fetch_assoc()) {
    $tmp = $row;
    array_push($res, $tmp);
}


include_once '../conexion_proveedor.php';

if(isset($_POST['btn_buscar'])){
  $buscar_text=$_POST['buscar'];
  $select_buscar=$con->prepare('
    SELECT * FROM solicitud_anular WHERE order_date LIKE :campo OR order_id LIKE :campo OR cliente LIKE :campo OR comercial LIKE :campo;'
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
        <title>Anular Cotizacion</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    </head>
    <body>
      <h2>Ver solicitudes de anulacion</h2>
      <center><h2>Buscar Solicitudes de anulacion</h2>
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
                  <th scope="col">Fecha solicitud</th>
                  <th scope="col">Cotizacion</th>
                  <th scope="col">Cliente</th>
                  <th scope="col">Comercial</th>
                  <th scope="col">Razon</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Fecha anulacion</th>                  
                  <th scope="col">Bodega</th>                  
                  <th scope="col">Anular</th>
              </tr>
          </thead>
          <tbody>
              <?php foreach ($res as $val) { ?>
                      <form class="" action="anular.php" method="post">
                  <tr>
                      <td><?php echo $val['fecha_solicitud']; ?> </td>
                      <td> <input type="text" class="form-control" name="cotizacion" value="<?php echo $val['order_id']; ?>">  </td>
                      <td> <input type="text" class="form-control" name="cliente" value="<?php echo $val['cliente']; ?>">  </td>
                      <td> <input type="text" class="form-control" name="comercial" value="<?php echo $val['comercial']; ?>"> </td>
                      <td> <input type="text" class="form-control" name="razon" value="<?php echo $val['razon']; ?>">  </td>
                      <td> <input type="text" class="form-control" name="estado" value="<?php echo $val['estado']; ?>">  </td>
                      <td><?php echo $val['fecha_anulacion']; ?></td>
                      <td>
                         <select class="form-control" name="bodega">
                             <option value="producto">Mostrador principal</option>
                             <option value="producto_d1">Mostrador D1</option>
                             <option value="productos_ibague">Ibague</option>
                             <option value="producto_av">Call Center</option>
                         </select>
                      </td>
                      <td>
                          <?php 
                             $cotizacion = $val['order_id'];
                             $id = $val['id'];
                              $boton = "<button type='submit' name='send' value='$id' class='btn btn-danger'>Anular</button>";
                              
                             if($val['estado'] == "anulado"){
                                 echo "Ya esta anulada";
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